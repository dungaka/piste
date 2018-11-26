<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use League\Csv\Reader;
use App\Client;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $secret = Hash::make('Ogilvymine!');

        // DB::table('clients')->insert([
        //     'name' => "Countdown",
        //     'dbm_advertiser_id' => 1853942,
        //     'fee' => 30
        // ]);
        // DB::table('clients')->insert([
        //     'name' => "Briscoes",
        //     'dbm_advertiser_id' => 1859543,
        //     'fee' => 30
        // ]);
        // DB::table('clients')->insert([
        //     'name' => "Rebel Sport",
        //     'dbm_advertiser_id' => 1859455,
        //     'fee' => 30
        // ]);
        DB::table('users')->insert([
            [
                'email' => 'analytics@ogilvy.co.nz',
                'name' => 'Ogilvy',
                'password' => $secret,
            ]
        ]);

        // Read CSV and save as the file
        $file = Reader::createFromPath('database/seeds/client_seed.csv');
        // Set the first row as the header offset
        $file->setHeaderOffset(0);
        // Get each line of the CSV as a record
        $records = $file->getRecords();
        // Build each record as an associative array with the header offset as keys
        foreach ($records as $offset => $record) {
            // Insert the record into the table
            Client::create([
                'name' => $record["Name"],
                'fee' => $record["Fee"],
                'dbm_advertiser_id' => $record["dbm_advertiser_id"],
            ]);
        }
    }
}
