export function request(route, method, form = {}, withResponse = false, withFile = false, isEdit = false) {

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
        if(withFile) {
            ajaxOptions.data = new FormData(form[0]);
            ajaxOptions.contentType = false;
            ajaxOptions.processData = false;
        } else {
            ajaxOptions.data = form.serialize();
        }
    }

    if(withResponse) {
        ajaxOptions.success = function(response) {
            if(isEdit) {
                let currentUrl = window.location.href;
                let currentSlug = currentUrl.split('/')[4];
                let newUrl = currentUrl.replace(currentSlug, response.data.slug);
                history.replaceState({}, '', newUrl);

                $('.edit-slug').val(response.data.slug);
            }
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
