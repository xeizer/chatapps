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
        Schema::create('semuaobrolans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('dari')->unsigned();
            $table->bigInteger('tujuan')->unsigned();
            $table->text('pesan')->nullable();
            $table->boolean('sudahbaca')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('semuaobrolans');
    }
};
