//===================== Fake it till you make it  ===============================//
// ********************************************************************
// ******* file created and written by Malik Ahsan Aftab **************
// ************* date : 15-dec-2020 ******************************
// ****************** js file-name:departments-eidt.js ******************
// ****************** view file name : Departments/Department-edit.blade.php ****
// ****************** controller name : Departments/DepartmentController *********


// ********* providde convenient CSRF protection for your AJAX based applications *****
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// ****************************************************************
$(document).ready(()=>{
  console.log("Edit in file-edit js")
  $( "#DepartmentEditModal" ).on('show.bs.modal', function(){
    // ********************* form validation ***********

      $("#formEdit").validate({
        submitHandler: function(form) {
              var editFormData = {};
              $(form).serializeArray().map(function(item) {
                    if ( editFormData[item.name] ) {
                        if ( typeof(editFormData[item.name]) === "string" ) {
                            editFormData[item.name+""] = [editFormData[item.name]];
                        }
                        editFormData[item.name+""].push(item.value);
                    } else {
                        editFormData[item.name+""] = item.value;
                    }
                });
              console.log(editFormData , form);
              $.ajax({
                  url: '/departments/'+editFormData.id,
                  type: 'Patch',
                  data: JSON.stringify(editFormData),
                  processData: false,
                  contentType: "application/json",

                  success: (response)=>{

                      if (response) {
                          $.notify('Department successfully updated.' , 'success'  );
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
                      $.notify('Something went while updating department' , 'error'  );
                    }

                  }
              })


              return false;
        }
      })
    });
  });
