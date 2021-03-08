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
      <div class="row">
         <div class="col-md-12">
            <div class="tabbable-line">
               </ul>
               <div class="row">
                  <div class="col-md-12">
                     <div class="card card-box">
                        <div class="card-head">
                           <header>Report</header>
                        </div>
                        <div class="card-body ">
                           <div class="row">
                              <div class="card-body ">
                                <div class="col-md-12 row" style="float:left;">
                                  <div>
                                  	
                                  	<table style="width:100%">
									  <tr>
									    <td>
									    	<div class="col-lg-12">
		                                       <div class="col-lg-12" style="text-align: center;"><label>State</label></div>
		                                        <div class="col-lg-12">
		                                          <div class="form-control-wrapper">
		                                          	<select class="form-control" name="state" id="state">
		                                          		<option value="" selected disabled>-- Select State --</option>
		                                          		<?php foreach ($state as $s) {?>
		                                          		<option value="<?php echo $s['state_id']; ?>" ><?php echo $s['state_name']; ?></option> 	
		                                          		<?php } ?>
		                                          	</select>   
		                                          </div>
		                                       </div>
		                                   </div>
                               			</td>
                               			<td>
                               				<h3><b>OR</b></h3>
                               			</td>	
									    <td>
									    	<div class="col-lg-12">
			                                    <div class="col-lg-12" style="text-align: center;"><label>City</label></div>
			                                       <div class="col-lg-12">
			                                          <div class="form-control-wrapper">
			                                          	<select class="form-control" name="city" id="city">
			                                          		<option value="" selected disabled >-- Select City --</option>
			                                          		<?php foreach ($city as $c) {?>
			                                          		<option value="<?php echo $c['city_id']; ?>" ><?php echo $c['city_name']; ?></option> 	
			                                          		<?php } ?>
			                                          	</select>   
			                                        </div>
			                                    </div>
			                                </div>
									    </td> 
									    <td>
                               				<h3><b>OR</b></h3>
                               			</td>
									    <td>
									    	<div class="col-lg-12">
		                                    <div class="col-lg-12" style="text-align: center;"><label>Zone</label></div>
		                                       <div class="col-lg-12">
		                                          <div class="form-control-wrapper">
		                                          	<select class="form-control" name="zone" id="zone">
		                                          		<option value="" selected disabled >-- Select Zone --</option>
		                                          		<?php foreach ($zone as $z) {?>
		                                          		<option value="<?php echo $z['zone_id']; ?>" ><?php echo $z['zone_name']; ?></option> 	
		                                          		<?php } ?>
		                                          	</select>   
		                                          </div>
		                                       </div>
		                                   </div>
									    </td>
									    <td>
                               				<h3><b>OR</b></h3>
                               			</td>
									    <td>
									    	<div class="col-lg-12">
		                                    <div class="col-lg-12" style="text-align: center;"><label>Subzone</label></div>
		                                       <div class="col-lg-12">
		                                          <div class="form-control-wrapper">
		                                          	<select class="form-control" name="subzone" id="subzone">
		                                          		<option value="" selected disabled >-- Select Subzone --</option>
		                                          		<?php foreach ($subzone as $sz) {?>
		                                          		<option value="<?php echo $sz['subzone_id']; ?>" ><?php echo $sz['subzone_name']; ?></option> 	
		                                          		<?php } ?>
		                                          	</select>   
		                                          </div>
		                                       </div>
		                                   </div>
									    </td>
									    <td>
                               				<h3><b>OR</b></h3>
                               			</td>
									    <td>
									    	<div class="col-lg-12">
		                                    <div class="col-lg-12" style="text-align: center;"><label>Choose Date</label></div>
		                                       <div class="col-lg-12">
		                                          <div class="form-control-wrapper">
														<input type="text" id="daterange" class="form-control" name="datefilter" />
														<input type="hidden" id="select_date" class="form-control" name="select_date" />   
		                                          </div>
		                                       </div>
		                                   </div>
									    </td>
									  </tr>
								
									</table>

								   <center>	
	                                   <div class="col-lg-12 p-t-20" style="float: left;">
	                                     <div class="form-control-wrapper">
	                                       <button type="submit" onclick="getResult();" class="btn btn-danger btn-lg" id="search" name="search">Search</button>    
	                                     </div>
	                                   </div>
                                   </center>
                                   
                                  </div>
                                </div> 
                              </div>


                         

                              <div class="table-scrollable" >
                                 <table class="table table-striped table-bordered table-hover table-checkable order-column valign-middle" id="order_detail_table">
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
<?php
       $this->load->view('admin/assets/footer');
?>
<script type="text/javascript">
$(function() {

  $('input[name="datefilter"]').daterangepicker({
      autoUpdateInput: false,
      locale: {
          cancelLabel: 'Clear'
      }
  });

  $('input[name="datefilter"]').on('apply.daterangepicker', function(ev, picker) {
  	//console.log(picker.startDate._d, 'date');
      var dates = $(this).val(picker.startDate.format('YYYY/MM/DD') + ' - ' + picker.endDate.format('YYYY/MM/DD'));
      var check_date = dates[0].value;
     // console.log(check_date);
      $('#select_date').val(check_date);
      // alert($(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY')));
  });

  $('input[name="datefilter"]').on('cancel.daterangepicker', function(ev, picker) {
      $(this).val('');
  });

});




    function getResult(){

      //alert(check_date);
      var state     = document.getElementById('state').value;
      var city      = document.getElementById('city').value;
      var zone      = document.getElementById('zone').value;
      var subzone   = document.getElementById('subzone').value;
      var datefilter= document.getElementById('select_date').value;;

      $.ajax({
        type: "GET",
        url: "<?php echo base_url('index.php/Report/Search');?>/?state="+state+"&city="+city+"&zone="+zone+"&subzone="+subzone+"&datefilter="+datefilter,
      success: function(data){
      	//alert(data);
         var obj = JSON.parse(data);
         if(obj.length>0){
            var html = '';
            
            for(var i=0;i<obj.length;i++){
	               var name          = obj[i]['fname'];
	               var lname         = obj[i]['lname'];
	               var email         = obj[i]['email'];
	               var mobile        = obj[i]['user_mobile'];

	               html += '<tr><td colspan="6" style="font-weight:bold;font-size:20px;;">Name : '+name+' '+lname+'</td></tr><tr><th>S.No.</th><th>Item Name</th><th>Quantity</th><th>Price</th><th>Total Price</th><th>Date</th></tr>';
	            

	             var cartarray = obj[i].cartData;
	             // console.log(cartarray);
	              var jj=0;
	              for(var k=0;k<cartarray.length;k++){
	              	var cart_id     = cartarray[k]['cart_id'];
	                var item_name   = cartarray[k]['item_name'];
	                var quanity     = cartarray[k]['quanity'];
	                var item_price  = cartarray[k]['price'];
	                var total_price = cartarray[k]['total_price'];
	                var date_time   = cartarray[k]['date_time']; 
	                jj = ++jj;
	                html += '<tr><td>'+jj+'</td><td>'+item_name+'</td><td>'+quanity+'</td><td>'+item_price+'</td><td>'+total_price+'</td><td>'+date_time+'</td></tr>';
	            } 
	        }
            $('#table_body').html(html);
         }else{
            html = '<tr><td  colspan="11">No Data Found</td></tr>';
            $('#table_body').html(html);
        }
      }
      });
   }
  getResult();
</script>



