<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Repository\Interfaces\UserRepositoryInterfaces;
use Illuminate\Http\Request;

/**
 * Class UserController
 *
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
	private UserRepositoryInterfaces $user;

	/**
	 * UserController constructor.
	 *
	 * @param  \App\Repository\Interfaces\UserRepositoryInterfaces  $userRepositoryInterfaces
	 */
	public function __construct(UserRepositoryInterfaces $userRepositoryInterfaces)
	{
		parent::__construct();
		$this->user = $userRepositoryInterfaces;
	}

	/**
	 *
	 */
	public function index()
	{
		$users = $this->user->getUsers();

		dd(__METHOD__, $users);
	}

	private function users()
	{

	}

	/**
	 * @param $user
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function show($user)
	{
		$currentUser = $this->user->getUser($user);
		$currentUser->created = $currentUser->created_at;
		$currentUser->last_logins = $currentUser->last_login;

		return view($this->frontend . 'user.profile', compact('currentUser'));
	}

	public function showComment($user)
	{
		$currentUser = $this->user->getUser($user);
		$this->isNotNull($currentUser);
		$title = "Комментарии пользователя {$currentUser->login}";
		$description = '';

		$allComments = $currentUser->getComments()->paginate($this->paginate);

		return view($this->frontend . 'user.all_user_comments', compact('currentUser', 'allComments', 'title', 'description'));
	}

	/**
	 * @param $user
	 *
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
	 */
	public function edit($user)
	{
		$currentUser = $this->user->getUser($user);

		return view('web.frontend.user.edit', compact('currentUser'));
	}

	/**
	 * @param                                  $user
	 * @param  \App\Http\Requests\UserRequest  $request
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update($user, UserRequest $request)
	{
		$requestUser = $this->user->setUsers($request, $user);

		if ($requestUser) {
			return redirect()->route('currentUser', $user);
		}

		return back()->withErrors(['msg' => 'Ошибка сохранения'])->withInput();
	}

	public function showAnime($user)
	{
		$currentUser = $this->user->getUser($user);
		$this->isNotNull($currentUser);
		$title = "Аниме добавленое пользователем {$currentUser->login}";
		$description = '';
		$allAnime = $currentUser->getAnime()->paginate($this->paginate);

		return view($this->frontend . 'anime.short', compact('currentUser', 'allAnime', 'title', 'description'));
	}

	public function userRss($user)
	{
		$feed = \App::make("feed");
		$feed->setCache(config('secondConfig.cache_time'), 'laravelFeedKey');
		if (!$feed->isCached()) {
			$currentUser = $this->user->getUser($user);
			$posts = $currentUser->getAnime()->limit(config('secondConfig.limitRss'))->get();

			$feed = $this->getRss($feed, $posts, $currentUser->login);
		}

		return $feed->render('rss');
	}
}
