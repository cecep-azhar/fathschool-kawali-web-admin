<?php

namespace App\Console\Commands;

use App\Traits\InvoiceTrait;
use Illuminate\Console\Command;

class DailyRecurringInvoiceCreate extends Command
{
    use InvoiceTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'recurring:invoice';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command use for recurring invoice create';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->recurringInvoice();

        $this->info('Daily Recurring Invoice Create Successfully.');
    }
}
