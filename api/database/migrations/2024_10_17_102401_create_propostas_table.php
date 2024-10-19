<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('propostas', function (Blueprint $table) {
            $table->id();
            $table->integer("envestimentos")->default(0);
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); 
            $table->foreignId('startup_id')->constrained('startup')->onDelete('cascade'); 
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('propostas');
    }
};
