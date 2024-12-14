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
        Schema::table('thread_discussions', function (Blueprint $table) {
            $table->enum('category', ['Matematika', 'Sains', 'Teknologi', 'Komputer', 'Filosofi', 'Lainnya'])->default('Lainnya');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('thread_discussions', function (Blueprint $table) {
            //
        });
    }
};