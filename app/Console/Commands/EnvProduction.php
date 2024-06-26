<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class EnvProduction extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'env:production';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set app environment to production';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        setEnv('APP_ENV', 'production');

        return Command::SUCCESS;
    }
}
