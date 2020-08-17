<?php

namespace Quinn\Logging;

use Illuminate\Console\Command;

use Quinn\Logging\Logging;

class TruncateTable extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'quinn-logging:truncate-table';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete all data in database';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        Logging::truncate();
        $this->info('Successfully delete all data in table!');
    }
}