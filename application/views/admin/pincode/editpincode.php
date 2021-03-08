<!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Edit Pincode details</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo site_url('welcome/dashboard');?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                               
                                <li class="active">Edit Pincode details</li>
                            </ol>
                        </div>
                    </div>
						<div class="row">
							<div class="col-sm-12">
								<div class="card-box">
									<div class="card-head">
										<header>Pincode Information</header>
										
				                       
									</div>
                  <?php echo $this->session->flashdata('pincode');?>
									<?php 
                  // print_r($records);exit; 
                  // foreach ($records as $row) { 
                    // print_r($row);exit;
                    ?>
                  
                  <form action="<?php echo site_url('Pincode/pincode_Edit');?>" method="post" onsubmit="return validation();" enctype="multipart/form-data">
                     <input class = "mdl-textfield__input" type = "hidden" id = "Name" name="id" value="<?php echo $records->pincodeID;?>">
									<div class="card-body row">
                        <div class="col-lg-6 p-t-20"> 
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                 <select class = "mdl-textfield__input" id = "freename" name="sub_zone_id" style="text-transform: capitalize;">
                                  <?php 
                                  $sid = $records->sub_zone_id;
                                  foreach ($pincodeID as $key) { ?>
                                    <option <?php if($key['subzone_id']==$sid){ echo'selected'; } ?> value="<?php echo $key['subzone_id'];?>"><?php echo $key['subzone_name'];?></option>
                                  <?php }
                                  ?>
                                 </select>
                                 <label class = "mdl-textfield__label" >Subzone Name</label>
                                  <span class="intro" id="errorname"></span>
                              </div>
                          </div>   

							            <div class="col-lg-6 p-t-20">
							            
							              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
						                     <input class = "mdl-textfield__input" type = "text" id = "name" name="pincode_no" value="<?php echo $records->pincode_no;?>" style="text-transform: capitalize;">
						                     <label class = "mdl-textfield__label">Pincode No</label>
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