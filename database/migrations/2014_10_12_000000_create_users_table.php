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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('gender');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('country');
            $table->integer('state');
            $table->integer('division')->nullable();
            $table->string('matchmaker_at')->nullable();
            $table->string('company')->nullable();
            $table->string('round')->nullable();
            $table->string('phone');
            $table->boolean('passport')->nullable();
            $table->boolean('visa')->nullable();
            $table->string('language');
            $table->string('boxrec_id')->nullable();
            $table->string('home_town');
            $table->string('avatar')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};