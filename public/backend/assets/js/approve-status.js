$(document).ready(function(){
    $('body').on('change', '.is_approved', function()
    {
        let value = $(this).val();
        let id = $(this).data('id');

        $.ajax({
            url: approveUrl,
            method: 'PUT',
            data: {
                "_token": myToken,
                id: id,
                value: value
            },
            success: function(data)
            {
                iziToast.success({title: 'Success', message: data.message});
                setTimeout(() => {
                    window.location.reload();
                }, 1500);
            },
            error: function(xhr, status, error)
            {
                iziToast.error({title: 'Oops', message: error})
            }
        })
    })
})
