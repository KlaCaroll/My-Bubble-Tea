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
        Schema::create('drinks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('drinker_name');
            $table->unsignedBigInteger('teas_id');
            $table->unsignedBigInteger('poppings_id')->nullable();
            $table->float('price', 30, 2)->nullable();
            $table->tinyInteger('sugar')->nullable();
            $table->timestamps();
            $table->string('status')->nullable();

            $table->foreign('teas_id')->references('id')->on('teas');
            $table->foreign('poppings_id')->references('id')->on('poppings');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drinks');
    }
};
