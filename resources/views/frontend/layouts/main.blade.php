<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densityDpi=device-dpi" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

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
    <link rel="stylesheet" href="{{ asset('frontend/modules/iziToast/css/iziToast.min.css') }}">

    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }} ">
    <link rel="stylesheet" href="{{ asset('frontend/css/responsive.css') }} ">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"/>
    <!-- <link rel="stylesheet" href="css/rtl.css"> -->
</head>

<body>

    <!--============================
        Header Start
    ==============================-->

    @include('frontend.layouts.header')

    <!--============================
        Header END
    ==============================-->

    <!--============================
        NavBar Start
    ==============================-->

    @include('frontend.layouts.nav')

    <!--============================
        NavBar END
    ==============================-->

    <!--============================
        MAIN Content Start
    ==============================-->

        @yield('content')

    <!--============================
        MAIN Content END
    ==============================-->


    <!--============================
        FOOTER PART START
    ==============================-->
        @include('frontend.layouts.footer')
    <!--============================
        FOOTER PART END
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
    <script src="{{ asset('frontend/js/jquery-3.6.0.min.js') }}"></script>
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

    <!--iziToast js-->
    <script src="{{ asset('frontend/modules/iziToast/js/iziToast.min.js') }}"></script>

    <!--main/custom js-->
    <script src="{{ asset('frontend/js/main.js') }}"></script>

    <!--SweetAlert js-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!--Toastr Js-->
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" ></script>

    <script>
        toastr.options.progressBar = true;
        toastr.options.closeButton = true;

        // Show Validation Errors
        @if ($errors->any())
            @foreach ($errors->all() as $error )
                toastr.error("{{$error}}")
            @endforeach
        @endif

        // Show Controller Messages
        @if ($message = session('message'))
            toastr.success("{{ $message }}")
        @elseif ($message = session('status'))
            toastr.success("{{ $message }}")
        @elseif ($message = session('warning'))
            toastr.warning("{{ $message }}")
        @elseif ($message = session('error'))
            toastr.error("{{ $message }}")
        @endif

    </script>

    <script>
        iziToast.settings({
            position: 'topCenter',
        })
    </script>

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

    @include('frontend.layouts.scripts')

    @stack('scripts')

</body>

</html>
