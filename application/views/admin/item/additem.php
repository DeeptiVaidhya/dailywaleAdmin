<!-- start page content  -->
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

                 <?php echo $this->session->flashdata('Item');?>    
                               
                  </div>
                <form action="<?php echo site_url('Item/add_item');?>" method="post" enctype="multipart/form-data" onsubmit="return validation();" >
                  <div class="card-body row">

                          <div class="col-lg-6 p-t-20"> 
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                              <?php if(isset($records)){ ?>
                                 <input class = "mdl-textfield__input" type = "text" id = "name" name="item_name" value="<?php echo $records->item_name;?>" style="text-transform: capitalize;">
                                 <?php }else{ ?>

                                 <input class = "mdl-textfield__input" type = "text" id = "item_name" name="item_name" style="text-transform: capitalize;">
                                 <?php } ?>
                                 <label class = "mdl-textfield__label" >Item Name</label>
                                  <span class="intro" id="errorStatename"></span>
                              </div>
                          </div>
                           <div class="col-lg-6 p-t-20"> 
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                              <?php if(isset($records)){ ?>
                                <select class = "mdl-textfield__input" id = "freename" name="name" style="text-transform: capitalize;">
                                  <?php 
                                  $vid = $records->vendor_id;
                                  foreach ($vendor as $key) { ?>
                                    <option <?php if($key['id']==$vid){ echo'selected'; } ?> value="<?php echo $key['id'];?>"><?php echo $key['name'];?></option>
                                  <?php }
                                  ?>
                                 </select>
                              <?php }else{ ?>



                                 <select class = "mdl-textfield__input" id = "freename" name="name" style="text-transform: capitalize;">
                                  <?php 
                                
                                  foreach ($vendor as $key) { ?>
                                    <option value="<?php echo $key['id'];?>"><?php echo $key['name'];?></option>
                                  <?php }
                                  ?>
                                 </select>
                              <?php } ?>
                                 <label class = "mdl-textfield__label" >Vendor</label>
                                  <span class="intro" id="errorname"></span>
                              </div>
                          </div> 

                           <div class="col-lg-6 p-t-20"> 
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                              <?php if(isset($records)){ ?>
                                <select class = "mdl-textfield__input" id = "freename" name="sub_cat_name" style="text-transform: capitalize;">
                                  <?php 
                                  $iid = $records->sub_cat_id;
                                  foreach ($sub_cat as $key) { ?>
                                    <option <?php if($key->sub_cat_id==$iid){ echo'selected'; } ?> value="<?php echo $key->sub_cat_id; ?>"><?php echo $key->cat_name." - ".$key->sub_cat_name;?></option>
                                  <?php }
                                  ?>
                                 </select>
                              <?php }else{ ?>


                                 <select class = "mdl-textfield__input" id = "freename" name="sub_cat_name" style="text-transform: capitalize;">
                                  <?php 
                                
                                  foreach ($sub_cat as $key) { ?>
                                    <option value="<?php echo $key->sub_cat_id; ?>"><?php echo $key->cat_name." - ".$key->sub_cat_name; ?></option>
                                  <?php }
                                  ?>
                                 </select>
                              <?php } ?>

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
                              <?php if(isset($records)){ ?>
                                 <input class = "mdl-textfield__input" type = "text" id = "item_desc" name="item_desc" value="<?php echo $records->item_desc;?>" style="text-transform: capitalize;">
                              <?php }else{ ?>

                                 <input class = "mdl-textfield__input" type = "text" id = "item_desc" name="item_desc" style="text-transform: capitalize;">
                                <?php } ?>

                                 <label class = "mdl-textfield__label" >Item description</label>
                                  <span class="intro" id="errorStatename"></span>
                              </div>
                          </div>

                          <div class="col-lg-6 p-t-20"> 
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                              <?php if(isset($records)){ ?>
                                <input class = "mdl-textfield__input" type = "text" id = "item_quantity_desc" name="item_quantity_desc" value="<?php echo $records->item_quantity_desc;?>" style="text-transform: capitalize;">
                              <?php }else{ ?>
                                 <input class = "mdl-textfield__input" type = "text" id = "item_quantity_desc" name="item_quantity_desc" style="text-transform: capitalize;">
                              <?php } ?>  
                                 <label class = "mdl-textfield__label" >Quantity description</label>
                                  <span class="intro" id="errorStatename"></span>
                              </div>
                          </div>

                          <div class="col-lg-6 p-t-20"> 
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                              <?php if(isset($records)){ ?>
                                <input class = "mdl-textfield__input" type = "text" id = "item_price" name="item_price" value="<?php echo $records->item_price;?>" style="text-transform: capitalize;">
                              <?php }else{ ?>

                                 <input class = "mdl-textfield__input" type = "text" id = "item_price" name="item_price" style="text-transform: capitalize;">
                              <?php } ?> 
                                 <label class = "mdl-textfield__label" >Item price</label>
                                  <span class="intro" id="errorStatename"></span>
                            </div>
                          </div>
                          <div class="col-lg-6 p-t-20"> 
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                            <?php if(isset($records)){ ?>
                              <input class = "mdl-textfield__input" type = "text" id = "item_discount" name="item_discount" value="<?php echo $records->item_discount;?>" style="text-transform: capitalize;">
                            <?php }else{ ?>
                                 <input class = "mdl-textfield__input" type = "text" id = "item_discount" name="item_discount" style="text-transform: capitalize;">
                            <?php } ?> 
                                 <label class = "mdl-textfield__label" >Item Discount</label>
                                  <span class="intro" id="errorStatename"></span>
                            </div>
                          </div>
                          <div class="col-lg-6 p-t-20"> 
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                              <?php if(isset($records)){ ?>
                                 <input class = "mdl-textfield__input" type = "text" id = "tax" name="tax" value="<?php echo $records->tax;?>" style="text-transform: capitalize;">
                              <?php }else{ ?>

                                 <input class = "mdl-textfield__input" type = "text" id = "tax" name="tax" style="text-transform: capitalize;">
                              <?php } ?> 

                                 <label class = "mdl-textfield__label" >Customer Tax Charge</label>
                                  <span class="intro" id="errorStatename"></span>
                              </div>
                          </div>
                           <div class="col-lg-6 p-t-20"> 
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">

                            <?php if(isset($records)){ ?>
                              <input class = "mdl-textfield__input" type = "text" id = "packaging" value="<?php echo $records->packaging;?>" name="packaging" style="text-transform: capitalize;">
                              <?php }else{ ?>

                                 <input class = "mdl-textfield__input" type = "text" id = "packaging" name="packaging" style="text-transform: capitalize;">
                              <?php } ?>  
                                 <label class = "mdl-textfield__label" >Customer Packaging Charge</label>
                                  <span class="intro" id="errorStatename"></span>
                            </div>
                          </div>
                          <div class="col-lg-6 p-t-20"> 
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                              <?php if(isset($records)){ ?>
                                <input class = "mdl-textfield__input" type = "text" id = "delivery" name="delivery" value="<?php echo $records->delivery;?>"  style="text-transform: capitalize;">
                              <?php }else{ ?>

                                 <input class = "mdl-textfield__input" type = "text" id = "delivery" name="delivery" style="text-transform: capitalize;">
                              <?php } ?>  
                                 <label class = "mdl-textfield__label" >Customer Delivery Charge</label>
                                  <span class="intro" id="errorStatename"></span>
                            </div>
                          </div>

                           <div class="col-lg-6 p-t-20"> 
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                              <?php if(isset($records)){ ?>
                                <input class = "mdl-textfield__input" type = "text" id = "seller_packaging" name="seller_packaging" value="<?php echo $records->seller_packaging;?>" style="text-transform: capitalize;">
                              <?php }else{ ?>

                                 <input class = "mdl-textfield__input" type = "text" id = "seller_packaging" name="seller_packaging" style="text-transform: capitalize;">
                                <?php } ?> 
                                 <label class = "mdl-textfield__label" >Seller Packaging Charge</label>
                                  <span class="intro" id="errorStatename"></span>
                            </div>
                          </div>
                          <div class="col-lg-6 p-t-20"> 
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                            <?php if(isset($records)){ ?>
                              <input class = "mdl-textfield__input" type = "text" id = "seller_delivery" name="seller_delivery" value="<?php echo $records->seller_delivery;?>" style="text-transform: capitalize;">
                              <?php }else{ ?>

                                 <input class = "mdl-textfield__input" type = "text" id = "seller_delivery" name="seller_delivery" style="text-transform: capitalize;">
                              <?php } ?> 
                                 <label class = "mdl-textfield__label" >Seller Delivery Charge</label>
                                  <span class="intro" id="errorStatename"></span>
                            </div>
                          </div>

                          <div class="col-lg-6 p-t-20"> 
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                              <?php if(isset($records)){ ?>
                                <input class = "mdl-textfield__input" type = "text" id = "cgstin" value="<?php echo $records->cgstin;?>" name="cgstin" style="text-transform: capitalize;">
                              <?php }else{ ?>  

                                 <input class = "mdl-textfield__input" type = "text" id = "cgstin" name="cgstin" style="text-transform: capitalize;">
                              <?php } ?> 
                                 <label class = "mdl-textfield__label" >CGSTIN ( % )</label>
                                  <span class="intro" id="errorStatename"></span>
                              </div>
                          </div>

                          <div class="col-lg-6 p-t-20"> 
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">

                              <?php if(isset($records)){ ?>
                                <input class = "mdl-textfield__input" type = "text" id = "sgstin" name="sgstin" value="<?php echo $records->sgstin;?>" style="text-transform: capitalize;">
                              <?php }else{ ?> 
                                 <input class = "mdl-textfield__input" type = "text" id = "sgstin" name="sgstin" style="text-transform: capitalize;">
                              <?php } ?> 
                                 <label class = "mdl-textfield__label" >SGSTIN ( % )</label>
                                  <span class="intro" id="errorStatename"></span>
                              </div>
                          </div>

                          <div class="col-lg-6 p-t-20"> 
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                            <?php if(isset($records)){ ?>
                              <input class = "mdl-textfield__input" type = "text" id = "remark" value="<?php echo $records->remark;?>" name="remark" style="text-transform: capitalize;">
                              <?php }else{ ?> 
                                 <input class = "mdl-textfield__input" type = "text" id = "remark" name="remark" style="text-transform: capitalize;">
                              <?php } ?> 
                                 <label class = "mdl-textfield__label" >Remark (Tax)</label>
                                  <span class="intro" id="errorStatename"></span>
                              </div>
                          </div>

                          <div class="col-lg-6 p-t-20"> 
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                              <?php if(isset($records)){ ?>
                                 <input class = "mdl-textfield__input" type = "text" id = "item_unit" value="<?php echo $records->item_unit;?>" name="item_unit" style="text-transform: capitalize;">
                              <?php }else{ ?> 
                                 <input class = "mdl-textfield__input" type = "text" id = "item_unit" name="item_unit" style="text-transform: capitalize;">
                              <?php } ?> 
                                 <label class = "mdl-textfield__label" >Item unit</label>
                                  <span class="intro" id="errorStatename"></span>
                              </div>
                          </div>
                          <div class="col-lg-6 p-t-20"> 
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                              <?php if(isset($records)){ ?>
                                <input class = "mdl-textfield__input" type="number" id="delivery_days" name="delivery_days" value="<?php echo $records->delivery_days;?>" style="text-transform: capitalize;">
                              <?php }else{ ?> 
                                 <input class = "mdl-textfield__input" type="number" id="delivery_days" name="delivery_days" style="text-transform: capitalize;">
                              <?php } ?>  
                                 <label class = "mdl-textfield__label" >Delivery Days</label>
                                  <span class="intro" id="errorStatename"></span>
                              </div>
                          </div>

                          <div class="col-lg-3 p-t-20"> 
                            <label for="sample2" class="mdl-textfield__label" style="margin-left: 20px;text-align: center;">Schedule</label>
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height txt-full-width">                 
                              <div class="col-md-12" style="text-align: center;">
                                <?php if(isset($records)){ ?>

                                  <input type="radio" name="is_schedule" value="0"<?php 
                                    if($records->is_schedule==0)
                                       echo "checked";
                                      ?>>Yes&nbsp;&nbsp;&nbsp;<input type="radio" name="is_schedule" value="1"<?php
                                       if($records->is_schedule==1)
                                        echo "checked";
                                        ?>>No

                                <?php }else{ ?>
                                    
                                    <input type="radio" name="is_schedule" value="0" style="width:25px;" >Yes&nbsp;&nbsp;&nbsp;<input type="radio" name="is_schedule" value="1" style="width:25px;" >No
                                <?php } ?>  
                               

                                <span class="intro" id="errorgender"></span>
                              </div>
                            </div>
                          </div>

                          <div class="col-lg-3 p-t-20" style="text-align: center;"> 
                            <label for="sample2" class="mdl-textfield__label" style="margin-left: 20px;text-align: center;">Stock</label>
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height txt-full-width">
                            <?php if(isset($records)){ ?>

                              <input type="radio" name="is_out_of_stock" value="0"<?php
                                   if( $records->is_out_of_stock==0)
                                   echo "checked";
                                    ?>>yes&nbsp;&nbsp;&nbsp;<input type="radio" name="is_out_of_stock" value="1"<?php
                                   if( $records->is_out_of_stock==1)
                                   echo "checked";
                                    ?>>no

                            <?php }else{ ?>

                                  <input type="radio" name="is_out_of_stock" value="0" style="width:25px;">Yes&nbsp;&nbsp;&nbsp;<input type="radio" name="is_out_of_stock" value="1" style="width:25px;" >No
                            <?php } ?>
                            
                            <span class="intro" id="errorgender"></span>      
                            </div>
                          </div>    

                          <div class="col-lg-3 p-t-20" > 
                           <label for="sample2" class="mdl-textfield__label" style="margin-left: 20px;text-align: center;">Online</label>
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height txt-full-width">
                                               
                              <div class="col-md-12" style="text-align: center;">
                                <?php if(isset($records)){ ?>
                                   <input type="radio" name="is_online" value="yes" <?php
                                     if( $records->is_online=="yes")
                                     echo "checked";
                                      ?>>yes&nbsp;&nbsp;&nbsp;<input type="radio" name="is_online" value="no"  <?php
                                     if( $records->is_online=="no")
                                     echo "checked";
                                    ?>>no
                                <?php }else{ ?>


                                    <input type="radio" name="is_online" value="Online" style="width:25px;">yes&nbsp;&nbsp;&nbsp;<input type="radio" name="is_online" value="Offline" style="width:25px;">no
                                <?php } ?>
                                <span class="intro" id="errorgender"></span>
                              </div>
                            </div>
                          </div>

                          <div class="col-lg-3 p-t-20" > 
                           <label for="sample2" class="mdl-textfield__label" style="margin-left: 20px;text-align: center;">Availability Six To Twelve</label>
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height txt-full-width">
                                               
                              <div class="col-md-12" style="text-align: center;">
                                <?php if(isset($records)){ ?>
                                  <input type="radio" name="is_available_six_to_twl" value="yes" <?php
                                   if( $records->is_available_six_to_twl=="yes")
                                   echo "checked";
                                    ?>>yes&nbsp;&nbsp;&nbsp;<input type="radio" name="is_available_six_to_twl" value="no"  <?php
                                   if( $records->is_available_six_to_twl=="no")
                                   echo "checked";
                                  ?>>no
                                <?php }else{ ?>
                                    <input type="radio" name="is_available_six_to_twl" value="yes" style="width:25px;">yes&nbsp;&nbsp;&nbsp;<input type="radio" name="is_available_six_to_twl" value="no" style="width:25px;">no
                                <?php } ?>
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