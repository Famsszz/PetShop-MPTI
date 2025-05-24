<nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav mr-auto">
          <li style="color: rgb(255, 255, 255); margin-top:5px;"><a class="dropdown-item" href="/"><b></b><i class="bi bi-house-door-fill" style="font-size: 25px;"></i></a></li>
          <ul class="navbar-nav">
            @if (Route::has('login'))
            <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
              @auth
              <div style="margin-bottom: -25px; margin-top:-13px; margin-left: 10px;">
                <li class="nav-item dropdown" style="cursor:pointer;">
                  <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" style="margin: 0; padding: 0;">
                    {{ Auth::user()->Nama_Pengguna }}
                  </a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" style="margin-left: 8px;" href="/profile">{{ __('Profile') }}</a></li>
                    <li>
                      <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-dropdown-link style="text-decoration: none;" :href="route('logout')" onclick="event.preventDefault();
                                      this.closest('form').submit();">
                          {{ __('Log Out') }}
                        </x-dropdown-link>
                      </form>
                    </li>
                  </ul>
                </li>
              </div>
            </div>
            <div style="margin-bottom:-50px; margin-top:8px;"><a href="/keranjang"><i class="bi bi-cart" style="color:white; margin-left:10px; font-size:larger"></i></a></div>
            <div style="margin-bottom:-50px; margin-top:8px;"><a href="/penitipan"><img src="/images/animal-care_6915431.png" alt="" height="20px;" style="margin-left: 10px;"></a></div>
            @else
              <li class="nav-item" style="margin-bottom: -25px; margin-top:-20px;">
                <a class="nav-link active" style="color: white;" aria-current="page" href="{{ route('login') }}">Login</a>
              </li>
              @endauth
            </div>
            @endif
          </ul>
        </ul>
      </div>
    </div>
  </nav>