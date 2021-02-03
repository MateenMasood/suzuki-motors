// ****************************************************************
// ******* file created and written by mateen masood **************
// ************* date : 7-oct-2020 ******************************
// ****************** js file-name:dealers-list.js ******************
// ****************** view file name : Dealers/dealers-list.blade.php ****
// ****************** controller name : Dealers/DealerController *********


$(document).ready(()=>{

    // Datatable with rows
    var $dataTableRows = $("#tblBankBranches").DataTable({
       bLengthChange: false,
       destroy: true,
       info: false,
       sDom: '<"row view-filter"<"col-sm-12"<"float-left"l><"float-right"f><"clearfix">>>t<"row view-pager"<"col-sm-12"<"text-center"ip>>>',
       pageLength: 10,
       ajax: {
           "url": "/bank-branches/datatable",
           "dataSrc": ""
       },
       columns: [
         { data : 'id'},
         { data: "code" },
         { data: "name" },
         { data: "bank.name" },
         { data: "contact" },
         { data: "address" },

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


     $('#tblBankBranches tbody').on('click', 'tr', function () {
       $(this).toggleClass('selected');
       var $checkBox = $(this).find(".custom-checkbox input");
       $checkBox.prop("checked", !$checkBox.prop("checked")).trigger("change");
       controlCheckAll();
     });

     function controlCheckAll() {
       var anyChecked = false;
       var allChecked = true;
       $('#tblBankBranches tbody tr .custom-checkbox input').each(function () {
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
       $('#tblBankBranches tbody tr').removeClass('selected');
       $('#tblBankBranches tbody tr .custom-checkbox input').prop("checked", false).trigger("change");
     }

     function checkAllRows() {
       $('#tblBankBranches tbody tr').addClass('selected');
       $('#tblBankBranches tbody tr .custom-checkbox input').prop("checked", true).trigger("change");
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
