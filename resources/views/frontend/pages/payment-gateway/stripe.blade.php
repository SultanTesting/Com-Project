<div class="tab-pane fade" id="v-pills-stripe" role="tabpanel" aria-labelledby="v-pills-stripe-tab">
    <div class="wsus__payment_area">
        <form action="{{route('user.stripe.pay')}}" method="POST" id="checkout-form">
            @csrf

            <div class="form-group">
                <input type="hidden" name="stripe_token" id="stripe-token-id">
                <div class="row">
                    <input type="text" class="col form-control-sm" name="card-first-name" placeholder="First Name">
                    <input type="text" class="col form-control-sm" name="card-last-name" placeholder="Last Name">
                    <div id="card_element" class="form-control p-3"></div>
                </div>
            </div>

            <button class="nav-link common_btn mt-3" id="pay-btn" onclick="createToken()" type="button">
                Pay With Stripe
            </button>

        </form>
    </div>
</div>

@push('scripts')
<script src="https://js.stripe.com/v3/"></script>

<script>
    var stripe = Stripe('{{$stripe->client_id}}')
    var elements = stripe.elements();
    var cardElement = elements.create('card');
    cardElement.mount('#card_element');

    function createToken()
    {
        $('#pay-btn').attr('disabled', true);
        stripe.createToken(cardElement).then(function(result) {
            if(typeof result.error != 'undefined')
            {
                $('#pay-btn').attr('disabled', false);
                alert(result.error.message);
            }

            if(typeof result.token != 'undefined')
            {
                $('#stripe-token-id').val(result.token.id);
                $('#checkout-form').submit();
            }
        })
    }
</script>

@endpush
