<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('c_patient', function (Blueprint $table) {
            $table->id();     
            $table->string('code', 150)->nullable();
            $table->string('patientname', 255)->nullable();
            $table->string('address', 255)->nullable();
            $table->string('birthdate', 255)->nullable();
            $table->string('birthplace', 255)->nullable();
            $table->string('identity', 255)->nullable();
            $table->string('phone', 15)->nullable();
            $table->string('religion', 150)->nullable();
            $table->string('career', 150)->nullable();
            $table->string('education', 150)->nullable();
            $table->integer('gender')->length(1);
            $table->integer('status')->length(1);
            $table->integer('created_by_id')->length(11);
            $table->integer('updated_by_id')->length(11);
            $table->integer('deleted_by_id')->length(11);
            $table->datetime('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->datetime('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->datetime('deleted_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('c_patient');
    }
};
