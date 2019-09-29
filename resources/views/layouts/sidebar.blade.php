
<ul class="page-sidebar-menu   " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
    


        <li class="nav-item start {{ request()->is('home') ? 'active' : '' }}">
        <a href="{{ route('home') }}" class="nav-link nav-toggle">
                <i class="icon-home"></i>
                <span class="title">{{ trans('general.dashboard') }}</span>         
            </a>       
        </li>

    {{-- <li class="nav-item start {{ request()->is('settings') ? 'active' : '' }}">
        <a href="{{  route('setting') }}" class="nav-link nav-toggle">
            <i class="icon-earphones-alt"></i>            
            <span class="title">{{ trans('general.settings') }}</span>         
        </a>       
    </li> --}}
    
</ul>