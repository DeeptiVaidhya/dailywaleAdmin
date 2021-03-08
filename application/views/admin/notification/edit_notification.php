<!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Notification</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo site_url('welcome/dashboard');?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Notification</li>
                            </ol>
                        </div>
                    </div>
						<div class="row">
							<div class="col-sm-12">
								<div class="card-box">
									<div class="card-head">
										<header>Notification</header>				                       
									</div>
                  <?php echo $this->session->flashdata('User');?>
                  <form action="<?php echo site_url('Notification/sendPushNotification');?>" method="post">
									<div class="card-body row">
                      <div class="col-md-3"></div>  
                      <div class="col-md-6">                       
                          <div class="col-lg-12">
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                 <input class = "mdl-textfield__input" type = "number"  name="id" value="" style="text-transform: capitalize;" placeholder="ex: 0 (zero) for all user" required>
                                 <label class = "mdl-textfield__label">User</label>
                                  <span class="intro" id="errorname"></span>
                              </div>
                          </div>
                          <div class="col-lg-12">
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                 <input class = "mdl-textfield__input" type = "text"  name="title" value="" style="text-transform: capitalize;" required>
                                 <label class = "mdl-textfield__label">Title</label>
                                  <span class="intro" id="errorname"></span>
                              </div>
                          </div>
                          <div class="col-lg-12">
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                 <textarea class = "mdl-textfield__input" type = "text" id = "message" name="message" value="" required></textarea>
                                 <label class = "mdl-textfield__label">Message</label>
                                  <span class="intro" id="errorname"></span>
                              </div>
                          </div>
                           <div class="col-lg-12">
                           <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                              <select class = "mdl-textfield__input" name="type"  style="text-transform: capitalize;" required>
                                  <option value="" disabled="" selected="">-- Select Mobile Type --</option>
                                    <option value="android">Android</option>
                                    <!-- <option value="ios">IOS</option>
                                     <option value="both">Both</option> -->
                                </select>                                
                                 <label class = "mdl-textfield__label">User Type</label>
                                  <span class="intro" id="errorname"></span>
                              </div>
                          </div> 
								         <div class="col-lg-12 text-center"> 
							              	<button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-primary">Submit</button>
											
							            </div>
                        </div>  
                        <div class="col-md-3"></div>
								    	</div>
                      </form>
								</div>
							</div>
						</div> 
         </div>
       </div>
       