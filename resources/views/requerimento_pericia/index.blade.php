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
        <h5><i class="fas fa-file-contract"></i> Requerimentos de Perícia Médica</h5>
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
                        <th>Email Enviado</th>
                    </tr>
                </thead>
                <tbody class="tabela">
                    @foreach($requerimentos as $requerimento)
                        @if ($requerimento->status === 0 OR $requerimento->status === 3 OR $requerimento->status === 5)
                            <tr>
                                <td>{{substr($requerimento->nome, 0, 12).'...'}}</td>
                                <td>{{$requerimento->matricula}}</td>
                                <td>{{$requerimento->protocolo}}</td>
                                {{-- <td>{{$requerimento->email}}</td> --}}
                                <td>{{date('d/m/Y', strtotime($requerimento-> created_at))}}</td>

                                <td>
                                    @if ($requerimento->status == 0)
                                        <a style="color: gray">Em Análise</a>
                                    @elseif($requerimento->status == 3)
                                    <a style="color: blue">Aguardando Confirmação</a>
                                    @elseif($requerimento->status == 5)
                                    <a style="color: gray">Reagendamento Solicitado</a>
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
                                    @if ($requerimento->status == 0 OR $requerimento->status == 5)
                                        <a href="{{ route('requerimento_pericias.edit', $requerimento->id)}}" class="btn btn-primary btn-xs" title="Avaliar requerimento.">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                            </svg>
                                        </a>
                                    @endif
                                    @if ($requerimento->status == 3 AND Auth::user()->nivel == "Super-Admin")
                                    <form style="display: inline-block;" action="{{ route('requerimentos.confirmacaointerna') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="protocolo" value="{{$requerimento->protocolo}}">
                                        <input type="hidden" name="presenca" value="1">
                                        <button type="submit" class="enviador btn btn-success btn-xs" title="Finalizar e marcar presença.">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-patch-check-fill" viewBox="0 0 16 16">
                                                <path d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zm.287 5.984-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7 8.793l2.646-2.647a.5.5 0 0 1 .708.708z"/>
                                            </svg>
                                        </button>
                                    </form>
                                    <form style="display: inline-block;" action="{{ route('requerimentos.confirmacaointerna') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="protocolo" value="{{$requerimento->protocolo}}">
                                        <input type="hidden" name="presenca" value="0">
                                        <button type="submit" class="enviador btn btn-danger btn-xs" title="Finalizar e marcar ausência.">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-patch-exclamation-fill" viewBox="0 0 16 16">
                                                <path d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zM8 4c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995A.905.905 0 0 1 8 4zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                            </svg>
                                        </button>
                                    </form>
                                    @endif
                                    @if (Auth::user()->nivel == "Super-Admin")
                                    <a style="vertical-align: top;" href="{{ route('requerimento_pericias.show', $requerimento->id)}}" class="btn btn-info btn-xs" title="Detalhar requerimento.">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                            <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                        </svg>
                                    </td>
                                    @endif
                                </td>

                                <td>
                                    @if ($requerimento->status != 0)
                                        {{ substr($requerimento->user->name, 0, strpos($requerimento->user->name, ' ')) }}
                                    @endif
                                </td>

                                <td>
                                    @if ($requerimento->envio_create == 1)
                                        Sim /
                                    @else
                                        Não /
                                    @endif

                                    @if ($requerimento->envio_agenda == 1)
                                        Sim /
                                    @else
                                        Não /
                                    @endif

                                    
                                    @if ($requerimento->envio_reagenda != null)
                                        @if ($requerimento->envio_reagenda == 1)
                                            Sim
                                        @elseif($requerimento->envio_reagenda == 0)
                                            Não
                                        @endif    
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
                        <th><input class="filter-input" data-column="7" type="text" placeholder="Filtro por Ações"></th>
                        <th><input class="filter-input" data-column="8" type="text" placeholder="Filtro por Avaliador"></th>
                        <th><input class="filter-input" data-column="9" type="text" placeholder="Filtro por Email"></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        const allSubmitBtns = document.querySelectorAll('.enviador');

        for (let btn of allSubmitBtns) {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                let formulario = this.form;
                if(formulario.checkValidity()) {
                    swal({
                        title: "Atenção!",
                        text: `Você está prestes a finalizar um requerimento.`,
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
                            formulario.submit();
                        }
                    });
                } else {
                    formulario.reportValidity();
                }
            });
        }
    </script>
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
                    { "width": "10%", "targets": 0 },
                    { "width": "5%",  "targets": 1 },
                    { "width": "10%",  "targets": 2 },
                    { "width": "9%",  "targets": 3 },
                    { "width": "10%", "targets": 4 },
                    { "width": "10%", "targets": 5 },
                    { "width": "10%", "targets": 6 },
                    { "width": "12%", "targets": 7 },
                    { "width": "7%",  "targets": 8 },
                    { "width": "5%",  "targets": 9 },
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
@endpush