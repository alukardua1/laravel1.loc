<?php


namespace App\Repository\Interfaces;


interface NewsRepositoryInterfaces
{
	public function getNewsAll();

	public function getNews(int $id);

	public function setNews(\Request $request, int $id = null);

	public function delNews(int $id);
}