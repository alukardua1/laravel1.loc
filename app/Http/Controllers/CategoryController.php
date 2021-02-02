<?php

namespace App\Http\Controllers;

use App\Repository\Interfaces\CategoryRepositoryInterfaces;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
	private $categories;

    public function __construct(CategoryRepositoryInterfaces $categoryRepository)
    {
    	$this->categories = $categoryRepository;
    }

    public function index()
    {
    	$categoryAll = $this->categories->getCategories()->get();

    	dd(__METHOD__, $categoryAll);
    }

    public function show($category)
    {
    	$currentCategory = $this->categories->getCategory($category)->get();

    	dd(__METHOD__, $currentCategory);
    }
}
