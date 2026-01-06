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
        Schema::create('csrs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            $table->longText('content');

            // Category - menggunakan enum langsung karena hanya 3 kategori
            $table->enum('category', ['social', 'environment', 'quality']);

            $table->string('featured_image')->nullable();
            $table->string('thumbnail_image')->nullable();
            $table->json('gallery_images')->nullable();

            // Program details
            $table->integer('beneficiaries_count')->nullable();
            $table->decimal('budget', 15, 2)->nullable();
            $table->string('location')->nullable();
            $table->year('year')->nullable();
            $table->string('duration')->nullable();

            // Program results
            $table->text('achievements')->nullable();
            $table->json('impact_metrics')->nullable();
            $table->text('testimonials')->nullable();
            $table->string('partners')->nullable();
            $table->json('team_members')->nullable();

            // Status & publishing
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            $table->dateTime('published_at')->nullable();

            // SEO
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();

            // Engagement metrics
            $table->integer('views')->default(0);
            $table->integer('likes')->default(0);
            $table->integer('shares')->default(0);

            // Ordering
            $table->integer('sort_order')->default(0);

            // User references
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();

            $table->softDeletes();
            $table->timestamps();

            // Indexes for performance
            $table->index(['status', 'published_at']);
            $table->index('category');
            $table->index('year');
            $table->index('sort_order');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('csrs');
    }
};
