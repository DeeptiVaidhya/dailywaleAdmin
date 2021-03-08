<!-- start page content -->
<style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
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
                                <div class="page-title">View User details</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo site_url('welcome/dashboard');?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                               
                                <li class="active"> View User details</li>
                            </ol>
                        </div>
                    </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="card-box">
                  <div class="card-head">
                    <header> View User Information</header>                              
                  </div>
                  <?php echo $this->session->flashdata('User');?>
                  <?php foreach ($userdata as $row) {?>
                  <form action="<?php echo site_url('User/viewRecordDetails');?>" method="post" onsubmit="return validation();" enctype="multipart/form-data">
                    <input class = "mdl-textfield__input" type = "hidden" id = "Name" name="id" value="<?php echo $row['user_id'];?>">
                  <div class="card-body row">
                  	  <!-- <div class="col-md-12"> -->
                  	  	<div class="col-lg-4">
                  	  		<center>
                  	  		 <img class="img-circle" src="http://dailywale.com/dailywaleAdmin/uploads/user/153578027129091.jpg" alt="user" width="200" />
                  	  		</center> 
                  	  	</div>
                  	  	<div class="col-lg-8">
                  	  		<table class="info_tab" style="width:100%">
							  <tr>
							    <th style="border: none;">Name</th>
							    <td style="border: none;">:</td>
							    <td style="border: none;"><?php echo $row['fname'];?>&nbsp;<?php echo $row['lname'];?></td>
							  </tr>
							  <tr>
							    <th style="border: none;">Email</th>
							    <td style="border: none;">:</td>
							    <td style="border: none;"><?php echo $row['email'];?></td>
							  </tr>
							  <tr>
							    <th style="border: none;">Mobile</th>
							    <td style="border: none;">:</td>
							    <td style="border: none;"><?php echo $row['user_mobile'];?></td>
							  </tr>
							  <tr>
							    <th style="border: none;">Wallet Amount</th>
							    <td style="border: none;">:</td>
							    <td style="border: none;"> <i class="fa fa-inr"></i> <?php echo $row['wallet_amount'];?></td>
							  </tr>
							  <tr>
							    <th style="border: none;" >Address</th>
							    <td style="border: none;">:</td>
							    <td style="border: none;"><?php echo $row['address'];
                    if (!$row['subzone_id'] == '') {
                      $whereSubzone = array('subzone_id' => $row['subzone_id'] );
                      $allsubzone = $this->Model->selectdata('subzone', $whereSubzone);
                      echo ',' .$allsubzone[0]['subzone_name'];
                    }
                    if (!$row['zone_id'] == '') {
                      $whereZone = array('zone_id' => $row['zone_id'] );
                      $allzone = $this->Model->selectdata('zone', $whereZone);
                      echo ',' .$allzone[0]['zone_name'];
                    }
                    if (!$row['city_id'] == '') {
                      $whereCity = array('city_id' => $row['city_id'] );
                      $allcity = $this->Model->selectdata('city', $whereCity);
                      echo ',' .$allcity[0]['city_name'];
                    }
                    if (!$row['state_id'] == '') {
                      $whereState = array('state_id' => $row['state_id'] );
                      $allState = $this->Model->selectdata('state', $whereState);
                      echo ',' .$allState[0]['state_name'];
                    }       
                  ?>
                   </td>
							  </tr>
                <tr>
                  <th style="border: none;">Last Order</th>
                  <td style="border: none;">:</td>
                  <td style="border: none;">
                    <?php if(!empty($lastOrder)){?>
                      Your Last order of &nbsp;<span style="color:red;"><?php  echo $lastOrder[0]['item_name']; ?></span> on date : <span style="color:red;"><?php echo $lastOrder[0]['date_time'];?></span>
                    <?php 
                      $current_date = date('Y-m-d');
                      if ($lastOrder[0]['date_time'] > $current_date) {
                       echo '<span style="color:#41fbd9;font-weight:bold;">( Upcoming )</span>';
                      }elseif ($lastOrder[0]['date_time'] < $current_date) {
                       echo '<span style="color:#24719e;font-weight:bold;">( Past )</span>';
                      }else{
                       echo '<span style="color:#efc6bd;font-weight:bold;">( Today )</span>';  
                      }
                     }else{ ?>
                     <span style="color:red;font-weight: bold;">Lets Start order for daily needs.</span>
                    <?php } ?>
                    
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
                                           $i=0;
                                           foreach($past_order as $row_past){
                                            $i++;
                                        ?>
                                        <tr>
                                        <td><?php echo $row_past['cart_id'];?></td> 
                                        <td><?php echo ucwords($row_past['fname']);?>&nbsp<?php echo ucwords($row_past['lname']);?></td>
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
                                     <table style="table-layout: fixed;">
                                      <thead>
                                      <tr>
                                        <th>No.</th>
                                        <th style="width: 30%;">Cart Id</th>
                                        <th>Trans Id</th>
                                        <th>Wallet Id</th>
                                        <th>Pay By</th>
                                        <th>Amount</th>
                                        <th>Details</th>
                                        <th>Apply Coupon Code</th>
                                        <th>Date</th>
                                      </tr>
                                    </thead>
                                      <tbody>
                                        <?php 
                                           $i=0;
                                           foreach($wallet_amount as $row_amount){
                                            $i++;
                                        ?>
                                        <tr>
                                        <td><?php echo $i;?></td>
                                        <td style="overflow: scroll;"><?php echo ucwords($row_amount['cart_id']);?></td>
                                        <td><?php echo ucwords($row_amount['trans_id']);?></td>
                                        <td><?php echo ucwords($row_amount['wallet_id']);?></td>
                                        <td><?php echo ucwords($row_amount['pay_by']);?></td>
                                        <td> <i class="fa fa-inr"></i>&nbsp;<?php echo ucwords($row_amount['amount']);?></td>
                                        <td><?php echo ucwords($row_amount['detail']);?></td>
                                        <td><?php echo ucwords($row_amount['coupon_code']);?></td>
                                        <td><?php echo ucwords($row_amount['date_time']);?></td>
                                       </tr>
                                       <?php } ?>
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
                                    <input type="hidden" class="form-control" id="userId" name="userId" value="<?php echo $userdata[0]['user_id']; ?>">
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
                                      <tbody>
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
                                      </tbody>
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
    var userId   = document.getElementById('userId').value;
    $.ajax({
      type: "GET",
      url: "<?php echo base_url('index.php/Invoice/fetchdata');?>/?month="+month+"&userId="+userId,
    success: function(data){

       var obj = JSON.parse(data);
       if(obj.length>0){
          var html = '';
          var j=0;
          for(var i=0;i<obj.length;i++){
               var name     = obj[i]['name'];
               var address  = obj[i]['address'];
               var gst_no   = obj[i]['gst_no'];
               var company_name = obj[i]['company_name'];
               var phone    = obj[i]['phone'];

             html += '<div class="invoice-box" style="margin-top:100px;"><div id="part_1"><center><img src="http://dailywale.com/dailywaleAdmin//assets/img/logo.png.png" alt="dailywale" width="12%"></center><table style="width:100%;padding-top:35px;" ><tr><td colspan="3"><b>Seller : <span style="color:#625db1;">'+name+'('+company_name+')</span> </b></td><td colspan="3"><!-- <b style="color:red;">Total - &#8377; 10,080.00</b> --></td></tr><tr><td>GSTIN</td><td>:</td><td>'+gst_no+'</td><td>Invoice Date</td><td>:</td><td> 4545454545</td></tr><tr><td>PAN</td><td>:</td><td>Nil</td><td>Invoice No.</td><td>:</td><td> DW-00</td></tr><tr><td>State</td><td>:</td><td>Madhya Pradesh</td><td></td><td></td><td></td></tr><tr><td colspan="6" style="font-size: 22px;">---------------------------------------  TAX INVOICE  ---------------------------------------</td></tr>';

             var userarray = obj[i].userArray;
              console.log(userarray);
              for(var l=0;l<userarray.length;l++){
                var fname = userarray[l]['fanme'];
                var lname = userarray[l]['lname'];
                var userAddress = userarray[l]['address'];
                var subzone_name = userarray[l]['subzone_name'];
                var zone_name = userarray[l]['zone_name'];
                var city_name = userarray[l]['city_name'];
                var state_name = userarray[l]['state_name'];
             }
             html += '<tr><td><b>Customer</b></td><td>:</td>'+fname+' '+lname+'<td><b><span style="color:red;">sdddddd </span></b></td><td colspan="3"><b style="color:red;float: right;">Billing Address</b></td></tr><tr><td>PAN</td><td>:</td><td>Nil</td><td colspan="3">'+userAddress+', '+subzone_name+', </td></tr><tr><td>State</td><td>:</td><td>'+state_name+'</td><td colspan="3">'+zone_name+', '+city_name+', '+state_name+'</td></tr><tr><tr colspan="6"></tr><tr colspan="6"></tr><tr colspan="6"></tr><tr colspan="6"></tr><tr colspan="6"></tr><tr colspan="6"></tr></table></div> <table id="product_details" style="width:100%;" ><tr><th>SN</th><th>Description</th><th>Unit</th><th>*Price</th><th>Amount</th></tr>'; 


              var itemarray = obj[i].itemArray;
              console.log(itemarray);
              var jj=0;
              for(var k=0;k<itemarray.length;k++){
                var item_name = itemarray[k]['item_name'];
                var total = itemarray[k]['total'];
                var price = itemarray[k]['price'];
                var delivery = itemarray[k]['delivery'];
                var total_amt = price * delivery; 
                jj = ++jj;
                html += '<tr><td>'+jj+'</td><td style="text-align: center;">'+item_name+' + Delivery Charges</td><td>'+total+'</td><td>&#8377; '+price+'</td><td>'+total_amt+'</td></tr>';
              } 

              html += '<tr><td colspan="9"></td></tr><tr><td></td><td>Taxable Amount</td><td></td><td></td><td>&#8377;     </td></tr><tr><td></td><td>GSTIN</td><td>0%</td><td></td><td>&#8377; -</td></tr><tr><td></td><td style="color:red;font-weight: bold;">Invoice Total</td><td></td><td></td><td style="color:red;font-weight: bold;">&#8377; </td></tr><tr><td colspan="9">*Note : Price is product final price of per unit including & exluding all tax, charges & discounts.<br>*Computer generated invoice.</td></tr><tr><td colspan="9" rowspan="3"><h4 style="float: right;color:red;">Thank You, We look forword to serve you again.</h4></td></tr></table><div style="margin-top: 30px;"><p style="width:85%;float: left;"><span style="color:red;">*</span>Scan the QR Code to check the invoice details of dailywale online Or visit : Our Site </p>      </div></div>';
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