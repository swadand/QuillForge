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
        Schema::create('team', function (Blueprint $table) {
            $table->id();
            $table->string('team_id', 50)->default("");
            $table->foreign('leader_id')->references('id')->on('users');
            $table->string('team_name', 25)->unique();
            $table->string('description', 75);
            $table->dateTime('created_at');
            $table->integer('status')->default('1');
            $table->integer('deleted')->default('0');
        });

        Schema::create('topic', function (Blueprint $table) {
            $table->id();
            $table->foreign('book_id')->references('id')->on('book');
            $table->string('title', 30);
            $table->string('description', 255);
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('team_id')->references('id')->on('team');
            $table->dateTime('created_at', 25);
            $table->foreign('taken_by')->references('id')->on('users');
            $table->integer('taken_at');
            $table->integer('completed_at');
            $table->integer('status')->default('0');
            $table->integer('deleted')->default('0');
        });

        Schema::create('discussion', function (Blueprint $table) {
            $table->id();
            $table->string('content', 100);
            $table->foreign('book_id')->references('id')->on('book');
            $table->foreign('created_by')->references('id')->on('users');
            $table->dateTime('created_at');
            $table->integer('deleted')->default('0');
        });

        Schema::create('comment', function (Blueprint $table) {
            $table->id();
            $table->string('content', 100);
            $table->foreign('discussion_id')->references('id')->on('discussion');
            $table->foreign('created_by')->references('id')->on('users');
            $table->dateTime('created_at');
            $table->integer('deleted')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('team');
        Schema::dropIfExists('topic');
        Schema::dropIfExists('discussion');
        Schema::dropIfExists('comment');
    }
};
