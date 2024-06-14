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
        Schema::create('book', function (Blueprint $table) {
            $table->id();
            $table->string('title', 10);
            $table->string('cover', 10)->default("");
            $table->longText('content');
            $table->integer('created_by');
            $table->integer('owned_by');
            $table->dateTime('created_at');
            $table->integer('status')->default('1');
            $table->integer('deleted')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book');
    }
};
