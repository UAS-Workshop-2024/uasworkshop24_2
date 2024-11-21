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
        Schema::create('user', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('id_jenis_user');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
			$table->string('phone')->nullable();
			$table->string('address1')->nullable();
			$table->string('address2')->nullable();
			$table->integer('province_id')->nullable();
			$table->integer('city_id')->nullable();
            $table->integer('postcode')->nullable();
            $table->boolean('is_admin')->default(false);
            $table->timestamps();

            $table->foreign('id_jenis_user')->references('id_jenis_user')->on('jenis_user');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};