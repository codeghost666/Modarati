jQuery(document).ready(function(event) {

    jQuery('p:empty').remove();
	
});

jQuery(document).on('change', 'input.form_info', function(event) {
    if(jQuery(this).hasClass('error') && jQuery(this).val() != '') {
        jQuery(this).removeClass('error');
    }
});

jQuery(document).on('click', 'input.form__btn', function(event) {
    event.preventDefault();
    event.stopPropagation();

    var data = {};
    var options = [];
    var flag = false;

    jQuery(this).closest('form').find('input.form_info').each(function(index, value) {
        if(jQuery(value).val() == '') {
            jQuery(value).addClass('error');
            flag = true;
            return true;
        }

        data[jQuery(value).attr('name')] = jQuery(value).val();
    });

    jQuery(this).closest('form').find('li.active').each(function(index, value) {
        var cb_value = jQuery(value).find('input[type=checkbox]:checked').val();
        options.push(cb_value);
    });

    if(flag) {
        return;
    }

    if(options.length == 0) {
        jQuery('.form__opener').addClass('error');
        return;
    } else {
        jQuery('.form__opener').removeClass('error');
    }

    data['options'] = options;
    data['action'] = 'tm_signin_ajax';

    jQuery.ajax({
        method: 'POST',
        url: url.ajaxurl,
        data: data,
        success: function(response_data) {
            if(response_data.success) {
                jQuery('.popup-thanks').show();
            } else {
                jQuery('.popup-thanks').hide();
                var error_message = '';

                jQuery(response_data.error_message).each(function(index, value) {
                    error_message += value + "\n";
                });

                alert('Some error here:\n'+error_message);
            }
        },
        error: function(response_data) {
            // console.log(response_data);
        }
    });
});
