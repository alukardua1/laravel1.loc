<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

abstract class ComposersAbstract
{
	abstract protected function view(): mixed;

	abstract public function compose(View $view);
}