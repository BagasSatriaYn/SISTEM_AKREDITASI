<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
{
    $this->app->bind(
        \App\Services\NotificationService::class
    );
}


    /**
     * Bootstrap any application services.
     */
    // public function boot(): void
    // {
    //     if (config('app.env') === 'local') {
    //         URL::forceScheme('https');
    //     }
    // }
    
    public function boot()
{
    View::composer('*', function ($view) {
        $user = Auth::user();
        $notifications = [];
        $unreadCount = 0;

        if ($user) {
            $notifications = Notification::where('user_id', $user->id_user)->latest()->take(5)->get();
            $unreadCount = Notification::where('user_id', $user->id_user)->where('is_read', false)->count();
        }

        $view->with('notifications', $notifications);
        $view->with('unreadCount', $unreadCount);
    });
}
}
