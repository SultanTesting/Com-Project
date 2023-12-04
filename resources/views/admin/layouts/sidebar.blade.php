<div class="main-sidebar sidebar-style-2">

    <aside id="sidebar-wrapper">

      <div class="sidebar-brand">
        <a href="{{route('admin.dashboard')}}">Stisla</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="{{route('admin.dashboard')}}">St</a>
      </div>
      <ul class="sidebar-menu">

        {{-- Dashboard Section --}}

        <li class="menu-header"> @lang("strings.Dashboard") </li>
        <li class="dropdown {{ setActive(['admin.dashboard']) }}">
            <a href="{{route('admin.dashboard')}}" class="nav-link">
                <i class="fas fa-fire"></i><span> {{__("strings.Dashboard")}} </span>
            </a>
        </li>

        {{-- Categories Section --}}

        <li class="menu-header">@lang("strings.CATEGORIES SECTION")</li>

        <li class="dropdown {{ setActive([
            'admin.category.*',
            'admin.sub-category.*',
            'admin.child-category.*'
        ]) }}">

          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
            <i class="fas fa-columns"></i> <span>@lang("strings.Manage Categories")</span>
          </a>

          <ul class="dropdown-menu">

            <li class="{{ setActive(['admin.category.*']) }}">
                <a class="nav-link" href="{{route('admin.category.index')}}">@lang("strings.Category")</a>
            </li>

            <li class="{{ setActive(['admin.sub-category.*']) }}">
                <a class="nav-link" href="{{route('admin.sub-category.index')}}">@lang("strings.Sub-Category")</a>
            </li>

            <li class="{{ setActive(['admin.child-category.*']) }}">
                <a class="nav-link" href="{{route('admin.child-category.index')}}">@lang("strings.Child-Category")</a>
            </li>

          </ul>
        </li>

        {{-- Products Section --}}

        <li class="menu-header">@lang("strings.PRODUCTS SECTION")</li>

        <li class="dropdown {{ setActive([
            'admin.brand.*',
            'admin.products.*'
            ]) }}">

          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
            <i class="fas fa-shopping-cart"></i> <span>@lang("strings.Manage Products")</span>
          </a>

          <ul class="dropdown-menu">

            <li class="{{ setActive(['admin.brand.*']) }}">
                <a class="nav-link" href="{{route('admin.brand.index')}}"> {{__('strings.Brands')}} </a>
            </li>

            <li class="{{ setActive(['admin.products.*']) }}">
                <a class="nav-link" href="{{route('admin.products.index')}}">{{__('strings.Products')}}</a>
            </li>

          </ul>

        </li>

        {{-- WebSite Section --}}


        <li class="menu-header">@lang("strings.WEBSITE SECTION")</li>

        <li class="dropdown {{ setActive([
             'admin.slider.*',
             'admin.vendor-profile.*'
             ]) }}">

          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
            <i class="fas fa-sitemap"></i> <span>@lang("strings.Manage Website")</span>
          </a>

          <ul class="dropdown-menu">

            <li class="{{ setActive(['admin.slider.*']) }}">
                <a class="nav-link" href="{{route('admin.slider.index')}}">@lang("strings.Slider")</a>
            </li>

            <li class="{{ setActive(['admin.vendor-profile.*']) }}">
                <a class="nav-link" href="{{route('admin.vendor-profile.index')}}">@lang("strings.Vendor Profile")</a>
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
