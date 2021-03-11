<?php

namespace App\Providers;

use Blade;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

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
			'test',
			function ($string) {
				return "<?php echo $string; ?>";
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
	}
}
