<nav id="sidebarMenu" class="col-lg-2 d-md-block bg-dark sidebar collapse">
	<div class="position-sticky pt-3">
		<ul class="nav flex-column">
			<li class="nav-item">
				<a type="button" class="nav-link" href="{{route('dashboard')}}">
					<span data-feather="home"></span>
					Главная
				</a>
			</li>
			<li class="nav-item">
				<div class="accordion" id="accordionExample">
					<div class="accordion-item-nav">
						<h2 class="accordion-header" id="headingOne">
							<a class="accordion-button accordion-button-link collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false"
							   aria-controls="collapseOne">
								Редактирование
							</a>
						</h2>
						<div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
							<div class="accordion-body-nav">
								<ul class="list-group list-group-flush">
									<li class="list-group-item">
										<a class="nav-link" href="{{route('indexAnimeAdmin')}}">
											Аниме
										</a>
									</li>
									<li class="list-group-item">
										<a class="nav-link" href="{{route('indexCategoryAdmin')}}">
											Категории
										</a>
									</li>
									<li class="list-group-item">
										<a class="nav-link" href="{{route('indexPeopleAdmin')}}">
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
											Студии
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
						</div>
					</div>
					<div class="accordion-item-nav">
						<h2 class="accordion-header" id="headingTwo">
							<a class="accordion-button accordion-button-link collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false"
							   aria-controls="collapseTwo">
								Пользователи
							</a>
						</h2>
						<div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
							<div class="accordion-body-nav">
								<ul class="list-group list-group-flush">
									<li class="list-group-item">
										<a class="nav-link" href="{{route('indexUserAdmin')}}">
											<span data-feather="user"></span>
											Все пользователи
										</a>
									</li>
									<li class="list-group-item">
										<a class="nav-link" href="{{route('indexGroupAdmin')}}">
											<span data-feather="users"></span>
											Группы
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="accordion-item-nav">
						<h2 class="accordion-header" id="headingThree">
							<a class="accordion-button accordion-button-link collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false"
							   aria-controls="collapseThree">
								Другие модули
							</a>
						</h2>
						<div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
							<div class="accordion-body-nav">
								<ul class="list-group list-group-flush bg-dark">
									<li class="list-group-item">
										<a class="nav-link" href="{{route('kodikBaseList', 'movie')}}">
											<span data-feather="other_module"></span>
											Kodik
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
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