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
            $table->integer('leader_id');
            $table->string('team_name', 25)->unique();
            $table->string('description', 75);
            $table->dateTime('created_at');
            $table->integer('status')->default('1');
            $table->integer('deleted')->default('0');
        });

        Schema::create('topic', function (Blueprint $table) {
            $table->id();
            $table->integer('book_id');
            $table->string('title', 30);
            $table->string('description', 255);
            $table->integer('created_by');
            $table->integer('team_id');
            $table->dateTime('created_at', 25);
            $table->integer('taken_by')->default('0');
            $table->integer('taken_at');
            $table->integer('completed_at');
            $table->integer('status')->default('0');
            $table->integer('deleted')->default('0');
        });

        Schema::create('discussion', function (Blueprint $table) {
            $table->id();
            $table->string('content', 100);
            $table->integer('book_id');
            $table->integer('created_by');
            $table->dateTime('created_at');
            $table->integer('deleted')->default('0');
        });

        Schema::create('comment', function (Blueprint $table) {
            $table->id();
            $table->string('content', 100);
            $table->integer('discussion_id');
            $table->integer('created_by');
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
