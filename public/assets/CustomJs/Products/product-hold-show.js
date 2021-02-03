// ********************** written and modified by mateen masood *******************
// ********************* date monday-oct-12 2020 ********************************
// ********************************************************************************

// ********* providde convenient CSRF protection for your AJAX based applications *****
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(document).ready(()=>{



    // ************ trigger canacel enquiry event here *********
    var switchStatus = false;
    $("#switch").on('change', ()=>{

        if($('#switch').prop('checked') == true){
            inventoryStatus(true);
        }else{
            inventoryStatus(false);
        }
    });

    // ****************** check the inventory status *****************

    if($('#defultInventoryStatus').val() == 'HOLD'){
        $('#switch').prop('checked', true);

    }else{
        $('#switch').prop('checked', false);

    }


    // ************************ product hold status change trigger event here ******************

    function inventoryStatus($switchButoonStatus) {

        $inventoryId = $('#inventoryId').val();

        $.ajax({
                    url: '/product-hold/inventory-status',
                    type: 'POST',
                    data: {inventoryId: $inventoryId , inventoryCurrentStatus: $switchButoonStatus},

                    success: (response)=>{
                        console.log(response);
                        if (response.status == 'HOLD') {
                            $('#switch').prop('checked', true);
                            $('#inventoryStatus').text(response.status)
                            $.notify(response.message , 'success')
                        }else if(response.status == 'UNHOLD') {

                            $('#switch').prop('checked', false);
                            $('#inventoryStatus').text(response.status)
                            $.notify(response.message , 'success')
                        }else{
                            $.notify(response.message , 'error');
                        }
                    },
                    error: (errorResponse)=>{
                        $.notify('error! please try again' , 'error'  );


                    }
                })


    }


    // *************** trigger  mature enquiry trigger event here ******************
    $('#btnSale').on('click' , ()=>{

        $productHoldId  = $("#productHoldId").val();


        $.ajax({
            url: '/product-hold/putUpForSale',
            type: 'POST',
            data: { productHoldId: $productHoldId },

            success: (response)=>{

                if (response == 'true') {

                    $.notify('Processed for sale successfully' , 'success')
                    window.location.href = '/orders/create';
                }else{

                    $.notify('error! some error occured please try again' , 'error')
                }

            },
            error: (errorResponse)=>{
                $.notify(errorResponse , 'error')

            }
        })

    });



});
