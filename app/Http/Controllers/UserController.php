<?php

namespace App\Http\Controllers;

use App;
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
	private UserRepositoryInterfaces $userRepository;
	private int                      $limitRss;
	private int                      $timeCacheRss;

	/**
	 * UserController constructor.
	 *
	 * @param  UserRepositoryInterfaces  $userRepositoryInterfaces
	 */
	public function __construct(UserRepositoryInterfaces $userRepositoryInterfaces)
	{
		parent::__construct();
		$this->userRepository = $userRepositoryInterfaces;
		$this->limitRss = config('secondConfig.limitRss');
		$this->timeCacheRss = config('secondConfig.cache_time');
	}

	/**
	 * @param  string  $login
	 *
	 * @return mixed
	 */
	public function show(string $login)
	{
		$currentUser = $this->userRepository->getUser($login);
		$currentUser->created = $currentUser->created_at;
		$currentUser->last_logins = $currentUser->last_login;

		return view($this->frontend . 'user.profile', compact('currentUser'));
	}

	/**
	 * @param  string  $login
	 *
	 * @return mixed
	 */
	public function showComment(string $login)
	{
		$currentUser = $this->userRepository->getUser($login);
		$this->isNotNull($currentUser);
		$title = "Комментарии пользователя {$currentUser->login}";
		$description = '';

		$allComments = $currentUser->getComments()->paginate($this->paginate);

		return view($this->frontend . 'user.all_user_comments', compact('currentUser', 'allComments', 'title', 'description'));
	}

	/**
	 * @param  string  $login
	 *
	 * @return mixed
	 */
	public function edit(string $login)
	{
		$currentUser = $this->userRepository->getUser($login);

		return view($this->frontend . 'user.edit', compact('currentUser'));
	}

	/**
	 * @param  string                          $login
	 * @param  UserRequest  $request
	 *
	 * @return mixed
	 */
	public function update(string $login, UserRequest $request)
	{
		unset($request['login'], $request['email']);
		$requestUser = $this->userRepository->setUsers($request, $login);

		if ($requestUser) {
			return redirect()->route('currentUser', $login);
		}

		return back()->withErrors(['msg' => 'Ошибка сохранения'])->withInput();
	}

	/**
	 * @param  string  $login
	 *
	 * @return mixed
	 */
	public function showAnime(string $login)
	{
		$currentUser = $this->userRepository->getUser($login);
		$this->isNotNull($currentUser);
		$title = "Аниме добавленое пользователем {$currentUser->login}";
		$description = '';
		$allAnime = $currentUser->getAnime()->paginate($this->paginate);

		return view($this->frontend . 'anime.short', compact('currentUser', 'allAnime', 'title', 'description'));
	}

	/**
	 * @param  string  $login
	 *
	 * @return mixed
	 */
	public function userRss(string $login)
	{
		$feed = App::make("feed");
		$feed->setCache($this->timeCacheRss, 'laravelFeedKey');
		if (!$feed->isCached()) {
			$currentUser = $this->userRepository->getUser($login);
			$posts = $currentUser->getAnime()->limit($this->limitRss)->get();

			$feed = $this->getRss($feed, $posts, $currentUser->login);
		}

		return $feed->render('rss');
	}
}
