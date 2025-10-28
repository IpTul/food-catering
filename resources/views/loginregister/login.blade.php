<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="{{ asset('css/login.css') }}">
  <title>Login</title>
</head>

<body>
  @if ($errors->any())
  <div class="error-message">
    {{ $errors->first() }}
  </div>
  @endif

  <form method="POST" action="{{ route('login.attempt') }}">
    @csrf
    <h1>Login</h1>
    <div>
      <label for="email">Email</label>
      <input id="email" type="email" name="email" required autofocus />
    </div>
    <div>
      <label for="password">Password</label>
      <input id="password" type="password" name="password" required />
    </div>
    <a href="{{ route('register.show') }}">Register</a>
    <button type="submit">Login</button>
  </form>
</body>

</html>