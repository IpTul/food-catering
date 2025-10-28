<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Register</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body class="min-h-screen flex items-center justify-center bg-gray-100">
  <div class="w-full max-w-md bg-white p-6 rounded-xl shadow">

    {{-- Success flash --}}
    @if(session('success'))
    <div class="error-message">
      {{ session('success') }}
    </div>
    @endif

    {{-- Validation errors --}}
    @if ($errors->any())
    <div class="error-message">
      <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('register.store') }}">
      <h1>Create an Account</h1>
      @csrf
      <div>
        <label>Name</label>
        <input type="text" name="name" value="{{ old('name') }}" class="w-full border rounded px-3 py-2" required
          autofocus>
      </div>

      <div>
        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}" class="w-full border rounded px-3 py-2" required>
      </div>

      <div>
        <label>Password</label>
        <input type="password" name="password" class="w-full border rounded px-3 py-2" required>
        <p class="password-hint">Min 8 characters.</p>
      </div>

      <div>
        <label>Confirm Password</label>
        <input type="password" name="password_confirmation" class="w-full border rounded px-3 py-2" required>
      </div>

      <a href="{{route('login')}}">Login</a>

      <button type="submit" class="w-full rounded-lg px-4 py-2 bg-blue-600 text-white font-semibold">
        Register
      </button>
    </form>
  </div>
</body>

</html>