<!--=============================
    DASHBOARD MENU START
  ==============================-->
  <div class="wsus__dashboard_menu">
    <div class="wsusd__dashboard_user">
      <img src="{{ asset('frontend/images/dashboard_user.jpg') }}" alt="img" class="img-fluid">
        <p>
            @auth
                {{ Auth::user()->name }}
            @endauth
        </p>
    </div>
  </div>
  <!--=============================
    DASHBOARD MENU END
  ==============================-->
