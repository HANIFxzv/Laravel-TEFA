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
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user'); // Perbaikan dari interger ke integer
            $table->string('image')->nullable(); // Menambahkan nullable jika diperlukan
            $table->bigInteger('nis'); // Perbaikan dari bigInterger ke bigInteger
            $table->string('tingkatan');
            $table->string('jurusan');
            $table->string('kelas');
            $table->bigInteger('hp'); // Perbaikan dari bigInterger ke bigInteger
            $table->integer('status'); // Perbaikan dari Interger ke integer
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};