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
        Schema::create('report_templates', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('report_template_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('report_template_id')->constrained('report_templates')->onDelete('cascade');
            $table->foreignId('lab_test_id')->nullable()->constrained('lab_tests')->onDelete('set null');
            $table->string('category')->default('General');
            $table->string('subcategory')->nullable();
            $table->string('name');
            $table->string('unit')->nullable();
            $table->string('normal_value')->nullable();
            $table->text('biological_reference')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report_template_items');
        Schema::dropIfExists('report_templates');
    }
};
