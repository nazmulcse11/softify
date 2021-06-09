<nav class="navbar navbar-expand-lg navbar-light bg-light">
   <div class="container">
     <a class="navbar-brand" href="{{url('/')}}">Navbar</a>
     <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
       <span class="navbar-toggler-icon"></span>
     </button>
     <div class="collapse navbar-collapse" id="navbarSupportedContent">
       <ul class="navbar-nav me-auto mb-2 mb-lg-0">
         <li class="nav-item">
           <a class="nav-link active" aria-current="page" href="{{ url('/') }}">Home</a>
         </li>
         <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{ url('/cart') }}">Cart</a>
        </li>
        <!-- Authentication Links -->
        @if(Auth::check())
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                My Account
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="{{ url('/user-logout') }}">Logout</a></li>
                <li><a class="dropdown-item" href="javascript:void(0)">Profile</a></li>
              </ul>
            </li>    
            @else
            <li class="nav-item">
              <a class="nav-link active"  href="{{ url('/login-register') }}">Log/Reg</a>
            </li>
            @endif
       </ul>
       <form class="d-flex">
         <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
         <button class="btn btn-outline-success" type="submit">Search</button>
       </form>
     </div>
   </div>
 </nav>