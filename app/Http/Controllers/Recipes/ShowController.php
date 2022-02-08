<?php

namespace App\Http\Controllers\Recipes;

use App\Http\Controllers\Controller;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ShowController extends Controller
{
    public function __invoke(Recipe $recipe)
    {
        $recipeIngredients = $recipe->ingredients()->orderBy('name')->get();

        $similarRecipes = Recipe::with('ingredients')
            ->withCount([
                'ingredients as ingredients_in_common_count' => function ($query) use ($recipeIngredients) {
                    $query->whereIn('ingredients.id', $recipeIngredients->pluck('id'));
                }
            ])
            ->where('id', '!=', $recipe->id)
            ->orderByDesc('ingredients_in_common_count')
            ->get()
            ->filter(function ($similarRecipe) {
                return $similarRecipe->ingredients_in_common_count > 0;
            })
            ->map(function ($similarRecipe) use ($recipeIngredients) {
                return [
                    'recipe' => $similarRecipe,
                    'ingredients_in_common' => $recipeIngredients->intersect($similarRecipe->ingredients)->values(),
                ];
            });

        return Inertia::render('Recipes/Show', [
            'recipe' => $recipe
                ->load('steps')
                ->setRelation('ingredients', $recipeIngredients),
            'similar_recipes' => $similarRecipes,
        ]);
    }
}
