@extends('gentelella.layouts.app')

@section('content')
<div class="x_panel modal-content">
  <div class="x_title">
    <h5 class="text-center fw-light p-1 m-0"><i class="fas fa-file-contract"></i> Avaliação de Requerimento</h5>
  </div>
    <div class="x_panel">
        <div class="x_content">
            <form method="post" action="{{ route('requerimento_pericias.update', $requerimento->id ) }}">
                @csrf
                @method('PATCH')
                <div class="avaliacao">
                    <div>
                        <label for="direcionamento">Direcionamento:</label>
                        <select required onchange="datasFixas()" name="direcionamento" id="direcionamento">
                            <option value="" selected>-- Direcionamento --</option>
                            <option value="Atendimento Pericial">Atendimento Pericial</option>
                            <option value="Avaliação Psiquiátrica">Avaliação Psiquiátrica</option>
                            <option value="Junta Médica">Junta Médica</option>
                            <option value="COVID">COVID</option>
                            <option value="Recusado">Recusado</option>
                        </select>
                    </div>
                    <div class="datahora">
                        <label class="labelDate">Data do Agendamento:</label>
                        <input autocomplete="off" type="text" id="daterecusado" disabled placeholder="dd/mm/aaaa" style="display: inline-block;">
                        <input onchange="timeJunta()" autocomplete="off" type="text" id="datejunta" placeholder="dd/mm/aaaa" style="display: none;">
                        <input onchange="timePsic()" autocomplete="off" type="text" id="datepsic" placeholder="dd/mm/aaaa" style="display: none;">
                        <input onchange="timePericia()" autocomplete="off" type="text" id="datepericia" placeholder="dd/mm/aaaa" style="display: none;">
                    </div>
                    <div class="datahora">
                        <label class="labelTime">Horário do Agendamento:</label>
                        <input autocomplete="off" id="timerecusado" type="text" disabled placeholder="hh:mm" style="display: inline-block;">
                        <input autocomplete="off" id="timejuntadom" class="timejunta" type="text" placeholder="hh:mm" style="display: none;">
                        <input autocomplete="off" id="timejuntaseg" class="timejunta" type="text" placeholder="hh:mm" style="display: none;">
                        <input autocomplete="off" id="timejuntater" class="timejunta" type="text" placeholder="hh:mm" style="display: none;">
                        <input autocomplete="off" id="timejuntaqua" class="timejunta" type="text" placeholder="hh:mm" style="display: none;">
                        <input autocomplete="off" id="timejuntaqui" class="timejunta" type="text" placeholder="hh:mm" style="display: none;">
                        <input autocomplete="off" id="timejuntasex" class="timejunta" type="text" placeholder="hh:mm" style="display: none;">
                        <input autocomplete="off" id="timejuntasab" class="timejunta" type="text" placeholder="hh:mm" style="display: none;">
                        <input autocomplete="off" id="timepsicdom" class="timepsic" type="text" placeholder="hh:mm" style="display: none;">
                        <input autocomplete="off" id="timepsicseg" class="timepsic" type="text" placeholder="hh:mm" style="display: none;">
                        <input autocomplete="off" id="timepsicter" class="timepsic" type="text" placeholder="hh:mm" style="display: none;">
                        <input autocomplete="off" id="timepsicqua" class="timepsic" type="text" placeholder="hh:mm" style="display: none;">
                        <input autocomplete="off" id="timepsicqui" class="timepsic" type="text" placeholder="hh:mm" style="display: none;">
                        <input autocomplete="off" id="timepsicsex" class="timepsic" type="text" placeholder="hh:mm" style="display: none;">
                        <input autocomplete="off" id="timepsicsab" class="timepsic" type="text" placeholder="hh:mm" style="display: none;">
                        <input autocomplete="off" id="timepericiadom" class="timepericia" type="text" placeholder="hh:mm" style="display: none;">
                        <input autocomplete="off" id="timepericiaseg" class="timepericia" type="text" placeholder="hh:mm" style="display: none;">
                        <input autocomplete="off" id="timepericiater" class="timepericia" type="text" placeholder="hh:mm" style="display: none;">
                        <input autocomplete="off" id="timepericiaqua" class="timepericia" type="text" placeholder="hh:mm" style="display: none;">
                        <input autocomplete="off" id="timepericiaqui" class="timepericia" type="text" placeholder="hh:mm" style="display: none;">
                        <input autocomplete="off" id="timepericiasex" class="timepericia" type="text" placeholder="hh:mm" style="display: none;">
                        <input autocomplete="off" id="timepericiasab" class="timepericia" type="text" placeholder="hh:mm" style="display: none;">
                    </div>
                    <div class="motivo" style="display: none;">
                        <label>Motivo de Recusa:</label>
                        <select name="motivo_recusa" id="motivo_recusa" onchange="outroMotivo()">
                            <option value="">-- Motivo --</option>
                            <option value="Documento Ilegível">Documento Ilegível</option>
                            <option value="Prazo Expirado">Prazo Expirado</option>
                            <option value="Outro">Outro</option>
                        </select>
                    </div>
                    <div id="outro-div" style="display: none;">
                        <textarea name="" id="outro-motivo" cols="30" rows="1" placeholder="Descreva o motivo." style="width: 100%;" maxlength="100"></textarea>
                    </div>
                    <a id="enviar" title="Enviar avaliação." class="btn btn-success">Avaliar Requerimento</a>
                </div>
                <div id="observacao-div">
                    <label>Observação (opcional):</label>
                    <textarea class="observacao" name="observacao" placeholder="A observação será inclusa no e-mail de resposta."></textarea>
                </div>
            </form>
        </div>
    </div>
    <div class="x_panel">
        <div class="x_title">
            <div>Protocolo: <strong>{{$requerimento->protocolo}}</strong></div>
            <div>Status: <strong>
                @switch($requerimento->status)
                    @case(0)
                        Em Análise
                        @break
                    @case(1)
                        Recusado
                        @break
                    @case(2)
                        Cancelado
                        @break
                    @case(3)
                        Aguardando Confirmação
                        @break
                    @case(4)
                        Confirmado
                        @break
                    @case(5)
                        Reagendamento Solicitado
                        @break
                @endswitch
                </strong>
            </div>
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
        @if ($requerimento->justificativa_reagenda)
        <div class="x_content">
            <div>Avaliador: <strong>{{$requerimento->user->name}}</strong></div>
            <div>Data/Hora da Avaliação: <strong>{{$requerimento->data_avaliacao}}</strong></div>
            <div>
                <div>Direcionamento: <strong>{{ $requerimento->direcionamento }}</strong></div>
            </div>
            @if($requerimento->observacao)
                <div>
                    <div>Observação do Avaliador: <strong>{{ $requerimento->observacao }}</strong></div>
                </div>
            @endif
            <div>
                <div>Data/Hora Agendada: <strong>{{ date('d/m/Y', strtotime($requerimento->data_agenda)) }} às {{ $requerimento->hora_agenda }}h.</strong></div>
            </div>
        </div>
        <div class="x_content">
            <div>
                <div>Justificativa para o reagendamento: <strong>{{ $requerimento->justificativa_reagenda }}</strong></div>
            </div>
            <div>
                <div>Data/Hora do pedido de reagendamento: <strong>{{ $requerimento->data_pedidoreagenda }}</strong></div>
            </div>
            @if($requerimento->data_reagenda)
                <div>
                    <div>Data/Hora da Avaliação de Reagendamento: <strong>{{ $requerimento->data_reagenda }}</strong></div>
                </div>
            @endif
            @if($requerimento->observacao_reagenda)
                <div>
                    <div>Observação do Avaliador (reagendamento): <strong>{{ $requerimento->observacao_reagenda }}</strong></div>
                </div>
            @endif
            @if($requerimento->data_reagendada)
                <div>
                    <div>Data/Hora Reagendada: <strong>{{ date('d/m/Y', strtotime($requerimento->data_reagendada)) }} às {{ $requerimento->hora_reagendada }}h.</strong></div>
                </div>
            @endif
            @if ($requerimento->quant_reagendas > 0)
                <div>
                    <div>Pedidos de Reagenda (Quantidade): <strong>{{ $requerimento->quant_reagendas }}</strong></div>
                </div>
            @endif
        </div>
        @endif
    </div>
    <div class="x-panel">
        <div class="x-title">
            <h5 class="text-center fw-light p-1 m-0">Imagem/Documento do Atestado</h5>
        </div>
        <div class="x-content">
            <div style="display: flex; justify-content: space-evenly; flex-wrap: wrap; row-gap: 20px;">
                @foreach ($doc_atestados as $atestado)
                @if ($atestado->extensao === 'png' || $atestado->extensao === 'jpg' || $atestado->extensao === 'jpeg' || $atestado->extensao === 'bmp' || $atestado->extensao === 'gif' || $atestado->extensao === 'jfif')
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
            <div style="display: flex; justify-content: space-evenly; flex-wrap: wrap; row-gap: 20px;">
                @foreach ($doc_afastamentos as $afastamento)
                @if ($afastamento->extensao === 'png' || $afastamento->extensao === 'jpg' || $afastamento->extensao === 'jpeg' || $afastamento->extensao === 'bmp' || $afastamento->extensao === 'gif' || $afastamento->extensao === 'jfif')
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
<div class="modal fade" id="modaleventclick" tabindex="-1" role="dialog" aria-labelledby="modaleventclickLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modaleventclickLabel">Enviando análise, por favor aguarde.</h5>
        </div>
         
        <div class="modal-body">
            <center>
                <div class="loader"></div>
            </center>
        </div>
      </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/jquery.timepicker.min.js') }}"></script>
<script src="{{ asset('js/sweetalert.min.js') }}"></script>

<script>
    const avPsiquiatrica = @json($avPsiquiatricaConfig);
    const atPericial = @json($atPericialConfig);
    const jtMedica = @json($jtMedicaConfig);
    
    /* jtMedica */
        $('#timejuntadom').timepicker({
            timeFormat: 'HH:mm',
            interval: 60,
            minTime: jtMedica[0].inicio,
            maxTime: jtMedica[0].fim,
            defaultTime: jtMedica[0].fim,
            startTime: jtMedica[0].inicio,
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });
        $('#timejuntaseg').timepicker({
            timeFormat: 'HH:mm',
            interval: 60,
            minTime: jtMedica[1].inicio,
            maxTime: jtMedica[1].fim,
            defaultTime: jtMedica[1].fim,
            startTime: jtMedica[1].inicio,
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });
        $('#timejuntater').timepicker({
            timeFormat: 'HH:mm',
            interval: 60,
            minTime: jtMedica[2].inicio,
            maxTime: jtMedica[2].fim,
            defaultTime: jtMedica[2].fim,
            startTime: jtMedica[2].inicio,
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });
        $('#timejuntaqua').timepicker({
            timeFormat: 'HH:mm',
            interval: 60,
            minTime: jtMedica[3].inicio,
            maxTime: jtMedica[3].fim,
            defaultTime: jtMedica[3].fim,
            startTime: jtMedica[3].inicio,
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });
        $('#timejuntaqui').timepicker({
            timeFormat: 'HH:mm',
            interval: 60,
            minTime: jtMedica[4].inicio,
            maxTime: jtMedica[4].fim,
            defaultTime: jtMedica[4].fim,
            startTime: jtMedica[4].inicio,
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });
        $('#timejuntasex').timepicker({
            timeFormat: 'HH:mm',
            interval: 60,
            minTime: jtMedica[5].inicio,
            maxTime: jtMedica[5].fim,
            defaultTime: jtMedica[5].fim,
            startTime: jtMedica[5].inicio,
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });
        $('#timejuntasab').timepicker({
            timeFormat: 'HH:mm',
            interval: 60,
            minTime: jtMedica[6].inicio,
            maxTime: jtMedica[6].fim,
            defaultTime: jtMedica[6].fim,
            startTime: jtMedica[6].inicio,
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });

    /* avPsiquiatrica */
        $('#timepsicdom').timepicker({
            timeFormat: 'HH:mm',
            interval: 60,
            minTime: avPsiquiatrica[0].inicio,
            maxTime: avPsiquiatrica[0].fim,
            defaultTime: avPsiquiatrica[0].fim,
            startTime: avPsiquiatrica[0].inicio,
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });
        $('#timepsicseg').timepicker({
            timeFormat: 'HH:mm',
            interval: 60,
            minTime: avPsiquiatrica[1].inicio,
            maxTime: avPsiquiatrica[1].fim,
            defaultTime: avPsiquiatrica[1].fim,
            startTime: avPsiquiatrica[1].inicio,
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });
        $('#timepsicter').timepicker({
            timeFormat: 'HH:mm',
            interval: 60,
            minTime: avPsiquiatrica[2].inicio,
            maxTime: avPsiquiatrica[2].fim,
            defaultTime: avPsiquiatrica[2].fim,
            startTime: avPsiquiatrica[2].inicio,
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });
        $('#timepsicqua').timepicker({
            timeFormat: 'HH:mm',
            interval: 60,
            minTime: avPsiquiatrica[3].inicio,
            maxTime: avPsiquiatrica[3].fim,
            defaultTime: avPsiquiatrica[3].fim,
            startTime: avPsiquiatrica[3].inicio,
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });
        $('#timepsicqui').timepicker({
            timeFormat: 'HH:mm',
            interval: 60,
            minTime: avPsiquiatrica[4].inicio,
            maxTime: avPsiquiatrica[4].fim,
            defaultTime: avPsiquiatrica[4].fim,
            startTime: avPsiquiatrica[4].inicio,
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });
        $('#timepsicsex').timepicker({
            timeFormat: 'HH:mm',
            interval: 60,
            minTime: avPsiquiatrica[5].inicio,
            maxTime: avPsiquiatrica[5].fim,
            defaultTime: avPsiquiatrica[5].fim,
            startTime: avPsiquiatrica[5].inicio,
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });
        $('#timepsicsab').timepicker({
            timeFormat: 'HH:mm',
            interval: 60,
            minTime: avPsiquiatrica[6].inicio,
            maxTime: avPsiquiatrica[6].fim,
            defaultTime: avPsiquiatrica[6].fim,
            startTime: avPsiquiatrica[6].inicio,
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });

    /* atPericial */
        $('#timepericiadom').timepicker({
            timeFormat: 'HH:mm',
            interval: 60,
            minTime: atPericial[0].inicio,
            maxTime: atPericial[0].fim,
            defaultTime: atPericial[0].fim,
            startTime: atPericial[0].inicio,
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });
        $('#timepericiaseg').timepicker({
            timeFormat: 'HH:mm',
            interval: 60,
            minTime: atPericial[1].inicio,
            maxTime: atPericial[1].fim,
            defaultTime: atPericial[1].fim,
            startTime: atPericial[1].inicio,
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });
        $('#timepericiater').timepicker({
            timeFormat: 'HH:mm',
            interval: 60,
            minTime: atPericial[2].inicio,
            maxTime: atPericial[2].fim,
            defaultTime: atPericial[2].fim,
            startTime: atPericial[2].inicio,
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });
        $('#timepericiaqua').timepicker({
            timeFormat: 'HH:mm',
            interval: 60,
            minTime: atPericial[3].inicio,
            maxTime: atPericial[3].fim,
            defaultTime: atPericial[3].fim,
            startTime: atPericial[3].inicio,
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });
        $('#timepericiaqui').timepicker({
            timeFormat: 'HH:mm',
            interval: 60,
            minTime: atPericial[4].inicio,
            maxTime: atPericial[4].fim,
            defaultTime: atPericial[4].fim,
            startTime: atPericial[4].inicio,
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });
        $('#timepericiasex').timepicker({
            timeFormat: 'HH:mm',
            interval: 60,
            minTime: atPericial[5].inicio,
            maxTime: atPericial[5].fim,
            defaultTime: atPericial[5].fim,
            startTime: atPericial[5].inicio,
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });
        $('#timepericiasab').timepicker({
            timeFormat: 'HH:mm',
            interval: 60,
            minTime: atPericial[6].inicio,
            maxTime: atPericial[6].fim,
            defaultTime: atPericial[6].fim,
            startTime: atPericial[6].inicio,
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });

    /* RECUSADO */
        $('#timerecusado').timepicker({
            timeFormat: 'HH:mm',
            interval: 60,
            minTime: '9',
            maxTime: '22:00',
            defaultTime: '0',
            startTime: '8:00',
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });
    
    /* jtMedica */
        $('#datejunta').datepicker({
            beforeShowDay: function(date) {
                var day = date.getDay();
                return [(jtMedica[day].isOn)];
            },
            dateFormat: 'dd/mm/yy D',
            dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
            dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S', 'D'],
            dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
            monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
            monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
            nextText: 'Proximo',
            prevText: 'Anterior',
            minDate: '1'
        });

    /* avPsiquiatrica */
        $('#datepsic').datepicker({
            beforeShowDay: function(date) {
                var day = date.getDay();
                return [(avPsiquiatrica[day].isOn)];
            },
            dateFormat: 'dd/mm/yy D',
            dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
            dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S', 'D'],
            dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
            monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
            monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
            nextText: 'Proximo',
            prevText: 'Anterior',
            minDate: '1'
        });

    /* atPericial */
        $('#datepericia').datepicker({
            beforeShowDay: function(date) {
                var day = date.getDay();
                return [(atPericial[day].isOn)];
            },
            dateFormat: 'dd/mm/yy D',
            dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
            dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S', 'D'],
            dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
            monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
            monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
            nextText: 'Proximo',
            prevText: 'Anterior',
            minDate: '1'
        });

    /* Recusado/COVID */
        $('#daterecusado').datepicker('option', 'disabled', true);

    const datasFixas = () => {

        let direcionamento = document.querySelector('#direcionamento');

        let datePsic = document.querySelector('#datepsic');
        let datePericia = document.querySelector('#datepericia');
        let dateJunta = document.querySelector('#datejunta');
        let dateRecusado = document.querySelector('#daterecusado');

        let datahora = document.querySelectorAll('.datahora');
        let motivo = document.querySelector('.motivo');
        let motivoRecusa = document.querySelector('#motivo_recusa');
        let outroDiv = document.querySelector('#outro-div');
        let outroMotivo = document.querySelector('#outro-motivo');

        // let timeJunta = document.querySelector('#timejunta');
        // let timePsic = document.querySelector('#timepsic');
        // let timePericiaQua = document.querySelector('#timepericiaqua');
        // let timePericiaQui = document.querySelector('#timepericiaqui');
        let timesJunta = document.querySelectorAll('.timejunta');
        let timesPsic = document.querySelectorAll('.timepsic');
        let timesPericia = document.querySelectorAll('.timepericia');
        let timeRecusado = document.querySelector('#timerecusado');

        if(direcionamento.value == "Junta Médica") {
            datahora[0].style.display = "inline-block";
            datahora[1].style.display = "inline-block";

            motivo.style.display = "none";
            motivoRecusa.removeAttribute('required');
            motivoRecusa.value = "";
            outroDiv.style.display = "none";
            outroMotivo.name = "";
            outroMotivo.removeAttribute('required');
        
            dateJunta.name = "data_agenda"
            datePsic.name = ""
            datePericia.name = ""
            dateRecusado.name = ""

            dateJunta.style.display = "inline-block"
            datePsic.style.display = "none"
            datePericia.style.display = "none"
            dateRecusado.style.display = "none"

            for (let time of timesPsic) { time.name = "" }
            for (let time of timesPericia) { time.name = "" }
            timeRecusado.name = ""

            for (let time of timesPsic) { time.style.display = "none" }
            for (let time of timesPericia) { time.style.display = "none" }
            timeRecusado.style.display = "inline-block"

            dateJunta.value = ""
            datePsic.value = ""
            datePericia.value = ""
            dateRecusado.value = ""

            for (let time of timesJunta) { time.value = "" }
            for (let time of timesPsic) { time.value = "" }
            for (let time of timesPericia) { time.value = "" }
            timeRecusado.value = ""

            dateJunta.setAttribute('required', 'required');
            datePsic.removeAttribute('required')
            datePericia.removeAttribute('required')
            dateRecusado.removeAttribute('required')

            for (let time of timesPsic) { time.removeAttribute('required') }
            for (let time of timesPericia) { time.removeAttribute('required') }
            timeRecusado.removeAttribute('required')

        } else if (direcionamento.value == "Avaliação Psiquiátrica") {
            datahora[0].style.display = "inline-block";
            datahora[1].style.display = "inline-block";

            motivo.style.display = "none";
            motivoRecusa.removeAttribute('required');
            motivoRecusa.value = "";
            outroDiv.style.display = "none";
            outroMotivo.name = "";
            outroMotivo.removeAttribute('required');

            datePsic.name = "data_agenda"
            dateJunta.name = ""
            datePericia.name = ""
            dateRecusado.name = ""

            datePsic.style.display = "inline-block"
            dateJunta.style.display = "none"
            datePericia.style.display = "none"
            dateRecusado.style.display = "none"

            for (let time of timesJunta) { time.name = "" }
            for (let time of timesPericia) { time.name = "" }
            timeRecusado.name = ""

            for (let time of timesJunta) { time.style.display = "none" }
            for (let time of timesPericia) { time.style.display = "none" }
            timeRecusado.style.display = "inline-block"

            dateJunta.value = ""
            datePsic.value = ""
            datePericia.value = ""
            dateRecusado.value = ""

            for (let time of timesJunta) { time.value = "" }
            for (let time of timesPsic) { time.value = "" }
            for (let time of timesPericia) { time.value = "" }
            timeRecusado.value = ""

            datePsic.setAttribute('required', 'required');
            dateJunta.removeAttribute('required')
            datePericia.removeAttribute('required')
            dateRecusado.removeAttribute('required')

            for (let time of timesJunta) { time.removeAttribute('required') }
            for (let time of timesPericia) { time.removeAttribute('required') }
            timeRecusado.removeAttribute('required')

        } else if (direcionamento.value == "Atendimento Pericial") {
            datahora[0].style.display = "inline-block";
            datahora[1].style.display = "inline-block";

            motivo.style.display = "none";
            motivoRecusa.removeAttribute('required');
            motivoRecusa.value = "";
            outroDiv.style.display = "none";
            outroMotivo.name = "";
            outroMotivo.removeAttribute('required');

            datePericia.name = "data_agenda"
            dateJunta.name = ""
            datePsic.name = ""
            dateRecusado.name = ""

            datePericia.style.display = "inline-block"
            dateJunta.style.display = "none"
            datePsic.style.display = "none"
            dateRecusado.style.display = "none"

            for (let time of timesJunta) { time.name = "" }
            for (let time of timesPsic) { time.name = "" }
            timeRecusado.name = ""

            for (let time of timesJunta) { time.style.display = "none" }
            for (let time of timesPsic) { time.style.display = "none" }
            timeRecusado.style.display = "inline-block"

            dateJunta.value = ""
            datePsic.value = ""
            datePericia.value = ""
            dateRecusado.value = ""

            for (let time of timesJunta) { time.value = "" }
            for (let time of timesPsic) { time.value = "" }
            for (let time of timesPericia) { time.value = "" }
            timeRecusado.value = ""

            datePericia.setAttribute('required', 'required');
            dateJunta.removeAttribute('required')
            datePsic.removeAttribute('required')
            dateRecusado.removeAttribute('required')

            for (let time of timesJunta) { time.removeAttribute('required') }
            for (let time of timesPsic) { time.removeAttribute('required') }
            timeRecusado.removeAttribute('required')

        } else {
            datahora[0].style.display = "inline-block"
            datahora[1].style.display = "inline-block"
            motivo.style.display = "none"
            motivoRecusa.removeAttribute('required')
            motivoRecusa.value = ""
            outroDiv.style.display = "none";
            outroMotivo.name = "";
            outroMotivo.removeAttribute('required');

            dateRecusado.name = "data_agenda"
            dateJunta.name = ""
            datePsic.name = ""
            datePericia.name = ""

            dateRecusado.style.display = "inline-block"
            dateJunta.style.display = "none"
            datePsic.style.display = "none"
            datePericia.style.display = "none"

            timeRecusado.name = "hora_agenda"
            for (let time of timesJunta) { time.name = "" }
            for (let time of timesPsic) { time.name = "" }
            for (let time of timesPericia) { time.name = "" }

            timeRecusado.style.display = "inline-block"
            for (let time of timesJunta) { time.style.display = "none" }
            for (let time of timesPsic) { time.style.display = "none" }
            for (let time of timesPericia) { time.style.display = "none" }

            dateRecusado.value = ""
            dateJunta.value = ""
            datePsic.value = ""
            datePericia.value = ""

            timeRecusado.value = ""
            for (let time of timesJunta) { time.value = "" }
            for (let time of timesPsic) { time.value = "" }
            for (let time of timesPericia) { time.value = "" }

            dateRecusado.removeAttribute('required')
            dateJunta.removeAttribute('required')
            datePsic.removeAttribute('required')
            datePericia.removeAttribute('required')

            timeRecusado.removeAttribute('required')
            for (let time of timesJunta) { time.removeAttribute('required') }
            for (let time of timesPsic) { time.removeAttribute('required') }
            for (let time of timesPericia) { time.removeAttribute('required') }

            if (direcionamento.value == "Recusado") {
                datahora[0].style.display = "none"
                datahora[1].style.display = "none"
                motivo.style.display = "inline-block"
                motivoRecusa.setAttribute('required', 'required')
            }
        }
    }

    /* avPsiquiatrica */
    const timePsic = () => {
        let diaSemana = document.querySelector('#datepsic').value;
        
        let timesPericia = document.querySelectorAll('.timepericia');

        let timesJunta = document.querySelectorAll('.timejunta');
        
        let timeRecusado = document.querySelector('#timerecusado');
        
        let timePsicDom = document.querySelector('#timepsicdom');
        let timePsicSeg = document.querySelector('#timepsicseg');
        let timePsicTer = document.querySelector('#timepsicter');
        let timePsicQua = document.querySelector('#timepsicqua');
        let timePsicQui = document.querySelector('#timepsicqui');
        let timePsicSex = document.querySelector('#timepsicsex');
        let timePsicSab = document.querySelector('#timepsicsab');

        if (diaSemana.includes('Dom')) {
            timePsicDom.name = "hora_agenda"
            timePsicSeg.name = ""
            timePsicTer.name = ""
            timePsicQua.name = ""
            timePsicQui.name = ""
            timePsicSex.name = ""
            timePsicSab.name = ""
            for (let time of timesPericia) { time.name = "" }
            for (let time of timesJunta) { time.name = "" }
            timeRecusado.name = ""
            
            timePsicDom.style.display = "inline-block"
            timePsicSeg.style.display = "none"
            timePsicTer.style.display = "none"
            timePsicQua.style.display = "none"
            timePsicQui.style.display = "none"
            timePsicSex.style.display = "none"
            timePsicSab.style.display = "none"
            for (let time of timesPericia) { time.style.display = "none" }
            for (let time of timesJunta) { time.style.display = "none" }
            timeRecusado.style.display = "none"
            
            // timePsicDom.value = ""
            timePsicSeg.value = ""
            timePsicTer.value = ""
            timePsicQua.value = ""
            timePsicQui.value = ""
            timePsicSex.value = ""
            timePsicSab.value = ""
            for (let time of timesPericia) { time.value = "" }
            for (let time of timesJunta) { time.value = "" }
            timeRecusado.value = ""

            timePsicDom.setAttribute('required', 'required')
            timePsicSeg.removeAttribute('required')
            timePsicTer.removeAttribute('required')
            timePsicQua.removeAttribute('required')
            timePsicQui.removeAttribute('required')
            timePsicSex.removeAttribute('required')
            timePsicSab.removeAttribute('required')

        } else if (diaSemana.includes('Seg')) {
            timePsicDom.name = ""
            timePsicSeg.name = "hora_agenda"
            timePsicTer.name = ""
            timePsicQua.name = ""
            timePsicQui.name = ""
            timePsicSex.name = ""
            timePsicSab.name = ""
            for (let time of timesPericia) { time.name = "" }
            for (let time of timesJunta) { time.name = "" }
            timeRecusado.name = ""
            
            timePsicDom.style.display = "none"
            timePsicSeg.style.display = "inline-block"
            timePsicTer.style.display = "none"
            timePsicQua.style.display = "none"
            timePsicQui.style.display = "none"
            timePsicSex.style.display = "none"
            timePsicSab.style.display = "none"
            for (let time of timesPericia) { time.style.display = "none" }
            for (let time of timesJunta) { time.style.display = "none" }
            timeRecusado.style.display = "none"
            
            timePsicDom.value = ""
            // timePsicSeg.value = ""
            timePsicTer.value = ""
            timePsicQua.value = ""
            timePsicQui.value = ""
            timePsicSex.value = ""
            timePsicSab.value = ""
            for (let time of timesPericia) { time.value = "" }
            for (let time of timesJunta) { time.value = "" }
            timeRecusado.value = ""

            timePsicDom.removeAttribute('required')
            timePsicSeg.setAttribute('required', 'required')
            timePsicTer.removeAttribute('required')
            timePsicQua.removeAttribute('required')
            timePsicQui.removeAttribute('required')
            timePsicSex.removeAttribute('required')
            timePsicSab.removeAttribute('required')

        } else if (diaSemana.includes('Ter')) {
            timePsicDom.name = ""
            timePsicSeg.name = ""
            timePsicTer.name = "hora_agenda"
            timePsicQua.name = ""
            timePsicQui.name = ""
            timePsicSex.name = ""
            timePsicSab.name = ""
            for (let time of timesPericia) { time.name = "" }
            for (let time of timesJunta) { time.name = "" }
            timeRecusado.name = ""
            
            timePsicDom.style.display = "none"
            timePsicSeg.style.display = "none"
            timePsicTer.style.display = "inline-block"
            timePsicQua.style.display = "none"
            timePsicQui.style.display = "none"
            timePsicSex.style.display = "none"
            timePsicSab.style.display = "none"
            for (let time of timesPericia) { time.style.display = "none" }
            for (let time of timesJunta) { time.style.display = "none" }
            timeRecusado.style.display = "none"
            
            timePsicDom.value = ""
            timePsicSeg.value = ""
            // timePsicTer.value = ""
            timePsicQua.value = ""
            timePsicQui.value = ""
            timePsicSex.value = ""
            timePsicSab.value = ""
            for (let time of timesPericia) { time.value = "" }
            for (let time of timesJunta) { time.value = "" }
            timeRecusado.value = ""

            timePsicDom.removeAttribute('required')
            timePsicSeg.removeAttribute('required')
            timePsicTer.setAttribute('required', 'required')
            timePsicQua.removeAttribute('required')
            timePsicQui.removeAttribute('required')
            timePsicSex.removeAttribute('required')
            timePsicSab.removeAttribute('required')

        } else if (diaSemana.includes('Qua')) {
            timePsicDom.name = ""
            timePsicSeg.name = ""
            timePsicTer.name = ""
            timePsicQua.name = "hora_agenda"
            timePsicQui.name = ""
            timePsicSex.name = ""
            timePsicSab.name = ""
            for (let time of timesPericia) { time.name = "" }
            for (let time of timesJunta) { time.name = "" }
            timeRecusado.name = ""
            
            timePsicDom.style.display = "none"
            timePsicSeg.style.display = "none"
            timePsicTer.style.display = "none"
            timePsicQua.style.display = "inline-block"
            timePsicQui.style.display = "none"
            timePsicSex.style.display = "none"
            timePsicSab.style.display = "none"
            for (let time of timesPericia) { time.style.display = "none" }
            for (let time of timesJunta) { time.style.display = "none" }
            timeRecusado.style.display = "none"
            
            timePsicDom.value = ""
            timePsicSeg.value = ""
            timePsicTer.value = ""
            // timePsicQua.value = ""
            timePsicQui.value = ""
            timePsicSex.value = ""
            timePsicSab.value = ""
            for (let time of timesPericia) { time.value = "" }
            for (let time of timesJunta) { time.value = "" }
            timeRecusado.value = ""

            timePsicDom.removeAttribute('required')
            timePsicSeg.removeAttribute('required')
            timePsicTer.removeAttribute('required')
            timePsicQua.setAttribute('required', 'required')
            timePsicQui.removeAttribute('required')
            timePsicSex.removeAttribute('required')
            timePsicSab.removeAttribute('required')

        } else if (diaSemana.includes('Qui')) {
            timePsicDom.name = ""
            timePsicSeg.name = ""
            timePsicTer.name = ""
            timePsicQua.name = ""
            timePsicQui.name = "hora_agenda"
            timePsicSex.name = ""
            timePsicSab.name = ""
            for (let time of timesPericia) { time.name = "" }
            for (let time of timesJunta) { time.name = "" }
            timeRecusado.name = ""
            
            timePsicDom.style.display = "none"
            timePsicSeg.style.display = "none"
            timePsicTer.style.display = "none"
            timePsicQua.style.display = "none"
            timePsicQui.style.display = "inline-block"
            timePsicSex.style.display = "none"
            timePsicSab.style.display = "none"
            for (let time of timesPericia) { time.style.display = "none" }
            for (let time of timesJunta) { time.style.display = "none" }
            timeRecusado.style.display = "none"
            
            timePsicDom.value = ""
            timePsicSeg.value = ""
            timePsicTer.value = ""
            timePsicQua.value = ""
            // timePsicQui.value = ""
            timePsicSex.value = ""
            timePsicSab.value = ""
            for (let time of timesPericia) { time.value = "" }
            for (let time of timesJunta) { time.value = "" }
            timeRecusado.value = ""

            timePsicDom.removeAttribute('required')
            timePsicSeg.removeAttribute('required')
            timePsicTer.removeAttribute('required')
            timePsicQua.removeAttribute('required')
            timePsicQui.setAttribute('required', 'required')
            timePsicSex.removeAttribute('required')
            timePsicSab.removeAttribute('required')

        } else if (diaSemana.includes('Sex')) {
            timePsicDom.name = ""
            timePsicSeg.name = ""
            timePsicTer.name = ""
            timePsicQua.name = ""
            timePsicQui.name = ""
            timePsicSex.name = "hora_agenda"
            timePsicSab.name = ""
            for (let time of timesPericia) { time.name = "" }
            for (let time of timesJunta) { time.name = "" }
            timeRecusado.name = ""
            
            timePsicDom.style.display = "none"
            timePsicSeg.style.display = "none"
            timePsicTer.style.display = "none"
            timePsicQua.style.display = "none"
            timePsicQui.style.display = "none"
            timePsicSex.style.display = "inline-block"
            timePsicSab.style.display = "none"
            for (let time of timesPericia) { time.style.display = "none" }
            for (let time of timesJunta) { time.style.display = "none" }
            timeRecusado.style.display = "none"
            
            timePsicDom.value = ""
            timePsicSeg.value = ""
            timePsicTer.value = ""
            timePsicQua.value = ""
            timePsicQui.value = ""
            // timePsicSex.value = ""
            timePsicSab.value = ""
            for (let time of timesPericia) { time.value = "" }
            for (let time of timesJunta) { time.value = "" }
            timeRecusado.value = ""

            timePsicDom.removeAttribute('required')
            timePsicSeg.removeAttribute('required')
            timePsicTer.removeAttribute('required')
            timePsicQua.removeAttribute('required')
            timePsicQui.removeAttribute('required')
            timePsicSex.setAttribute('required', 'required')
            timePsicSab.removeAttribute('required')

        } else if (diaSemana.includes('Sab')) {
            timePsicDom.name = ""
            timePsicSeg.name = ""
            timePsicTer.name = ""
            timePsicQua.name = ""
            timePsicQui.name = ""
            timePsicSex.name = ""
            timePsicSab.name = "hora_agenda"
            for (let time of timesPericia) { time.name = "" }
            for (let time of timesJunta) { time.name = "" }
            timeRecusado.name = ""
            
            timePsicDom.style.display = "none"
            timePsicSeg.style.display = "none"
            timePsicTer.style.display = "none"
            timePsicQua.style.display = "none"
            timePsicQui.style.display = "none"
            timePsicSex.style.display = "none"
            timePsicSab.style.display = "inline-block"
            for (let time of timesPericia) { time.style.display = "none" }
            for (let time of timesJunta) { time.style.display = "none" }
            timeRecusado.style.display = "none"
            
            timePsicDom.value = ""
            timePsicSeg.value = ""
            timePsicTer.value = ""
            timePsicQua.value = ""
            timePsicQui.value = ""
            timePsicSex.value = ""
            // timePsicSab.value = ""
            for (let time of timesPericia) { time.value = "" }
            for (let time of timesJunta) { time.value = "" }
            timeRecusado.value = ""

            timePsicDom.removeAttribute('required')
            timePsicSeg.removeAttribute('required')
            timePsicTer.removeAttribute('required')
            timePsicQua.removeAttribute('required')
            timePsicQui.removeAttribute('required')
            timePsicSex.removeAttribute('required')
            timePsicSab.setAttribute('required', 'required')
        }
        }

    /* jtMedica */
    const timeJunta = () => {
        let diaSemana = document.querySelector('#datejunta').value;
        
        let timesPericia = document.querySelectorAll('.timepericia');

        let timesPsic = document.querySelectorAll('.timepsic');
        
        let timeRecusado = document.querySelector('#timerecusado');
        
        let timeJuntaDom = document.querySelector('#timejuntadom');
        let timeJuntaSeg = document.querySelector('#timejuntaseg');
        let timeJuntaTer = document.querySelector('#timejuntater');
        let timeJuntaQua = document.querySelector('#timejuntaqua');
        let timeJuntaQui = document.querySelector('#timejuntaqui');
        let timeJuntaSex = document.querySelector('#timejuntasex');
        let timeJuntaSab = document.querySelector('#timejuntasab');

        if (diaSemana.includes('Dom')) {
            timeJuntaDom.name = "hora_agenda"
            timeJuntaSeg.name = ""
            timeJuntaTer.name = ""
            timeJuntaQua.name = ""
            timeJuntaQui.name = ""
            timeJuntaSex.name = ""
            timeJuntaSab.name = ""
            for (let time of timesPericia) { time.name = "" }
            for (let time of timesPsic) { time.name = "" }
            timeRecusado.name = ""
            
            timeJuntaDom.style.display = "inline-block"
            timeJuntaSeg.style.display = "none"
            timeJuntaTer.style.display = "none"
            timeJuntaQua.style.display = "none"
            timeJuntaQui.style.display = "none"
            timeJuntaSex.style.display = "none"
            timeJuntaSab.style.display = "none"
            for (let time of timesPericia) { time.style.display = "none" }
            for (let time of timesPsic) { time.style.display = "none" }
            timeRecusado.style.display = "none"
            
            // timeJuntaDom.value = ""
            timeJuntaSeg.value = ""
            timeJuntaTer.value = ""
            timeJuntaQua.value = ""
            timeJuntaQui.value = ""
            timeJuntaSex.value = ""
            timeJuntaSab.value = ""
            for (let time of timesPericia) { time.value = "" }
            for (let time of timesPsic) { time.value = "" }
            timeRecusado.value = ""

            timeJuntaDom.setAttribute('required', 'required')
            timeJuntaSeg.removeAttribute('required')
            timeJuntaTer.removeAttribute('required')
            timeJuntaQua.removeAttribute('required')
            timeJuntaQui.removeAttribute('required')
            timeJuntaSex.removeAttribute('required')
            timeJuntaSab.removeAttribute('required')

        } else if (diaSemana.includes('Seg')) {
            timeJuntaDom.name = ""
            timeJuntaSeg.name = "hora_agenda"
            timeJuntaTer.name = ""
            timeJuntaQua.name = ""
            timeJuntaQui.name = ""
            timeJuntaSex.name = ""
            timeJuntaSab.name = ""
            for (let time of timesPericia) { time.name = "" }
            for (let time of timesPsic) { time.name = "" }
            timeRecusado.name = ""
            
            timeJuntaDom.style.display = "none"
            timeJuntaSeg.style.display = "inline-block"
            timeJuntaTer.style.display = "none"
            timeJuntaQua.style.display = "none"
            timeJuntaQui.style.display = "none"
            timeJuntaSex.style.display = "none"
            timeJuntaSab.style.display = "none"
            for (let time of timesPericia) { time.style.display = "none" }
            for (let time of timesPsic) { time.style.display = "none" }
            timeRecusado.style.display = "none"
            
            timeJuntaDom.value = ""
            // timeJuntaSeg.value = ""
            timeJuntaTer.value = ""
            timeJuntaQua.value = ""
            timeJuntaQui.value = ""
            timeJuntaSex.value = ""
            timeJuntaSab.value = ""
            for (let time of timesPericia) { time.value = "" }
            for (let time of timesPsic) { time.value = "" }
            timeRecusado.value = ""

            timeJuntaDom.removeAttribute('required')
            timeJuntaSeg.setAttribute('required', 'required')
            timeJuntaTer.removeAttribute('required')
            timeJuntaQua.removeAttribute('required')
            timeJuntaQui.removeAttribute('required')
            timeJuntaSex.removeAttribute('required')
            timeJuntaSab.removeAttribute('required')

        } else if (diaSemana.includes('Ter')) {
            timeJuntaDom.name = ""
            timeJuntaSeg.name = ""
            timeJuntaTer.name = "hora_agenda"
            timeJuntaQua.name = ""
            timeJuntaQui.name = ""
            timeJuntaSex.name = ""
            timeJuntaSab.name = ""
            for (let time of timesPericia) { time.name = "" }
            for (let time of timesPsic) { time.name = "" }
            timeRecusado.name = ""
            
            timeJuntaDom.style.display = "none"
            timeJuntaSeg.style.display = "none"
            timeJuntaTer.style.display = "inline-block"
            timeJuntaQua.style.display = "none"
            timeJuntaQui.style.display = "none"
            timeJuntaSex.style.display = "none"
            timeJuntaSab.style.display = "none"
            for (let time of timesPericia) { time.style.display = "none" }
            for (let time of timesPsic) { time.style.display = "none" }
            timeRecusado.style.display = "none"
            
            timeJuntaDom.value = ""
            timeJuntaSeg.value = ""
            // timeJuntaTer.value = ""
            timeJuntaQua.value = ""
            timeJuntaQui.value = ""
            timeJuntaSex.value = ""
            timeJuntaSab.value = ""
            for (let time of timesPericia) { time.value = "" }
            for (let time of timesPsic) { time.value = "" }
            timeRecusado.value = ""

            timeJuntaDom.removeAttribute('required')
            timeJuntaSeg.removeAttribute('required')
            timeJuntaTer.setAttribute('required', 'required')
            timeJuntaQua.removeAttribute('required')
            timeJuntaQui.removeAttribute('required')
            timeJuntaSex.removeAttribute('required')
            timeJuntaSab.removeAttribute('required')

        } else if (diaSemana.includes('Qua')) {
            timeJuntaDom.name = ""
            timeJuntaSeg.name = ""
            timeJuntaTer.name = ""
            timeJuntaQua.name = "hora_agenda"
            timeJuntaQui.name = ""
            timeJuntaSex.name = ""
            timeJuntaSab.name = ""
            for (let time of timesPericia) { time.name = "" }
            for (let time of timesPsic) { time.name = "" }
            timeRecusado.name = ""
            
            timeJuntaDom.style.display = "none"
            timeJuntaSeg.style.display = "none"
            timeJuntaTer.style.display = "none"
            timeJuntaQua.style.display = "inline-block"
            timeJuntaQui.style.display = "none"
            timeJuntaSex.style.display = "none"
            timeJuntaSab.style.display = "none"
            for (let time of timesPericia) { time.style.display = "none" }
            for (let time of timesPsic) { time.style.display = "none" }
            timeRecusado.style.display = "none"
            
            timeJuntaDom.value = ""
            timeJuntaSeg.value = ""
            timeJuntaTer.value = ""
            // timeJuntaQua.value = ""
            timeJuntaQui.value = ""
            timeJuntaSex.value = ""
            timeJuntaSab.value = ""
            for (let time of timesPericia) { time.value = "" }
            for (let time of timesPsic) { time.value = "" }
            timeRecusado.value = ""

            timeJuntaDom.removeAttribute('required')
            timeJuntaSeg.removeAttribute('required')
            timeJuntaTer.removeAttribute('required')
            timeJuntaQua.setAttribute('required', 'required')
            timeJuntaQui.removeAttribute('required')
            timeJuntaSex.removeAttribute('required')
            timeJuntaSab.removeAttribute('required')

        } else if (diaSemana.includes('Qui')) {
            timeJuntaDom.name = ""
            timeJuntaSeg.name = ""
            timeJuntaTer.name = ""
            timeJuntaQua.name = ""
            timeJuntaQui.name = "hora_agenda"
            timeJuntaSex.name = ""
            timeJuntaSab.name = ""
            for (let time of timesPericia) { time.name = "" }
            for (let time of timesPsic) { time.name = "" }
            timeRecusado.name = ""
            
            timeJuntaDom.style.display = "none"
            timeJuntaSeg.style.display = "none"
            timeJuntaTer.style.display = "none"
            timeJuntaQua.style.display = "none"
            timeJuntaQui.style.display = "inline-block"
            timeJuntaSex.style.display = "none"
            timeJuntaSab.style.display = "none"
            for (let time of timesPericia) { time.style.display = "none" }
            for (let time of timesPsic) { time.style.display = "none" }
            timeRecusado.style.display = "none"
            
            timeJuntaDom.value = ""
            timeJuntaSeg.value = ""
            timeJuntaTer.value = ""
            timeJuntaQua.value = ""
            // timeJuntaQui.value = ""
            timeJuntaSex.value = ""
            timeJuntaSab.value = ""
            for (let time of timesPericia) { time.value = "" }
            for (let time of timesPsic) { time.value = "" }
            timeRecusado.value = ""

            timeJuntaDom.removeAttribute('required')
            timeJuntaSeg.removeAttribute('required')
            timeJuntaTer.removeAttribute('required')
            timeJuntaQua.removeAttribute('required')
            timeJuntaQui.setAttribute('required', 'required')
            timeJuntaSex.removeAttribute('required')
            timeJuntaSab.removeAttribute('required')

        } else if (diaSemana.includes('Sex')) {
            timeJuntaDom.name = ""
            timeJuntaSeg.name = ""
            timeJuntaTer.name = ""
            timeJuntaQua.name = ""
            timeJuntaQui.name = ""
            timeJuntaSex.name = "hora_agenda"
            timeJuntaSab.name = ""
            for (let time of timesPericia) { time.name = "" }
            for (let time of timesPsic) { time.name = "" }
            timeRecusado.name = ""
            
            timeJuntaDom.style.display = "none"
            timeJuntaSeg.style.display = "none"
            timeJuntaTer.style.display = "none"
            timeJuntaQua.style.display = "none"
            timeJuntaQui.style.display = "none"
            timeJuntaSex.style.display = "inline-block"
            timeJuntaSab.style.display = "none"
            for (let time of timesPericia) { time.style.display = "none" }
            for (let time of timesPsic) { time.style.display = "none" }
            timeRecusado.style.display = "none"
            
            timeJuntaDom.value = ""
            timeJuntaSeg.value = ""
            timeJuntaTer.value = ""
            timeJuntaQua.value = ""
            timeJuntaQui.value = ""
            // timeJuntaSex.value = ""
            timeJuntaSab.value = ""
            for (let time of timesPericia) { time.value = "" }
            for (let time of timesPsic) { time.value = "" }
            timeRecusado.value = ""

            timeJuntaDom.removeAttribute('required')
            timeJuntaSeg.removeAttribute('required')
            timeJuntaTer.removeAttribute('required')
            timeJuntaQua.removeAttribute('required')
            timeJuntaQui.removeAttribute('required')
            timeJuntaSex.setAttribute('required', 'required')
            timeJuntaSab.removeAttribute('required')

        } else if (diaSemana.includes('Sab')) {
            timeJuntaDom.name = ""
            timeJuntaSeg.name = ""
            timeJuntaTer.name = ""
            timeJuntaQua.name = ""
            timeJuntaQui.name = ""
            timeJuntaSex.name = ""
            timeJuntaSab.name = "hora_agenda"
            for (let time of timesPericia) { time.name = "" }
            for (let time of timesPsic) { time.name = "" }
            timeRecusado.name = ""
            
            timeJuntaDom.style.display = "none"
            timeJuntaSeg.style.display = "none"
            timeJuntaTer.style.display = "none"
            timeJuntaQua.style.display = "none"
            timeJuntaQui.style.display = "none"
            timeJuntaSex.style.display = "none"
            timeJuntaSab.style.display = "inline-block"
            for (let time of timesPericia) { time.style.display = "none" }
            for (let time of timesPsic) { time.style.display = "none" }
            timeRecusado.style.display = "none"
            
            timeJuntaDom.value = ""
            timeJuntaSeg.value = ""
            timeJuntaTer.value = ""
            timeJuntaQua.value = ""
            timeJuntaQui.value = ""
            timeJuntaSex.value = ""
            // timeJuntaSab.value = ""
            for (let time of timesPericia) { time.value = "" }
            for (let time of timesPsic) { time.value = "" }
            timeRecusado.value = ""

            timeJuntaDom.removeAttribute('required')
            timeJuntaSeg.removeAttribute('required')
            timeJuntaTer.removeAttribute('required')
            timeJuntaQua.removeAttribute('required')
            timeJuntaQui.removeAttribute('required')
            timeJuntaSex.removeAttribute('required')
            timeJuntaSab.setAttribute('required', 'required')
        }
        }

    /* atPericial */
    const timePericia = () => {
        let diaSemana = document.querySelector('#datepericia').value;
        
        let timesJunta = document.querySelectorAll('.timejunta');

        let timesPsic = document.querySelectorAll('.timepsic');
        
        let timeRecusado = document.querySelector('#timerecusado');
        
        let timePericiaDom = document.querySelector('#timepericiadom');
        let timePericiaSeg = document.querySelector('#timepericiaseg');
        let timePericiaTer = document.querySelector('#timepericiater');
        let timePericiaQua = document.querySelector('#timepericiaqua');
        let timePericiaQui = document.querySelector('#timepericiaqui');
        let timePericiaSex = document.querySelector('#timepericiasex');
        let timePericiaSab = document.querySelector('#timepericiasab');

        if (diaSemana.includes('Dom')) {
            timePericiaDom.name = "hora_agenda"
            timePericiaSeg.name = ""
            timePericiaTer.name = ""
            timePericiaQua.name = ""
            timePericiaQui.name = ""
            timePericiaSex.name = ""
            timePericiaSab.name = ""
            for (let time of timesJunta) { time.name = "" }
            for (let time of timesPsic) { time.name = "" }
            timeRecusado.name = ""
            
            timePericiaDom.style.display = "inline-block"
            timePericiaSeg.style.display = "none"
            timePericiaTer.style.display = "none"
            timePericiaQua.style.display = "none"
            timePericiaQui.style.display = "none"
            timePericiaSex.style.display = "none"
            timePericiaSab.style.display = "none"
            for (let time of timesJunta) { time.style.display = "none" }
            for (let time of timesPsic) { time.style.display = "none" }
            timeRecusado.style.display = "none"
            
            // timePericiaDom.value = ""
            timePericiaSeg.value = ""
            timePericiaTer.value = ""
            timePericiaQua.value = ""
            timePericiaQui.value = ""
            timePericiaSex.value = ""
            timePericiaSab.value = ""
            for (let time of timesJunta) { time.value = "" }
            for (let time of timesPsic) { time.value = "" }
            timeRecusado.value = ""

            timePericiaDom.setAttribute('required', 'required')
            timePericiaSeg.removeAttribute('required')
            timePericiaTer.removeAttribute('required')
            timePericiaQua.removeAttribute('required')
            timePericiaQui.removeAttribute('required')
            timePericiaSex.removeAttribute('required')
            timePericiaSab.removeAttribute('required')

        } else if (diaSemana.includes('Seg')) {
            timePericiaDom.name = ""
            timePericiaSeg.name = "hora_agenda"
            timePericiaTer.name = ""
            timePericiaQua.name = ""
            timePericiaQui.name = ""
            timePericiaSex.name = ""
            timePericiaSab.name = ""
            for (let time of timesJunta) { time.name = "" }
            for (let time of timesPsic) { time.name = "" }
            timeRecusado.name = ""
            
            timePericiaDom.style.display = "none"
            timePericiaSeg.style.display = "inline-block"
            timePericiaTer.style.display = "none"
            timePericiaQua.style.display = "none"
            timePericiaQui.style.display = "none"
            timePericiaSex.style.display = "none"
            timePericiaSab.style.display = "none"
            for (let time of timesJunta) { time.style.display = "none" }
            for (let time of timesPsic) { time.style.display = "none" }
            timeRecusado.style.display = "none"
            
            timePericiaDom.value = ""
            // timePericiaSeg.value = ""
            timePericiaTer.value = ""
            timePericiaQua.value = ""
            timePericiaQui.value = ""
            timePericiaSex.value = ""
            timePericiaSab.value = ""
            for (let time of timesJunta) { time.value = "" }
            for (let time of timesPsic) { time.value = "" }
            timeRecusado.value = ""

            timePericiaDom.removeAttribute('required')
            timePericiaSeg.setAttribute('required', 'required')
            timePericiaTer.removeAttribute('required')
            timePericiaQua.removeAttribute('required')
            timePericiaQui.removeAttribute('required')
            timePericiaSex.removeAttribute('required')
            timePericiaSab.removeAttribute('required')

        } else if (diaSemana.includes('Ter')) {
            timePericiaDom.name = ""
            timePericiaSeg.name = ""
            timePericiaTer.name = "hora_agenda"
            timePericiaQua.name = ""
            timePericiaQui.name = ""
            timePericiaSex.name = ""
            timePericiaSab.name = ""
            for (let time of timesJunta) { time.name = "" }
            for (let time of timesPsic) { time.name = "" }
            timeRecusado.name = ""
            
            timePericiaDom.style.display = "none"
            timePericiaSeg.style.display = "none"
            timePericiaTer.style.display = "inline-block"
            timePericiaQua.style.display = "none"
            timePericiaQui.style.display = "none"
            timePericiaSex.style.display = "none"
            timePericiaSab.style.display = "none"
            for (let time of timesJunta) { time.style.display = "none" }
            for (let time of timesPsic) { time.style.display = "none" }
            timeRecusado.style.display = "none"
            
            timePericiaDom.value = ""
            timePericiaSeg.value = ""
            // timePericiaTer.value = ""
            timePericiaQua.value = ""
            timePericiaQui.value = ""
            timePericiaSex.value = ""
            timePericiaSab.value = ""
            for (let time of timesJunta) { time.value = "" }
            for (let time of timesPsic) { time.value = "" }
            timeRecusado.value = ""

            timePericiaDom.removeAttribute('required')
            timePericiaSeg.removeAttribute('required')
            timePericiaTer.setAttribute('required', 'required')
            timePericiaQua.removeAttribute('required')
            timePericiaQui.removeAttribute('required')
            timePericiaSex.removeAttribute('required')
            timePericiaSab.removeAttribute('required')

        } else if (diaSemana.includes('Qua')) {
            timePericiaDom.name = ""
            timePericiaSeg.name = ""
            timePericiaTer.name = ""
            timePericiaQua.name = "hora_agenda"
            timePericiaQui.name = ""
            timePericiaSex.name = ""
            timePericiaSab.name = ""
            for (let time of timesJunta) { time.name = "" }
            for (let time of timesPsic) { time.name = "" }
            timeRecusado.name = ""
            
            timePericiaDom.style.display = "none"
            timePericiaSeg.style.display = "none"
            timePericiaTer.style.display = "none"
            timePericiaQua.style.display = "inline-block"
            timePericiaQui.style.display = "none"
            timePericiaSex.style.display = "none"
            timePericiaSab.style.display = "none"
            for (let time of timesJunta) { time.style.display = "none" }
            for (let time of timesPsic) { time.style.display = "none" }
            timeRecusado.style.display = "none"
            
            timePericiaDom.value = ""
            timePericiaSeg.value = ""
            timePericiaTer.value = ""
            // timePericiaQua.value = ""
            timePericiaQui.value = ""
            timePericiaSex.value = ""
            timePericiaSab.value = ""
            for (let time of timesJunta) { time.value = "" }
            for (let time of timesPsic) { time.value = "" }
            timeRecusado.value = ""

            timePericiaDom.removeAttribute('required')
            timePericiaSeg.removeAttribute('required')
            timePericiaTer.removeAttribute('required')
            timePericiaQua.setAttribute('required', 'required')
            timePericiaQui.removeAttribute('required')
            timePericiaSex.removeAttribute('required')
            timePericiaSab.removeAttribute('required')

        } else if (diaSemana.includes('Qui')) {
            timePericiaDom.name = ""
            timePericiaSeg.name = ""
            timePericiaTer.name = ""
            timePericiaQua.name = ""
            timePericiaQui.name = "hora_agenda"
            timePericiaSex.name = ""
            timePericiaSab.name = ""
            for (let time of timesJunta) { time.name = "" }
            for (let time of timesPsic) { time.name = "" }
            timeRecusado.name = ""
            
            timePericiaDom.style.display = "none"
            timePericiaSeg.style.display = "none"
            timePericiaTer.style.display = "none"
            timePericiaQua.style.display = "none"
            timePericiaQui.style.display = "inline-block"
            timePericiaSex.style.display = "none"
            timePericiaSab.style.display = "none"
            for (let time of timesJunta) { time.style.display = "none" }
            for (let time of timesPsic) { time.style.display = "none" }
            timeRecusado.style.display = "none"
            
            timePericiaDom.value = ""
            timePericiaSeg.value = ""
            timePericiaTer.value = ""
            timePericiaQua.value = ""
            // timePericiaQui.value = ""
            timePericiaSex.value = ""
            timePericiaSab.value = ""
            for (let time of timesJunta) { time.value = "" }
            for (let time of timesPsic) { time.value = "" }
            timeRecusado.value = ""

            timePericiaDom.removeAttribute('required')
            timePericiaSeg.removeAttribute('required')
            timePericiaTer.removeAttribute('required')
            timePericiaQua.removeAttribute('required')
            timePericiaQui.setAttribute('required', 'required')
            timePericiaSex.removeAttribute('required')
            timePericiaSab.removeAttribute('required')

        } else if (diaSemana.includes('Sex')) {
            timePericiaDom.name = ""
            timePericiaSeg.name = ""
            timePericiaTer.name = ""
            timePericiaQua.name = ""
            timePericiaQui.name = ""
            timePericiaSex.name = "hora_agenda"
            timePericiaSab.name = ""
            for (let time of timesJunta) { time.name = "" }
            for (let time of timesPsic) { time.name = "" }
            timeRecusado.name = ""
            
            timePericiaDom.style.display = "none"
            timePericiaSeg.style.display = "none"
            timePericiaTer.style.display = "none"
            timePericiaQua.style.display = "none"
            timePericiaQui.style.display = "none"
            timePericiaSex.style.display = "inline-block"
            timePericiaSab.style.display = "none"
            for (let time of timesJunta) { time.style.display = "none" }
            for (let time of timesPsic) { time.style.display = "none" }
            timeRecusado.style.display = "none"
            
            timePericiaDom.value = ""
            timePericiaSeg.value = ""
            timePericiaTer.value = ""
            timePericiaQua.value = ""
            timePericiaQui.value = ""
            // timePericiaSex.value = ""
            timePericiaSab.value = ""
            for (let time of timesJunta) { time.value = "" }
            for (let time of timesPsic) { time.value = "" }
            timeRecusado.value = ""

            timePericiaDom.removeAttribute('required')
            timePericiaSeg.removeAttribute('required')
            timePericiaTer.removeAttribute('required')
            timePericiaQua.removeAttribute('required')
            timePericiaQui.removeAttribute('required')
            timePericiaSex.setAttribute('required', 'required')
            timePericiaSab.removeAttribute('required')

        } else if (diaSemana.includes('Sab')) {
            timePericiaDom.name = ""
            timePericiaSeg.name = ""
            timePericiaTer.name = ""
            timePericiaQua.name = ""
            timePericiaQui.name = ""
            timePericiaSex.name = ""
            timePericiaSab.name = "hora_agenda"
            for (let time of timesJunta) { time.name = "" }
            for (let time of timesPsic) { time.name = "" }
            timeRecusado.name = ""
            
            timePericiaDom.style.display = "none"
            timePericiaSeg.style.display = "none"
            timePericiaTer.style.display = "none"
            timePericiaQua.style.display = "none"
            timePericiaQui.style.display = "none"
            timePericiaSex.style.display = "none"
            timePericiaSab.style.display = "inline-block"
            for (let time of timesJunta) { time.style.display = "none" }
            for (let time of timesPsic) { time.style.display = "none" }
            timeRecusado.style.display = "none"
            
            timePericiaDom.value = ""
            timePericiaSeg.value = ""
            timePericiaTer.value = ""
            timePericiaQua.value = ""
            timePericiaQui.value = ""
            timePericiaSex.value = ""
            // timePericiaSab.value = ""
            for (let time of timesJunta) { time.value = "" }
            for (let time of timesPsic) { time.value = "" }
            timeRecusado.value = ""

            timePericiaDom.removeAttribute('required')
            timePericiaSeg.removeAttribute('required')
            timePericiaTer.removeAttribute('required')
            timePericiaQua.removeAttribute('required')
            timePericiaQui.removeAttribute('required')
            timePericiaSex.removeAttribute('required')
            timePericiaSab.setAttribute('required', 'required')
        }
    }

    const outroMotivo = () => {
        let motivo = document.querySelector('#motivo_recusa');
        let outroDiv = document.querySelector('#outro-div');
        let outroMotivo = document.querySelector('#outro-motivo');
        if (motivo.value === "Outro") {
            outroDiv.style.display = "block";
            outroMotivo.setAttribute('required', 'required')
            outroMotivo.name = "motivo_recusa";
            motivo.name = "";
            motivo.removeAttribute('required')
        } else {
            motivo.name = "motivo_recusa";
            motivo.setAttribute('required', 'required')
            outroDiv.style.display = "none";
            outroMotivo.name = "";
            outroMotivo.removeAttribute('required')
        }
    }
</script>

<script>
    document.querySelector('.ui-timepicker').style.height = 'auto';
    document.querySelector('.ui-timepicker-viewport').style.height = 'auto';
    document.querySelector('.ui-timepicker-container').style.height = 'auto';
</script>
<script>
    const submitBtn = document.querySelector('#enviar');
    const form = document.querySelector('form');

    submitBtn.addEventListener('click', (e) => {
        swal({
                title: "Atenção!",
                text: `Você está prestes a confirmar a presença do requerimento.`,
                icon: "warning",
                buttons: {
                    cancel: {
                        text: "Cancelar",
                        value: "cancelar",
                        visible: true,
                        closeModal: true
                    },
                    ok: {
                        text: "Confirmar",
                        value: 'ok',
                        visible: true,
                        closeModal: true
                    }
                }
            }).then(function(resultado){
            if(resultado === 'ok'){
                if(form.checkValidity()) {
                    form.submit();
                    $("#modaleventclick").modal("show");
                } else {
                    form.reportValidity();
                }
            }
		});
    });
</script>
@endpush