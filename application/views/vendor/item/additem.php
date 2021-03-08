<!-- start page content --> 
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Add Item</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo site_url('welcome/dashboard');?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                               
                                <li class="active">Add Item</li>
                            </ol>
                        </div>
                    </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="card-box">
                  <div class="card-head">
                    <header>Item Information</header>

                 <?php echo $this->session->flashdata('Vendor');?>    
                               
                  </div>
                <form action="<?php echo site_url('Vendor/add_item');?>" method="post" enctype="multipart/form-data" onsubmit="return validation();" >
                  <div class="card-body row">

                          <div class="col-lg-6 p-t-20"> 
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                 <input class = "mdl-textfield__input" type = "text" id = "item_name" name="item_name" style="text-transform: capitalize;">
                                 <label class = "mdl-textfield__label" >Item Name</label>
                                  <span class="intro" id="errorStatename"></span>
                              </div>
                          </div>
                         <!--   <div class="col-lg-6 p-t-20"> 
                            <div class = "mdl-textfield mdl-js-textfield                       mdl-textfield--floating-label txt-full-width">
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
                                 <select class = "mdl-textfield__input" id = "freename" name="sub_cat_name" style="text-transform: capitalize;">
                                  <?php 
                                
                                  foreach ($sub_cat as $key) { ?>
                                    <option value="<?php echo $key->sub_cat_id; ?>"><?php echo $key->cat_name." - ".$key->sub_cat_name; ?></option>
                                  <?php }
                                  ?>
                                 </select>
                                 <label class = "mdl-textfield__label" >Sub Category Name</label>
                                  <span class="intro" id="errorname"></span>
                              </div>
                          </div> 

                           <div class="col-lg-6 p-t-20"> 
                           <label class = "mdl-textfield__label" style="margin-left: 14px;" >item image</label>
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">

                                 <input class = "mdl-textfield__input" type = "file" name="picture" id = "profile" accept="image/gif, image/jpeg, image/jpg, image/png" >
                          
                                   <span class="intro" id="errorprofile"></span>
                              </div>
                          </div>

                           <div class="col-lg-6 p-t-20"> 
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                 <input class = "mdl-textfield__input" type = "text" id = "item_desc" name="item_desc" style="text-transform: capitalize;">
                                 <label class = "mdl-textfield__label" >Item description</label>
                                  <span class="intro" id="errorStatename"></span>
                              </div>
                          </div>

                          <div class="col-lg-6 p-t-20"> 
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                 <input class = "mdl-textfield__input" type = "text" id = "item_price" name="item_price" style="text-transform: capitalize;">
                                 <label class = "mdl-textfield__label" >Item price</label>
                                  <span class="intro" id="errorStatename"></span>
                              </div>
                          </div>

                           <div class="col-lg-6 p-t-20"> 
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                 <input class = "mdl-textfield__input" type = "text" id = "item_unit" name="item_unit" style="text-transform: capitalize;">
                                 <label class = "mdl-textfield__label" >Item unit</label>
                                  <span class="intro" id="errorStatename"></span>
                              </div>
                          </div>

                           <div class="col-lg-6 p-t-20"> 
                           <label for="sample2" class="mdl-textfield__label" style="margin-left: 20px;">is_out_of_stock</label>
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height txt-full-width">
                                               
                              <div class="col-md-12">
                                
                                  <input type="radio" name="is_out_of_stock" value="in_stock">in_stock&nbsp;<input type="radio" name="is_out_of_stock" value="out_stock">out_stock
                                     
                                  
                                     <span class="intro" id="errorgender"></span>
                              </div>
                            </div>
                           </div>
                            <div class="col-lg-6 p-t-20"> 
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                 <input class = "mdl-textfield__input" type = "text" id = "tax" name="tax" style="text-transform: capitalize;">
                                 <label class = "mdl-textfield__label" >Tax</label>
                                  <span class="intro" id="errorStatename"></span>
                              </div>
                          </div>


                           <div class="col-lg-6 p-t-20"> 
                           <label for="sample2" class="mdl-textfield__label" style="margin-left: 20px;">Is Online</label>
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height txt-full-width">
                                               
                              <div class="col-md-12">
                               <input type="radio" name="is_online" value="yes">yes&nbsp;<input type="radio" name="is_online" value="no">no
                                <span class="intro" id="errorgender"></span>
                              </div>
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