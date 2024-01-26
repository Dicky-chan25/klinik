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
        Schema::create('c_medical_record', function (Blueprint $table) {
            $table->id();
            $table->string('code', 150)->nullable();

            $table->integer('patient_id')->length(11);
            $table->integer('doctor_id')->length(11);
            $table->integer('blood_id')->length(11);

            // medicine detail
            // $table->integer('m_detail_id', 11)->nullable();

            $table->string('service', 255)->nullable();
            $table->text('complaint')->nullable();
            $table->text('diagnose')->nullable();
            $table->text('information')->nullable();

            $table->string('weight', 10)->nullable();
            $table->string('height', 10)->nullable();
            $table->string('waist', 10)->nullable();
            
            $table->integer('new_record')->length(1); // 0 => true (new) ; 1 => false (not new)
            $table->integer('status_patient')->length(1); // 0 => inpatient ; 1 => outpatient

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
        Schema::dropIfExists('c_medical_record');
    }
};
