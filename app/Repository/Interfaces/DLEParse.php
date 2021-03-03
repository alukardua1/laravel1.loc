<?php


namespace App\Repository\Interfaces;


/**
 * Interface DLEParse
 *
 * @package App\Repository\Interfaces
 */
interface DLEParse
{
    /**
     * @return mixed
     */
    public function parseCategory();

    /**
     * @return mixed
     */
    public function parseUser();

	/**
	 * @param  null  $id
	 *
	 * @return mixed
	 */
    public function parsePost($id = null);

    /**
     * @return mixed
     */
    public function parsePostCategory();

    /**
     * @return mixed
     */
    public function parseComments();

    /**
     * @return mixed
     */
    public function parseStudio();

    /**
     * @return mixed
     */
    public function parsePerson();

	/**
	 * @return mixed
	 */
	public function parseChannel();

	/**
	 * @param $url
	 *
	 * @return mixed
	 */
	public function parseKodik($url);

	/**
	 * @return mixed
	 */
	public function parseQualityAnime();

	/**
	 * @param $url
	 *
	 * @return mixed
	 */
	public function parseKodikQuality($url);
}
