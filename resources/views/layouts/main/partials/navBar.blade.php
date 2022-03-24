<nav class="layout-navbar navbar navbar-expand-lg align-items-lg-center bg-facebook-darker navbar-dark " id="layout-navbar">

<!-- Brand demo (see assets/css/demo/demo.css) -->
    <a href="{{ route('home') }}" class="navbar-brand app-brand demo d-lg-none py-0 mr-4">
         <span class="app-brand-text demo font-weight-normal ml-2">{!! config('app.name') !!}</span>
    </a>

    <!-- Sidenav toggle (see assets/css/demo/demo.css) -->
    <div class="layout-sidenav-toggle navbar-nav d-lg-none align-items-lg-center mr-auto">
        <a class="nav-item nav-link px-0 mr-lg-4" href="javascript:void(0)">
            <i class="ion ion-md-menu text-large align-middle"></i>
        </a>
    </div>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#layout-navbar-collapse">
        <i class="fas fa-times"></i>
    </button>

    <div class="navbar-collapse collapse" id="layout-navbar-collapse">
        <!-- Divider -->
        <hr class="d-lg-none w-100 my-2">

        <div class="navbar-nav align-items-lg-center  ">
            <!-- Search -->
        </div>

        <div class="navbar-nav align-items-lg-center ml-auto">
            <div class="demo-navbar-notifications nav-item dropdown mr-lg-3">
                <a class="nav-link dropdown-toggle hide-arrow" href="#" data-toggle="dropdown">
                    <i class="ion ion-md-notifications-outline navbar-icon align-middle"></i>
                    <span class="badge badge-primary badge-dot indicator" id="notifications-badge"></span>
                    <span class="d-lg-none align-middle">&nbsp; Notifications</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" id="notifications-view">
                </div>
            </div>


            <!-- Divider -->
            <div class="nav-item d-none d-lg-block text-big font-weight-light line-height-1 opacity-25 mr-3 ml-1">|</div>

            <div class="demo-navbar-user nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
                  <span class="d-inline-flex flex-lg-row-reverse align-items-center align-middle">
                      <img src="@if($avatarFile = \App\Domain\System\File\File::findByTableAndId('users',Sentinel::getUser()->id)){{ Storage::url($avatarFile->getFullPath()) }}@else {{Storage::url('user-default.png')}} @endif" alt="" class="d-block ui-w-30 rounded-circle">
                    <span class="px-1 mr-lg-2 ml-2 ml-lg-0">{{ getUserName() }}</span>
                  </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a href="{{ route('user.profile') }}" class="dropdown-item">
                        <i class="fas fa-user"></i> &nbsp; Mi Perfil
                    </a>
                    <a href="{{ route('userSettings.index') }}" class="dropdown-item">
                        <i class="fas fa-cog"></i> &nbsp; Opciones de Cuenta
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="/logout" class="dropdown-item">
                        <i class="ion ion-ios-log-out text-danger"></i> Logout
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>
