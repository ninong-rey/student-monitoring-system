<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->boolean('is_dropped')->default(false)->after('class_id');
            $table->date('drop_date')->nullable()->after('is_dropped');
            $table->string('drop_reason')->nullable()->after('drop_date');
            $table->text('drop_remarks')->nullable()->after('drop_reason');
            $table->foreignId('dropped_by')->nullable()->after('drop_remarks')->constrained('users');
        });
    }

    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn(['is_dropped', 'drop_date', 'drop_reason', 'drop_remarks', 'dropped_by']);
        });
    }
};