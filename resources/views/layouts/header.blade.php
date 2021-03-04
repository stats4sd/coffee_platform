<!-- Navigation / Header Bar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark h-100">
        <a class="navbar-brand" href="#" class="px-4"><h1 class="big-title">SSCF Initiative</h1></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link @if(Route::currentRouteName() === 'home') active @endif" href="{{ route('home') }}">Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(Route::currentRouteName() === 'partners') active @endif" href="{{ route('partners') }}">Partners</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(Route::currentRouteName() === 'reports') active @endif" href="{{ route('reports') }}">Reports</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(Route::currentRouteName() === 'indicators') active @endif" href="{{ route('indicators') }}">Indicator Hub</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('backpack') }}">Admin Panel</a>
                </li>
            </ul>
        </div>
</nav>