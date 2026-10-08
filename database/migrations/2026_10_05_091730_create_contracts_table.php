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
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();

            // بيانات العقد
            $table->string('contract_number')->unique();

            $table->foreignId('customer_id')
                ->constrained('customers')
                ->restrictOnDelete();

            $table->foreignId('user_id')
                ->constrained('users')
                ->restrictOnDelete();

            $table->enum('sale_type', ['cash', 'installment']);
            $table->date('contract_date');

            $table->unsignedInteger('contract_months')->default(0);

            // العمولة
            $table->decimal('commission_rate', 5, 2)->default(0);
            $table->decimal('commission_amount', 12, 2)->default(0);

            // إجماليات العقد
            $table->decimal('cash_total', 12, 2)->default(0);
            $table->decimal('installment_total', 12, 2)->default(0);
            $table->decimal('down_payment', 12, 2)->default(0);

            // قواعد التأخير الخاصة بالعقد
            $table->unsignedInteger('grace_days')->default(0);
            $table->enum('late_fee_type', ['fixed', 'percentage'])->nullable();
            $table->decimal('late_fee_value', 12, 2)->nullable();

            // حالة العقد
            $table->enum('status', [
                'pending',
                'active',
                'completed',
                'cancelled',
            ])->default('pending');

            // بيانات الإلغاء
            $table->text('cancellation_reason')->nullable();
            $table->string('cancelled_by')->nullable();
            $table->timestamp('cancelled_at')->nullable();

            // بيانات الإغلاق
            $table->timestamp('closed_at')->nullable();

            $table->text('notes')->nullable();

            $table->string('created_by');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};