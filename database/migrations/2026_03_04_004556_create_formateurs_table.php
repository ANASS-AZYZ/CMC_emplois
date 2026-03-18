<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
{
    Schema::create('formateurs', function (Blueprint $table) {
    $table->id();
    $table->string('matricule')->unique();
    $table->string('nom');
    $table->string('prenom');
    $table->string('email_professionnel')->unique(); 
    $table->string('telephone')->nullable();
    $table->string('specialite');
    $table->timestamps();
});
}

    
    public function down(): void
    {
        Schema::dropIfExists('formateurs');
    }
};

