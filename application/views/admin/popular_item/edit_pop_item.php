<!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Edit Pop_item details</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo site_url('welcome/dashboard');?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                               
                                <li class="active">Edit Pop_item details</li>
                            </ol>
                        </div>
                    </div>
						<div class="row">
							<div class="col-sm-12">
								<div class="card-box">
									<div class="card-head">
										<header>Pop_item Information</header>
										
				                       
									</div>
                  <?php echo $this->session->flashdata('Pop_item');?>
									<?php 
                  // print_r($records);exit; 
                  // foreach ($records as $row) { 
                    // print_r($row);exit;
                    ?>

                  <form action="<?php echo site_url('Popular_item/pop_item_Edit');?>" method="post">
                    <input class = "mdl-textfield__input" type = "hidden" id = "Name" name="id" value="<?php echo $records->pop_pro_id;?>">
									  <div class="card-body row">
                        <div class="col-lg-6 p-t-20"> 
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                 <select class = "mdl-textfield__input" id = "freename" name="item_name" style="text-transform: capitalize;">
                                  <?php 
                                  $iid = $records->item_id;
                                  foreach ($item as $key) { ?>
                                    <option <?php if($key['item_id']==$iid){ echo'selected'; } ?> value="<?php echo $key['item_id'];?>"><?php echo $key['item_name'];?></option>
                                  <?php }
                                  ?>
                                 </select>
                                 <label class = "mdl-textfield__label" >item Name</label>
                                  <span class="intro" id="errorname"></span>
                              </div>
                          </div> 
                          <div class="col-lg-6 p-t-20">
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
     