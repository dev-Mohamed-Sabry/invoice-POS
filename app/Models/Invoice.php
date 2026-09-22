<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'invoice_number',
        'invoice_date',
        'due_date',
        'section_id',
        'product_id',
        'amount_collection',
        'commission_rate',
        'amount_commission',
        'rate_vat',
        'value_vat',
        'total',
        'note',
        'image',
    ];

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
