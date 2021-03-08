<!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Add Popular Service</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo site_url('welcome/dashboard');?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                               
                                <li class="active">Add Popular Service</li>
                            </ol>
                        </div>
                    </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="card-box">
                  <div class="card-head">
                    <header>Popular Service Information</header>

                 <?php echo $this->session->flashdata('pop_service');?>    
                               
                  </div>
                <form action="<?php echo site_url('Pop_services/add_pop_services');?>" method="post" >
                  <div class="card-body row">
                          <div class="col-lg-6 p-t-20"> 
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                 <select class = "mdl-textfield__input" id = "freename" name="service_id" style="text-transform: capitalize;" required="">
                                   <option value="" selected disabled>select service</option>
                                  <?php 
                                  foreach ($service_id as $key) { ?>
                                    <option value="<?php echo $key['service_id'];?>"><?php echo $key['title'];?></option>
                                  <?php }
                                  ?>
                                 </select>
                                 <label class = "mdl-textfield__label" >Service Id</label>
                                  <span class="intro" id="errorname"></span>
                              </div>
                          </div>
                          <div class="col-lg-6 p-t-20"> 
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                 <input class = "mdl-textfield__input" type = "date" id = "valid_date" name="valid_date" style="text-transform: capitalize;" required="">
                                 <label class = "mdl-textfield__label" >Valid date</label>
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