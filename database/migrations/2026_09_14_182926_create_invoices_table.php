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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();

            $table->string('invoice_number')->unique();

            $table->date('invoice_date');
            $table->date('due_date');

            $table->foreignId('section_id')
                ->constrained('sections')
                ->restrictOnDelete();

            $table->foreignId('product_id')
                ->constrained('products')
                ->restrictOnDelete();

            $table->decimal('amount_collection', 12, 2);

            $table->decimal('commission_rate', 5, 2);
            $table->decimal('amount_commission', 12, 2);

            $table->decimal('rate_vat', 5, 2)->default(0);
            $table->decimal('value_vat', 12, 2)->default(0);
            $table->decimal('total', 12, 2)->default(0);

            $table->text('note')->nullable();
            $table->string('image')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
