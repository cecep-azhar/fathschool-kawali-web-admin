<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SchoolExpense
{
    use Dispatchable, SerializesModels;

    public $user;

    public $transactions;

    /**
     * Create a new event instance.
     *
     * @param  \App\Models\User  $user
     * @param  \Illuminate\Database\Eloquent\Collection  $transactions
     * @return void
     */
    public function __construct($user, $transactions)
    {
        $this->user = $user;
        $this->transactions = $transactions;
    }
}
