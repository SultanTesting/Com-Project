<div class="tab-pane fade show active" id="list-general" role="tabpanel" aria-labelledby="list-general-list">

        <div class="card border">

            <div class="card-body">
                <form action="{{route('admin.general-settings.update')}}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label class="form-label">{{__('Site Name')}}</label>
                        <input type="text" class="form-control" name="site_name"
                        value="{{@$generalSet->site_name}}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">{{__('Contact Email')}}</label>
                        <input type="text" class="form-control" name="contact_email" value="{{@$generalSet->contact_email}}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">{{__('Layout')}}</label>
                        <select name="layout" class="form-control form-select">
                            <option {{(@$generalSet->layout == 'LTR') ? 'selected' : ''}} value="LTR">LTR</option>
                            <option {{(@$generalSet->layout == 'RTL') ? 'selected' : ''}} value="RTL">RTL</option>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label class="form-label">{{__('Default Currency')}}</label>
                            <select name="currency_name" class="form-control currency_name select2">
                                @foreach (config('settings.currency_list') as $key => $currency)
                                    <option {{(@$generalSet->currency_name == $key) ? 'selected' : ''}}
                                        value="{{$key}}"> {{$currency['name']}}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col">
                            <label class="form-label">{{__('Currency Symbol')}}</label>
                            <input type="text" readonly class="form-control currency_syb"
                            name="currency_icon" value="{{@$generalSet->currency_icon}}">
                        </div>
                    </div>

                    <div class="form-group mt-4">
                        <label class="form-label">{{__('TimeZone')}}</label>
                        <select name="timezone" class="form-control select2">
                            <option selected disabled>{{__('Select')}}</option>
                            @foreach (config('settings.time_zone') as $key => $timeZone)
                                <option {{(@$generalSet->timezone == $key) ? 'selected' : ''}}
                                value="{{$key}}">{{$key}}</option>
                            @endforeach
                        </select>
                    </div>

                    <button class="btn btn-outline-primary btn-block">{{__('Update', ['name' => __('Site Info')])}}</button>
                </form>
            </div>

        </div>

</div>


