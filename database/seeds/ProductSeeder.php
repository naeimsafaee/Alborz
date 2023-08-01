<?php

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder{

    /**
     * Run the database seeds.
     * @return void
     */
    public function run(){

        $material = ['سفالی', 'سرامیک', '', 'گلی'];
        $image = [
            'assets/svg//sample2.jpg',
            'assets/svg//sample.jpg',
            'assets/svg/gol3.jpg',
            'assets/svg/gol2.jpg',
            'assets/svg/gol1.jpg',
        ];

        for($i = 0; $i < 10; $i++){

            $price = rand(1 , 20) * 10000;
            $discounted_price = rand(0, 3) * 1000;
            if($discounted_price != 0)
                $discounted_price = $price - $discounted_price;

            DB::table('products')->insert([
                'name' => "گیاه شماره " . rand(1, 20),
                'price' => $price,
                'discounted_price' => $discounted_price,
                'height' => rand(0, 8) * 10,
                'material' => $material[rand(0, 3)],
                'main_image' => $image[rand(0, count($image) - 1)],
                'description' => 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است، چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است، و برای شرایط فعلی تکنولوژی مورد نیاز، و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد، کتابهای زیادی در شصت و سه درصد گذشته حال و آینده، شناخت فراوان جامعه و متخصصان را می طلبد، تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی، و فرهنگ پیشرو در زبان فارسی ایجاد کرد، در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها، و شرایط سخت تایپ به پایان رسد و زمان مورد نیاز شامل حروفچینی دستاوردهای اصلی، و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.',
            ]);
        }
    }
}
