<!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Edit Sub_Cat details</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo site_url('welcome/dashboard');?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                               
                                <li class="active">Edit Sub_Cat details</li>
                            </ol>
                        </div>
                    </div>
						<div class="row">
							<div class="col-sm-12">
								<div class="card-box">
									<div class="card-head">
										<header>Sub_Cat Information</header>
										
				                       
									</div>
                  <?php echo $this->session->flashdata('category');?>
									<?php 
                  // print_r($records);exit; 
                  // foreach ($records as $row) { 
                    // print_r($row);exit;
                    ?>

                  <form action="<?php echo site_url('Sub_cat/sub_cat_Edit');?>" method="post" onsubmit="return validation();" enctype="multipart/form-data">

                    <div class="card-body row">
                        <div class="col-lg-6 p-t-20"> 
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                 <select class = "mdl-textfield__input" id = "freename" name="cat_name" style="text-transform: capitalize;">
                                  <?php 
                                  $cid = $records->cat_id;
                                  foreach ($cat as $key) { ?>
                                    <option <?php if($key['cat_id']==$cid){ echo'selected'; } ?> value="<?php echo $key['cat_id'];?>"><?php echo $key['cat_name'];?></option>
                                  <?php }
                                  ?>
                                 </select>
                                 <label class = "mdl-textfield__label" >Cat Name</label>
                                  <span class="intro" id="errorname"></span>
                              </div>
                          </div>   

									   

							            <div class="col-lg-6 p-t-20">
							             <input class = "mdl-textfield__input" type = "hidden" id = "Name" name="id" value="<?php echo $records->sub_cat_id;?>">
 
							              <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
						                     <input class = "mdl-textfield__input" type = "text" id = "name" name="sub_cat_name" value="<?php echo $records->sub_cat_name;?>" style="text-transform: capitalize;">
						                     <label class = "mdl-textfield__label">Sub_cat name</label>
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
          
     