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

// ************* image upload dropzone
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    if ($().dropzone && !$(".dropzone").hasClass("disabled")) {
       $(".dropzone").dropzone({
          url: "/products--image-upload",
          headers: {
            'x-csrf-token': CSRF_TOKEN,
          },


          acceptedFiles: ".jpeg,.jpg,.png,.pdf",
          init: function () {
            this.on("sending", function (file, xhr ,formData) {


              });

            this.on("success", function (file, responseText) {

              // ************* set the image name as value into hidden input field ****
              $('#image').val(responseText);

            });
          },
          thumbnailWidth: 160,
          previewTemplate: '<div class="dz-preview dz-file-preview mb-3"><div class="d-flex flex-row "><div class="p-0 w-30 position-relative"><div class="dz-error-mark"><span><i></i></span></div><div class="dz-success-mark"><span><i></i></span></div><div class="preview-container"><img data-dz-thumbnail class="img-thumbnail border-0" /><i class="simple-icon-doc preview-icon" ></i></div></div><div class="pl-3 pt-2 pr-2 pb-1 w-70 dz-details position-relative"><div><span data-dz-name></span></div><div class="text-primary text-extra-small" data-dz-size /><div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div><div class="dz-error-message"><span data-dz-errormessage></span></div></div></div><a href="#/" class="remove" data-dz-remove><i class="glyph-icon simple-icon-trash"></i></a></div>'
        });
    }



    // *****************initilization company select2 ****************

    $("#company").select2();

    // *****************initilization branchId select2 ****************
    // $("#branchId").select2({});

    $("#branchId").select2({
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
        formatResult: FormatResult,
    });


    /************* Formating  Select2 Data**************** */

function FormatResult(item) {
    var markup = "";
    if (item.name !== undefined) {
        markup += "<option value='" + item.id + "' title='" + item.id + "'>" + item.name + "</option>";
    }
    return markup;
}


    // ********************* form validation ***********

      $("#formCreate").validate({

        errorPlacement:function (error , element) {
          error.insertAfter(element.parents(".form-group"))
        },



            rules: {
                name: {
                    required: true,
                    // lettersonly: true
                },
                company: {
                    required: true,

                },
                branchId: {
                    required: true,


                },
                description: {
                    required: true,

                },

            },
            messages: {
                name: {
                    required: "Please enter your  Name",
                    // lettersonly: "Please user only letter for your name "
                } ,
                description: 'Please enter product description',
                company: 'Please select company Name',
                branchId: 'Please select branch',
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
        url: '/products',
        type: 'POST',
        data: createFormData,
        contentType: false,
        processData: false,

        success: (response)=>{
            if (response) {
                $.notify('successfull! product added successfully' , 'success'  );
            }else{
                $.notify('error! please try again' , 'error');

            }
        },
        error: (errorResponse)=>{
            $.notify('error! please try again' , 'error'  );


        }
    })

}
