<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\RecipeResource;
use App\Models\Recipe;

use Illuminate\Http\Request;

class RecipeController extends Controller
{
    public function index() 
    {
        $recipes = Recipe::with([
            'category',
            'photos',
        ])->get();
        return RecipeResource::collection($recipes);
        return view('catering.catering', compact('recipes'));
    }

    public function show(Recipe $recipe)
    {
        $recipe->load([
            'category',
            'photos',
            // 'tutorials',
            'recipeIngredients.ingredient'
        ]);
        return new RecipeResource($recipe);
        return view('catering.show', compact('recipe'));
    }
}
