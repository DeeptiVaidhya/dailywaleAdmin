start page content -->
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
                               
                                <li class="active">Customer Invoice</li>
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
                  
                  <form action="<?php echo site_url('Invoice/search');?>" method="post" >
                  <div class="card-body row">
                          <div class="col-lg-4 p-t-20"> 
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                    <select class = "mdl-textfield__input" id="user_name" name="user_name" style="text-transform: capitalize;" required>
                                      <option selected disabled >-- Choose Customer --</option>
                                      <?php foreach ($user as $key) {?>
                                          <option value="<?php echo $key['user_id']; ?>"><?php echo $key['fname']; ?> <?php echo $key['lname']; ?> - <?php echo $key['user_mobile']; ?></option>
                                      <?php } ?>
                                    </select>
                                    <label class = "mdl-textfield__label" >Select User Name</label>
                                    <span class="intro" id="errorname"></span>
                            </div>
                          </div> 
                          <div class="col-lg-4 p-t-20"> 
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                 <input class = "mdl-textfield__input" type="month" name="month" id="month" required> 
                            </div>
                          </div> 
                                
                         <div class="col-lg-12 p-t-20 text-center"> 
                              <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-primary">Search</button>
                      
                          </div>


                  </div>
                 </form>

                </div>
              </div>
            </div> 
         </div>
       </div>
            <!-- end page content -->




















<!-- <!doctype html>
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
    </style>
</head>

<body>


  <div class="container" style="margin-top: 120px;">
    <div class="col-md-12">
        <center>
          <form action="<?php echo site_url('Invoice/search');?>" method="post" >
            <select class="col-md-4 form-control" name="user_name" id="user_name">
                <option selected disabled >-- Choose Customer --</option>
                <?php foreach ($user as $key) {?>
                    <option value="<?php echo $key['user_id']; ?>"><?php echo $key['fname']; ?> <?php echo $key['lname']; ?> - <?php echo $key['user_mobile']; ?></option>
                <?php } ?>
            </select>
            <input type="submit" name="submit" value="Search" />
          </form>
        </center>
    </div>
  </div> -->
<?php 
//foreach($user as $value)
//{//print_r($value['id']);

//$itemdata = $this->Model->getSellerData($value['id']);
//}?>
    <!-- <div class="invoice-box" style="margin-top:100px;">
        <!-- <h3 style="text-align: center;">Invoice</h3> -->
     <!-- <div id="part_1">
        <table style="width:100%;padding-top:35px;" >
          <tr>
            <td colspan="3"><b><span style="color:#625db1;font-size: 22px;">Daily Needs And Activiti</span> </b></td>
            <td colspan="3"><b style="color:red;">Total - &#8377; 10,080.00</b></td>
          </tr>
          <tr>
            <td>GSTIN</td>
            <td>:</td>
            <td><?php // echo $value['gst_no']; ?>1212121121</td>
            <td>Invoice Date</td>
            <td>:</td>
            <td><?php // echo $value['gst_no']; ?>23-Nov-2018</td>
          </tr>
          <tr>
            <td>PAN</td>
            <td>:</td>
            <td><?php // echo $value['gst_no']; ?>1212121121</td>
            <td>Invoice No.</td>
            <td>:</td>
            <td><?php // echo $value['gst_no']; ?>001</td>
          </tr> 
          <tr>
            <td>State</td>
            <td>:</td>
            <td><?php // echo $value['gst_no']; ?>Madhya Pradesh</td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
           <td colspan="6" style="font-size: 22px;">---------------------------------------  TAX INVOICE  ---------------------------------------</td>
          <tr>
          <tr>
            <td><b>Seller</b></td>
            <td>:</td>
            <td><b><span style="color:red;"><?php // echo $value['gst_no']; ?>abc</span></b></td>
            <td colspan="3"><b style="color:red;float: right;">Billing Address</b></td>
          </tr>
          <tr>
            <td>PAN</td>
            <td>:</td>
            <td><?php // echo $value['gst_no']; ?>1212121121</td>
            <td colspan="3"></td>
          </tr> 
          <tr>
            <td>State</td>
            <td>:</td>
            <td><?php // echo $value['gst_no']; ?>Madhya Pradesh</td>
            <td colspan="3"></td>
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
            <th>Amount</th>
            <th>Remarks</th>
          </tr>
          <?php 
        //  $i=1;
         // print_r($itemdata);
         // foreach ($itemdata as $item) {?>
<!--                <tr>
                    <td><?php // echo $i; ?></td>
                    <td><?php // echo $item['item_name']; ?></td>
                    <td>&#8377; <?php //  echo $item['total']; ?></td>
                    <td><?php  //echo $item['price']; ?></td>
                </tr>
          <?php //  $i++; } ?>
         
           
      <!--    <tr>
            <td colspan="9"></td>
          </tr>
          <tr>
            <td colspan="9"></td>
          </tr>
          <!-- <tr>
            <td>Description</td>
            <td>:</td>
            <td colspan="4">dddfdfdsfdsf</td>
          </tr>
          <tr>
            <td colspan="9" rowspan="3"><h4 style="float: right;color:red;">Thank You, We look forword to serve you again.</h4></td>
          </tr> -->
       <!-- </table>


        <div>
            <p style="width:85%;float: left;">Scan the QR Code to check the status of your job online Or visit : Our Site </p>
           <!--  <img id='barcode' 
            src="https://api.qrserver.com/v1/create-qr-code/?data=Job No-<?php echo $j->Job_No; ?>&amp;size=100x100" 
            alt="" 
            title="Qr" 
            width="70" 
            height="70" /> -->
    <!--    </div>

    </div> -->
<?php // } ?>

  <!--  <center><input type="button" onclick="myFunction()" value="print" id="printbtn" style="margin-top:30px;" /></center>-->
<!-- <script>
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
<script type="text/javascript">
// $(document).ready(function()
//  {
//     $("#user_name").on('change', function() {
//         var userId = $(this).val();
//         if(userId){
//             $.ajax ({                
//                 type: 'GET',
//                 url: '<?php echo base_url(); ?>index.php/Invoice/getUserItemData/'+userId,
//                 success: function(data){
//                     alert(data);
//                 var obj = JSON.parse(data); 
//                   if(obj.length>0){
//                   //   $("#selectCity option").remove();
//                   // for(var i=0; i<obj.length; i++){

//                   //   $('#selectCity').append("<option value='"+obj[i].city_id+"' >"+obj[i].city_name+"</option>");
//                   // }
//                   //alert(obj[0]['fname']);
//                 var html = '';
//                     var name          = obj[0]['fname'];
//                     var lname         = obj[0]['lname'];
//                     var email         = obj[0]['email'];
//                     var address         = obj[0]['address'];

//                     html += '<table style="width:100%;padding-top:35px;" ><tr><td colspan="3"><b><span style="color:#625db1;font-size: 22px;">Daily Needs And Activiti</span> </b></td><td colspan="3"><b style="color:red;">Total - &#8377; 10,080.00</b></td></tr><tr><td>GSTIN</td><td>:</td><td>22232232</td><td>Invoice Date</td><td>:</td><td>23-Nov-2018</td></tr><tr><td>PAN</td><td>:</td><td>1212121121</td><td>Invoice No.</td><td>:</td><td>001</td></tr><tr><td>State</td><td>:</td><td>Madhya Pradesh</td><td></td><td></td><td></td></tr><tr><td colspan="6" style="font-size: 22px;">---------------------------------------  TAX INVOICE  ---------------------------------------</td><tr><tr><td><b>Seller</b></td><td>:</td><td><b><span style="color:red;">'+name+' '+lname+'</span></b></td><td colspan="3"><b style="color:red;float: right;">Billing Address</b></td></tr><tr><td>PAN</td><td>:</td><td></td><td colspan="3">'+address+'</td></tr><tr><td>State</td><td>:</td><td></td><td colspan="3"></td></tr><tr><tr colspan="6"></tr><tr colspan="6"></tr><tr colspan="6"></tr><tr colspan="6"></tr><tr colspan="6"></tr><tr colspan="6"></tr></table>';
//                 $('#part_1').html(html);
//              }else{
//                 html = '<tr><td  colspan="10">No Data Found</td></tr>';
//                 $('#part_1').html(html);
//             }
            
//               }
//             });
//         }
//     });
//   });  
</script>

</body>
</html>