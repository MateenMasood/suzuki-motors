// ****************************************************************
// ******* file created and written by mateen masood **************
// ************* date : 12-12-2020 ******************************
// ****************** js file-name:insurance-company-create.js ******************
// ****************** view file name : AddOns/InsuranceComapnies/insurance-comapny-create.blade.php ****
// ****************** controller name : AddOns/InsuranceComapnies/InsuranceCompanyController *********


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

    // *********************** date of birth *******************
    $.validator.addMethod("birth", function (value, element) {
        var year = value.split('/');
        if ( value.match(/^\d\d?\/\d\d?\/\d\d\d\d$/) && parseInt(year[2]) <= 2002 )
            return true;
        else
            return false;
    });

    // ************************* phone number validation **********

    $('#phoneNo').keydown(function(){

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

    // ********************* form validation ***********

      $("#formCreate").validate({

        errorPlacement:function (error , element) {
          error.insertAfter(element.parents(".form-group"))
        },



            rules: {
                name: {
                    required: true,
                    // lettersonly: true
                },
                email: {
                    required: true,
                    email:true,
                },
                phoneNo: {
                    required: true,
                    validPhoneNo:true,

                },
                address: {
                    required: true,
                    // number:true,
                },

            },
            messages: {

                firstName: {
                    required: "Please enter company Name*",
                    // lettersonly: "Please enter employee  Name*",
                } ,
                email: {
                    required: "Please enter company email*",
                    // lettersonly: "Please enter employee  Name*",
                } ,
                phoneNo: {
                    required: "Please enter company phone number*",
                    validPhoneNo: "Please enter valid phone number*",
                },
                address: {
                    required: "Please enter company address*",
                    // number: "Please enter valid phone number*",
                },
            },

            submitHandler: function(form) {

                form_Create(form);
            }

      });

})

// ****************** create from ajax request ********************
// ***************** for adding product tinot database ************

function form_Create(formData) {

var createFormData = new FormData (formData);

        $.ajax({
        url: '/insurance-comapny',
        type: 'POST',
        data: createFormData,
        contentType: false,
        processData: false,

        success: (response)=>{
            if (response.status == 'true') {
                $.notify(response.message , 'success'  );
                window.location.href = window.location.protocol + '//' + window.location.hostname +":"+window.location.port+"/insurance-comapny";

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
