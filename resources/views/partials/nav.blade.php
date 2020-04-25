<div class="wrapper">

<!-- SIDEBAR -->
<div class="sidebar" data-color="purple" data-background-color="white" data-image="{{asset('/img/sidebar-1.jpg')}}">
    <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
    <div class="logo">
        <a href="{{ config('app.url') }}" class="simple-text logo-normal">
            <img src="{{ asset('/img/logo.png') }}" alt="" width="40" height="40">
            {{ config('app.name') }}
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="nav-item {{ set_active_route('home') }}  ">
                <a class="nav-link" href="{{ route('home') }}">
                <i class="fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item {{ set_active_route('project') }}">
                <a class="nav-link" href="{{ route('project.index') }}">
                <i class="fas fa-folder-open"></i>
                <p>Projets</p>
                </a>
            </li>
            <li class="nav-item {{ set_active_route('learning') }}">
                <a class="nav-link" href="{{ route('learning.index') }}">
                <i class="fas fa-graduation-cap"></i>
                <p> Formations </p>
                </a>
            </li>
            <li class="nav-item {{ set_active_route('expertise') }}">
                <a class="nav-link" href="{{ route('expertise.index') }}">
                    <i class="fas fa-award"></i>
                    <p>Compétences</p>
                </a>
            </li>
            <li class="nav-item {{ set_active_route('notification') }}">
                <a class="nav-link" href="{{ route('notification') }}">
                <i class="fas fa-bell"></i>
                <p>Notifications  {!! get_new_notification()->count() != 0 ? "<span class='badge badge-danger'>".get_new_notification()->count()."</span>" : ''!!} </p>
                </a>
            </li>
            <li class="nav-item {{ set_active_route('profil') }}">
                <a class="nav-link" href="{{ route('profil') }}">
                    <i class="fas fa-user"></i>
                    <p>Profil</p>
                </a>
            </li>
            <li class="nav-item {{ set_active_route('setting') }}">
                <a class="nav-link" href="{{ route('setting') }}">
                <i class="fas fa-cog"></i>
                <p>Paramètres</p>
                </a>
            </li>
            <li class="nav-item active-pro ">
                <a class="dropdown-item" href="#"
                    onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                    <p><i class="fas fa-power-off"> </i> &nbsp; Se déconnecter</p>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                </a>
            </li>
        </ul>
    </div>
</div>

<!-- NAVBAR -->
<div class="main-panel">
    <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
            <div class="navbar-wrapper">
                <h1 style="font-weight:bold; font-size:30px; text-transform:uppercase; color:blueviolet;">
                    <a class="" href="#">
                        {{ $title ?? '' }}
                    </a>
                </h1>
            </div>

            <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                <span class="sr-only">Toggle navigation</span>
                <span class="navbar-toggler-icon icon-bar"></span>
                <span class="navbar-toggler-icon icon-bar"></span>
                <span class="navbar-toggler-icon icon-bar"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end">
                <form class="navbar-form">
                    <div class="input-group no-border">
                        <input type="text" value="" class="form-control" placeholder="Search...">
                        <button type="submit" class="btn btn-white btn-round btn-just-icon">
                        <i class="fas fa-search"></i>
                        <div class="ripple-container"></div>
                        </button>
                    </div>
                </form>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-bell" style="font-size:20px;">  </i>
                            {!! get_new_notification()->count() != 0 ? "<span class='notification'>".get_new_notification()->count()."</span>" : ''!!}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                            @if (get_new_notification()->count() != 0)
                                @foreach (get_new_notification() as $notification)
                                    <a class="dropdown-item" href="{{route('notification')}}"> <i class="fas fa-circle text-{{ $notification->read == 0 ? 'danger' : ''  }}" style="font-size:10px;"></i> &nbsp; {{$notification->name}} </a>
                                @endforeach
                            @else
                                <br>
                                <p class="text-center"> Pas de nouvelle notification </p>
                            @endif
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item " style="padding: 5px 70px;" href="{{ route('notification') }}"> Voir toute les notifications</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#pablo" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="text-transform:none">
                            <img src="{{set_user_profil_picture(Auth::user()->picture)}}" alt="profil_picture" height=45 width=45 class="rounded-circle">
                            {{ ucfirst(Auth::user()->username) }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                            <a class="dropdown-item" href="{{ route('profil') }}"> <i class="fas fa-user"></i> &nbsp; Profil</a>
                            <a class="dropdown-item" href="{{ route('setting') }}"> <i class="fas fa-cog"></i> &nbsp; Paramètres</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#"
                                onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                <i class="fas fa-power-off"></i> &nbsp; Se déconnecter
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>



