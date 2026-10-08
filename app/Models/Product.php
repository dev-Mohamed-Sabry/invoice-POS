<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'product_name',
        'product_price',
        'is_vat_applicable',
        'vat_rate',
        'product_description',
        'product_image',
        'section_id',
        'created_by',
    ];


    protected function casts()
    {
        return [
            'product_price' => 'decimal:2',
            'is_vat_applicable' => 'boolean',
            'vat_rate' => 'decimal:2',
        ];
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function contractItems()
    {
        return $this->hasMany(ContractItem::class);
    }
}