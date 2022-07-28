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
        <h5><i class="fas fa-file-contract"></i> Direcionamentos</h5>
    </div>
    <div class="x_panel">
        <div class="x_content">
            <table id="tb_direcionamentos" class="display responsive table table-hover table-striped compact" style="width:100%">
                <thead class="tabela">
                  <tr>
                    <th>Nome</th>
                    <th style="text-align: end">Ações</th>
                  </tr>
                </thead>
                <tbody class="tabela">
                  @foreach($direcionamentos as $direcionamento)
                    <tr>
                        <td>{{$direcionamento->nome}}</td>
                        <td style="text-align: end">
                          <a href="{{ route('direcionamentos.edit', $direcionamento->id)}}" class="btn btn-warning btn-xs" title="Editar configuração.">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                            </svg>
                          </a>
                        </td>
                    </tr>
                  @endforeach
                </tbody>
                <tfoot class="tabela">
                  <tr>
                    <th><input class="filter-input" data-column="0" type="text" placeholder="Filtro por Nome"></th>
                    <th><input class="filter-input" data-column="1" type="text" placeholder="Filtro por Ações"></th>
                  </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script>
        $(document).ready( function () {
            var table = $('#tb_direcionamentos').DataTable({
                    "language" : {
                        "url" : "{{ asset('js/portugues.json') }}"
                    },
                    "columnDefs": [
                    { "width": "88%", "targets": 0 },
                    { "width": "12%", "targets": 1 },
                    ],
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