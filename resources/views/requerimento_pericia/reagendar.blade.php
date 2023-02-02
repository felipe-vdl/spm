@extends('gentelella.layouts.app')

@section('content')
@if(session()->get('success'))
<div class="alert alert-success">
    {{ session()->get('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
@if(session()->get('error'))
<div class="alert alert-danger">
    {{ session()->get('error') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
<div class="x_panel modal-content">
  <div class="x_title">
    <h5 class="text-center fw-light p-1 m-0"><i class="fas fa-file-contract"></i> Reagendamento em Massa</h5>
  </div>
    <div class="x_panel">
        <form method="post" id="reagenda-form" action="{{ url('/requerimento_pericias/reagendar') }}">
        @csrf
            <div class="x_title">
                <label for="data">Data a ser cancelada:</label>
                <input autocomplete="off" name="data_cancela" type="text" id="datecancela" placeholder="dd/mm/aaaa">
            </div>
            <div class="x_content">
                <div class="avaliacao" style="justify-content: space-between;">
                    <div class="datahora">
                        <label class="labelDate">Nova data de atendimento:</label>
                        <input autocomplete="off" type="text" id="datenova" placeholder="dd/mm/aaaa" name="data_nova" style="display: inline-block;">
                    </div>
                    <div>
                        <label for="justificativa">Justificativa:</label>
                        <input type="text" id="justificativa" name="justificativa" placeholder="Descreva o motivo." maxlength="100">
                    </div>
                    <div>
                        <a id="enviar" title="Enviar reagendamentos." class="btn btn-success">Enviar Reagendamentos</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@if (Auth::user()->nivel == "Super-Admin")
    <div class="x_panel modal-content" style="margin-top: 3rem;">
    <div class="x_title">
        <h5 class="text-center fw-light p-1 m-0"><i class="fas fa-file-contract"></i> Reenviar E-mails</h5>
    </div>
        <div class="x_panel">
            <form method="GET" id="reenvio-form" action="{{ url('/requerimento_pericias/reenviar') }}">
            @csrf
                <div class="x_content">
                    <div>
                        <a id="reenviar" title="Reenviar E-mail." class="btn btn-success">Reenviar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @push('scripts')
    <script defer>
        const submitReenvioBtn = document.querySelector('#reenviar');
        const formReenvio = document.querySelector('#reenvio-form');

        submitReenvioBtn.addEventListener('click', (e) => {
            swal({
                    title: "Atenção!",
                    text: `Você está prestes a reenviar os e-mails.`,
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
                    if(formReenvio.checkValidity()) {
                        formReenvio.submit();
                        $("#modaleventclick").modal("show");
                    } else {
                        formReenvio.reportValidity();
                    }
                }
            });
        });
    </script>
    @endpush
@endif
<div class="modal fade" id="modaleventclick" tabindex="-1" role="dialog" aria-labelledby="modaleventclickLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modaleventclickLabel">Enviando, por favor aguarde.</h5>
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
{{-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script> --}}
{{-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> --}}
{{-- <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script> --}}
<script src="{{ asset('js/jquery.timepicker.min.js') }}"></script>
{{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> --}}
<script src="{{ asset('js/sweetalert.min.js') }}"></script>
<script>

    $('#datecancela').datepicker({
            dateFormat: 'dd/mm/yy',
            dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
            dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S', 'D'],
            dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
            monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
            monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
            nextText: 'Proximo',
            prevText: 'Anterior',
        });
    
    $('#datenova').datepicker({
        dateFormat: 'dd/mm/yy',
        dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
        dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S', 'D'],
        dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
        monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
        monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
        nextText: 'Proximo',
        prevText: 'Anterior',
        minDate: '1'
    });
</script>
<script defer>
    const submitBtn = document.querySelector('#enviar');
    const form = document.querySelector('#reagenda-form');

    submitBtn.addEventListener('click', (e) => {
        swal({
                title: "Atenção!",
                text: `Você está prestes a confirmar o reagendamento dos requerimentos.`,
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