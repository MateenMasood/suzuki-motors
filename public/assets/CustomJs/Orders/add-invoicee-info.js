/********* This File will create Invoicee info input Fields on the base of customer type *******/
$(document).ready(function(){

    $('#customerType').on('change',function(){

        $customerType=$(this).val();
        $('#invoiceeType').css('display','none');
        $('#invoiceeTypeContainer').hide(1000, "linear");
        $('#invoiceInName').val('');

        /***********  customer type bank **********/

        if($customerType=="Bank")
        {

           var invoiceeTypeBankInputFields=`<div class="row">
        <div class="col-md-6">
           <div class="form-group">
               <label for="name">Bank</label>
               <select class="form-control" id="bank" name="bank" data-width="100%">
                   <option value="">Select</option>
               </select>
           </div>
       </div>

       <div class="col-md-6">
           <div class="form-group">
               <label for="name">Bank Branch</label>
               <select class="form-control" id="bankBranch" name="bankBranch" data-width="100%">
                   <option value="">Select</option>
               </select>
           </div>
       </div>

       <div class="col-md-6">
           <div class="form-group">
               <label for="name">Bank Agent</label>
               <select class="form-control" id="bankAgent" name="bankAgent" data-width="100%">
                   <option value="">Select</option>
               </select>
           </div>
       </div>
       </div>`

       $('#invoiceeType').html('Bank Info');
       $('#invoiceeType').css('display','block');
       $('#invoiceeTypeContainer').html(invoiceeTypeBankInputFields).show(1000, "linear");


     // *****************initilization Bank select2 ****************

     $("#bank").select2({

        theme: "bootstrap",
        // dir: direction,
        allowClear: true,
        placeholder: "Select a bank",
        "pagination": {
        "more": true
        },

        // minimumResultsForSearch: Infinity,
        // dropdownParent:$('#formContainer'),
        // containerCssClass: ":all:",
        ajax: {
            url: "/banks/select2-banks",
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

        // formatResult: FormatResult,

    });


    // *********************** get bank branch select2 initlization get *************

    $("#bankBranch").select2({
        theme: "bootstrap",
        // dir: direction,
        allowClear: true,
        placeholder: "Select a version",
        "pagination": {
            "more": true
        },

        ajax: {
            url: "/bank-branches/select2-bank-branches",
            type: "get",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    bankId:$('#bank').val(),
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
        // formatResult: FormatProductVersionModel,
    });

      // *********************** get bank branch dealers select2 initlization get *************

      $("#bankAgent").select2({
        theme: "bootstrap",
        // dir: direction,
        allowClear: true,
        placeholder: "Select a bank agent",
        "pagination": {
            "more": true
        },

        ajax: {
            url: "/bank-branch-dealers/select2-bank-branch-dealers",
            type: "get",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    bankBranchId:$("#bankBranch").val(),
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
        // formatResult: FormatProductVersionModel,
    });


    }

    else if ($customerType=="Corporate") {

        var invoiceeTypeBankInputFields=`<div class="row">
        <div class="col-md-6">
           <div class="form-group">
               <label for="name">Corporate</label>
               <select class="form-control" id="corporate" name="corporate" data-width="100%">
                   <option value="">Select</option>
                   <option value="Allocation">Allocation</option>
                   <option value="Booking">Booking</option>
               </select>
           </div>
       </div>
       </div>`

       $('#invoiceeType').html('Corporate Info');
       $('#invoiceeType').css('display','block');
       $('#invoiceeTypeContainer').html(invoiceeTypeBankInputFields).show(1000, "linear");


       $('#corporate').select2({
		theme: "bootstrap",
		placeholder: "Select a corporate",
    });

          // *********************** corporate select2 initlization  *************

          $("#corporate").select2({
            theme: "bootstrap",
            // dir: direction,
            allowClear: true,
            placeholder: "Select a corporate",
            "pagination": {
                "more": true
            },

            ajax: {
                url: "/corporates/select2-corporates",
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
            // formatResult: FormatProductVersionModel,
        });


    }

    else {

    }

    });


    /********* Invoicee Type Bank On Change *******/

    // $('#bank').on('change',function(){

    //     alert("hello");
    // });

    $(document).on('change','#bank',function(){

        var $option = $(this).find('option:selected');
        $('#invoiceInName').val($option.text());

    });

        /********* Invoicee Type Corporate On Change *******/

        $(document).on('change','#corporate',function(){

            var $option = $(this).find('option:selected');
            $('#invoiceInName').val($option.text());

        });


});
