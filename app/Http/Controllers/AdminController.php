<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Recipe;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function recipes()
    {
        $recipes = Recipe::with('category')->paginate(8);
        $categories = Category::all();
        return view('admin.recipes-list', compact('recipes', 'categories'));
    }

    //stores que recipe that the admin added to the list
    public function storeRecipe(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string', 'min:5', 'max:255', 'regex:/^[a-zA-Z\s]+$/'],
            'category_id' => ['required', Rule::exists('categories', 'id')],
            'image' => ['required', 'image', 'max:2048'],
            'description' => ['required', 'string', 'min:20'],
            'ingredients' => ['required', 'string', 'min:20'],
            'instructions' => ['required', 'string', 'min:40'],
            'prep_time' => ['required', 'integer'],
            'is_approved' => ['nullable', 'boolean']
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('modal_id', 'addRecipeModal')
                ->with('error', 'There was a problem adding the recipe. Please try again.');
        }

        $attributes = $validator->validated();
        $attributes['user_id'] = auth()->id();
        $attributes['image'] = $request->file('image')->store('recipe_images', 'public');

        Recipe::create($attributes);

        if ($request->ajax()) {
            return response()->json(['success' => 'Recipe has been added successfully!']);
        }

        return redirect()->route('admin.recipes')->with('success', 'Recipe has been added successfully!');
    }

    public function updateRecipe(Request $request, Recipe $recipe)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]+$/'],
            'category_id' => ['required', Rule::exists('categories', 'id')],
            'image' => ['nullable', 'image', 'max:2048'],
            'description' => ['required', 'string', 'min:20'],
            'ingredients' => ['required', 'string', 'min:20'],
            'instructions' => ['required', 'string', 'min:40'],
            'prep_time' => ['required', 'integer'],
            'is_approved' => ['nullable', 'boolean']
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('modal_id', 'editRecipeModal' . $recipe->id)
                ->with('error', 'There was a problem updating the recipe. Please try again.');
        }

        $attributes = $validator->validated();

        if ($request->hasFile('image')) {
            $attributes['image'] = $request->file('image')->store('recipe_images', 'public');
        }

        $recipe->update($attributes);

        if ($request->ajax()) {
            return response()->json(['success' => 'Recipe has been updated successfully!']);
        }

        return redirect()->route('admin.recipes')->with('success', 'Recipe has been updated successfully!');
    }


    public function destroyRecipe(Recipe $recipe)
    {
        $recipe->delete();
        return redirect()->route('admin.recipes')->with('success', 'Recipe has been deleted successfully!');
    }

    public function categories()
    {
        $categories = Category::paginate(4);
        return view('admin.categories-list', compact('categories'));
    }

    public function storeCategory(Request $request)
    {
        $attributes = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'image' => ['required', 'image', 'max:2048'],
        ]);

        $attributes['image'] = $request->file('image')->store('category_images', 'public');

        Category::create($attributes);

        return redirect()->route('admin.categories')->with('success', 'Category has been added successfully!');
    }

    public function updateCategory(Request $request, Category $category)
    {
        $attributes = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('image')) {
            $attributes['image'] = $request->file('image')->store('category_images', 'public');
        }

        $category->update($attributes);

        return redirect()->route('admin.categories')->with('success', 'Category has been updated successfully!');
    }

    public function destroyCategory(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.categories')->with('success', 'Category has been deleted successfully!');
    }

    public function users()
    {
        $users = User::all();
        return view('admin.users-list', compact('users'));
    }

    public function comments()
    {
        $comments = Comment::with('user', 'recipe')->paginate(10);
        return view('admin.comments-list', compact('comments'));
    }
}
