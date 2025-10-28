@extends('layouts.app')

@section('title', 'Catering')

@section('content')
<div class="container">
  <h2 class="section-title">Catalog</h2>
  <div class="list-card">
    <div class="row">
      @foreach($recipes as $recipe)
      <a href="{{ $recipe->stok === 'habis' ? 'javascript:void(0);' : route('catering.show', $recipe->slug) }}"
        class="column {{ $recipe->stok === 'habis' ? 'disabled-card' : '' }}">
        <div class="card">
          <img src="{{ $recipe->thumbnail ? asset('storage/'.$recipe->thumbnail) : 'https://via.placeholder.com/200' }}"
            alt="{{ $recipe->name }}">
          <div class="card-details">
            <h1>{{ $recipe->name }}</h1>
            <p>{{ $recipe->price ?? 'No Price' }} Rp</p>
            <label>{{ $recipe->stok }}</label>
          </div>
        </div>
      </a>
      @endforeach
    </div>
  </div>
</div>
@endsection