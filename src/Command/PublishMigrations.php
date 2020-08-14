<?php

namespace Quinn\Logging;

use Illuminate\Console\Command;
use Quinn\Logging\Helpers\Publisher;

class PublishMigrations extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'quinn-logging:publish-migrations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish migrations file into project and migrate it';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        //publish migrations files
        $this->info('Publishing migrations files...');

        if(!file_exists('2020_08_05_095336_sample.php')){

            (new Publisher($this))->publishFile(
                realpath(__DIR__.'/../../database/migrations/').'/2020_08_05_095336_sample.php',
                database_path('migrations'),
                '2020_08_05_095336_sample.php'
            );
        }

        $this->info('Successfully publish migrations files!');

        //run php artisan migrate automatically
        $this->info('Running migrations...');
        $this->call('migrate', ['--force' => true,]);
        $this->comment('Migrations all done!');
    }
}