/**
 * Delete confirmation
 * 
 */
$('button[name="delete-me"]').on('click', function(e){
    e.preventDefault();
    var $form=$(this).closest('form');
    $('#confirm-delete').on('click', '#delete', function(e) {
       $form.trigger('submit'); // submit the form
   });
});

/**
 * Update confirmation
 * 
 */
$('button[name="update-me"]').on('click', function(e){
    e.preventDefault();
    var $form=$(this).closest('form');
    $('#confirm-update').on('click', '#update', function(e) {
       $form.trigger('submit'); // submit the form
   });
});

/**
 * Fade Out Alert Message
 */
$('.alert-flash').delay(2000).fadeOut(400)


/**
 * Add More Fields
 */
$(document).ready(function() {
    var max_fields      = 5; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID

    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            $(wrapper).append('<div class="store-photos"><input name="photo['
            + x +']" type="file" class="col-md-8 store-file"><a href="#" class="remove_field col-md-4">Remove</a><div>'); //add input box
            x++; //text box increment
        }
    });

    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })

    /**
     * Disable button if no file uploaded
     */
    $('input:file.photos-add').change(
        function(){
            if ($(this).val()) {
                $('.btn-add').attr('disabled',false);
            } 
        }
    );

    $('input:file.photos-update').change(
        function(){
            if ($(this).val()) {
                $('.btn-update').attr('disabled',false);
            } 
        }
    );
});


// Tag Mapping on change select option
$('.store-name').change(function() {
    $('.tag-list').empty();
    $('.product-list').empty();

    fetchTags();
    fetchProducts();
});

/**
 * Fetch Tags by Store Id
 * 
 * @param  $storeId
 * @return mixed
 */
function fetchTags()
{
    // Get the store id from the store select
    var storeId = $('.store-name').find(":selected").val();

    $.ajax({
        type: 'GET',
        url: '/admin/tag-mapping/fetchTags/'+storeId,
        error: function() {
           console.log('Error!');
        },
        success: function(data) {
            console.log(data)
            $.each(data, function(i, item) {
                $('.tag-list').append($('<option>', { 
                    value: i,
                    text : item 
                }));
            });
        }
    });
}

/**
 * Fetch Products by Store Id
 * 
 * @param  $storeId
 * @return mixed
 */
function fetchProducts()
{
    // Get the store id from the store select
    var storeId = $('.store-name').find(":selected").val();

    $.ajax({
        type: 'GET',
        url: '/admin/tag-mapping/fetchProducts/'+storeId,
        error: function() {
           console.log('Error!');
        },
        success: function(data) {
            console.log(data)
            $.each(data, function(i, item) {
                $('.product-list').append($('<option>', { 
                    value: i,
                    text : item 
                }));
            });
        }
    });
}