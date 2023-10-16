<div class="main-sidebar sidebar-style-2">

    <aside id="sidebar-wrapper">

      <div class="sidebar-brand">
        <a href="{{route('admin.dashboard')}}">Stisla</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="index.html">St</a>
      </div>
      <ul class="sidebar-menu">

        <li class="menu-header">Dashboard</li>
        <li class="dropdown active">
          <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
          <ul class="dropdown-menu">
            <li class="{{Route::is('admin.dashboard') ? 'active' : ''}}"><a class="nav-link" href="{{route('admin.dashboard')}}">General Dashboard</a></li>
            <li><a class="nav-link" href="index.html">Ecommerce Dashboard</a></li>
          </ul>
        </li>

        <li class="menu-header">Starter</li>
        <li class="dropdown active">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Manage Website</span></a>
          <ul class="dropdown-menu">
            <li class="{{Route::is('admin.slider.index') ? 'active' : ''}}"><a class="nav-link" href="{{route('admin.slider.index')}}">Products</a></li>

          </ul>
        </li>

        {{-- <li>
            <a class="nav-link" href="blank.html"><i class="far fa-square"></i>
                <span>Blank Page</span>
        </a>
        </li> --}}

      </ul>

    </aside>

</div>
