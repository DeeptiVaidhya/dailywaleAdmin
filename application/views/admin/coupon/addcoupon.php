<!-- start page content -->
<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Add Coupon</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo site_url('welcome/dashboard');?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Add Coupon</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card-box">
                    <div class="card-head">
                        <header>Coupon </header>
                        <?php echo $this->session->flashdata('Coupon');?>
                    </div>
                    <form action="<?php echo site_url('Coupon/InsertCoupon');?>" method="post" id="login" enctype="multipart/form-data">
                        <h4 style="font-size:15px;text-align:center;">Coupon Details</h4>
                        <div class="card-body row">
                            <div class="col-lg-6 p-t-20">
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                    <input class="mdl-textfield__input" type="text" id="coupon_code" name="coupon_code" style="text-transform: uppercase;" requierd>
                                    <label class="mdl-textfield__label">Coupon Code</label>
                                    <span class="intro" id="errorname"></span>
                                </div>
                            </div>
                            <div class="col-lg-6 p-t-20">
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                    <input class="mdl-textfield__input" type="text" id="is_one_time" name="is_one_time" style="text-transform: capitalize;"requierd>
                                    <label class="mdl-textfield__label">Is One Time</label>
                                    <span class="intro" id="errorname"></span>
                                </div>
                            </div>
                            <div class="col-lg-6 p-t-20">
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                    <input class="mdl-textfield__input" type="text" id="no_of_user" name="no_of_user" requierd>
                                    <label class="mdl-textfield__label">No Of User</label>
                                    <span class="intro" id="erroremail"></span>
                                </div>
                            </div>
                            <div class="col-lg-6 p-t-20">
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                    <input class="mdl-textfield__input" type="date" id="started_at" name="started_at" requierd>
                                    <label class="mdl-textfield__label">Started At</label>
                                    <span class="intro" id="erroremail"></span>
                                </div>
                            </div>
                            <div class="col-lg-6 p-t-20">
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                    <input class="mdl-textfield__input" type="date" name="valid_at" id="valid_at" requierd>
                                    <label class="mdl-textfield__label">Valid At</label>
                                    <span class="intro" id="errordob"></span>
                                </div>
                            </div>
                            <div class="col-lg-6 p-t-20">
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                    <input class="mdl-textfield__input" type="text" name="percentage" id="percentage" requierd>
                                    <label class="mdl-textfield__label">Percentage</label>
                                    <span class="intro" id="errordob"></span>
                                </div>
                            </div>
                            <div class="col-lg-6 p-t-20">
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                    <input class="mdl-textfield__input" type="text" name="max_amount" id="max_amount" requierd>
                                    <label class="mdl-textfield__label">Max Amount</label>
                                    <span class="intro" id="errordob"></span>
                                </div>
                            </div>
                            <div class="col-lg-6 p-t-20">
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                    <input class="mdl-textfield__input" type="text" name="is_rand" id="is_rand" requierd>
                                    <label class="mdl-textfield__label">Is Rand</label>
                                    <span class="intro" id="errordob"></span>
                                </div>
                            </div>
                            <div class="col-lg-6 p-t-20">
                                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                    <input class="mdl-textfield__input" type="text" name="min_cart_amount" id="min_cart_amount" requierd>
                                    <label class="mdl-textfield__label">Min Cart Amount</label>
                                    <span class="intro" id="errordob"></span>
                                </div>
                            </div>

                            <div class="col-lg-12 p-t-20 text-center">
                                <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-primary" data-upgraded=",MaterialButton,MaterialRipple">Submit
                                    <span class="mdl-button__ripple-container">
                                        <span class="mdl-ripple is-animating" style="width: 190.106px; height: 190.106px; transform: translate(-50%, -50%) translate(58px, 31px);"></span>
                                    </span>
                                </button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end page content -->