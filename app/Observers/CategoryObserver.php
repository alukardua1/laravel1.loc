<?php

namespace App\Observers;

use App\Models\Category;
use Str;

class CategoryObserver
{
	/**
	 * @param  \App\Models\Category  $category
	 */
	public function creating(Category $category)
	{
		$this->saving($category);
	}

	/**
	 * @param  \App\Models\Category  $category
	 */
	public function saving(Category $category)
	{
		if ($category->english) {
			$category->url = Str::slug($category->english);
		} else {
			$category->url = Str::slug($category->title);
		}
	}
}
