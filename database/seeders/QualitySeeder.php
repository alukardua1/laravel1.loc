<?php

namespace Database\Seeders;

use App\Repository\DLEParseRepository;
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

	protected $kodikRepository;

	public function __construct(DLEParseRepository $DLEParseRepository)
	{
		$this->kodikRepository = $DLEParseRepository;
	}
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$quality = $this->kodikRepository->parseKodikQuality('https://kodikapi.com/qualities?token=16b2ff25feb8e53b0aded1ebb0fff2c1');

		foreach ($quality as $value)
		{
			$data[] = [
				'name' => $value,
				'url'  => \Str::slug($value),
			];
		}

		DB::table('qualities')->insert($data);
	}
}
