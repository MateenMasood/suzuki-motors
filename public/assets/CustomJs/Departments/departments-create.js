//===================== Rock & Roll ===============================//
// ********************************************************************
// ******* file created and written by mateen masood updated by Malik Ahsan Aftab **************
// ************* date : 27-sep-2020 ******************************
// ************* date : 07-oct-2020 ******************************
// ****************** js file-name:departments-create.js ******************
// ****************** view file name : Departments/Department-create.blade.php ****
// ****************** controller name : Departments/DepartmentController *********


// ********* providde convenient CSRF protection for your AJAX based applications *****
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
// ****************************************************************
$(document).ready(()=>{

    // ********************* form validation ***********

      $("#formCreate").validate({

        errorPlacement:function (error , element) {
          error.insertAfter(element.parents(".form-group"))
        },
            rules: {
                name: {
                    required: true,
                    lettersonly: true
                },

            },
            messages: {
                name: {
                    required: "Please enter department Name",

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
        url: '/departments',
        type: 'POST',
        data: createFormData,
        contentType: false,
        processData: false,

        success: (response)=>{
            if (response) {
                $.notify('Department added successfully.' , 'success'  );
                window.location.href = window.location.protocol + '//' + window.location.hostname +":"+window.location.port+"/departments";

            }else{
                $.notify('error! please try again' , 'error');
            }
        },
        error: (errorResponse)=>{
          console.log("Error response " , errorResponse)
          //Writing code to print all errors
          let errors = errorResponse.responseJSON.errors;
          if(errors)
            {
              Object.keys(errors).forEach( key => {
                let errorType = errors[key];
                Object.keys(errorType).forEach(k => {
                  let error = errorType[k];
                  $.notify(error , 'error'  );
                });
              })
          }else{
            $.notify('Something went while adding order' , 'error'  );
          }

        }
    })

}
