// ****************************************************************
// ******* file created and written by mateen masood **************
// ************* date : 14-oct-2020 ******************************
// ****************** js file-name:product-hold.js ******************
// ****************** view file name : Products/Products-hold.blade.php ****
// ****************** controller name : Products/HoldProductController *********


// ********* providde convenient CSRF protection for your AJAX based applications *****
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
// ****************************************************************
$(document).ready(()=>{



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


     // *****************initilization color select2 ****************

    $('#color').select2({
        theme: "bootstrap",
        placeholder: "Select a color",
    });

     // *****************initilization inventory  items select2 ****************

    $("#inventoryItem").select2({
        theme: "bootstrap",
        // dir: direction,
        allowClear: true,
        placeholder: "Select a model",
        "pagination": {
            "more": true
          },
        // minimumResultsForSearch: Infinity,
        // dropdownParent:$('#formContainer'),
        // containerCssClass: ":all:",
        ajax: {
            url: "/inventories/select2-inventory-items-type-allocation",
            type: "get",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    searchTerm: params.term,
                    versionId: $("#version").val(),
                    color: $("#color").val(),
                };
            },
            processResults: function (response) {
                return {
                    results: $.map(response, function (obj) {
                        return {
                            text: "Engine-No-"+obj.engine_no+"Chasis-No-"+obj.chassis_no,
                            id: obj.id
                        }
                    }),
                }
            },
            cache: true
        },
        formatResult: FormatResult,
    });

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
                customerName: {
                    required: true,
                    lettersonly: true
                },
                customerPhoneNo: {
                    required: true,
                    number:true,

                },
                productName: {
                    required: true,


                },
                version: {
                    required: true,

                },
                color: {
                    required: true,

                },
                inventoryItem:{
                    required: true,
                },
                tokenAmount:{
                    required: true,
                    number:true,

                },
                description:{
                    required: true,
                },

            },
            messages: {

                customerName: {
                    required: "Please enter customer  Name*",

                } ,
                customerPhoneNo: {
                    required: "Please enter customer phone number*",
                    number: "Please enter valid phone number*",
                },
                productName: "Please select product*",
                version: 'Please Select version-Model*',
                color: 'Please select product color*',
                inventoryItem: 'Please select product item*',
                tokenAmount: 'Please enter token amount*',
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
        url: '/product-hold',
        type: 'POST',
        data: createFormData,
        contentType: false,
        processData: false,

        success: (response)=>{
            if (response == 'true') {
                $.notify('successfull! product hold successfully' , 'success'  );
            }else{
                $.notify('error! please try again' , 'error');

            }
        },
        error: (errorResponse)=>{
            $.notify('error! please try again' , 'error'  );


        }
    })

}
