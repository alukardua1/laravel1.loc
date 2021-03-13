<?php

namespace App\Providers;

use Blade;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Route;

class BladeServiceProvider extends ServiceProvider
{
	/**
	 * Register services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

	/**
	 * Bootstrap services.
	 *
	 * @return void
	 */
	public function boot()
	{
		Blade::directive(
			'declination',
			function ($string) {
				[$string, $text] = explode(', ', $string);
				return "<?php echo Lang::choice($text, $string, [], 'ru'); ?>";
			}
		);
		Blade::if(
			'group',
			function ($string) {
				return Auth::user()->group_id == $string;
			}
		);
		Blade::if(
			'not_group',
			function ($string) {
				return Auth::user()->group_id <> $string;
			}
		);
		Blade::if(
			'admin_link',
			function () {
				return Auth::user()->getGroup->is_dashboard == 1;
			}
		);
		Blade::if(
			'available',
			function ($expression) {
				$routeName = explode('|', $expression);

				return in_array(Route::currentRouteName(), $routeName, true);
			}
		);
		Blade::if(
			'not_available',
			function ($expression) {
				$routeName = explode('|', $expression);

				return !in_array(Route::currentRouteName(), $routeName, true);
			}
		);
	}
}
