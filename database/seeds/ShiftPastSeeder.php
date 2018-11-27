<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
class ShiftPastSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$today = Carbon::now();
		for ($i=1; $i <= 100; $i++) { 
			$shiftDay = $today->addDays(random_int(-30, -1));
			DB::table('Shifts')->insert([
				'date' => $shiftDay,
				'tradeable' => 0,
				'startTime' => $shiftDay,
				'endTime' => $shiftDay->addHours(3),
				'FK_User' => random_int(1,40),
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now(),
			]);
		}
    }
}