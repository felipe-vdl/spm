@extends('gentelella.layouts.app')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
@section('content')
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
                        <th>Data/Hora do Requerimento</th>
                        <th>Status</th>
                        <th>Direcionamento</th>
                        <th>Data/Hora Agendada</th>
                        <th>Ações</th>
                        <th>Avaliador</th>
                    </tr>
                </thead>
                <tbody class="tabela">
                    @foreach($requerimentos as $requerimento)
                        @if($requerimento->status === 4 OR $requerimento->status === 1)
                            <tr>
                                <td>{{$requerimento->nome}}</td>
                                <td>{{$requerimento->matricula}}</td>
                                <td>{{$requerimento->protocolo}}</td>
                                {{-- <td>{{$requerimento->email}}</td> --}}
                                <td>{{date('d/m/Y H:i', strtotime($requerimento-> created_at))}}</td>
                                <td>
                                    @if($requerimento->status == 1)
                                        <a style="color: red">Recusado</a>
                                    @elseif($requerimento->status == 4)
                                        <a style="color: green">Finalizado</a>
                                    @endif
                                </td>

                                <td>{{$requerimento->direcionamento}}</td>

                                <td>
                                    @if ($requerimento->data_agenda)
                                        {{ date('d/m/Y', strtotime($requerimento->data_agenda))." ".$requerimento->hora_agenda }}
                                    @endif
                                </td>

                                <td><a href="{{ route('requerimento_pericias.show', $requerimento->id)}}" class="btn btn-info">Detalhar</a></td>
                                
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
                        <th><input class="filter-input" data-column="3" type="text" placeholder="Filtro por Data/Hora do Requerimento"></th>
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
@endsection

@push('scripts')
    <script src="//cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready( function () {
            var table = $('#tb_requerimentos').DataTable({
                    "language" : {
                        "url" : "{{ asset('js/portugues.json') }}"
                    },
                    "columnDefs": [
                    { "width": "30%", "targets": 0 },
                    { "width": "15%", "targets": 6 },
                    ],
                    "responsive": true
                });

                $('.filter-input').keyup(function() {
                    table.column( $(this).data('column') )
                    .search( $(this).val() )
                    .draw();
                });
        } );
    </script>
@endpush