<!DOCTYPE html>
<html lang="pt-br">
	@section('htmlheader_title', 'Login')
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<!-- Meta, title, CSS, favicons, etc. -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
	
		<title>Perícia Médica</title>
	
		<!--     Fonts and icons     -->
		<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons" rel="stylesheet">
		
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
		
		
		{{-- datatables --}}
			<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/zf/dt-1.10.18/r-2.2.2/datatables.min.css"/>
	
			{{-- bootstrap-datetimepicker --}}
			{{-- <link rel="stylesheet" href="{{ asset('/bootstrap-datetimepicker/bootstrap-datetimepicker.css') }}">       --}}
		
			{{-- jquery-timepicker --}}
			<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/timepicker@1.11.14/jquery.timepicker.min.css">
			<link rel="stylesheet" href="{{ asset('css/app2.css') }}">
			<link rel="stylesheet" href="{{ asset('css/inputstyle.css') }}">
			{{-- <link rel="stylesheet" href="{{ asset('css/app4.1.css') }}"> --}}
			<link rel="stylesheet" href="{{ asset('css/footer.css') }}">
			<style>
				@media only screen and (min-width: 768px) {
					#manual {
						width: 185px;
						position: absolute;
						margin-left: auto;
						margin-right: auto;
						left: 0;
						right: 0;
						text-align: center;
					}
				}

				@media only screen and (max-width: 768px) {
					#logonav {
						margin-bottom: 0.5rem;
					}
					#manual {
						text-align: center;
					}
				}

				body {
					min-height: 100vh;
					display: flex;
					flex-direction: column;
				}
			</style>
	</head>

	<body class="login">
		
		<div id="app" style="background-color: white; "> 
			<a class="hiddenanchor" id="signup"></a>
			<a class="hiddenanchor" id="signin"></a>
			<div class="cor_fundo_roxo" style="width:100%; height:150px; text-align: center;">
				<img class="logo_topo" src="{{ asset("assets/logo.png") }}">
			</div>

			{{-- <div class="login_wrapper"> --}}
			<div class="logindiv">
				{{--  login  --}}
				<div class="animate form login_form">
					<section class="login_content">
						<form method="POST" action="{{ route('login') }}">
							{{ csrf_field() }}
							
							<h1 class="cor_texto_roxo">Perícia Médica - SEMAD</h1>
							
							<div class="form-group row">
								<label class="control-label col-md-2 col-sm-2 col-xs-12" for="email">Email:</label>
								<div class="col-md-10 col-sm-10 col-xs-12">
									<input type="email" name="email" id="email_fake" autocomplete="off" style="display: none;" />
  								
									<input id="email" type="email" placeholder="Email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required >
									@if ($errors->has('email'))
										<span class="invalid-feedback">
											<strong>{{ $errors->first('email') }}</strong>
										</span>
									@endif	
								</div>
							</div>
							
							<div class="form-group row">
								<label class="control-label col-md-2 col-sm-2 col-xs-12" for="password">Senha:</label>
								<div class="col-md-10 col-sm-10 col-xs-12">
										<input id="password" type="password" placeholder="Password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required autocomplete="off">
								
										@if ($errors->has('password'))
										<span class="invalid-feedback">
											<strong>{{ $errors->first('password') }}</strong>
										</span>
										@endif
								</div>
							</div>

							
							<div>
								<button type="submit" class="btn btn-default submit">
									Login
								</button>               
								
								
							</div>
							
							<div class="clearfix"></div>
							
							
						</form>
					</section>
				</div>
		
			</div>
		</div>
		<footer class="footer back-roxo">
			<div class="container-fluid">
			  <nav>
				  <a style="padding-left: 30px">
					<b> ©
					  <script>
						document.write(new Date().getFullYear())
					  </script>, EQUIPE DE DESENVOLVIMENTO DE SISTEMAS
						  
					</b>
				  </a>
				
			   
				  <a style="padding-left: 30px">
					<b><i class="fab fa-free-code-camp"></i> SUBSECRETARIA DA TECNOLOGIA DA INFORMAÇÃO - PREFEITURA MUNICIPAL DE MESQUITA - RJ</b>
				  </a>
		   
				
				  <a style="padding-left: 30px">
					<b>RUA ARTHUR OLIVEIRA VECCHI, 120 - CENTRO - MESQUITA - RJ - CEP: 26553-080</b>
				  </a>
				  
				  <a class="text-white" style="text-decoration: none; padding-left: 30px" href="https://lgpd.mesquita.rj.gov.br/?page_id=43" target="_blank">
					<b>POLÍTICA DE PRIVACIDADE</b>
				  </a>
			  </nav>
			</div>
		</footer>

		<script src="{{ url(mix('/js/app.js'))}}"></script>
		<script src="{{ asset('/js/components.js')}}"></script>

		{{-- <script src="{{ asset('js/sweetalert2.js') }}"></script> --}}

		{{-- Vanilla Masker --}}
		<script src="{{ asset('js/vanillaMasker.min.js') }}"></script>


		<script>

			$("#modulo").focus();
			$().ready(function() {
				//mensagens de sucesso
			
				@if (session('erro'))
					funcoes.notificationRight("top", "right", "danger", "{{ session('erro') }}"); 
				@endif
			
							
			});
			
		</script>


		
		

	</body>
</html>


