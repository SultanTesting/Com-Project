<script>
    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })

        /** Add Product Into Cart **/
        $('.shopping-cart').on('submit', function(e) {
            e.preventDefault();

            let formData = $(this).serialize();

            $.ajax({
                method: 'POST',
                data: formData,
                url: "{{ route('add-to-cart') }}",
                success: function(data) {
                    iziToast.success({
                        title: 'Done✅',
                        message: data.message
                    });
                    cartCounter();
                    addMoreItemsToCart();
                    miniCartSubTotal();
                },
                error: function(data) {
                    iziToast.error({
                        title: 'Oops 🚫',
                        message: data.responseText
                    });
                }
            })
        })

        /** Cart Counter **/
        function cartCounter() {
            $.ajax({
                method: "GET",
                url: "{{ route('cart-counter') }}",
                success: function(data) {
                    $('#cart-counter').text(data);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }

            })
        }

        // mini-cart Control

        function addMoreItemsToCart() {
            $.ajax({
                method: "GET",
                url: "{{ route('mini-cart') }}",
                success: function(data) {
                    $('.mini-cart').empty();
                    var html = "";

                    $.each(data, function(index, value) {
                        if (value.options.max < value.qty) {
                            value.qty = value.options.max;
                            iziToast.warning({
                                title: 'Oops',
                                message: 'Product Reached Max Quantity'
                            });
                            return false;
                        }

                        html += `<li>
                            <div class="wsus__cart_img">
                                <a href="{{ url('product') }}/${value.options.slug}">
                                    <img src="{{ asset('/') }}${value.options.image}" alt="${value.name}" class="img-fluid w-100"></a>
                                <a class="wsis__del_icon" href="{{ url('cart/delete') }}/${value.rowId}">
                                    <i class="fas fa-minus-circle "></i>
                                </a>
                            </div>
                            <div class="wsus__cart_text">
                                <a class="wsus__cart_title" href="{{ url('product') }}/${value.options.slug}">${value.name}</a>
                                <div class="d-flex justify-content-between">
                                    <code>${value.price} {{ $settings->currency_icon }}</code>
                                    <div style="display: ruby">
                                        <i class="fas fa-times fa-xs"></i>
                                        <p id="${value.rowId+'qty'}" class="text-secondary">${value.qty}</p>
                                    </div>
                                </div>

                            </div>
                        </li>`;
                    })

                    $('.mini-cart').html(html);
                    $('.mini-cart-actions').removeClass('d-none');

                },
                error: function(xhr, status, error) {
                    console.error(error)
                }
            })
        }


        /** Get Mini-Cart SubTotal **/

        function miniCartSubTotal() {
            $.ajax({
                method: 'GET',
                url: "{{ route('mini-cart.sub-total') }}",
                success: function(data) {
                    $('.mini-cart-subTotal').html(data + currency);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            })
        }
    })
</script>
