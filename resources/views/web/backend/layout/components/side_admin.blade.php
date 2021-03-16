<nav id="sidebarMenu" class="col-lg-2 d-md-block bg-dark sidebar collapse">
	<div class="position-sticky pt-3">
		<ul class="nav flex-column">
			<li class="nav-item">
				<a class="nav-link" href="{{route('dashboard')}}">
					<span data-feather="home"></span>
					Главная
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">
					<span data-feather="settings"></span>
					Настройки
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" data-toggle="collapse" href="#edit" role="button" aria-expanded="false" aria-controls="edit">
					<span data-feather="edit"></span>
					Редактирование
				</a>
				<div class="collapse" id="edit">
					<ul class="list-group list-group-flush bg-dark">
						<li class="list-group-item">
							<a class="nav-link" href="{{route('showAllAnimeAdmin')}}">
								Аниме
							</a>
						</li>
						<li class="list-group-item">
							<a class="nav-link" href="{{route('showAllCategoryAdmin')}}">
								Категории
							</a>
						</li>
						<li class="list-group-item">
							<a class="nav-link" href="#">
								Люди
							</a>
						</li>
						<li class="list-group-item">
							<a class="nav-link" href="#">
								Персонажи
							</a>
						</li>
						<li class="list-group-item">
							<a class="nav-link" href="#">
								Страны
							</a>
						</li>
						<li class="list-group-item">
							<a class="nav-link" href="#">
								MPAA рейтинг
							</a>
						</li>
						<li class="list-group-item">
							<a class="nav-link" href="#">
								Тип
							</a>
						</li>
						<li class="list-group-item">
							<a class="nav-link" href="#">
								Каналы
							</a>
						</li>
						<li class="list-group-item">
							<a class="nav-link" href="#">
								Франшиза
							</a>
						</li>
						<li class="list-group-item">
							<a class="nav-link" href="#">
								Хронология
							</a>
						</li>
					</ul>
				</div>
			</li>
			<li class="nav-item">
				<a class="nav-link" data-toggle="collapse" href="#user" role="button" aria-expanded="false" aria-controls="user">
					<span data-feather="user"></span>
					Пользователи
				</a>
				<div class="collapse" id="user">
					<ul class="list-group list-group-flush bg-dark">
						<li class="list-group-item">
							<a class="nav-link" href="#">
								<span data-feather="user"></span>
								Все пользователи
							</a>
						</li>
						<li class="list-group-item">
							<a class="nav-link" href="#">
								<span data-feather="users"></span>
								Группы
							</a>
						</li>
					</ul>
				</div>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">
					Отчеты
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">
					Integrations
				</a>
			</li>
		</ul>

		<h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
			<span>Saved reports</span>
			<a class="link-secondary" href="#" aria-label="Add a new report">
				<span data-feather="plus-circle"></span>
			</a>
		</h6>
		<ul class="nav flex-column mb-2">
			<li class="nav-item">
				<a class="nav-link" href="#">
					<span data-feather="file-text"></span>
					Current month
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">
					<span data-feather="file-text"></span>
					Last quarter
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">
					<span data-feather="file-text"></span>
					Social engagement
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">
					<span data-feather="file-text"></span>
					Year-end sale
				</a>
			</li>
		</ul>
	</div>
</nav>