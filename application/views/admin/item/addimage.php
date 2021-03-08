<!-- start page content  -->
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Upload Image</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo site_url('welcome/dashboard');?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                               
                                <li class="active">Upload Image</li>
                            </ol>
                        </div>
                    </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="card-box">
                  <div class="card-head">
                    <header>Upload Image</header>

                 <?php // echo $this->session->flashdata('Item');?>    
                               
                  </div>
                <form action="<?php echo site_url('Item/upload_single_image');?>" method="post" enctype="multipart/form-data" onsubmit="return validation();" >
                  <div class="card-body row">

                          <div class="col-lg-3 p-t-20 text-center"> 
                              
                          </div>

                          <div class="col-lg-6 p-t-20"> 
                           <label class = "mdl-textfield__label" style="margin-left: 14px;" >Upload Image</label>
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">

                                 <input class = "mdl-textfield__input" type = "file" name="picture" id = "profile" accept="image/gif, image/jpeg, image/jpg, image/png" >
                          
                                   <span class="intro" id="errorprofile"></span>
                              </div>
                          </div>

                           

                          <div class="col-lg-2 p-t-20 text-center"> 
                              <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-primary">Submit</button>
                          </div>


                  </div>
                 </form>

                 <h3 style="text-align: center;">
                   <?php
                    if(empty($_REQUEST)){
                      echo "Upload your promotion Image"; 
                    }else{  
                      echo $_REQUEST['url']; ?> 
                      <img src="<?php echo $_REQUEST['url']; ?>" alt="promotion" style="width:600px;margin-top: 50px;" />
                      <?php  
                    }
                   ?> 
                 </h3>

                </div>
              </div>
            </div> 
         </div>
       </div>
