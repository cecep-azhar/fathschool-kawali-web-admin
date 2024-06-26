<?php

namespace App\Services\Parent;

use App\Models\Transaction;
use App\Models\User;
use App\Services\ParentChildrenService;

class ParentDashboardService
{
    public function dashboard($request)
    {
        // all child
        $child_ids = (new ParentChildrenService)->getChildren();

        $data['all_childrens'] = User::whereIn('id', $child_ids)->with(['profile:id,user_id,roll_no', 'profile.user:id'])->get();

        // unpaid transactions
        $data['unpaid_invoices'] = Transaction::whereIn('user_id', $child_ids)->with(['user:id,name,username,email', 'type'])->where('status', 'unpaid')
            ->latest()
            ->paginate(20);

        return $data;
    }
}
