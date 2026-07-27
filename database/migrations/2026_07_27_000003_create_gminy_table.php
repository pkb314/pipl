<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gminy', function (Blueprint $table) {
            $table->id();
            $table->foreignId('powiat_id')->constrained('powiaty')->cascadeOnDelete();
            $table->string('nazwa');
            $table->timestamps();

            $table->unique(['powiat_id', 'nazwa']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gminy');
    }
};
