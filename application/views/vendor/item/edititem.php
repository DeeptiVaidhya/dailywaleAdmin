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
                  <?php echo $this->session->flashdata('Vendor');?>
									<?php 
                  // print_r($records);exit; 
                  // foreach ($records as $row) { 
                    // print_r($row);exit;
                    ?>

                  <form action="<?php echo site_url('Vendor/item_Edit');?>" method="post" onsubmit="return validation();" enctype="multipart/form-data">
                     <div class="card-body row">
                          <div class="col-lg-6 p-t-20">
                            <input class = "mdl-textfield__input" type = "hidden" id = "Name" name="id" value="<?php echo $records->item_id;?>">
 
                              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                 <input class = "mdl-textfield__input" type = "text" id = "name" name="item_name" value="<?php echo $records->item_name;?>" style="text-transform: capitalize;">
                                 <label class = "mdl-textfield__label">item name</label>
                                  <span class="intro" id="errorname"></span>
                              </div>
                          </div>
                     <!--  <div class="card-body row">
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
 -->

                  
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
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                 <input class = "mdl-textfield__input" type = "text" id = "name" name="item_desc" value="<?php echo $records->item_desc;?>" style="text-transform: capitalize;">
                                 <label class = "mdl-textfield__label">item description</label>
                                <span class="intro" id="errorname"></span>
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
                                 <input class = "mdl-textfield__input" type = "text" id = "name" name="item_unit" value="<?php echo $records->item_unit;?>" style="text-transform: capitalize;">
                                 <label class = "mdl-textfield__label">item unit</label>
                                <span class="intro" id="errorname"></span>
                            </div>
                          </div>

                          <div class="col-lg-6 p-t-20">
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                 <input class = "mdl-textfield__input" type = "text" id = "name" name="is_out_of_stock" value="<?php echo $records->is_out_of_stock;?>" style="text-transform: capitalize;">
                                 <label class = "mdl-textfield__label">is out of stock</label>
                                 <input type="radio" name="is_out_of_stock" value="in_stock"<?php
                                   if( $records->is_online=="yes")
                                   echo "checked";
                                    ?>>in_stock&nbsp;<input type="radio" name="is_out_of_stock" value="out_stock"<?php
                                   if( $records->is_online=="yes")
                                   echo "checked";
                                    ?>>out_stock
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
                                 <input class = "mdl-textfield__input" type = "text" id = "name" name="is_online" value="<?php echo $records->is_online;?>" style="text-transform: capitalize;">
                                 <input type="radio" name="is_online" value="yes" <?php
                                   if( $records->is_online=="yes")
                                   echo "checked";
                                    ?>>yes&nbsp;<input type="radio" name="is_online" value="no"  <?php
                                   if( $records->is_online=="no")
                                   echo "checked";
                                  ?>>no
                                 <label class = "mdl-textfield__label">is online</label>
                                  <span class="intro" id="errorname"></span>
                             </div>
                         </div>
             
                          <div class="col-lg-6 p-t-20">
  								          <div class="col-lg-12 p-t-20 text-center"> 
  							              	<button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-primary">Submit</button>
  											    </div>
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
    