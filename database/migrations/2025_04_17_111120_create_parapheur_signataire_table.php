<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('parapheur_signataire', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parapheur_id')->constrained()->cascadeOnDelete();
            $table->foreignId('signataire_id')->constrained()->cascadeOnDelete();
            $table->enum('status', ['en_attente', 'signé'])->default('en_attente');
            $table->timestamp('signed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parapheur_signataire');
    }
};
