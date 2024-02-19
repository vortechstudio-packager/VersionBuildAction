<?php

namespace Vortechstudio\VersionBuildAction\Commands;

use Illuminate\Console\Command;

class VersionBuildActionCommand extends Command
{
    public $signature = 'versionbuildaction';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
