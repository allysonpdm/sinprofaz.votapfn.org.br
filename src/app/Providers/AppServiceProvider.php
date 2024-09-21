<?php

namespace App\Providers;

use Faker\{
    Factory,
    Generator
};
use Illuminate\Support\ServiceProvider;
use Spatie\CpuLoadHealthCheck\CpuLoadCheck;
use Spatie\Health\Checks\Checks\BackupsCheck;
use Spatie\Health\Checks\Checks\CacheCheck;
use Spatie\Health\Checks\Checks\DatabaseCheck;
use Spatie\Health\Checks\Checks\DatabaseConnectionCountCheck;
use Spatie\Health\Checks\Checks\DatabaseSizeCheck;
use Spatie\Health\Checks\Checks\DebugModeCheck;
use Spatie\Health\Checks\Checks\EnvironmentCheck;
use Spatie\Health\Checks\Checks\OptimizedAppCheck;
use Spatie\Health\Checks\Checks\PingCheck;
use Spatie\Health\Checks\Checks\QueueCheck;
use Spatie\Health\Checks\Checks\RedisCheck;
use Spatie\Health\Checks\Checks\RedisMemoryUsageCheck;
use Spatie\Health\Checks\Checks\ScheduleCheck;
use Spatie\Health\Checks\Checks\UsedDiskSpaceCheck;
use Spatie\Health\Facades\Health;
use Spatie\SecurityAdvisoriesHealthCheck\SecurityAdvisoriesCheck;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Generator::class, function () {
            return Factory::create('pt_BR');
        });

        Health::checks([
            CacheCheck::new(),
            OptimizedAppCheck::new()
                ->checkConfig()
                ->checkRoutes(),
            CpuLoadCheck::new()
                ->failWhenLoadIsHigherInTheLast5Minutes(2.0)
                ->failWhenLoadIsHigherInTheLast15Minutes(1.5),
            DatabaseCheck::new()
                ->connectionName('mysql')
                ->name('Mysql status: Local'),
            DatabaseCheck::new()
                ->connectionName('mysql_area_filiado')
                ->name('Mysql status: Area do filiado'),
            DatabaseConnectionCountCheck::new()
                ->name('Mysql connection count: local')
                ->connectionName('mysql')
                ->warnWhenMoreConnectionsThan(50)
                ->failWhenMoreConnectionsThan(100),
            DatabaseConnectionCountCheck::new()
                ->name('Mysql connection count: mysql_area_filiado')
                ->connectionName('mysql_area_filiado')
                ->warnWhenMoreConnectionsThan(50)
                ->failWhenMoreConnectionsThan(100),
            DatabaseSizeCheck::new()
                ->name('Mysql size : local')
                ->connectionName('mysql')
                ->failWhenSizeAboveGb(5.0),
            DatabaseSizeCheck::new()
                ->name('Mysql size: mysql_area_filiado')
                ->connectionName('mysql_area_filiado')
                ->failWhenSizeAboveGb(5.0),
            DebugModeCheck::new(),
            EnvironmentCheck::new()
                ->expectEnvironment('production'),
            PingCheck::new()
                ->url('https://sinprofaz.org.br')
                ->name('sinprofaz')
                ->retryTimes(3),
            QueueCheck::new(),
            RedisCheck::new(),
            RedisMemoryUsageCheck::new()
                ->failWhenAboveMb(1000),
            ScheduleCheck::new(),
            SecurityAdvisoriesCheck::new(),
            UsedDiskSpaceCheck::new()
                ->warnWhenUsedSpaceIsAbovePercentage(60)
                ->failWhenUsedSpaceIsAbovePercentage(80)
        ]);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
