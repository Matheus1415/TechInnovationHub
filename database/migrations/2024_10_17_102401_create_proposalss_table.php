<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('proposalss', function (Blueprint $table) {
            $table->id();
            $table->integer("investimentos")->default(0);
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); 
            $table->foreignId('startup_id')->constrained('startups')->onDelete('cascade'); 
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('proposalss');
    }
};
