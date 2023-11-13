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
        <li class="dropdown {{ setActive(['admin.dashboard']) }}">
            <a href="{{route('admin.dashboard')}}" class="nav-link">
                <i class="fas fa-fire"></i><span>Dashboard</span>
            </a>
        </li>

        <li class="menu-header">Categories Section</li>

        <li class="dropdown {{ setActive([
            'admin.category.*',
            'admin.sub-category.*',
            'admin.child-category.*'
        ]) }}">

          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
            <i class="fas fa-columns"></i> <span>Manage Categories</span>
          </a>

          <ul class="dropdown-menu">

            <li class="{{ setActive(['admin.category.*']) }}">
                <a class="nav-link" href="{{route('admin.category.index')}}">Category</a>
            </li>

            <li class="{{ setActive(['admin.sub-category.*']) }}">
                <a class="nav-link" href="{{route('admin.sub-category.index')}}">Sub-Category</a>
            </li>

            <li class="{{ setActive(['admin.child-category.*']) }}">
                <a class="nav-link" href="{{route('admin.child-category.index')}}">Child-Category</a>
            </li>

          </ul>
        </li>

        <li class="menu-header">Products Section</li>

        <li class="dropdown {{ setActive([ 'admin.slider.*' ]) }}">

          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
            <i class="fas fa-columns"></i> <span>Manage Website</span>
          </a>

          <ul class="dropdown-menu">

            <li class="{{ setActive(['admin.slider.*']) }}">
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
