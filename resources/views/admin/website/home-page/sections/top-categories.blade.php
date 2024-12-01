<div class="tab-pane fade show active" id="list-general" role="tabpanel" aria-labelledby="list-general-list">

    <div class="card border">
        <div class="card-body">
            <form action="{{route('admin.top-categories')}}" method="POST">
                @csrf
                @method('PUT')

                <h6>{{__('Category')}} 1</h6>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">{{__('Category')}}</label>
                            <select name="category_1" class="form-control form-select main-category">
                                    <option selected disabled>{{__('Select')}}</option>
                                @foreach ($categories_view as $category)
                                    <option {{@($category->id == $topCategory[0]->category) ? 'selected' : ''}}
                                    value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">{{__('Sub-Category')}}</label>
                            <select name="sub_1" class="form-control form-select sub-category">
                                    <option selected disabled>{{__('Select')}}</option>
                                @foreach (@subCats($topCategory[0]->category, $topCategory[0]->category) as $subCat)
                                    <option {{@($subCat->id == $topCategory[0]->sub_category) ? 'selected' : ''}}
                                    value="{{$subCat->id}}">{{$subCat->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">{{__('Child-Category')}}</label>
                            <select name="child_1" class="form-control form-select child-category">
                                    <option selected disabled>{{__('Select')}}</option>
                                @foreach (@childCats($topCategory[0]->sub_category, $topCategory[0]->sub_category) as $childCat)
                                    <option {{@($childCat->id == $topCategory[0]->child_category) ? 'selected' : ''}}
                                    value="{{$childCat->id}}">{{$childCat->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <h6>{{__('Category')}} 2</h6>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">{{__('Category')}}</label>
                            <select name="category_2" class="form-control form-select main-category">
                                    <option selected disabled>{{__('Select')}}</option>
                                @foreach ($categories_view as $category)
                                    <option {{@($category->id == $topCategory[1]->category) ? 'selected' : ''}}
                                    value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">{{__('Sub-Category')}}</label>
                            <select name="sub_2" class="form-control form-select sub-category">
                                    <option selected disabled>{{__('Select')}}</option>
                                @foreach (@subCats($topCategory[1]->category, $topCategory[1]->category) as $subCat)
                                    <option {{@($subCat->id == $topCategory[1]->sub_category) ? 'selected' : ''}}
                                    value="{{$subCat->id}}">{{$subCat->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">{{__('Child-Category')}}</label>
                            <select name="child_2" class="form-control form-select child-category">
                                    <option selected disabled>{{__('Select')}}</option>
                                @foreach (@childCats($topCategory[1]->sub_category, $topCategory[1]->sub_category) as $childCat)
                                    <option {{@($childCat->id == $topCategory[1]->child_category) ? 'selected' : ''}}
                                    value="{{$childCat->id}}">{{$childCat->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <h6>{{__('Category')}} 3</h6>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">{{__('Category')}}</label>
                            <select name="category_3" class="form-control form-select main-category">
                                    <option selected disabled>{{__('Select')}}</option>
                                @foreach ($categories_view as $category)
                                    <option {{@($category->id == $topCategory[2]->category) ? 'selected' : ''}}
                                    value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">{{__('Sub-Category')}}</label>
                            <select name="sub_3" class="form-control form-select sub-category">
                                    <option selected disabled>{{__('Select')}}</option>
                                @foreach (@subCats($topCategory[2]->category, $topCategory[2]->category) as $subCat)
                                    <option {{@($subCat->id == $topCategory[2]->sub_category) ? 'selected' : ''}}
                                    value="{{$subCat->id}}">{{$subCat->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">{{__('Child-Category')}}</label>
                            <select name="child_3" class="form-control form-select child-category">
                                    <option selected disabled>{{__('Select')}}</option>
                                @foreach (@childCats($topCategory[2]->sub_category, $topCategory[2]->sub_category) as $childCat)
                                    <option {{@($childCat->id == $topCategory[2]->child_category) ? 'selected' : ''}}
                                    value="{{$childCat->id}}">{{$childCat->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <h6>{{__('Category')}} 4</h6>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">{{__('Category')}}</label>
                            <select name="category_4" class="form-control form-select main-category">
                                    <option selected disabled>{{__('Select')}}</option>
                                @foreach ($categories_view as $category)
                                    <option {{@($category->id == $topCategory[3]->category) ? 'selected' : ''}}
                                    value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">{{__('Sub-Category')}}</label>
                            <select name="sub_4" class="form-control form-select sub-category">
                                    <option selected disabled>{{__('Select')}}</option>
                                @foreach (@subCats($topCategory[3]->category, $topCategory[3]->category) as $subCat)
                                    <option {{@($subCat->id == $topCategory[3]->sub_category) ? 'selected' : ''}}
                                    value="{{$subCat->id}}">{{$subCat->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">{{__('Child-Category')}}</label>
                            <select name="child_4" class="form-control form-select child-category">
                                    <option selected disabled>{{__('Select')}}</option>
                                @foreach (@childCats($topCategory[3]->sub_category, $topCategory[3]->sub_category) as $childCat)
                                    <option {{@($childCat->id == $topCategory[3]->child_category) ? 'selected' : ''}}
                                    value="{{$childCat->id}}">{{$childCat->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <button class="btn btn-outline-primary btn-block mt-3">
                    {{__('Update', ['name' => __('Top Categories')])}}
                </button>
            </form>
        </div>

    </div>

</div>

@push('scripts')
    <script>
        var myUrl = "{{route('admin.get-subCategories')}}";
        var childUrl = "{{route('admin.product.get-childcategories')}}";
    </script>

    <script src="{{ asset('backend/assets/js/sub-categories-view.js') }}"></script>
    <script src="{{ asset('backend/assets/js/child-categories.js') }}"></script>

@endpush


