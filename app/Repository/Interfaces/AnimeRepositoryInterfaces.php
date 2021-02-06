<?php


namespace App\Repository\Interfaces;


interface AnimeRepositoryInterfaces
{
	public function getAnime($id);

	public function getAllAnime();

	public function getFirstPageAnime($count);

	public function getCustomAnime($columns, $custom);
}