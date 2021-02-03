let stringDivider = "__!__";
$(document).ready(function () {
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	var basicPrice = 0;
	var advanceTax = 0;
	var totalPrice = 0;
	var handelingCharges = 0;
	var warrantyPrice = 0;
	var insurancePrice = 0;
	var registrationFee = 0;
	var jumboPackCharges = 0;
	var otherCharges = 0;
	var totalAmount = 0;

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
					productId: $('#product').val(),
					searchTerm: params.term,
				};
			},
			processResults: function (response) {

				return {
					results: $.map(response, function (obj) {
						return {
							text: obj.variant_label + "-" + obj.model,
							id: obj.id
						}
					}),
				}
			},
			cache: true
		},
		formatResult: FormatProductVersionModel,
	});

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
							text: obj.engine_no +stringDivider+ obj.chassis_no,
							id: obj.id
						}
					}),
				}
			},
			cache: true
		},
        templateResult: FormatInventorySelect2Result,
        formatResult : function(item){
            console.log("The item slected " , item)

            item.text = item.text.split(stringDivider).join(" ");
            return item;
        }
	});

    function FormatInventorySelect2Result (item) {

        if (!item.id) {
          return item.text;
        }

        var $item = $(
          `
          <!--<div class="numberCircle">A</div>-->
            <div class="inlnblck">
                <b>Engine No# </b>${item.text.split(stringDivider)[0]}</span><br>
                <b>Chassis No# </b><span>${item.text.split(stringDivider)[1]}</span>
            </div>`
        );

         return $item;
      };

	// Get Item invoice price

	$('#version').on('change', function () {

		var data = {
			'versionId': $("#version").val(),
			'customerTaxStatus': $("#customerTaxStatus").val()
		};

		$.ajax({
			url: "/products-prices/product-invoice-price",
			type: "get",
			data: data,
			// contentType: false,
			// cache: false,
			// processData: false,
			success: (response) => {
				console.log(response);
				//total of basic price and advance tax
				if (response.itemPrice && response.itemPrice.length != 0) {
					let oldBasicPrice = basicPrice;
					let oldTotalPrice = totalPrice;
					basicPrice = parseInt(response.itemPrice.invoice_price);
					totalPrice -= oldBasicPrice;
					totalPrice += basicPrice;
					totalAmount -= oldTotalPrice;
					totalAmount += totalPrice;


					//inventory prices data
					$('#basicPrice').val(basicPrice);
					$('#totalPrice').val(totalPrice);
					$('#totalAmount').val(totalAmount);

				} else {
					let oldBasicPrice = basicPrice;
					let oldTotalPrice = totalPrice;
					basicPrice = 0;
					totalPrice -= oldBasicPrice;
					totalPrice += basicPrice;
					totalAmount -= oldTotalPrice;
					totalAmount += totalPrice;

					//inventory prices data
					$('#basicPrice').val(basicPrice);
					$('#totalPrice').val(totalPrice);
					$('#totalAmount').val(totalAmount);

				}


			},
			error: (errorResponse) => {


			},
		});
	});

	// Get Item tax amount

	$('#customerTaxStatus').on('change', function () {
		var data = {
			'versionId': $("#version").val(),
			'customerTaxStatus': $("#customerTaxStatus").val()
		};

		$.ajax({
			url: "/tax-amounts/tax-amount",
			type: "get",
			data: data,
			// contentType: false,
			// cache: false,
			// processData: false,
			success: (response) => {
				console.log(response);
				//inventory prices data
				if (response.taxAmount && response.taxAmount.length != 0) {
					let oldAdvanceTax = advanceTax;
					let oldTotalPrice = totalPrice;
					advanceTax = parseInt(response.taxAmount.tax_amount)
					totalPrice -= oldAdvanceTax;
					totalPrice += advanceTax;
					totalAmount -= oldTotalPrice;
					totalAmount += totalPrice;

					$('#advanceTax').val(advanceTax);
					$('#totalPrice').val(totalPrice);
					$('#totalAmount').val(totalAmount);

				} else {
					let oldAdvanceTax = advanceTax;
					let oldTotalPrice = totalPrice;
					advanceTax = 0
					totalPrice -= oldAdvanceTax;
					totalPrice += advanceTax;
					totalAmount -= oldTotalPrice;
					totalAmount += totalPrice;
					$('#totalPrice').val(totalPrice);
					$('#advanceTax').val(advanceTax);
					$('#totalAmount').val(totalAmount);


				}


			},
			error: (errorResponse) => {


			},
		});

    });

    //manage handeling charges

    $('#handelingCharges').on('keyup',function(){

                    if($(this).val()!='')
                    {
                    let oldHandelingCharges = handelingCharges;
					handelingCharges = parseInt($(this).val())
					totalAmount -= oldHandelingCharges;
					totalAmount += handelingCharges;
                    $('#totalAmount').val(totalAmount);
                    }
                    else
                    {
                    let oldHandelingCharges = handelingCharges;
					handelingCharges = 0
					totalAmount -= oldHandelingCharges;
                    totalAmount += handelingCharges;
                    $('#totalAmount').val(totalAmount);
                    }

    });


    //manage jumbo pack charges

    $('#jumboPack').on('keyup',function(){

        if($(this).val()!='')
        {
        let oldJumboPackCharges = jumboPackCharges;
        jumboPackCharges = parseInt($(this).val())
        totalAmount -= oldJumboPackCharges;
        totalAmount += jumboPackCharges;
        $('#totalAmount').val(totalAmount);
        }
        else
        {
            let oldJumboPackCharges = jumboPackCharges;
            jumboPackCharges = 0
            totalAmount -= oldJumboPackCharges;
            totalAmount += jumboPackCharges;
            $('#totalAmount').val(totalAmount);
        }

});

    //manage other charges

    $('#otherCharges').on('keyup',function(){

        if($(this).val()!='')
        {
        let oldOtherCharges = otherCharges;
        otherCharges = parseInt($(this).val())
        totalAmount -= oldOtherCharges;
        totalAmount += otherCharges;
        $('#totalAmount').val(totalAmount);
        }
        else
        {
            let oldOtherCharges = otherCharges;
            otherCharges = 0
            totalAmount -= oldOtherCharges;
            totalAmount += otherCharges;
            $('#totalAmount').val(totalAmount);
        }

});




	// Populate Engine Chasis

	$('#inventoryItem').on('change', function () {

		var data = {
			'inventoryItemId': $('#inventoryItem').val(),
			'versionId': $("#version").val(),
		};
		console.log(data);
		$.ajax({
			url: "/inventories/inventory-item-engine-chasis",
			type: "get",
			data: data,
			// contentType: false,
			// cache: false,
			// processData: false,
			success: (response) => {
				console.log(response);
				//inventory item data
				$('#engineNo').val(response.item.chassis_no);
				$('#chasisNo').val(response.item.engine_no);


			},
			error: (errorResponse) => {


			},
		});
	});


	$('#orderType').select2({
		theme: "bootstrap",
		placeholder: "Select a order type",
	});

	$('#customerType').select2({
		theme: "bootstrap",
		placeholder: "Select a customer type",
	});

	$('#customerTaxStatus').select2({
		theme: "bootstrap",
		placeholder: "Select a customer tax status",
	});

	$('#color').select2({
		theme: "bootstrap",
		placeholder: "Select a color",
	});

	$('#extendedWarrantyPlan').select2({
		theme: "bootstrap",
		placeholder: "Select a warranty plan",
	});
	$('#warrantyPricePlan').select2({
		theme: "bootstrap",
		placeholder: "Select a warranty price plan",
	});

	$('#insurancePlan').select2({
		theme: "bootstrap",
		placeholder: "Select a insurance plan",
	});
	$('#paymentType').select2({
		theme: "bootstrap",
		placeholder: "Select a payment type",
	});


	// Get Warranty price plan and populate in text fields

	$('#warrantyPricePlan').on('change', function () {

		var data = {
			'extendedWarrantyPlan': $('#extendedWarrantyPlan').val(),
			'warrantyPricePlan': $('#warrantyPricePlan').val(),
			'versionId': $("#version").val()
		};
		$.ajax({
			url: "/extended-warranties/extended-warranty-plan",
			type: "get",
			data: data,
			success: (response) => {
				console.log(response);
				if (response.extendedWarranty && response.extendedWarranty.length != 0) {
					// let oldTotalAmount=totalAmount;
					let oldWarrantyPrice = warrantyPrice;
					warrantyPrice = parseInt(response.extendedWarranty.price)
					totalAmount -= oldWarrantyPrice;
					totalAmount += warrantyPrice;

                    $('#warrantyPricePlanId').val(response.extendedWarranty.id);
					$('#warrantyPrice').val(warrantyPrice);
                    $('#totalAmount').val(totalAmount);

				} else {
					let oldWarrantyPrice = warrantyPrice;
					warrantyPrice = 0
					totalAmount -= oldWarrantyPrice;
                    totalAmount += warrantyPrice;

                    $('#warrantyPricePlanId').val('');
					$('#warrantyPrice').val(warrantyPrice);
					$('#totalAmount').val(totalAmount);
				}

			},
			error: (errorResponse) => {


			},
		});
	});

	// Get Insurance price plan and populate in text fields

	$('#insurancePlan').on('change', function () {

		var data = {
			'insurancePlan': $('#insurancePlan').val(),
			'versionId': $("#version").val()
		};
		$.ajax({
			url: "/insurance-programs/insurance-plan",
			type: "get",
			data: data,
			success: (response) => {
				console.log(response);
				if (response.insuranceProgram && response.insuranceProgram.length != 0) {
					// let oldTotalAmount=totalAmount;
					let oldInsurancePrice = insurancePrice;
					insurancePrice = parseInt(response.insuranceProgram.price)
					totalAmount -= oldInsurancePrice;
					totalAmount += insurancePrice;

                    $('#insurancePriceId').val(response.insuranceProgram.id);
					$('#insurancePrice').val(insurancePrice);
					$('#totalAmount').val(totalAmount);

				} else {
					let oldInsurancePrice = insurancePrice;
					insurancePrice = 0;
					totalAmount -= oldInsurancePrice;
					totalAmount += insurancePrice;

                    $('#insurancePriceId').val('');
					$('#insurancePrice').val(insurancePrice);
					$('#totalAmount').val(totalAmount);
				}

			},
			error: (errorResponse) => {


			},
		});
	});
	/************* Formating  Select2 Data**************** */


	function FormatResult(item) {
		var markup = "";
		if (item.name !== undefined) {
			markup += "<option value='" + item.id + "' title='" + item.id + "'>" + item.name + "</option>";
		}
		return markup;
	}
	function FormatProductVersionModel(item) {
		var markup = "";
		if (item.variant_label !== undefined) {
			markup += "<option value='" + item.id + "' title='" + item.id + "'>" + item.variant_label + `-` + item.model + "</option>";
		}
		return markup;
	}


	/************* Set Intial Values from enquiry ********** */

	if (typeof enquiryProductCustomer != 'undefined' && enquiryProductCustomer.length != 0) {
		$('#enquiryNo').val(enquiryProductCustomer.enquiry_id);
		$('#customerName').val(enquiryProductCustomer.customer.name);
		$('#customerContact').val(enquiryProductCustomer.customer.contact);

		var option = new Option(
			enquiryProductCustomer.product_version.product.name,
			enquiryProductCustomer.product_version.product.id,
			true,
			true
		);
		$("#product")
			.append(option)
			.trigger("change");


		var option = new Option(
			enquiryProductCustomer.product_version.variant_label + '-' + enquiryProductCustomer.product_version.model,
			enquiryProductCustomer.product_version.id,
			true,
			true
		);
		$("#version")
			.append(option)
			.trigger("change");

    }


    /************* Set Intial Values from product hold ********** */

	if (typeof productHoldProductInventoryCustomer !="undefined"  && productHoldProductInventoryCustomer.length != 0) {

        console.log(productHoldProductInventoryCustomer);


		$('#customerName').val(productHoldProductInventoryCustomer.customer.name);
		$('#customerContact').val(productHoldProductInventoryCustomer.customer.contact);

		var option = new Option(
			productHoldProductInventoryCustomer.inventory.product_version.product.name,
			productHoldProductInventoryCustomer.inventory.product_version.product.id,
			true,
			true
		);
		$("#product")
			.append(option)
			.trigger("change");


		var option = new Option(
			productHoldProductInventoryCustomer.inventory.product_version.variant_label + '-' + productHoldProductInventoryCustomer.inventory.product_version.model,
			productHoldProductInventoryCustomer.inventory.product_version.id,
			true,
			true
		);
		$("#version")
			.append(option)
            .trigger("change");


            var option = new Option(
			productHoldProductInventoryCustomer.inventory.color,
			productHoldProductInventoryCustomer.inventory.color,
			true,
			true
		);
		$("#color")
			.append(option)
            .trigger("change");

            var option = new Option(
                productHoldProductInventoryCustomer.inventory.engine_no+'-'+productHoldProductInventoryCustomer.inventory.chassis_no,
                productHoldProductInventoryCustomer.inventory.id,
                true,
                true
            );
            $("#inventoryItem")
                .append(option)
                .trigger("change");


                $('#product,#version,#color,#inventoryItem').prop("disabled", true);
                $("#engineNo,#chasisNo").prop("readonly", true);


    }


	/************* Enable Disable Registration Fee and get registration fee value ********** */


	$('#switchRegistrationFee').on('change', function () {

		if ($(this).prop("checked") == true) {

			$("#registrationFee").prop("disabled", false);

			var data = {
				'versionId': $("#version").val()
			};
			$.ajax({
				url: "/registration-fee/registration-fee",
				type: "get",
				data: data,
				success: (response) => {
					console.log(response);
					if (response.registrationFee && response.registrationFee.length != 0) {
						let oldRegistrationFee = registrationFee;
						registrationFee = parseInt(response.registrationFee.fee_amount)
						totalAmount -= oldRegistrationFee;
						totalAmount += registrationFee;

                        $('#registrationFeeId').val(response.registrationFee.id);
						$('#registrationFee').val(registrationFee);
						$('#totalAmount').val(totalAmount);

					} else {
						let oldRegistrationFee = registrationFee;
						registrationFee = 0
						totalAmount -= oldRegistrationFee;
						totalAmount += registrationFee;

                        $('#registrationFeeId').val('');
						$('#registrationFee').val(registrationFee);
						$('#totalAmount').val(totalAmount);
					}

				},
				error: (errorResponse) => {


				},
			});

		} else {
			let oldRegistrationFee = registrationFee;
			registrationFee = 0
			totalAmount -= oldRegistrationFee;
			totalAmount += registrationFee;

            $('#registrationFeeId').val('');
			$('#registrationFee').val(registrationFee);
			$('#totalAmount').val(totalAmount);
			$("#registrationFee").prop("disabled", true);


		}
	});


	/************* Disable engine chasis text fields when order type is booking********** */


	$('#orderType').on('change', function () {

        if (typeof productHoldProductInventoryCustomer !="undefined"  && productHoldProductInventoryCustomer.length != 0) {
            return;
        }
		if ($(this).val() == "Booking") {
			$("#inventoryItem,#engineNo,#chasisNo").prop("disabled", true);
		} else {
			$("#inventoryItem,#engineNo,#chasisNo").prop("disabled", false);
		}

	})


});
