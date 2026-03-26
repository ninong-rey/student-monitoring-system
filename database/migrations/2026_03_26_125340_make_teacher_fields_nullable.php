<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('teachers', function (Blueprint $table) {
            $table->string('employee_id')->nullable()->change();
            $table->string('phone')->nullable()->change();
            $table->string('department')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('teachers', function (Blueprint $table) {
            $table->string('employee_id')->nullable(false)->change();
            $table->string('phone')->nullable(false)->change();
            $table->string('department')->nullable(false)->change();
        });
    }
};