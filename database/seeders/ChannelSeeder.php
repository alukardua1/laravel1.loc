<?php

namespace Database\Seeders;

use App\Repository\DLEParseRepository;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChannelSeeder extends Seeder
{
	protected $channelRepository;

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
	    foreach ($channel as $value) {
		    DB::table('channels')->insert($value);
	    }
    }
}
