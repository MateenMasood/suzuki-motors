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


        // ************************* phone number validation **********

        $('#branchPhoneNo').keydown(function(){

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



    // *****************initilization Bank select2 ****************

    $("#bankId").select2({

        theme: "bootstrap",
        // dir: direction,
        allowClear: true,
        placeholder: "Select a branch",
        "pagination": {
        "more": true
        },

        // minimumResultsForSearch: Infinity,
        // dropdownParent:$('#formContainer'),
        // containerCssClass: ":all:",
        ajax: {
            url: "/banks/select2-banks",
            type: "get",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                     searchTerm: params.term,
                };
            },
            processResults: function (response) {
                return {
                    results: $.map(response, function (obj) {
                        return {
                            text: obj.name,
                            id: obj.id
                        }
                    }),
                }
            },
            cache: true
        },

        // formatResult: FormatResult,

    });

    /***** Formating  Select2 Data****** */

    function FormatResult(item) {
        var markup = "";
        if (item.name !== undefined) {
            markup += "<option value='" + item.id + "' title='" + item.id + "'>" + item.name + "</option>";
        }
        return markup;
    }

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
                branchName: {
                    required: true,
                    // lettersonly: true
                },
                bankId: {
                    required: true,
                    number:true,
                },
                branchCode: {
                    required: true,
                    number:true,
                },
                branchPhoneNo: {
                    required: true,
                    validPhoneNo:true,

                },
                branchAddress: {
                    required: true,
                },



            },
            messages: {

                branchName: {
                    required: "Please enter branch name*",

                } ,
                bankId: "Please select bank*",
                branchCode: "Please enter branch code*",
                branchPhoneNo: {
                    required: "Please enter  phone number*",
                    number: "Please enter valid phone number*",
                },
                branchAddress: "Please enter branch address*",

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
        url: '/bank-branches',
        type: 'POST',
        data: createFormData,
        contentType: false,
        processData: false,

        success: (response)=>{
            if (response == 'true') {
                $.notify('successfull! enquiry added successfully' , 'success'  );
                window.location.href = window.location.protocol + '//' + window.location.hostname +":"+window.location.port+"/bank-branches";

            }else{
                $.notify('error! please try again' , 'error');

            }
        },
        error: (errorResponse)=>{
            $.each( errorResponse.responseJSON.errors, function( key, value ) {
                $.notify(value[0], "error");
              });


        }
    })

}
