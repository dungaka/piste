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
        // for ($i=0; $i < 10; $i++) {
        //     factory(App\Client::class)->create();
        //     factory(App\Campaign::class)->create();
        //     factory(App\InsertionOrder::class)->create();
        // };

        factory(App\Client::class)->create();
        factory(App\Campaign::class)->create();
        factory(App\MediaPlan::class)->create();
        factory(App\InsertionOrder::class)->create();
        factory(App\Creative::class)->create();

        // DB::table('creative_line_item')->insert([
        //     'creative_id' => 1,
        //     'line_item_id' => 1
        // ]);
    }
}
