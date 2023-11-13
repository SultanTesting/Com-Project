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
        <li class="dropdown {{Route::is('admin.dashboard') ? 'active' : ''}}">
            <a href="{{route('admin.dashboard')}}" class="nav-link">
                <i class="fas fa-fire"></i><span>Dashboard</span>
            </a>
        </li>

        <li class="menu-header">Category Manage</li>
        <li class="dropdown active">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Manage Categories</span></a>
          <ul class="dropdown-menu">

            <li class="{{Route::is('admin.category.index') ? 'active' : ''}}">
                <a class="nav-link" href="{{route('admin.category.index')}}">Category</a>
            </li>

            <li class="{{Route::is('admin.sub-category.index') ? 'active' : ''}}">
                <a class="nav-link" href="{{route('admin.sub-category.index')}}">Sub-Category</a>
            </li>

            <li class="{{Route::is('admin.child-category.index') ? 'active' : ''}}">
                <a class="nav-link" href="{{route('admin.child-category.index')}}">Child-Category</a>
            </li>

          </ul>
        </li>

        <li class="menu-header">Products Manage</li>
        <li class="dropdown active">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Manage Website</span></a>
          <ul class="dropdown-menu">
            <li class="{{Route::is('admin.slider.index') ? 'active' : ''}}">
                <a class="nav-link" href="{{route('admin.slider.index')}}">Products</a>
            </li>
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
