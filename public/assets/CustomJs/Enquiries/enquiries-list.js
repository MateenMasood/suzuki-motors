// ****************************************************************
// ******* file created and written by mateen masood **************
// ************* date : 28-sep-2020 ******************************
// ****************** js file-name:product-list.js ******************
// ****************** view file name : Enquiries/enquiries-list.blade.php ****
// ****************** controller name : Enquiries/EnquiryController *********


$(document).ready(()=>{

    // Datatable with rows
    var $dataTableRows = $("#tblEnquiries").DataTable({
       bLengthChange: false,
       destroy: true,
       info: false,
       sDom: '<"row view-filter"<"col-sm-12"<"float-left"l><"float-right"f><"clearfix">>>t<"row view-pager"<"col-sm-12"<"text-center"ip>>>',
       pageLength: 10,
       ajax: {
           "url": "/enquiries/datatable",
           "dataSrc": ""
       },
       columns: [
         { data : 'id'},
         { data : 'enquiry_id'},
         { data: "customer.name" },
         { data: "customer.contact" },
         { data: "product_version.product.name" },
         { data: "product_version.product.description" },
         { data: "enquiry_status" },
      //    { data: 'base_image',
      //    render: function( data, type, full, meta ) {
      //        return `<img src="` + data + `" height="50">`;
      //    }
      //  },
         { render : function(data, type, row) {
           return `
                   <label class="custom-control custom-checkbox mb-1 align-self-center data-table-rows-check">
                       <input type="checkbox" class="custom-control-input">
                       <span class="custom-control-label">&nbsp;</span>
                   </label>
           `
       }
           },
       ],
       language: {
         paginate: {
           previous: "<i class='simple-icon-arrow-left'></i>",
           next: "<i class='simple-icon-arrow-right'></i>"
         }
       },
       drawCallback: function () {

        $("#tblEnquiries tbody tr").click(function(event) {
            //getting the dtata against the row
            var currentRowData = $dataTableRows.row(this).data();

// return;
            // ************ redirect to another page ******


            window.location.href = "/enquiries/"+currentRowData.id;


          });


         unCheckAllRows();
         $("#checkAllDataTables").prop("checked", false);
         $("#checkAllDataTables").prop("indeterminate", false).trigger("change");

         $($(".dataTables_wrapper .pagination li:first-of-type"))
           .find("a")
           .addClass("prev");
         $($(".dataTables_wrapper .pagination li:last-of-type"))
           .find("a")
           .addClass("next");
         $(".dataTables_wrapper .pagination").addClass("pagination-sm");
         var api = $(this).dataTable().api();
         $("#pageCountDatatable span").html("Displaying " + parseInt(api.page.info().start + 1) + "-" + api.page.info().end + " of " + api.page.info().recordsTotal + " items");
       }
     });

     $dataTableRows.on( 'order.dt search.dt', function () {
       $dataTableRows.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
           cell.innerHTML = i+1;
       } );
    } ).draw();

    // *************** on click ***********

    $('#tblEnquiries tbody').on('dblclick','tr', function() {
        var currentRowData = $dataTableRows.row(this).data();
        alert(currentRowData[0]) // wil give you the value of this clicked row and first index (td)
        //your stuff goes here
    });


     $('#tblEnquiries tbody').on('click', 'tr', function () {
       $(this).toggleClass('selected');
       var $checkBox = $(this).find(".custom-checkbox input");
       $checkBox.prop("checked", !$checkBox.prop("checked")).trigger("change");
       controlCheckAll();
     });

     function controlCheckAll() {
       var anyChecked = false;
       var allChecked = true;
       $('#tblEnquiries tbody tr .custom-checkbox input').each(function () {
         if ($(this).prop("checked")) {
           anyChecked = true;
         } else {
           allChecked = false;
         }
       });
       if (anyChecked) {
         $("#checkAllDataTables").prop("indeterminate", anyChecked);
       } else {
         $("#checkAllDataTables").prop("indeterminate", anyChecked);
         $("#checkAllDataTables").prop("checked", anyChecked);
       }
       if (allChecked) {
         $("#checkAllDataTables").prop("indeterminate", false);
         $("#checkAllDataTables").prop("checked", allChecked);
       }
     }

     function unCheckAllRows() {
       $('#tblEnquiries tbody tr').removeClass('selected');
       $('#tblEnquiries tbody tr .custom-checkbox input').prop("checked", false).trigger("change");
     }

     function checkAllRows() {
       $('#tblEnquiries tbody tr').addClass('selected');
       $('#tblEnquiries tbody tr .custom-checkbox input').prop("checked", true).trigger("change");
     }

     $("#checkAllDataTables").on("click", function (event) {
       var isCheckedAll = $("#checkAllDataTables").prop("checked");
       if (isCheckedAll) {
         checkAllRows();
       } else {
         unCheckAllRows();
       }
     });

     function getSelectedRows() {
       //Getting Selected Ones
       console.log($dataTableRows.rows('.selected').data());
     }

     $("#searchDatatable").on("keyup", function (event) {
       $dataTableRows.search($(this).val()).draw();
     });

     $("#pageCountDatatable .dropdown-menu a").on("click", function (event) {
       var selText = $(this).text();
       $dataTableRows.page.len(parseInt(selText)).draw();
     });

});
