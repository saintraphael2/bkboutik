<aside class="main-sidebar sidebar-dark-primary elevation-2" style="background-color:#3CB371 !important">
    <a href="{{ route('home') }}" class="brand-link">
        <img src="{{asset('images/logo_bk_zed.png')}}"
             alt="Logo"
             class="brand-image img-circle elevation-3">
        <span class="brand-text font-weight-light" style="color:white; font-weight:bold !important;">{{ config('app.name') }}</span>
    </a>

    <div class="sidebar" style="background-color:#3CB371 !important">
        <nav class="mt-2" >
            <ul class="nav nav-pills nav-sidebar flex-column"  data-widget="treeview" role="menu" data-accordion="false">
                @include('layouts.menu')
            </ul>
        </nav>
    </div>

</aside>
