<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('documents', function (Blueprint $table) {
            $table->enum('status', ['Brouillon', 'En attente', 'Signé', 'Annulé'])
                  ->default('Brouillon')
                  ->after('due_date');
        });
    }

    public function down()
    {
        Schema::table('documents', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
