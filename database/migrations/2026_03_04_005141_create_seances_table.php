<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('seances', function (Blueprint $table) {
        $table->id();
        $table->foreignId('groupe_id')->constrained()->onDelete('cascade');
        $table->foreignId('formateur_id')->constrained()->onDelete('cascade');
        $table->foreignId('salle_id')->constrained()->onDelete('cascade');
        $table->string('jour'); 
        $table->string('creneau'); 
        $table->timestamps();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('seances');
    }
};