<?php

namespace Quinn\Logging;

use Illuminate\Console\Command;
use Quinn\Logging\Helpers\Publisher;

class PublishConfig extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'quinn-logging:publish-config';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish config file/folder into project';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        //create folder if not already have
        $path = 'config';

        if(!is_dir($path)){
            mkdir($path);
        }

        //publish config if not already have file
        if(!file_exists('logging.php')){

            (new Publisher($this))->publishFile(
                realpath(__DIR__.'/../../config/').'/logging.php',
                base_path('config'),'logging.php'
            );
        } else{

        //insert only command if already have file
        $path_to_file = 'config/logging.php';
        $file_contents = file_get_contents($path_to_file);
        $search = '"channels" => [
            "stack" => [
                "driver" => "stack",
                "channels" => ["database", "file"],
                "ignore_exceptions" => false,
            ],';

        $insert = '"sample" => [
            "driver" => "custom",
            "handler" => Quinn\Logging\LoggingHandler::class,
            "via" => Quinn\Logging\BaseLogger::class,
            "level" => "debug",
        ],';

        $replace = $search."\n".$insert;
        $file_contents = str_replace($search , $replace , $file_contents);
        file_put_contents($path_to_file,$file_contents);
        }

        $this->info('Successfully publish config file/folder!');
    }
}