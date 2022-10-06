<?php

namespace DefStudio\Uncharted\Commands;

use Illuminate\Console\Command;

class UnchartedCommand extends Command
{
    public $signature = 'uncharted';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
