start page content -->
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Add Service_provider</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo site_url('welcome/dashboard');?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                               
                                <li class="active">Add Service Provider</li>
                            </ol>
                        </div>
                    </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="card-box">
                  <div class="card-head">
                    <header>Service Provider Information</header>

                 <?php echo $this->session->flashdata('Service_provider');?>    
                               
                  </div>
                <form action="<?php echo site_url('Vendor/add_services');?>" method="post">
                 
                       <!-- <div class="col-lg-6 p-t-20"> 
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                 <select class = "mdl-textfield__input" id = "freename" name="name" style="text-transform: capitalize;">
                                  <?php 
                                
                                  foreach ($vendor as $key) { ?>
                                    <option value="<?php echo $key['id'];?>"><?php echo $key['name'];?></option>
                                  <?php }
                                  ?>
                                 </select>
                                 <label class = "mdl-textfield__label" >Vendor</label>
                                  <span class="intro" id="errorname"></span>
                              </div>
                          </div>  -->
                           <div class="col-lg-6 p-t-20"> 
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                 <select class = "mdl-textfield__input" id = "freename" name="item_name" style="text-transform: capitalize;">
                                  <?php 
                                
                                  foreach ($item as $key) { ?>
                                    <option value="<?php echo $key['item_id'];?>"><?php echo $key['item_name'];?></option>
                                  <?php }
                                  ?>
                                 </select>
                                 <label class = "mdl-textfield__label" >Services provider</label>
                                  <span class="intro" id="errorname"></span>
                              </div>
                          </div> 
                         <div  class="col-lg-6 p-t-20"> 
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                 <input class = "mdl-textfield__input" type = "text" id = "title" name="title" style="text-transform: capitalize;">
                                 <label class = "mdl-textfield__label" >Tittle</label>
                                  <span class="intro" id="errorStatename"></span>
                              </div>
                          </div>
                            <div  class="col-lg-6 p-t-20"> 
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                 <input class = "mdl-textfield__input" type = "text" id = "description" name="description" style="text-transform: capitalize;">
                                 <label class = "mdl-textfield__label" >Description</label>
                                  <span class="intro" id="errorStatename"></span>
                              </div>
                          </div>
                            <div  class="col-lg-6 p-t-20"> 
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                 <input class = "mdl-textfield__input" type = "text" id = "pre_booking_price" name="pre_booking_price" style="text-transform: capitalize;">
                                 <label class = "mdl-textfield__label" >pre_booking_price</label>
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
 </script>