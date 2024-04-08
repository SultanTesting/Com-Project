$(document).ready(function()
{
    $('body').on('change', '.sub-category', function(e)
    {
        let id = $(this).val();

        $.ajax(
            {
                method: "GET",
                url: childUrl,
                data: {
                    id: id
                },

                success: function(data)
                {
                    $('.child-category').empty();
                    $('.child-category').append(`<option selected disabled>Choose One</option>`);

                    $.each(data, function(i, item)
                    {
                        $('.child-category').append(`<option value="${item.id}">${item.name}</option>`)
                    })
                },

                error: function(xhr, status, error)
                {
                    console.log(error);
                    iziToast.error(error);
                }
            }
        )
    })
})
