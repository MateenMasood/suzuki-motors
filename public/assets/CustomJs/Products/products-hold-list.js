// ****************************************************************
// ******* file created and written by mateen masood **************
// ************* date : 26-sep-2020 ******************************
// ****************** js file-name:product-list.js ******************
// ****************** view file name : Products/Products-list.blade.php ****
// ****************** controller name : Products/ProductController *********


$(document).ready(()=>{

    // Datatable with rows
    var $dataTableRows = $("#tblProductHold").DataTable({
       bLengthChange: false,
       destroy: true,
       info: false,
       sDom: '<"row view-filter"<"col-sm-12"<"float-left"l><"float-right"f><"clearfix">>>t<"row view-pager"<"col-sm-12"<"text-center"ip>>>',
       pageLength: 10,
       ajax: {
           "url": "/product-hold/datatable",
           "dataSrc": ""
       },
       columns: [
         { data : 'id'},
         { data: "customer.name" },
         { data: "customer.contact" },
         { data: "inventory.product_version.product.name" },
         {
            render: function (data, type, full, meta) {
                return (
                    full.inventory.product_version.variant_label+'-'+full.inventory.product_version.model
                );
            },
        },
         { data: "inventory.color" },
         { data: "inventory.engine_no" },
         { data: "inventory.chassis_no" },
         { data: "token_amount" },
       //   { data: 'base_image',
       //   render: function( data, type, full, meta ) {
       //       return `<img src="` + data + `" height="50">`;
       //   }
       // },
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

        // ***************** onclick on dattatable row trigger below event *********
        $("#tblProductHold tbody tr").click(function(event) {
            //getting the dtata against the row
            var currentRowData = $dataTableRows.row(this).data();
// console.log(currentRowData.id);
// return;
            // ************ redirect to another page ******


            window.location.href = "/product-hold/"+currentRowData.id;


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


     $('#tblProductHold tbody').on('click', 'tr', function () {
       $(this).toggleClass('selected');
       var $checkBox = $(this).find(".custom-checkbox input");
       $checkBox.prop("checked", !$checkBox.prop("checked")).trigger("change");
       controlCheckAll();
     });

     function controlCheckAll() {
       var anyChecked = false;
       var allChecked = true;
       $('#tblProductHold tbody tr .custom-checkbox input').each(function () {
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
       $('#tblProductHold tbody tr').removeClass('selected');
       $('#tblProductHold tbody tr .custom-checkbox input').prop("checked", false).trigger("change");
     }

     function checkAllRows() {
       $('#tblProductHold tbody tr').addClass('selected');
       $('#tblProductHold tbody tr .custom-checkbox input').prop("checked", true).trigger("change");
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
