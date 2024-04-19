{{-- @dd(Request::path()) --}}
<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true"
    data-img="app-assets/images/backgrounds/04.jpg">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row position-relative">
            <li class="nav-item mr-auto">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <h5 class="brand-text">Prediksi Pupuk</h5>
                </a>
            </li>
            <li class="nav-item d-md-none">
                <a class="nav-link close-navbar"><i class="ft-x"></i></a>
            </li>
        </ul>
    </div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="nav-item">
                <a class="nav-link {{ Request::path() == '/' ? 'active' : '' }}" href="{{ url('/') }}"><i
                        class="ft-home"></i><span class="menu-title" data-i18n="">Dashboard</span></a>
            </li>
            <li class="nav-item"><a href="#"><i class="ft-pie-chart"></i><span class="menu-title"
                        data-i18n="">Dataset</span></a>
                <ul class="menu-content">
                    <li class="{{ Request::path() == 'urea' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('/urea') }}"><span class="menu-title"
                                data-i18n="">Urea</span></a>
                    </li>
                    <li class="{{ Request::path() == 'phonska' ? 'active' : '' }}">
                        <a class="nav-link " href="{{ url('/phonska') }}"><span class="menu-title"
                                data-i18n="">Phonska</span></a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::path() == 'forecasting' ? 'active' : '' }}"
                    href="{{ url('/forecasting') }}"><i class="ft-bar-chart-2"></i><span class="menu-title"
                        data-i18n="">Forecasting</span></a>
            </li>

        </ul>
    </div>
    <div class="navigation-background"></div>
</div>
