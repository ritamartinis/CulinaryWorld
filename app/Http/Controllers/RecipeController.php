<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Recipe;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecipeController extends Controller
{
    public function index()
    {
        //show all recipes with the category
        $allRecipes = Recipe::with('category')->get();

        // Get the latest recipe
        $latestRecipe = Recipe::latest()->first();

        //just 9 for the featured-carousel
        $recentRecipes = Recipe::orderBy('created_at', 'desc')->take(9)->get();

        // show 6 categories
        $categories = Category::all()->take(4);

        return view('recipes.index', compact('allRecipes', 'recentRecipes', 'latestRecipe', 'categories'));
    }

    public function show(Recipe $recipe)
    {
        //show one recipe
        return view('recipes.recipe', compact('recipe'));
    }

    public function recipes()
    {
        // Get all recipes per page
        $recipes = Recipe::paginate(12);

        return view('recipes.recipes', compact('recipes'));
    }


    public function storeComment(Request $request, Recipe $recipe)
    {
        $request->validate([
            'body' => ['required'],
            'rating' => ['required', 'integer', 'min:1', 'max:5']

        ]);

        Comment::create([
            'user_id' => auth()->id(),
            'recipe_id' => $recipe->id,
            'body' => $request->body,
            'rating' => $request->rating
        ]);

        return back()->with('success', 'Your review has been posted!');
    }

    public function categories()
    {
        // Get all categories per page
        $categories = Category::paginate(12);

        return view('categories.categories', compact('categories'));
    }

    public function showCategory(Category $category)
    {
        // Get all recipes for the given category
        $recipes = $category->recipes()->paginate(12);

        return view('categories.category', compact('category', 'recipes'));
    }

    //Favorite Recipes
    public function addFavorite(Recipe $recipe)
    {
        Auth::user()->favorites()->attach($recipe->id);
        return back()->with('success', 'The recipe has been added to your favorites!');
    }

    public function removeFavorite(Recipe $recipe)
    {
        Auth::user()->favorites()->detach($recipe->id);
        return back()->with('success', 'The recipe has been removed from your favorites!');
    }
}
