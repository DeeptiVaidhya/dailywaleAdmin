<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Print</title>
    
    <style>
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
.invoice-box { page-break-before: always; } /* page-break-after works, as well */
    </style>
</head>

<body>

<?php 
$j=1;
foreach($vendor as $v)
{ 
  $itemdata = $this->Model->getSellerData($v['id'], $month, $userId);
  if (!empty($itemdata)) {
?>
    <div class="invoice-box" style="margin-top:100px;">
      <div id="part_1">
        <center><img src="http://dailywale.com/dailywaleAdmin//assets/img/logo.png.png" alt="dailywale" width="12%"></center>
        <table style="width:100%;padding-top:35px;" >
          <tr>
            <td colspan="3"><b>Seller : <span style="color:#625db1;"><?php echo $v['name']; ?> <?php if (!$v['company_name'] == '') {?>(<?php echo $v['company_name']; ?>)<?php } ?> </span> </b></td>
            <td colspan="3"><!-- <b style="color:red;">Total - &#8377; 10,080.00</b> --></td>
          </tr>
          <tr>
            <td>GSTIN</td>
            <td>:</td>
            <td><?php if (!$v['gst_no'] == '') { echo $v['gst_no']; }else{ echo 'Nil'; } ?></td>
            <td>Invoice Date</td>
            <td>:</td>
            <td><?php echo date('d-M-Y') ?></td>
          </tr>
          <tr>
            <td>PAN</td>
            <td>:</td>
            <td>Nil</td>
            <td>Invoice No.</td>
            <td>:</td>
            <td> DW-00<?php echo $j; ?></td>
          </tr> 
          <tr>
            <td>State</td>
            <td>:</td>
            <td>Madhya Pradesh</td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
           <td colspan="6" style="font-size: 22px;">---------------------------------------  TAX INVOICE  ---------------------------------------</td>
          <tr>
            <?php foreach ($user as $value) {
             
            } ?>
          <tr>
            <td><b>Customer</b></td>
            <td>:</td>
            <td><b><span style="color:red;"><?php echo $value['fname']; ?> <?php echo $value['lname']; ?></span></b></td>
            <td colspan="3"><b style="color:red;float: right;">Billing Address</b></td>
          </tr>
          <tr>
            <td>PAN</td>
            <td>:</td>
            <td>Nil</td>
            <td colspan="3"><?php echo $value['address']; ?>, <?php echo $value['subzone_name']; ?>, </td>
          </tr> 
          <tr>
            <td>State</td>
            <td>:</td>
            <td><?php echo $value['state_name']; ?></td>
            <td colspan="3"> <?php echo $value['zone_name']; ?>, <?php echo $value['city_name']; ?>, <?php echo $value['state_name']; ?></td>
          </tr>
          <tr>  
          <tr colspan="6"></tr>
          <tr colspan="6"></tr>
          <tr colspan="6"></tr>
          <tr colspan="6"></tr>
          <tr colspan="6"></tr>
          <tr colspan="6"></tr>
        </table>
      </div>  
        <table id="product_details" style="width:100%;" >
          <tr>
            <th>SN</th>
            <th>Description</th>
            <th>Unit</th>
            <th>*Price</th>
            <th>Amount</th>
          </tr>
          <?php 
          $i=1;
          $TaxableAmount = '0';
          foreach ($itemdata as $item) {?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td style="text-align: center;"><?php echo $item['item_name']; ?> + Delivery Charges</td>
                    <td><?php echo $item['total']; ?></td>
                    <td>&#8377; <?php  echo $calcu_price = $item['price'] + $item['delivery'];?></td>
                    <td><?php echo $amount = $item['total'] * $calcu_price;?></td>
                </tr>
                <?php $TaxableAmount += $amount ?>
          <?php  $i++; } ?>
          <tr>
            <td colspan="9"></td>
          </tr>      
          <tr>
            <td></td>
            <td>Taxable Amount</td>
            <td></td>
            <td></td>
            <td>&#8377; <?php echo $TaxableAmount; ?></td>
          </tr>
          <tr>
            <td></td>
            <td>GSTIN</td>
            <td>0%</td>
            <td></td>
            <td>&#8377; -</td>
          </tr>
          <tr>
            <td></td>
            <td style="color:red;font-weight: bold;">Invoice Total</td>
            <td></td>
            <td></td>
            <td style="color:red;font-weight: bold;">&#8377; <?php echo $TaxableAmount; ?></td>
          </tr>
          <tr>
            <td colspan="9">*Note : Price is product final price of per unit including & exluding all tax, charges & discounts.<br>*Computer generated invoice.</td>
          </tr>
          <tr>
            <td colspan="9" rowspan="3"><h4 style="float: right;color:red;">Thank You, We look forword to serve you again.</h4></td>
          </tr>
        </table>


        <div style="margin-top: 30px;">
            <p style="width:85%;float: left;"><span style="color:red;">*</span>Scan the QR Code to check the invoice details of dailywale online Or visit : Our Site </p>
             <img id='barcode' 
            src="https://api.qrserver.com/v1/create-qr-code/?data=Sanjay&amp;size=100x100" 
            alt="" 
            title="Qr" 
            width="70" 
            height="70" />
        </div>

    </div>
<?php $j++; } } ?>

    <center>
      <div class="col-md-12">
          <input class="col-md-2 btn-primary" type="button" onclick="myFunction()" value="print" id="printbtn" style="margin-top:30px;margin-bottom: 30px;" />

          <form action="<?php echo site_url('Invoice/SendMailOnUserMail');?>" method="post">
            <input type="hidden" name="month" value="<?php echo $month; ?>">
            <input type="hidden" name="userid" value="<?php echo $userId; ?>">
          <input class="col-md-2 btn-info" type="submit"  value="Send Email"  style="margin-top:30px;margin-bottom: 30px;" />
          </form>
      </div>
    </center>
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

</body>
</html>