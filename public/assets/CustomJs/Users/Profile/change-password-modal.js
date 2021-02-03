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

    // ********************* form validation ***********

      $("#formPasswordUpdate").validate({

        errorPlacement:function (error , element) {
          error.insertAfter(element.parents(".form-group"))
        },



            rules: {
                oldPassword: {
                    required: true,
                },
                newPassword: {
                    required: true,
                    minlength: 5,
                },
                confirmPassword: {
                    required: true,
                    minlength: 5,
                    equalTo: "#newPassword"
                },

            },
            messages: {
                oldPassword: {
                    required: "Please enter your old password*",
                },
                newPassword: {
                    required: "Please enter your password*",
                    // number: "Please enter valid phone number*",
                },
                confirmPassword: {
                    required: "Please enter confirm password*",
                    equalTo: "your passwword is not matching",

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
        url: '/user-profile/change-password',
        type: 'POST',
        data: createFormData,
        contentType: false,
        processData: false,

        success: (response)=>{
            if (response.status == 'true') {
                $.notify(response.message , 'success'  );
            }else{
                $.notify(response.message , 'error');

            }
        },
        error: (errorResponse)=>{
            $.notify(errorResponse.message , 'error'  );


        }
    })

}
