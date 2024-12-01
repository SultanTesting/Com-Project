$(document).ready(function()
{
    $('body').on('change', '.sub-category', function(e)
    {
        let id = $(this).val();
        let row = $(this).closest('.row');

        $.ajax(
            {
                method: "GET",
                url: childUrl,
                data: {
                    id: id
                },

                success: function(data)
                {
                    let selector = row.find('.child-category');
                    selector.empty();
                    selector.append(`<option selected disabled>Choose One</option>`);

                    $.each(data, function(i, item)
                    {
                        selector.append(`<option value="${item.id}">${item.name}</option>`)
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
