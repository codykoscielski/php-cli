<?php

declare(strict_types=1);

namespace App\Command\Generate;

use Minicli\Command\CommandController;

class HelpController extends CommandController
{
    public function handle(): void
    {
        $this->info('Generate Usage');
    }
}


