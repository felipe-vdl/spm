@extends('gentelella.layouts.app')

@section('content')
<div class="x_panel modal-content">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  @endif
  <div class="x_title">
    <h5 class="text-center fw-light p-1 m-0"><i class="fas fa-cogs"></i> {{ $direcionamento->nome }}</h5>
  </div>
  <div class="x_panel">
    <div class="x_content">
      <form method="post" action="{{ route('direcionamentos.update', $direcionamento->id ) }}">
        @csrf
        @method('PATCH')
        <table class="table">
          <thead>
            <th class="">Dia</th>
            <th class="text-center">Habilitar dia?</th>
            <th class="text-center">Horário Mínimo</th>
            <th class="text-center">Horário Máximo</th>
          </thead>
          <tbody>
            <tr>
              <td class="" style="width: 25%;">Domingo</td>
              <td class="text-center">
                <input type="hidden" value="0" name="dom[isOn]">
                <input type="checkbox" @if($config[0]->isOn) checked @endif value="1" name="dom[isOn]">
              </td>
              <td style="width: 25%;" class="text-center">
                <input autocomplete="off" value="{{ $config[0]->inicio }}" name="dom[inicio]" class="timepickers" type="text" placeholder="hh:mm">
              </td>
              <td style="width: 25%;" class="text-center">
                <input autocomplete="off" value="{{ $config[0]->fim }}" name="dom[fim]" class="timepickers" type="text" placeholder="hh:mm">
              </td>
            </tr>
            <tr>
              <td class="" style="width: 25%;">Segunda-Feira</td>
              <td class="text-center">
                <input type="hidden" value="0" name="seg[isOn]">
                <input type="checkbox" @if($config[1]->isOn) checked @endif value="1" name="seg[isOn]">
              </td>
              <td style="width: 25%;" class="text-center">
                <input autocomplete="off" value="{{ $config[1]->inicio }}" name="seg[inicio]" class="timepickers" type="text" placeholder="hh:mm">
              </td>
              <td style="width: 25%;" class="text-center">
                <input autocomplete="off" value="{{ $config[1]->fim }}" name="seg[fim]" class="timepickers" type="text" placeholder="hh:mm">
              </td>
            </tr>
            <tr>
              <td class="" style="width: 25%;">Terça-Feira</td>
              <td class="text-center">
                <input type="hidden" value="0" name="ter[isOn]">
                <input type="checkbox" @if($config[2]->isOn) checked @endif value="1" name="ter[isOn]">
              </td>
              <td style="width: 25%;" class="text-center">
                <input autocomplete="off" value="{{ $config[2]->inicio }}" name="ter[inicio]" class="timepickers" type="text" placeholder="hh:mm">
              </td>
              <td style="width: 25%;" class="text-center">
                <input autocomplete="off" value="{{ $config[2]->fim }}" name="ter[fim]" class="timepickers" type="text" placeholder="hh:mm">
              </td>
            </tr>
            <tr>
              <td class="" style="width: 25%;">Quarta-Feira</td>
              <td class="text-center">
                <input type="hidden" value="0" name="qua[isOn]">
                <input type="checkbox" @if($config[3]->isOn) checked @endif value="1" name="qua[isOn]">
              </td>
              <td style="width: 25%;" class="text-center">
                <input autocomplete="off" value="{{ $config[3]->inicio }}" name="qua[inicio]" class="timepickers" type="text" placeholder="hh:mm">
              </td>
              <td style="width: 25%;" class="text-center">
                <input autocomplete="off" value="{{ $config[3]->fim }}" name="qua[fim]" class="timepickers" type="text" placeholder="hh:mm">
              </td>
            </tr>
            <tr>
              <td class="" style="width: 25%;">Quinta-Feira</td>
              <td class="text-center">
                <input type="hidden" value="0" name="qui[isOn]">
                <input type="checkbox" @if($config[4]->isOn) checked @endif value="1" name="qui[isOn]">
              </td>
              <td style="width: 25%;" class="text-center">
                <input autocomplete="off" value="{{ $config[4]->inicio }}" name="qui[inicio]" class="timepickers" type="text" placeholder="hh:mm">
              </td>
              <td style="width: 25%;" class="text-center">
                <input autocomplete="off" value="{{ $config[4]->fim }}" name="qui[fim]" class="timepickers" type="text" placeholder="hh:mm">
              </td>
            </tr>
            <tr>
              <td class="" style="width: 25%;">Sexta-Feira</td>
              <td class="text-center">
                <input type="hidden" value="0" name="sex[isOn]">
                <input type="checkbox" @if($config[5]->isOn) checked @endif value="1" name="sex[isOn]">
              </td>
              <td style="width: 25%;" class="text-center">
                <input autocomplete="off" value="{{ $config[5]->inicio }}" name="sex[inicio]" class="timepickers" type="text" placeholder="hh:mm">
              </td>
              <td style="width: 25%;" class="text-center">
                <input autocomplete="off" value="{{ $config[5]->fim }}" name="sex[fim]" class="timepickers" type="text" placeholder="hh:mm">
              </td>
            </tr>
            <tr>
              <td class="" style="width: 25%;">Sábado</td>
              <td class="text-center">
                <input type="hidden" value="0" name="sab[isOn]">
                <input type="checkbox" @if($config[6]->isOn) checked @endif value="1" name="sab[isOn]">
              </td>
              <td style="width: 25%;" class="text-center">
                <input autocomplete="off" value="{{ $config[6]->inicio }}" name="sab[inicio]" class="timepickers" type="text" placeholder="hh:mm">
              </td>
              <td style="width: 25%;" class="text-center">
                <input autocomplete="off" value="{{ $config[6]->fim }}" name="sab[fim]" class="timepickers" type="text" placeholder="hh:mm">
              </td>
            </tr>
          </tbody>
          <tfoot>
            <th>
              <a href="{{ route('direcionamentos.index') }}" id="cancelar" title="Cancelar operação." class="btn btn-primary">Cancelar</a>
              <a id="enviar" title="Salvar configurações." class="btn btn-success">Salvar Configuração</a>
            </th>
          </tfoot>
        </table>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="modaleventclick" tabindex="-1" role="dialog" aria-labelledby="modaleventclickLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modaleventclickLabel">Aplicando as configurações, por favor aguarde.</h5>
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
  const config = @json($config);
  console.log(config);

  /* timePicker */
  $('.timepickers').timepicker({
    timeFormat: 'HH:mm',
    interval: 60,
    minTime: "00:00",
    maxTime: "23:00",
    defaultTime: "",
    startTime: "",
    dynamic: false,
    dropdown: true,
    scrollbar: true
  });
</script>
<script>
  const submitBtn = document.querySelector('#enviar');
  const form = document.querySelector('form');

  submitBtn.addEventListener('click', (e) => {
    swal({
      title: "Atenção!",
      text: `Você está prestes a aplicar a configuração.`,
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
    if(resultado === 'ok') {
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