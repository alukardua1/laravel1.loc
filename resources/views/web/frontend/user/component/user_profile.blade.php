<section class="text-center text-lg-left">
	<div class="row d-flex justify-content-center">
		<div class="col-md-12">
			<div class="row">
				<div class="col-lg-3 mb-2">
					<div class="row">
						<div class="col-12">
							<div class="avatar mx-4 w-100 white justify-content-center">
								<img src="{foto}" class="rounded-circle z-depth-1" alt="{usertitle}">
							</div>
						</div>
						<div class="col-12 send">
							<div class="btn-group-vertical" role="group" aria-label="Vertical button group">
								{email}
								[not-group=5]
								{pm}
								[/not-group]
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-9 d-flex flex-column justify-content-between">
					<ul class="list-group list-group-flush mb-4 dark-grey-text text-wrap">
						<li class="list-group-item clearfix">
							<span class="float-left mb-0 mt-0"><i class="far fa-user"></i> Полное имя </span>
							<span class="float-right">{fullname}[not-fullname]Неизвестно[/not-fullname]</span>
						</li>
						<li class="list-group-item clearfix">
							<span class="float-left mb-0 mt-0"><i class="far fa-calendar-alt"></i> Зарегистрировался </span>
							<span class="float-right">{registration}</span>
						</li>
						<li class="list-group-item clearfix">
							<span class="float-left mb-0 mt-0"><i class="far fa-calendar-alt"></i> Был(а) в сети </span>
							<span class="float-right">{lastdate}</span>
						</li>
						<li class="list-group-item clearfix">
							<span class="float-left mb-0 mt-0"><i class="fas fa-users"></i> Группа </span>
							<span class="float-right">{status}</span>
						</li>
						<li class="list-group-item clearfix">
							<span class="float-left mb-0 mt-0"><i class="far fa-address-card"></i> О себе </span>
							<blockquote class="blockquote">
								<p class="float-right">{info}</p>
							</blockquote>
						</li>
						[signature]
						<li class="list-group-item clearfix">
							<span class="float-left mb-0 mt-0"><i class="fas fa-signature"></i> Подпись</span>
							<blockquote class="blockquote">
								<p class="float-right">{signature}</p>
							</blockquote>
						</li>
						[/signature]
					</ul>
				</div>
			</div>
		</div>
	</div>
</section>