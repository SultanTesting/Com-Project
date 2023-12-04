<div class="btn-group">


        <a type="button" class="nav-link nav-link-lg" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i style="color: #e6e7ef;" class="fa fa-globe"></i>
        </a>

        <div class="dropdown-menu">
            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                    @if ($properties['native'] == 'English')
                        <div class="d-flex justify-content-between">
                            <img src="{{ asset('frontend/images/en.png') }}" width="20px">
                             <span>English</span>
                        </div>
                    @else
                    <div class="d-flex justify-content-between">
                        <img src="{{ asset('frontend/images/ar.png') }}" width="20px">
                         <span>العربية</span>
                    </div>
                    @endif
                </a>
            @endforeach
        </div>

</div>
