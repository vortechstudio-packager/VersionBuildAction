<?php

namespace Vortechstudio\VersionBuildAction;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Vortechstudio\VersionBuildAction\Commands\VersionBuildActionCommand;
use Vortechstudio\VersionBuildAction\Commands\VersionPublishCommand;

class VersionBuildActionServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('versionbuildaction')
            ->hasConfigFile()
            ->hasCommand(VersionBuildActionCommand::class)
            ->hasCommand(VersionPublishCommand::class);
    }
}
