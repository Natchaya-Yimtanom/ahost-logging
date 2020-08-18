<?php

namespace Quinn\Logging;

use Illuminate\Console\Command;
use Quinn\Logging\Helpers\Publisher;

class ActivateAllCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'logging:activate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Activate all command in packages (Total 3 command)';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        // $this->call('quinn-logging:add-route');
        // $this->call('quinn-logging:publish-migrations');
        // $this->call('quinn-logging:publish-config');

        //////////////////////insert route//////////////////////

        //insert route in web.php
        $file = "routes/web.php";
        $fc = fopen($file, "r");
        while (!feof($fc)) {
            $buffer = fgets($fc, 4096);
            $lines[] = $buffer;
        }
        fclose($fc);
        $f = fopen($file, "r+") or die("couldn't open $file");
        $lineCount = count($lines);
        for ($i = 0; $i < $lineCount- 1; $i++) {
            fwrite($f, $lines[$i]);
        }
        fwrite($f, '$router->group(["namespace" => "\Quinn\Logging"], function() use ($router) {
            $router->get("log", "CustomController@test");
        });'.PHP_EOL."\n");
        fwrite($f, $lines[$lineCount-1]);
        fclose($f);
        $this->info('Successfully insert route in web.php!');

        //////////////////////publish config file//////////////////////

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

        $insert = '"logging" => [
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

        //////////////////////publish migrations file//////////////////////

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

        ////////////////////// DONE //////////////////////
        $this->info('Successfully activate all command in packages');
    }
}