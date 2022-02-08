<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use App\Models\Recipe;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $this->seedDummyRecipes();
    }

    public function seedDummyRecipes()
    {
        $this->addRecipe(
            'Scharfe Tomaten-Paprika-Suppe',
            [
                'subtitle' => 'mit überbackenem Käse-Ciabatta',
                'preparation' => 'Wasche ab...',
                'cooking_time' => 40,
                'servings' => 2,
                'total_kcal' => 1000,
            ],
            [
                'Crème Fraîche' => [75, 'Gramm'],
                'Ciabatta' => [250, 'Gramm'],
                'Gelbe Paprika' => [1, 'Stück'],
                'Kirschtomatenpolpa' => [1, 'Dose'],
                'Knoblauchzehe' => [1, 'Stück'],
                'Mozzarella' => [1, 'Stück'],
                'Basilikum' => [10, 'Gramm'],
                'Hartkäse geraspelt' => [20, 'Gramm'],
                'Sriracha Sauce' => [8, 'Milliliter'],
                'Gemüsebrühe' => [4, 'Gramm'],
            ],
        );

        $this->addRecipe(
            'Spätzle mit Bacon',
            [
                'subtitle' => 'in cremiger Kirschtomaten-Babyspinat-Soße',
                'preparation' => 'Wasche ab...',
                'cooking_time' => 30,
                'servings' => 2,
                'total_kcal' => 1000,
            ],
            [
                'Frühlingszwiebel' => [1, 'Stück'],
                'Kirschtomaten' => [150, 'Gramm'],
                'Bacon' => [100, 'Gramm'],
                'Crème Fraîche' => [150, 'Gramm'],
                'Babyspinat' => [50, 'Gramm'],
                'Hartkäse geraspelt' => [40, 'Gramm'],
                'Eierspätzle' => [400, 'Gramm'],
                'Hühnerbrühe' => [4, 'Gramm'],
                'Wasser' => [2, 'Esslöffel'],
            ],
        );

        $this->addRecipe(
            'Schnelle Penne mit Basilikumsoße',
            [
                'subtitle' => 'dazu gegrilltes Gemüse und Pinienkerne',
                'preparation' => 'Wasche ab...',
                'cooking_time' => 40,
                'servings' => 2,
                'total_kcal' => 1000,
            ],
            [
                'Penne' => [250, 'Gramm'],
                'Kochsahne' => [200, 'Gramm'],
                'Basilikum' => [10, 'Gramm'],
                'Gemüsebrühe' => [4, 'Gramm'],
                'Knoblauchzehe' => [1, 'Stück'],
                'Schalotte' => [1, 'Stück'],
                'Rote Spitzpaprika' => [1, 'Stück'],
                'Hartkäse geraspelt' => [80, 'Gramm'],
                'Pinienkerne' => [10, 'Gramm'],
                'Zucchini' => [1, 'Stück'],
                'Hello Buon Appetito' => [2, 'Gramm'],
            ],
        );
    }

    public function addRecipe(string $recipeTitle, array $recipeDetails, array $ingredients)
    {
        $recipe = Recipe::firstOrCreate(
            [
                'title' => $recipeTitle,
            ],
            $recipeDetails,
        );

        collect($ingredients)->each(function ($value, $key) use ($recipe) {
            $ingredient = Ingredient::firstOrCreate(['name' => $key], []);
            [$amount, $unit] = $value;

            $recipe->ingredients()->syncWithoutDetaching([$ingredient->id => compact('amount', 'unit')]);
        });
    }
}
