$(document).ready(function() {

    var debounce = null;
    $('body').on('click', '.change-status', function(){
        let isChecked = $(this).is(':checked');
        let id = $(this).data('id');

        clearTimeout(debounce);

            debounce = setTimeout(function()
            {
                $.ajax({
                    url: myUrl,
                    method: "PUT",
                    data: {
                        "_token": myToken,
                        status: isChecked,
                        id: id
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
            }, 600)
    })
})
