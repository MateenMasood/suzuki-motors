// ****************************************************************
// ******* file created and written by mateen masood **************
// ************* date : 31-oct-2020 ******************************
// ****************** js file-name:corporate-create.js ******************
// ****************** view file name : Corporate/corporate-create.blade.php ****
// ****************** controller name : Corporate/corporateController *********


// ********* providde convenient CSRF protection for your AJAX based applications *****
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
// ****************************************************************
$(document).ready(()=>{

            // ************************* phone number validation **********

            $('#contact').keydown(function(){

                //allow  backspace, tab, ctrl+A, escape, carriage return
                if (event.keyCode == 8 || event.keyCode == 9
                                  || event.keyCode == 27 || event.keyCode == 13
                                  || (event.keyCode == 65 && event.ctrlKey === true) )
                                      return;
                if((event.keyCode < 48 || event.keyCode > 57))
                 event.preventDefault();

                var length = $(this).val().length;

                if(length == 4)
                 $(this).val($(this).val()+'-');

               });

               $.validator.addMethod("validPhoneNo", function (value, element) {

                // ********************************
                var phone_no = value;

                var phone_no_regex = /^[0][3][0-5+][\d]{1}-[\d]{7}$/;

                if(phone_no_regex.test(phone_no))
                {
                    return true;
                }
                else
                {
                    return false;
                }
            });

    // *****************initilization type select2 ****************

    $("#type").select2();

    // ********************* form validation ***********

      $("#formCreate").validate({

        errorPlacement:function (error , element) {
          error.insertAfter(element.parents(".form-group"))
        },



            rules: {
                type: {
                    required: true,
                    // lettersonly: true
                },
                name: {
                    required: true,
                    // lettersonly: true
                },
                contact: {
                    required: true,
                    validPhoneNo:true,

                },
                email: {
                    required: true,
                    email: true,


                },
                address: {
                    required: true,

                },
                description: {
                    required: true,

                },

            },
            messages: {
                type:  "Please select corporate type*",
                name: {
                    required: "Please enter corporate  Name*",
                    // lettersonly: "Please user only letter for your name "
                } ,
                contact: {
                    required: 'Please enter corporate contact*',
                    number: 'Please enter valid number*',
                },
                email: {
                    required: "Please enter corporate email*",
                    email: "Please enter valid email*"
                } ,
                address: 'Please enter corporate address*',
                description: 'Please enter description*',
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
        url: '/corporates',
        type: 'POST',
        data: createFormData,
        contentType: false,
        processData: false,

        success: (response)=>{
            if (response.status == 'true') {
                $.notify(response.message , 'success'  );
                window.location.href = window.location.protocol + '//' + window.location.hostname +":"+window.location.port+"/corporates";

            }else{
                $.notify(response , 'error');

            }
        },
        error: (errorResponse)=>{
            $.each( errorResponse.responseJSON.errors, function( key, value ) {
                $.notify(value[0], "error");
              });
        }
    })

}
