
        <!-- start page container -->
        <div class="page-container">
 			<!-- start sidebar menu -->
 			<div class="sidebar-container">
 				<div class="sidemenu-container navbar-collapse collapse fixed-menu">
	                <div id="remove-scroll">
	                    <ul class="sidemenu  page-header-fixed" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
	                        <li class="sidebar-toggler-wrapper hide">
	                            <div class="sidebar-toggler">
	                                <span></span>
	                            </div>
	                        </li>
	                       <!--  <li class="sidebar-user-panel">
	                            <div class="user-panel">
	                                <div class="pull-left image">
	                                    <img src="<?php echo base_url();?>/assets/img/dp.jpg.jpg" class="img-circle user-img-circle" alt="User Image" />
	                                </div>
	                                <div class="pull-left info">
	                                    <p> Admin </p>
	                                    <a href="#"><i class="fa fa-circle user-online"></i><span class="txtOnline"> Online</span></a>
	                                </div>
	                            </div>
	                        </li> -->
	                        <li class="nav-item start active open">
	                            <a href="<?php echo site_url('Vendor/dashboard');?>" class="nav-link nav-toggle">
	                                <i class="material-icons">dashboard</i>
	                                <span class="title">Dashboard</span>
                                	<!-- <span class="selected"></span>
                                	<span class="arrow open"></span> -->
	                            </a>
	                        </li>
	                        <li class="nav-item">
	                            <a href="<?php echo site_url('Vendor/item');?>" class="nav-link nav-toggle"> <i class="material-icons">event</i>
	                                <span class="title">Items</span> 
	                            </a>
	                        </li>

	                        <!--<li class="nav-item">
	                            <a href="<?php echo site_url('Vendor/service_provider');?>" class="nav-link nav-toggle"> <i class="material-icons">event</i>
	                                <span class="title">Services</span> 
	                            </a>
	                        </li>-->

	                        <li class="nav-item">
	                            <a href="<?php echo site_url('Vendor/payment_history');?>" class="nav-link nav-toggle"> <i class="material-icons">event</i>
	                                <span class="title">Payment History </span> 
	                            </a>
	                        </li>
	                        
	                        <!-- <li class="nav-item">
	                            <a href="#" class="nav-link nav-toggle"><i class="material-icons">group</i>
	                            <span class="title"></span>Order<span class="arrow"></span></a>
	                            <ul class="sub-menu"> -->
	                            	<?php if($this->uri->segment(1) && $this->uri->segment(1)=="Pending") {?>
			                        <li class="nav-item active">
			                            <a href="<?php echo site_url('VendorOrder/pending');?>" class="nav-link nav-toggle">
			                                <span class="title">Pending</span> 
			                            </a>
			                        </li>
			                        <?php }else {?>
			                        <li class="nav-item">
			                            <a href="<?php echo site_url('VendorOrder/pending');?>" class="nav-link nav-toggle">
			                                <span class="title">Pending</span> 
			                            </a>
			                        </li>
			                        <?php }?>
			                        <?php if($this->uri->segment(1) && $this->uri->segment(1)=="Dispatch") {?>
			                        <li class="nav-item active">
			                            <a href="<?php echo site_url('VendorOrder/dispatch');?>" class="nav-link nav-toggle">
			                                <span class="title">Dispatch</span> 
			                            </a>
			                        </li>
			                        <?php }else {?>
			                        <li class="nav-item">
			                            <a href="<?php echo site_url('VendorOrder/dispatch');?>" class="nav-link nav-toggle">
			                                <span class="title">Dispatch</span> 
			                            </a>
			                        </li>
			                        <?php }?>
			                        <?php if($this->uri->segment(1) && $this->uri->segment(1)=="Confirmed") {?>
			                        <li class="nav-item active">
			                            <a href="<?php echo site_url('VendorOrder/confirmed');?>" class="nav-link nav-toggle">
			                                <span class="title">Confirmed</span> 
			                            </a>
			                        </li>
			                        <?php }else {?>
			                        <li class="nav-item">
			                            <a href="<?php echo site_url('VendorOrder/confirmed');?>" class="nav-link nav-toggle">
			                                <span class="title">Confirmed</span> 
			                            </a>
			                        </li>
			                        <?php }?>
	                                 <?php if($this->uri->segment(1) && $this->uri->segment(1)=="Delivered") {?>
			                        <li class="nav-item active">
			                            <a href="<?php echo site_url('VendorOrder/delivered');?>" class="nav-link nav-toggle">
			                                <span class="title">Delivered</span> 
			                            </a>
			                        </li>
			                        <?php }else {?>
			                        <li class="nav-item">
			                            <a href="<?php echo site_url('VendorOrder/delivered');?>" class="nav-link nav-toggle">
			                                <span class="title">Delivered</span> 
			                            </a>
			                        </li>
			                        <?php }?>
	                                <?php if($this->uri->segment(1) && $this->uri->segment(1)=="Refund") {?>
			                        <li class="nav-item active">
			                            <a href="<?php echo site_url('VendorOrder/refund');?>" class="nav-link nav-toggle">
			                                <span class="title">Refund</span> 
			                            </a>
			                        </li>
			                        <?php }else {?>
			                        <li class="nav-item">
			                            <a href="<?php echo site_url('VendorOrder/refund');?>" class="nav-link nav-toggle">
			                                <span class="title">Refund</span> 
			                            </a>
			                        </li>
			                        <?php }?>
			                        <?php if($this->uri->segment(1) && $this->uri->segment(1)=="Cancelled") {?>
			                        <li class="nav-item active">
			                            <a href="<?php echo site_url('VendorOrder/cancelled');?>" class="nav-link nav-toggle">
			                                <span class="title">Cancelled</span> 
			                            </a>
			                        </li>
			                        <?php }else {?>
			                        <li class="nav-item">
			                            <a href="<?php echo site_url('VendorOrder/cancelled');?>" class="nav-link nav-toggle">
			                                <span class="title">Cancelled</span> 
			                            </a>
			                        </li>
			                        <?php }?>
			                   <!--      
	                            </ul>
	                        </li>  -->
	                       
	                    </ul>
	                </div>
                </div>
            </div>
            <!-- end sidebar menu --> 