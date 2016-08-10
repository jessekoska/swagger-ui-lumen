<?php

namespace SwaggerUILumen\Console;

use SwaggerUILumen\Console\Helpers\Publisher;
use Illuminate\Console\Command;

class PublishViewsCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'swagger-ui-lumen:publish-views';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish views';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        $this->info('Publishing view files');

        (new Publisher($this))->publishFile(
            realpath(__DIR__.'/../../resources/views/').'/index.blade.php',
            config('swagger-ui-lumen.paths.views'),
            'index.blade.php'
        );
    }
}
