<?php

declare(strict_types=1);

namespace App\Command\Generate;

use Minicli\Command\CommandController;

class DefaultController extends CommandController
{
    public function handle(): void
    {
        $url = null;
        if ($this->hasParam('url')) {
            $url = $this->getParam('url');
        }
        $this->display("Hi $url");

        if(!$url) {
            $this->error("Please provide a URL");
            return;
        }

        $this->info("Generating config for site $url");

        $projectRoot = dirname(__DIR__, 3);

        $templatePath = $projectRoot . '/templates/apache.conf.template';
        $outputPath = $projectRoot . '/' . $url . '.conf';

        $templateContent = file_get_contents($templatePath);

        $this->info("reading template from $templatePath");

        $placeHolder = '{{SERVER_NAME}}';
        $newContent = str_replace($placeHolder, $url, $templateContent);

        $bytesWritten = file_put_contents($outputPath, $newContent);

        if($bytesWritten === false) {
            $this->error('Could not save');
        } else {
            $this->info('Saved!');
        }
    }
}

