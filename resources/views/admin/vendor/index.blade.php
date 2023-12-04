@extends('admin.layouts.main')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Vendor Profile Data</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.slider.index') }}">Manage Website</a></div>
                <div class="breadcrumb-item">Vendor Profile</div>
            </div>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12 col-xl-12 col-md-6">
                    <div class="card">
                        <div class="card-header justify-content-between">
                            <h4>Vendor Data</h4>
                        </div>

                        <div class="card-body">

                            <form method="POST" action="{{ route('admin.vendor-profile.update', $vendor->id) }}"
                            enctype="multipart/form-data" >
                                @csrf
                                @method('PUT')

                                <label class="font-weight-bold">Preview</label>
                                <div class="form-group">
                                    <img src="{{($vendor->banner) ? asset($vendor->banner) : asset('frontend/images/no-image.jpg')}}" width="25%" class="img-thumbnail">
                                </div>

                                <div class="mb-3 form-group">
                                    <label for="formFileMultiple" class="form-label">Upload Banner</label>
                                    <input class="form-control" name="banner" type="file" id="formFileMultiple"
                                        multiple>
                                        @error('banner')
                                            <div class="alert-danger">
                                                {{$message}}
                                            </div>
                                        @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Email</label>
                                    <input type="text" name="email" value="{{$vendor->email}}" class="form-control">
                                        @error('email')
                                            <div class="alert-danger">
                                                {{$message}}
                                            </div>
                                        @enderror
                                </div>

                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" name="phone" value="{{$vendor->phone}}" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" name="address" value="{{$vendor->address}}" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>Desctiption</label>
                                    <textarea name="shop_description" class="summernote">
                                        {{$vendor->shop_description}}
                                    </textarea>
                                </div>

                                <div class="form-group">
                                    <label for="facebook">Facebook</label>
                                    <input type="url" name="facebook" value="{{$vendor->facebook}}"
                                    class="form-control" placeholder="https://facebook.com/vendor_profile">
                                </div>

                                <div class="form-group">
                                    <label for="x">X</label>
                                    <input type="url" name="x" value="{{$vendor->x}}"
                                    class="form-control" placeholder="https://x.com/vendor_profile">
                                </div>

                                <div class="form-group">
                                    <label for="instagram">Instagram</label>
                                    <input type="url" name="instagram" value="{{$vendor->instagram}}"
                                    class="form-control" placeholder="https://instagram.com/vendor_profile">
                                </div>

                                <label>Status</label>
                                <select class="form-control" name="store_status">
                                    <option selected disabled>Choose One</option>
                                    <option {{$vendor->store_status == 'Open' ? 'selected' : ''}}
                                        value="Open">Open</option>
                                    <option {{$vendor->store_status == 'Close' ? 'selected' : ''}}
                                        value="Close">Close</option>
                                    <option {{$vendor->store_status == 'Permanently_Closed' ? 'selected' : ''}} value="Permanently_Closed">Permanently Closed</option>
                                </select>

                                <div class="mt-4">
                                    <button type="submit" class="btn btn-outline-primary btn-lg btn-block">
                                        Create Vendor
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>


    </section>
@endsection
