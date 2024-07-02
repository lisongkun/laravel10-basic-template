<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \Schema::defaultStringLength(191);

        // 开发环境打印 SQL
        if (config('app.env') === 'local') {
            \DB::listen(function ($query) {
                $sql = $query->sql;
                $bindings = $query->bindings;
                $time = $query->time;
                $sql = str_replace('?', "'%s'", $sql);
                $fullSql = vsprintf($sql, $bindings);
                \Log::debug('SQL', ['sql' => $fullSql, 'time' => $time]);
            });
        }
    }
}
