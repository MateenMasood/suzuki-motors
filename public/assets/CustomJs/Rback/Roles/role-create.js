// ****************************************************************
// ******* file created and written by mateen masood **************
// ************* date : 27-sep-2020 ******************************
// ****************** js file-name:product-create.js ******************
// ****************** view file name : Products/Products-create.blade.php ****
// ****************** controller name : Products/ProductController *********


// ********* providde convenient CSRF protection for your AJAX based applications *****
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
// ****************************************************************
$(document).ready(()=>{

        // ***************** letters only and allow space in a name only *********

        jQuery.validator.addMethod("lettersonly", function(value, element) {
            return this.optional(element) || /^[a-z\s]+$/i.test(value);
        }, "Only alphabetical characters");


    // ********************* form validation ***********

      $("#formCreate").validate({

        errorPlacement:function (error , element) {
          error.insertAfter(element.parents(".form-group"))
        },
            rules: {
                role: {
                    required: true,
                    lettersonly: true
                },

            },
            messages: {
                role: {
                    required: "Please enter role name",

                } ,

            },

            submitHandler: function(form) {
                // console.log(myDropzone.files[0].name)

               form_Create(form);
            }

      });

})

// ****************** create from ajax request ********************
// ***************** for adding product tinot database ************

function form_Create(formData) {
//    let createFormData = $('#formCreate').serialize();
var createFormData = new FormData (formData);
    // console.log(createFormData);
    $.ajax({
        url: '/roles',
        type: 'POST',
        data: createFormData,
        contentType: false,
        processData: false,

        success: (response)=>{
            if (response.status) {
                $.notify(response.message , 'success'  );
                window.location.href = window.location.protocol + '//' + window.location.hostname +":"+window.location.port+"/roles";

            }else{
                $.notify(response.message , 'error');

            }
        },
        error: (errorResponse)=>{
            $.each( errorResponse.responseJSON.errors, function( key, value ) {
                $.notify(value[0], "error");
              });
        }
    })

}
