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
   /* background-color: #dddddd;*/
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
<!--start page content -->
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Invoice</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo site_url('welcome/dashboard');?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                   
                    <li class="active">Seller Invoice</li>
                </ol>
            </div>
        </div>
<div class="row">
  <div class="col-sm-12">
    <div class="card-box">
      <div class="card-head">
        <header>Search</header>

     <?php echo $this->session->flashdata('User');?>    
                   
      </div>

      <div class="col-md-12 card-body row">
              <div class="col-lg-3 p-t-20"></div>
              <div class="col-lg-3 p-t-20"> 
                <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                        <select class = "mdl-textfield__input" id="seller" name="seller" style="text-transform: capitalize;" required>
                          <option selected disabled >-- Choose Seller --</option>
                          <?php foreach ($vendor as $key) {?>
                              <option value="<?php echo $key['id']; ?>"><?php echo $key['name']; ?>  
                                <?php if ($key['company_name'] != '') {
                                 echo '  -  ';   
                                 echo $key["company_name"]; } ?> </option>
                          <?php  } ?>
                        </select>
                        <label class = "mdl-textfield__label" >Select Seller</label>
                        <span class="intro" id="errorname"></span>
                </div>
              </div> 
              <div class="col-lg-3 p-t-20"> 
                <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                     <input class = "mdl-textfield__input" type="month" name="month" id="month" required> 
                </div>
              </div>
              <div class="col-lg-3 p-t-20"></div> 
                    
             <div class="col-lg-12 p-t-20 text-center">
                  <a class=" mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-primary" onclick="getSellerRecord();" name="search">Search</a>  
             </div>


      </div>

      <div class="invoice-body" id="invoice-body"></div>

    </div>
  </div>
</div> 
</div>
</div>
<!-- end page content -->


<script type="text/javascript">
 function getSellerRecord(){
    var month = document.getElementById('month').value;
    var seller   = document.getElementById('seller').value;
    $.ajax({
      type: "GET",
      url: "<?php echo base_url('index.php/Invoice/fetchSellerData');?>/?month="+month+"&seller_id="+seller,
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

               var currentDate = new Date()
               var day = currentDate.getDate()
               var month = currentDate.getMonth() + 1
               var year = currentDate.getFullYear()
               var InvoiceDaTE = day + "/" + month + "/" + year
            
             html += '<div class="invoice-box" style="margin-top:100px;"><div id="part_1"><center><img src="http://dailywale.com/dailywaleAdmin//assets/img/logo.png.png" alt="dailywale" width="12%"></center><table style="width:100%;padding-top:35px;" ><tr><td colspan="3"><b><span style="color:#625db1;">Daily Needs And Activities</span> </b></td><td colspan="3"><!-- <b style="color:red;">Total - &#8377; 10,080.00</b> --></td></tr><tr><td>GSTIN</td><td>:</td><td>'+gst_no+'</td><td>Invoice Date</td><td>:</td><td>'+InvoiceDaTE+'</td></tr><tr><td>PAN</td><td>:</td><td>Nil</td><td>Invoice No.</td><td>:</td><td> DW-00</td></tr><tr><td>State</td><td>:</td><td>Madhya Pradesh</td><td></td><td></td><td></td></tr><tr style="line-height:80px"><td colspan="6" style="font-size: 22px;">----------------------------------  BANK SETTELMENT  ----------------------------------</td></tr><tr><td><b>Seller</b></td><td>:</td><td><b><span style="color:red;">'+name+'('+company_name+')</span></b></td><td colspan="3"><b style="color:red;float: right;">Billing Address</b></td></tr><tr><td>GSTIN</td><td>:</td><td>'+gst_no+'</td><tr><td>PAN</td><td>:</td><td>Nil</td><td colspan="3">'+address+'</td></tr><tr><td>State</td><td>:</td><td>Madhya Pradesh</td><td colspan="3"></td></tr><tr><tr colspan="6"></tr><tr colspan="6"></tr><tr colspan="6"></tr><tr colspan="6"></tr><tr colspan="6"></tr><tr colspan="6"></tr></table></div> <table id="product_details" style="width:100%;" ><tr><th>SN</th><th>Product</th><th>Unit</th><th>Selling Price</th><th>Unit Amount</th><th>Delivery Charges</th><th>Delivery Total</th><th>Amount</th><th>Remarks</th></tr>'; 


              var itemarray = obj[i].ItemDetails;
              console.log(itemarray);
              var jj=0;
              var calculated_qty_total = 0;
              var calculated_amount_total = 0;
              var calculated_delivery_total = 0;
              for(var k=0;k<itemarray.length;k++){
                var item_name = itemarray[k]['item_name'];
                var qty = itemarray[k]['total'];
                var price = itemarray[k]['item_price'];
                var tax = itemarray[k]['tax'];
                var delivery = itemarray[k]['delivery'];
                var total_amt = qty * price; 
                
                calculated_qty_total += parseFloat(qty);
                calculated_amount_total += parseFloat(total_amt);
                //calculated_delivery_total += '00';

                jj = ++jj;
                html += '<tr><td>'+jj+'</td><td style="text-align: center;">'+item_name+'</td><td>'+qty+'</td><td>&#8377; '+price+'</td><td>'+total_amt+'</td><td>&#8377; </td><td>&#8377; '+delivery+' </td><td>&#8377; </td><td>&#8377; </td></tr>';

              } 

              html += '<tr><td colspan="9"></td></tr><tr><td></td><td><b>Total</b></td><td><b>'+calculated_qty_total+'</b></td><td></td><td><b>&#8377; '+calculated_amount_total+'</b></td><td></td><td>&#8377; '+calculated_delivery_total+' </td><td>&#8377;</td><td></td></tr><tr><td></td><td></td><td colspan="2">Taxable Amount</td><td></td><td></td><td></td><td>&#8377; '+calculated_amount_total+'    </td><td></td></tr><tr><td></td><td></td><td colspan="2">CGSTIN 2.5%</td><td></td><td></td><td></td><td>&#8377; - 0</td><td></td></tr><tr><td></td><td></td><td colspan="2">SGSTIN 2.5%</td><td></td><td></td><td></td><td>&#8377; - 0</td><td></td></tr><tr><td></td><td></td><td style="color:red;font-weight: bold;" colspan="3">Payment Gateway</td><td></td><td></td><td style="color:red;font-weight: bold;">&#8377; </td><td></td></tr><tr><td colspan="9" rowspan="3"><h4 style="float: right;color:red;">Thank You, We look forword to serve you again.</h4></td></tr></table><div style="margin-top: 30px;"><p style="width:85%;float: left;"><span style="color:red;">*</span>Scan the QR Code to check the invoice details of dailywale online Or visit : Our Site </p></div></div><center><div class="col-md-12"><input class="col-md-2 btn-primary" type="button" onclick="myFunction()" value="print" id="printbtn" style="margin-top:30px;margin-bottom: 30px;" /></div></center>';
          }
          $('#invoice-body').html(html);
       }else{
          html = '<h2>No Data Found</h2>';
          $('#invoice-body').html(html);
      }
    }
    });
 }
    getSellerRecord();
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
        //alert(url);
        $('#barcode').attr('src', url);
    }
</script>
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>