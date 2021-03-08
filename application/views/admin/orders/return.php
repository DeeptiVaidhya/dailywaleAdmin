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
                  <div class="col-md-12">
                     <div class="card card-box">
                        <div class="card-head">
                           <header>Show Return Order</header>
                        </div>
                        <div class="card-body ">
                           <div class="row">
                              <div class="card-body ">
                                <div class="row">
                                   <div class="col-lg-4 ">
                                    <div class="col-lg-1"><label>From</label></div>
                                       <div class="col-lg-12">
                                          <div class="form-control-wrapper">
                                             <input type="date"  id="fromm"  name="from" class="floating-label mdl-textfield__input"  placeholder="Date">   
                                          </div>
                                       </div>
                                   </div>
                                    <div class="col-lg-4">
                                       <div class="col-lg-1"><label>To</label></div>
                                       <div class="col-lg-12">
                                          <div class="form-control-wrapper">
                                             <input type="date" min="07/03/2018" id="to"  name="to" class="floating-label mdl-textfield__input"  placeholder="Date">
                                             <!-- <input type="text" id="date" name="to" class="floating-label mdl-textfield__input"  placeholder="Date"> -->   
                                          </div>
                                       </div>
                                   </div>
                                   <div class="col-lg-3 p-t-20">
                                     <div class="form-control-wrapper">
                                       <button type="submit" onclick="getRecord();" class="btn btn-primary">Submit</button>   
                                     </div>
                                   </div>
                                </div>
                              </div>
                              <div class="table-scrollable" >
                                 <table class="table table-striped table-bordered table-hover table-checkable order-column valign-middle" id="order_detail_table">
                                    <thead>
                                       <tr>
                                          <th>Id</th>
                                          <th>User Name</th>
                                          <th>Email</th>
                                          <th>Mobile</th>
                                          <th>Address</th>
                                          <th>Item</th>
                                          <th>Quantity</th>
                                          <th>Order Amount</th>
                                          <th>Order Date</th> 
                                          <th>Driver</th>
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

        </div>
      </div>
      <div class="modal-footer">
        <input type="submit" class="btn btn-success" value="Send" name="Submit" onClick="saveDriverData(this);"  />
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    <!-- </form> -->
    </div>

  </div>
</div>

<!-- end model -->

<!-- end page content-->
<?php
       $this->load->view('admin/assets/footer');
?>
<script type="text/javascript">
   var dataTablePending = $('#order_detail_table').DataTable();
   function getRecord(){
      var from = document.getElementById('fromm').value;
      var to   = document.getElementById('to').value;
      // alert(to);
      $.ajax({
        type: "GET",
        url: "<?php echo base_url('index.php/Orders/returndata');?>/?from="+from+"&to="+to,
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
               var address        = obj[i]['address'];
               var item_name     = obj[i]['item_name'];
               var quantity      = obj[i]['quanity'];
               var order_date    = obj[i]['date_time'];
               var total_amount  = obj[i]['total_price'];
               var cart_id      = obj[i]['cart_id'];
               var driver_name     = obj[i]['driver_name'];
               j = ++j;


               dataTablePending.row.add([
                j,
                name+' '+lname,
                email,
                mobile,
                address,
                item_name,
                quantity,
                total_amount,
                order_date,
                driver_name,
                '<a class="btn btn-primary" onClick="ShowModal(this)" data-id='+cart_id+'><i class="glyphicon glyphicon-ok">Accept</i></a>'
              ]).draw(true);


               html += '<tr><td>'+j+'</td><td>'+name+' '+lname+'</td><td>'+email+'</td><td>'+mobile+'</td><td>'+address+'</td><td>'+item_name+'</td><td>'+quantity+'</td><td>'+total_amount+'</td><td>'+order_date+'</td><td>'+driver_name+'</td><td><!--<a class="btn btn-primary" href="<?php echo site_url('Orders/updateReturnOrder/5/');?>'+cart_id+'"><i class="glyphicon glyphicon-ok">Accept</i></a>--><a class="btn btn-primary" onClick="ShowModal(this)" data-id='+cart_id+'><i class="glyphicon glyphicon-ok">Accept</i></a><!--<a class="btn btn-basic" href="<?php echo site_url('Orders/pendingview/');?>'+cart_id+'"><i class="glyphicon glyphicon-ok">View</i></a>--></td></tr>';
            }
            console.log(html);
            $('#table_body').html(html);
         }else{
            html = '<tr><td  colspan="11">No Data Found</td></tr>';
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



     function saveDriverData(){
       var dd_driver = document.getElementById('dd_driver').value;
       var order_id_send   = document.getElementById('order_idss').value;
       $.ajax({
        type: "GET",
        url: "<?php echo base_url(); ?>index.php/Api/getCartandUserDetails/?cart_id="+order_id_send,
        success: function(data){
            var res_data = JSON.parse(data);
            if(res_data.result==true){
              sendToDelivry(res_data, dd_driver);
            }else{
              alert("Order Not Found");
            }
         }
      });
    }

    function sendToDelivry(req, d_id){
     // console.log(req);
     // console.log(req.vender);
      var data = {
        "api_key": "<?php echo DV_API_KEY; ?>",
        "driver_id": d_id,
        "customer": {
          "first_name": req.user.fname,
          "last_name": req.user.lname,
          "password": req.user.pwd,
          "mobile": req.user.user_mobile,
          "email": req.user.email,
          "address": req.user.address +","+req.user.zone_name +","+req.user.subzone_name +","+req.user.city_name +","+req.user.state_name
        },
        "order": {
          "unique_id": req.cart.cart_id,
          "order_name": req.item[0].item_name+" - "+req.cart.quanity,
          "order_type": "Regular", 
          "weight": req.cart.quanity,  
          "longitude_from": "", 
          "longitude_to": "", 
          "confirm_order_date":req.cart.date_time,
          "parcel_idCount":"1",
          "pick_mobile": req.vender.phone,
          "pick_email": req.vender.email,
          "pick_name": req.vender.name,
          "pick_address": req.vender.address,
          "pickaddress_label": req.vender.address,
        }
      }
      console.log(data);
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
        if(res_data.result==true){
          updateMyOrder(d_id, req.cart.cart_id);
        }else{
          alert("Order Not Found");
        }
      });
    }

    function updateMyOrder(dd_driver, cart_id){
       $.ajax({
        type: "POST",
        url: "<?php echo base_url('index.php/Orders/updateReturnOrder'); ?>/?dd_driver="+dd_driver+"&cart_id="+cart_id,
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