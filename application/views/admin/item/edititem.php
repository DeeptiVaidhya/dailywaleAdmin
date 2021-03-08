<!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Edit Item details</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo site_url('welcome/dashboard');?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                               
                                <li class="active">Edit Item details</li>
                            </ol>
                        </div>
                    </div>
						<div class="row">
							<div class="col-sm-12">
								<div class="card-box">
									<div class="card-head">
										<header>Item Information</header>
										
				                       
									</div>
                  <?php echo $this->session->flashdata('Item');?>
									<?php 
                  // print_r($records);exit; 
                  // foreach ($records as $row) { 
                    // print_r($row);exit;
                    ?>

                  <form action="<?php echo site_url('Item/item_Edit');?>" method="post" onsubmit="return validation();" enctype="multipart/form-data">
                    <div class="card-body row">
                        <div class="col-lg-6 p-t-20">
                            <input class = "mdl-textfield__input" type = "hidden" id = "Name" name="id" value="<?php echo $records->item_id;?>">

                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label  txt-full-width">
                            <input class = "mdl-textfield__input" type = "text" id = "name" name="item_name" value="<?php echo $records->item_name;?>" style="text-transform: capitalize;">
                            <label class = "mdl-textfield__label">item name</label>
                            <span class="intro" id="errorname"></span>
                          </div>
                        </div>
                      
                        <div class="col-lg-6 p-t-20"> 
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                 <select class = "mdl-textfield__input" id = "freename" name="name" style="text-transform: capitalize;">
                                  <?php 
                                  $vid = $records->vendor_id;
                                  foreach ($vendor as $key) { ?>
                                    <option <?php if($key['id']==$vid){ echo'selected'; } ?> value="<?php echo $key['id'];?>"><?php echo $key['name'];?></option>
                                  <?php }
                                  ?>
                                 </select>
                                 <label class = "mdl-textfield__label" >Vendor</label>
                                  <span class="intro" id="errorname"></span>
                              </div>
                          </div>   


                   
                        <div class="col-lg-6 p-t-20"> 
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                 <select class = "mdl-textfield__input" id = "freename" name="sub_cat_name" style="text-transform: capitalize;">
                                  <?php 
                                  $iid = $records->sub_cat_id;
                                  foreach ($sub_cat as $key) { ?>
                                    <option <?php if($key->sub_cat_id==$iid){ echo'selected'; } ?> value="<?php echo $key->sub_cat_id; ?>"><?php echo $key->cat_name." - ".$key->sub_cat_name;?></option>
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
                                 <input class = "mdl-textfield__input" type = "file" name="picture" id = "item_images" value="<?php echo $records->item_images;?>" accept="image/gif, image/jpeg, image/jpg, image/png">
                                  <span class="intro" id="errorprofile"></span>
                                 <a href="<?php echo base_url();?>uploads/user/<?php echo $records->item_images;?>">
                            <img src="<?php echo base_url();?>uploads/user/<?php echo $records->item_images;?>" alt="" style="height: 60px;width: 60px;margin-left:  200px;margin-top:  -63px;"></a>
                              </div>
                          </div>  
                          <div class="col-lg-6 p-t-20"> 
                           <div class = "mdl-textfield mdl-js-textfield  mdl-textfield--floating-label txt-full-width">
                             <input class = "mdl-textfield__input" type = "text" id = "name" name="item_desc" value="<?php echo $records->item_desc;?>" style="text-transform: capitalize;">
                             <label class = "mdl-textfield__label">item description</label>
                              <span class="intro" id="errorname"></span>
                          </div>
                         </div>  

                         <div class="col-lg-6 p-t-20"> 
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                 <input class = "mdl-textfield__input" type = "text" id = "item_quantity_desc" name="item_quantity_desc" value="<?php echo $records->item_quantity_desc;?>" style="text-transform: capitalize;">
                                 <label class = "mdl-textfield__label" >Quantity description</label>
                                  <span class="intro" id="errorStatename"></span>
                              </div>
                          </div>

                            <div class="col-lg-6 p-t-20"> 
                              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                 <input class = "mdl-textfield__input" type = "text" id = "name" name="item_price" value="<?php echo $records->item_price;?>" style="text-transform: capitalize;">
                                 <label class = "mdl-textfield__label">item price</label>
                                  <span class="intro" id="errorname"></span>
                              </div>
                            </div> 
                            <div class="col-lg-6 p-t-20"> 
                               <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                 <input class = "mdl-textfield__input" type = "text" id = "name" name="item_discount" value="<?php echo $records->item_discount;?>" style="text-transform: capitalize;">
                                 <label class = "mdl-textfield__label">item discount</label>
                                  <span class="intro" id="errorname"></span>
                              </div>
                            </div> 
                            <div class="col-lg-6 p-t-20"> 
                               <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                 <input class = "mdl-textfield__input" type = "text" id = "name" name="packaging" value="<?php echo $records->packaging;?>" style="text-transform: capitalize;">
                                 <label class = "mdl-textfield__label">packaging</label>
                                  <span class="intro" id="errorname"></span>
                              </div>
                            </div>
                             <div class="col-lg-6 p-t-20">  
                               <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                 <input class = "mdl-textfield__input" type = "text" id = "name" name="delivery" value="<?php echo $records->delivery;?>" style="text-transform: capitalize;">
                                 <label class = "mdl-textfield__label">delivery</label>
                                  <span class="intro" id="errorname"></span>
                              </div>
                            </div>

                            <div class="col-lg-6 p-t-20"> 
                          <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                 <input class = "mdl-textfield__input" type = "text" id = "name" name="tax" value="<?php echo $records->tax;?>" style="text-transform: capitalize;">
                                 <label class = "mdl-textfield__label">tax</label>
                                  <span class="intro" id="errorname"></span>
                          </div>
                         </div>
                              
                             
                                
                            <div class="col-lg-6 p-t-20">  
                              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                 <input class = "mdl-textfield__input" type = "text" id = "name" name="item_unit" value="<?php echo $records->item_unit;?>" style="text-transform: capitalize;">
                                 <label class = "mdl-textfield__label">item unit</label>
                                  <span class="intro" id="errorname"></span>
                              </div>
                            </div>

                           <div class="col-lg-6 p-t-20"> 
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                 <input class = "mdl-textfield__input" type = "text" id = "seller_packaging" name="seller_packaging" value="<?php echo $records->seller_packaging;?>" style="text-transform: capitalize;">
                                 <label class = "mdl-textfield__label" >Seller Packaging Charge</label>
                                  <span class="intro" id="errorStatename"></span>
                            </div>
                          </div>
                          <div class="col-lg-6 p-t-20"> 
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                 <input class = "mdl-textfield__input" type = "text" id = "seller_delivery" name="seller_delivery" value="<?php echo $records->seller_delivery;?>" style="text-transform: capitalize;">
                                 <label class = "mdl-textfield__label" >Seller Delivery Charge</label>
                                  <span class="intro" id="errorStatename"></span>
                            </div>
                          </div>


                          <div class="col-lg-6 p-t-20"> 
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                 <input class = "mdl-textfield__input" type = "text" id = "cgstin" name="cgstin" value="<?php echo $records->cgstin;?>" style="text-transform: capitalize;">
                                 <label class = "mdl-textfield__label" >CGSTIN ( % )</label>
                                  <span class="intro" id="errorStatename"></span>
                              </div>
                          </div>

                          <div class="col-lg-6 p-t-20"> 
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                 <input class = "mdl-textfield__input" type = "text" id = "sgstin" name="sgstin" value="<?php echo $records->sgstin;?>" style="text-transform: capitalize;">
                                 <label class = "mdl-textfield__label" >SGSTIN ( % )</label>
                                  <span class="intro" id="errorStatename"></span>
                              </div>
                          </div>

                          <div class="col-lg-6 p-t-20"> 
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                 <input class = "mdl-textfield__input" type = "text" id = "remark" name="remark" value="<?php echo $records->remark;?>" style="text-transform: capitalize;">
                                 <label class = "mdl-textfield__label" >Remark (Tax)</label>
                                  <span class="intro" id="errorStatename"></span>
                              </div>
                          </div>
                          <div class="col-lg-6 p-t-20"> 
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                 <input class = "mdl-textfield__input" type="number" id="delivery_days" name="delivery_days" value="<?php echo $records->delivery_days;?>" style="text-transform: capitalize;">
                                 <label class = "mdl-textfield__label" >Delivery Days</label>
                                  <span class="intro" id="errorStatename"></span>
                              </div>
                          </div>


                          <div class="col-lg-3 p-t-20">  

                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height txt-full-width">              
                                  
                                    <input type="radio" name="is_schedule" value="0"<?php 
                                    if($records->is_schedule==0)
                                       echo "checked";
                                      ?>>Yes&nbsp;&nbsp;&nbsp;<input type="radio" name="is_schedule" value="1"<?php
                                       if($records->is_schedule==1)
                                        echo "checked";
                                        ?>>No
                                  
                                    <label class = "mdl-textfield__label" style="margin-top: -12%;"> Schedule </label>    
                                    <span class="intro" id="errorgender"></span>
                                </div>
                              </div>

                             <div class="col-lg-3 p-t-20"> 
                              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                 <!-- <input class = "mdl-textfield__input" type = "text" id = "name" name="is_out_of_stock" value="<?php echo $records->is_out_of_stock;?>" style="text-transform: capitalize;"> -->
                                 <label class = "mdl-textfield__label" style="margin-top: -12%;">In Stock</label>
                                 <input type="radio" name="is_out_of_stock" value="0"<?php
                                   if( $records->is_out_of_stock==0)
                                   echo "checked";
                                    ?>>yes&nbsp;&nbsp;&nbsp;<input type="radio" name="is_out_of_stock" value="1"<?php
                                   if( $records->is_out_of_stock==1)
                                   echo "checked";
                                    ?>>no
                                  <span class="intro" id="errorname"></span>
                              </div>
                            </div>

                          
                           <div class="col-lg-3 p-t-20"> 
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                 <!-- <input class = "mdl-textfield__input" type = "text" id = "name" name="is_online" value="<?php echo $records->is_online;?>" style="text-transform: capitalize;"> -->
                                 <input type="radio" name="is_online" value="yes" <?php
                                   if( $records->is_online=="yes")
                                   echo "checked";
                                    ?>>yes&nbsp;&nbsp;&nbsp;<input type="radio" name="is_online" value="no"  <?php
                                   if( $records->is_online=="no")
                                   echo "checked";
                                  ?>>no
                                 <label class = "mdl-textfield__label" style="margin-top: -12%;">Online</label>
                                  <span class="intro" id="errorname"></span>
                             </div>
                            </div>

                            <div class="col-lg-3 p-t-20"> 
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                 <input type="radio" name="is_available_six_to_twl" value="yes" <?php
                                   if( $records->is_available_six_to_twl=="yes")
                                   echo "checked";
                                    ?>>yes&nbsp;&nbsp;&nbsp;<input type="radio" name="is_available_six_to_twl" value="no"  <?php
                                   if( $records->is_available_six_to_twl=="no")
                                   echo "checked";
                                  ?>>no
                                 <label class = "mdl-textfield__label" style="margin-top: -12%;">Is Availability Six To Twelve</label>
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
  