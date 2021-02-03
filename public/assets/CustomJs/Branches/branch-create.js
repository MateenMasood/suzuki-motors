$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

/************* Branch Add Form Validation********** */
    jQuery("#formAddBranch").validate({
        errorPlacement: function (error, element) {
            error.insertAfter(element.parents(".form-group"));
        },

        errorClass: "error",

        submitHandler: function (form) {
            addBranch(form);
        },

        rules: {
            "name": {
                required: true,
            },
            "email": {
                required: true,
            },
            "contact": {
                required: true,
                // regex: /^[+-]{1}[0-9]{1,3}\-[0-9]{10}$/,
                // regex: /^((\+92)|(0092))-{0,1}\d{3}-{0,1}\d{7}$|^\d{11}$|^\d{4}-\d{7}$/,
            },
            "dealerCode": {
                required: true,
            },
            "keyPerson1Contact": {
                required: true,
            },
            "keyPerson2Contact": {
                required: true,
            },
            "address": {
                required: true,
            },

        },
        messages: {
            "name": {
                required: "Please enter a branch name",
            },
            "email": {
                required: "Please enter a branch email",
            },
            "contact": {
                required: "Please enter a branch phone",
                regex: 'Please enter a phone no. - nn nnnn nnnn.'
            },
            "dealerCode": {
                required: "Please enter a branch dealer code",
            },
            "keyPerson1Contact": {
                required: "Please enter a branch key person 1 contact",
            },
            "keyPerson2Contact": {
                required: "Please enter a branch key person 2 contact",
            },
            "address": {
                required: "Please enter a branch address",
            },

        }
    });

    function addBranch(form) {
        $.ajax({
            url: "/branches",
            type: "post",
            data: new FormData(form),
            contentType: false,
            cache: false,
            processData: false,
            success: (response) => {
                console.log(response);
                if (response.success) {
                    $.notify(response.success, "success");
                    window.location.href = window.location.protocol + '//' + window.location.hostname +":"+window.location.port+"/branches";

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
