export function request(route, method, form = {}, isCreateOrUpdate = false, withImage = false) {

    $('.success-response').addClass('d-none');
    $('.error-response').addClass('d-none');
    $('.field-error').addClass('d-none');

    let ajaxOptions = {
        url: route,
        type: method,
        dataType: 'json',
        error: function(xhr) {
            let errors = xhr.responseJSON.errors;
            if (errors) {
                $.each(errors, function(key, value) {
                    let errorElement = $('#' + key + '-error');
                    errorElement.text(value[0]);
                    errorElement.removeClass('d-none');
                });
            } else {
                $('.error-response').text(xhr.responseJSON.message);
                $('.error-response').removeClass('d-none');
            }
        }
    }
    
    if (Object.keys(form).length !== 0) {
        if(withImage) {
            ajaxOptions.data = new FormData(form[0]);
            ajaxOptions.contentType = false;
            ajaxOptions.processData = false;
        } else {
            ajaxOptions.data = form.serialize();
        }
    }

    if(isCreateOrUpdate) {
        ajaxOptions.success = function(response) {
            $('.success-response').text(response.message);
            $('.success-response').removeClass('d-none');
        }
    } else {
        ajaxOptions.success = function(response) {
            window.location.reload();
        };
    }

    $.ajax(ajaxOptions);
}
