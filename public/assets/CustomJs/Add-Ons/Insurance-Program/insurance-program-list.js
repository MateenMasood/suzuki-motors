$(document).ready(function(){
    // Branches Datatable
    var $dataTableRows = $("#tblInsuranceProgram").DataTable({
      ajax: {
          url: "/insurance-programs/datatable",
          dataSrc: "",
      },
      bLengthChange: false,
      destroy: true,
      info: false,
      sDom: '<"row view-filter"<"col-sm-12"<"float-left"l><"float-right"f><"clearfix">>>t<"row view-pager"<"col-sm-12"<"text-center"ip>>>',
      pageLength: 10,
      columns: [
        { data: "product_version.product.branch.name" },
        { data: "product_version.product.name" },
        {
            render: function (data, type, full, meta) {
                return (
                    full.product_version.variant_label+'-'+full.product_version.model
                );
            },
        },
        // { data: "product_version.variant_label" },
        { data: "insurance_type" },
        { data: "price" },

        {
          render: function (data, type, full, meta) {
              return (
                  `<a class="" href="/branches/` +full.id +`/edit"><i class="fa fa-edit fa-fw bg-primary icon-edit"></i></a>`
              );
          },
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

    $('#datatableRows tbody').on('click', 'tr', function () {
      $(this).toggleClass('selected');
      var $checkBox = $(this).find(".custom-checkbox input");
      $checkBox.prop("checked", !$checkBox.prop("checked")).trigger("change");
      controlCheckAll();
    });

    function controlCheckAll() {
      var anyChecked = false;
      var allChecked = true;
      $('#datatableRows tbody tr .custom-checkbox input').each(function () {
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
      $('#datatableRows tbody tr').removeClass('selected');
      $('#datatableRows tbody tr .custom-checkbox input').prop("checked", false).trigger("change");
    }

    function checkAllRows() {
      $('#datatableRows tbody tr').addClass('selected');
      $('#datatableRows tbody tr .custom-checkbox input').prop("checked", true).trigger("change");
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
})
