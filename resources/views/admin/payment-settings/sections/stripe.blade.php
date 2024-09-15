<div class="tab-pane fade" id="list-stripe" role="tabpanel" aria-labelledby="list-stripe-list">
    <div class="card border">

        <div class="card-body">

            <div class="d-flex justify-content-center mb-2">
                <img src="{{ asset('backend/assets/img/stripe-logo.png') }}" alt="paypal" width="120px">
            </div>

            <form action="{{route('admin.stripe-settings')}}" method="POST">
                @csrf

                <div class="row">
                    <div class="col form-group">
                        <label class="form-label">{{__('Status')}}</label>
                        <select name="status" class="form-control form-select">
                            <option {{(@$stripe->status == 'active') ? 'selected' : ''}} value="active">{{__('Active')}}</option>
                            <option {{(@$stripe->status == 'inactive') ? 'selected' : ''}} value="inactive">{{__('Inactive')}}</option>
                        </select>
                        <x-input-error :messages="$errors->get('status')" class="alert-danger mb-2"/>
                    </div>
                    <div class="col form-group">
                        <label class="form-label">{{__('Account Mode')}}</label>
                        <select name="account_mode" class="form-control form-select">
                            <option {{(@$stripe->account_mode == 'live') ? 'selected' : ''}} value="live">{{__('Live')}}</option>
                            <option {{(@$stripe->account_mode == 'sandbox') ? 'selected' : ''}} value="sandbox">{{__('SandBox')}}</option>
                        </select>
                        <x-input-error :messages="$errors->get('account_mode')" class="alert-danger mb-2"/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">{{__('Country')}}</label>
                    <select name="country" style="width: 100%" class="form-control form-select select2">
                        <option selected disabled>{{__('Select')}}</option>
                        @foreach (config('settings.country_list') as $country)
                            <option {{(@$stripe->country == $country) ? 'selected' : ''}} value="{{$country}}">{{$country}}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('country')" class="alert-danger mb-2"/>
                </div>

                <div class="row mb-3">
                    <div class="col form-group">
                        <label class="form-label">{{__('Default Currency')}}</label>
                        <select name="currency_name" style="width: 100%" class="form-control currency_name select2">
                            @foreach (config('settings.currency_list') as $key => $currency)
                                <option {{(@$stripe->currency_name == $key) ? 'selected' : ''}}
                                    value="{{$key}}"> {{$currency['name']}}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('currency_name')" class="alert-danger mb-2"/>
                    </div>

                    <div class="col form-group">
                        <label class="form-label">{{__('Currency Symbol')}}</label>
                        <input type="text" readonly class="form-control currency_syb"
                        name="currency_icon" value="{{@$stripe->currency_icon}}">
                        <x-input-error :messages="$errors->get('currency_icon')" class="alert-danger mb-2"/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">{{__('Currency Rate')}} ({{$settings->currency_name}})</label>
                    <input type="text" name="currency_rate" value="{{@$stripe->currency_rate}}" class="form-control">
                    <x-input-error :messages="$errors->get('currency_rate')" class="alert-danger mb-2"/>
                </div>

                <div class="row mb-3">
                    <div class="col form-group">
                        <label class="form-label">{{__('Stripe Client ID')}}</label>
                        <input type="text" name="client_id" value="{{@$stripe->client_id}}" class="form-control">
                        <x-input-error :messages="$errors->get('client_id')" class="alert-danger mb-2"/>
                    </div>

                    <div class="col form-group">
                        <label class="form-label">{{__('Stripe Secret Key')}}</label>
                        <input type="text" name="secret_key" value="{{@$stripe->secret_key}}" class="form-control">
                        <x-input-error :messages="$errors->get('secret_key')" class="alert-danger mb-2"/>
                    </div>

                    <input type="hidden" name="id" value="1">
                </div>

                <button class="btn btn-outline-primary btn-block">
                    {{__('Update', ['name' => __('Stripe')])}}
                </button>
            </form>
        </div>

    </div>
</div>
