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
        Schema::create('setting_menu_user', function (Blueprint $table) {
            $table->increments('no_setting');
            $table->unsignedInteger('id_jenis_user');
            $table->unsignedInteger('menu_id');
            $table->string('create_by', 30);
            $table->timestamp('created_at')->nullable();
            $table->boolean('delete_mark')->default(0);
            $table->string('update_by', 30)->nullable();
            $table->timestamp('updated_at')->nullable();

            $table->foreign('id_jenis_user')->references('id_jenis_user')->on('jenis_user');
            $table->foreign('menu_id')->references('menu_id')->on('menu');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('setting_menu_user');
    }
};
