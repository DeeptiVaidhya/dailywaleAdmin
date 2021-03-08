<!DOCTYPE html>
<html>

<!-- Mirrored from radixtouch.in/smart/source/light/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 02 Feb 2018 13:14:17 GMT -->
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta name="description" content="Responsive Admin Template" />
    <meta name="author" content="SmartUniversity" />
    <title>Dailywale | Bootstrap Responsive Admin Template</title>
    <!-- google font -->
    <link href="<?php echo base_url();?>https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet" type="text/css" />
	<!-- icons -->
    <link href="<?php echo base_url();?>css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <!-- bootstrap -->
	<link href="<?php echo base_url();?>/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- style -->
    <link rel="stylesheet" href="<?php echo base_url();?>/assets/css/pages/extra_pages.css">
	<!-- favicon -->
    <link rel="shortcut icon" href="http://radixtouch.in/smart/source/assets/img/favicon.ico" /> 
</head>
<body>
    <div class="form-title">
        <h1>Login Form</h1>
    </div>
    <!-- Login Form-->
    <div class="login-form text-center">
        <div class="toggle" style="display: block;"><i class="fa fa-user-plus"></i>
        </div>
        <div class="form formLogin">
            <h2>Login to your account</h2>
            <?php echo $this->session->flashdata('message');?>
            <?php echo $this->session->flashdata('forgot');?>
            <?php echo $this->session->flashdata('otp');?>
            <form action="<?php echo site_url('Vendor/login');?>" method="post" onsubmit="return validation();" name="login" id="login">

            <input type="text" placeholder="Email" id="username" name="username" value="<?php if(!empty($_COOKIE['name'])){ echo $_COOKIE['name']; } ?>" />

            <input type="password" placeholder="Password" id="password" name="password" value="<?php if(!empty($_COOKIE['pass'])){ echo $_COOKIE['pass']; } ?>"/>
            
                <div class="remember text-left">
                    <div class="checkbox checkbox-primary">
                        <input id="checkbox2" type="checkbox" name="rem" <?php if(!empty($_COOKIE['rem'])){ echo "checked"; }?>>
                        <label for="checkbox2">
                            Remember me
                        </label>
                    </div>
                </div>
                <button type="submit">Login</button>
                <div class="forgetPassword"><a href="javascript:void(0)">Forgot your password</a>
                </div>
            </form>
        </div>
        <div class="form formRegister">
            <h2>Regiter Your Account</h2>
            <form method="post" action="<?php echo site_url('welcome/forgot');?>">
                <input type="text" placeholder="Username" />
                <input type="password" placeholder="Password" />
                <input type="email" placeholder="Email Address" />
                <input type="text" placeholder="Full Name" />
                <input type="tel" placeholder="Phone Number" />
                <button>Register</button>
            </form>
        </div>
    </div>
    <!-- start js include path -->
    <script src="<?php echo base_url();?>assets/plugins/jquery/jquery.min.js" ></script>
    
    <script src="<?php echo base_url();?>assets/js/pages/extra-pages/pages.js" ></script>
    <!-- end js include path -->
</body>

<!-- Mirrored from radixtouch.in/smart/source/light/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 02 Feb 2018 13:14:17 GMT -->
</html>