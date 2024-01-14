<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <link rel="icon" type="image/x-icon" href="{{ asset('backend/assets/img/main-logo.png') }}">
  <title>General Dashboard &mdash; Stisla</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{ asset('backend/assets/modules/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/assets/modules/fontawesome/css/all.min.css') }}">

  {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> --}}

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="{{ asset('backend/assets/modules/jqvmap/dist/jqvmap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/assets/modules/weather-icon/css/weather-icons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/assets/modules/weather-icon/css/weather-icons-wind.min.css') }}">
  {{-- <link rel="stylesheet" href="{{asset('backend/assets/css/bootstrap-iconpicker.min.css')}}"> --}}
  <link rel="stylesheet" href="{{asset('backend/assets/modules/bootstrap-daterangepicker/daterangepicker.css')}}">
  <link rel="stylesheet" href="{{ asset('backend/assets/modules/summernote/summernote-bs4.css') }}">
  {{-- <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"/> --}}
  {{-- <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css"/>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css"/> --}}
  <link rel="stylesheet" href="{{ asset('backend/assets/css/bootstrap-iconpicker.min.css') }}"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css"/>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css"/>
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap.min.css"/>





  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('backend/assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/assets/css/components.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/assets/css/toastr.min.css') }}">

  @if (dirSelect() == 'rtl')
    <link rel="stylesheet" href="{{asset('backend/assets/css/rtl.scss')}}">
  @endif



<!-- Start GA -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-94034622-3');
</script>
<!-- /END GA --></head>

<body>
    <div id="app">
        <div  class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
                <!-- NavBar -->

                    @include('admin.layouts.navbar')

                <!-- SideBar -->

                    @include('admin.layouts.sidebar')

                <!-- Main Content -->

                <div class="main-content">
                        @yield('content')
                </div>

                <!-- Footer -->

                <footer class="main-footer">
                    <div class="footer-left">
                    Copyright &copy; 2023 <div class="bullet"></div> Design By <a href="https://nauval.in/">Muhamad Nauval Azhar</a>
                    </div>
                    <div class="footer-right">

                    </div>
                </footer>
        </div>
    </div>

  <!-- General JS Scripts -->
  {{-- <script src="{{ asset('backend/assets/modules/jquery.min.js') }}"></script> --}}
  <script src="https://code.jquery.com/jquery-3.7.0.js" ></script>

  <script src="{{ asset('backend/assets/modules/popper.js') }}"></script>
  <script src="{{ asset('backend/assets/modules/tooltip.js') }}"></script>
  <script src="{{ asset('backend/assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('backend/assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
  <script src="{{ asset('backend/assets/modules/moment.min.js') }}"></script>
  <script src="{{ asset('backend/assets/js/stisla.js') }}"></script>

  <!-- JS Libraies -->
  <script src="{{ asset('backend/assets/modules/simple-weather/jquery.simpleWeather.min.js') }}"></script>
  <script src="{{ asset('backend/assets/modules/chart.min.js') }}"></script>
  <script src="{{ asset('backend/assets/modules/jqvmap/dist/jquery.vmap.min.js') }}"></script>
  <script src="{{ asset('backend/assets/modules/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
  <script src="{{ asset('backend/assets/modules/summernote/summernote-bs4.js') }}"></script>
  <script src="{{ asset('backend/assets/modules/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>
  {{-- <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js" ></script>
  <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js" ></script> --}}
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="{{ asset('backend/assets/js/bootstrap-iconpicker.bundle.min.js') }}"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js" ></script>
  <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js" ></script>
  <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js" ></script>
  <script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap.min.js" ></script>
  <script async src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js"
    integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D"
    crossorigin="anonymous"></script>


  <!-- Page Specific JS File -->
  <script src="{{ asset('backend/assets/js/page/index-0.js') }}"></script>

  <!-- Template JS File -->
  <script src="{{ asset('backend/assets/js/scripts.js') }}"></script>
  <script src="{{ asset('backend/assets/js/custom.js') }}"></script>

  <!-- Toastr Js -->
  <script src="{{asset('backend/assets/js/toastr.min.js')}}"></script>

  <!-- Toastr Script  -->

    <script>
        toastr.options.progressBar = true;
        toastr.options.closeButton = true;
        toastr.options.timeOut = 5000;

        @if ($errors->any())
            @foreach ($errors->all() as $error )
                toastr.error("{{$error}}", "{{__('Whoops!')}}")
            @endforeach
        @endif

        @if ($message = session('message'))
            toastr.success("{{ $message }}", "{{__('Success')}}")
        @endif

    </script>

  <!-- END Of Toastr Script  -->

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
