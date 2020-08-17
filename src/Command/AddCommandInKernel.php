<?php

namespace Quinn\Logging;

use Illuminate\Console\Command;

class AddCommandInKernel extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'quinn-logging:kernel-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Insert command in Kernel.php';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {   
        //insert command in Kernel.php
        $path_to_file = 'app/Console/Kernel.php';
        $file_contents = file_get_contents($path_to_file);
        $search = '\Quinn\Logging\AddCommandInKernel::class,';

        $insert = "\t"."\t".'\Quinn\Logging\ActivateAllCommand::class,
        \Quinn\Logging\AddRoute::class,
        \Quinn\Logging\PublishConfig::class,
        \Quinn\Logging\PublishMigrations::class,
        \Quinn\Logging\TruncateTable::class,';

        $replace = $search."\n".$insert;
        $file_contents = str_replace($search , $replace , $file_contents);
        file_put_contents($path_to_file,$file_contents);

        $this->info('Successfully insert command in Kernel.php!');
    }
}