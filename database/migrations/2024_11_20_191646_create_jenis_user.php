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
        Schema::create('jenis_user', function (Blueprint $table) {
            $table->increments('id_jenis_user');
            $table->string('jenis_user', 60);
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
        Schema::dropIfExists('jenis_user');
    }
};
