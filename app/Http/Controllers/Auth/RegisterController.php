<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUserRequest;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Repository\Interfaces\UserRepositoryInterfaces;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
	/*
	|--------------------------------------------------------------------------
	| Register Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users as well as their
	| validation and creation. By default this controller uses a trait to
	| provide this functionality without requiring any additional code.
	|
	*/

	use RegistersUsers;

	protected $userRepository;

	/**
	 * Where to redirect users after registration.
	 *
	 * @var string
	 */
	protected string $redirectTo = RouteServiceProvider::HOME;

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct(UserRepositoryInterfaces $userRepositoryInterfaces)
	{
		$this->userRepository = $userRepositoryInterfaces;
		$this->middleware('guest');
	}

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 *
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	protected function validator(array $data): \Illuminate\Contracts\Validation\Validator
	{
		return Validator::make(
			$data,
			[
				'name'     => ['required', 'string', 'max:255'],
				'login'    => ['required', 'string', 'max:255', 'unique:users'],
				'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
				'password' => ['required', 'string', 'min:8', 'confirmed'],
			]
		);
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 *
	 * @return \App\Models\User
	 */
	protected function create(array $data): User
	{
		return User::create(
			[
				'name'     => $data['name'],
				'login'    => $data['login'],
				'email'    => $data['email'],
				'password' => Hash::make($data['password']),
			]
		);
	}

	public function register(RegisterUserRequest $request)
	{
		$update = $this->userRepository->setUsers($request);
		if ($update) {
			return redirect()->route('home');
		}
	}

	/**
	 * Показывает форму регистрации
	 */
	public function showRegistrationForm()
	{
		return view('web.frontend.auth.register');
	}
}
