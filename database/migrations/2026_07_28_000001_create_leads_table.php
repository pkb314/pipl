<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('surname', 50);
            $table->string('company', 100);
            $table->string('adres', 255);
            $table->string('gmina', 100);
            $table->string('powiat', 100)->nullable();
            $table->string('wojewodztwo', 100)->nullable();
            $table->string('email');
            $table->string('phone');
            $table->string('status')->default('pending');
            $table->integer('bitrix_contact_id')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
