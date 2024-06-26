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
        Schema::create('team_member', function (Blueprint $table) {
            $table->id();
            $table->foreign('team_id')->references('id')->on('team');
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('kicked')->default('0');
            $table->integer('role');
            $table->integer('request_accepted')->default('0');
            $table->integer('deleted')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('team_member');
    }
};
