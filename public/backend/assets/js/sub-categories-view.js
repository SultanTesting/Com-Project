$(document).ready(function()
{
    $('body').on('change', '.main-category', function(e)
    {
        let id = $(this).val();
        let row = $(this).closest('.row');

        $.ajax(
            {
                method: "GET",
                url: myUrl,
                data: {
                    id: id
                },

                success: function(data)
                {
                    let selector = row.find('.sub-category, .child-category');
                    selector.empty();
                    selector.append(`<option selected disabled>Choose One</option>`);

                    $.each(data, function(i, item)
                    {
                        let subSelector = row.find('.sub-category');
                        subSelector.append(`<option value="${item.id}">${item.name}</option>`);
                    })
                },

                error: function(xhr, status, error)
                {
                    iziToast.error({
                        title: __('Oops'),
                        message: error
                    });
                    console.log(error);
                }
            }
        )
    })
})
