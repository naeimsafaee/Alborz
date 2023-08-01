<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductImageSeeder extends Seeder{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run(){

     /*   $image = [
            'assets/svg//sample2.jpg',
            'assets/svg//sample.jpg',
            'assets/svg/gol3.jpg',
            'assets/svg/gol2.jpg',
            'assets/svg/gol1.jpg',
        ];

        for($i = 22 ; $i < 32 ;$i++){
            for($j = 0 ;$j < 3 ;$j++){
                DB::table('product_images')->insert([
                    'product_id' => $i,
                    'image' => $image[rand(0 , 4)],
                ]);
            }

        }*/

    }
}
