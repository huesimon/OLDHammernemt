<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CompaniesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		for ($i=1; $i <= 3; $i++) { 
			DB::table('Companies')->insert([
			'name' => 'Virksomhed' . $i,
			'cvr' => random_int(10000000,99999999),
			'active' => 1,
			'created_at' => Carbon::now(),
			'updated_at' => Carbon::now(),
		]);
		}
    }
}
