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
        Schema::create('inputs', function (Blueprint $table) {
            $table->id('id_input');
            $table->string('x');
            $table->string('y');
            $table->unsignedBigInteger('id_type')->nullable();
            $table->timestamps();

            // Tambahkan kunci asing
            $table->foreign('id_type')->references('id_type_input')->on('type_inputs')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inputs');
    }
};
