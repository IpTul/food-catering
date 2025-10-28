@extends('layouts.app')

@section('title', 'Welcome Page')

@section('content')
{{-- @auth('customer')
<h1>Selamat Datang, {{ auth('customer')->user()->name }}!</h1>
@endauth
<h1>Welcome</h1> --}}

<div class="welcome-hero">
  <div class="food-decor">🍲</div> <!-- Left floating food emoji -->
  <div class="welcome-content">
    @auth('customer')
    <h1 class="auth-greeting">Selamat Datang, {{ auth('customer')->user()->name }}!</h1>
    @endauth
    <h1 class="general-welcome">Welcome to Our Food Catering</h1>
  </div>
  <div class="food-decor right">🍔</div> <!-- Right floating food emoji -->
</div>
@endsection