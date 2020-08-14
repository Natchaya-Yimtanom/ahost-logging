<?php

namespace Quinn\Logging;

use Illuminate\Console\Command;

class ActivateAllCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'quinn-logging:activate-all';

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
        $this->info('Successfully activate all command in packages (Total 3 command)');
        $this->call('quinn-logging:add-route');
        $this->call('quinn-logging:publish-migrations');
        $this->call('quinn-logging:publish-config');
    }
}