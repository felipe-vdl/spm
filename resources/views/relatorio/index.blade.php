@extends('gentelella.layouts.app')


@section('content')

   <div class="x_panel modal-content">
      <div class="x-title">
         <h2><i class="fas fa-solid fa-file-pdf"></i> Relatório de Requerimentos Agendados</h2>
         <div class="clearfix"></div>
      </div>
   
      <div class="x_panel">
         <div class="x_content">
            <div class="form-group row">
               <label class="control-label col-md-2 col-sm-2 ">Selecione o Intervalo:</label>
               <input required class="data-intervalo" autocomplete="off" type="text" name="daterange" id="daterange" placeholder="dd/mm/aaaa - dd/mm/aaaa" onchange="relatorioCheck()" title="Intervalo de data." style="width:188px;">
            </div>
            <div class="footer text-center">
               <br>
               <div id="divLink" style="visibility:hidden;">
                  <b>Clique no botão abaixo para gerar a listagem em PDF</b><br>
                  <a class="btn btn-info" target="_blank" href="#" id="link">Gerar Relatório</a>
               </div>
               <br><br>
               <div id="divLinkWord" style="visibility:hidden;">
                  <b>Clique no botão abaixo para gerar a listagem em Excel</b><br>
                  <a class="btn btn-success" href="#" id="linkWord">Gerar Relatório</a>
               </div>
           </div>

         </div>
      </div>
   </div>
@endsection

@push('scripts')
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script>
   $('#daterange').daterangepicker({
      "locale": {
         "format": 'DD/MM/YYYY',
         "separator": " — ",
         "applyLabel": "Aplicar",
         "cancelLabel": "Cancelar",
         "fromLabel": "De",
         "toLabel": "Até",
         "customRangeLabel": "Personalizado",
         "weekLabel": "S",
         "daysOfWeek": [
            "Dom",
            "Seg",
            "Ter",
            "Qua",
            "Qui",
            "Sex",
            "Sáb"
         ],
         "monthNames": [
            "Janeiro",
            "Fevereiro",
            "Março",
            "Abril",
            "Maio",
            "Junho",
            "Julho",
            "Agosto",
            "Setembro",
            "Outubro",
            "Novembro",
            "Dezembro"
         ],
         "firstDay": 1
      },
      "autoApply": true,
      /* "maxDate": moment() */
   });
</script>

<script>
   const dataIntervalo = document.querySelector('#daterange');
   const pdfDiv = document.querySelector('#divLink');
   const pdfLink = document.querySelector('#link');

   const wordDiv = document.querySelector('#divLinkWord');
   const wordLink = document.querySelector('#linkWord');

   function relatorioCheck() {
      let dataInterv = dataIntervalo.value.replaceAll('/', '-').replaceAll('—', '').replaceAll(' ', '');

      let endereco = "relatorio/pdf/"+dataInterv;
      let enderecoWord = "export-the-docx/"+dataInterv;

      pdfLink.setAttribute('href', endereco);
      pdfDiv.style.visibility = 'visible';

      wordLink.setAttribute('href', enderecoWord);
      wordDiv.style.visibility = 'visible';
   }
</script>

<script>
   dataIntervalo.value = "";
</script>

@endpush