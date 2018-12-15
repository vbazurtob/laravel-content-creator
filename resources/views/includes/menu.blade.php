<div class="menubar">
  <span>
    <a href="/">Home</a>

  </span>
  <span>
    <a href="/register">Register</a>

  </span>


          @auth

              <span>
                <a href="/create-entry">Create entry</a>
              </span>

              <span>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>

              </span>
          @else
              <span>
                <a href="/login">Sign in</a>

              </span>


          @endauth

</div>
