<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Setting;

class SettingsTableSeeder extends Seeder{

    public function run(){
        $setting = $this->findSetting('site.title');
        if(!$setting->exists){
            $setting->fill([
                'display_name' => __('voyager::seeders.settings.site.title'),
                'value' => __('voyager::seeders.settings.site.title'),
                'details' => '',
                'type' => 'text',
                'order' => 1,
                'group' => 'Site',
            ])->save();
        }

        $setting = $this->findSetting('site.description');
        if(!$setting->exists){
            $setting->fill([
                'display_name' => __('voyager::seeders.settings.site.description'),
                'value' => __('voyager::seeders.settings.site.description'),
                'details' => '',
                'type' => 'text',
                'order' => 2,
                'group' => 'Site',
            ])->save();
        }

        $setting = $this->findSetting('site.logo');
        if(!$setting->exists){
            $setting->fill([
                'display_name' => __('voyager::seeders.settings.site.logo'),
                'value' => '',
                'details' => '',
                'type' => 'image',
                'order' => 3,
                'group' => 'Site',
            ])->save();
        }

        $setting = $this->findSetting('site.google_analytics_tracking_id');
        if(!$setting->exists){
            $setting->fill([
                'display_name' => __('voyager::seeders.settings.site.google_analytics_tracking_id'),
                'value' => '',
                'details' => '',
                'type' => 'text',
                'order' => 4,
                'group' => 'Site',
            ])->save();
        }

        $setting = $this->findSetting('admin.bg_image');
        if(!$setting->exists){
            $setting->fill([
                'display_name' => __('voyager::seeders.settings.admin.background_image'),
                'value' => '',
                'details' => '',
                'type' => 'image',
                'order' => 5,
                'group' => 'Admin',
            ])->save();
        }

        $setting = $this->findSetting('admin.title');
        if(!$setting->exists){
            $setting->fill([
                'display_name' => __('voyager::seeders.settings.admin.title'),
                'value' => 'Voyager',
                'details' => '',
                'type' => 'text',
                'order' => 1,
                'group' => 'Admin',
            ])->save();
        }

        $setting = $this->findSetting('admin.emergency_calls');
        if(!$setting->exists){
            $setting->fill([
                'display_name' => __('voyager::seeders.settings.admin.emergency_calls'),
                'value' => '09099019898',
                'details' => '',
                'type' => 'text',
                'order' => 1,
                'group' => 'Admin',
            ])->save();
        }

        $setting = $this->findSetting('admin.messaging_credit');
        if(!$setting->exists){
            $setting->fill([
                'display_name' => __('voyager::seeders.settings.admin.messaging_credit'),
                'value' => '10',
                'details' => '',
                'type' => 'text',
                'order' => 1,
                'group' => 'Admin',
            ])->save();
        }

        $setting = $this->findSetting('admin.description');
        if(!$setting->exists){
            $setting->fill([
                'display_name' => __('voyager::seeders.settings.admin.description'),
                'value' => __('voyager::seeders.settings.admin.description_value'),
                'details' => '',
                'type' => 'text',
                'order' => 2,
                'group' => 'Admin',
            ])->save();
        }

        $setting = $this->findSetting('admin.loader');
        if(!$setting->exists){
            $setting->fill([
                'display_name' => __('voyager::seeders.settings.admin.loader'),
                'value' => '',
                'details' => '',
                'type' => 'image',
                'order' => 3,
                'group' => 'Admin',
            ])->save();
        }

        $setting = $this->findSetting('admin.icon_image');
        if(!$setting->exists){
            $setting->fill([
                'display_name' => __('voyager::seeders.settings.admin.icon_image'),
                'value' => '',
                'details' => '',
                'type' => 'image',
                'order' => 4,
                'group' => 'Admin',
            ])->save();
        }

        $setting = $this->findSetting('admin.google_analytics_client_id');
        if(!$setting->exists){
            $setting->fill([
                'display_name' => __('voyager::seeders.settings.admin.google_analytics_client_id'),
                'value' => '',
                'details' => '',
                'type' => 'text',
                'order' => 1,
                'group' => 'Admin',
            ])->save();
        }

        $setting = $this->findSetting('home.services_text');
        if(!$setting->exists){
            $setting->fill([
                'display_name' => "متن خدمات ما",
                'value' => 'خدمات ما در البرز آترا',
                'details' => '',
                'type' => 'text',
                'order' => 1,
                'group' => 'Home',
            ])->save();
        }

        $setting = $this->findSetting('home.services_text_one');
        if(!$setting->exists){
            $setting->fill([
                'display_name' => "متن بالای خدمات ما",
                'value' => 'لورم ایپسوم متن ساختگی',
                'details' => '',
                'type' => 'text',
                'order' => 1,
                'group' => 'Home',
            ])->save();
        }

        $setting = $this->findSetting('home.facilities_above_text');
        if(!$setting->exists){
            $setting->fill([
                'display_name' => "متن بالای امکانات ما",
                'value' => 'لورم ایپسوم متن ساختگی',
                'details' => '',
                'type' => 'text',
                'order' => 1,
                'group' => 'Home',
            ])->save();
        }

        $setting = $this->findSetting('home.facilities_text');
        if(!$setting->exists){
            $setting->fill([
                'display_name' => "متن امکانات ما",
                'value' => 'امکانات منحصربفرد در البرز آترا',
                'details' => '',
                'type' => 'text',
                'order' => 1,
                'group' => 'Home',
            ])->save();
        }

        $setting = $this->findSetting('home.product_above_text');
        if(!$setting->exists){
            $setting->fill([
                'display_name' => "متن بالای محصولات ما",
                'value' => 'لورم ایپسوم متن ساختگی',
                'details' => '',
                'type' => 'text',
                'order' => 1,
                'group' => 'Home',
            ])->save();
        }

        $setting = $this->findSetting('home.product_text');
        if(!$setting->exists){
            $setting->fill([
                'display_name' => "متن محصولات ما",
                'value' => 'تازه ترین محصولات فروشگاه',
                'details' => '',
                'type' => 'text',
                'order' => 1,
                'group' => 'Home',
            ])->save();
        }

        $setting = $this->findSetting('home.podcast_above');
        if(!$setting->exists){
            $setting->fill([
                'display_name' => "متن بالای تازه ترین پادکست ها",
                'value' => 'لورم ایپسوم متن ساختگی',
                'details' => '',
                'type' => 'text',
                'order' => 1,
                'group' => 'Home',
            ])->save();
        }

        $setting = $this->findSetting('home.comments');
        if(!$setting->exists){
            $setting->fill([
                'display_name' => "متن نظرات مراجعین",
                'value' => 'نظر مراجعین درباره ما',
                'details' => '',
                'type' => 'text',
                'order' => 1,
                'group' => 'Home',
            ])->save();
        }

        $setting = $this->findSetting('home.comments_above');
        if(!$setting->exists){
            $setting->fill([
                'display_name' => "متن بالای نظرات مراجعین",
                'value' => 'لورم ایپسوم متن ساختگی',
                'details' => '',
                'type' => 'text',
                'order' => 1,
                'group' => 'Home',
            ])->save();
        }

        $setting = $this->findSetting('home.podcast');
        if(!$setting->exists){
            $setting->fill([
                'display_name' => "متن تازه ترین پادکست ها",
                'value' => 'تازه ترین پادکست ها و ویدیو ها',
                'details' => '',
                'type' => 'text',
                'order' => 1,
                'group' => 'Home',
            ])->save();
        }

       
        $setting = $this->findSetting('social.facebook');
        if(!$setting->exists){
            $setting->fill([
                'display_name' => "لینک فیسبوک",
                'value' => '',
                'details' => '',
                'type' => 'text',
                'order' => 1,
                'group' => 'social',
            ])->save();
        }
        $setting = $this->findSetting('social.insta');
        if(!$setting->exists){
            $setting->fill([
                'display_name' => "لینک اینستاگرام",
                'value' => '',
                'details' => '',
                'type' => 'text',
                'order' => 1,
                'group' => 'social',
            ])->save();
        }

        $setting = $this->findSetting('social.youtube');
        if(!$setting->exists){
            $setting->fill([
                'display_name' => "لینک یوتیوب",
                'value' => '',
                'details' => '',
                'type' => 'text',
                'order' => 1,
                'group' => 'social',
            ])->save();
        }

        $setting = $this->findSetting('social.tweeter');
        if(!$setting->exists){
            $setting->fill([
                'display_name' => "لینک توییتر",
                'value' => '',
                'details' => '',
                'type' => 'text',
                'order' => 1,
                'group' => 'social',
            ])->save();
        }

        $setting = $this->findSetting('social.aparat');
        if(!$setting->exists){
            $setting->fill([
                'display_name' => "لینک آپارات",
                'value' => '',
                'details' => '',
                'type' => 'text',
                'order' => 1,
                'group' => 'social',
            ])->save();
        }

        $setting = $this->findSetting('social.linkedin');
        if(!$setting->exists){
            $setting->fill([
                'display_name' => "لینک لینکد این",
                'value' => '',
                'details' => '',
                'type' => 'text',
                'order' => 1,
                'group' => 'social',
            ])->save();
        }

        $setting = $this->findSetting('footer.phone');
        if(!$setting->exists){
            $setting->fill([
                'display_name' => "شماره تماس",
                'value' => '',
                'details' => '',
                'type' => 'text',
                'order' => 1,
                'group' => 'footer',
            ])->save();
        }

        $setting = $this->findSetting('title.name');
        if(!$setting->exists){
            $setting->fill([
                'display_name' => "نام تایتل",
                'value' => '',
                'details' => '',
                'type' => 'text',
                'order' => 1,
                'group' => 'title',
            ])->save();
        }

        $setting = $this->findSetting('title.image');
        if(!$setting->exists){
            $setting->fill([
                'display_name' => "عکس تایتل",
                'value' => '',
                'details' => '',
                'type' => 'text',
                'order' => 1,
                'group' => 'title',
            ])->save();
        }

        $setting = $this->findSetting('mainpic.slider1');
        if(!$setting->exists){
            $setting->fill([
                'display_name' => "عکس اسلایدر بزرگ",
                'value' => '',
                'details' => '',
                'type' => 'image',
                'order' => 1,
                'group' => 'mainpic',
            ])->save();
        }

        $setting = $this->findSetting('mainpic.slider2');
        if(!$setting->exists){
            $setting->fill([
                'display_name' => "عکس اسلایدر متوسط",
                'value' => '',
                'details' => '',
                'type' => 'image',
                'order' => 1,
                'group' => 'mainpic',
            ])->save();
        }

        $setting = $this->findSetting('mainpic.slider3');
        if(!$setting->exists){
            $setting->fill([
                'display_name' => "عکس اسلایدر کوچک",
                'value' => '',
                'details' => '',
                'type' => 'image',
                'order' => 1,
                'group' => 'mainpic',
            ])->save();
        }

        $setting = $this->findSetting('mainpic.shop');
        if(!$setting->exists){
            $setting->fill([
                'display_name' => "عکس محصولات فروشگاه",
                'value' => '',
                'details' => '',
                'type' => 'image',
                'order' => 1,
                'group' => 'mainpic',
            ])->save();
        }

        $setting = $this->findSetting('mainpic.podcastvideo');
        if(!$setting->exists){
            $setting->fill([
                'display_name' => "عکس پادکست و ویدئو",
                'value' => '',
                'details' => '',
                'type' => 'image',
                'order' => 1,
                'group' => 'mainpic',
            ])->save();
        }

        $setting = $this->findSetting('mainpic.podcast');
        if(!$setting->exists){
            $setting->fill([
                'display_name' => "عکس پادکست (صفحه ویدئو و پادکست ها)",
                'value' => '',
                'details' => '',
                'type' => 'image',
                'order' => 1,
                'group' => 'mainpic',
            ])->save();
        }

        $setting = $this->findSetting('mainpic.video');
        if(!$setting->exists){
            $setting->fill([
                'display_name' => "عکس ویدئو (صفحه ویدئو و پادکست ها)",
                'value' => '',
                'details' => '',
                'type' => 'image',
                'order' => 1,
                'group' => 'mainpic',
            ])->save();
        }

        $setting = $this->findSetting('mainpic.service');
        if(!$setting->exists){
            $setting->fill([
                'display_name' => "عکس کنار دسته بندی ها (صفحه خدمات)",
                'value' => '',
                'details' => '',
                'type' => 'image',
                'order' => 1,
                'group' => 'mainpic',
            ])->save();
        }

        $setting = $this->findSetting('aboutus.title');
        if(!$setting->exists){
            $setting->fill([
                'display_name' => "تیتر درباره ما",
                'value' => 'متن ساختگی با تولید سادگی',
                'details' => '',
                'type' => 'text',
                'order' => 1,
                'group' => 'aboutus',
            ])->save();
        }

        $setting = $this->findSetting('aboutus.desc');
        if(!$setting->exists){
            $setting->fill([
                'display_name' => "توضیحات درباره ما",
                'value' => '',
                'details' => '',
                'type' => 'text',
                'order' => 1,
                'group' => 'aboutus',
            ])->save();
        }

        $setting = $this->findSetting('aboutus.image');
        if(!$setting->exists){
            $setting->fill([
                'display_name' => "تصویر درباره ما",
                'value' => '',
                'details' => '',
                'type' => 'image',
                'order' => 1,
                'group' => 'aboutus',
            ])->save();
        }

        $setting = $this->findSetting('aboutus.video');
        if(!$setting->exists){
            $setting->fill([
                'display_name' => "ویدئو",
                'value' => '',
                'details' => '',
                'type' => 'file',
                'order' => 1,
                'group' => 'aboutus',
            ])->save();
        }

        $setting = $this->findSetting('aboutus.title2');
        if(!$setting->exists){
            $setting->fill([
                'display_name' => "تیتر دوم درباره ما",
                'value' => '',
                'details' => '',
                'type' => 'text',
                'order' => 1,
                'group' => 'aboutus',
            ])->save();
        }

        $setting = $this->findSetting('aboutus.desc2');
        if(!$setting->exists){
            $setting->fill([
                'display_name' => "توضیخات دوم درباره ما",
                'value' => '',
                'details' => '',
                'type' => 'text',
                'order' => 1,
                'group' => 'aboutus',
            ])->save();
        }

        $setting = $this->findSetting('aboutus.nobat');
        if(!$setting->exists){
            $setting->fill([
                'display_name' => "توضیخات نوبت گیری",
                'value' => 'توضیحات نوبت گیری',
                'details' => 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.
                        چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی
                        مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه
                        درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری
                        را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این
                        صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد
                        وزمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی
                        اساسا مورد استفاده قرار گیرد',
                'type' => 'text',
                'order' => 1,
                'group' => 'aboutus',
            ])->save();
        }

        $setting = $this->findSetting('exam.answer');
        if(!$setting->exists){
            $setting->fill([
                'display_name' => "توضیحات قسمت درخواست بررسی آزمون",
                'value' => 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.
                        چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی
                        مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه
                        درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری
                        را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این
                        صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد
                        وزمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی
                        اساسا مورد استفاده قرار گیرد',
                'details' => '',
                'type' => 'text',
                'order' => 1,
                'group' => 'exam',
            ])->save();
        }

    }

    protected function findSetting($key){
        return Setting::query()->firstOrNew(['key' => $key]);
    }

}
