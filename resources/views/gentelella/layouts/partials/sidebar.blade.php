<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
	<div class="menu_section">
		<ul class="nav side-menu">
			<li>
				<a href="{{ route('home')}}" title="Contadores"><i class="fas fa-home"></i> Principal </a>
			</li>

			<li>
				<a href="{{ url('/requerimentos')}}" title="Requerimentos Ativos"><i class="fas fa-file-contract"></i>Requerimentos</a>
			</li>

			<li>
				<a href="{{ url('/arquivo')}}" title="Requerimentos Arquivados"><i class="fas fa-solid fa-folder-open"></i>Arquivo</a>
			</li>
			
			<li>
				<a href="{{url("/relatorio")}}" title="Relatórios"><i class="fas fa-solid fa-file-pdf"></i>Relatório</a>
			</li>

			@if (Auth::user()->nivel == "Super-Admin")
				<br>
				<li>
					<a href="{{url("/user")}}"><i class="fas fa-user-shield"></i> Funcionários </a>
				</li>
			@endif
			
			{{-- <li>
				<a><i class="fas fa-user-shield"></i> Guardas <span class="fa fa-chevron-down"></span></a>
				<ul class="nav child_menu">
					<li><a href="{{ url("/guarda") }}">					<i class="fa fa-list">	</i> Relação </a></li>
				</ul>
			</li> --}}

			{{-- <li>
				<a><i class="fas fa-file-alt"></i> Documentos <span class="fa fa-chevron-down"></span></a>
				<ul class="nav child_menu">
					<li><a href="{{ url('/requerimento')}}"><i class="fas fa-file-contract"></i> Requerimentos </a></li>
					<li><a href="{{ url('/trocaservico')}}"><i class="fas fa-exchange-alt"></i> Troca de Serviço </a></li>
					
				</ul>
			</li> --}}

			{{-- <li>
				<a><i class="fas fa-calendar-alt"></i> Escalas <span class="fa fa-chevron-down"></span></a>
				<ul class="nav child_menu">
					<li><a href="{{ url("/escala") }}">	<i class="fa fa-list">	</i> Escala diária </a> </li>
					<li><a href="{{ url("/escalapass") }}">	<i class="fa fa-list">	</i> Escala passada </a> </li>
					<li><a href="{{ url("/escalaescprint") }}">	<i class="fa fa-print">	</i> Impressão de Escala </a> </li>
				</ul>
			</li>	 --}}

			{{-- <li><a><i class="fas fa-cogs"></i> Configurações <span class="fa fa-chevron-down"></span></a>
				<ul class="nav child_menu">
						<li><a href="{{ url("/cargo") }}">	<i class="fa fa-list">	</i> Cargos </a> </li>
						<li>
							<a><i class="fas fa-calendar-alt"></i> Escalas <span class="fa fa-chevron-down"></span></a>
							<ul class="nav child_menu">
								<li><a href="{{ url("/tipo_escala") }}">	<i class="fa fa-list">	</i> Tipos</a>
								<li><a href="{{ url("/setor_escala") }}"><i class="fa fa-list">	</i> Setores</a>
							</ul>
						</li>
				</ul>
			</li>	 --}}

			<li>
				<a href="{{ route('logout')}}" title="Sair"><i class="fa fa-sign-out"></i> Sair do sistema </a>
			</li>
		</ul>	
	</div>
</div>



