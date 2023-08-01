<?php

namespace App\Providers;

use App\Models\Banneduser;
use App\Models\Notification;
use App\Models\Support;
use App\Observers\BanneduserObserver;
use App\Observers\NotificationObserver;
use App\Observers\SupportObserver;
use Illuminate\Support\ServiceProvider;
use TCG\Voyager\Facades\Voyager;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Builder;

class AppServiceProvider extends ServiceProvider{

    /**
     * Register any application services.
     * @return void
     */
    public function register(){
        Voyager::useModel('Role', \App\Models\Role::class);
    }

    /**
     * Bootstrap any application services.
     * @return void
     */
    public function boot(){
        Support::observe(SupportObserver::class);
        Banneduser::observe(BanneduserObserver::class);
        Notification::observe(NotificationObserver::class);

        Builder::defaultStringLength(191);
    }
}
