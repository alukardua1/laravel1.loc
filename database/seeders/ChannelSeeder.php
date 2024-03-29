<?php

namespace Database\Seeders;

use App\Repository\DLEParseRepository;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class ChannelSeeder
 *
 * @package Database\Seeders
 */
class ChannelSeeder extends Seeder
{
	protected DLEParseRepository $channelRepository;

	/**
	 * ChannelSeeder constructor.
	 *
	 * @param  \App\Repository\DLEParseRepository  $DLEParseRepository
	 */
	public function __construct(DLEParseRepository $DLEParseRepository)
	{
		$this->channelRepository = $DLEParseRepository;
	}

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$channel = $this->channelRepository->parseChannel();
		DB::table('channels')->insert($channel);
	}
}
