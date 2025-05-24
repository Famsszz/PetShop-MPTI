<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" style="color: white;" aria-current="page" href="/kasirdashboard">Dashboard</a>
                </li>

                @if(Auth::user()->Peran == 'Admin')
                    <li class="nav-item">
                        <!-- Button for admin only -->
                        <a class="nav-link active" style="color: white;" aria-current="page" href="/admindashboard">Admin Dashboard</a>
                    </li>
                @endif

                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a class="nav-link active" style="color: rgb(255, 255, 255);" aria-current="page"
                            href="route('logout')" onclick="event.preventDefault();
                            this.closest('form').submit();">Log Out</a>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
