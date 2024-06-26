<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = [
        'date_time',
        'due_date_format',
    ];

    // public function getAmountAttribute($amount)
    // {
    //     return  currencyFormat($amount);
    // }

    // public function getPaidAmountAttribute($paid_amount)
    // {
    //     return  currencyFormat($paid_amount);
    // }
    protected static function boot() // for role wise data create
    {
        parent::boot();

        static::creating(function ($item) {
            $transaction_no = 'TRN_'.strtoupper(date('ymdhis').uniqid());
            $item->transaction_no = $transaction_no;
        });

        // static::created(function ($user) { });
    }

    // accessor | transaction time format
    public function getDateTimeAttribute()
    {
        $date = $this->date;

        if ($date) {
            return date('M d, Y', strtotime($date));
        }

        // or return an alternative value if desired
    }

    // accessor | transaction time format
    public function getDueDateFormatAttribute()
    {
        $date = $this->due_date;

        if ($date) {
            return date('M d, Y', strtotime($date));
        }

        // or return an alternative value if desired
    }

    // accessor | transaction date format
    public function getDateAttribute($value)
    {
        if ($value) {
            return date('Y-m-d', strtotime($value));
        }

        // or return an alternative value if desired
    }

    // accessor | transaction document url gen
    public function getDocumentAttribute($value)
    {
        if ($value) {
            return asset($value);
        }

        // or return an alternative value if desired
    }

    // One to one relation with type model
    public function type()
    {
        return $this->belongsTo(TransactionType::class, 'transaction_type_id');
    }

    // One to one relation with user model
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Scope define | Get All Unpaid Transactions
     */
    public function scopeUnpaid($query)
    {
        return $query->where('status', 'unpaid');
    }

    /**
     * Scope define | Get All Paid Transactions
     */
    public function scopePaid($query)
    {
        return $query->where('status', 'paid');
    }

    /**
     * Scope define | Get Income Transactions
     */
    public function scopeIncome($query)
    {
        return $query->whereHas('type', function ($q) {
            $q->where('type', 'income');
        });
    }

    /**
     * Scope define | Get Expense Transactions
     */
    public function scopeExpense($query)
    {
        return $query->whereHas('type', function ($q) {
            $q->where('type', 'expense');
        });
    }
}
