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
        Schema::create('doctor_infos', function (Blueprint $table) {
            $table->id();

            $table->string('full_name');
            $table->string('mobile');
            $table->string('degree')->nullable();
            $table->string('designation')->nullable();
            $table->string('address')->nullable();
            $table->string('gender')->nullable();
            $table->string('bod')->nullable();
            $table->string('weight')->nullable();
            $table->string('blood_grp')->nullable();
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->string('image')->nullable();
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
        Schema::dropIfExists('doctor_infos');
    }
};
