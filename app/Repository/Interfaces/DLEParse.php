<?php


namespace App\Repository\Interfaces;


/**
 * Interface DLEParse
 *
 * @package App\Repository\Interfaces
 */
interface DLEParse
{
    public function parseCategory();

    public function parseUser();

    public function parsePost($id = null);

    public function parsePostCategory();

    public function parseComments();

    public function parseStudio();

    public function parsePerson();

	public function parseChannel();

	public function parseKodik($url);

	public function parseKodikQuality($url);
}
