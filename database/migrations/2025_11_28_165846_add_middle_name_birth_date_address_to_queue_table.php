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
        Schema::table('queue', function (Blueprint $table) {
            $table->string('middle_name', 100)->nullable()->after('first_name');
            $table->date('birth_date')->nullable()->after('issue_date');
            $table->string('address', 255)->nullable()->after('birth_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('queue', function (Blueprint $table) {
            $table->dropColumn(['middle_name', 'birth_date', 'address']);
        });
    }
};
