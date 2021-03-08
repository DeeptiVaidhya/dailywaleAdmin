<htmi>

    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    </head>
    <style type="text/css">
        .dropdown-menu>li>a {
            display: block;
            padding: 3px 20px;
            clear: both;
            font-weight: 400;
            line-height: 1.42857143;
            color: #333;
            white-space: nowrap;
        }
        
        .input-group-addon,
        .input-group-btn {
            width: 1%;
            white-space: nowrap;
            vertical-align: middle;
        }
        
        select.form-control:not([size]):not([multiple]) {
            height: calc(3.25rem + 2px);
        }
    </style>

    <body>
        <!-- start page content -->
        <div class="page-content-wrapper">
            <div class="page-content">
                <div class="page-bar">
                    <div class="page-title-breadcrumb">
                        <div class=" pull-left">
                            <div class="page-title">Add Vendor wallet details</div>
                        </div>
                        <ol class="breadcrumb page-breadcrumb pull-right">
                            <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo site_url('welcome/dashboard');?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                            </li>

                            <li class="active">Add Vendor wallet details</li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box">
                            <div class="card-head">
                                <header>Vendor wallet Information</header>

                            </div>
                            <?php echo $this->session->flashdata('User');?>

                                <form action="<?php echo site_url('Vendorinfo/credit_debit');?>" method="post" onsubmit="return validation();" enctype="multipart/form-data">

                                    <?php 
                                        //print_r($wallet);die;
                                        foreach($wallet as $data){}?>
                                        <input class="mdl-textfield__input" type="hidden" id="Name" name="id" value="<?php echo  $data['id']; ?>" readonly>

                                        <div class="card-body row">
                                            <div class="col-lg-6 p-t-20">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <input class="mdl-textfield__input" type="text" id="name" name="name" value="<?php echo  $data['name']; ?>" style="text-transform: capitalize;" readonly>
                                                    <label class="mdl-textfield__label">Name</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 p-t-20">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <?php if ($data['wallet_amount'] == '') {?>
                                                        <input type="text" class="mdl-textfield__input" name="wallet_amount" value="0" readonly>
                                                    <?php }else{?>
                                                        <input type="text" class="mdl-textfield__input" name="wallet_amount" value="<?php echo  $data['wallet_amount']; ?>" readonly>
                                                    <?php } ?>
                                                    <label class="mdl-textfield__label">Current Amount</label>
                                                </div>
                                            </div>
                                            <!-- <div class="col-lg-6 p-t-20" style="margin-top: 2%;">
                                                <div class="input-group">
                                                    <?php if ($data['wallet_amount'] == '') {?>
                                                        <input type="text" class="form-control " name="wallet_amount" value="0" readonly>
                                                        <?php }else{?>
                                                            <input type="text" class="form-control " name="wallet_amount" value="<?php echo  $data['wallet_amount']; ?>" readonly>
                                                            <?php } ?>
                                                </div>
                                            </div> -->
                                            <!-- <div class="col-lg-6 p-t-20">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <input class="mdl-textfield__input" type="text" id="phone" name="phone" style="text-transform: capitalize;" value="<?php echo  $data['phone']; ?>" readonly>
                                                    <label class="mdl-textfield__label">Mobile Number</label>
                                                    <span class="intro" id="errorname"></span>
                                                </div>
                                            </div> -->
                                        </div>
                                        <div class="card-body row">
                                            <!-- <label class="mdl-textfield__label" style="padding-left: 40px;">Current Amount</label> -->
                                            <!-- <span class="intro" id="errorname"></span> -->
                                            <!-- <div class="col-lg-6 p-t-20" style="margin-top: 2%;">
                                                <div class=" col-lg-6 input-group" style="float:left;">
                                                    <?php if ($data['wallet_amount'] == '') {?>
                                                        <input type="text" class="form-control " name="wallet_amount" value="0" readonly>
                                                        <?php }else{?>
                                                            <input type="text" class="form-control " name="wallet_amount" value="<?php echo  $data['wallet_amount']; ?>" readonly>
                                                            <?php } ?>
                                                </div>
                                                <div class="col-lg-6 input-group" style="float:left;">
                                                    <select class="form-control" name="status" id="status" style="margin-top:-3px;       margin-top: 0%;" required="">
                                                        <option value="" disabled selected>Select Type</option>
                                                        <option value="credit">Credit</option>
                                                        <option value="debit">Debit</option>
                                                    </select>
                                                    <span class="intro" id="errorname"></span>
                                                </div>
                                                <!-- /input-group -->
                                            <!--</div> -->
                                            <div class="col-lg-6 p-t-20">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                                    <input class="mdl-textfield__input" type="text" id="phone" name="phone" style="text-transform: capitalize;" value="<?php echo  $data['phone']; ?>" readonly>
                                                    <label class="mdl-textfield__label">Mobile Number</label>
                                                    <span class="intro" id="errorname"></span>
                                                </div>
                                            </div>
                                            <!-- /.col-lg-6 -->
                                            <div class="col-lg-3 p-t-20">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width" style="float: left;">
                                                    <input class="mdl-textfield__input" type="text" id="amt" name="amt" style="text-transform: capitalize;">
                                                    <label class="mdl-textfield__label">Credit/Debit Wallet Amount</label>
                                                    <span class="intro" id="errorname"></span>
                                                </div>   
                                            </div>
                                            <div class="col-lg-3 p-t-20">
                                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width" style="float:left;">
                                                    <select class="mdl-textfield__input" name="status" id="status" style="margin-top:-3px;       margin-top: 0%;" required="">
                                                        <option value="" disabled selected>Select Type</option>
                                                        <option value="credit">Credit</option>
                                                        <option value="debit">Debit</option>
                                                    </select>
                                                    <span class="intro" id="errorname"></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 p-t-20 text-center">
                                                <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-primary">Submit</button>
                                            </div>
                                        </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>

    </body>

    </html>