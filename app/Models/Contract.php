<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Contract extends Model
{

    protected $fillable = [
        'contract_number',
        'customer_id',
        'sale_type',
        'contract_date',
        'cash_total',
        'installment_total',
        'down_payment',
        'administrative_fees',
        'finance_amount',
        'vat_amount',
        'commission_amount',
        'grace_days',
        'late_fee_type',
        'late_fee_value',
        'notes',
        'status',
        'created_by',
        'closed_at',
    ];

    // بدون casts كل شيء تقريبًا يرجع كنص (string) من قاعدة البيانات
    protected function casts()
    {
        return [
            'contract_date' => 'date',
            'cash_total' => 'decimal:2',
            'installment_total' => 'decimal:2',
            'down_payment' => 'decimal:2',
            'administrative_fees' => 'decimal:2',
            'finance_amount' => 'decimal:2',
            'vat_amount' => 'decimal:2',
            'commission_amount' => 'decimal:2',
            'late_fee_value' => 'decimal:2',
            'closed_at' => 'datetime',
        ];
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
