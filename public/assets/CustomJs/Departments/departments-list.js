// ****************************************************************
// ******* file created and written by mateen masood **************
// ************* date : 28-sep-2020 ******************************
// ****************** js file-name:product-list.js ******************
// ****************** view file name : Enquiries/enquiries-list.blade.php ****
// ****************** controller name : Enquiries/EnquiryController *********


$(document).ready(() => {
  console.log("List will be fetched")
  // Datatable with rows
  var $dataTableRows = $("#tblDepartments").DataTable({
    bLengthChange: false,
    destroy: true,
    info: false,
    sDom: '<"row view-filter"<"col-sm-12"<"float-left"l><"float-right"f><"clearfix">>>t<"row view-pager"<"col-sm-12"<"text-center"ip>>>',
    pageLength: 10,
    ajax: {
      "url": "/departments/datatable",
      "dataSrc": ""
    },
    columns: [
      { data: 'id' },
      { data: "name" },
      { data: 'id' },
      {
        data: 'Actions',
        render: function (data, type, full, meta) {
          // return `<button data="` + data + `" >edit</button>`;
          return `<a href="#"  class="btn btn-outline-primary mb-2" 
                   data-toggle="modal" data-target="#DepartmentEditModal" data-obj='${JSON.stringify(full)}'>
                   Edit
                  </a>
             <a href="#"  class="btn btn-outline-danger mb-2" onclick='deleteDepartment(${JSON.stringify(full)})'>
                Delete
             </a>`
        }
      },
      {
        render: function (data, type, row) {
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

  $dataTableRows.on('order.dt search.dt', function () {
    $dataTableRows.column(0, { search: 'applied', order: 'applied' }).nodes().each(function (cell, i) {
      cell.innerHTML = i + 1;
    });
  }).draw();


  $('#tblDepartments tbody').on('click', 'tr', function () {
    $(this).toggleClass('selected');
    var $checkBox = $(this).find(".custom-checkbox input");
    $checkBox.prop("checked", !$checkBox.prop("checked")).trigger("change");
    controlCheckAll();
  });

  function controlCheckAll() {
    var anyChecked = false;
    var allChecked = true;
    $('#tblDepartments tbody tr .custom-checkbox input').each(function () {
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
    $('#tblDepartments tbody tr').removeClass('selected');
    $('#tblDepartments tbody tr .custom-checkbox input').prop("checked", false).trigger("change");
  }

  function checkAllRows() {
    $('#tblDepartments tbody tr').addClass('selected');
    $('#tblDepartments tbody tr .custom-checkbox input').prop("checked", true).trigger("change");
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
  //Departments edit functionality
  /* 03.23. Modal Passing Content */
  $("#DepartmentEditModal").on("show.bs.modal", function (event) {
    var data = $(event.relatedTarget).attr("data-obj");
    data = JSON.parse(data);

    var modal = $(this);
    modal.find("#department-id").val(data.id);
    modal.find("#department-name").val(data.name);
    modal.find("#employee-number").val(data.numberofemployee);
  });

});
function deleteDepartment(obj){
  console.log(obj)
}