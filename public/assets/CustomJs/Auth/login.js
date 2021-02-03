
/************* Branch Add Form Validation********** */
jQuery("#loginForm").validate({
    errorPlacement: function (error, element) {
        error.insertAfter(element.parents(".form-group"));
    },

    errorClass: "error",

    submitHandler: function (form) {
        return true;
    },

    rules: {
        "email": {
            required: true,
            email: true
        },
        "password": {
            required: true,
        },

    },
    messages: {
        "email": {
            required: "Please enter your email",
            email: "Please enter valid email "
        },
        "password": {
            required: "Please enter password",
        },

    }
});
