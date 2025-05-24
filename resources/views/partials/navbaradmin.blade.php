<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li>
                    <a class="nav-link dropdown-toggle tes" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->Nama_Pengguna }}
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/profile">{{ __('Profile') }}</a></li>
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
                <li class="nav-item">
                    <a class="nav-link active" style="color: white;" aria-current="page"
                        href="/admindashboard">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" style="color: white;" aria-current="page"
                        href="/kasirdashboard">Kasir</a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link active" style="color: white;" aria-current="page"
                        href="/">user</a>
                </li> --}}



            </ul>
        </div>
    </div>
</nav>