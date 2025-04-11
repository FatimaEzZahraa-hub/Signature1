<?php
//C:\MAMP\htdocs\Signature1\database\migrations\2025_04_10_114415_create_documents_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('path');            // chemin du fichier sur le disque
            $table->enum('status', ['en attente', 'signé', 'annulé'])
                  ->default('en attente');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('documents');
    }
}
