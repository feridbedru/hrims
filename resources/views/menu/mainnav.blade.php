<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#">
                <i class="fas fa-bars mr-2"></i> {{__('setting.title')}}
            </a>
        </li>
    </ul>

    <ul class="navbar-nav ml-auto">
        <form class="form-inline mr-3" id="language">
            <div class="input-group input-group-sm">
                <select onchange="location = this.value;" name="lang" id="lang" class="form-control ">
                    @if(Config::get('app.locale')=='am')
                    <option hidden="true" value="{{ url('locale/am') }}">አማርኛ</option>
                    @else
                    <option hidden="true" value="{{ url('locale/en') }}">English</option>
                    @endif
                    <option value="{{ url('locale/am') }}">አማርኛ</option>
                    <option value="{{ url('locale/en') }}">English</option>
                </select>
            </div>
        </form>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
              <i class="fas fa-expand-arrows-alt"></i>
            </a>
          </li>

        <li class="nav-item dropdown mr-2">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-comments"></i>
            </a>
        </li>
        <li class="nav-item dropdown mr-2">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
            </a>
        </li>
        <li class="nav-item dropdown mr-3">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-user"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a href="#" class="dropdown-item">
                    {{ auth()->user()->name}}
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item">
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
</nav>
