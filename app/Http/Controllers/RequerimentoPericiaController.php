<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RequerimentoPericia;
use App\Models\DocumentoAtestado;
use App\Models\DocumentoAfastamento;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use DB;
use Config;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Mail\MailNotify;

class RequerimentoPericiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requerimentos = RequerimentoPericia::with('user')->get();

        return view('index', compact('requerimentos'));
    }

    public function arquivo()
    {
        $requerimentos = RequerimentoPericia::all();

        return view('arquivo', compact('requerimentos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('requerimento_pericia.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $requerimento = new RequerimentoPericia;
            $validatedData = $request->validate([
                'nome' => 'required|max:255',
                'matricula' => 'required|max:255',
                'local_lotacao' => 'required|max:255',
                'trabalho_inicio' => 'required|max:255',
                'trabalho_fim' => 'required|max:255',
                'dt_inicio_atestado' => 'required|max:255',
                'vinculo' => 'required|max:255',
                'email' => 'required|max:255',
            ]);
            
            // Atribuir informações do formulário.
            $requerimento->nome                     = $request->nome;
            $requerimento->matricula                = $request->matricula;
            $requerimento->local_lotacao            = $request->local_lotacao;
            /* $requerimento->horario_trabalho         = $request->horario_trabalho; */
            $requerimento->horario_trabalho         = $request->trabalho_inicio.' às '.$request->trabalho_fim;
            $requerimento->dt_inicio_atestado       = $request->dt_inicio_atestado;
            $requerimento->email                    = $request->email;
            $requerimento->status                   = 0;
            $requerimento->vinculo                  = $request->vinculo;

            // Atribuir data atual.
            $data_atual = Carbon::now('America/Sao_Paulo')->format('His');
            
            // Caracteres aleatórios de A-Z.
            $caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $shuffled = str_shuffle($caracteres);

            // Gerar código de Protocolo:
            $novo_protocolo = strtoupper(substr($shuffled,0,3)).rand(100,999).$data_atual;
            
            // Prevenir repetição de protocolos.
            $protocolo_existe = RequerimentoPericia::where('protocolo','=',$novo_protocolo)->get();
            while (!$protocolo_existe->isEmpty()) {
                $data_atual = Carbon::now('America/Sao_Paulo')->format('His');
                $shuffled = str_shuffle($caracteres);
                $novo_protocolo = strtoupper(substr($shuffled,0,3)).rand(100,999).$data_atual;
                $protocolo_existe = RequerimentoPericia::where('protocolo','=',$novo_protocolo)->get();
            }
            $requerimento->protocolo                = $novo_protocolo;
            $requerimento->save();

            // Recebimento do(s) atestado(s)
            $atestadoFiles = [];
            foreach($request->documento_atestado as $atestado) {
                $filename_atestado = $atestado->store('public/atestados');
                // Inclui o nome dos arquivos em uma array, para a função de exclusão em caso de falha.
                array_push($atestadoFiles, substr($filename_atestado, 17));
                DocumentoAtestado::create([
                    'requerimento_id' => $requerimento->id,
                    'filename' => substr($filename_atestado, 17),
                    'extensao' => $atestado->extension()
                ]);
            }

            // Recebimento do(s) comprovante(s) de afastamento, se incluso(s).
            if(isset($request->documento_afastamento)) {
                $afastamentoFiles = [];
                foreach($request->documento_afastamento as $afastamento) {
                    $filename_afastamento = $afastamento->store('public/afastamentos');
                    // Inclui o nome dos arquivos em uma array, para a função de exclusão em caso de falha.
                    array_push($afastamentoFiles, substr($filename_afastamento, 20));
                    DocumentoAfastamento::create([
                        'requerimento_id' => $requerimento->id,
                        'filename' => substr($filename_afastamento, 20),
                        'extensao' => $afastamento->extension()
                    ]);
                }
            }

            // Visualizar E-mail por View.
            /* $requerimento->update();
            return view('mail/requerimento', compact('requerimento')); */

            // Envio de e-mail após a criação, atribui envio_create = 0 em caso de falha de envio.
            try {
                $mail = env('MAIL_FROM_ADDRESS','');
                Mail::send('mail.requerimento', ['requerimento' => $requerimento], function($m) use ($requerimento, $mail) {
                    $m->from($mail, 'Perícia Médica');
                    $m->subject('Novo Requerimento');
                    $m->to($requerimento->email);
                });         
                $requerimento->envio_create = 1;
                
            } catch (\Throwable $th) {
                $requerimento->envio_create = 0;
            }
            $requerimento->update();

        } catch (\Throwable $th) {
            // Em caso de falha: exclusão do requerimento e documentos enviados.
            DB::rollback();

            foreach($atestadoFiles as $atestado) {
                unlink(storage_path('app/public/atestados/'.$atestado));
            }

            if(isset($afastamentoFiles)) {
                foreach($afastamentoFiles as $afastamento) {
                    unlink(storage_path('app/public/afastamentos/'.$afastamento));
                }
            }
            
            return redirect('/')->with('error', 'Houve um erro ao tentar criar o requerimento, tente novamente.');
        }
        // Aplicar no banco de dados.
        DB::commit();
        return redirect('/')->with('success', 'O protocolo do seu requerimento será informado por e-mail, fique atento e verifique a sua caixa de spam.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $requerimento = RequerimentoPericia::with('doc_atestado', 'doc_afastamento')->find($id);
        $doc_atestados = DocumentoAtestado::where('requerimento_id', $id)->get();
        $doc_afastamentos = DocumentoAfastamento::where('requerimento_id', $id)->get();
        
        return view('show', compact('requerimento', 'doc_atestados', 'doc_afastamentos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $requerimento = RequerimentoPericia::with('doc_atestado', 'doc_afastamento')->find($id);
        $doc_atestados = DocumentoAtestado::where('requerimento_id', $id)->get();
        $doc_afastamentos = DocumentoAfastamento::where('requerimento_id', $id)->get();

        return view('edit', compact('requerimento', 'doc_atestados', 'doc_afastamentos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $requerimento = RequerimentoPericia::findOrFail($id);

            $validatedData = $request->validate([
                'direcionamento' => 'required|max:255',
                'data_agenda' => 'max:255',
                'hora_agenda' => 'max:255',
                'avaliador' => 'max:255',
                'motivo_recusa' => 'max:255',
                'status',
                'envio_agenda',
                'data_avaliacao'
            ]);

            // Atribuir informações da avaliação.
            $requerimento->direcionamento           = $request->direcionamento;
            $requerimento->user_id                  = Auth::user()->id;

            // Requerimentos recusados vs agendados.
            if ($request->direcionamento === "Recusado") {
                $requerimento->status               = 1;
                $requerimento->motivo_recusa        = $request->motivo_recusa;
            } else {
                $requerimento->data_agenda              = date("Y-m-d H:i:s", strtotime(str_replace('/','-',substr($request->data_agenda, 0, 10))." 12:00:00"));
                $requerimento->hora_agenda              = $request->hora_agenda;
                $requerimento->status               = 3;
            };

            // Data da Avaliação
            $data_atual = Carbon::now('America/Sao_Paulo')->format('d/m/Y à\s H:i.');
            $requerimento->data_avaliacao           = $data_atual;

            //Visualizar e-mail por View
            /* $requerimento->update();
            return view('mail/requerimento', compact('requerimento')); */
            
            // Envio de E-mail após avaliação, atribui envio_agenda = 0 em caso de falha de envio.
            try {
                $mail = env('MAIL_FROM_ADDRESS','');
                Mail::send('mail.requerimento', ['requerimento' => $requerimento], function($m) use ($requerimento, $mail) {
                    $m->from($mail, 'Perícia Médica');
                    if ($requerimento->direcionamento === "Recusado") {
                        $m->subject('Requerimento Recusado');
                    } else {
                        $m->subject('Requerimento Agendado');
                    }
                    $m->to($requerimento->email);
                });
                $requerimento->envio_agenda = 1;
            } catch (\Throwable $th) {
                $requerimento->envio_agenda = 0;
            }

            $requerimento->update();

        } catch (\Throwable $th) {
            DB::rollback();
            return redirect('/requerimentos')->with('error', 'Erro ao tentar avaliar o requerimento, tente novamente.');
        }

        DB::commit();
        return redirect('/requerimentos')->with('success', 'Requerimento avaliado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function confirmar()
    {
        return view('requerimento_pericia.confirmar');
    }

    public function confirmacao(Request $request)
    {   
        DB::beginTransaction();
        try {
            if (RequerimentoPericia::where('protocolo', '=', $request->protocolo)->count() <= 0) {
                return redirect('/confirmar')->with('error', 'Certifique-se de que o protocolo inserido esteja correto.');
            }
    
            $data_atual = Carbon::now('America/Sao_Paulo')->format('d/m/Y à\s H:i.');
            $requerimento = RequerimentoPericia::where('protocolo','=', $request->protocolo)->get();
    
            $req = RequerimentoPericia::find($requerimento[0]->id);
    
            if ($req->status === 4) {
                return redirect('/confirmar')->with('confirmado', 'Compareça ao local direcionado na data e hora informados, seguindo as demais instruções informadas por e-mail.');
            } elseif ($req->status === 1) {
                return redirect('/confirmar')->with('recusado', 'Este requerimento foi recusado pela perícia médica.');
            } elseif ($req->status === 0) {
                return redirect('/confirmar')->with('analise', 'A resposta por e-mail com o agendamento poderá se dar em até 48 horas úteis da solicitação.');
            }
            
            $req->status = 4;
            $req->data_confirmacao = $data_atual;
    
            $req->save();

        } catch (\Throwable $th) {
            DB::rollback();
            return redirect('/confirmar')->with('error', 'Houve um erro ao tentar confirmar o requerimento, tente novamente.');
        }
        DB::commit();
        return redirect('/confirmar')->with('success', 'Compareça ao local direcionado na data e hora informados, seguindo as demais instruções informadas por e-mail.');
    }

}
