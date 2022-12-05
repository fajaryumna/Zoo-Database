<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav container ">
                <a class="nav-link" href="{{ route('service.index') }}">Service Info</a>
                <a class="nav-link" href="{{ route('zoo_keeper.index') }}">Zoo Keeper</a>
                <a class="nav-link" href="{{ route('cage.index') }}">Cage</a>
                <a class="nav-link" href="{{ route('animal.index') }}">Animal</a>
                <div class="ms-auto">
                    <a href="{{ route('logout') }}" class=" btn btn-danger btn-block">Logout</a>
                </div>
            </div>

        </div>
    </div>
</nav>