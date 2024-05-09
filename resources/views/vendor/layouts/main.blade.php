<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densityDpi=device-dpi" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <title>@yield('title', $settings->site_name)</title>

    <link rel="icon" type="image/png" href="{{ asset('frontend/images/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/all.min.css') }} ">
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }} ">
    <link rel="stylesheet" href="{{ asset('frontend/css/select2.min.css') }} ">
    <link rel="stylesheet" href="{{ asset('frontend/css/slick.css') }} ">
    <link rel="stylesheet" href="{{ asset('frontend/css/jquery.nice-number.min.css') }} ">
    <link rel="stylesheet" href="{{ asset('frontend/css/jquery.calendar.css') }} ">
    <link rel="stylesheet" href="{{ asset('frontend/css/add_row_custon.css') }} ">
    <link rel="stylesheet" href="{{ asset('frontend/css/mobile_menu.css') }} ">
    <link rel="stylesheet" href="{{ asset('frontend/css/jquery.exzoom.css') }} ">
    <link rel="stylesheet" href="{{ asset('frontend/css/multiple-image-video.css') }} ">
    <link rel="stylesheet" href="{{ asset('frontend/css/ranger_style.css') }} ">
    <link rel="stylesheet" href="{{ asset('frontend/css/jquery.classycountdown.css') }} ">
    <link rel="stylesheet" href="{{ asset('frontend/css/venobox.min.css') }} ">
    {{-- <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css"/> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap.min.css"/>
    <link rel="stylesheet" href="{{ asset('backend/assets/modules/summernote/summernote-bs4.css') }}">


    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }} ">
    <link rel="stylesheet" href="{{ asset('frontend/css/responsive.css') }} ">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/components.css') }}">

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"/>

    @if (dirSelect() == 'rtl')
        <link rel="stylesheet" href="{{asset('frontend/css/rtl.scss')}}">
    @endif
</head>

<body>


    {{-- NavBar Start --}}


  @include('vendor.layouts.nav')

    {{-- NavBar End --}}



  <!--=============================
    DASHBOARD START
  ==============================-->
  <section id="wsus__dashboard">
    <div class="container-fluid">

      {{-- SideBar Start --}}

      @include('vendor.layouts.side')

      {{-- SideBar End --}}


      {{-- Main Content Start --}}

      @yield('content')

      {{-- Main Content End --}}

    </div>
  </section>
  <!--=============================
    DASHBOARD START
  ==============================-->


  <!--============================
      SCROLL BUTTON START
    ==============================-->
  <div class="wsus__scroll_btn">
    <i class="fas fa-chevron-up"></i>
  </div>
  <!--============================
    SCROLL BUTTON  END
  ==============================-->


  <!--jquery library js-->
  {{-- <script src="{{ asset('frontend/js/jquery-3.6.0.min.js') }}"></script> --}}
  <script src="https://code.jquery.com/jquery-3.7.0.js" ></script>

  <!--bootstrap js-->
  <script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
  <!--font-awesome js-->
  <script src="{{ asset('frontend/js/Font-Awesome.js') }}"></script>
  <!--select2 js-->
  <script src="{{ asset('frontend/js/select2.min.js') }}"></script>
  <!--slick slider js-->
  <script src="{{ asset('frontend/js/slick.min.js') }}"></script>
  <!--simplyCountdown js-->
  <script src="{{ asset('frontend/js/simplyCountdown.js') }}"></script>
  <!--product zoomer js-->
  <script src="{{ asset('frontend/js/jquery.exzoom.js') }}"></script>
  <!--nice-number js-->
  <script src="{{ asset('frontend/js/jquery.nice-number.min.js') }}"></script>
  <!--counter js-->
  <script src="{{ asset('frontend/js/jquery.waypoints.min.js') }}"></script>
  <script src="{{ asset('frontend/js/jquery.countup.min.js') }}"></script>
  <!--add row js-->
  <script src="{{ asset('frontend/js/add_row_custon.js') }}"></script>
  <!--multiple-image-video js-->
  <script src="{{ asset('frontend/js/multiple-image-video.js') }}"></script>
  <!--sticky sidebar js-->
  <script src="{{ asset('frontend/js/sticky_sidebar.js') }}"></script>
  <!--price ranger js-->
  <script src="{{ asset('frontend/js/ranger_jquery-ui.min.js') }}"></script>
  <script src="{{ asset('frontend/js/ranger_slider.js') }}"></script>
  <!--isotope js-->
  <script src="{{ asset('frontend/js/isotope.pkgd.min.js') }}"></script>
  <!--venobox js-->
  <script src="{{ asset('frontend/js/venobox.min.js') }}"></script>
  <!--classycountdown js-->
  <script src="{{ asset('frontend/js/jquery.classycountdown.js') }}"></script>
  <!--SweetAlert js-->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


  <!--DataTables js-->
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js" ></script>
  <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js" ></script>
  <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js" ></script>
  <script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap.min.js" ></script>


  <!--main/custom js-->
  <script src="{{ asset('frontend/js/main.js') }}"></script>

  <!--SummerNote JS-->
  <script src="{{ asset('backend/assets/modules/summernote/summernote-bs4.js') }}"></script>

  <!--Masonry JS-->
  <script async src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js"
    integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D"
    crossorigin="anonymous"></script>

  <script>
   $('.summernote').summernote({
        placeholder: 'Hello Bootstrap 4',
        tabsize: 2,
        height: 100
      });
  </script>

  <!--Toastr Js-->
  <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" ></script>

  <script>
      toastr.options.progressBar = true;
      toastr.options.closeButton = true;

      @if ($errors->any())
        @foreach ($errors->all() as $error )
          toastr.error("{{$error}}")
        @endforeach
      @endif

      @if ($message = session('message'))
        toastr.success("{{ $message }}", "{{__('Success')}}")
      @endif

      @if ($message = session('status'))
          toastr.success("{{ $message }}")
      @endif

  </script>

  <!-- Sweet Alert  -->

  <script>

    var sure = @json(__('Are You Sure?'));
    var revert = @json(__("You won't be able to revert this!"));
    var cant = @json(__("Can't Delete!"));

    $(document).ready(function(){
        $('body').on('click', '.delete-item', function(event){
            event.preventDefault();

            let deleteUrl = $(this).attr('href');

            Swal.fire(
            {
                title: sure,
                text: revert,
                icon: 'warning',
                cancelButtonText: @json(__('Cancel')),
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: @json(__('Yes, delete it!'))
                }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        type: 'DELETE',
                        url: deleteUrl,
                        data: {
                            "_token": "{{ csrf_token() }}",
                        },
                        success: function(data){
                            if(data.status == 'success')
                            {
                                Swal.fire(
                                    'Deleted!',
                                    data.message,
                                    'success'
                                )
                               setTimeout(() => {
                                window.location.reload();
                               }, 3000);
                            }
                            else if(data.status == 'error')
                            {
                                Swal.fire(
                                    cant,
                                    data.message,
                                    'error'

                                )
                            }
                        },
                        error: function(xhr, status, error){
                            console.log(error);
                        }
                    })
                }
            })
        })
    })
</script>

    @stack('scripts')


</body>

</html>
