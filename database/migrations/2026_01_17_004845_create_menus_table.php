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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('route')->nullable(); // route name
            $table->string('icon')->nullable(); // fontawesome icon
            $table->integer('order')->default(0); // urutan menu
            $table->string('roles')->nullable(); // role yang boleh lihat, pisahkan koma
            $table->integer('count')->nullable(); // badge count
            $table->unsignedBigInteger('parent_id')->nullable(); // untuk submenu
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
