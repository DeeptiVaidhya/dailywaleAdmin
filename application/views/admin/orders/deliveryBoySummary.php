<!-- start page content  -->  
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;

}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 1px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
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
                           <header style="width: 90%;">Delivery Boy Summary</header>
                           
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
                                     </div>
                                   </div>
                                  </div>
                                </div>
                               </div>




                              <div style="width: 100%;" >
                                 <table  style="font-size: 6px;">
                                    <thead>
                                       <tr>
                                          <th>Item Name</th>
                                          <th>Quanity</th>
                                          <th>Item Quantity Desc</th>
                                          <th>Seller Name</th>
                                          <th>Date Time</th>
                                           
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
        url: "<?php echo base_url('index.php/Orders/deliveryBoySummaryData');?>/?from="+from+"&to="+to,
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
               var item_name          = obj[i]['item_name'];
               var total         = obj[i]['total'];
               var item_quantity_desc         = obj[i]['item_quantity_desc'];
               var name        = obj[i]['name'];
               var date_time        = obj[i]['date_time'];
               j = ++j;

              dataTablePending.row.add([
                item_name,
                total,
                item_quantity_desc,
                name,
                date_time
                
              ]).draw(true);

               html += '<tr><td>'+item_name+'</td><td>'+total+'</td><td>'+item_quantity_desc+'</td><td>'+name+'</td><td>'+date_time+'</td></tr>';
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