<div class="app-sidebar sidebar-shadow">
    <div class="app-header__logo">
        <div class="logo-src"></div>
        <div class="header__pane ml-auto">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>
    <div class="app-header__menu">
        <span>
            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                <span class="btn-icon-wrapper">
                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                </span>
            </button>
        </span>
    </div>    
                    <div class="scrollbar-sidebar">
                        <div class="app-sidebar__inner">
                            <ul class="vertical-nav-menu">
                                <li class="app-sidebar__heading">APPLICATIONS</li>
                                <li>
                                    <a href="{{ route('user.index') }}" {{-- class="mm-active" --}}>
                                        <i class="metismenu-icon pe-7s-home"></i>
                                        Mon cabinet
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('user.index') }}" class="">
                                        <i class="metismenu-icon pe-7s-id"></i>
                                        Mes patients
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('act.index') }}" class="">
                                        <i class="metismenu-icon pe-7s-cash"></i>
                                        Mes honoraires
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('act.index') }}" class="">
                                        <i class="metismenu-icon pe-7s-note2"></i>
                                        Mes ordonnances
                                    </a>
                                </li>                                
                                <li>
                                    <a href="{{ route('appointement.index') }}" class="">
                                        <i class="metismenu-icon pe-7s-date"></i>
                                        Mon agenda
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('act.index') }}" class="">
                                        <i class="metismenu-icon pe-7s-config"></i>
                                        Réglages
                                    </a>
                                </li>                                                                                                                        
                                <li class="app-sidebar__heading">MEDIAS</li>
                                <li>
                                    <a href="{{ route('patient.create') }}" class="">
                                        <i class="metismenu-icon pe-7s-video"></i>
                                        Mes videos
                                    </a>
                                </li>    
                                <li>
                                    <a href="{{ route('patient.index') }}" class="">
                                        <i class="metismenu-icon pe-7s-photo"></i>
                                        Mes photos
                                    </a>
                                </li>    
                            </ul>                                                                                                  
                        </div>
                    </div>
</div>           