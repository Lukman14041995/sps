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
        Schema::create('careers', function (Blueprint $table) {
            $table->id();
            $table->string('position');
            $table->string('department');
            $table->text('description');
            $table->text('requirements');
            $table->enum('employment_type', ['full_time', 'part_time', 'contract', 'internship']);
            $table->string('location');
            $table->decimal('salary_min', 10, 2)->nullable();
            $table->decimal('salary_max', 10, 2)->nullable();
            $table->date('application_deadline');
            $table->boolean('is_active')->default(true);
            $table->integer('vacancies')->default(1);
            $table->integer('experience_required')->nullable()->comment('Years of experience');
            $table->json('benefits')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('careers');
    }
};
