<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Task;
use App\Glucotest;


class AppServiceProvider extends ServiceProvider { /**
 * The policy mappings for the application.
 *
 * @var array
 */

    protected $policies = [
        Task::class => TaskPolicy::class,
        Glucotest::class => GlucotestPolicy::class,
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        //
    }

}
