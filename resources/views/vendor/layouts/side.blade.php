<div class="dashboard_sidebar">
    <span class="close_icon">
      <i class="far fa-bars dash_bar"></i>
      <i class="far fa-times dash_close"></i>
    </span>

    <a href="{{route('home')}}" class="dash_logo"><img src="{{ asset('frontend/images/vendor-dash.png') }}" alt="logo" class="img-fluid"></a>
    <p class="text-center fs-6 text-secondary fw-bold">{{__('Vendor Dashboard')}}</p>

    <ul class="dashboard_link">

        <li class="text-center">
            @include('components.language-changer')
        </li>

      <li><a class="{{setActive(['vendor.dashboard'])}}" href="{{route('vendor.dashboard')}}">
        <i class="fas fa-tachometer"></i>{{__('Dashboard')}}</a>
      </li>
      <li>
        <a class="{{setActive(['vendor.products.*'])}}" href="{{route('vendor.products.index')}}">
        <i class="fas fa-store"></i> {{__('Products')}}
        </a></li>
      <li>
        <a class="{{setActive(['vendor.shop-profile.index'])}}" href="{{route('vendor.shop-profile.index')}}">
            <i class="fas fa-id-badge"></i>
            {{__('Shop Profile')}}
        </a>
      </li>
      <li><a class="{{setActive(['vendor.profile'])}}" href="{{route('vendor.profile')}}">
       <i class="far fa-user"></i> {{__('Profile')}}</a>
      </li>

      <li>
        <form method="POST" action="{{route('logout')}}">
            @csrf

            <a href="{{route('logout')}}"
            onclick="event.preventDefault();
            this.closest('form').submit();">
                <i class="far fa-sign-out-alt"></i> {{__('Log Out')}}
            </a>

        </form>
      </li>

    </ul>
  </div>
