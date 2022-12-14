


<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="/">BDResorts</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0" >
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/">Resorts</a>
              </li>
           
             
        </ul>

        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            
          
                   
   
          @guest
          @if (Route::has('login'))
              <li class="nav-item me-2">
                  <a class="nav-link text-light" href="{{ route('login') }}">{{ __('Login') }}</a>
              </li>
          @endif

 
      @else
          <li class="nav-item dropdown text-light">
              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                  {{ Auth::user()->name }}
              </a>

              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="/logout"
                     onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                      {{ __('Logout') }}
                  </a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                      @csrf
                  </form>
              </div>
          </li>
      @endguest
      @if(Auth::check())
      <li class="nav-item ">
        <a class="nav-link active" aria-current="page" href="/admin">Admin Panel</a>
      </li>
      @endif
          
        </ul>
     
      </div>
    </div>
  </nav>