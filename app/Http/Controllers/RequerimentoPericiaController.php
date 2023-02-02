<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RequerimentoPericia;
use App\Models\Direcionamento;
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

        return view('requerimento_pericia/index', compact('requerimentos'));
    }

    public function diario()
    {
        $data_atual = Carbon::now('America/Sao_Paulo')->format('Y-m-d 12:00:00');
        $requerimentos = RequerimentoPericia::where('status', 4)->where('data_agenda', $data_atual)->orWhere([['data_reagendada', $data_atual], ['status', 4]])->get();
        return view('requerimento_pericia/diario', compact('requerimentos'));
    }

    public function presente(Request $request)
    {   
        DB::beginTransaction();
        try {
            $requerimento = RequerimentoPericia::where('id','=', $request->id)->get();
            
            $req = RequerimentoPericia::find($requerimento[0]->id);
            
            $req->presenca = 1;
            
            $req->save();

        } catch (\Throwable $th) {
            DB::rollback();
            
            return redirect()->back()->with('error', 'Houve um erro ao marcar a presença, tente novamente.');
        }
        DB::commit();
        return redirect()->back()->with('success', 'Presença marcada com sucesso.');
    }

    public function ausente(Request $request)
    {   
        DB::beginTransaction();
        try {
            $requerimento = RequerimentoPericia::where('id','=', $request->id)->get();
            
            $req = RequerimentoPericia::find($requerimento[0]->id);
            
            $req->presenca = 0;
            
            $req->save();

        } catch (\Throwable $th) {
            DB::rollback();
            
            return redirect()->back()->with('error', 'Houve um erro ao marcar a ausência, tente novamente.');
        }
        DB::commit();
        return redirect()->back()->with('success', 'Ausência marcada com sucesso.');
    }

    public function arquivo()
    {
        $requerimentos = RequerimentoPericia::all();

        return view('requerimento_pericia/arquivo', compact('requerimentos'));
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
        
        return view('requerimento_pericia/show', compact('requerimento', 'doc_atestados', 'doc_afastamentos'));
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
        
        $avPsiquiatrica = Direcionamento::where('nome', "Avaliação Psiquiátrica")->first();
        $atPericial = Direcionamento::where('nome', "Atendimento Pericial")->first();
        $jtMedica = Direcionamento::where('nome', "Junta Médica")->first();

        $avPsiquiatricaConfig = json_decode($avPsiquiatrica->config);
        $atPericialConfig     = json_decode($atPericial->config);
        $jtMedicaConfig       = json_decode($jtMedica->config);

        // dd($avPsiquiatricaConfig, $atPericialConfig, $jtMedicaConfig);

        return view('requerimento_pericia/edit', compact('requerimento', 'doc_atestados', 'doc_afastamentos', 'avPsiquiatricaConfig', 'atPericialConfig', 'jtMedicaConfig'));
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
                'data_avaliacao'
            ]);

            // Atribuir informações da avaliação.
            $requerimento->direcionamento           = $request->direcionamento;
            $requerimento->user_id                  = Auth::user()->id;

            // Data da Avaliação/Reagendamento
            $data_atual = Carbon::now('America/Sao_Paulo')->format('d/m/Y à\s H:i.');
            
            // Requerimentos recusados vs agendados vs reagendar.
            if ($request->direcionamento === "Recusado") {
                $requerimento->motivo_recusa        = $request->motivo_recusa;
                $requerimento->data_avaliacao       = $data_atual;
                $requerimento->status               = 1;
                $requerimento->observacao           = $request->observacao;
                $reagenda                           = 0;

            } else if ($request->direcionamento === "COVID") {
                $requerimento->data_avaliacao       = $data_atual;
                $requerimento->status               = 4;
                $requerimento->observacao           = $request->observacao;
                $reagenda                           = 0;

            } else if ($requerimento->status === 0) {
                $requerimento->data_agenda          = date("Y-m-d H:i:s", strtotime(str_replace('/','-',substr($request->data_agenda, 0, 10))." 12:00:00"));
                $requerimento->hora_agenda          = $request->hora_agenda;
                $requerimento->observacao           = $request->observacao;
                $requerimento->status               = 3;
                $requerimento->data_avaliacao       = $data_atual;
                $reagenda                           = 0;

            } else if ($requerimento->status === 5) {
                $requerimento->data_reagenda        = $data_atual;
                $requerimento->data_reagendada      = date("Y-m-d H:i:s", strtotime(str_replace('/','-',substr($request->data_agenda, 0, 10))." 12:00:00"));
                $requerimento->hora_reagendada      = $request->hora_agenda;
                $requerimento->observacao_reagenda  = $request->observacao;
                $requerimento->quant_reagendas      = $requerimento->quant_reagendas + 1;
                $requerimento->status               = 3;
                $reagenda                           = 1;
            }

            //Visualizar e-mail por View
            /* $requerimento->update();
            DB::commit();
            return view('mail/requerimento', compact('requerimento')); */
            
            // Envio de E-mail após avaliação, atribui envio = 0 em caso de falha de envio.
            try {
                if ($reagenda === 1) {
                    // Visualizar por View
                    /* $requerimento->update();
                    DB::commit();
                    return view('mail/reagenda', compact('requerimento')); */
                    
                    $mail = env('MAIL_FROM_ADDRESS','gesol@mesquita.rj.gov.br');
                    Mail::send('mail.reagenda', ['requerimento' => $requerimento], function($m) use ($requerimento, $mail) {
                        $m->from($mail, 'Perícia Médica');
                        $m->subject('Requerimento Reagendado');
                        $m->to($requerimento->email);
                    });
                    $requerimento->envio_reagenda = 1;

                } else if ($requerimento->direcionamento === "COVID") {
                    // Visualizar por View:
                    /* $requerimento->update();
                    DB::commit();
                    return view('mail/covid', compact('requerimento')); */

                    $mail = env('MAIL_FROM_ADDRESS','gesol@mesquita.rj.gov.br');
                    Mail::send('mail.covid', ['requerimento' => $requerimento], function($m) use ($requerimento, $mail) {
                        $m->from($mail, 'Perícia Médica');
                        $m->subject('Requerimento Finalizado');
                        $m->to($requerimento->email);
                    });
                    $requerimento->envio_agenda = 1;

                } else {
                    $mail = env('MAIL_FROM_ADDRESS','gesol@mesquita.rj.gov.br');
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
                }
                
            } catch (\Throwable $th) {
                if ($reagenda === 1) {
                    $requerimento->envio_reagenda = 0;
                } else {
                    $requerimento->envio_agenda = 0;
                }
            }

            $requerimento->update();

        } catch (\Throwable $th) {
            DB::rollback();
            dd($th);
            return redirect('/requerimentos')->with('error', 'Erro ao tentar avaliar o requerimento, tente novamente.');
        }

        DB::commit();
        return redirect('/requerimentos')->with('success', 'Requerimento avaliado com sucesso.');
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
            } elseif ($req->status === 0 or $req->status === 5) {
                return redirect('/confirmar')->with('analise', 'A resposta por e-mail com o agendamento poderá se dar em até 48 horas úteis da solicitação.');
            }

            if ($request->reagendar == 0) {
                if($req->quant_reagendas == 0) {
                    $req->data_confirmacao = $data_atual;
                } else {
                    $req->data_confirmacaoreagenda = $data_atual;
                }
                
                $req->status = 4;
                $req->save();
                DB::commit();
                return redirect('/sucesso')->with('confirmado', 'Compareça ao local direcionado na data e hora informados, seguindo as demais instruções informadas por e-mail.');
            } else {
                $req->data_pedidoreagenda = $data_atual;
                $req->justificativa_reagenda = $request->justificativa_reagenda;
                $req->status = 5;
                $req->save();
                DB::commit();
                return redirect('/sucesso')->with('reagendar', 'A resposta por e-mail com o agendamento poderá se dar em até 48 horas úteis da solicitação.');
            }

        } catch (\Throwable $th) {
            DB::rollback();
            return redirect('/confirmar')->with('error', 'Houve um erro ao tentar confirmar o requerimento, tente novamente.');
        }
    }

    public function confirmacaointerna(Request $request)
    {
        DB::beginTransaction();
        try {
            $data_atual = Carbon::now('America/Sao_Paulo')->format('d/m/Y à\s H:i.');
            $requerimento = RequerimentoPericia::where('protocolo','=', $request->protocolo)->first();
            
            /* Único vs Reagendado */
            if($requerimento->quant_reagendas == 0) {
                $requerimento->data_confirmacao = $data_atual;
            } else {
                $requerimento->data_confirmacaoreagenda = $data_atual;
            }

            $requerimento->presenca  = $request->presenca;
            $requerimento->status    = 4;
            $requerimento->save();

            DB::commit();
            return redirect('/requerimentos')->with('success', 'Requerimento finalizado com sucesso.');

        } catch(\Throwable $th) {
            dd($th);
            DB::rollback();
            return redirect('/requerimentos')->with('error', 'Houve um erro ao finalizar o requerimento, tente novamente.');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function guardar(Request $request)
    {
        DB::beginTransaction();
        try {
            $requerimento = new RequerimentoPericia;
            $validatedData = $request->validate([
                'nome' => 'required|max:128',
                'matricula' => 'required|max:7',
                'local_lotacao' => 'required|max:72',
                'trabalho_inicio' => 'required|max:14',
                'trabalho_fim' => 'required|max:14',
                'dt_inicio_atestado' => 'required|max:10',
                'vinculo' => 'required|max:3',
                'email' => 'required|max:128',
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
            $requerimento->quant_reagendas          = 0;
            $requerimento->presenca                 = -1;
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
            DB::commit();
            return view('mail/requerimento', compact('requerimento')); */

            // Envio de e-mail após a criação, atribui envio_create = 0 em caso de falha de envio.
            try {
                $mail = env('MAIL_FROM_ADDRESS','gesol@mesquita.rj.gov.br');
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
        return redirect('/sucesso')->with('success', 'Requerimento registrado com sucesso.');
    }

    public function sucesso()
    {
        return view('requerimento_pericia/sucesso');
    }

    public function reagendar()
    {
        return view('requerimento_pericia/reagendar');
    }

    public function reagendamento(Request $request)
    {   
        DB::beginTransaction();
        try {
            $data = str_replace('/', '-', $request->data_cancela);
            $data_cancelada = substr($data, -4).substr($data, 2, 3).'-'.substr($data, 0, 2).' 12:00:00';

            $requerimentos = RequerimentoPericia::where('data_agenda','=', $data_cancelada)->orWhere('data_reagendada','=', $data_cancelada)->get();
            
            foreach($requerimentos as $requerimento) {
                $requerimento = RequerimentoPericia::find($requerimento->id);
                $requerimento->status = 3;
                $requerimento->data_reagendada = date("Y-m-d H:i:s", strtotime(str_replace('/','-',substr($request->data_nova, 0, 10))." 12:00:00"));
                $requerimento->hora_reagendada = $requerimento->hora_agenda;
                $requerimento->justificativa_cancelamento = $request->justificativa;

                try {
                    $mail = env('MAIL_FROM_ADDRESS','gesol@mesquita.rj.gov.br');
                    Mail::send('mail.massa', ['requerimento' => $requerimento], function($m) use ($requerimento, $mail) {
                        $m->from($mail, 'Perícia Médica');
                        $m->subject('Requerimento Reagendado');
                        $m->to($requerimento->email);
                    });
                    $requerimento->envio_reagenda = 1;

                } catch (\Throwable $th) {
                    $requerimento->envio_reagenda = 0;
                }

                $requerimento->update();
            }

            DB::commit();
            return redirect('/requerimento_pericias/reagendar')->with('success', 'Requerimentos reagendados com sucesso.');

        } catch (\Throwable $th) {
            dd($th);
            DB::rollback();
            return redirect('/requerimento_pericias/reagendar')->with('error', 'Houve um erro ao reagendar os requerimentos.');
        }
    }

    public function reenviar()
    {
        DB::beginTransaction();
        try {
            $requerimentos = RequerimentoPericia::where('envio_create', 0)
            ->orWhere('envio_agenda', 0)
            ->orWhere('envio_reagenda', 0)
            ->get();

            foreach($requerimentos as $requerimento) {
                if($requerimento->envio_create === 0) {
                    try {
                        $mail = env('MAIL_FROM_ADDRESS','gesol@mesquita.rj.gov.br');
                        Mail::send('mail.requerimento', ['requerimento' => $requerimento], function($m) use ($requerimento, $mail) {
                            $m->from($mail, 'Perícia Médica');
                            $m->subject('Novo Requerimento');
                            $m->to($requerimento->email);
                        });
                        $requerimento->envio_create = 1;

                    } catch (Throwable $th) {
                        $requerimento->envio_create = 0;
                    }
                }
                if($requerimento->envio_agenda === 0) {
                    try {
                        if ($requerimento->direcionamento === "COVID") {
                            $mail = env('MAIL_FROM_ADDRESS','gesol@mesquita.rj.gov.br');
                            Mail::send('mail.covid', ['requerimento' => $requerimento], function($m) use ($requerimento, $mail) {
                                $m->from($mail, 'Perícia Médica');
                                $m->subject('Requerimento Finalizado');
                                $m->to($requerimento->email);
                            });
                            $requerimento->envio_agenda = 1;
        
                        } else {
                            $mail = env('MAIL_FROM_ADDRESS','gesol@mesquita.rj.gov.br');
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
                        }

                    } catch (Throwable $th) {
                        $requerimento->envio_agenda = 0;
                    }
                }
                if($requerimento->envio_reagenda === 0) {
                    try {
                        $mail = env('MAIL_FROM_ADDRESS','gesol@mesquita.rj.gov.br');
                        Mail::send('mail.reagenda', ['requerimento' => $requerimento], function($m) use ($requerimento, $mail) {
                            $m->from($mail, 'Perícia Médica');
                            $m->subject('Requerimento Reagendado');
                            $m->to($requerimento->email);
                        });
                        $requerimento->envio_reagenda = 1;

                    } catch (Throwable $th) {
                        $requerimento->envio_reagenda = 0;
                    }
                }
                $requerimento->update();
            }

        } catch (Throwable $th) {
            dd($th);
            DB::rollback();
            return json_encode($th);
        }
    }
}