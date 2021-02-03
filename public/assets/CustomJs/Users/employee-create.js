// ****************************************************************
// ******* file created and written by mateen masood **************
// ************* date : 31-oct-2020 ******************************
// ****************** js file-name:employee-create.js ******************
// ****************** view file name : Users/employee-create.blade.php ****
// ****************** controller name : USers/EmployeeController *********


// ********* providde convenient CSRF protection for your AJAX based applications *****
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
// ****************************************************************
$(document).ready(()=>{

    // ********************** initlization of departments select2 ***************

    $("#department").select2({
        theme: "bootstrap",
        // dir: direction,
        allowClear: true,
        placeholder: "Select a department",
        "pagination": {
            "more": true
          },
        // minimumResultsForSearch: Infinity,
        // dropdownParent:$('#formContainer'),
        // containerCssClass: ":all:",
        ajax: {
            url: "/departments/select2-departments",
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

    // ********************** initilizing branch select2 ***********

    /************* Initializing Select2**************** */

$("#branch").select2({
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
        url: "/branches/select2-branches",
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




    // *****************initilization role select2 ****************

    $("#role").select2({

        theme: "bootstrap",
        // dir: direction,
        allowClear: true,
        placeholder: "Select a role",
        "pagination": {
        "more": true
        },

        // minimumResultsForSearch: Infinity,
        // dropdownParent:$('#formContainer'),
        // containerCssClass: ":all:",
        ajax: {
            url: "/roles/select2-roles",
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

    // function FormatResult(item) {
    //     var markup = "";
    //     if (item.name !== undefined) {
    //         markup += "<option value='" + item.id + "' title='" + item.id + "'>" + item.name + "</option>";
    //     }
    //     return markup;
    // }

    // *****************initilization model select2 ****************


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

    $('#cnic').keydown(function(){

        //allow  backspace, tab, ctrl+A, escape, carriage return
        if (event.keyCode == 8 || event.keyCode == 9
                          || event.keyCode == 27 || event.keyCode == 13
                          || (event.keyCode == 65 && event.ctrlKey === true) )
                              return;
        if((event.keyCode < 48 || event.keyCode > 57))
         event.preventDefault();

        var length = $(this).val().length;

        if(length == 5 || length == 13)
         $(this).val($(this).val()+'-');

       });

    // ********************** cnic validation *************

    $.validator.addMethod("validCnic", function (value, element) {

        // ********************************
        var cnic_no = value;

        var cnic_no_regex = /^[0-9+]{5}-[0-9+]{7}-[0-9]{1}$/;

        if(cnic_no_regex.test(cnic_no))
        {
            return true;
        }
        else
        {
            return false;
        }
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
                firstName: {
                    required: true,
                    lettersonly: true
                },
                lastName: {
                    required: true,
                    lettersonly: true
                },
                email: {
                    required: true,
                    email:true,
                },
                phoneNo: {
                    required: true,
                    validPhoneNo:true,

                },
                password: {
                    required: true,
                    // number:true,
                },
                confirmPassword: {
                    required: true,
                    equalTo: "#password"
                },
                department: {
                    required: true,
                    number: true,

                },
                cnic: {
                    required: true,
                    validCnic: true,

                },
                dob: {
                    required: true,

                },
                role: {
                    required: true,
                    number: true,
                },
                branch: {
                    required: true,
                    number: true,
                },
                address:{
                    required: true,
                },

            },
            messages: {

                firstName: {
                    required: "Please enter employee first Name*",
                    // lettersonly: "Please enter employee  Name*",
                } ,
                lastName: {
                    required: "Please enter employee last Name*",
                    // lettersonly: "Please enter employee  Name*",
                } ,
                phoneNo: {
                    required: "Please enter employee phone number*",
                    validPhoneNo: "Please enter valid phone number*",
                },
                password: {
                    required: "Please enter password*",
                    // number: "Please enter valid phone number*",
                },
                confirmPassword: {
                    required: "Please enter confirm password*",
                    equalTo: "your passwword is not matching",

                    // number: "Please enter valid phone number*",
                },
                email: {
                    required: "Please enter employee email*",
                    number: "Please enter valid email address",
                },
                cnic: {
                    required: "Please enter cnic number*",
                    validCnic: "Please enter valid cnic",
                },
                dob: {
                    required: "Please enter date of birth*",
                },
                department: "Please select department*",
                role: 'Please select role*',
                branch: 'Please select branch*',
                address: 'Please enter address* ',
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
        url: '/users',
        type: 'POST',
        data: createFormData,
        contentType: false,
        processData: false,

        success: (response)=>{
            if (response.status == 'true') {
                $.notify(response.message , 'success'  );
                window.location.href = window.location.protocol + '//' + window.location.hostname +":"+window.location.port+"/users";

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
