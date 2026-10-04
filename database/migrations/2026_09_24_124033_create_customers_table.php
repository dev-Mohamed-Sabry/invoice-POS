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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('phone');
            $table->string('secondary_phone')->nullable();

            $table->string('national_id')->unique();
            $table->string('national_id_front')->nullable();
            $table->string('national_id_back')->nullable();

            $table->date('date_of_birth')->nullable();

            $table->text('address');

            $table->string('job')->nullable();
            $table->string('workplace')->nullable();

            $table->string('emergency_contact_name')->nullable();
            $table->string('emergency_contact_phone')->nullable();
            $table->string('emergency_contact_relation')->nullable();

            $table->text('additional_data')->nullable();
            $table->text('notes')->nullable();

            $table->boolean('is_active')->default(true);

            $table->string('created_by');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
