<?php

use App\Notifications\SendSMS;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('migrate', function(){
    Artisan::call('migrate');

    return redirect()->route('home');
    //    die('migrate complete');
});

Route::get('clear', function(){
    Artisan::call('config:clear');


    return redirect()->route('home');
    //    die('migrate complete');
});

Route::get('seed', function(){
    Artisan::call('db:seed', ['--class' => 'SettingsTableSeeder']);

    return redirect()->route('home');
    //    die('migrate complete');
});

Route::get('clear_view', function(){
    Artisan::call('view:clear');

    die('clear complete');
});

//pages
Route::get('/', 'Client\Pages\HomeController')->name('home');
Route::get('/contact-us', 'Client\Pages\ContactUsController')->name('contact_us');
Route::post('/contact-us/save', 'Client\Pages\ContactUsController@save_form')->name('contact_us_save');
Route::get('/about-us', 'Client\Pages\AboutUsController')->name('about_us');
Route::get('/about-dr/{slug}', 'Client\Pages\AboutDrController')->name('about_dr');

//search
Route::get('/search', 'Client\Search\SearchController')->name('search');

//service
Route::get('/services/{slug}', 'Client\Services\ServicesController')->name('services');
Route::get('/services_category/{slug}', 'Client\Services\ServicesCategoryController')->name('services_category');
Route::post('/services/appointment', 'Client\Services\ServicesController@appointment')->name('appointment');


Route::post('/support/user', 'Client\SupportController@store')->name('support_user');

//exam
Route::get('/exam/{slug?}', 'Client\Exam\ExamController')->name('exam');
Route::get('/exam_result/{id}/{code}', 'Client\Exam\ExamController@result')->name('exam_result')->middleware('auth_client');
Route::get('/exam_result_admin/{id}/{code}', 'Client\Exam\ExamController@result_admin')->name('exam_result_admin')->middleware('auth_client');
Route::get('/questions/{exam_id}/{code}/{step?}', 'Client\Exam\QuestionsController')->name('questions')->middleware('auth_client');
Route::post('/answer', 'Client\Exam\QuestionsController@answer')->name('answer')->middleware('auth_client');
Route::post('/answer_1', 'Client\Exam\QuestionsController@answer_1')->name('answer_1')->middleware('auth_client');
Route::post('/answer_questions', 'Client\Exam\QuestionsController@answer_2')->name('answer_2')->middleware('auth_client');
Route::get('/show_answer/{exam_id}', 'Client\Exam\QuestionsController@show_answer')->name('show_answer')->middleware('auth_client');


//magazine
Route::get('/magazine', 'Client\Magazine\MagazineController')->name('magazine');
Route::get('/single_magazine/{slug}', 'Client\Magazine\SingleMagazineController')->name('single_magazine');
Route::get('/magazine_category/{slug?}', 'Client\Magazine\MagazineCategoryController')->name('magazine_category');
Route::get('/all_magazine/{slug}', 'Client\Magazine\AllMagazineController')->name('all_magazine');


//magazine
Route::get('/voice', 'Client\Voice\VoiceController')->name('voice')->middleware('auth_client');
Route::post('/voice', 'Client\Voice\VoiceController@submit')->name('voice_submit')->middleware('auth_client');
Route::get('/voice_result/{voice}', 'Client\Voice\VoiceController@result')->name('voice_result')->middleware('auth_client');

//podcast video
Route::get('/podcast_video', 'Client\PodcastVideo\PodcastVideoController')->name('podcast_video');
Route::get('/podcast_video/all_videos', 'Client\PodcastVideo\ShowAllVideoController')->name('all_video');
Route::get('/podcast_video/all_podcasts', 'Client\PodcastVideo\ShowAllPodcastsController')->name('all_podcasts');
Route::get('/podcast_video/all_videos/{slug}', 'Client\PodcastVideo\VideoCategoryController')->name('video_category');
Route::get('/podcast_video/all_podcasts/{slug}', 'Client\PodcastVideo\PodcastCategoryController')->name('podcast_category');
Route::get('/podcast_video/single_video/{slug}', 'Client\PodcastVideo\SingleVideoController')->name('single_video');
Route::get('/podcast_video/single_podcast/{slug}', 'Client\PodcastVideo\SinglePodcastController')->name('single_podcast');
Route::get('/all_products', 'Client\Pages\AllProductController')->name('all_products');

//profile
Route::get('/profile', 'Client\Profile\ProfileController')->name('profile')->middleware('auth_client');
Route::post('/profile/edit', 'Client\Profile\ProfileController@edit')->name('profile_edit');


//shop
Route::get('/shop/{slug}', 'Client\Shop\ShopController')->name('shop');
Route::get('/single_shop/{shop_id}/{id}',   'Client\Shop\SingleShopController')->name('single_shop');


//auth
Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/verify', 'Auth\VerifyController@show')->name('verify');
Route::post('/verify', 'Auth\VerifyController@register')->name('set_verify');
Route::get('/set_name', 'Auth\SetNameController@show')->middleware('auth_client')->name('show_set_name');
Route::post('/set_name', 'Auth\SetNameController@register')->middleware('auth_client')->name('set_name');

//Route::get('check_out', 'CheckOutController@show')->middleware('auth_client')->name('check_out');
Route::get('buy_exam/{id}', 'PaymentController@buy_exam')->middleware('auth_client')->name('buy_exam');
Route::get('buy_product/{id}', 'PaymentController@buy_product')->middleware('auth_client')->name('buy_product');
Route::get('buy_product_with_link/{link}', 'PaymentController@buy_product_with_link')->name('buy_product_with_link');
Route::get('/callback', 'PaymentController@verify');

Route::post('/comment_video', 'Client\PodcastVideo\SingleVideoController@set_commet')->middleware('auth_client')->name('set_comment_video');
Route::post('/comment_podcast', 'Client\PodcastVideo\SinglePodcastController@set_commet')->middleware('auth_client')->name('set_comment_podcast');
Route::post('/comment_blog', 'Client\Magazine\SingleMagazineController@set_commet')->middleware('auth_client')->name('set_comment_blog');

Route::get('send_sms' , 'Client\Pages\PageController@send_sms')->name('send_sms');
Route::post('send_sms' , 'Client\Pages\PageController@send_sms_submit')->name('send_sms_submit');

Route::get('/{page}' ,'Client\Pages\PageController')->name('pages');
