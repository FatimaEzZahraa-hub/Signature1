<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('signataires', function (Blueprint $table) {
            $table->string('telephone')->nullable()->after('email');
        });
    }

    public function down()
    {
        Schema::table('signataires', function (Blueprint $table) {
            $table->dropColumn('telephone');
        });
    }
}; 