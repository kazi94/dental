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
                <li class="app-sidebar__heading">Configuration</li>
                <li>
                    <a href="{{ route('user.index') }}" {{-- class="mm-active" --}}>
                        <i class="metismenu-icon pe-7s-rocket"></i>
                        Utilisateurs
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.index') }}" class="">
                        <i class="metismenu-icon pe-7s-rocket"></i>
                        Profils
                    </a>
                </li>
                <li>
<<<<<<< HEAD
                    <a href="{{ route('act.index') }}" class="">
=======
                    <a href="{{ route('acte.index') }}" class="">
>>>>>>> a3433d2ecbd535b1e67896b2cf4c7a16d59556b3
                        <i class="metismenu-icon pe-7s-rocket"></i>
                        Actes
                    </a>
                </li>                                                                
                <li class="app-sidebar__heading">Patients</li>
                <li>
                    <a href="{{ route('patient.create') }}" class="">
                        <i class="metismenu-icon pe-7s-rocket"></i>
                        Ajouter Patient
                    </a>
                </li>    
                <li>
                    <a href="{{ route('patient.index') }}" class="">
                        <i class="metismenu-icon pe-7s-rocket"></i>
                        Liste des patients
                    </a>
                </li>    
                <li>
<<<<<<< HEAD
                    <a href="{{ route('act.index') }}" class="">
=======
                    <a href="{{ route('acte.index') }}" class="">
>>>>>>> a3433d2ecbd535b1e67896b2cf4c7a16d59556b3
                        <i class="metismenu-icon pe-7s-rocket"></i>
                        Payements
                    </a>
                </li>  
                <li>
                    <a href="{{ route('appointement.index') }}" class="">
                        <i class="metismenu-icon pe-7s-rocket"></i>
                        Calendrier
                    </a>
                </li>  
            </ul>                                                                                                  
        </div>
    </div>
</div>           