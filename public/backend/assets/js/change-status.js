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
                        toastr.success(data.message);
                        setTimeout(() => {
                            window.location.reload();
                        }, 2000);
                    },

                    error: function(xhr, status, error){
                        toastr.error(error);
                        console.log(error);
                    }
                })
            }, 600)
    })
})
