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
        Schema::create('employee_leave_masters', function (Blueprint $table) {
            $table->id();
            $table->string('leave_type');
            $table->date('from_date');
            $table->date('to_date');
            $table->integer('number_of_days');
            $table->text('comment')->nullable();
            $table->string('employee_code')->default('');
            $table->foreign('employee_code')->references('employee_code')->on('employee_masters')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_leave_masters');
    }
};
