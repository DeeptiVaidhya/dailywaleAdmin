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
                           <header>Show All Order</header>
                        </div>
                        <div class="card-body ">
                           <div class="row">
                              <div class="card-body ">
                                <div class="row">
                                   <div class="col-lg-4 ">
                                     <label style="    padding-left: 16px;">Search Order</label>
                                       <div class="col-lg-12">
                                          <div class="form-control-wrapper">
                                             <input type="date"  id="fromm"  name="from" class="floating-label mdl-textfield__input"  placeholder="Date">   
                                          </div>
                                       </div>
                                   </div>
                                    <!-- <div class="col-lg-4">
                                       <div class="col-lg-1"><label>To</label></div>
                                       <div class="col-lg-12">
                                          <div class="form-control-wrapper">
                                             <input type="date" min="07/03/2018" id="to"  name="to" class="floating-label mdl-textfield__input"  placeholder="Date">
                                             <input type="text" id="date" name="to" class="floating-label mdl-textfield__input"  placeholder="Date">  
                                          </div>
                                       </div>
                                   </div> -->
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
                                          <th>Item</th>
                                          <th>Quantity</th>
                                          <th>Order Amount</th>
                                          <th>Order Date</th>
                                          <th>Status</th> 
                                          <!-- <th> Action </th>   -->
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


<?php
       $this->load->view('admin/assets/footer');
?>
<script type="text/javascript">
   var dataTablePending = $('#order_detail_table').DataTable();
   function getRecord(){
      var from = document.getElementById('fromm').value;
      

      $.ajax({
        type: "GET",
        url: "<?php echo base_url('index.php/Orders/fetchorderdata');?>/?from="+from,
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
              var item_name     = obj[i]['item_name'];
              var quantity      = obj[i]['quanity'];
              var order_date    = obj[i]['date_time'];
              var total_amount  = obj[i]['total_price'];
              var cart_id      = obj[i]['cart_id'];
              var cart_status  = obj[i]['cart_status'];
              var cart_id      = obj[i]['cart_id'];
              
              if (cart_status == 0)
               var status= 'Cart';
              else if (cart_status == 1)
               var status= 'Order';
              else if (cart_status == 2)
               var status= 'Cancle';
             else if (cart_status == 3)
               var status= 'Return';
             else if (cart_status == 4)
               var status= 'Delivery';
             else if (cart_status == 5 )
               var status= 'Return Accepted';
            else 
               var status= 'Empty';

               j = ++j;


               dataTablePending.row.add([
                //j,
                cart_id,
                name+' '+lname,
                email,
                mobile,
                item_name,
                quantity,
                total_amount,
                order_date,
                //cart_id,
                status,
              ]).draw(true);


               html += '<tr><td>'+cart_id+'</td><td>'+name+' '+lname+'</td><td>'+email+'</td><td>'+mobile+'</td><td>'+item_name+'</td><td>'+quantity+'</td><td>'+total_amount+'</td><td>'+order_date+'</td><td>'+status+'</td></tr>';
            }
            $('#table_body').html(html);
         }else{
            html = '<tr><td  colspan="9">No Data Found</td></tr>';
            $('#table_body').html(html);
        }
      }
      });

      
   }
    


   

    
</script>