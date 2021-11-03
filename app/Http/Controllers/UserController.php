<?php

namespace App\Http\Controllers;

use App;
use App\Http\Requests\UserRequest;
use App\Repository\Interfaces\UserRepositoryInterfaces;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
	private UserRepositoryInterfaces $repository;
	private int                      $limitRss;
	private int                      $timeCacheRss;

	/**
	 * @param  \App\Repository\Interfaces\UserRepositoryInterfaces  $userRepositoryInterfaces
	 */
	public function __construct(UserRepositoryInterfaces $userRepositoryInterfaces)
	{
		parent::__construct();
		$this->repository = $userRepositoryInterfaces;
		$this->limitRss = config('secondConfig.limitRss');
		$this->timeCacheRss = config('secondConfig.cache_time');
	}

	/**
	 * @param  string  $login
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function show(string $login): View|Factory|Application
	{
		$currentUser = $this->repository->getUser($login);
		$currentUser->created = $currentUser->created_at;
		$currentUser->last_logins = $currentUser->last_login;
		$currentUser->birthdayShow = Carbon::parse($currentUser->birthday)->format('d.m.Y');

		return view($this->frontend . 'user.profile', compact('currentUser'));
	}

	/**
	 * @param  string  $login
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
	 */
	public function showComment(string $login): Factory|View|Application
	{
		$currentUser = $this->repository->getUser($login);
		$this->isNotNull($currentUser);
		$title = "Комментарии пользователя $currentUser->login";
		$description = '';

		$allComments = $currentUser->getComments()->paginate($this->paginate);

		return view($this->frontend . 'user.all_user_comments', compact('currentUser', 'allComments', 'title', 'description'));
	}

	/**
	 * @param  string  $login
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function edit(string $login): View|Factory|Application
	{
		$currentUser = $this->repository->getUser($login);

		return view($this->frontend . 'user.edit', compact('currentUser'));
	}

	/**
	 * @param  string       $login
	 * @param  UserRequest  $request
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update(string $login, UserRequest $request): RedirectResponse
	{
		unset($request['login'], $request['email']);
		$requestUser = $this->repository->setUsers($request, $login);

		if ($requestUser) {
			return redirect()->route('showUser', $login);
		}

		return back()->withErrors(['msg' => 'Ошибка сохранения'])->withInput();
	}

	/**
	 * @param  string  $login
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function showAnime(string $login): View|Factory|Application
	{
		$show = $this->repository->getUser($login);
		$this->isNotNull($show);
		$views['title'] = "Аниме добавленое пользователем $show->login";
		$views['description'] = '';
		$views['content'] = $show->getAnime()->paginate($this->paginate);

		return view($this->frontend . 'anime.short', compact('views'));
	}

	/**
	 * @param  string  $login
	 *
	 * @return mixed
	 */
	public function userRss(string $login): mixed
	{
		$feed = App::make("feed");
		$feed->setCache($this->timeCacheRss, 'laravelFeedKey');
		if (!$feed->isCached()) {
			$currentUser = $this->repository->getUser($login);
			$posts = $currentUser->getAnime()->limit($this->limitRss)->get();

			$feed = $this->getRss($feed, $posts, $currentUser->login);
		}

		return $feed->render('rss');
	}
}
