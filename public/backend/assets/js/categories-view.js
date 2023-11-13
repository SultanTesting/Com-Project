$(document).ready(function()
{
    $('body').on('change', '.main-category', function(e)
    {
        let id = $(this).val();

        $.ajax(
            {
                method: "GET",
                url: myUrl,
                data: {
                    id: id
                },

                success: function(data)
                {
                    $('.sub-category').empty();

                    $.each(data, function(i, item)
                    {
                        $('.sub-category').append(`<option value="${item.id}">${item.name}</option>`)
                    })
                },

                error: function(xhr, status, error)
                {
                    console.log(error);
                    toastr.error(error);
                }
            }
        )
    })
})
