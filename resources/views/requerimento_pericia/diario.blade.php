@extends('gentelella.layouts.app')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
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
    @if(session()->get('error'))
        <div class="alert alert-danger">
            {{ session()->get('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="x_title">
        <h5><i class="fas fa-file-contract"></i>Agenda Diária</h5>
    </div>
    <div class="x_panel">
        <div class="x_content">
            <table id="tb_requerimentos" class="display responsive table table-hover table-striped compact" style="width:100%">
                <thead class="tabela">
                    <tr>
                        <th>Nome Completo</th>
                        <th>Matrícula</th>
                        <th>Protocolo</th>
                        {{-- <th>E-Mail</th> --}}
                        <th>Data do Requerimento</th>
                        <th>Status</th>
                        <th>Direcionamento</th>
                        <th>Data/Hora Agendada</th>
                        <th>Ações</th>
                        <th>Avaliador</th>
                    </tr>
                </thead>
                <tbody class="tabela">
                    @foreach($requerimentos as $requerimento)
                        <tr>
                            <td>{{$requerimento->nome}}</td>
                            <td>{{$requerimento->matricula}}</td>
                            <td>{{$requerimento->protocolo}}</td>
                            {{-- <td>{{$requerimento->email}}</td> --}}
                            <td>{{date('d/m/Y', strtotime($requerimento-> created_at))}}</td>

                            <td>
                                @if ($requerimento->status == 4)
                                    <a style="color: green">Confirmado</a>
                                @elseif ($requerimento->status == 3)
                                    <a style="color: blue">Aguardando Confirmação</a>
                                @endif
                            </td>

                            <td>{{$requerimento->direcionamento}}</td>
                            
                            <td>
                                @if ($requerimento->data_reagendada)
                                    {{ date('d/m/Y', strtotime($requerimento->data_reagendada))." ".$requerimento->hora_reagendada }}
                                @elseif ($requerimento->data_agenda)
                                    {{ date('d/m/Y', strtotime($requerimento->data_agenda))." ".$requerimento->hora_agenda }}
                                @endif
                            </td>

                            <td>
                                @if ($requerimento->presenca == -1)
                                <form style="display: inline" action="{{ route('presente', $requerimento->id)}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="hiddeninput" value="{{ $requerimento->id }}">
                                    <a style="display: inline-block;" class="btn btn-success presente" title="Marcar presença.">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
                                            <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z"/>
                                        </svg>
                                    </a>
                                </form>
                                <form style="display: inline" action="{{ route('ausente', $requerimento->id)}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="hiddeninput" value="{{ $requerimento->id }}">
                                    <a style="display: inline-block;" class="btn btn-danger ausente" title="Marcar ausência.">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M13.854 2.146a.5.5 0 0 1 0 .708l-11 11a.5.5 0 0 1-.708-.708l11-11a.5.5 0 0 1 .708 0Z"/>
                                            <path fill-rule="evenodd" d="M2.146 2.146a.5.5 0 0 0 0 .708l11 11a.5.5 0 0 0 .708-.708l-11-11a.5.5 0 0 0-.708 0Z"/>
                                        </svg>
                                    </a>
                                </form>
                                @elseif ($requerimento->presenca == 0)
                                <a style="color: red">Ausente</a>
                                @elseif ($requerimento->presenca == 1)
                                <a style="color: green">Presente</a>
                                @endif
                            </td>

                            <td>
                                @if ($requerimento->status != 0)
                                    {{ substr($requerimento->user->name, 0, strpos($requerimento->user->name, ' ')) }}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="tabela">
                    <tr>
                        <th><input class="filter-input" data-column="0" type="text" placeholder="Filtro por Nome"></th>
                        <th><input class="filter-input" data-column="1" type="text" placeholder="Filtro por Matrícula"></th>
                        <th><input class="filter-input" data-column="2" type="text" placeholder="Filtro por Protocolo"></th>
                        {{-- <th><input class="filter-input" data-column="3" type="text" placeholder="Filtro por E-mail"></th> --}}
                        <th><input class="filter-input" data-column="3" type="text" placeholder="Filtro por Data do Requerimento"></th>
                        <th><input class="filter-input" data-column="4" type="text" placeholder="Filtro por Status"></th>
                        <th><input class="filter-input" data-column="5" type="text" placeholder="Filtro por Direcionamento"></th>
                        <th><input class="filter-input" data-column="6" type="text" placeholder="Filtro por Data/Hora Agendada"></th>
                        <th><input class="filter-input" data-column="7" type="text" placeholder="Filtro por Ações"></th>
                        <th><input class="filter-input" data-column="8" type="text" placeholder="Filtro por Avaliador"></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
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
    <script>
        jQuery.extend( jQuery.fn.dataTableExt.oSort, {
            "date-euro-pre": function ( a ) {
                var x;
        
                if ( a.trim() !== '' ) {
                    var frDatea = a.trim().split(' ');
                    var frTimea = (undefined != frDatea[1]) ? frDatea[1].split(':') : [00,00,00];
                    var frDatea2 = frDatea[0].split('/');
                    x = (frDatea2[2] + frDatea2[1] + frDatea2[0] + frTimea[0] + frTimea[1] + ((undefined != frTimea[2]) ? frTimea[2] : 0)) * 1;
                }
                else {
                    x = Infinity;
                }
        
                return x;
            },
        
            "date-euro-asc": function ( a, b ) {
                return a - b;
            },
        
            "date-euro-desc": function ( a, b ) {
                return b - a;
            }
        } );
        
        $(document).ready( function () {
            $.fn.dataTable.moment('DD/MM/YYYY');
            var table = $('#tb_requerimentos').DataTable({
                    "language" : {
                        "url" : "{{ asset('js/portugues.json') }}"
                    },
                    "columnDefs": [
                    { "width": "25%", "targets": 0 },
                    { "width": "15%", "targets": 6 },
                    { "width": "10%", "targets": 7 },
                    { "type": 'date-euro', "targets": 6}
                    ],
                    order: [[3, "desc"]],
                    "responsive": true,
                    "aoColumns": [
                        null,
                        null,
                        null,
                        { "sType": "date-uk" },
                        null,
                        null,
                        null,
                        null,
                        null
                    ]
                });

                $('.filter-input').keyup(function() {
                    table.column( $(this).data('column') )
                    .search( $(this).val() )
                    .draw();
                });
        } );
    </script>
    <script>
        const presencaButtons = document.querySelectorAll('.presente');
        const ausenciaButtons = document.querySelectorAll('.ausente');

        for (let button of presencaButtons) {
            button.addEventListener('click', (e) => {
                swal({
					title: "Atenção!",
					text: `Você está prestes a confirmar a presença do requerimento.`,
					icon: "warning",
					buttons: {
					  cancel: {
						 text: "Cancelar",
						 value: "cancelar",
						 visible: true,
						 closeModal: true,
					  },
					  ok: {
						 text: "Confirmar",
						 value: 'ok',
						 visible: true,
						 closeModal: true,
					  }
					}
				 }).then(function(resultado){
                    if(resultado === 'ok'){
                        button.parentElement.submit();
                        $("#modaleventclick").modal("show");
                    }
		        });
            });
        }
        
        for (let button of ausenciaButtons) {
            button.addEventListener('click', (e) => {
                swal({
					title: "Atenção!",
					text: `Você está prestes a confirmar a ausência do requerimento.`,
					icon: "warning",
					buttons: {
					  cancel: {
						 text: "Cancelar",
						 value: "cancelar",
						 visible: true,
						 closeModal: true,
					  },
					  ok: {
						 text: "Confirmar",
						 value: 'ok',
						 visible: true,
						 closeModal: true,
					  }
					}
				 }).then(function(resultado){
                    if(resultado === 'ok'){
                        button.parentElement.submit();
                        $("#modaleventclick").modal("show");
                    }
		        });
            });
        }
    </script>
@endpush