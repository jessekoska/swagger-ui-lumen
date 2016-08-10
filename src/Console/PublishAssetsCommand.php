<?php

namespace SwaggerUILumen\Console;

use SwaggerUILumen\Console\Helpers\Publisher;
use Illuminate\Console\Command;

class PublishAssetsCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'swagger-ui-lumen:publish-assets';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish assets to public';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        $this->info('Publishing assets files');

        (new Publisher($this))->publishDirectory(
            realpath(__DIR__.'/../../resources/assets'),
            config('swagger-ui-lumen.paths.assets')
        );
    }
}
