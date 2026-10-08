<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContractItem extends Model
{
    protected $fillable = [
        'contract_id',
        'product_id',
        'product_name',
        'quantity',
        'cash_product_price',
        'cash_total',
        'interest_rate',
        'interest_amount',
        'administrative_fees',
        'installment_total',
        'installment_months',
    ];

    protected function casts()
    {
        return [
            'quantity' => 'integer',
            'cash_product_price' => 'decimal:2',
            'cash_total' => 'decimal:2',
            'interest_rate' => 'decimal:2',
            'interest_amount' => 'decimal:2',
            'administrative_fees' => 'decimal:2',
            'installment_total' => 'decimal:2',
            'installment_months' => 'integer',
        ];
    }

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
