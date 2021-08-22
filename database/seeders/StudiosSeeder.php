<?php

namespace Database\Seeders;

use App\Repository\DLEParseRepository;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class StudiosSeeder
 *
 * @package Database\Seeders
 */
class StudiosSeeder extends Seeder
{
    protected DLEParseRepository $studiosRepository;

	/**
	 * StudiosSeeder constructor.
	 *
	 * @param  \App\Repository\DLEParseRepository  $DLEParseRepository
	 */
	public function __construct(DLEParseRepository $DLEParseRepository)
    {
        $this->studiosRepository = $DLEParseRepository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $studios = $this->studiosRepository->parseStudio();

	    DB::table('studios')->insert($studios);
    }
}
