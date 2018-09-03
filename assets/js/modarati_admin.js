jQuery(document).ready(function() {
    jQuery('#clients_brands').DataTable();
});

jQuery(document).on('click', 'a.delete_item', function(event) {
   event.preventDefault();
   event.stopPropagation();

   if(confirm('Are you sure? It can not be undone!')) {
       var id = parseInt(jQuery(this).data('id'));

       if(typeof id != 'number' || id == '') {
           return;
       }

       var data = {
           action: 'tm_delete_post',
           post_id: id
       };

       jQuery.ajax({
           method: 'post',
           url: url.ajaxurl,
           data: data,
           success: function(response_data) {
               if(response_data.success) {
                   location.reload();
               }
           },
           error: function(response_data) {
                console.log(response_data.error_message);
           }
       });
   }
});