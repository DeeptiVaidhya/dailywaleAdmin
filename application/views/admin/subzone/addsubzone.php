<!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Add Subzone</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo site_url('welcome/dashboard');?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                               
                                <li class="active">Add Subzone</li>
                            </ol>
                        </div>
                    </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="card-box">
                  <div class="card-head">
                    <header>Subzone Information</header>

                 <?php echo $this->session->flashdata('Subzone');?>    
                               
                  </div>
                <form action="<?php echo site_url('Subzone/addSubzone');?>" method="post" >
                  <div class="card-body row">
                          <div class="col-lg-4 p-t-20"> 
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                 <select class = "mdl-textfield__input" id = "freename" name="zone_name" style="text-transform: capitalize;">
                                  <?php 
                                  foreach ($zone as $key) { ?>
                                    <option value="<?php echo $key['zone_id'];?>"><?php echo $key['zone_name'];?></option>
                                  <?php }
                                  ?>
                                 </select>
                                 <label class = "mdl-textfield__label" >zone Name</label>
                                  <span class="intro" id="errorname"></span>
                              </div>
                          </div>
                          <div class="col-lg-4 p-t-20"> 
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                 <input class = "mdl-textfield__input" type = "text" id = "subzonename" name="subzone_name" style="text-transform: capitalize;">
                                 <label class = "mdl-textfield__label" >Subzone Name</label>
                                  <span class="intro" id="errorStatename"></span>
                              </div>
                          </div>
                           <div  class="col-lg-4 p-t-20"> 
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