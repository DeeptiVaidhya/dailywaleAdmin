<!-- start page content -->
<style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    /*border: 1px solid #dddddd;*/
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    /*background-color: #dddddd;*/
}

.info_tab tr:nth-child(even) {
    background-color: #fff;
}


    .invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15); 
        background-color: #fff;
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }
    
    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
    }
    
    .invoice-box table td {
        padding: 5px;
        vertical-align: top;
    }
    
    .invoice-box table tr td:nth-child(2) {
        text-align: right;
    }
    
    .invoice-box table tr.top table td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: 45px;
        color: #333;
    }
    
    .invoice-box table tr.information table td {
        padding-bottom: 40px;
    }
    
    .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
    }
    
    .invoice-box table tr.details td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.item td{
        border-bottom: 1px solid #eee;
    }
    
    .invoice-box table tr.item.last td {
        border-bottom: none;
    }
    
    .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
    }

    #product_details tr th{
        border: 1px solid #000;
        background-color: #5e3ba0eb;
        color: #fff ;
        padding:4px;
    }
    #product_details tr td{
        border: 1px solid #000;
        font-size: 13px;
    }
    
    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
            width: 100%;
            display: block;
            text-align: center;
        }
        
        .invoice-box table tr.information table td {
            width: 100%;
            display: block;
            text-align: center;
        }
    }
    
    /** RTL **/
    .rtl {
        direction: rtl;
        font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }
    
    .rtl table {
        text-align: right;
    }
    
    .rtl table tr td:nth-child(2) {
        text-align: left;
    }

    @media print {
    #printbtn {
        display :  none;
    }
}

</style>
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Vendor Profile</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo site_url('welcome/dashboard');?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                               
                                <li class="active">Vendor Profile</li>
                            </ol>
                        </div>
                    </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="card-box">
                  <div class="card-head">
                    <header> View Vendor Profile</header>                              
                  </div>
                  <?php echo $this->session->flashdata('User');?>
                  <?php
                // echo '<pre>'; print_r($vendordata);die;
                  foreach ($vendordata as $row) {?>
                  <form action="<?php // echo site_url('User/viewRecordDetails');?>" method="post" onsubmit="return validation();" enctype="multipart/form-data">
                    <input class = "mdl-textfield__input" type = "hidden" id = "Name" name="id" value="<?php echo $row['id'];?>">
                  <div class="card-body row">
                  	  <!-- <div class="col-md-12"> -->
                  	  	<div class="col-lg-4">
                  	  		<center>
                  	  		 <img class="img-circle" src="http://dailywale.com/dailywaleAdmin/uploads/user/153578027129091.jpg" alt="user" width="200" style="margin-top: 40px;" />
                  	  		</center> 
                  	  	</div>
                  	  	<div class="col-lg-8">
                  	  		<table class="info_tab" style="width:100%">
							  <tr>
							    <th style="border: none;">Name</th>
							    <td style="border: none;">:</td>
							    <td style="border: none;"><?php echo $row['name'];?></td>
							  </tr>
                <tr>
                  <th style="border: none;">Company Name</th>
                  <td style="border: none;">:</td>
                  <td style="border: none;"><?php if ($row['company_name'] != '') { echo $row['company_name']; }else{ echo 'NIL'; }?></td>
                </tr>
                <tr>
                  <th style="border: none;">GSTIN </th>
                  <td style="border: none;">:</td>
                  <td style="border: none;"><?php if ($row['gst_no'] != '') { echo $row['gst_no']; }else{ echo 'NIL'; }?></td>
                </tr>
							  <tr>
							    <th style="border: none;">Email</th>
							    <td style="border: none;">:</td>
							    <td style="border: none;"><?php echo $row['email'];?></td>
							  </tr>
							  <tr>
							    <th style="border: none;">Mobile</th>
							    <td style="border: none;">:</td>
							    <td style="border: none;"><?php echo $row['phone'];?></td>
							  </tr>
							  <tr>
							    <th style="border: none;">Wallet Amount</th>
							    <td style="border: none;">:</td>
							    <td style="border: none;"> <i class="fa fa-inr"></i> <?php echo $row['wallet_amount'];?></td>
							  </tr>
							  <tr>
							    <th style="border: none;" >Address</th>
							    <td style="border: none;">:</td>
							    <td style="border: none;"><?php echo $row['address']; ?>
                   </td>
							  </tr>
							</table>
                  	  	</div>
                  	  <!-- </div> -->


                          <div class="col-lg-12 p-t-20">
                             <ul class="nav nav-tabs" id="myTab" role="tablist">
                              <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Upcoming Order</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Last Order</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Wallet History</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" id="invoice-tab" data-toggle="tab" href="#invoice" role="tab" aria-controls="invoice" aria-selected="false">Invoice</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" id="notification-tab" data-toggle="tab" href="#notification" role="tab" aria-controls="notification" aria-selected="false">Notification</a>
                              </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                              <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                               <div class="">
                                 <table>
                                  <thead>
                                  <tr>
                                    <th> Order No.</th>
                                    <th>Username</th>
                                    <th>Item Name</th>
                                    <th>Quantity</th>
                                    <th>Status</th>
                                    <th>Driver Name</th>
                                    <th>Date</th>
                                  </tr>
                                </thead>
                                  <tbody>
                                    <?php 
                                       if(!empty($upcoming_order)){
                                       $i=0;
                                       foreach($upcoming_order as $row){
                                        $i++;
                                    ?>
                                    <tr>
                                    <td><?php echo $row['cart_id'];?></td>
                                    <td><?php echo ucwords($row['fname']);?>&nbsp<?php echo ucwords($row['lname']);?></td>
                                    <td><?php echo ucwords($row['item_name']);?></td>
                                    <td><?php echo ucwords($row['quanity']);?></td>
                                    <td>
                                        <?php                                        
                                          if ($row['cart_status'] == '0')
                                           echo 'Cart';
                                          else if ($row['cart_status'] == '1')
                                          echo  'Order';
                                          else if ($row['cart_status'] == '2')
                                           echo  'Cancle';
                                         else if ($row['cart_status'] == '3')
                                           echo  'Return';
                                         else if ($row['cart_status'] == '4')
                                           echo  'Delivery';
                                         else if ($row['cart_status'] == '5')
                                           echo  'Return Accepted';
                                        else 
                                           echo  'Empty';
                                         ?>
                                        </td>
                                    <td><?php echo ucwords($row['driver_name']);?></td>
                                    <td><?php echo ucwords($row['date_time']);?></td>
                                   </tr>
                                   <?php } }else{ ?>
                                    <tr><td  colspan="7"><h2>No Data Found</h2></td></tr>
                                   <?php  }?>
                                  </tbody>
                                </table>
                           </div>
                              </div>
                              <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                    <div class="">
                                     <table>
                                      <thead>
                                      <tr>
                                         <th>Order No.</th> 
                                        <th>Item Name</th>
                                        <th>Quantity</th>
                                        <th>Status</th>
                                        <th>Driver Name</th>
                                        <th>Date</th>
                                      </tr>
                                    </thead>
                                      <tbody>
                                        <?php 
                                           $i=0;
                                           foreach($PrivousDayOrder as $row_past){
                                            $i++;
                                        ?>
                                        <tr>
                                        <td><?php echo $row_past['cart_id'];?></td> 
                                        <td><?php echo ucwords($row_past['item_name']);?></td>
                                        <td><?php echo ucwords($row_past['quanity']);?></td>
                                        <td>
                                        <?php                                        
                                          if ($row_past['cart_status'] == '0')
                                           echo 'Cart';
                                          else if ($row_past['cart_status'] == '1')
                                          echo  'Order';
                                          else if ($row_past['cart_status'] == '2')
                                           echo  'Cancle';
                                         else if ($row_past['cart_status'] == '3')
                                           echo  'Return';
                                         else if ($row_past['cart_status'] == '4')
                                           echo  'Delivery';
                                         else if ($row_past['cart_status'] == '5')
                                           echo  'Return Accepted';
                                        else 
                                           echo  'Empty';
                                         ?>
                                        </td>
                                        <td><?php echo ucwords($row_past['driver_name']);?></td>
                                        <td><?php echo ucwords($row_past['date_time']);?></td>
                                       </tr>
                                       <?php } ?>
                                      </tbody>
                                    </table>
                               </div>
                              </div>
                              <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                  <div class="">
                                     <table>
                                      <thead>
                                      <tr>
                                        <th>No.</th>
                                        <th>Pay By</th>
                                        <th>Amount</th>
                                        <th>Details</th>
                                        <th>Date</th>
                                      </tr>
                                    </thead>
                                      <tbody>
                                        <?php 
                                           $i=0;
                                           //foreach($wallet_amount as $row_amount){
                                            $i++;
                                        ?>
                                        <tr>
                                        <td><?php// echo $i;?></td>
                                        <td><?php// echo ucwords($row_amount['pay_by']);?></td>
                                        <td> <i class="fa fa-inr"></i>&nbsp;<?php// echo ucwords($row_amount['amount']);?></td>
                                        <td><?php// echo ucwords($row_amount['detail']);?></td>
                                        <td><?php// echo ucwords($row_amount['date_time']);?></td>
                                       </tr>
                                       <?php// } ?>
                                      </tbody>
                                    </table>
                               </div>
                              </div>

                              <div class="tab-pane fade" id="invoice" role="tabpanel" aria-labelledby="invoice-tab">
                                <div class="col-md-12">
                                  <div class="col-md-4 form-group" style="float: left;">
                                  </div>
                                  <div class="col-md-4 form-group" style="float: left;">
                                    <label for="usr">Month</label>
                                    <input type="month" class="form-control" id="month" name="month">
                                    <input type="hidden" class="form-control" id="vendorId" name="vwendorId" value="<?php echo $vendordata[0]['id']; ?>">
                                  </div>
                                  <div class="col-md-4 form-group" style="float: left;margin-top:35px;">
                                    <label for="usr"></label>
                                    <a class="btn-primary" onclick="getRecord();" name="search" style="/*margin-top:30px;*/padding:7px;">Search</a> 
                                  </div>
                                </div>  


                                <div class="invoice-body" id="invoice-body"></div>

                                
                              </div>

                              <div class="tab-pane fade" id="notification" role="tabpanel" aria-labelledby="notification-tab">
                                  <div class="">
                                     <table>
                                      <thead>
                                      <tr>
                                        <th>S No.</th>
                                        <th>Title</th>
                                        <th>Message</th>
                                        <th>Date</th>
                                      </tr>
                                    </thead>
                                      <!-- <tbody>
                                        <?php 
                                           $jj=0;
                                           foreach($allnotification as $notifi){
                                            $jj++;
                                        ?>
                                        <tr>
                                        <td><?php echo $jj;?></td>
                                        <td><?php echo ucwords($notifi['title']);?></td>
                                        <td> <i class="fa fa-inr"></i>&nbsp;<?php echo ucwords($notifi['message']);?></td>
                                        <td><?php echo ucwords($notifi['date_time']);?></td>
                                       </tr>
                                       <?php } ?>
                                      </tbod -->y>
                                    </table>
                                </div>
                              </div>
                            </div>
                          </div>
                         <div class="col-lg-12 p-t-20 text-center"> 
                            <!--  <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-primary">Submit</button> -->                      
                          </div>
                      </div>
                      </form>
                     <?php 
                    } 
                   ?>
                </div>
              </div>
            </div> 
         </div>
       </div>

<script type="text/javascript">
 function getRecord(){
    var month = document.getElementById('month').value;
    var vendorId   = document.getElementById('vendorId').value;
    var month11 = document.getElementById('month').value;
    $.ajax({
      type: "GET",
      url: "<?php echo base_url('index.php/Vendorinfo/fetchSellerInvoiceForMonth');?>/?month="+month+"&vendorId="+vendorId,
    success: function(data){
       //alert(data);
       var obj = JSON.parse(data);
       if(obj.length>0){
          var html = '';
          var j=0;
          for(var i=0;i<obj.length;i++){
               var name     = obj[i]['name'];
               var address  = obj[i]['address'];
               var gst_no   = obj[i]['gst_no'];
               var company_name = obj[i]['company_name'];
               var phone       = obj[i]['phone'];
               var invoice_num = obj[i]['invoice_no'];

               var currentDate = new Date()
               var day = currentDate.getDate()
               var month = currentDate.getMonth() + 1
               var year = currentDate.getFullYear()
               var InvoiceDaTE = day + "/" + month + "/" + year
            
             html += '<div class="invoice-box" style="margin-top:100px;"><div id="part_1"><center><img src="http://dailywale.com/dailywaleAdmin//assets/img/logo.png.png" alt="dailywale" width="12%"></center><table style="width:100%;padding-top:35px;" ><tr><td colspan="3"><b><span style="color:#625db1;">Daily Needs And Activities</span> </b></td><td colspan="3"><!-- <b style="color:red;">Total - &#8377; 10,080.00</b> --></td></tr><tr><td>GSTIN</td><td>:</td><td>'+gst_no+'</td><td>Invoice Date</td><td>:</td><td>'+InvoiceDaTE+'</td></tr><tr><td>PAN</td><td>:</td><td>Nil</td><td>Invoice No.</td><td>:</td><td>'+invoice_num+'</td></tr><tr><td>State</td><td>:</td><td>Madhya Pradesh</td><td></td><td></td><td></td></tr><tr style="line-height:80px"><td colspan="6" style="font-size: 22px;">----------------------------------  BANK SETTELMENT  ----------------------------------</td></tr><tr><td><b>Seller</b></td><td>:</td><td><b><span style="color:red;">'+name+'('+company_name+')</span></b></td><td colspan="3"><b style="color:red;float: right;">Billing Address</b></td></tr><tr><td>GSTIN</td><td>:</td><td>'+gst_no+'</td><tr><td>PAN</td><td>:</td><td>Nil</td><td colspan="3">'+address+'</td></tr><tr><td>State</td><td>:</td><td>Madhya Pradesh</td><td colspan="3"></td></tr><tr><tr colspan="6"></tr><tr colspan="6"></tr><tr colspan="6"></tr><tr colspan="6"></tr><tr colspan="6"></tr><tr colspan="6"></tr></table></div> <table id="product_details" style="width:100%;" ><tr><th>SN</th><th>Product</th><th>Unit</th><th>Selling Price</th><th>Discount</th><th>Unit Amount</th><th>Delivery Charges</th><th>Delivery Total</th><th>Total Discount</th><th>Amount</th><th>Remarks</th></tr>'; 


              var itemarray = obj[i].ItemDetails;
              console.log(itemarray);
              var jj=0;
              var calculated_qty_total      = 0;
              var calculated_total_discount      = 0;
              var calculated_amount_total   = 0;
              var calculated_delivery_total = 0;
              var calculated_total = 0;
              for(var k=0;k<itemarray.length;k++){
                var item_name    = itemarray[k]['item_name'];
                var qty          = itemarray[k]['total_item_unit'];
                var price        = itemarray[k]['item_price'];
                var item_discount= itemarray[k]['item_discount'];
                var total_discount = itemarray[k]['total_item_discount'];
                var remarks        = itemarray[k]['remark'];
                var delivery     = parseFloat(itemarray[k]['seller_delivery']) + parseFloat(itemarray[k]['seller_packaging_charge']);
                var tax          = parseFloat(itemarray[k]['cgstin']) + parseFloat(itemarray[k]['sgstin']);
                var total_amt    = qty * price;
                var total_delivery_charge = qty * delivery; 
                // var total_gst = parseFloat(total_amt) * parseFloat(tax) / 100;
                // var total_with_gst = parseFloat(total_gst) + parseFloat(total_amt);
                var total_amount_calcu = parseFloat(total_amt) - parseFloat(total_delivery_charge) ;
                
                calculated_qty_total += parseFloat(qty);
                calculated_total_discount += parseFloat(total_discount);
                calculated_amount_total += parseFloat(total_amt);
                calculated_delivery_total += parseFloat(total_delivery_charge);
                calculated_total += parseFloat(total_amount_calcu);
          
                var payment_gateway = Math.round(parseFloat(calculated_total) * 2.97 / 100);

                var invoice_total = parseFloat(calculated_total) - parseFloat(payment_gateway);

                var final_invoice_total = parseFloat(invoice_total) - parseFloat(calculated_total_discount);

                jj = ++jj;
                html += '<tr><td>'+jj+'</td><td style="text-align: center;">'+item_name+'</td><td>'+qty+'</td><td>&#8377; '+price+'</td><td>&#8377; '+item_discount+'</td><td>'+total_amt+'</td><td>&#8377; '+delivery+'</td><td>&#8377; '+total_delivery_charge+'</td><td>&#8377; '+total_discount+'</td><td>&#8377; '+total_amount_calcu+'</td><td>&#8377; '+remarks+'</td></tr>';

              } 

              html += '<tr><td colspan="9"></td></tr><tr><td></td><td><b>Total</b></td><td><b>'+calculated_qty_total+'</b></td><td></td><td></td><td><b>&#8377; '+calculated_amount_total+'</b></td><td></td><td><b>&#8377; '+calculated_delivery_total+'</b></td><td><b>&#8377; '+calculated_total_discount+'</b></td><td><b>&#8377; '+calculated_total+' </b></td><td></td></tr><tr><td></td><td></td><td colspan="2" style="font-weight: bold;">Taxable Amount</td><td></td><td></td><td></td><td></td><td></td><td>&#8377; '+calculated_total+'    </td><td></td></tr><tr><td></td><td></td><td colspan="2">CGSTIN</td><td></td><td></td><td></td><td></td><td></td><td>&#8377;  0</td><td>0.00%</td></tr><tr><td></td><td></td><td colspan="2">SGSTIN</td><td></td><td></td><td></td><td></td><td></td><td>&#8377;  0</td><td>0.00%</td></tr><tr><td></td><td></td><td style="color:red;font-weight: bold;" colspan="3">Payment Gateway</td><td></td><td></td><td></td><td></td><td style="color:red;font-weight: bold;">&#8377; - '+payment_gateway+'</td><td>2.97%</td></tr><tr><td></td><td></td><td style="font-weight: bold;" colspan="3">Discount</td><td></td><td></td><td></td><td></td><td style="font-weight: bold;">&#8377; - '+calculated_total_discount+'</td><td></td></tr><tr><td></td><td></td><td colspan="2"><b>Invoice Total</b></td><td></td><td></td><td></td><td></td><td></td><td>&#8377; '+final_invoice_total+'</td><td></td></tr><tr><td colspan="11" rowspan="3"><h4 style="float: right;color:red;">Thank You, We look forword to serve you again.</h4></td></tr></table><div style="margin-top: 30px;"><p style="width:85%;float: left;"><span style="color:red;">*</span>Scan the QR Code to check the invoice details of dailywale online Or visit : Our Site </p></div></div><div class="col-sm-12 container"><center><input class="col-md-4 btn-primary" type="button" onclick="myFunction()" value="print" id="printbtn" style="margin-top:30px;margin-bottom: 30px;margin-right:15px;" /> <a href="<?php echo site_url('Vendorinfo/sendVendorInvoice');?>?month='+month11+'&vendorId='+vendorId+'"><input class="col-md-4 btn-primary" type="button"  value="Send To Email" id="printbtn" style="margin-top:30px;margin-bottom: 30px;" /></a></center></div> ';
          }
          $('#invoice-body').html(html);
       }else{
          html = '<h2>No Data Found</h2>';
          $('#invoice-body').html(html);
      } 

    }
    });
 }
    getRecord();
</script>       

<script>
function myFunction() {
    window.print();
}
</script>  

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script type="text/javascript">
    function generateBarCode()
    {
        var nric = $('#job_status').val();
        var url = 'https://api.qrserver.com/v1/create-qr-code/?data=' + nric + '&amp;size=50x50';
        alert(url);
        $('#barcode').attr('src', url);
    }
</script>
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>