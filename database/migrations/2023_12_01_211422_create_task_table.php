<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Query\Expression;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('task', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->string('description', 1024)->nullable(true);
            $table->unsignedInteger('responsible_id')->nullable(true);
            $table->unsignedTinyInteger('priority')->default(1);
            $table->date('due_date')->nullable(true);
            $table->json('attachments')->default(new Expression('(JSON_ARRAY())'));
            $table->unsignedInteger('creator_id')->nullable(true);
            $table->timestamp('updated_at')->useCurrent();
            $table->timestamp('created_at')->useCurrent();
            $table->foreign('responsible_id')->references('id')->on('user')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('creator_id')->references('id')->on('user')->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task');
    }
};
