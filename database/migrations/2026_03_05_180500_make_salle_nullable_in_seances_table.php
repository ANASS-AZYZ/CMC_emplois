<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('seances', function (Blueprint $table) {
            $table->dropForeign(['salle_id']);
        });

        Schema::table('seances', function (Blueprint $table) {
            $table->unsignedBigInteger('salle_id')->nullable()->change();
        });

        Schema::table('seances', function (Blueprint $table) {
            $table->foreign('salle_id')->references('id')->on('salles')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('seances', function (Blueprint $table) {
            $table->dropForeign(['salle_id']);
        });

        Schema::table('seances', function (Blueprint $table) {
            $table->unsignedBigInteger('salle_id')->nullable(false)->change();
        });

        Schema::table('seances', function (Blueprint $table) {
            $table->foreign('salle_id')->references('id')->on('salles')->cascadeOnDelete();
        });
    }
};
