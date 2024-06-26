<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['invoice_date', 'due_date_format', 'next_recurring_date'];

    // accessor --> date format
    public function getInvoiceDateAttribute()
    {
        $date = $this->date;
        if ($date) {
            return date('M d, Y', strtotime($date));
        }
    }

    // accessor --> Due date format
    public function getDueDateFormatAttribute()
    {
        $date = $this->due_date;
        if ($date) {
            return date('M d, Y', strtotime($date));
        }
    }

    // accessor --> Next Recurring date format
    public function getNextRecurringDateAttribute()
    {
        $date = $this->recurring_date;
        if ($date) {
            return date('M d, Y', strtotime($date));
        }
    }

    // Scope --> Only Recurring Invoice
    public function ScopeRecurring($query)
    {
        return $query->where('recurring', true);
    }

    // One to one relation with user model
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     *  One to One relation with Transaction model
     * to get transaction item which related
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'invoice_id');
    }

    // One to Many relation with Invoice Item model
    public function items()
    {
        return $this->hasMany(InvoiceItem::class, 'invoice_id');
    }

    // One to Many relation with Invoice Attachment model
    public function attachments()
    {
        return $this->hasMany(InvoiceAttachment::class, 'invoice_id');
    }
}
