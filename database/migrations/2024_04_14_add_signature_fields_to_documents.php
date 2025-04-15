<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('documents', function (Blueprint $table) {
            $table->unsignedBigInteger('recipient_id')->nullable()->after('user_id');
            $table->string('status')->default('pending')->after('path');
            $table->string('signature_path')->nullable()->after('status');
            $table->timestamp('signed_at')->nullable();
            $table->timestamp('rejected_at')->nullable();
            
            $table->foreign('recipient_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('documents', function (Blueprint $table) {
            $table->dropForeign(['recipient_id']);
            $table->dropColumn(['recipient_id', 'status', 'signature_path', 'signed_at', 'rejected_at']);
        });
    }
}; 