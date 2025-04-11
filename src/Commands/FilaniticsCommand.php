<?php

namespace Sepremex\Filanitics\Commands;

use Illuminate\Console\Command;

class FilaniticsCommand extends Command
{
    public $signature = 'filanitics';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
