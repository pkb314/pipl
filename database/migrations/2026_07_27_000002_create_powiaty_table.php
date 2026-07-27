<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('powiaty', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wojewodztwo_id')->constrained('wojewodztwa')->cascadeOnDelete();
            $table->string('nazwa');
            $table->timestamps();

            $table->unique(['wojewodztwo_id', 'nazwa']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('powiaty');
    }
};
