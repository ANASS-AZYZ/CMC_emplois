<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('seances', function (Blueprint $table) {
            $table->string('mode')->default('presentiel')->after('creneau');
            $table->boolean('formateur_present')->default(true)->after('mode');
        });
    }

    public function down(): void
    {
        Schema::table('seances', function (Blueprint $table) {
            $table->dropColumn(['mode', 'formateur_present']);
        });
    }
};
