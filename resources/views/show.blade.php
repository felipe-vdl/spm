@extends('gentelella.layouts.app')

@section('content')
<div class="x_panel modal-content">
  <div class="x_title">
    <h5 class="text-center fw-light p-1 m-0"><i class="fas fa-solid fa-folder-open"></i>Visualização de Requerimento</h5>
  </div>
    <div class="x_panel">
        <div class="x_title">
            <div>Protocolo: <strong>{{$requerimento->protocolo}}</strong></div>
            <div>Avaliador: <strong>{{$requerimento->user->name}}</strong></div>
            <div>Data/Hora da Avaliação: <strong>{{$requerimento->data_avaliacao}}</strong></div>
        </div>
        <div class="x_content">
            <div>
                <div>
                    <div>Nome Completo: <strong>{{$requerimento->nome}}</strong></div>
                    <div>Matrícula: <strong>{{$requerimento->matricula}}</strong></div>
                    <div>Data Inicial do Atestado: <strong>{{$requerimento->dt_inicio_atestado}}</strong></div>
                    <div>Local de Lotação: <strong>{{$requerimento->local_lotacao}}</strong></div>
                    <div>Horário de Trabalho: <strong>{{$requerimento->horario_trabalho}}</strong></div>
                    <div>E-mail: <strong>{{$requerimento->email}}</strong></div>
                    <div>O servidor acumula matrícula? <strong>{{$requerimento->vinculo}}</strong></div>
                </div>
            </div>
        </div>
        <div class="x_content">
            <div>
                <div>Direcionamento: <strong>{{ $requerimento->direcionamento }}</strong></div>
            </div>
            @if ($requerimento->direcionamento != "Recusado")
            <div>
                <div>Data/Hora Agendada: <strong>{{ date('d/m/Y', strtotime($requerimento->data_agenda)) }} às {{ $requerimento->hora_agenda }}h.</strong></div>
            </div>
            <br>
            <div>
                <div>Data/Hora da Confirmação: <strong>{{ $requerimento->data_confirmacao }}</strong></div>
            </div>
            @else
            <div>
                <div>Motivo de Recusa: <strong>{{ $requerimento->motivo_recusa }}</strong></div>
            </div>
            @endif
        </div>
    </div>
    <div class="x-panel">
        <div class="x-title">
            <h5 class="text-center fw-light p-1 m-0">Imagem/Documento do Atestado</h5>
        </div>
        <div class="x-content">
            <div style="display: flex; justify-content: space-evenly; align-items: center;">
                @foreach ($doc_atestados as $atestado)
                    @if ($atestado->extensao === 'png' || $atestado->extensao === 'jpg' || $atestado->extensao === 'jpeg')
                    <figure>
                        <figcaption style="text-align: center; padding-bottom: 0.7rem;"><a class="btn btn-sm btn-info" href="{{ asset('storage/atestados/'.$atestado->filename) }}" target="_blank" rel="noopener noreferrer">Visualizar Imagem</a></figcaption>
                        <img style="max-width: 25vw;" src="{{ asset('storage/atestados/'.$atestado->filename) }}" alt="Atestado">
                    </figure>
                    @else
                        <a class="btn btn-sm btn-info" href="{{ asset('storage/atestados/'.$atestado->filename) }}" target="_blank" rel="noopener noreferrer">Visualizar Documento</a>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    @if (!$doc_afastamentos->isEmpty())
    <hr>
    <div class="x-panel">
        <div class="x-title">
            <h5 class="text-center fw-light p-1 m-0">Comprovante de Afastamento</h5>
        </div>
        <div class="x-content">
            <div style="display: flex; justify-content: space-evenly; align-items: center;">
                @foreach ($doc_afastamentos as $afastamento)
                    @if ($afastamento->extensao === 'png' || $afastamento->extensao === 'jpg' || $afastamento->extensao === 'jpeg')
                    <figure>
                        <figcaption style="text-align: center; padding-bottom: 0.7rem;"><a class="btn btn-sm btn-info" href="{{ asset('storage/afastamentos/'.$afastamento->filename) }}" target="_blank" rel="noopener noreferrer">Visualizar Imagem</a></figcaption>
                        <img style="max-width: 25vw;" src="{{ asset('storage/afastamentos/'.$afastamento->filename) }}" alt="Comprovante de Afastamento">
                    </figure>
                    @else
                        <a class="btn btn-sm btn-info" href="{{ asset('storage/afastamentos/'.$afastamento->filename) }}" target="_blank" rel="noopener noreferrer">Visualizar Documento</a>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    @endif
</div>
@endsection