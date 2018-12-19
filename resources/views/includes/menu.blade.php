

<nav class="navbar navbar-expand-lg navbar-light  bg-dark">

      <a class="navbar-brand text-primary" href="/index">
        Content Creator <br>
        <h6 >Laravel demo</h6>
      </a>
       <ul class="navbar-nav">
         <li class="nav-item">
           <a href="/"><i class="fas fa-home"></i> Home</a>
         </li>
         <li class="nav-item">
           <a href="/register"><i class="fas fa-signature"></i> Register</a>
         </li>
         @auth
                   <li class="nav-item">
                     <a href="/create-entry"><i class="fas fa-plus-square"></i> Create entry</a>
                   </li>

                   <li class="nav-item">

                     <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i> Logout</a>
                     <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>

                   </li>
          @else
                   <li class="nav-item">
                     <a href="/login"><i class="fas fa-sign-in-alt"></i> Sign in</a>

                   </li>


          @endauth



        </ul>

</nav>
