$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


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
    formatResult: FormatResult,
});


$("#product").select2({
    theme: "bootstrap",
    // dir: direction,
    allowClear: true,
    placeholder: "Select a product",
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
                productId:$('#product').val(),
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


$('#taxpayerType').select2({
    theme: "bootstrap",

});


/************* Formating  Select2 Data**************** */

function FormatResult(item) {
    var markup = "";
    if (item.name !== undefined) {
        markup += "<option value='" + item.id + "' title='" + item.id + "'>" + item.name + "</option>";
    }
    return markup;
}


/************* Product Price Add Form Validation********** */
    jQuery("#formAddTaxAmount").validate({
        errorPlacement: function (error, element) {
            error.insertAfter(element.parents(".form-group"));
        },

        errorClass: "error",

        submitHandler: function (form) {
            addTaxAmount(form);
        },

        rules: {
            "branch": {
                required: true,
            },
            "product": {
                required: true,
            },
            "version": {
                required: true,
            },
            "taxpayerType": {
                required: true,
            },
            "taxAmount": {
                required: true,
                digits: true,
                minlength:4,
            },
        },
        messages: {
            "branch": {
                required: "Please select a branch",
            },
            "product": {
                required: "Please select a product",
            },
            "version": {
                required: "Please select a version",
            },
            "taxpayerType": {
                required: "Please select a taxpayer Type",
            },
            "taxAmount": {
                required: "Please enter a  tax amount",
            },

        }
    });

    function addTaxAmount(form) {
        $.ajax({
            url: "/tax-amounts",
            type: "post",
            data: new FormData(form),
            contentType: false,
            cache: false,
            processData: false,
            success: (response) => {
                console.log(response);
                if (response.success) {
                    $.notify(response.success, "success");
                }
            },
            error: (errorResponse) => {

                console.log(errorResponse.responseJSON.errors);

                    // console.log("hello");
                    // console.log(errorResponse);

                    $.each( errorResponse.responseJSON.errors, function( key, value ) {
                        $.notify(value[0], "error");
                        // $('#'+key).addClass( "error");
                    //     $('#'+key).css('border' , '2px solid red');
                    //     setTimeout(function(){
                    //         $('#'+key).css('border' , '1px solid black');
                    //     } , 4000)
                      });


            },
        });
    }

});