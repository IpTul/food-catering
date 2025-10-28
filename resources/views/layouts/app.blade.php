<!DOCTYPE html>
<html lang="en">

<head>
  <title>@yield('title')</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
  @include('layouts.header')

  <div class="content">
    @yield('content')
  </div>

  @include('layouts.footer')
</body>

</html>