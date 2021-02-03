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



    // *****************initilization productName select2 ****************

    $("#productName").select2({

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
            url: "/products/select2-products",
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

        formatResult: FormatResult,

    });

    /***** Formating  Select2 Data****** */

    function FormatResult(item) {
        var markup = "";
        if (item.name !== undefined) {
            markup += "<option value='" + item.id + "' title='" + item.id + "'>" + item.name + "</option>";
        }
        return markup;
    }


    // *****************initilization model select2 ****************

    // *****************initilization version select2 ****************
    $("#version").select2({
        theme: "bootstrap",
        // dir: direction,
        allowClear: true,
        placeholder: "Select a version",
        "pagination": {
            "more": true
          },
        // minimumResultsForSearch: Infinity,
        // dropdownParent:$('#formContainer'),
        // containerCssClass: ":all:",
        ajax: {
            url: "/product/versions-models",
            type: "get",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    productId:$('#productName').val(),
                    searchTerm: params.term,
                };
            },
            processResults: function (response) {

                return {
                    results: $.map(response, function (obj) {
                        return {
                            text: obj.variant_label+"-"+obj.model,
                            id: obj.id
                        }
                    }),
                }
            },
            cache: true
        },
        // formatResult: FormatProductVersionModel,
    });

    // ***************** letters only and allow space in a name only *********

    jQuery.validator.addMethod("lettersonly", function(value, element) {
        return this.optional(element) || /^[a-z\s]+$/i.test(value);
    }, "Only alphabetical characters");


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
                customerName: {
                    required: true,
                    lettersonly: true
                },
                phoneNo: {
                    required: true,
                    validPhoneNo:true,

                },
                version: {
                    required: true,

                },
                description: {
                    required: true,

                },
                productName:{
                    required: true,
                },

            },
            messages: {

                customerName: {
                    required: "Please enter customer  Name*",

                } ,
                phoneNo: {
                    required: "Please enter customer phone number*",
                    number: "Please enter valid phone number*",
                },
                productName: "Please select product*",
                version: 'Please select version*',
                description: 'Please enter description* ',
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
        url: '/enquiries',
        type: 'POST',
        data: createFormData,
        contentType: false,
        processData: false,

        success: (response)=>{
                $.notify(response , 'success'  );
                window.location.href = window.location.protocol + '//' + window.location.hostname +":"+window.location.port+"/enquiries";
        },
        error: (errorResponse)=>{
            $.each( errorResponse.responseJSON.errors, function( key, value ) {
                $.notify(value[0], "error");
              });


        }
    })

}
