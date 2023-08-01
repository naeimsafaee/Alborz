<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sms')->insert(
            array(
                'stock' => 10,
                'sends' => 0,
                'totalsend' => 0,
                'emergencysend' => 0,
                'created_at' => now()
            )
        );


    }
}
