<!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Add wallet details</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo site_url('welcome/dashboard');?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                               
                                <li class="active">Add wallet details</li>
                            </ol>
                        </div>
                    </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="card-box">
                  <div class="card-head">
                    <header>wallet Information</header>
                  </div>
                  <?php echo $this->session->flashdata('User');?>
                
                  <form action="<?php echo site_url('Wallet_amount/addwallet');?>" method="post" onsubmit="return validation();" enctype="multipart/form-data">
                    <input class = "mdl-textfield__input" type = "hidden" id = "Name" name="id" value="<?php echo $records->user_id;?>">
                      <div class="card-body row">
                       <div class="col-lg-6 p-t-20">
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                 <input class = "mdl-textfield__input" readonly type = "text" id = "name" name="name" value="<?php echo $records->fname." ".$records->lname; ?>" style="text-transform: capitalize;">
                                 <label class = "mdl-textfield__label">Name</label>
                              </div>
                          </div>
                          <div class="col-lg-6 p-t-20">
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                 <input class = "mdl-textfield__input" type = "text" id = "mobile" name="mobile" style="text-transform: capitalize;" value="<?php echo $records->user_mobile;?>" readonly >
                                 <label class = "mdl-textfield__label">Mobile Number</label>
                                  <span class="intro" id="errorname"></span>
                              </div>
                          </div>
                        </div>
                      <div class="card-body row">
                       <div class="col-lg-6 p-t-20">
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                 <input class = "mdl-textfield__input" readonly="" type = "number" id = "wamt" name="wallet_amount" value="<?php echo $records->wallet_amount;?>" style="text-transform: capitalize;">
                                 <label class = "mdl-textfield__label">Wallet Amount</label>
                              </div>
                          </div>
                          <!-- <div class="col-lg-6 p-t-20">
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                 <input class = "mdl-textfield__input" type = "text" id = "amt" name="amt" style="text-transform: capitalize;">
                                 <label class = "mdl-textfield__label">Add Wallet Amount</label>
                                  <span class="intro" id="errorname"></span>
                              </div>
                          </div> -->
                            <div class="col-lg-3 p-t-20">
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width" style="float: left;">
                                    <input class="mdl-textfield__input" type="text" id="amt" name="amt" style="text-transform: capitalize;">
                                    <label class="mdl-textfield__label">Credit/Debit Wallet Amount</label>
                                    <span class="intro" id="errorname"></span>
                                </div>   
                            </div>
                            <div class="col-lg-3 p-t-20">
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width" style="float:left;">
                                    <select class="mdl-textfield__input" name="status" id="status" style="margin-top:-3px; margin-top: 0%;" required="">
                                        <option value="" disabled selected>Select Type</option>
                                        <option value="credit">Credit</option>
                                        <option value="debit">Debit</option>
                                    </select>
                                    <span class="intro" id="errorname"></span>
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
       