<?php


namespace App\Repository;


use App\Repository\Interfaces\VideoHostRepositoryInterfaces;
use App\Services\CurlTrait;

/**
 * Class VideoHostRepository
 *
 * @package App\Repository
 */
class VideoHostRepository implements VideoHostRepositoryInterfaces
{

	use CurlTrait;

	private mixed  $config;
	private string $token;
	private int    $limit              = 50;
	private string $sort               = 'updated_at';
	private string $order              = 'desc';
	private string $types;
	private string $year;
	private string $translation_id;
	private string $translation_type;
	private string $camrip;
	private bool   $with_seasons       = false;
	private bool   $with_episodes      = false;
	private bool   $with_episodes_data = false;
	private bool   $with_page_links    = false;
	private string $not_blocked_in;
	private bool   $not_blocked_for_me;
	private bool   $with_material_data = false;

	public function __construct()
	{
		$this->config = config('video_host');
		$this->token = $this->config['token'];
	}

	/**
	 * @param  array|null  $other
	 *
	 * @return mixed
	 */
	public function list(array $other = null): mixed
	{
		// TODO: Implement list() method.
	}

	/**
	 * @param  array  $search
	 *
	 * @return mixed
	 */
	public function search(array $search): mixed
	{
		// TODO: Implement search() method.
	}
}