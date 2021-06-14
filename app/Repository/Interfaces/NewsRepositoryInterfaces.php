<?php


namespace App\Repository\Interfaces;


interface NewsRepositoryInterfaces
{
	public function getNewsAll($limit = null);

	public function getNews(int $id);

	public function setNews(\Request $request, int $id = null);

	public function delNews(int $id);
}