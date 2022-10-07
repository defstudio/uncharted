<?php

/** @noinspection PhpUnhandledExceptionInspection */

namespace DefStudio\Uncharted;

use DefStudio\Uncharted\Middlewares\InjectChartJsCdn;
use Illuminate\Contracts\Http\Kernel;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class UnchartedServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('uncharted')
            ->hasConfigFile()
            ->hasViews('uncharted')
            ->hasInstallCommand(fn (InstallCommand $command) => $command
                ->publishConfigFile()
                ->askToStarRepoOnGitHub('defstudio/uncharted'));
    }

    public function packageBooted(): void
    {
        $this->registerMiddleware();
    }

    private function registerMiddleware()
    {
        $kernel = $this->app->make(Kernel::class);
        $kernel->pushMiddleware(InjectChartJsCdn::class);
    }
}
