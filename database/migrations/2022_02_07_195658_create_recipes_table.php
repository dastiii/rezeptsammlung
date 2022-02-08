<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->string('subtitle')
                ->nullable();
            $table->text('preparation')
                ->nullable();
            $table->integer('cooking_time')
                ->nullable();
            $table->smallInteger('servings');
            $table->integer('total_kcal')
                ->nullable();
            $table->string('photo')
                ->nullable();


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
        Schema::dropIfExists('recipes');
    }
}
