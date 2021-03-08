  <!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Edit City details</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo site_url('welcome/dashboard');?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                               
                                <li class="active">Edit City details</li>
                            </ol>
                        </div>
                    </div>
						<div class="row">
							<div class="col-sm-12">
								<div class="card-box">
									<div class="card-head">
										<header>City Information</header>
										
				                       
									</div>
                  <?php echo $this->session->flashdata('city');?>
									<?php 
                  // print_r($records);exit; 
                  // foreach ($records as $row) { 
                    // print_r($row);exit;
                    ?>

                  <form action="<?php echo site_url('City/cityEdit');?>" method="post" onsubmit="return validation();" enctype="multipart/form-data">

									<div class="card-body row">
                        <div class="col-lg-6 p-t-20"> 
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                 <select class = "mdl-textfield__input" id = "freename" name="state_name" style="text-transform: capitalize;">
                                  <?php 
                                  $sid = $records->state_id;
                                  foreach ($state as $key) { ?>
                                    <option <?php if($key['state_id']==$sid){ echo'selected'; } ?> value="<?php echo $key['state_id'];?>"><?php echo $key['state_name'];?></option>
                                  <?php }
                                  ?>
                                 </select>
                                 <label class = "mdl-textfield__label" >State Name</label>
                                  <span class="intro" id="errorname"></span>
                              </div>
                          </div>   

							            <div class="col-lg-6 p-t-20">
							             <input class = "mdl-textfield__input" type = "hidden" id = "Name" name="id" value="<?php echo $records->city_id;?>">
 
							              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
						                     <input class = "mdl-textfield__input" type = "text" id = "name" name="city_name" value="<?php echo $records->city_name;?>" style="text-transform: capitalize;">
						                     <label class = "mdl-textfield__label">city name</label>
						                      <span class="intro" id="errorname"></span>
						                  </div>
							            </div>

                           

							                  
                
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
            <!-- end page content -->
 <!-- <script>
   function validation(){ 

   var freename =document.getElementById('name').value;
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
        </script> -->