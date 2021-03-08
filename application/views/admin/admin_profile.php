<!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Edit Admin profile </div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo site_url('welcome/dashboard');?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                               
                                <li class="active">Edit Admin Profile</li>
                            </ol>
                        </div>
                    </div>
						<div class="row">
							<div class="col-sm-12">
								<div class="card-box">
									<div class="card-head">
										<header>Admin Profile Information</header>
										
				                       
									</div>
                  <?php echo $this->session->flashdata('Admin');?>
					<?php 
                  // print_r($records);exit; 
                  // foreach ($records as $row) { 
                    // print_r($row);exit;
                    ?>

                  <form action="<?php echo site_url('Admin/profile_Edit');?>" method="post" onsubmit="return validation();" enctype="multipart/form-data">

                    <div class="col-lg-6 p-t-20"> 
                        <label class = "mdl-textfield__label" style="margin-left: 14px;" >Admin profile</label>
                        <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">  
                            <input class = "mdl-textfield__input" type = "hidden" name="picture1"  value="<?php echo $records->profile;?>" >
                            <input class = "mdl-textfield__input" type = "file" name="picture" id = "id" value="<?php echo $records->profile;?>" accept="image/gif, image/jpeg, image/jpg, image/png">
                            <span class="intro" id="errorprofile"></span>
                            <a href="<?php echo base_url();?>uploads/user/<?php echo $records->profile;?>">
                        <img src="<?php echo base_url();?>uploads/user/<?php echo $records->profile;?>" alt="" style="height: 60px;width: 60px;margin-left:  200px;margin-top:  -63px;"></a>
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