@extends('components.layout')

@section('content')
    <x-main-carousel :recipes="$allRecipes" />
    <x-today-special :latestRecipe="$latestRecipe" />
    <x-featured-carousel :recipes="$recentRecipes" />
    <x-category-cards :categories="$categories" />
@endsection



