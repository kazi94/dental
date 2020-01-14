        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="{{ route('home.index') }}" class="site_title"><i class="fa fa-paw"></i> <span>Dental Office Management!</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}+{{ Auth::user()->prenom }}  " alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Bienvenue,</span>
                <h2> {{ Auth::user()->name }} {{ Auth::user()->prenom }} </h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side  main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-home"></i> Configuration <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{ route('user.index') }}">Utilisateurs</a></li>
                      <li><a href="{{ route('user.index') }}">Profils</a></li>
                      <li><a href="{{ route('acte.index') }}">Actes</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-edit"></i> Patients <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{ route('patient.create') }}">Ajouter Patient</a></li>
                      <li><a href="{{ route('patient.index') }}">Liste des patients</a></li>
                      <li><a href="form_validation.html">Payments</a></li>
                      <li><a href="{{ route('appointement.index') }}">Calendrier</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
            </div>
            <!-- /sidebar menu -->
          </div>
        </div>