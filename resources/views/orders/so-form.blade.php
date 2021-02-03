{{-- *********************** Today is your day *******************--}}
{{-- ******************************************************************* --}}
{{-- ************ file created and written by Malik Ahsan************ --}}
{{-- **************** date : 08-nov-2020 ************************}
{{-- **********************file-name: so-form *********************** --}}
{{-- **********************  controller-name:  Products/ProductController  *** --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Print So Form</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @include('layouts.head')
</head>

<body id="app-container" class="menu-default">
  <script>
  function dateToYMD(date) {
    const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
        "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

      var d = date.getDate();
      var m = date.getMonth() + 1; //Month from 0 to 11
      var y = date.getFullYear();
      console.log(date)
      return '' +(d <= 9 ? '0' + d : d)+ '-' + monthNames[m] + '-' + y;
  }
  </script>
{{-- ***************** all css file here are **************** --}}


    <link rel="stylesheet" href="{{ asset('assets/css/vendor/bootstrap-float-label.min.css') }} " />

    {{-- ************************** custom css files --}}
    <link rel="stylesheet" href="{{ asset('assets/CustomCss/so-print.css') }} " />




<main>
    <div class="container-fluid m-4">
        <div class="row">
            <div class="col-12">
                <h1>SUZUKI GUJJAR KHAN MOTORS<br>SALES ORDER (S.O) FORM - v1.9</h1>
                <div class="separator mb-5"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-9"></div>
            <div class="col-3 pull-right">
              Date
              <u >
                  <script type="text/javascript">document.write(dateToYMD(new Date()) );</script>
              </u>
            </div>
        </div>

        <div class="row">
            <div class="col-12 row">
                      <table class="col-12 row">
                        <tbody class="col-12 row ">
                          <tr class="row col-12 mb-3 space-between">
                            <td class="col-2 border">Enquiry#</td>
                            <td class="col-4 border"></td>
                            <td class="col-2 border">Tax Status</td>
                            <td class="col-4 border"></td>
                          </tr>

                          <tr class="row col-12 mb-3 space-between">
                            <td class="col-2 border">Customer Type</td>
                            <td class="col-4 border"></td>
                            <td class="col-2 border">Vehicle Type</td>
                            <td class="col-4 border"></td>
                          </tr>

                          <tr class="row col-12 space-between">
                            <td class="col-2 border">Customer's Name</td>
                            <td class="col-4 border"></td>
                            <td class="col-2 border">Invoice in name of</td>
                            <td class="col-4 border"></td>
                          </tr>
                          <tr class="row col-12 space-between">
                            <td class="col-2 border">Customer's CNIC</td>
                            <td class="col-4 border"></td>
                            <td class="col-2 border">CNIC of Invoicee</td>
                            <td class="col-4 border"></td>
                          </tr>
                          <tr class="row col-12 space-between">
                            <td class="col-2 border">Contact#</td>
                            <td class="col-4 border"></td>
                            <td class="col-2 border">Contact#</td>
                            <td class="col-4 border"></td>
                          </tr>
                          <tr class="row col-12 mb-3 pr-2">
                            <td class="col-2 border">Address</td>
                            <td class="col-10 border" >
                            </td>
                          </tr>

                          <tr class="row col-12 space-between">
                            <td class="col-2 border">Vehicle</td>
                            <td class="col-3 border"></td>
                            <td class="col-1"></td>
                            <td class="col-2 border">Engine #</td>
                            <td class="col-3 border"></td>
                            <td class="col-1"></td>
                          </tr>
                          <tr class="row col-12 mb-3 space-between">
                            <td class="col-2 border">Color</td>
                            <td class="col-3 border"></td>
                            <td class="col-1"></td>
                            <td class="col-2 border">Chassis #</td>
                            <td class="col-3 border"></td>
                            <td class="col-1"></td>
                          </tr>


                          <tr class="row col-12 space-between">
                            <td class="col-2 border">Basic Price</td>
                            <td class="col-3 border"></td>
                            <td class="col-1"></td>
                            <td class="col-2 border">Extended Warranty</td>
                            <td class="col-3 border"></td>
                            <td class="col-1"></td>
                          </tr>
                          <tr class="row col-12  space-between">
                            <td class="col-2 border">Advance Tax</td>
                            <td class="col-3 border"></td>
                            <td class="col-1"></td>
                            <td class="col-2 border">Rehistration Fee</td>
                            <td class="col-3 border"></td>
                            <td class="col-1"></td>
                          </tr><tr class="row col-12 space-between">
                            <td class="col-2 border">Total Price</td>
                            <td class="col-3 border"></td>
                            <td class="col-1"></td>
                            <td class="col-2 border">Insurance</td>
                            <td class="col-3 border"></td>
                            <td class="col-1"></td>
                          </tr>
                          <tr class="row col-12  space-between">
                            <td class="col-2 border">Handling Charges</td>
                            <td class="col-3 border"></td>
                            <td class="col-1"></td>
                            <td class="col-2 border">Jumbo Pack</td>
                            <td class="col-3 border"></td>
                            <td class="col-1"></td>
                          </tr>
                          <tr class="row col-12 mb-3 space-between">
                            <td class="col-2 border">Total Payment Due</td>
                            <td class="col-3 border"></td>
                            <td class="col-1"></td>
                            <td class="col-2 border">Others</td>
                            <td class="col-3 border"></td>
                            <td class="col-1"></td>
                          </tr>


                          <tr class="row col-12 ">
                            <td class="col-2 border">Payment Recieved from customer</td>
                            <td class="col-1 border">Amount</td>
                            <td class="col-1 border">Date</td>
                            <td class="col-1 border">V#</td>
                            <td class="col-1 "></td>
                            <td class="col-6 border" style="margin-left:30px;margin-right:-30px;">Dealer / Banker Commission Details</td>
                          </tr>
                          <tr class="row col-12">
                            <td class="col-2 border">Cash</td>
                            <td class="col-1 border"></td>
                            <td class="col-1 border"></td>
                            <td class="col-1 border"></td>
                            <td class="col-1 "></td>
                            <td class="col-2 border" style="margin-left:30px;">Name</td>
                            <td class="col-4 border" style="margin-right:-30px;"> </td>
                          </tr>
                          <tr class="row col-12">
                            <td class="col-2 border">DD / Cheque</td>
                            <td class="col-1 border"></td>
                            <td class="col-1 border"></td>
                            <td class="col-1 border"></td>
                            <td class="col-1 "></td>
                            <td class="col-2 border" style="margin-left:30px;">Contact No.</td>
                            <td class="col-4 border" style="margin-right:-30px;"> </td>
                          </tr>
                         <tr class="row col-12 mb-3">
                            <td class="col-2 border">Balance Receivable</td>
                            <td class="col-1 border"></td>
                            <td class="col-1 "></td>
                            <td class="col-1 "></td>
                            <td class="col-1 "></td>
                            <td class="col-2 border" style="margin-left:30px;">Commission Amount</td>
                            <td class="col-4 border" style="margin-right:-30px;"> </td>
                          </tr>

                          <tr class="row col-12">
                             <td class="col-12 border">Details of Payment to Pak Suzuki (To be filled by Finance Dept, after payment is done)</td>
                             </td>
                           </tr>
                            <tr class="row col-12">
                               <td class="col-2 border">Balance Receivable</td>
                               <td class="col-1 border"></td>
                               <td class="col-1 "></td>
                               <td class="col-1 "></td>
                               <td class="col-1 "></td>
                               <td class="col-2 border" style="margin-left:30px;">Commission Amount</td>
                               <td class="col-4 border" style="margin-right:-30px;"> </td>
                            </tr>
                            <tr class="row col-12">
                               <td class="col-2 border">Cash Payment date</td>
                               <td class="col-1 border">BCV#</td>
                               <td class="col-2 border">Amount</td>
                               <td class="col-1 "></td>
                               <td class="col-2 border" style="margin-left:30px;">DD Payment Date</td>
                               <td class="col-1 border" >BCV# </td>
                               <td class="col-3 border" style="margin-right:-30px;"> Amount</td>
                             </tr>
                             <tr class="row col-12 mb-3">
                                <td class="col-2 border"> </td>
                                <td class="col-1 border"> </td>
                                <td class="col-2 border"> </td>
                                <td class="col-1 "> </td>
                                <td class="col-2 border" style="margin-left:30px;"> </td>
                                <td class="col-1 border" > </td>
                                <td class="col-3 border" style="margin-right:-30px;"> </td>
                              </tr>


                              <tr class="row col-12 mb-5 h-40 d-flex">
                                 <td class="border col-12" style="text-decoration:underline;">Comments / Notes:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                 </td>
                               </tr>

                               <tr class="row col-12">
                                 <td class="col-1"> </td>
                                 <td class="col-5">Sort by:
                                   <u>
                                     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                   </u>
                                 </td>
                                 <td class="col-1"></td>
                                 <td class="col-5">Finance Dept.
                                    <u>
                                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    </u>
                                 </td>

                               </tr>

                        </tbody>
                      </table>
            </div>
        </div>
    </div>
</main>


</body>

</html>
