<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIngredientRecipeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingredient_recipe', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(\App\Models\Ingredient::class)
                ->references('id')
                ->on('ingredients')
                ->cascadeOnDelete();

            $table->foreignIdFor(\App\Models\Recipe::class)
                ->references('id')
                ->on('recipes')
                ->cascadeOnDelete();

            $table->integer('amount');
            $table->string('unit');

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
        Schema::dropIfExists('ingredient_recipe');
    }
}
