<?php

namespace App\Jobs;

use App\Models\Journal;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ClearExpiredSecurityCodes implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct()
    {
        //
    }

    public function handle()
    {
        Journal::where('security_code_expiration', '<', Carbon::now())
            ->update(['security_code' => null, 'security_code_expiration' => null]);
    }
}
