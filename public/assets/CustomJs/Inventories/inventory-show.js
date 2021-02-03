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


console.log(inventoryJavaScriptData);
    // ************ trigger canacel enquiry event here *********
    var switchStatus = false;

    $("input[type=radio][name=changeInventoryStatus]").on('change', ()=>{

        if((inventoryJavaScriptData.current_status == 'PENDING') && (inventoryJavaScriptData.type == 'Booking') && (inventoryJavaScriptData.chassis_no == null) && (inventoryJavaScriptData.engine_no == null) && ($("input[name=changeInventoryStatus]:checked").val() == 'TRANSITION') ){

            $bookingInputFields = `
                <div class="card-body" id="containerEngineChassisNoForm">

                    <form id="formAddedEngineChassis">
                        <div class="row">

                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label for="engineNo">Engine No</label>
                                    <input type="text" class="form-control input-sm" id="engineNo" name="engineNo"  placeholder="Engine No" >
                                </div>
                            </div>


                            <div class="col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label for="chassisNo">Chassis No</label>
                                    <input type="text" class="form-control input-sm" id="chassisNo" name="chassisNo"  placeholder="Chassis No" >
                                </div>
                            </div>

                        </div>
                        <button type="submit" class="btn btn-primary mb-0">Submit</button>

                    </form>


                </div>
            `;

            $('#bookingInputFields').html($bookingInputFields).animate();
            $("#formAddedEngineChassis").validate({
                errorPlacement: function (error, element) {
                    error.insertAfter(element.parents(".form-group"));
                },

                errorClass: "error",

                submitHandler: function (form) {

                    addInventoryEngineChassisNo(form);
                    return false;
                },

                rules: {
                    "engineNo": {
                        required: true,
                        number: true,
                    },
                    "chassisNo": {
                        required: true,
                        number: true,
                    },
                },
                messages: {
                    "engineNo": {
                        required: "Please enter engine Number",
                    },
                    "chassisNo": {
                        required: "Please enter chassis Number",
                    },
                }
            });

        }else{


            $('#containerEngineChassisNoForm').remove();
            $statusValue = $('input[type=radio][name=changeInventoryStatus]:checked').val()
            $inventoryId = $('#inventoryId').val();
            inventoryStatus($statusValue , $inventoryId);

        }
    });

    // ******************************* validate daynamically added booking form ***********




    // ****************** check the inventory status *****************



    // console.log(inventoryInfoJavaScriptData.vlaue);
    if(inventoryInfoJavaScriptData.vlaue == 'STOCKIN'){

        $("#stockIn").attr('checked', 'checked');
        $("#stockIn").parent().addClass('active');


    }else if (inventoryInfoJavaScriptData.vlaue == 'TRANSITION') {

        $("#transition").attr('checked', 'checked');
        $("#transition").parent().addClass('active');


    }else{

        $("#pending").attr('checked', 'checked');
        $("#pending").parent().addClass('active');


    }




    // ************************* added engine cassis number in case of booking *******************

    function addInventoryEngineChassisNo(form) {

    $data = $('#formAddedEngineChassis').serialize();

        $.ajax({
            type: 'PATCH',
            url: '/inventories/'+inventoryJavaScriptData.id,
            data: $data,
            success: (response)=>{
                console.log(response);

                // return;
                if (response.status == 'true') {

                    $('#engineNumber').text($('#engineNo').val())
                    $('#chassissNumber').text($('#chassisNo').val())

                    $statusValue = $('input[type=radio][name=changeInventoryStatus]:checked').val()
                    $inventoryId = $('#inventoryId').val();
                    inventoryStatus($statusValue , $inventoryId);

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


    // ************************ product hold status change trigger event here ******************

    function inventoryStatus($statusValue , $inventoryId  ) {

        $inventoryId = $('#inventoryId').val();
        $.ajax({
                    url: '/inventories/inventory-status',
                    type: 'POST',
                    data: {inventoryId: $inventoryId , inventoryStatus: $statusValue },

                    success: (response)=>{
                        console.log(response);
                        if (response.status == 'true') {

                            $('#defultInventoryStatus').text($statusValue)
                            $.notify(response.message , 'success')

                        }else{

                            $.notify(response , 'error');

                        }
                    },
                    error: (errorResponse)=>{
                        $.notify('error! please try again' , 'error'  );


                    }
                })


    }



});

