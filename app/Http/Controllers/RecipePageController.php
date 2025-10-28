<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Ingredient;

class RecipePageController extends Controller
{
    public function index()
    {
        $recipes = Recipe::with(['category', 'photos'])->get();
        return view('catering.catering', compact('recipes'));
    }

    public function show(Recipe $recipe)
    {
        $recipe->load([
            'category',
            'photos',
            // 'tutorials',
            'recipeIngredients.ingredient',
        ]);
        // dd($recipe->toArray());

        return view('catering.show', compact('recipe'));
    }

    public function buy(Recipe $recipe)
    {
        $recipe->load([
            'category',
            'photos',
            // 'tutorials',
            'recipeIngredients.ingredient',
        ]);

        // $ingredients = Ingredient::all();
        $ingredients = Ingredient::where('stok', '!=', 'habis')->get();
        // dd($recipe->toArray(), $ingredients->toArray());

        return view('catering.buy', compact('recipe', 'ingredients'));
    }
}

