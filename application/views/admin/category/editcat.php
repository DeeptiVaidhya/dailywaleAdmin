<!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Edit Category details</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo site_url('welcome/dashboard');?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                               
                                <li class="active">Edit Category details</li>
                            </ol>
                        </div>
                    </div>
						<div class="row">
							<div class="col-sm-12">
								<div class="card-box">
									<div class="card-head">
										<header>Category Information</header>
										
				                       
									</div>
                  <?php echo $this->session->flashdata('category');?>
									<?php 
                  // print_r($records);exit; 
                  // foreach ($records as $row) { 
                    // print_r($row);exit;
                    ?>

                  <form action="<?php echo site_url('Category/categoryEdit');?>" method="post" onsubmit="return validation();" enctype="multipart/form-data">

									   

							            <div class="col-lg-6 p-t-20">
							             <input class = "mdl-textfield__input" type = "hidden" id = "Name" name="id" value="<?php echo $records->cat_id;?>">
 
							              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
						                     <input class = "mdl-textfield__input" type = "text" id = "name" name="cat_name" value="<?php echo $records->cat_name;?>" style="text-transform: capitalize;">
						                     <label class = "mdl-textfield__label">category name</label>
						                      <span class="intro" id="errorname"></span>
						                  </div>
							            </div>

                           <div class="col-lg-6 p-t-20"> 
                          <label class = "mdl-textfield__label" style="margin-left: 14px;" >icon</label>
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">         
                                 <input class = "mdl-textfield__input" type = "file" name="picture" id = "icon" value="<?php echo $records->icon;?>" accept="image/gif, image/jpeg, image/jpg, image/png">
                                  <span class="intro" id="errorprofile"></span>
                                 <a href="<?php echo base_url();?>uploads/user/<?php echo $records->icon;?>">
                            <img src="<?php echo base_url();?>uploads/user/<?php echo $records->icon;?>" alt="" style="height: 60px;width: 60px;margin-left:  200px;margin-top:  -63px;"></a>
                              </div>
                          </div>  

                     <div class="card-body row">
                       <div class="col-lg-6 p-t-20">
                           <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                              <select class = "mdl-textfield__input" name="type" value="<?php echo $records->type;?>" style="text-transform: capitalize;">
                                  
                                  <option value="<?php echo $records->type;?>">Select type</option>
                                  <option <?php if($records->type=='Service'){ echo'selected'; } ?> value="Service">Service</option>
                                  <option <?php if($records->type=='Subscription'){ echo'selected'; } ?> value="Subscription">Subscription</option>
                                </select>
                                
                                 <label class = "mdl-textfield__label">Type</label>
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