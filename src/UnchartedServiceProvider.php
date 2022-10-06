<?php

namespace DefStudio\Uncharted;

use DefStudio\Uncharted\Commands\UnchartedCommand;
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
            ->hasViews()
            ->hasMigration('create_uncharted_table')
            ->hasCommand(UnchartedCommand::class);
    }
}
