<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB as DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('c_doctor', function (Blueprint $table) {
            $table->id();
            $table->string('doctorname', 150)->nullable();
            $table->string('address', 150)->nullable();
            $table->string('email', 150)->nullable();
            $table->string('hp', 150)->nullable();

            // doctor detail -> poli_id , schedule_id
            // $table->integer('poli_id')->length(11);

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
        Schema::dropIfExists('c_doctor');
    }
};
