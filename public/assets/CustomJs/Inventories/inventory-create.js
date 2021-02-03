//Making a variable to keep elements unique
var idMaker = 1;
$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });



/************* Initializing Select2**************** */

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



$('#type').select2({
    theme: "bootstrap",
    placeholder:"Select type",

});
/************* Formating  Select2 Data**************** */

function FormatResult(item) {
    var markup = "";
    if (item.name !== undefined) {
        markup += "<option value='" + item.id + "' title='" + item.id + "'>" + item.name + "</option>";
    }
    return markup;
}


/************* Create New Inventory Form********** */

// $('#type').on('change',function(){

//     addInventoryFormFields();
// });

// $('#quantity').on('keyup',function(){

//     addInventoryFormFields();


// });


$('.addInventoryItem').on('click',function(){

    $inventoryType=$('#type').val();
    if($inventoryType=="allocation")
    {
        addInventoryTypeAllocationFormFields();
    }
});

function addInventoryTypeAllocationFormFields()
{


    $inputFields=`<div class="card d-flex mb-3 inventoryItemContainer">
    <div class="d-flex flex-grow-1 min-width-zero collapseHeader" data-toggle="collapse" data-target="#collapse${idMaker}"
        aria-expanded="true" aria-controls="collapse${idMaker}">
        <button type="button" class="card-body btn btn-empty list-item-heading text-left text-one">
            Inventory item 1
        </button>
        <span><i class="fas fa-times m-4 remove-inventory-item btnDeleteItems" id="btnDeleteItem"></i></span>
    </div>
    <div id="collapse${idMaker++}" class="collapse collapseContent" data-parent="#accordion">
        <div class="card-body accordion-content">
            <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Color</label>
                    <select class="form-control colors" id="color1" name="colors[]" id="color1" data-width="100%">
                        <option value="">Select</option>
                        <option value="red">Red</option>
                        <option value="white">White</option>
                        <option value="blue">Blue</option>

                    </select>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Engine No</label>
                    <input type="text" class="form-control engineNos" id="engineNo1" name="engineNos[]"  placeholder="Engine No">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Chasis No</label>
                    <input type="text" class="form-control chasisNos" id="chasisNo1" name="chasisNos[]"  placeholder="Chasis No">
                </div>
            </div>

        </div>
    </div>
</div>
</div>`;


$('#accordion').append($inputFields);


        // rerenderIds('collapseHeader', 'collapse');
        // rerenderIds('collapseContent', 'collapse');
        rerenderIds('colors', 'color');
        rerenderIds('engineNos', 'engineNo');
        rerenderIds('chasisNos', 'chasisNo');
        rerenderIds('btnDeleteItems', 'btnDeleteItem');


        // $('.inventoryItemContainer').accordion('refresh');

}




$(document).on('click', '.btnDeleteItems', function () {
    $(this).parents('.inventoryItemContainer').remove();
    // rerenderIds('collapseHeader', 'collapse');
    // rerenderIds('collapseContent', 'collapse');
    rerenderIds('colors', 'color');
    rerenderIds('engineNos', 'engineNo');
    rerenderIds('chasisNos', 'chasisNo');
    rerenderIds('btnDeleteItems', 'btnDeleteItem');



});


/********** Rerender Input Fields Ids ****************/

function rerenderIds(inputFields,idPrefix) {

    if(inputFields=="collapseHeader")
    {
        var list = $('.' + inputFields);
        for (var i = 0; i < list.length; i++) {
            $(list[i]).attr('data-target', idPrefix + (i + 1));
            $(list[i]).attr('aria-controls', idPrefix + (i + 1));


        }
    }

    else
    {

        var list = $('.' + inputFields);
    for (var i = 0; i < list.length; i++) {
        $(list[i]).attr('id', idPrefix + (i + 1));

    }
    }

}

/************* Product Price Add Form Validation********** */
    jQuery("#formAddInventory").validate({
        errorPlacement: function (error, element) {
            error.insertAfter(element.parents(".form-group"));
        },

        errorClass: "error",

        submitHandler: function (form) {
            addInventory(form);
        },

        rules: {
            "product": {
                required: true,
            },
            "version": {
                required: true,
            },
            "type": {
                required: true,
            },
        },
        messages: {
            "product": {
                required: "Please select a product",
            },
            "version": {
                required: "Please select a version",
            },
            "type": {
                required: "Please select a type",
            },
        }
    });

    jQuery('[id^=engineNo]').each(function(e) {
        jQuery(this).rules('add', {
            minlength: 2,
            required: true,
            messages: {
              required: "Please enter engine no",
            }
        });
    });

    jQuery('[id^=engineNo]').each(function(e) {
        jQuery(this).rules('add', {
            minlength: 2,
            required: true,
            messages: {
              required: "Please enter engine no",
            }
        });
    });

    jQuery('[id^=color]').each(function(e) {
        jQuery(this).rules('add', {
            required: true,
            messages: {
              required: "Please select a color",
            }
        });
    });

    jQuery('[id^=chasisNo]').each(function(e) {
        jQuery(this).rules('add', {
            minlength: 2,
            required: true,
            minlength: 2,
            messages: {
              required: "Please enter chassis no",
            }
        });
    });

    function addInventory(form) {
        $.ajax({
            url: "/inventories",
            type: "post",
            data: new FormData(form),
            contentType: false,
            cache: false,
            processData: false,
            success: (response) => {
                console.log(response);
                if (response.success) {
                    $.notify(response.success, "success");
                    window.location.href = window.location.protocol + '//' + window.location.hostname +":"+window.location.port+"/inventories";

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
