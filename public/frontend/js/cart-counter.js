$(document).ready(function(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var debounce = null;

    /** Cart Increment */

    $('.add').click(function(){

        clearTimeout(debounce);

        let input = $(this).siblings('.qty');
        let qty = parseInt(input.val()) + 1;
        let rowId = input.data('rowid');
        let itemQty = $('#'+rowId+'qty');

        if(qty > input.attr('max'))
            {
                qty = input.attr('max');
                iziToast.warning({title: 'Oops', message: 'Product Reached Max Quantity'});
                return false;
            }

        debounce = setTimeout(() => {
            $.ajax({
            url: url,
            method: 'POST',
            data: {
                rowId: rowId,
                qty: qty
            },
            success: function(data)
            {
                let productId = '#'+rowId;
                let total = (data.product_total).toLocaleString('en-us')+currency;

                $(productId).text(total);
                $(itemQty).text(qty);
                getSubTotal();
                couponCalc();
                toastr.success(data.message);

            },
            error: function(xhr, status, error){
                console.error(error);
            }
            })
        }, 1000);

    })

    /** Cart Decrement */

    $('.sub').click(function(){

        clearTimeout(debounce);

        let input = $(this).siblings('.qty');
        let qty = parseInt(input.val()) - 1;
        let rowId = input.data('rowid');
        let itemQty = $('#'+rowId+'qty');

        if(qty < 1 ){
            qty = 1;
            iziToast.warning({title: 'Oops', message: "Quantity Shouldn't Be Less Than 1"});
            // throw new Error('Quantity Less Than 1');
            return false;
        }

        debounce = setTimeout(() => {
            $.ajax({
            url: url,
            method: "POST",
            data: {
                rowId: rowId,
                qty: qty
            },
            success: function(data)
            {
                let productId = '#'+rowId;
                let total = (data.product_total).toLocaleString('en-us')+currency;

                $(productId).text(total);
                $(itemQty).text(qty);
                getSubTotal();
                couponCalc();
                toastr.success(data.message);

            },
            error: function(xhr, status, error)
            {
                console.error(error);
            }
            })
        }, 1000)
    })

    function getSubTotal()
    {
        $.ajax({
            method: "GET",
            url: subTotalUrl,
            success: function(data)
            {
                $('#subTotal').html(data+currency);
            },
            error: function(xhr, status, error)
            {
                console.error(error);
            }
        });
    }


    /** Apply Coupon **/
    $('#coupon_form').submit(function(e) {
        e.preventDefault();

        let formData = $('#coupon_form').serialize();

        $.ajax({
            method: 'GET',
            url: cartCoupon,
            data: formData,
            success: function(data)
            {
                iziToast.success({
                    title: 'Done✅',
                    message: data.message
                });

                couponCalc();
            },
            error: function(data)
            {
                toastr.error(data.responseText);
            }

        })
    })

    /** Calculate Coupon Discount **/
    function couponCalc(){
        $.ajax({
            method: 'GET',
            url: couponCalcRoute,
            success: function(data)
            {
                $('#discount_cart').text(data.discount);
                $('#total_cart').text(data.total + currency);
            },
            error: function(data)
            {
                iziToast.error({
                    title: 'Failed ❌',
                    message: data.responseText
                });
            }
        })
    }

    // /** Cash Discount Can't Be Zero Or Negative */
    // function couponCheck()
    // {
    //     $.ajax({
    //         method: "GET",
    //         url: couponCheckRoute,
    //         success: function(data)
    //         {
    //             console.log('success');
    //             // $('#discount_cart').html('0');
    //             // $('#total_cart').text(data.total + currency);
    //         },
    //         error: function(xhr, status, error)
    //         {
    //             console.error(error);
    //         }
    //     })
    // }

})
