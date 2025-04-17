<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('parapheurs', function (Blueprint $table) {
            $table->id();
            $table->string('nom'); // tu peux adapter les champs selon tes besoins
            $table->text('description')->nullable();
            $table->string('status')->default('en_attente');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parapheurs');
    }
};
