<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QualitySeeder extends Seeder
{
	private $arr = [
		'BDRip',
		'BDRip 1080p',
		'BDRip 720p',
		'CAMRip',
		'D-VHS',
		'DVBRip',
		'DVBRip 720p',
		'DVDRip',
		'DVDSrc',
		'HDDVDRip',
		'HDDVDRip 1080p',
		'HDDVDRip 720p',
		'HDRip',
		'HDRip 1080p',
		'HDRip 720p',
		'HDTVRip',
		'HDTVRip 1080p',
		'HDTVRip 720p',
		'IPTVRip',
		'Laserdisc-RIP',
		'SATRip',
		'SuperTS',
		'TS',
		'TS 720p',
		'TVRip',
		'TVRip 720p',
		'VHSRip',
		'WEB-DLRip',
		'WEB-DLRip 1080p',
		'WEB-DLRip 720p',
		'Workprint-AVC',
	];
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		foreach ($this->arr as $item) {
			$data[] = [
				'title' => $item,
				'url' => \Str::slug($item)
			];
		}

		DB::table('qualities')->insert($data);
	}
}
