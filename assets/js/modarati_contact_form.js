jQuery(document).ready(function(event) {});

jQuery(document).on('change', 'input.form_info', function(event) {
    if(jQuery(this).hasClass('error') && jQuery(this).val() != '') {
        jQuery(this).removeClass('error');
    }
});

jQuery(document).on('change', 'textarea', function(event) {
    if(jQuery(this).hasClass('error') && jQuery(this).val() != '') {
        jQuery(this).removeClass('error');
    }
});

jQuery(document).on('click', 'input.form__btn', function(event) {
    event.preventDefault();
    event.stopPropagation();

    var data = {};
    var flag = false;

    jQuery(this).closest('form').find('input.form_info').each(function(index, value) {
        if(jQuery(value).val() == '') {
            jQuery(value).addClass('error');
            flag = true;
            return true;
        }

        data[jQuery(value).attr('name')] = jQuery(value).val();
    });

    var question = jQuery(document).find('textarea').val();

    if(question == '') {
        jQuery(document).find('textarea').addClass('error');
        flag = true;
    } else {
        jQuery(document).find('textarea').removeClass('error');
    }

    data['sender_question'] = jQuery(document).find('textarea').val();

    if(flag) {
        return;
    }

    data['action'] = 'tm_send_email';

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

                jQuery(response_data.error_messages).each(function(index, value) {
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