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
        Schema::create('menu', function (Blueprint $table) {
            $table->increments('menu_id');
            $table->string('menu_name', 300);
            $table->string('menu_link', 300);
            $table->string('menu_icon', 100)->nullable();
            $table->unsignedInteger('parent_id')->nullable();
            $table->string('create_by', 30);
            $table->timestamp('created_at')->nullable();
            $table->boolean('delete_mark')->default(0);
            $table->string('update_by', 30)->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu');
    }
};
