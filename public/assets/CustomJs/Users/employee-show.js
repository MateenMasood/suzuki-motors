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

    $("#cancel").on('click' , ()=>{

        var r = confirm("Are you sure you want to cancel the enquiry!");
        if (r) {
            $cancelStatus = $("#cancel").val();
            $enquiryId  = $("#enquiryId").val();

            $.ajax({
                url: '/enquiries/cancel',
                type: 'POST',
                data: {status: $cancelStatus , id: $enquiryId},

                success: (response)=>{
                    if (response) {
                        $.notify('you cancel the enquiry successfully' , 'success')
                    }else{
                        $.notify('error! please try again' , 'error');

                    }
                },
                error: (errorResponse)=>{
                    $.notify('error! please try again' , 'error'  );


                }
            })

        }



    });


    // *************** trigger  mature enquiry trigger event here ******************

    $('#mature').on('click' , ()=>{

        $enquiryId  = $("#enquiryId").val();
        $EnquiryStatus = $("#mature").val();


        $.ajax({
            url: '/enquiries/mature-enquiry',
            type: 'POST',
            data: { id: $enquiryId , status: $EnquiryStatus},

            success: (response)=>{
                if (response == 'true') {

                    $.notify('your enquiry matured successfully' , 'success')
                }else if(response == 'false'){
                    $.notify('error! some error occured please try again' , 'error')

                }else{

                    $.notify(response , 'error')
                }

            },
            error: (errorResponse)=>{
                $.notify(errorResponse , 'error')

            }
        })

    });



});
