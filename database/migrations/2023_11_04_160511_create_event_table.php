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
        Schema::create('event', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('action', ['create', 'read', 'update', 'delete']);
            $table->unsignedInteger('user_id');
            $table->string('target', 50);
            $table->unsignedInteger('target_id')->nullable(true);
            $table->json('details')->nullable(true);
            $table->timestamp('created_at')->useCurrent();
            $table->foreign('user_id')->references('id')->on('user')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event');
    }
};
