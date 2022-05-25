@extends('gentelella.layouts.app')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
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
        <h5><i class="fas fa-solid fa-folder-open"></i> Requerimentos Arquivados</h5>
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
                        <th>Presença</th>
                        <th>Ações</th>
                        <th>Avaliador</th>
                    </tr>
                </thead>
                <tbody class="tabela">
                    @foreach($requerimentos as $requerimento)
                        @if($requerimento->status === 4 OR $requerimento->status === 1)
                            <tr>
                                <td>{{substr($requerimento->nome, 0, 12).'...'}}</td>
                                <td>{{$requerimento->matricula}}</td>
                                <td>{{$requerimento->protocolo}}</td>
                                {{-- <td>{{$requerimento->email}}</td> --}}
                                <td>{{date('d/m/Y', strtotime($requerimento-> created_at))}}</td>
                                <td>
                                    @if($requerimento->status == 1)
                                        <a style="color: red">Recusado</a>
                                    @elseif($requerimento->status == 4)
                                        <a style="color: green">Confirmado</a>
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
                                    <form style="display: inline-block" action="{{ route('presente', $requerimento->id)}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="hiddeninput" value="{{ $requerimento->id }}">
                                        <a style="display: inline-block;" class="btn btn-success presente btn-xs" title="Marcar presença.">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-patch-check-fill" viewBox="0 0 16 16">
                                                <path d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zm.287 5.984-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7 8.793l2.646-2.647a.5.5 0 0 1 .708.708z"/>
                                            </svg>
                                        </a>
                                    </form>
                                    <form style="display: inline-block" action="{{ route('ausente', $requerimento->id)}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="hiddeninput" value="{{ $requerimento->id }}">
                                        <a style="display: inline-block;" class="btn btn-danger ausente btn-xs" title="Marcar ausência.">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-patch-exclamation-fill" viewBox="0 0 16 16">
                                                <path d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zM8 4c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995A.905.905 0 0 1 8 4zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                            </svg>
                                        </a>
                                    </form>
                                    @elseif ($requerimento->presenca == 0)
                                    <a style="color: red">Ausente</a>
                                    @elseif ($requerimento->presenca == 1)
                                    <a style="color: green">Presente</a>
                                    @endif
                                </td>

                                <td><a href="{{ route('requerimento_pericias.show', $requerimento->id)}}" class="btn btn-info btn-xs">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                        <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                    </svg>
                                </a></td>
                                
                                <td>
                                    @if ($requerimento->status != 0)
                                        {{ substr($requerimento->user->name, 0, strpos($requerimento->user->name, ' ')) }}
                                    @endif
                                </td>
                            </tr>
                        @endif
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
                        <th><input class="filter-input" data-column="7" type="text" placeholder="Filtro por Presença"></th>
                        <th><input class="filter-input" data-column="8" type="text" placeholder="Filtro por Ações"></th>
                        <th><input class="filter-input" data-column="9" type="text" placeholder="Filtro por Avaliador"></th>
                    </tr>
                </tfoot>
            </table>
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
                    { "width": "12%", "targets": 0 },
                    { "width": "16%", "targets": 6 },
                    { "width": "12%", "targets": 7 },
                    { "type": 'date-euro', "targets": 6}
                    ],
                    order: [[3, "desc"]],
                    "responsive": true,
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