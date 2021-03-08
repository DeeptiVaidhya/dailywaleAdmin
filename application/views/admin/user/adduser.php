<!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Add User</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo site_url('welcome/dashboard');?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                               
                                <li class="active">Add User</li>
                            </ol>
                        </div>
                    </div>
						<div class="row">
							<div class="col-sm-12">
								<div class="card-box">
									<div class="card-head">
										<header>User Information</header>

								 <?php echo $this->session->flashdata('User');?>		
				                       
									</div>
									<form action="<?php echo site_url('User/addUser');?>" method="post" id="login"
									enctype="multipart/form-data" onsubmit="return validation();" >
									<div class="card-body row">
							            <div class="col-lg-4 p-t-20"> 
							              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
						                     <input class = "mdl-textfield__input" type = "text" id = "freename" name="fname" style="text-transform: capitalize;">
						                     <label class = "mdl-textfield__label" >First Name</label>
						                      <span class="intro" id="errorname"></span>
						               </div>
							      </div>
                          <div class="col-lg-4 p-t-20"> 
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                 <input class = "mdl-textfield__input" type = "text" id = "freename" name="lname" style="text-transform: capitalize;">
                                 <label class = "mdl-textfield__label" >Last Name</label>
                                  <span class="intro" id="errorname"></span>
                              </div>
                          </div>

							             <div class="col-lg-4 p-t-20"> 
							              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
						                     <input class = "mdl-textfield__input" type = "text" id = "email" name="email">
						                     <label class = "mdl-textfield__label" >Email</label>
						                  <span class="intro" id="erroremail"></span>
						                  </div>
							            </div>
                          <div class="col-lg-4 p-t-20"> 
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                 <input class = "mdl-textfield__input" type="email" id="email" name="pwd">
                                 <label class = "mdl-textfield__label" >Password</label>
                              <span class="intro" id="erroremail"></span>
                              </div>
                          </div>
                          <div class="col-lg-4 p-t-20">
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                 <input class="mdl-textfield__input" type="number"  id = "name" name="user_mobile" title="10 digit mobile number"  maxlength="10"  id = "name" name="user_mobile" >
                                 <label class = "mdl-textfield__label">mobile no.</label>
                                  <span class="intro" id="errorname"></span>
                              </div>
                          </div>

  <!--                         <div class="col-lg-6 p-t-20"> 
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
                          </div>
                         <div class="col-lg-6 p-t-20"> 
                           <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                              <input class = "mdl-textfield__input" type = "text" name="dob" id = "dob" >
                              <label class = "mdl-textfield__label" >Birth Date</label>
                               <span class="intro" id="errordob"></span>
                            </div>
                          </div> -->
                          <div class="col-lg-4 p-t-20"> 
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                    <select class = "mdl-textfield__input" id="selectState" name="state_name" style="text-transform: capitalize;">
                                      <option value="" selected disabled> Select State</option>
                                       <?php foreach ($state as $key) {?>
                                        <option  value="<?php echo $key['state_id'];?>" ><?php echo $key['state_name']?></option>
                                        <?php }?>
                                    </select>
                                    <label class = "mdl-textfield__label" >State Name</label>
                                    <span class="intro" id="errorname"></span>
                            </div>
                          </div> 
                          <div class="col-lg-4 p-t-20"> 
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                 <select class = "mdl-textfield__input" id="selectCity" name="city_name" style="text-transform: capitalize;">
                                   <option value="" selected>Selcet City</option> 
                                   <!-- <?php// foreach ($city as $c) {
                                    // if($c['city_id'] == $records->city_id){?>
                                    <option  value="<?php // echo $c['city_id'];?>" selected><?php // echo $c['city_name'];?></option> 
                                   <?php // } } ?> -->
                                     
                                 </select>
                                 <label class = "mdl-textfield__label" >City Name</label>
                                  <span class="intro" id="errorname"></span>
                              </div>
                          </div> 
                          <div class="col-lg-4 p-t-20"> 
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                  <select class = "mdl-textfield__input selectZone" id="selectZone" name="zone_name" style="text-transform: capitalize;">
                                    <option value="" selected >Selcet Zone</option> 
                                 </select>
                                 <label class = "mdl-textfield__label" >Zone Name</label>
                                  <span class="intro" id="errorname"></span>
                              </div>
                          </div>    
                          <div class="col-lg-4 p-t-20"> 
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                  <select class = "mdl-textfield__input" id="selectSubzone" name="subzone_name" style="text-transform: capitalize;">
                                  <option value="" selected >Selcet Subzone</option>
                                 <!--  <?php //foreach ($subzone as $s) {
                                     //if($s['subzone_id'] == $records->subzone_id){?>
                                    <option  value="<?php// echo $s['subzone_id'];?>" selected><?php //echo $s['subzone_name'];?></option> 
                                   <?php// } } ?> -->
                                 </select>
                                 <label class = "mdl-textfield__label" >SubZone Name</label>
                                  <span class="intro" id="errorname"></span>
                              </div>
                          </div>

                          <div class="col-lg-4 p-t-20">
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                 <input class = "mdl-textfield__input" type = "number" id = "name" name="pincode"  style="text-transform: capitalize;">
                                 <label class = "mdl-textfield__label">Pincode</label>
                                  <span class="intro" id="errorpincode"></span>
                              </div>
                          </div>

                          <div class="col-lg-4 p-t-20">
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                 <input class = "mdl-textfield__input" type = "text" id = "address" maxlength="30" name="address"  style="text-transform: capitalize;">
                                 <label class = "mdl-textfield__label">Address</label>
                                  <span class="intro" id="erroraddress"></span>
                              </div>
                          </div>
                            
                          <!-- <div class="col-lg-4 p-t-20"> 
                           <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                              <input class = "mdl-textfield__input" type = "text" name="wallet_amount" id = "wallet_amount" >
                              <label class = "mdl-textfield__label" >wallet amount</label>
                               <span class="intro" id="errordob"></span>
                            </div>
                          </div> -->
							            
								         <div class="col-lg-12 p-t-20 text-center"> 
							              	<button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-primary">Submit</button>
											
							            </div>


									</div>
                 </form>

								</div>
							</div>
						</div> 
         </div>
       </div>
            <!-- end page content -->
        <script>
   function validation(){ 

   var freename =document.getElementById('freename').value;
   if(freename.length==""){
   
   document.getElementById('errorname').innerHTML = "Please Enter Name!";
   return false;
   }
 
   var email =document.getElementById('email').value;
   if(email.length==""){
   
   document.getElementById('erroremail').innerHTML = "Please Enter Email!";
   return false;
   }

    var email=/^\w+[\+\.\w-]*@([\w-]+\.)*\w+[\w-]*\.([a-z]{2,4}|\d+)$/i
   var email=email.test(document.getElementById("email").value);
   if(email==false)
   {
   
   document.getElementById('erroremail').innerHTML = "Please Enter valid Email id !";
   return false;
   }

   var ej = document.getElementById("gender");
   var strUserqwe = ej.options[ej.selectedIndex].value;
   var strUser1123 = ej.options[ej.selectedIndex].text;
   if(strUserqwe==0)
   {
   
   document.getElementById('errorgender').innerHTML = "Please Select Gender Type!";
   return false;
   }

   var add =document.getElementById('linkedin_id').value;
   if(add.length==""){
   
   document.getElementById('errorLink').innerHTML = "Please Enter Linkedin Id!";
   return false;
   }



}
 </script>
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
                selectZoneData(); 
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

    
    function selectZoneData() {
        var cityId = $('#selectCity').val();
        console.log(cityId);
        if(cityId){
            $.ajax ({
                type: 'GET',
                url: '<?php echo base_url(); ?>index.php/User/getzone/'+cityId,
                success: function(data){
                getselectZone();  
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
    }


    //$("#selectZone").on('change', function() {
    function getselectZone(){
        var zoneId = $('#selectZone').val();
        alert(zoneId);
        console.log(zoneId);
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
    }
});
</script>