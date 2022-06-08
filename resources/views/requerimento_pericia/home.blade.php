@extends('gentelella.layouts.app')


@section('content')
@if(session()->get('successo'))
	<div class="alert alert-success m-0">
		{{ session()->get('successo') }}
	</div>
@endif
<div class="container-fluid">
	<div class="row title-count text-center" style="display: flex; justify-content: center;">
		<div class="col-md-3 col-sm-3 col-xs-6 tile_stats_count" style="padding: 0.5rem; border: 1px solid rgba(70, 60, 70, 0.5);">
			<span class="count_top"></i> Total de Requerimentos </span> 
			<div class="count" style="text-align: center; font-size: 30px !important;">{{$total}} </div> 
			<span class="count_bottom"><i><i></i></i> </span>
		</div>
	</div>
	<div class="row title-count text-center" style="margin-top: 2.5rem; margin-bottom: 2.5rem; display: flex; justify-content: center;">
		<div class="col-md-3 col-sm-3 col-xs-6 tile_stats_count" style="padding: 0.5rem; border: 1px solid rgba(70, 60, 70, 0.5);">
			<span class="count_top"></i> Total de Requerimentos Ativos </span> 
			<div class="count" style="text-align: center; font-size: 30px !important;">{{$totalreq}} </div> 
			<span class="count_bottom"><i><i></i></i> </span>
		</div>
		<div class="col-md-3 col-sm-3 col-xs-6 tile_stats_count" style="padding: 0.5rem; border: 1px solid rgba(70, 60, 70, 0.5); border-left: none;">
			<span class="count_top"></i> Em Análise </span> 
			<div class="count" style="text-align: center; font-size: 30px !important;">{{$analise}} </div> 
			<span class="count_bottom"><i><i></i></i> </span>
		</div>
		<div class="col-md-3 col-sm-3 col-xs-6 tile_stats_count" style="padding: 0.5rem; border: 1px solid rgba(70, 60, 70, 0.5); border-left: none;">
			<span class="count_top"></i> Aguardando Confirmação </span> 
			<div class="count" style="text-align: center; font-size: 30px !important;">{{$confirmacao}} </div> 
			<span class="count_bottom"><i><i></i></i> </span>
		</div>
	</div>
	<div class="row title-count text-center" style="margin-top: 2.5rem; display: flex; justify-content: center;">
		<div class="col-md-3 col-sm-3 col-xs-6 tile_stats_count" style="padding: 0.5rem; border: 1px solid rgba(70, 60, 70, 0.5);">
			<span class="count_top"></i> Total de Requerimentos Arquivados </span> 
			<div class="count" style="text-align: center; font-size: 30px !important;">{{$totalarq}} </div> 
			<span class="count_bottom"><i><i></i></i> </span>
		</div>
		<div class="col-md-3 col-sm-3 col-xs-6 tile_stats_count" style="padding: 0.5rem; border: 1px solid rgba(70, 60, 70, 0.5); border-left: none;">
			<span class="count_top"></i> Confirmados </span> 
			<div class="count" style="text-align: center; font-size: 30px !important;">{{$finalizados}} </div> 
			<span class="count_bottom"><i><i></i></i> </span>
		</div>
		<div class="col-md-3 col-sm-3 col-xs-6 tile_stats_count" style="padding: 0.5rem; border: 1px solid rgba(70, 60, 70, 0.5); border-left: none;">
			<span class="count_top"></i> Recusados </span> 
			<div class="count" style="text-align: center; font-size: 30px !important;">{{$recusados}} </div> 
			<span class="count_bottom"><i><i></i></i> </span>
		</div>
	</div>
</div>
@endsection

@push('scripts')

	<script type="text/javascript">


	</script>
@endpush