<div class="tab-pane fade show active" id="list-paypal" role="tabpanel" aria-labelledby="list-paypal-list">

    <div class="card border">

        <div class="card-body">

            <div class="d-flex justify-content-center mb-2">
                <img src="{{ asset('backend/assets/img/paypal-logo.png') }}" alt="paypal" width="120px">
            </div>

            <form action="{{route('admin.paypal-settings')}}" method="POST">
                @csrf

                <div class="row">
                    <div class="col form-group">
                        <label class="form-label">{{__('Status')}}</label>
                        <select name="status" class="form-control form-select">
                            <option {{(@$paypal->status == 'active') ? 'selected' : ''}} value="active">{{__('Active')}}</option>
                            <option {{(@$paypal->status == 'inactive') ? 'selected' : ''}} value="inactive">{{__('Inactive')}}</option>
                        </select>
                        <x-input-error :messages="$errors->get('status')" class="alert-danger mb-2"/>
                    </div>
                    <div class="col form-group">
                        <label class="form-label">{{__('Account Mode')}}</label>
                        <select name="account_mode" class="form-control form-select">
                            <option {{(@$paypal->account_mode == 'live') ? 'selected' : ''}} value="live">{{__('Live')}}</option>
                            <option {{(@$paypal->account_mode == 'sandbox') ? 'selected' : ''}} value="sandbox">{{__('SandBox')}}</option>
                        </select>
                        <x-input-error :messages="$errors->get('account_mode')" class="alert-danger mb-2"/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">{{__('Country')}}</label>
                    <select name="country" style="width: 100%" class="select2 form-control form-select">
                        <option selected disabled>{{__('Select')}}</option>
                        @foreach (config('settings.country_list') as $country)
                            <option {{(@$paypal->country == $country) ? 'selected' : ''}} value="{{$country}}">{{$country}}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('country')" class="alert-danger mb-2"/>
                </div>

                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label">{{__('Default Currency')}}</label>
                        <select name="currency_name" style="width: 100%" class="form-control currency_name select2">
                            @foreach (config('settings.currency_list') as $key => $currency)
                                <option {{(@$paypal->currency_name == $key) ? 'selected' : ''}}
                                    value="{{$key}}"> {{$currency['name']}}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('currency_name')" class="alert-danger mb-2"/>
                    </div>

                    <div class="col">
                        <label class="form-label">{{__('Currency Symbol')}}</label>
                        <input type="text" readonly class="form-control currency_syb"
                        name="currency_icon" value="{{@$paypal->currency_icon}}">
                        <x-input-error :messages="$errors->get('currency_icon')" class="alert-danger mb-2"/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">{{__('Currency Rate')}} ({{$settings->currency_name}})</label>
                    <input type="text" name="currency_rate" value="" class="form-control cr">
                    <x-input-error :messages="$errors->get('currency_rate')" class="alert-danger mb-2"/>
                </div>

                <div class="row mb-3">
                    <div class="col form-group">
                        <label class="form-label">{{__('Paypal Client ID')}}</label>
                        <input type="text" name="paypal_client_id" value="{{@$paypal->paypal_client_id}}" class="form-control">
                        <x-input-error :messages="$errors->get('paypal_client_id')" class="alert-danger mb-2"/>
                    </div>

                    <div class="col form-group">
                        <label class="form-label">{{__('Paypal Secret Key')}}</label>
                        <input type="text" name="paypal_sec_key" value="{{@$paypal->paypal_sec_key}}" class="form-control">
                        <x-input-error :messages="$errors->get('paypal_sec_key')" class="alert-danger mb-2"/>
                    </div>
                </div>

                <button class="btn btn-outline-primary btn-block">
                    {{__('Update', ['name' => __('Paypal')])}}
                </button>
            </form>

        </div>

    </div>

</div>

@push('scripts')
    <script>
        let list = @json(config('settings.currency_list'));
    </script>

    <script>
        $(document).ready(function(){
            $('body').on('change', '.currency_name', function()
            {
                let currency_name = $(this).val();

                $('.currency_syb').attr('value', list[currency_name]['symbol']);

            })
        })
    </script>

    <script>
        let api = 'https://api.currencyfreaks.com/v2.0/rates/latest?apikey=5dc31423eaf541879ed1f9d69f28c243';

        let usd;

        fetch(api)
            .then(response => response.json())
            .then(data => $('.cr').val(data.rates.EGP))
    </script>

@endpush


