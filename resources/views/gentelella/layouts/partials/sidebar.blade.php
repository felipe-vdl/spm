<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
	<div class="menu_section">
		<ul class="nav side-menu">
			<li>
				<a href="{{ route('home')}}" title="Contadores"><i class="fas fa-home"></i> Principal </a>
			</li>
			
			<li>
				<a><i class="fas fa-solid fa-folder-open"></i> Requerimentos<span class="fa fa-chevron-down"></span></a>
				<ul class="nav child_menu">
					<li>
						<a href="{{ url('/requerimentos')}}" title="Requerimentos Ativos"><i class="fas fa-file-contract"></i>Em Análise</a>
					</li>
					<li>
						<a href="{{ url('/diario')}}" title="Requerimentos Ativos"><i class="fas fa-address-book"></i>Agenda Diária</a>
					</li>
					<li>
						<a href="{{ url('/arquivo')}}" title="Requerimentos Arquivados"><i class="fas fa-solid fa-folder"></i>Arquivados</a>
					</li>
					<li>
						<a href="{{url("/relatorio")}}" title="Relatórios"><i class="fas fa-solid fa-file-pdf"></i>Relatório</a>
					</li>
				</ul>
			</li>
			@if (Auth::user()->nivel == "Super-Admin")
				<li>
					<a><i class="fas fa-cogs"></i> Administração<span class="fa fa-chevron-down"></span></a>
					<ul class="nav child_menu">
						<li><a href="{{route("direcionamentos.index")}}"><i class="fas fa-solid fa-location-arrow"></i> Direcionamentos </a></li>
						<li><a href="{{url("requerimento_pericias/reagendar")}}"><i class="fas fa-file-import"></i> Reagendamento </a></li>
						<li><a href="{{url("/user")}}"><i class="fas fa-user-shield"></i> Funcionários </a></li>
					</ul>
				</li>
			@endif
			<br>
			<li>
				<a href="{{ route('logout')}}" title="Sair"><i class="fa fa-sign-out"></i> Sair do sistema </a>
			</li>
		</ul>	
	</div>
</div>



