$(document).ready(()=>{
    //Making an array of file mapping so that we could know on client side the
    //Exact path on server
     $fileMappingRemotePath = [];

        // *************************** files upload dropzone initilization *******************

        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $uploadsDocsPaths = [];

        if ($().dropzone && !$(".dropzone").hasClass("disabled")) {
           $(".dropzone").dropzone({
              url: "/orders/files-upload",
              headers: {
                'x-csrf-token': CSRF_TOKEN,
              },
            //   uploadMultiple: true,
              acceptedFiles: ".jpeg,.jpg,.png,.pdf",
              removedfile: function(file) {
                if($fileMappingRemotePath[file.name])
                {
                    //Mapping of this file exists
                    delete $fileMappingRemotePath[file.name];
                }
                file.previewElement.remove();

                // var name = file.name;
                // $.ajax({
                //   type: 'POST',
                //   url: 'upload.php',
                //   data: {name: name,request: 2},
                //   sucess: function(data){
                //      console.log('success: ' + data);
                //   }
                // });
                // var _ref;
                //  return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
              },
              init: function () {
                this.on("sending", function (file, xhr ,formData) {
                  });

                this.on("success", function (file, responseText) {
                  // ************* set the image name as value into hidden input field ****

                  //Making a map for each file
                  $fileMappingRemotePath[file.name]=responseText;
                  $uploadsDocsPaths.push(responseText);
                });
                //Code added by Malik Ahsan Aftab
                //Handling exception
                this.on("error", function(file, errormessage, xhr){
                    if(xhr) {
                        var responseObj = JSON.parse(xhr.responseText);
                        alert(responseObj.message);
                    }
                });
              },
              thumbnailWidth: 160,
              previewTemplate: '<div class="dz-preview dz-file-preview mb-3"><div class="d-flex flex-row "><div class="p-0 w-30 position-relative"><div class="dz-error-mark"><span><i></i></span></div><div class="dz-success-mark"><span><i></i></span></div><div class="preview-container"><img data-dz-thumbnail class="img-thumbnail border-0" /><i class="simple-icon-doc preview-icon" ></i></div></div><div class="pl-3 pt-2 pr-2 pb-1 w-70 dz-details position-relative"><div><span data-dz-name></span></div><div class="text-primary text-extra-small" data-dz-size /><div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div><div class="dz-error-message"><span data-dz-errormessage></span></div></div></div><a href="#/" class="remove" data-dz-remove><i class="glyph-icon simple-icon-trash"></i></a></div>'
            });
        }
})
