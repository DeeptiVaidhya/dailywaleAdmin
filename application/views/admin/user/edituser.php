<!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Edit User details</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo site_url('welcome/dashboard');?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Edit User details</li>
                            </ol>
                        </div>
                    </div>
						<div class="row">
							<div class="col-sm-12">
								<div class="card-box">
									<div class="card-head">
										<header>User Information</header>
									</div>
                  <?php echo $this->session->flashdata('User');?>
                  <form action="<?php echo site_url('User/userEdit');?>" method="post" onsubmit="return validation();" enctype="multipart/form-data">
                    <input class = "mdl-textfield__input" type = "hidden" id = "Name" name="id" value="<?php echo $records->user_id;?>">
                  <div class="card-body row">
                       <div class="col-lg-4 p-t-20">
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                 <input class = "mdl-textfield__input" type = "text" id = "name" name="fname" value="<?php echo $records->fname;?>" style="text-transform: capitalize;">
                                 <label class = "mdl-textfield__label">first name</label>
                                  <span class="intro" id="errorname"></span>
                              </div>
                          </div>
                          <div class="col-lg-4 p-t-20">
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                 <input class = "mdl-textfield__input" type = "text" id = "name" name="lname" value="<?php echo $records->lname;?>" style="text-transform: capitalize;">
                                 <label class = "mdl-textfield__label">last name</label>
                                  <span class="intro" id="errorname"></span>
                              </div>
                          </div>
                          <div class="col-lg-4 p-t-20">
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                 <input class = "mdl-textfield__input" type = "email" id = "name" name="email" value="<?php echo $records->email;?>" style="text-transform: capitalize;">
                                 <label class = "mdl-textfield__label">Email</label>
                                  <span class="intro" id="errorname"></span>
                              </div>
                          </div>
                          <div class="col-lg-4 p-t-20">
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                 <input class = "mdl-textfield__input" type = "text" id = "name" name="pwd" value="<?php echo $records->pwd;?>" style="text-transform: capitalize;">
                                 <label class = "mdl-textfield__label">password</label>
                                  <span class="intro" id="errorname"></span>
                              </div>
                          </div>
                          <div class="col-lg-4 p-t-20">
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                 <input class = "mdl-textfield__input" type="number" minlength="10" maxlength="10" id = "name" name="user_mobile" title="10 digit mobile number"  id = "name" name="user_mobile" value="<?php echo $records->user_mobile;?>" style="text-transform: capitalize;">
                                 <label class = "mdl-textfield__label">mobile no.</label>
                                  <span class="intro" id="errorname"></span>
                              </div>
                          </div>
                          <!-- <div class="col-lg-4 p-t-20"> 
                           <label for="sample2" class="mdl-textfield__label" style="margin-left: 20px;">Gender</label>
                             <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height txt-full-width">
                                               
                              <div class="col-md-12">
                                <select class="form-control input-height" name="gender" style="margin-left: -15px;width: 106%;border: none;border-bottom: 1px solid rgba(0,0,0,.12);" id="gender">
                                      <option value="0" >Select Gender</option>
                                      <option value="Male">Male</option>
                                      <option value="Female">Female</option>
                                  </select>
                                     <span class="intro" id="errorgender"></span>
                              </div>
                            </div>
                          </div> -->
                           <!-- <div class="col-lg-4 p-t-20">
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                 <input class = "mdl-textfield__input" type = "text" id = "name" name="dob" value="<?php echo $records->dob;?>" style="text-transform: capitalize;">
                                 <label class = "mdl-textfield__label">dob</label>
                                  <span class="intro" id="errorname"></span>
                              </div>
                          </div> --> 
                         <div class="col-lg-4 p-t-20"> 
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                        <select class = "mdl-textfield__input" id="selectState" name="state_name" style="text-transform: capitalize;">
                                   
                                          <option value="" selected disabled> Select State</option>
                                           <?php
                                        $data = $this->Model->select('state', 'state_id');
                                        foreach ($data as $key) {?>
                                       
                                        <option  value="<?php echo $key['state_id'];?>" <?php if($key['state_id']==$records->state_id) echo 'selected="selected" '?>><?php echo $key['state_name']?></option>
                                        <?php }?>
                                        </select>
                                 <label class = "mdl-textfield__label" >State Name</label>
                                  <span class="intro" id="errorname"></span>
                              </div>
                          </div> 
                           <div class="col-lg-4 p-t-20"> 
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                 <select class = "mdl-textfield__input" id="selectCity" name="city_name" style="text-transform: capitalize;">
                                   <!--  <option value="" disabled>Selcet City</option> -->
                                   <?php foreach ($city as $c) {
                                     if($c['city_id'] == $records->city_id){?>
                                    <option  value="<?php echo $c['city_id'];?>" selected><?php echo $c['city_name'];?></option> 
                                   <?php } } ?>
                                     
                                 </select>
                                 <label class = "mdl-textfield__label" >City Name</label>
                                  <span class="intro" id="errorname"></span>
                              </div>
                          </div> 
                          <div class="col-lg-4 p-t-20"> 
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                  <select class = "mdl-textfield__input selectZone" id="selectZone" name="zone_name" style="text-transform: capitalize;">
                                    <!-- <option value="" selected disabled>Selcet Zone</option> -->
                                    <?php foreach ($zone as $z) {
                                     if($z['zone_id'] == $records->zone_id){?>
                                    <option  value="<?php echo $z['zone_id'];?>" selected><?php echo $z['zone_name'];?></option> 
                                   <?php } } ?>
                                 </select>
                                 <label class = "mdl-textfield__label" >Zone Name</label>
                                  <span class="intro" id="errorname"></span>
                              </div>
                          </div>    
                          <div class="col-lg-4 p-t-20"> 
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                  <select class = "mdl-textfield__input" id="selectSubzone" name="subzone_name" style="text-transform: capitalize;">
                                    <!-- <option value="" selected disabled>Selcet Subzone</option> -->
                                  <?php foreach ($subzone as $s) {
                                     if($s['subzone_id'] == $records->subzone_id){?>
                                    <option  value="<?php echo $s['subzone_id'];?>" selected><?php echo $s['subzone_name'];?></option> 
                                   <?php } } ?>
                                 </select>
                                 <label class = "mdl-textfield__label" >SubZone Name</label>
                                  <span class="intro" id="errorname"></span>
                              </div>
                          </div>   
                         
                       
                          
                          <div class="col-lg-4 p-t-20">
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                 <input class = "mdl-textfield__input" type = "number" id = "name" name="pincode" value="<?php echo $records->pincode;?>" style="text-transform: capitalize;">
                                 <label class = "mdl-textfield__label">Pincode</label>
                                  <span class="intro" id="errorpincode"></span>
                              </div>
                          </div>
                          <div class="col-lg-4 p-t-20">
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                 <input class = "mdl-textfield__input" type = "text" id = "address" maxlength="30" name="address" value="<?php echo $records->address;?>" style="text-transform: capitalize;">
                                 <label class = "mdl-textfield__label">Address</label>
                                  <span class="intro" id="erroraddress"></span>
                              </div>
                          </div>      
                         <!-- <div class="col-lg-4 p-t-20">
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                 <input class = "mdl-textfield__input" type = "text" id = "name" name="wallet_amount" readonly="" value="<?php echo $records->wallet_amount;?>" style="text-transform: capitalize;">
                                 <label class = "mdl-textfield__label">Wallet amount</label>
                                  <span class="intro" id="errorname"></span>
                              </div>
                          </div> -->
                           
								         <div class="col-lg-12 p-t-20 text-center"> 
							              	<button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-primary">Submit</button>
											
							            </div>
								    	</div>
                      </form>
                     <?php 
                   // } 
                   ?>
								</div>
							</div>
						</div> 
         </div>
       </div>
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script type="text/javascript">
$(document).ready(function()
 {
    $("#selectState").on('change', function() {
        var level = $(this).val();
        if(level){
            $.ajax ({                
                type: 'GET',
                url: '<?php echo base_url(); ?>index.php/User/getCity/'+level,
                success: function(data){
                var obj = JSON.parse(data); 
                  if(obj.length>0){
                    $("#selectCity option").remove();
                  for(var i=0; i<obj.length; i++){

                    $('#selectCity').append("<option value='"+obj[i].city_id+"' >"+obj[i].city_name+"</option>");
                  }
               }
              }
            });
        }
    });

    $("#selectCity").on('change', function() {
        var cityId = $(this).val();
        if(cityId){
            $.ajax ({
                type: 'GET',
                url: '<?php echo base_url(); ?>index.php/User/getzone/'+cityId,
                success: function(data){
                var obj = JSON.parse(data); 
                  if(obj.length>0){

                    $('#selectZone option').remove();
                  for(var i=0; i<obj.length; i++){

                    $('#selectZone').append("<option value='"+obj[i].zone_id+"' >"+obj[i].zone_name+"</option>");
                  }
               }
              }
            });
        }
    });


    $("#selectZone").on('change', function() {
        var zoneId = $(this).val();
        if(zoneId){
            $.ajax ({
                type: 'GET',
                url: '<?php echo base_url(); ?>index.php/User/getSubzone/'+zoneId,
                success: function(data){
                var obj = JSON.parse(data); 
                  if(obj.length>0){
                    $("#selectSubzone option").remove();
                  for(var i=0; i<obj.length; i++){

                    $('#selectSubzone').append("<option value='"+obj[i].subzone_id+"' >"+obj[i].subzone_name+"</option>");
                  }
               }
              }
            });
        }
    });
});
</script>


       