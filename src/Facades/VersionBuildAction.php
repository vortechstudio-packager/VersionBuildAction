<?php

namespace Vortechstudio\VersionBuildAction\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Vortechstudio\VersionBuildAction\VersionBuildAction
 */
class VersionBuildAction extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Vortechstudio\VersionBuildAction\VersionBuildAction::class;
    }
}
