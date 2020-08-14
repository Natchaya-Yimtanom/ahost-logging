<?php

namespace Quinn\Logging;

use Illuminate\Console\Command;
use Quinn\Logging\Helpers\Publisher;

class AddRoute extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'quinn-logging:add-route';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Insert route in web.php';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {   
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
        fwrite($f, '$router->get("log","CustomController@test");'.PHP_EOL."\n");

        fwrite($f, $lines[$lineCount-1]);
        fclose($f);
        
        $this->info('Successfully insert route in web.php!');
    }
}