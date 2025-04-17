<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // 👈 Ajout ici
            $table->string('titre');
            $table->text('description')->nullable();
            $table->string('fichier');
            $table->date('due_date')->nullable();
            $table->enum('status', ['en attente', 'signé', 'brouillon'])->default('brouillon');
            $table->timestamps();
        });        
    }

    public function down()
    {
        Schema::dropIfExists('documents');
    }
} 