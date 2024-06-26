<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class EnvLocal extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'env:local';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set app environment to local';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        setEnv('APP_ENV', 'local');

        return Command::SUCCESS;
    }
}
