@extends('admin.layouts.main')

@section('content')


<section class="section">
    <div class="section-header">
    <h1>Table</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{route('admin.dashboard')}}">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="{{route('admin.slider.index')}}">Manage Website</a></div>
        <div class="breadcrumb-item">Slider</div>
    </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">Table</h2>
        <p class="section-lead">Example of some Bootstrap table components.</p>

        <div class="row">
            <div class="col-12 col-md-6 col-lg-12">
                <div class="card">
                    <div class="card-header justify-content-between">
                        <h4>Simple Table</h4>
                        <a href="{{route('admin.slider.create')}}" class="btn btn-primary">Create +</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">

                            <table class="table table-bordered border-dark table-hover ">
                            <thead class="table-info">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Url</th>
                                    <th scope="col">Serial</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Created At</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach($data as $index => $row)
                                    <tr>
                                        <td>{{ $data->firstItem() + $index }}</td>
                                        <td><a href="">{{ $row->type }}</a></td>
                                        <td>{{ $row->title }}</td>
                                        <td>{{ $row->starting_price }}</td>
                                        <td>{{ $row->url }}</td>
                                        <td>{{ $row->serial }}</td>
                                        <td><div class="badge {{($row->status == 'Active') ? 'badge-success' : 'badge-danger'}} ">{{$row->status}}</div></td>
                                        <td>{{ $row->uploadDate() }}</td>
                                    </tr>
                                @endforeach

                            </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center">
        {{$data->links()}}
    </div>

</section>

@endsection
