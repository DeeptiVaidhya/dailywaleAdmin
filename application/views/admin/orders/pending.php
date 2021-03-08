<!-- start page content  -->  
<div  id="getdate"></div>
<div class="page-content-wrapper" id="hidetable">
   <div class="page-content">
      <div class="page-bar">
         <div class="page-title-breadcrumb">
            <div class=" pull-left">
              <!--  <div class="page-title">Item List</div> -->
            </div>
         </div>
      </div>
      <?php echo $this->session->flashdata('sucessuser');?>
      <?php echo $this->session->flashdata('updateuser');?>
      <?php echo $this->session->flashdata('deleteuser');?>  
      <div class="row">
         <div class="col-md-12">
            <div class="tabbable-line">
               </ul>
               <div class="row">
               <!--  <form action="<?php // echo site_url();?>/Orders/downloadDailyOrdersCSV"><button type="submit"  class="btn btn-primary">CSV</button> </form>
                <form action="<?php // echo site_url();?>/Orders/downloadOrdersSummaryCSV"><button type="submit"  class="btn btn-primary">Summary</button> </form> -->
                  <div class="col-md-12">
                     <div class="card card-box">
                        <div class="card-head">
                           <header style="width: 90%;">Show Upcoming Order</header>
                           <div style="margin: 10px;"><button class="btn btn-primary" id="multiDispatch" onClick="ShowModal(this)"  ><i class="glyphicon glyphicon-ok">Dispatch</i></button></div>
                        </div>
                        <div class="card-body ">
                           <div class="row">
                              <div class="card-body ">
                                <div class="col-md-6 row" style="float:left;">
                                  <h5><b>Search Order</b></h5>
                                  <div style="float:left;border: 1px solid #cdcccc;padding-bottom: 10px;width: 100%;">
                                   <div class="col-lg-4" style="float: left;">
                                    <div class="col-lg-1"><label>From</label></div>
                                       <div class="col-lg-12">
                                          <div class="form-control-wrapper">
                                             <input type="date"  id="fromm"  name="from" class="floating-label mdl-textfield__input"  placeholder="Date">   
                                          </div>
                                       </div>
                                   </div>
                                    <div class="col-lg-4" style="float: left;">
                                       <div class="col-lg-1"><label>To</label></div>
                                       <div class="col-lg-12">
                                          <div class="form-control-wrapper">
                                             <input type="date" min="07/03/2018" id="to"  name="to" class="floating-label mdl-textfield__input"  placeholder="Date">
                                             <!-- <input type="text" id="date" name="to" class="floating-label mdl-textfield__input"  placeholder="Date"> -->   
                                          </div>
                                       </div>
                                   </div>
                                   <div class="col-lg-4 p-t-20" style="float: left;">
                                     <div class="form-control-wrapper">
                                       <button type="submit" onclick="getRecord();" class="btn btn-primary">Submit</button>   
                                        <img src="http://dailywale.com/dailywaleAdmin/assets/img/Untitled-5-512.png" style="width:24%;float:left;" alt="csv" id='aaa'> 
                                     </div>
                                   </div>
                                  </div>
                                </div>



                                 <div class="col-md-6 row">
                                  <h5><b>Export Order in CSV formate.</b></h5>
                                  <form action="<?php echo site_url();?>/Orders/ExportData" method="post"  style="float:left;border: 1px solid #cdcccc;padding-bottom: 10px;">
                                   <div class="col-lg-4" style="float: left;">
                                    <div class="col-lg-1"><label>From</label></div>
                                       <div class="col-lg-12">
                                          <div class="form-control-wrapper">
                                             <input type="date"  name="export_from" class="" 
                                             required="">   
                                          </div>
                                       </div>
                                   </div>
                                    <div class="col-lg-4" style="float: left;margin-left: 15px;">
                                       <div class="col-lg-1"><label>To</label></div>
                                       <div class="col-lg-12">
                                          <div class="form-control-wrapper">
                                             <input type="date" name="export_to" class="" required="">  
                                          </div>
                                       </div>
                                   </div>
                                   <div class="col-lg-3 p-t-20" style="float: left;margin: 5px 0px 0px 25px;">
                                     <div class="form-control-wrapper">
                                          <button type="submit" class="btn btn-primary">Export Order</button> 
                                     </div>
                                   </div>
                                  </form>   

                                </div>    
                              </div>


                              <div class="col-md-12 row" id="sss" style="display: none;">
                            <center >  
                                  <h4><b>Download Delivery Orders (CSV)</b></h4>
                                  <div style="float:left;border: 1px solid #cdcccc;padding-bottom: 10px;width: 100%;">
                                  <form action="<?php echo site_url();?>/Orders/Export_Delivery_Data" method="post" >
                                   <div class="col-lg-4" style="float: left;">
                                    <div class="col-lg-1"><label>From</label></div>
                                       <div class="col-lg-12">
                                          <div class="form-control-wrapper">
                                             <input type="date"  name="export_from_delivery" required="">   
                                          </div>
                                       </div>
                                   </div>
                                    <div class="col-lg-4" style="float: left;">
                                       <div class="col-lg-1"><label>To</label></div>
                                       <div class="col-lg-12">
                                          <div class="form-control-wrapper">
                                             <input type="date"   name="export_to_delivery" required="">
                                             <!-- <input type="text" id="date" name="to" class="floating-label mdl-textfield__input"  placeholder="Date"> -->   
                                          </div>
                                       </div>
                                   </div>
                                   <div class="col-lg-4 p-t-20" style="float: left;">
                                    
                                     <div class="form-control-wrapper">
                                          <button type="submit" class="btn btn-primary" id="Export_Delivery_Button">Export Delivery Order</button> 
                                     </div>
                                  
                                   </div>
                                 </form>
                                  </div>
                              </center>    
                                </div>




                              <div class="table-scrollable" >
                                 <table class="table table-striped table-bordered table-hover table-checkable order-column valign-middle" id="order_detail_table">
                                    <thead>
                                       <tr>
                                          <th>Select</th> 
                                          <th>OrderId</th>
                                          <th>User Name</th>
                                          <th>Email</th>
                                          <th>Mobile</th>
                                          <th>Address</th>
                                          <th>Zone</th>
                                          <th>Sub Zone</th>
                                          <th>Item</th>
                                          <th>Quantity</th>
                                          <th>Order Amount</th>
                                          <th>Order Date</th> 
                                          <th> Action </th>  
                                       </tr>
                                    </thead>
                                    <tbody id="table_body" >
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                         </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

<!-- end page content-->

<!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button> -->

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
     <!--  <form action="<?php echo site_url();?>/Orders/updateStatus" method="post" > -->
      <div class="modal-header">
       <!--  <button type="button" class="close" data-dismiss="modal">&times;</button> -->
        <h4 class="col-md-12 modal-title" style="text-align: center;">Driver List</h4>
      </div>
      <div class="modal-body">
        <div class="col-md-12 form-group">
          <label for="comment">Select Driver</label>
          <select class="col-md-12" name="dd_driver" id="dd_driver">
          </select>
          <input type="hidden" name="order_idss" value="" id="order_idss">
           <div id="arr_ids"><input type="hidden" name="mulorder_idss" value="" id="mulorder_idss"></div>
        </div>

        <div class="col-md-12 form-group" style="display:none;">
          <select class="col-md-12" name="dd_driver_name" id="dd_driver_name">
          </select>
        </div>

      </div>
      <div class="modal-footer">
        <input type="submit" class="btn btn-success" value="Send" name="Submit" onClick="DispatchDriverData(this);"  />
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    <!-- </form> -->
    </div>

  </div>
</div>
<?php
       $this->load->view('admin/assets/footer');
?>
<script type="text/javascript">
jQuery(document).ready(function($) {
    $("#dd_driver").on('change', function() {
        var driver_ids = $(this).val();
        var data = {
        'api_key': "<?php echo DV_API_KEY; ?>"
      }
      $.ajax({
        type: "POST",
        url: "<?php echo DV_API_URL_GET_DRIVER_DATA; ?>/"+driver_ids,
        data: JSON.stringify(data),
        success: function(data){
          var res = JSON.parse(data);
          if(res.result==true){
            var driverList = res.data;
            var driverdata = "<option value=''selected disabled>--- Choose ---</option>";
            for (var i = 0; i <= res.data.length-1; i++) {
              driverdata += "<option  value='"+res.data[i].name+" "+res.data[i].lname+"' selected disabled >"+res.data[i].name+" "+res.data[i].lname+"</option>"
            }
            $("#dd_driver_name").html(driverdata);
          }
        }
      });
    });
});
</script>
<script type="text/javascript">

    var dataTablePending = $('#order_detail_table').DataTable();
    function getRecord(){
      var from = document.getElementById('fromm').value;
      var to   = document.getElementById('to').value;

      $.ajax({
        type: "GET",
        url: "<?php echo base_url('index.php/Orders/fetchdata');?>/?from="+from+"&to="+to,
      success: function(data){
          dataTablePending
            .rows()
            .remove()
            .draw();
         var obj = JSON.parse(data);
         if(obj.length>0){
            var html = '';
            var j=0;
            for(var i=0;i<obj.length;i++){
               var name          = obj[i]['fname'];
               var lname         = obj[i]['lname'];
               var email         = obj[i]['email'];
               var mobile        = obj[i]['user_mobile'];
               var address       = obj[i]['address'];
               var city          = obj[i]['city_name'];
               var state         = obj[i]['state_name'];
               var zone          = obj[i]['zone_name'];
               var subzone       = obj[i]['subzone_name'];
               var item_name     = obj[i]['item_name'];
               var quantity      = obj[i]['quanity'];
               var order_date    = obj[i]['date_time'];
               var total_amount  = obj[i]['total_price'];
               var cart_id      = obj[i]['cart_id'];
               j = ++j;

              dataTablePending.row.add([
                '<input type="checkbox" id="checked_id" name="checked_id[]" value='+cart_id+' />',
                //j,
                cart_id,
                name+' '+lname,
                email,
                mobile,
                address+','+zone+','+subzone+','+city+','+state,
                zone,
                subzone,
                //city,
                //state,
                item_name,
                quantity,
                total_amount,
                order_date,
                '<a class="btn btn-primary" onClick="ShowModal(this)" data-id='+cart_id+' ><i class="glyphicon glyphicon-ok">Dispatch</i></a><a class="btn btn-danger" href="<?php echo site_url('Orders/updateStatusCenc/2/');?>'+cart_id+'"><i class="glyphicon glyphicon-ok">Cancel</i></a>'
              ]).draw(true);

               html += '<tr><td><input type="checkbox" id="checked_id" name="checked_id[]" value='+cart_id+' /></td><td>'+cart_id+'</td><td>'+name+' '+lname+'</td><td>'+email+'</td><td>'+mobile+'</td><td>'+address+', '+zone+', '+subzone+', '+city+', '+state+'</td><td>'+zone+'</td><td>'+subzone+'</td><td>'+item_name+'</td><td>'+quantity+'</td><td>'+total_amount+'</td><td>'+order_date+'</td><td><a class="btn btn-primary" onClick="ShowModal(this)" data-id='+cart_id+' ><i class="glyphicon glyphicon-ok">Dispatch</i></a><a class="btn btn-danger" href="<?php echo site_url('Orders/updateStatusCenc/2/');?>'+cart_id+'"><i class="glyphicon glyphicon-ok">Cancel</i></a><!--<a class="btn btn-basic" href="<?php echo site_url('Orders/pendingview/');?>'+cart_id+'"><i class="glyphicon glyphicon-ok">View</i></a>--></td></tr>';
            }
            $('#table_body').html(html);
         }else{
            html = '<tr><td  colspan="13">No Data Found</td></tr>';
            $('#table_body').html(html);
        }
      }
      });
   }

    function getDriverList(){
      var data = {
        'api_key': "<?php echo DV_API_KEY; ?>"
      }
      $.ajax({
        type: "POST",
        url: "<?php echo DV_API_URL_GET_DRIVER; ?>",
        data: JSON.stringify(data),
        success: function(data){
          var res = JSON.parse(data);
          if(res.result==true){
            var driverList = res.data;
            var driverdata = "<option value=''selected disabled>--- Choose ---</option>";
            for (var i = 0; i <= res.data.length-1; i++) {
              driverdata += "<option value='"+res.data[i].d_id+"' >"+res.data[i].name+" "+res.data[i].lname+" - "+res.data[i].zone+"</option>"
            }
            $("#dd_driver").html(driverdata);
          }
        }
      });
   }





   function DispatchDriverData(){
       var dd_driver = document.getElementById('dd_driver').value;
       var dd_driver_name = document.getElementById('dd_driver_name').value;
       var order_id_send   = document.getElementById('order_idss').value;
       var mulorder_idss   = document.getElementById('mulorder_idss').value;

       if (order_id_send != '') {
          saveDriverData(dd_driver, dd_driver_name, order_id_send);
       }else{
          var myarray = mulorder_idss.split(',');
          for(var i = 0; i < myarray.length; i++)
          {
             //console.log(myarray[i]);
             saveDriverData(dd_driver, dd_driver_name, myarray[i]);
          }
       }
       
    }


   function saveDriverData(dd_driver, dd_driver_name, order_id_send){
       // var dd_driver = document.getElementById('dd_driver').value;
       // var dd_driver_name = document.getElementById('dd_driver_name').value;
       // var order_id_send   = document.getElementById('order_idss').value;
       // var mulorder_idss   = document.getElementById('mulorder_idss').value;
       $.ajax({
        type: "GET",
        url: "<?php echo base_url(); ?>index.php/Api/getCartandUserDetails/?cart_id="+order_id_send,
        //url: "<?php echo base_url(); ?>index.php/Api/getCartandUserDetails/?cart_id="+order_id_send+"&mulorder_idss="+mulorder_idss,
        success: function(data){
            var res_data = JSON.parse(data);
            if(res_data.result==true){
              sendToDelivry(res_data, dd_driver, dd_driver_name);
            }else{
              alert("Order Not Found");
            }
         }
      });
    }

    function sendToDelivry(req, d_id){
      var data = {
        "api_key": "<?php echo DV_API_KEY; ?>",
        "driver_id": d_id,
        "customer": {
          "first_name": req.vender.name,
          "last_name": req.vender.name,
          "password": req.user.pwd,
          "mobile": req.vender.phone,
          "email": req.vender.email,
          "address": req.vender.address
        },
        "order": {
          "unique_id": req.cart.cart_id,
          "order_name": req.item[0].item_name+" - "+req.cart.quanity,
          "order_type": "Regular", 
          "weight": req.cart.quanity, 
          "pickaddress_label": req.user.address +","+req.user.zone_name +","+req.user.subzone_name +","+req.user.city_name +","+req.user.state_name, 
          "longitude_from": "", 
          "longitude_to": "", 
          "confirm_order_date":req.cart.date_time,
          "parcel_idCount":"1",
          "pick_mobile": req.user.user_mobile,
          "pick_email": req.user.email,
          "pick_name": req.user.fname,
          "pick_address": req.user.address +","+req.user.zone_name +","+req.user.subzone_name +","+req.user.city_name +","+req.user.state_name
        }
      }
     // console.log(data);
      var settings = {
        "url": "<?php echo DV_API_URL_SEND_ORDER; ?>",
        "method": "POST",
        "headers": {
          "content-type": "application/json",
        },
        "processData": false,
        "data": JSON.stringify(data)
      }

      $.ajax(settings).done(function (response) {
        var res_data = JSON.parse(response);
        //console.log(res_data);
        if(res_data.result==true){
          updateMyOrder(d_id, req.cart.cart_id);
        }else{
          alert("Order Not Found");
        }
      });
    }

    function updateMyOrder(dd_driver, cart_id){
      var dd_driver_name = document.getElementById('dd_driver_name').value;
     // var mulorder_idss   = document.getElementById('mulorder_idss').value;
       $.ajax({
        type: "POST",
        url: "<?php echo base_url('index.php/Orders/updateStatusAPI'); ?>/?dd_driver="+dd_driver+"&cart_id="+cart_id+"&dd_driver_name="+dd_driver_name,         
        //url: "<?php // echo base_url('index.php/Orders/updateStatusAPI'); ?>/?dd_driver="+dd_driver+"&cart_id="+cart_id+"&dd_driver_name="+dd_driver_name+"&mulorder_idss="+mulorder_idss,
        success: function(response){
          var res_data = JSON.parse(response);
          if(res_data.result==true){
              $("#myModal").modal('hide');
              $('#table_body').html('');
              getRecord();
          }
        }
      });
    }
  getRecord();
  getDriverList(); 
</script>
<script type="text/javascript">
  function ShowModal(elem){
    $("#myModal").modal('show');
    var dataId = $(elem).data("id");
    $('#order_idss').val(dataId);
}
</script>
<script type="text/javascript">
$(document).ready(function(){
    $("#aaa").click(function(){
        $("#sss").show();
    });
    $("#Export_Delivery_Button").click(function(){
        $("#sss").hide();
    });
    
});            
</script>

<script type="text/javascript">
$(document).ready(function()
{
    $("#multiDispatch").click(function()
    {
     var arr = $.map($('input:checkbox:checked'), function(e, i) {
        return +e.value;
    });
      
    //alert(arr.join(','));
    var send_multiple_order = arr.join(',')  
    
    $('#mulorder_idss').val(send_multiple_order); 
     // alert("My location themes colors are: " + locationthemes.join(", "));

    });
      
});


// $(document).ready(function() {
//   $('#multiDispatch').hide();
//   $('#radio').mouseup(function() {
//     $('#multiDispatch').toggle();

//   });
// });
</script>