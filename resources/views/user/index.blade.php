@extends('gentelella.layouts.app')

@section('content')
    <div class="x_panel modal-content ">
		<div class="x_title">
			<h2><i class="fas fa-user-shield"></i> Funcionários</h2>
			<ul class="nav navbar-right panel_toolbox">
			    <a href="{{url('user/create')}}" class="btn-circulo btn  btn-success btn-md  pull-right " data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Novo Usuario"> Novo Funcionário </a>
			</ul>
			<div class="clearfix"></div>
		</div>
        <div class="x_panel ">
			<div class="x_content">
				<table id="tb_user" class="table table-hover table-striped compact" style="width:100%">
					<thead>
						<tr>
							<th>Nome Completo</th>
							<th>Email</th>
							<th>Permissão</th>
							<th>Ações</th>
						</tr>
					</thead>
					<tbody>
                        @foreach ($usuarios as $usuario)
                            <tr>
							    <td>{{$usuario->name}}</td>
							    <td>{{$usuario->email}}</td>
								<td>{{$usuario->nivel}}</td>
                                <td class="actions">
                                    {{-- <a
										class="btn btn-success btn-xs action botao_acao btn_enviar" 
										data-requerimento = {{$requerimento->id}}
										data-toggle="tooltip" 
										data-placement="bottom" 
										title="Evniar Requerimento">  
										<i class="glyphicon glyphicon-ok "></i>
									</a> --}}
									<a
										href="{{url("user/$usuario->id/edit")}}"
										{{-- href="#" --}}
										class="btn btn-warning btn-xs action botao_acao btn_editar" 
										data-toggle="tooltip" 
										data-placement="bottom" 
										title="Editar Usuario">  
										<i class="glyphicon glyphicon-pencil "></i>
									</a>
									{{-- <a
										id="btn_exclui_guarda"
										class="btn btn-danger btn-xs  action botao_acao btn_excluir"  
										data-toggle="tooltip" 
										data-requerimento = {{$requerimento->id}}
										data-placement="bottom" 
										title="Excluir Requerimento"> 
										<i class="glyphicon glyphicon-remove "></i>
									</a>  --}}
                                </td>
							</tr>
                        @endforeach	
					</tbody>
				</table>
			</div>
		</div>
    </div>
@endsection

@push('scripts')
	{{-- <script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.20/sorting/date-uk.js"></script> --}}
	<script type="text/javascript" src="{{ asset('js/date-uk.js') }}"></script>
	{{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> --}}
	<script src="{{ asset('js/sweetalert.min.js') }}"></script>

    <script>
        $(document).ready(function(){
            var tb_user = $("#tb_user").DataTable({
                language: {
                    'url' : '{{ asset('js/portugues.json') }}',
					"decimal": ",",
					"thousands": "."
                },
                stateSave: true,
                stateDuration: -1,
                responsive: true,
				order: [[ 2, 'desc' ], [0, 'asc']]
            })
        });
    </script>
@endpush