<?php

namespace SwaggerLume\Console;

use Illuminate\Console\Command;

class PublishCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'swagger-ui-lumen:publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish config, views, assets';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        $this->info('Publishing all files');
        $this->call('swagger-ui-lumen:publish-config');
        $this->call('swagger-ui-lumen:publish-views');
        $this->call('swagger-ui-lumen:publish-assets');
    }
}
