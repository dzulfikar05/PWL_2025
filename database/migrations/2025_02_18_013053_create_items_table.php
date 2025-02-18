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
        Schema::create('items', function (Blueprint $table) {
            $table->id(); //menambahkan kolom id
            $table->string('name'); // menambahkan kolom name bertipe string / varchar
            $table->text('description'); // menambahkan kolom description bertipe text
            $table->timestamps(); // menambahkan kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items'); //menghapus tabel jika tabel sudah ada
    }
};
