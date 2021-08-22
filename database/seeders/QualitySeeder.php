<?php

namespace Database\Seeders;

use App\Repository\DLEParseRepository;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class QualitySeeder
 *
 * @package Database\Seeders
 */
class QualitySeeder extends Seeder
{
	protected DLEParseRepository $kodikRepository;

	/**
	 * QualitySeeder constructor.
	 *
	 * @param  \App\Repository\DLEParseRepository  $DLEParseRepository
	 */
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
