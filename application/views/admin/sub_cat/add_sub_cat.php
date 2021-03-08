<!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Add Sub_Category</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo site_url('welcome/dashboard');?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                               
                                <li class="active">Add Sub_Category</li>
                            </ol>
                        </div>
                    </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="card-box">
                  <div class="card-head">
                    <header>Sub_Category Information</header>

                 <?php echo $this->session->flashdata('Sub_cat');?>    
                               
                  </div>
                <form action="<?php echo site_url('Sub_cat/add_sub_cat');?>" method="post" enctype="multipart/form-data" onsubmit="return validation();" >
                  <div class="card-body row">
                           <div class="col-lg-6 p-t-20"> 
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                 <select class = "mdl-textfield__input" id = "freename" name="cat_name" style="text-transform: capitalize;">
                                  <?php 
                                
                                  foreach ($cat as $key) { ?>
                                    <option value="<?php echo $key['cat_id'];?>"><?php echo $key['cat_name'];?></option>
                                  <?php }
                                  ?>
                                 </select>
                                 <label class = "mdl-textfield__label" >cat Name</label>
                                  <span class="intro" id="errorname"></span>
                              </div>
                          </div> 
                          <div class="col-lg-6 p-t-20"> 
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                 <input class = "mdl-textfield__input" type = "text" id = "sub_cat_name" name="sub_cat_name" style="text-transform: capitalize;">
                                 <label class = "mdl-textfield__label" >Sub_cat Name</label>
                                  <span class="intro" id="errorStatename"></span>
                              </div>
                          </div>

                           <div class="col-lg-6 p-t-20"> 
                           <label class = "mdl-textfield__label" style="margin-left: 14px;" >icon</label>
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">

                                 <input class = "mdl-textfield__input" type = "file" name="picture" id = "profile" accept="image/gif, image/jpeg, image/jpg, image/png" >
                          
                                   <span class="intro" id="errorprofile"></span>
                              </div>
                          </div>
                          <div  class="col-lg-6 p-t-20"> 
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">

                                <select class = "mdl-textfield__input" id ="freename" name="is_status" style="text-transform: capitalize;">
                                  <option value="" >Select Status</option>
                                 <option value="Online">Online</option>
                                 <option value="Offline">Offline</option>
                                 </select>
                                 <label class = "mdl-textfield__label" >Status</label>
                                  <span class="intro" id="errorStatename"></span>
                              </div>
                          </div>

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
   
   document.getElementById('errorname').innerHTML = "Please Enter Company Name!";
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

  
   var add =document.getElementById('Estabilish date').value;
   if(add.length==""){
   
   document.getElementById('errorLink').innerHTML = "Please Enter Estabilish date!";
   return false;
   }

}
 </script> -->