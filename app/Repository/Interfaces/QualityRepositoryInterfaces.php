<?php


namespace App\Repository\Interfaces;


use Illuminate\Http\Request;

/**
 * Interface QualityRepositoryInterfaces
 *
 * @package App\Repository\Interfaces
 */
interface QualityRepositoryInterfaces
{
	/**
	 * @param  string  $qualityUrl
	 *
	 * @return mixed
	 */
	public function getAnime(string $qualityUrl): mixed;

	/**
	 * @return mixed
	 */
	public function getQuality(): mixed;

	/**
	 * @param  string   $name
	 * @param  Request  $request
	 *
	 * @return mixed
	 */
	public function setQuality(string $name, Request $request): mixed;
}