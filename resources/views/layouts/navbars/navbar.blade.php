@auth()
    @include('layouts.navbars.navs.auth_dashboard')
@endauth

@guest()
    @include('layouts.navbars.navs.guest')
@endguest

