<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clients')->insert([
            'name' => "Countdown",
            'dbm_advertiser_id' => 1853942,
            'fee' => 30
        ]);
        DB::table('clients')->insert([
            'name' => "Briscoes",
            'dbm_advertiser_id' => 1859543,
            'fee' => 30
        ]);
        DB::table('clients')->insert([
            'name' => "Rebel Sport",
            'dbm_advertiser_id' => 1859455,
            'fee' => 30
        ]);
    }
}
