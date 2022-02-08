<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecipeUtensilTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipe_utensil', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(\App\Models\Recipe::class)
                ->references('id')
                ->on('recipes')
                ->cascadeOnDelete();

            $table->foreignIdFor(\App\Models\Utensil::class)
                ->references('id')
                ->on('utensils')
                ->cascadeOnDelete();

            $table->integer('amount')
                ->default(1);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recipe_utensil');
    }
}
