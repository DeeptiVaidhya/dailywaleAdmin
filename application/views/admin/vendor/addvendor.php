<!-- start page content -->
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Add Vendor</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo site_url('welcome/dashboard');?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Add Vendor</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card-box">
                    <div class="card-head">
                        <header>Vendor Information</header>
                        <?php echo $this->session->flashdata('Vendor');?>
                    </div>
                    <form action="<?php echo site_url('Vendorinfo/addVendor');?>" method="post" id="login" enctype="multipart/form-data" onsubmit="return validation();">
                        <h4 style="font-size:15px;text-align:center;">Vendor Details</h4>
                        <div class="card-body row">
                            <div class="col-lg-6 p-t-20">
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                    <input class="mdl-textfield__input" type="text" id="freename" name="name" style="text-transform: capitalize;" requierd>
                                    <label class="mdl-textfield__label">Name</label>
                                    <span class="intro" id="errorname"></span>
                                </div>
                            </div>
                            <div class="col-lg-6 p-t-20">
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                    <input class="mdl-textfield__input" type="text" id="freename" name="address" style="text-transform: capitalize;"requierd>
                                    <label class="mdl-textfield__label">Address</label>
                                    <span class="intro" id="errorname"></span>
                                </div>
                            </div>
                            <div class="col-lg-6 p-t-20">
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                    <input class="mdl-textfield__input" type="text" id="email" name="email"requierd>
                                    <label class="mdl-textfield__label">Email</label>
                                    <span class="intro" id="erroremail"></span>
                                </div>
                            </div>
                            <div class="col-lg-6 p-t-20">
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                    <input class="mdl-textfield__input" type="text" id="email" name="pwd"requierd>
                                    <label class="mdl-textfield__label">Password</label>
                                    <span class="intro" id="erroremail"></span>
                                </div>
                            </div>
                            <div class="col-lg-6 p-t-20">
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                    <input class="mdl-textfield__input" type="text" name="phone" id="phone"requierd>
                                    <label class="mdl-textfield__label">Phone No.</label>
                                    <span class="intro" id="errordob"></span>
                                </div>
                            </div>
                        </div>
                        <h4 style="font-size:15px;text-align:center;">Bank Account Detials</h4>
                        <div class="card-body row">
                          <div class="col-lg-6 p-t-20">
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                    <input class="mdl-textfield__input" type="text" id="freename" name="account_name" style="text-transform: capitalize;"requierd>
                                    <label class="mdl-textfield__label">Account Name</label>
                                    <span class="intro" id="errorname"></span>
                                </div>
                            </div>
                            <div class="col-lg-6 p-t-20">
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                    <input class="mdl-textfield__input" type="text" id="freename" name="account_no" style="text-transform: capitalize;"requierd>
                                    <label class="mdl-textfield__label">Account Number</label>
                                    <span class="intro" id="errorname"></span>
                                </div>
                            </div>
                            <div class="col-lg-6 p-t-20">
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                    <select class="mdl-textfield__input" name="account_type" id="status" style="" required="">
                                      <option value="" disabled selected>Select Account Type</option>
                                      <option value="current">Current</option>
                                      <option value="savings">Saving</option>
                                    </select>
                                    <span class="intro" id="erroremail"></span>
                                </div>
                            </div>
                            <div class="col-lg-6 p-t-20">
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                    <input class="mdl-textfield__input" type="text" id="ifsccode" name="ifsc_code"requierd>
                                    <label class="mdl-textfield__label">IFSC Code</label>
                                    <span class="intro" id="erroremail"></span>
                                </div>
                            </div>
                        </div>
                        <h4 style="font-size:15px;text-align:center;">Company Details</h4>
                        <div class="card-body row">
                            <div class="col-lg-6 p-t-20">
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                    <input class="mdl-textfield__input" type="text" id="companyname" name="company_name" style="text-transform: capitalize;">
                                    <label class="mdl-textfield__label"> Company Name</label>
                                    <span class="intro" id="errorname"></span>
                                </div>
                            </div>
                            <div class="col-lg-6 p-t-20">
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                    <input class="mdl-textfield__input" type="text" id="companyaddress" name="company_address" style="text-transform: capitalize;">
                                    <label class="mdl-textfield__label"> Company Address</label>
                                    <span class="intro" id="errorname"></span>
                                </div>
                            </div>
                            <div class="col-lg-6 p-t-20">
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                    <input class="mdl-textfield__input" type="text" name="company_phone_no" id="phone"requierd>
                                    <label class="mdl-textfield__label"> Company Phone No.</label>
                                    <span class="intro" id="errordob"></span>
                                </div>
                            </div>
                             <div class="col-lg-6 p-t-20">
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                    <input class="mdl-textfield__input" type="text" name="gst_no" maxlength="16" id="gst_no"requierd>
                                    <label class="mdl-textfield__label"> GST </label>
                                    <span class="intro" id="errorreggst"></span>
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
    function validation() {

        var freename = document.getElementById('freename').value;
        if (freename.length == "") {

            document.getElementById('errorname').innerHTML = "Please Enter Name!";
            return false;
        }

        var email = document.getElementById('email').value;
        if (email.length == "") {

            document.getElementById('erroremail').innerHTML = "Please Enter Email!";
            return false;
        }

        var email = /^\w+[\+\.\w-]*@([\w-]+\.)*\w+[\w-]*\.([a-z]{2,4}|\d+)$/i
        var email = email.test(document.getElementById("email").value);
        if (email == false) {

            document.getElementById('erroremail').innerHTML = "Please Enter valid Email id !";
            return false;
        }

        var ej = document.getElementById("gender");
        var strUserqwe = ej.options[ej.selectedIndex].value;
        var strUser1123 = ej.options[ej.selectedIndex].text;
        if (strUserqwe == 0) {

            document.getElementById('errorgender').innerHTML = "Please Select Gender Type!";
            return false;
        }

        var add = document.getElementById('linkedin_id').value;
        if (add.length == "") {

            document.getElementById('errorLink').innerHTML = "Please Enter Linkedin Id!";
            return false;
        }
        

    }
</script>