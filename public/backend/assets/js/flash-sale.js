// Change Flash Sale Product Status

$(document).ready(function(){
    $('body').on('click', '.flash-sale', function(event)
    {
        event.preventDefault();

        let id = $(this).data('id');

        $.ajax({
            url: flashStore,
            method: "POST",
            data: {
                "_token": myToken,
                "product_id": id
            },

            success: function(data){
                iziToast.success({title: 'Success', message: data.message});
                setTimeout(() => {
                    window.location.reload();
                }, 2000);
            },

            error: function(xhr, status, error){
                iziToast.error({title: 'Oops', message: error});
                console.log(error);
            }
        })
    })
})

// Send Vendor Products To Flash Sale

$(document).ready(function(){
    $('body').on('submit', '.vendor_select', function(event)
    {
        event.preventDefault();

        let vendor_id = $(this).val();

        $.ajax({
            url: flashStore,
            method: "POST",
            data: {
                "_token": myToken,
                vendor_id: vendor_id
            },

            success: function(data){
                iziToast.success({title: 'Success', message: data.message});
            },

            error: function(xhr, status, error){
                iziToast.error({title: 'Oops', message: error});
                console.log(error);
            }
        })
    })
})
