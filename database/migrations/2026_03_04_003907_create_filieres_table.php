<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void {
    Schema::create('filieres', function (Blueprint $table) {
        $table->id();
        $table->string('nom');
        $table->enum('niveau', ['1ère année', '2ème année']);
        $table->timestamps();
    });
}

    
    public function down(): void
    {
        Schema::dropIfExists('filieres');
    }
};

