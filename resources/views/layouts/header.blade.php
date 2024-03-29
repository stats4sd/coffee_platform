<!-- Navigation / Header Bar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark h-100 pl-4">
        <a class="navbar-brand" href="{{ route('home', session('locale')) }}" class="px-4"><h1 class="big-title d-flex d-sm-none">SSCF</h1><h1 class="big-title d-none d-sm-flex">
            {{ t('State of the Smallholder Coffee Farmer') }}</h1></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="{{ t('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link @if(Route::currentRouteName() === 'home') active @endif" href="{{ route('home', session('locale')) }}">{{ t('Home') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(Route::currentRouteName() === 'about') active @endif" href="{{ route('about', session('locale')) }}">{{ t('About') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(Route::currentRouteName() === 'webinar') active @endif" href="{{ route('webinar', session('locale')) }}">{{ t('Webinar') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(Route::currentRouteName() === 'reports') active @endif" href="{{ route('reports', session('locale')) }}">{{ t('Report') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(Route::currentRouteName() === 'indicators') active @endif" href="{{ route('indicators', session('locale')) }}">{{ t('Indicator Hub') }}</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">{{ t('Change Language') }}</a>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="{{ route(Route::currentRouteName(), 'en') }}">{{ t('English') }}</a>
                      <a class="dropdown-item" href="{{ route(Route::currentRouteName(), 'es') }}">{{ t('Spanish') }}</a>
                    </div>
                  </li>
            </ul>
        </div>
</nav>
