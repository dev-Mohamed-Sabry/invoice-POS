<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $fillable = [
        'contract_number',
        'customer_id',
        'user_id',
        'sale_type',
        'contract_date',
        'commission_rate',
        'commission_amount',
        'cash_total',
        'installment_total',
        'down_payment',
        'grace_days',
        'contract_months',
        'late_fee_type',
        'late_fee_value',
        'notes',
        'status',
        'cancellation_reason',
        'cancelled_by',
        'cancelled_at',
        'closed_at',
        'created_by',
    ];

    protected function casts()
    {
        return [
            'contract_date' => 'date',
            'commission_rate' => 'decimal:2',
            'commission_amount' => 'decimal:2',
            'cash_total' => 'decimal:2',
            'installment_total' => 'decimal:2',
            'contract_months' => 'integer',
            'down_payment' => 'decimal:2',
            'late_fee_value' => 'decimal:2',
            'cancelled_at' => 'datetime',
            'closed_at' => 'datetime',
        ];
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function contractItems()
    {
        return $this->hasMany(ContractItem::class);
    }
}