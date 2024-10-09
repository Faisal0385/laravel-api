<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('attendant_infos', function (Blueprint $table) {
            $table->id();

            $table->string('doctor_id');
            $table->string('venue_id');
            $table->string('full_name');
            $table->string('hotline')->nullable();
            $table->string('address')->nullable();
            $table->string('gender')->nullable();
            $table->string('bod')->nullable();
            $table->string('blood_grp')->nullable();
            $table->string('joining_date');
            $table->string('email')->nullable();
            $table->string('password')->nullable();
            
            $table->string('image')->nullable();
            $table->string('salary')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendant_infos');
    }
};
