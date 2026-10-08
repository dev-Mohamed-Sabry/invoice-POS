<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contract_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('contract_id')
                ->constrained('contracts')
                ->restrictOnDelete();

            $table->foreignId('product_id')
                ->constrained('products')
                ->restrictOnDelete();

            // Snapshot لبيانات المنتج وقت إنشاء العقد
            $table->string('product_name');

            // المنتجات تباع بوحدات صحيحة
            $table->unsignedInteger('quantity')->default(1);

            // السعر النقدي النهائي للمنتج (شامل VAT إذا كان خاضعًا)
            $table->decimal('cash_product_price', 12, 2);
            $table->decimal('cash_total', 12, 2);

            // فائدة التقسيط
            $table->decimal('interest_rate', 5, 2)->default(0);
            $table->decimal('interest_amount', 12, 2)->default(0);

            // المصاريف الإدارية
            $table->decimal('administrative_fees', 12, 2)->default(0);

            // إجمالي التقسيط
            $table->decimal('installment_total', 12, 2)->default(0);
            $table->unsignedInteger('installment_months')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contract_items');
    }
};
