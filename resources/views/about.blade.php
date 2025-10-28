@extends('layouts.app')

@section('title', 'About Us')

@section('content')
<div class="container">
  <h2 class="section-title">Get in Touch</h2>
  <div class="contact-info">
    <h3>We're Here to Help!</h3>
    <p>Email: {{$profile->email}} | Phone: +62 {{$profile->phone}} | Address: {{$profile->address}}</p>
  </div>
</div>

@endsection