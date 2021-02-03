	/************* Product Price Add Form Validation********** */
	jQuery("#formAddOrder").validate({
		errorPlacement: function (error, element) {
			error.insertAfter(element.parents(".form-group"));
		},

		errorClass: "error",

		submitHandler: function (form) {
			addOrder(form);
		},

		// rules: {
		// 	"branch": {
		// 		required: true,
		// 	},
		// 	"product": {
		// 		required: true,
		// 	},
		// 	"version": {
		// 		required: true,
		// 	},
		// 	"model": {
		// 		required: true,
		// 	},
		// 	"taxpayerType": {
		// 		required: true,
		// 	},
		// 	"invoicePrice": {
		// 		required: true,
		// 		digits: true,
		// 		minlength: 5,
		// 	},
		// 	// "description": {
		// 	//     required: true,
		// 	// },
		// },
		// messages: {
		// 	"branch": {
		// 		required: "Please select a branch",
		// 	},
		// 	"product": {
		// 		required: "Please select a product",
		// 	},
		// 	"version": {
		// 		required: "Please select a version",
		// 	},
		// 	"model": {
		// 		required: "Please select a model",
		// 	},
		// 	"taxpayerType": {
		// 		required: "Please select a taxpayer Type",
		// 	},
		// 	"invoicePrice": {
		// 		required: "Please enter a invoice price",
		// 	},

		// }
	});

	function addOrder(form) {

        $('#product,#version,#color,#inventoryItem').prop("disabled", false);


        $formData=new FormData(form);
        Object.keys($fileMappingRemotePath).map(key=>$formData.append('docs[]',$fileMappingRemotePath[key]) );

		$.ajax({
			url: "/orders",
			type: "post",
			data: $formData,
			contentType: false,
			cache: false,
			processData: false,
			success: (response) => {
				console.log(response);
				if (response) {
                    $.notify(response.success, "success");
                    window.location.href = window.location.protocol + '//' + window.location.hostname +":"+window.location.port+"/orders";

				}
			},
			error: (errorResponse) => {
                console.log("Response exception" , errorResponse)
                let error = errorResponse.responseJSON.error;
                $.notify(  error+".Code :87329#$" , "error");

			},
		});
	}
