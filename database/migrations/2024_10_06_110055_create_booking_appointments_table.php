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
        Schema::create('booking_appointments', function (Blueprint $table) {
            $table->id();

            $table->string('doctor_id');
            $table->string('venue_id');
            $table->string('asst_id');
            $table->string('patient_id');
            $table->string('visit_id')->unique();
            $table->string('serial_no')->nullable();
            $table->string('full_name');
            $table->string('mobile');
            $table->string('gender')->nullable();
            $table->string('age_day')->nullable();
            $table->string('age_month')->nullable();
            $table->string('age_year');
            $table->string('weight')->nullable();
            $table->string('blood_grp')->nullable();
            $table->string('date');
            $table->string('time')->nullable();
            $table->string('date_day')->nullable();
            $table->string('date_month')->nullable();
            $table->string('date_year')->nullable();
            $table->string('payment_amount')->default(0);
            $table->enum('payment_status', ['paid', 'due', 'cancel'])->default('due');
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_appointments');
    }
};
