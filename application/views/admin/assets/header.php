<!DOCTYPE html>
<html lang="en">
<!-- BEGIN HEAD -->

<!-- Mirrored from radixtouch.in/smart/source/light/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 02 Feb 2018 13:08:55 GMT -->
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta name="description" content="Responsive Admin Template" />
    <meta name="author" content="SmartUniversity" />
    <title>DailyWale</title>
    <!-- google font -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet" type="text/css" />
	<!-- icons -->
    <link href="<?php echo base_url();?>/assets/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<!--bootstrap -->
	<link href="<?php echo base_url();?>/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url();?>/assets/plugins/summernote/summernote.css" rel="stylesheet">
    <!-- Material Design Lite CSS -->
	<link rel="stylesheet" href="<?php echo base_url();?>/assets/plugins/material/material.min.css">
	<link rel="stylesheet" href="<?php echo base_url();?>/assets/css/material_style.css">
	<!-- inbox style -->
    <link href="<?php echo base_url();?>/assets/css/pages/inbox.min.css" rel="stylesheet" type="text/css" />
     <link href="<?php echo base_url();?>assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css"/>
	<!-- Theme Styles -->
    <link href="<?php echo base_url();?>/assets/css/theme/light/theme_style.css" rel="stylesheet" id="rt_style_components" type="text/css" />
    <link href="<?php echo base_url();?>/assets/css/plugins.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>/assets/css/theme/light/style.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>/assets/css/responsive.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>/assets/css/theme/light/theme-color.css" rel="stylesheet" type="text/css" />
	<!-- favicon -->
    <link rel="stylesheet" href="<?php echo base_url();?>/assets/plugins/material-datetimepicker/bootstrap-material-datetimepicker.css" />
    <link rel="shortcut icon" href="http://radixtouch.in/smart/source/assets/img/favicon.ico" /> 
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
 </head>
 <!-- END HEAD -->
<body class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white white-sidebar-color logo-indigo">
    <div class="page-wrapper">
        <!-- start header -->
        <div class="page-header navbar navbar-fixed-top">
            <div class="page-header-inner ">
                <!-- logo start -->
                <div class="page-logo">
                    <a href="<?php echo site_url('Welcome/dashboard');?>">
                    <!-- <span class="logo-icon material-icons fa-rotate-45">school</span> -->
                    <span><img  src="<?php echo base_url();?>/assets/img/logo.png.png"  style="width:12%" alt="logo" /></span>
                    <span class="logo-default" >DailyWale</span> </a>
                </div>
                </form>
                <!-- start mobile menu -->
                <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
                    <span></span>
                </a>
                <div class="top-menu">
                    <ul class="nav navbar-nav pull-right">
 						<li class="dropdown dropdown-user">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                <?php
                                $admin_id  = $this->session->userdata('userinfo')->id;
                                $wheredata = array("id"=>$admin_id);
                                $data      = $this->Model->selectAllById('admin',$wheredata);
                                $image     = $data->profile;
                                    // print_r($_SESSION['userinfo']->profile);
                                    if(empty($image)){ ?>
                                        <img alt="" class="img-circle" src="<?php echo base_url();?>/assets/img/dp.jpg.jpg" />
                                    <?php }else{ ?>
                                        <img alt="" class="img-circle" src="<?php echo base_url();?>/uploads/user/<?php echo $image; ?>"/>
                                    <?php }
                                ?>
                                
                                <span class="username username-hide-on-mobile"></span>
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-default">
                                <li>
                                    <a href="<?php echo site_url('Admin/profile');?>">
                                        <i class="icon-user"></i> Profile </a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('Vendor/logout')?> ">
                                        <i class="icon-logout"></i> Log Out </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
