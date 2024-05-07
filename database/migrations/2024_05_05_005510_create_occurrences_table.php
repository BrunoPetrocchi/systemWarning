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
        Schema::create('occurrences', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idCity')->unsigned();
            $table->foreign('idCity')->references('id')->on('cities')->onDelete('cascade');

            $table->unsignedBigInteger('idTrash')->unsigned();
            $table->foreign('idTrash')->references('id')->on('trashes')->onDelete('cascade');

            $table->string('description');
            $table->string('zipcode');
            $table->string('street');
            $table->string('district');
            $table->string('locality');
            $table->integer('status'); // 0 ativo - 1 solucionado - 2 outros


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('occurrences');
    }
};
