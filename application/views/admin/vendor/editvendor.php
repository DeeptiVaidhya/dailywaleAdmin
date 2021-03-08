<!-- start page content -->
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Edit User details</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo site_url('welcome/dashboard');?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>

                    <li class="active">Edit User details</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card-box">
                    <div class="card-head">
                        <header>User Information</header>

                    </div>
                    <?php echo $this->session->flashdata('User');?>
                        <?php 
                  // print_r($records);exit; 
                  // foreach ($records as $row) { 
                    // print_r($row);exit;
                    ?>

                            <form action="<?php echo site_url('Vendorinfo/vendorEdit');?>" method="post" onsubmit="return validation();" enctype="multipart/form-data">
                                <input class="mdl-textfield__input" type="hidden" id="Name" name="id" value="<?php //echo $records->coupon_id;?>">
                                <div class="card-body row">
                                    <div class="col-lg-6 p-t-20">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <input class="mdl-textfield__input" type="text" id="name" name="name" value="<?php echo $records->name;?>" style="text-transform: capitalize;">
                                            <label class="mdl-textfield__label">Name</label>
                                            <span class="intro" id="errorname"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 p-t-20">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <input class="mdl-textfield__input" type="text" id="name" name="address" value="<?php  echo $records->address;?>" style="text-transform: capitalize;">
                                            <label class="mdl-textfield__label">address</label>
                                            <span class="intro" id="errorname"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 p-t-20">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <input class="mdl-textfield__input" type="text" id="name" name="email" value="<?php  echo $records->email;?>" style="text-transform: capitalize;">
                                            <label class="mdl-textfield__label">Email</label>
                                            <span class="intro" id="errorname"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 p-t-20">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <input class="mdl-textfield__input" type="text" id="name" name="pwd" value="<?php  echo $records->pwd;?>" style="text-transform: capitalize;">
                                            <label class="mdl-textfield__label">password</label>
                                            <span class="intro" id="errorname"></span>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 p-t-20">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <input class="mdl-textfield__input" type="text" id="name" name="phone" value="<?php echo $records->phone;?>" style="text-transform: capitalize;">
                                            <label class="mdl-textfield__label">Phone No.</label>
                                            <span class="intro" id="errorname"></span>
                                        </div>
                                    </div>
                                </div>
                                <h4 style="font-size:15px;text-align:center;">Bank Account Detials</h4>
                                <div class="card-body row">
                                    <div class="col-lg-6 p-t-20">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <input class="mdl-textfield__input" type="text" id="freename" name="account_name" value="<?php  echo $records->account_name;?>" style="text-transform: capitalize;" requierd>
                                            <label class="mdl-textfield__label">Account Name</label>
                                            <span class="intro" id="errorname"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 p-t-20">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <input class="mdl-textfield__input" type="text" id="freename" name="account_no" value="<?php echo $records->account_no;?>" style="text-transform: capitalize;" requierd>
                                            <label class="mdl-textfield__label">Account Number</label>
                                            <span class="intro" id="errorname"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 p-t-20">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <select class="mdl-textfield__input" name="account_type" id="status" style="" required="">
                                                <option value="" disabled selected>Select Account Type</option>
                                                <option <?php if($records->account_type == 'current'){ echo "selected"; } ?> value="current" >Current</option>
                                                <option <?php if($records->account_type == 'saving'){ echo "selected"; } ?> value="savings">Saving</option>
                                            </select>
                                            <span class="intro" id="erroremail"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 p-t-20">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <input class="mdl-textfield__input" type="text" id="ifsccode" value="<?php echo $records->ifsc_code;?>" name="ifsc_code" requierd>
                                            <label class="mdl-textfield__label">IFSC Code</label>
                                            <span class="intro" id="erroremail"></span>
                                        </div>
                                    </div>
                                </div>
                                <h4 style="font-size:15px;text-align:center;">Company Details</h4>
                                <div class="card-body row">
                                    <div class="col-lg-6 p-t-20">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <input class="mdl-textfield__input" type="text" id="companyname" name="company_name" value="<?php echo $records->company_name;?>" style="text-transform: capitalize;">
                                            <label class="mdl-textfield__label"> Company Name</label>
                                            <span class="intro" id="errorname"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 p-t-20">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <input class="mdl-textfield__input" type="text" id="companyaddress" name="company_address" value="<?php echo $records->company_address;?>" style="text-transform: capitalize;">
                                            <label class="mdl-textfield__label"> Company Address</label>
                                            <span class="intro" id="errorname"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 p-t-20">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <input class="mdl-textfield__input" type="text" name="company_phone_no" id="phone" value="<?php echo $records->company_phone_no;?>" requierd>
                                            <label class="mdl-textfield__label"> Company Phone No.</label>
                                            <span class="intro" id="errordob"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 p-t-20">
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                            <input class="mdl-textfield__input" type="text" name="gst_no" value="<?php echo $records->gst_no;?>" size="16" id="gst" requierd>
                                            <label class="mdl-textfield__label"> GST</label>
                                            <span class="intro" id="errorgst"></span>
                                        </div>
                                    </div>
                                </div>

                                <h4 style="font-size:15px;text-align:center;"> Item Details</h4>
                                <div class="card-body row">
                                    <div class="table-scrollable">
                              <table class="table table-striped table-bordered table-hover table-checkable order-column valign-middle" id="example4">
                                 <thead>
                                    <tr>
                                       <th>S.No.</th>
                                       <th>Item Name</th>
                                       <th>Description</th>
                                       <th>Item Price</th>
                                       <th>Item Discount</th>
                                       <th>Customer Tax Charge</th>
                                       <th>Customer Packaging Charge</th>
                                       <th>Customer Delivery Charge</th>
                                       <th>Seller Tax Charge</th>
                                       <th>Seller Packaging Charge</th>
                                       <th>Seller Delivery Charge</th>
                                        
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php 
                                    $i=1;
                                    foreach($item_list as $r){?>
                                    <tr class="odd gradeX">
                                       <td class="left"><?php echo $i;?></td>
                                       <td class="left"><?php echo $r['item_name'];?></td>
                                       <td class="left"><?php echo ucwords($r['item_desc']);?></td>
                                       <td class="left"><?php echo ucwords($r['item_price']);?></td>
                                       <td class="left"><?php echo $r['item_discount'];?></td>
                                       <td class="left"><?php echo $r['tax'];?></td>
                                       <td class="left"><?php echo $r['packaging'];?></td>
                                       <td class="left"><?php echo $r['delivery'];?></td> 
                                       <td class="left"><?php echo $r['seller_tax'];?></td>
                                       <td class="left"><?php echo $r['seller_packaging'];?></td>
                                       <td class="left"><?php echo $r['seller_delivery'];?></td>
                                    </tr>
                                    <?php $i++; } ?>
                                 </tbody>
                              </table>
                           </div>
                                    
                                </div>

                                <div class="col-lg-12 p-t-20 text-center">
                                    <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-primary">Submit</button>
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