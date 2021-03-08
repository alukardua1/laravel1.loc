<?php


namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Config;

class LoginAdminController extends Controller
{
	use AuthenticatesUsers;
	protected $redirectTo = RouteServiceProvider::HOME;

	public function __construct()
	{
		$this->middleware('guest')->except('logout');
	}

	protected function redirectTo(): string
	{
		return url()->previous();
	}

	public function username()
	{
		return Config::get('secondConfig.login_email');
	}

	protected function credentials(Request $request): array
	{
		return $request->only($this->username(), 'password');
	}

	public function showLoginForm()
	{
		return view('web.backend.auth.login');
	}
}