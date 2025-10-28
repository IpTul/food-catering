@extends('layouts.app')

@section('title', $recipe->name)

@section('content')
<div class="container-show">
  <h2 class="section-title">{{$recipe->name}}</h2>

  {{-- Thumbnail --}}
  <div class="thumbnail-wrapper">
    <img src="{{ $recipe->thumbnail ? asset('storage/'.$recipe->thumbnail) : 'https://via.placeholder.com/400' }}"
      alt="{{ $recipe->name }}" class="thumbnail" />
  </div>

  {{-- Basic Info --}}
  <div class="basic-info">
    <p><strong>Name :</strong> {{ $recipe->name }}</p>
    <p><strong>Category :</strong> {{ $recipe->category->name ?? 'Uncategorized' }}</p>
    <p><strong>Price :</strong> {{ $recipe->price ?? 'No Price' }} Rp</p>
    <p><strong>About :</strong> {{ $recipe->about }}</p>
  </div>

  {{-- Photos --}}
  <section class="photos-section">
    <h3>Photos :</h3>
    <div style="photos-wrapper">
      @forelse($recipe->photos as $photo)
      <img src="{{ asset('storage/'.$photo->photo) }}" alt="Recipe photo"
        style="max-width:150px; border:1px solid #ccc; padding:5px;">
      @empty
      <p>No photos available</p>
      @endforelse
    </div>
  </section>

  {{-- Ingredients --}}
  <section class="ingredients-section">
    <h3>Menu :</h3>
    @if($recipe->recipeIngredients->isEmpty())
    <p>No ingredients available</p>
    @else
    <ul>
      @foreach($recipe->recipeIngredients as $ingredient)
      {{-- <li>{{ $ingredient->ingredient->name }} ({{ $ingredient->amount ?? '-' }})</li> --}}
      <li>{{ $ingredient->ingredient->name }}</li>
      @endforeach
    </ul>
    @endif
  </section>

  {{-- BUY Button --}}
  <a href="{{ route('catering.buy', $recipe->slug) }}" class="buy-button">PESAN</a>
</div>
@endsection