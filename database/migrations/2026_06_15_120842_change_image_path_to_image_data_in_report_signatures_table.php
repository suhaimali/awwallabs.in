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
        Schema::table('report_signatures', function (Blueprint $table) {
            if (Schema::hasColumn('report_signatures', 'image_path')) {
                $table->dropColumn('image_path');
            }
            if (!Schema::hasColumn('report_signatures', 'image_data')) {
                $table->longText('image_data')->nullable()->after('name');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('report_signatures', function (Blueprint $table) {
            if (Schema::hasColumn('report_signatures', 'image_data')) {
                $table->dropColumn('image_data');
            }
            if (!Schema::hasColumn('report_signatures', 'image_path')) {
                $table->string('image_path')->nullable()->after('name');
            }
        });
    }
};
