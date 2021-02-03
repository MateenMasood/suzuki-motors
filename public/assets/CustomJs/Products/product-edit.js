// ****************************************************************
// ******* file created and written by Muhammad Ahsan Aftab Malik **************
// ************* date : 22-nov-2020 ******************************
// ****************** js file-name:product-edit.js ******************
// ****************** view file name : Products/Products-edit.blade.php ****
// ****************** controller name : Products/ProductController *********


// ********* provide convenient CSRF protection for your AJAX based applications *****
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  })

//Edited by Malik Ahsan on 08/10/2020
//Integerating Product versions
//Will use this variable to store template html of add version row
var divVersionTemplate;
var divVersionTemplateHtml;

//Versions html for global use
let optionHTML = '';

//Variants which will be deleted
let variantsToBeDeleted = [];

// ****************************************************************
$(document).ready(()=>{
    //Since select2 is unable to initially set the value
    //Way around is to set an attribute and then ask select2 to set value
    $(".select2-single")
      .each(
          function(i , elem)
          {
            let value = $(elem).attr('data-val');
            $(elem).val(value).trigger("change");
          } );

    //Initializing Model select options so that user can select
    let allModels = JSON.parse($("#versionOptionsInput").attr("data-options") ) .map(elem=>{
      //Since we have to set tags inpiut as well
      $('#versionsTGInput').tagsinput('add', elem.variant_label);
      //Making html for select options
      return `<option value="${elem.variant_label}" >${elem.variant_label}</option>`;
    });
    $("select.versionFields").html(allModels.join());
    $("select.versionFields").each((k , elem)=>{
      let actualValue = $(elem).attr('data-val')
      if(actualValue)
        $(elem).val(actualValue).trigger('change')
    })
    //Setting up html of select options
    optionHTML = allModels.join();

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
            //Code added by Malik Ahsan Aftab
            //Handling exception
            this.on("error", function(file, errormessage, xhr){
                if(xhr) {
                    var responseObj = JSON.parse(xhr.responseText);
                    alert(responseObj.message);
                }
            });
          },
          removedfile: function(file) {
            $(file)[0].previewElement.remove()
            $('#image').val("");
          },
          thumbnailWidth: 160,
          previewTemplate: '<div class="dz-preview dz-file-preview mb-3"><div class="d-flex flex-row "><div class="p-0 w-30 position-relative"><div class="dz-error-mark"><span><i></i></span></div><div class="dz-success-mark"><span><i></i></span></div><div class="preview-container"><img data-dz-thumbnail class="img-thumbnail border-0" /><i class="simple-icon-doc preview-icon" ></i></div></div><div class="pl-3 pt-2 pr-2 pb-1 w-70 dz-details position-relative"><div><span data-dz-name></span></div><div class="text-primary text-extra-small" data-dz-size /><div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div><div class="dz-error-message"><span data-dz-errormessage></span></div></div></div><a href="#/" class="remove" data-dz-remove><i class="glyph-icon simple-icon-trash"></i></a></div>'
        });
    }



    // *****************initilization company select2 ****************

    $("#company").select2();

    // *****************initilization branchId select2 ****************
    $("#branchId").select2({});



  //Code added by Malik Ahsan Aftab on 08/20/2020
  //Since we have multiple versions of a product
  //Thus i am saving the html of a single product template
  //Once we have the template of asingle we can add as many as we want to add a row
  divVersionTemplate = $("#divVersionTemplate");

  //getting the html to have a tempolate string to remove row
  divVersionTemplateHtml =
                          `<div class="col-sm-8 clearfix mt-2 row">
                              <div class="form-group col-5">
                                <input type="text" class="versionFields form-control model" name="model[]"
                                    placeholder="Model" data-provide="typeahead"
                                    autocomplete="off"
                                    data-rule-required="true" data-msg-required="Model must not be empty."
                                    data-rule-minlength="3" data-msg-required="Model must be at least 3 characters long.">
                                <span class="error-label error"></span>
                              </div>
                              <div class="form-group col-5">
                                <select type="text" class="form-control versionFields version" name="version[]"
                                    placeholder="Label" data-provide="typeahead"
                                    data-rule-required="true" data-msg-required="Version must not be empty.">
                                    <!--options placeholder-->
                                </select>
                                <span class="error-label error"></span>
                              </div>
                              <div class="input-group-append ">
                                      <button type="button" class="btn btn-primary default rowAction" >
                                          <i class="iconsminds-add"></i>
                                      </button>
                              </div>
                          </div>`;

  //Rules for auto generation of new rows
  //Last row remove icon
  removeVersionRowEventListener();
  addVersionRowEventListener();

  /* Versions Input */
  if ($().tagsinput) {
    $(".tags").tagsinput({
      cancelConfirmKeysOnEmpty: true,
      confirmKeys: [13]
    });

    $("body").on("keypress", ".bootstrap-tagsinput input", function (e) {
      if (e.which == 13) {
        e.preventDefault();
        e.stopPropagation();
      }
    });
  }

  //Adding validations to form controls
  // Initialize form validation on the registration form.
  addFormValidation();

})

// ****************** create from ajax request ********************
// ***************** for adding product tinot database ************

function  form_Create(formData) {
   let createFormData = $('#formCreate').serialize()+`&tobedeleted=${JSON.stringify(variantsToBeDeleted)}`;
   console.log("After serializing", createFormData)
// var createFormData = new FormData (formData);
    // console.log(createFormData);
    $.ajax({
        url: '/products/'+id,
        type: 'PUT',
        data: createFormData ,
        // contentType: false,
        // processData: false,
        async : false ,
        success: (response)=>{
            try{
                $.notify(response.message , "success");
                window.location.href = window.location.protocol + '//' + window.location.hostname +":"+window.location.port+"/products";
            }catch(err)
            {
              console.log("Errors occured" , err)
              $.notify(err , "error")
            }
        },
        error: (errorResponse)=>{
          // console.log("Errors response" , errorResponse)
          for(const err in errorResponse.responseJSON.errors)
          {
              $.notify(errorResponse.responseJSON.errors[err] , "error")
          }
        }
    })

}

//Code Added by Malik Ahsan Aftab
//This method will add a version row to html in form body
function addTemplate(divNode){
    //Change last Row button ui to delete and red etc
    //so that it depicts that this buttton removes the row
    let btnWhoseUiToChange = $('.rowRemoveAction').last();
    btnWhoseUiToChange.html('<i class="iconsminds-remove"></i>');
    btnWhoseUiToChange.css('background' , 'indianred');

    //Append html template
    divNode.append(divVersionTemplateHtml.split("<!--options placeholder-->").join(optionHTML));

    //Binding Event listeners
    addVersionRowEventListener();
    removeVersionRowEventListener();
}
//this method will bind click event listener to add icon
function addVersionRowEventListener(){
  $(".rowAction").on("click" ,
                      function() {
                          //Remove all previous listeners
                           $('.rowAction').unbind('click');

                           //Remove rowAction class and add row delete class
                           $('.rowAction').addClass('rowRemoveAction').removeClass('rowAction')
                          addTemplate(divVersionTemplate)
                          adJustNames('model,version');

                        });
                        // addFormValidation();


}

//This method will bind remove functionality evenet listener
function removeVersionRowEventListener(){
  $(".rowRemoveAction").on("click" ,
                      function() {
                          //Since may be the case that this row is to be deleted so keeping the record of rows which will be deleted from database
                          //Getting
                          let variantId = $(this).attr("data-id");
                          variantsToBeDeleted.push(variantId);

                          //Remove row
                          $(this).closest('.clearfix').remove() ;
                          adJustNames('model,version');
                        });
                        // addFormValidation();
}


//This method will validation to versions form
function addFormValidation(){
  //Since product info form is static thus it's rules are static
  let ProductFormRules = {
         errorPlacement:function (error , element) {
           error.insertAfter(element.parents(".form-group").find(".error-label").length ? element.parents(".form-group").find(".error-label") : element.parents(".form-group") )
         },
         submitHandler: function(form) {
           let arr=[];
           variantsToBeDeleted
                    .forEach((elem)=> { if(elem)arr[elem]=true; });
           variantsToBeDeleted = Object.keys(arr);
           // console.log("Variants to be deleted" , variantsToBeDeleted, form , arr)
           //  return false;
             // console.log(myDropzone.files[0].name)
             try{
                  let errors = [];
                 //Validate models and versions
                 $(".model").each(function(i , obj){
                   if($.trim($(obj).val()) == '' ){
                     $(obj).next().html("Please provide model.");
                     //Keeping a copy of errors
                     // errors.push(obj);
                   }else{
                     $(obj).next().html("")
                   }
                 });
                 $(".version").each(function(i , obj){
                   if($.trim($(obj).val()) == '' ){
                     $(obj).next().html("Please provide version.")
                     //Keeping a copy of errors
                     // errors.push(obj);

                   }else{
                     $(obj).next().html("")
                   }
                 });
                 //Check if an image is selected or not
                 if( $('#image').val().trim() == "" && $(".img").length < 1 )
                 {
                   throw "Please select an image."
                 }

                //Just in case the error occured
                if(errors.length > 0)
                  throw "Error occured.";

                 form_Create(form);
              }catch(err){
                 console.log("Exception occured" , err)
                 $.notify(err , 'error'  );
              }
         },
         ignore : [],
         rules: {
               name: {
                   required: true,
                   lettersonly: true,
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
                   lettersonly: "Product name must contain letters only."
               },
               description: 'Please enter product description.',
               company: 'Please select company Name.',
               branchId: 'Please select branch.',
           }
        };
    //remove validations on entire form
     $("form[name='frmProduct']").validate(ProductFormRules);
}

//This method will rename models and versions name attribute for validation plugin to work properly
function adJustNames(inpSelectors){
  console.log("Adjust names called args" , inpSelectors);
  inpSelectors
    .split(",")
      .forEach(inputSelector => {
        let i =0 ;
        $('.'+inputSelector)
          .each(function(index , inputNode){
            console.log("running for index :"+i , ($(inputNode).attr('name').split('[')[0] )+'['+ (parseInt(i))+`]`) ;
            // $(inputNode).attr('name' , ($(inputNode).attr('name').split('[')[0] )+'['+ (parseInt(i++))+`]`)
            // $(inputNode).rules('add', {
            //     required: true,
            //     minlength: 2,
            //     messages: {
            //       required: "This field is required.",
            //       minlength: "Please, at least 2 characters are necessary."
            //     }
            // });
          })
      })
}
// $("#myform").validate({
//   highlight: function(element, errorClass, validClass) {
//     $(element).addClass(errorClass).removeClass(validClass);
//     $(element.form).find("label[for=" + element.id + "]")
//       .addClass(errorClass);
//   },
//   unhighlight: function(element, errorClass, validClass) {
//     $(element).removeClass(errorClass).addClass(validClass);
//     $(element.form).find("label[for=" + element.id + "]")
//       .removeClass(errorClass);
//   }
// });
function addVersions(form){
  $.ajax({
    type: "POST",
    url: "/product-versions",
    data: new FormData(form),
    contentType : false ,
    processData: false,
    success: function(msg){
          console.log(msg);
          alert( "Data Saved: " + msg );
    },
    error: function(XMLHttpRequest, textStatus, errorThrown) {
       alert("some error");
    }
  });
}

//Based on the user added tags
//If the user adds or removes a tag this method will be called as a listener
function changeVersionOptions(obj){
    //We have all versions
    let allTags = $(obj).val();

    console.log(divVersionTemplateHtml);
    //Refresh all select versions
    optionHTML = '';
    allTags.split(",").forEach(model=>{
        optionHTML += `<option value="${model}" class="" >${model}</option>`;
    })
    $('.version').html(optionHTML)
}
//A method to remove image previously added
function removeImage(element){
  $target = $(element).closest(".imgParent");
  $target.hide('slow', function(){ $target.remove(); });
}
