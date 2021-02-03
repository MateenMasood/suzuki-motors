$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
function assignPermission(value) {
    $id = $('input[value='+value+']').attr('id');
    $permissionStatus = '';

    if ($("#"+$id).is(':checked')) {
        $permissionStatus = 'checked';
    }else{
        $permissionStatus = 'unchecked';

    }

    $.ajax({
        url: '/roles/assign-permissions-to-role',
        type: 'POST',
        data: {permission: value , role: roleId , status: $permissionStatus},

        success: (response)=>{
            if (response.status) {
                // $.notify(response.message , 'success'  );
            }else{
                // $.notify(response.message , 'error');

            }
        },
        error: (errorResponse)=>{
            // $.notify( errorResponse, 'error'  );


        }
    })

}
