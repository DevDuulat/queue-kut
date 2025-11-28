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
        Schema::create('queue', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('queue_type');
            $table->tinyInteger('apartment_type');
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('phone_number', 20);
            $table->integer('curator_id')->nullable();
            $table->string('inn', 14)->unique();
            $table->string('document_series', 10)->nullable();
            $table->string('document_number', 7)->unique();
            $table->string('issued_by', 255);
            $table->string('monthly_payment_no_down', 20)->nullable();
            $table->unsignedInteger('custom_monthly_payment')->nullable();
            $table->unsignedBigInteger('down_payment')->nullable();
            $table->unsignedSmallInteger('payment_term')->nullable();
            $table->date('issue_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('queue');
    }
};
