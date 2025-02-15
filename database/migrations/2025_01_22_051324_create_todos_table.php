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
        Schema::create('todos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('content');
            $table->enum('sharing_range', ['share', 'personal']);
            $table->foreignId('completed_by')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('registered_by')->constrained('users')->onDelete('cascade');
            $table->smallInteger('completed')->default(0)->comment('0:未完了 1:完了');
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('todos');
    }
};
