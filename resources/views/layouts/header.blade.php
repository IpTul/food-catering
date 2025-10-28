<div class="header">
  <a href="{{route('welcome')}}" class="logo">DAPUR YANTI</a>
  <div class="header-right">
    <a href="{{route('catering.catering')}}">Catalog</a>
    <a href="{{route('about')}}">About</a>
    @guest('customer')
    <a href="{{route('login')}}">Login</a>
    @endguest
    @auth('customer')
    <form action="{{ route('logout') }}" method="POST">
      @csrf
      <button type="submit" class="btn-logout">Logout</button>
    </form>
    @endauth
  </div>
</div>