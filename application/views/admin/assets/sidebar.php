
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

         <?php if($_SESSION['userType']=="1"){ ?>
	                        <?php if($this->uri->segment(1) && $this->uri->segment(1)=="Welcome") {?>
	                        <li class="nav-item active">
	                            <a href="<?php echo site_url('Welcome/dashboard');?>" class="nav-link nav-toggle">
	                              <i class="material-icons">dashboard</i>
	                                <span class="title">Dashboard</span> 
	                            </a>
	                        </li>
	                        <?php }else {?>
	                        <li class="nav-item">
	                            <a href="<?php echo site_url('Welcome/dashboard');?>" class="nav-link nav-toggle">
	                              <i class="material-icons">dashboard</i>
	                                <span class="title">Dashboard</span> 
	                            </a>
	                        </li>
	                        <?php }?>

	                        <?php if($this->uri->segment(1) && $this->uri->segment(1)=="Welcome") {?>
	                        <li class="nav-item active">
	                            <a href="<?php echo site_url('Orders/all_order');?>" >
	                             
	                                <i class="material-icons">group</i><span class="title">All order</span> 
	                            </a>
	                        </li>
	                        <?php }else {?>
	                        <li class="nav-item">
	                            <a href="<?php echo site_url('Orders/all_order');?>" class="nav-link nav-toggle">
	                             
	                                <i class="material-icons">group</i><span class="title">All order</span> 
	                            </a>
	                        </li>
	                        <?php }?>


	                        <li class="nav-item">
	                            <a href="#" class="nav-link nav-toggle"><i class="material-icons">group</i>
	                            <span class="title"></span>Orders<span class="arrow"></span></a>
	                            <ul class="sub-menu">
	                            	<?php if($this->uri->segment(1) && $this->uri->segment(1)=="Pending") {?>
			                        <li class="nav-item active">
			                            <a href="<?php echo site_url('Orders/pending');?>" class="nav-link nav-toggle">
			                                <span class="title">Upcoming</span> 
			                            </a>
			                        </li>
			                        <?php }else {?>
			                        <li class="nav-item">
			                            <a href="<?php echo site_url('Orders/pending');?>" class="nav-link nav-toggle">
			                                <span class="title">Upcoming</span> 
			                            </a>
			                        </li>
			                        <?php }?>
			                        <?php if($this->uri->segment(1) && $this->uri->segment(1)=="Accept") {?>
			                        <!-- <li class="nav-item active">
			                            <a href="<?php echo site_url('Orders/accept');?>" class="nav-link nav-toggle">
			                                <span class="title">Dispatch</span> 
			                            </a>
			                        </li> -->
			                        <?php }else {?>
			                       <!--  <li class="nav-item">
			                            <a href="<?php echo site_url('Orders/accept');?>" class="nav-link nav-toggle">
			                                <span class="title">Dispatch</span> 
			                            </a>
			                        </li> -->
			                        <?php }?>
	                                <!--  <?php if($this->uri->segment(1) && $this->uri->segment(1)=="City") {?>
			                        <li class="nav-item active">
			                            <a href="<?php echo site_url('Orders/usercancelOrder');?>" class="nav-link nav-toggle">Userside Delete</span> 
			                            </a>
			                        </li>
			                        <?php }else {?>
			                        <li class="nav-item">
			                            <a href="<?php echo site_url('Orders/usercancelOrder');?>" class="nav-link nav-toggle">
			                                <span class="title">Userside Delete</span> 
			                            </a>
			                        </li>
			                        <?php }?> -->
			                         <?php if($this->uri->segment(1) && $this->uri->segment(1)=="Dispatch") {?>
			                        <li class="nav-item active">
			                            <a href="<?php echo site_url('Orders/dispatch');?>" class="nav-link nav-toggle">
			                                <span class="title">Dispatch</span> 
			                            </a>
			                        </li>
			                        <?php }else {?>
			                        <li class="nav-item">
			                            <a href="<?php echo site_url('Orders/dispatch');?>" class="nav-link nav-toggle">
			                                <span class="title">Dispatch</span> 
			                            </a>
			                        </li>
			                        <?php }?>
			                        <?php if($this->uri->segment(1) && $this->uri->segment(1)=="Deliverd") {?>
			                        <li class="nav-item active">
			                            <a href="<?php echo site_url('Orders/deliverdOrder');?>" class="nav-link nav-toggle">
			                                <span class="title">Delivered</span> 
			                            </a>
			                        </li>
			                        <?php }else {?>
			                        <li class="nav-item">
			                            <a href="<?php echo site_url('Orders/deliverdOrder');?>" class="nav-link nav-toggle">
			                                <span class="title">Delivered</span> 
			                            </a>
			                        </li>
			                        <?php }?>
	                                <?php if($this->uri->segment(1) && $this->uri->segment(1)=="Cancel") {?>
			                        <li class="nav-item active">
			                            <a href="<?php echo site_url('Orders/cancelOrders');?>" class="nav-link nav-toggle">
			                                <span class="title">Canceld</span> 
			                            </a>
			                        </li>
			                        <?php }else {?>
			                        <li class="nav-item">
			                            <a href="<?php echo site_url('Orders/cancelOrders');?>" class="nav-link nav-toggle">
			                                <span class="title">Canceld</span> 
			                            </a>
			                        </li>
			                        <?php }?>
			                        <?php if($this->uri->segment(1) && $this->uri->segment(1)=="Closed") {?>
			                        <!-- <li class="nav-item active">
			                            <a href="<?php echo site_url('Orders/closedOrder');?>" class="nav-link nav-toggle">
			                                <span class="title">Closed</span> 
			                            </a>
			                        </li> -->
			                        <?php }else {?>
			                        <!-- <li class="nav-item">
			                            <a href="<?php echo site_url('Orders/closedOrder');?>" class="nav-link nav-toggle">
			                                <span class="title">Closed</span> 
			                            </a>
			                        </li> -->
			                        <?php }?>
			                        <?php if($this->uri->segment(1) && $this->uri->segment(1)=="Return") {?>
			                        <li class="nav-item active">
			                            <a href="<?php echo site_url('Orders/returnOrder');?>" class="nav-link nav-toggle">
			                                <span class="title">Return</span> 
			                            </a>
			                        </li>
			                        <?php }else {?>
			                        <li class="nav-item">
			                            <a href="<?php echo site_url('Orders/returnOrder');?>" class="nav-link nav-toggle">
			                                <span class="title">Return</span> 
			                            </a>
			                        </li>
			                        <?php }?>
			                         <?php if($this->uri->segment(1) && $this->uri->segment(1)=="Refund") {?>
			                        <li class="nav-item active">
			                            <a href="<?php echo site_url('Orders/refundOrder');?>" class="nav-link nav-toggle">
			                                <span class="title">Refund</span> 
			                            </a>
			                        </li>
			                        <?php }else {?>
			                        <li class="nav-item">
			                            <a href="<?php echo site_url('Orders/refundOrder');?>" class="nav-link nav-toggle">
			                                <span class="title">Refund</span> 
			                            </a>
			                        </li>
			                        <?php }?>

			                        <?php if($this->uri->segment(1) && $this->uri->segment(1)=="deliveryBoyOrder") {?>
			                        <li class="nav-item active">
			                            <a href="<?php echo site_url('Orders/deliveryBoyOrder');?>" class="nav-link nav-toggle">
			                                <span class="title">Delivery Boy Order</span> 
			                            </a>
			                        </li>
			                        <?php }else {?>
			                        <li class="nav-item">
			                            <a href="<?php echo site_url('Orders/deliveryBoyOrder');?>" class="nav-link nav-toggle">
			                                <span class="title">Delivery Boy Order</span> 
			                            </a>
			                        </li>
			                        <?php }?>


			                         <?php if($this->uri->segment(1) && $this->uri->segment(1)=="deliveryBoySummary") {?>
			                        <li class="nav-item active">
			                            <a href="<?php echo site_url('Orders/deliveryBoySummary');?>" class="nav-link nav-toggle">
			                                <span class="title">Delivery Boy Summary</span> 
			                            </a>
			                        </li>
			                        <?php }else {?>
			                        <li class="nav-item">
			                            <a href="<?php echo site_url('Orders/deliveryBoySummary');?>" class="nav-link nav-toggle">
			                                <span class="title">Delivery Boy Summary</span> 
			                            </a>
			                        </li>
			                        <?php }?>

	                            </ul>
	                        </li> 

	                        <li class="nav-item">
	                            <a href="<?php echo site_url('Report/viewReport');?>" class="nav-link nav-toggle"> <i class="material-icons">event</i>
	                                <span class="title">Report</span> 
	                            </a>
	                        </li>

	                        <?php if($this->uri->segment(1) && $this->uri->segment(1)=="Vendor") {?>
	                          <li class="nav-item active">
	                            <a href="<?php echo site_url('Vendorinfo/vendor');?>" class="nav-link nav-toggle"> <i class="material-icons">event</i>
	                                <span class="title">Vendor</span> 
	                            </a>
	                        </li>
	                        <?php }else {?>
	                        <li class="nav-item">
	                             <a href="<?php echo site_url('Vendorinfo/vendor');?>" class="nav-link nav-toggle"> <i class="material-icons">event</i>
	                                <span class="title">Vendor</span> 
	                            </a>
	                        </li>
	                        <?php }?>


	                         <li class="nav-item">
	                            <a href="#" class="nav-link nav-toggle"><i class="material-icons">group</i>
	                            <span class="title"></span>Location<span class="arrow"></span></a>
	                            <ul class="sub-menu">
	                            	<?php if($this->uri->segment(1) && $this->uri->segment(1)=="Country") {?>
			                        <li class="nav-item active">
			                            <a href="<?php echo site_url('Country/country');?>" class="nav-link nav-toggle">
			                                <span class="title">Country</span> 
			                            </a>
			                        </li>
			                        <?php }else {?>
			                        <li class="nav-item">
			                            <a href="<?php echo site_url('Country/country');?>" class="nav-link nav-toggle">
			                                <span class="title">Country</span> 
			                            </a>
			                        </li>
			                        <?php }?>
			                        <?php if($this->uri->segment(1) && $this->uri->segment(1)=="State") {?>
			                        <li class="nav-item active">
			                            <a href="<?php echo site_url('State/state');?>" class="nav-link nav-toggle">
			                                <span class="title">State</span> 
			                            </a>
			                        </li>
			                        <?php }else {?>
			                        <li class="nav-item">
			                            <a href="<?php echo site_url('State/state');?>" class="nav-link nav-toggle">
			                                <span class="title">State</span> 
			                            </a>
			                        </li>
			                        <?php }?>
	                                 <?php if($this->uri->segment(1) && $this->uri->segment(1)=="City") {?>
			                        <li class="nav-item active">
			                            <a href="<?php echo site_url('City/city');?>" class="nav-link nav-toggle">
			                                <span class="title">City</span> 
			                            </a>
			                        </li>
			                        <?php }else {?>
			                        <li class="nav-item">
			                            <a href="<?php echo site_url('City/city');?>" class="nav-link nav-toggle">
			                                <span class="title">City</span> 
			                            </a>
			                        </li>
			                        <?php }?>
	                                <?php if($this->uri->segment(1) && $this->uri->segment(1)=="Zone") {?>
			                        <li class="nav-item active">
			                            <a href="<?php echo site_url('Zone/zone');?>" class="nav-link nav-toggle">
			                                <span class="title">Zone</span> 
			                            </a>
			                        </li>
			                        <?php }else {?>
			                        <li class="nav-item">
			                            <a href="<?php echo site_url('Zone/zone');?>" class="nav-link nav-toggle">
			                                <span class="title">Zone</span> 
			                            </a>
			                        </li>
			                        <?php }?>
			                        <?php if($this->uri->segment(1) && $this->uri->segment(1)=="Subzone") {?>
			                        <li class="nav-item active">
			                            <a href="<?php echo site_url('Subzone/subzone');?>" class="nav-link nav-toggle">
			                                <span class="title">Subzone</span> 
			                            </a>
			                        </li>
			                        <?php }else {?>
			                        <li class="nav-item">
			                            <a href="<?php echo site_url('Subzone/subzone');?>" class="nav-link nav-toggle">
			                                <span class="title">Subzone</span> 
			                            </a>
			                        </li>
			                        <?php }?>
			                        <?php if($this->uri->segment(1) && $this->uri->segment(1)=="Pincode") {?>
			                        <li class="nav-item active">
			                            <a href="<?php echo site_url('Pincode/pincode');?>" class="nav-link nav-toggle">
			                                <span class="title">Pincode</span> 
			                            </a>
			                        </li>
			                        <?php }else {?>
			                        <li class="nav-item">
			                            <a href="<?php echo site_url('Pincode/pincode');?>" class="nav-link nav-toggle">
			                                <span class="title">Pincode</span> 
			                            </a>
			                        </li>
			                        <?php }?>
	                            </ul>
	                        </li> 
	                       <?php if($this->uri->segment(1) && $this->uri->segment(1)=="Category") {?>
	                        <li class="nav-item active">
	                            <a href="<?php echo site_url('Category/category');?>" class="nav-link nav-toggle"> <i class="material-icons">event</i>
	                                <span class="title">Category</span> 
	                            </a>
	                        </li>
	                        <?php }else {?>
	                        <li class="nav-item">
	                            <a href="<?php echo site_url('Category/category');?>" class="nav-link nav-toggle"> <i class="material-icons">event</i>
	                                <span class="title">Category</span> 
	                            </a>
	                        </li>
	                        <?php }?>
	                        <?php if($this->uri->segment(1) && $this->uri->segment(1)=="Sub_cat") {?>
	                        <li class="nav-item active">
	                            <a href="<?php echo site_url('Sub_cat/sub_cat');?>" class="nav-link nav-toggle"> <i class="material-icons">event</i>
	                                <span class="title">Sub category</span> 
	                            </a>
	                        </li>
	                        <?php }else {?>
	                        <li class="nav-item">
	                            <a href="<?php echo site_url('Sub_cat/sub_cat');?>" class="nav-link nav-toggle"> <i class="material-icons">event</i>
	                                <span class="title">Sub category</span> 
	                            </a>
	                        </li>
	                        <?php }?>
	                        <?php if($this->uri->segment(1) && $this->uri->segment(1)=="Item") {?>
	                        <li class="nav-item active">
	                            <a href="<?php echo site_url('Item/item');?>" class="nav-link nav-toggle"> <i class="material-icons">event</i>
	                                <span class="title">Item</span> 
	                            </a>
	                        </li>
	                        <?php }else {?>
	                        <li class="nav-item">
	                            <a href="<?php echo site_url('Item/item');?>" class="nav-link nav-toggle"> <i class="material-icons">event</i>
	                                <span class="title">Item</span> 
	                            </a>
	                        </li>
	                        <?php }?>
	                        <?php if($this->uri->segment(1) && $this->uri->segment(1)=="Banner") {?>
	                        <li class="nav-item active">
	                            <a href="<?php echo site_url('Banner/banner');?>" class="nav-link nav-toggle"> <i class="material-icons">event</i>
	                                <span class="title">Banner</span> 
	                            </a>
	                        </li>
	                        <?php }else {?>
	                        <li class="nav-item">
	                            <a href="<?php echo site_url('Banner/banner');?>" class="nav-link nav-toggle"> <i class="material-icons">event</i>
	                                <span class="title">Banner</span> 
	                            </a>
	                        </li>
	                        <?php }?>
	                        <?php if($this->uri->segment(1) && $this->uri->segment(1)=="Popular_item") {?>
	                        <li class="nav-item active">
	                            <a href="<?php echo site_url('Popular_item/popular_item');?>" class="nav-link nav-toggle"> <i class="material-icons">event</i>
	                                <span class="title">Popular item</span> 
	                            </a>
	                        </li>
	                        <?php }else {?>
	                        <li class="nav-item">
	                            <a href="<?php echo site_url('Popular_item/popular_item');?>" class="nav-link nav-toggle"> <i class="material-icons">event</i>
	                                <span class="title">Popular item</span> 
	                            </a>
	                        </li>
	                        <?php }?>
	                        <?php if($this->uri->segment(1) && $this->uri->segment(1)=="Service_provider") {?>
	                        <li class="nav-item active">
	                            <a href="<?php echo site_url('Service_provider/service_provider');?>" class="nav-link nav-toggle"> <i class="material-icons">event</i>
	                                <span class="title">Service provider</span> 
	                            </a>
	                        </li>
	                        <?php }else {?>
	                        <li class="nav-item">
	                            <a href="<?php echo site_url('Service_provider/service_provider');?>" class="nav-link nav-toggle"> <i class="material-icons">event</i>
	                                <span class="title">Service provider</span> 
	                            </a>
	                        </li>
	                        <?php }?>
	                        <?php if($this->uri->segment(1) && $this->uri->segment(1)=="Pop_services") {?>
	                        <li class="nav-item active">
	                            <a href="<?php echo site_url('Pop_services/pop_services');?>" class="nav-link nav-toggle"> <i class="material-icons">event</i>
	                                <span class="title">Popular Services</span> 
	                            </a>
	                        </li>
	                        <?php }else {?>
	                        <li class="nav-item">
	                            <a href="<?php echo site_url('Pop_services/pop_services');?>" class="nav-link nav-toggle"> <i class="material-icons">event</i>
	                                <span class="title">Popular Services</span> 
	                            </a>
	                        </li>
	                        <?php }?>
	                        <?php if($this->uri->segment(1) && $this->uri->segment(1)=="User") {?>
	                        <li class="nav-item active">
	                             <a href="<?php echo site_url('User/user');?>" class="nav-link nav-toggle"> <i class="material-icons">event</i>
	                                <span class="title">User</span> 
	                            </a>
	                        </li>
	                        <?php }else {?>
	                        <li class="nav-item">
	                             <a href="<?php echo site_url('User/user');?>" class="nav-link nav-toggle"> <i class="material-icons">event</i>
	                                <span class="title">User</span> 
	                            </a>
	                        </li>
	                        <?php }?>
	                        <?php if($this->uri->segment(1) && $this->uri->segment(1)=="Wallet_amount") {?>
	                          <li class="nav-item active">
	                            <a href="<?php echo site_url('Wallet_amount/wallet_amount');?>" class="nav-link nav-toggle"> <i class="material-icons">event</i>
	                                <span class="title">Wallets History</span> 
	                            </a>
	                        </li>
	                        <?php }else {?>
	                        <li class="nav-item">
	                             <a href="<?php echo site_url('Wallet_amount/wallet_amount');?>" class="nav-link nav-toggle"> <i class="material-icons">event</i>
	                                <span class="title">Wallets History</span> 
	                            </a>
	                        </li>
	                        <?php }?>
	                        <?php if($this->uri->segment(1) && $this->uri->segment(1)=="transaction") {?>
	                          <li class="nav-item active">
	                            <a href="<?php echo site_url('Transaction/transaction');?>" class="nav-link nav-toggle"> <i class="material-icons">event</i>
	                                <span class="title">Transaction History</span> 
	                            </a>
	                        </li>
	                        <?php }else {?>
	                        <li class="nav-item">
	                             <a href="<?php echo site_url('Transaction/transaction');?>" class="nav-link nav-toggle"> <i class="material-icons">event</i>
	                                <span class="title">Transaction History</span> 
	                            </a>
	                        </li>
	                        <?php }?>

	                        <li class="nav-item">
	                            <a href="#" class="nav-link nav-toggle"><i class="material-icons">group</i>
	                            <span class="title"></span>Invoice<span class="arrow"></span></a>
	                            <ul class="sub-menu">
			                        <li class="nav-item active">
			                            <a href="<?php echo site_url('Invoice/sellerInvoice');?>" class="nav-link nav-toggle">
			                                <span class="title">Seller Invoice</span> 
			                            </a>
			                        </li>
			                        <li class="nav-item">
			                            <a href="<?php echo site_url('Invoice/SearchInvoice');?>" class="nav-link nav-toggle">
			                                <span class="title">Customer Invoice</span> 
			                            </a>
			                        </li>
	                            </ul>
	                        </li>

	                        <li class="nav-item active">
	                            <a href="<?php echo site_url('User/UserLastOrder');?>" class="nav-link nav-toggle"> <i class="material-icons">event</i>
	                                <span class="title">Last Orders</span> 
	                            </a>
	                        </li>

	                         <?php if($this->uri->segment(1) && $this->uri->segment(1)=="Push_Notification") {?>
	                          <li class="nav-item active">
	                            <a href="<?php echo site_url('Notification/push_notification');?>" class="nav-link nav-toggle"> <i class="material-icons">event</i>
	                                <span class="title">Push Notification</span> 
	                            </a>
	                        </li>
	                        <?php }else {?>
	                        <li class="nav-item">
	                             <a href="<?php echo site_url('Notification/push_notification');?>" class="nav-link nav-toggle"> <i class="material-icons">event</i>
	                                <span class="title">Push Notification</span> 
	                            </a>
	                        </li>
	                        <?php }?>

	                        <?php if($this->uri->segment(1) && $this->uri->segment(1)=="") {?>
	                          <li class="nav-item active">
	                            <a href="<?php echo site_url('Item/Add_SingleImage');?>" class="nav-link nav-toggle"> <i class="material-icons">event</i>
	                                <span class="title"> Promotion Image</span> 
	                            </a>
	                        </li>
	                        <?php }else {?>
	                        <li class="nav-item">
	                             <a href="<?php echo site_url('Item/Add_SingleImage');?>" class="nav-link nav-toggle"> <i class="material-icons">event</i>
	                                <span class="title">Promotion Image</span> 
	                            </a>
	                        </li>
	                        <?php }?>


	                        <?php if($this->uri->segment(1) && $this->uri->segment(1)=="Vendor") {?>
	                          <li class="nav-item active">
	                            <a href="<?php echo site_url('Coupon/ViewCoupon');?>" class="nav-link nav-toggle"> <i class="material-icons">event</i>
	                                <span class="title">Coupon</span> 
	                            </a>
	                        </li>
	                        <?php }else {?>
	                        <li class="nav-item">
	                            <a href="<?php echo site_url('Coupon/ViewCoupon');?>" class="nav-link nav-toggle"> <i class="material-icons">event</i>
	                                <span class="title">Coupon</span> 
	                            </a>
	                        </li>
	                        <?php }?>


	         




	                       
<?php } else{ ?>

<li class="nav-item active">
<a href="<?php echo site_url('Welcome/dashboard');?>" class="nav-link nav-toggle">
<i class="material-icons">dashboard</i>
<span class="title">Dashboard</span>
</a>
</li>

<li class="nav-item active">
<a href="<?php echo site_url('User/UserLastOrder');?>" class="nav-link nav-toggle"> <i class="material-icons">event</i>
<span class="title">Last Orders</span>
</a>
</li>

<li class="nav-item active">
<a href="<?php echo site_url('Notification/push_notification');?>" class="nav-link nav-toggle"> <i class="material-icons">event</i>
<span class="title">Push Notification</span>
</a>
</li>

<li class="nav-item">
<a href="#" class="nav-link nav-toggle"><i class="material-icons">group</i>
<span class="title"></span>Orders<span class="arrow"></span></a>
<ul class="sub-menu">
<?php if($this->uri->segment(1) && $this->uri->segment(1)=="Pending") {?>
<li class="nav-item active">
<a href="<?php echo site_url('Orders/pending');?>" class="nav-link nav-toggle">
<span class="title">Upcoming</span>
</a>
</li>
<?php }else {?>
<li class="nav-item">
<a href="<?php echo site_url('Orders/pending');?>" class="nav-link nav-toggle">
<span class="title">Upcoming</span>
</a>
</li>
<?php }?>
<?php if($this->uri->segment(1) && $this->uri->segment(1)=="Accept") {?>
<!-- <li class="nav-item active">
<a href="<?php echo site_url('Orders/accept');?>" class="nav-link nav-toggle">
<span class="title">Dispatch</span>
</a>
</li> -->
<?php }else {?>
<!--  <li class="nav-item">
<a href="<?php echo site_url('Orders/accept');?>" class="nav-link nav-toggle">
<span class="title">Dispatch</span>
</a>
</li> -->
<?php }?>
<!--  <?php if($this->uri->segment(1) && $this->uri->segment(1)=="City") {?>
<li class="nav-item active">
<a href="<?php echo site_url('Orders/usercancelOrder');?>" class="nav-link nav-toggle">Userside Delete</span>
</a>
</li>
<?php }else {?>
<li class="nav-item">
<a href="<?php echo site_url('Orders/usercancelOrder');?>" class="nav-link nav-toggle">
<span class="title">Userside Delete</span>
</a>
</li>
<?php }?> -->
<?php if($this->uri->segment(1) && $this->uri->segment(1)=="Dispatch") {?>
<li class="nav-item active">
<a href="<?php echo site_url('Orders/dispatch');?>" class="nav-link nav-toggle">
<span class="title">Dispatch</span>
</a>
</li>
<?php }else {?>
<li class="nav-item">
<a href="<?php echo site_url('Orders/dispatch');?>" class="nav-link nav-toggle">
<span class="title">Dispatch</span>
</a>
</li>
<?php }?>
<?php if($this->uri->segment(1) && $this->uri->segment(1)=="Deliverd") {?>
<li class="nav-item active">
<a href="<?php echo site_url('Orders/deliverdOrder');?>" class="nav-link nav-toggle">
<span class="title">Delivered</span>
</a>
</li>
<?php }else {?>
<li class="nav-item">
<a href="<?php echo site_url('Orders/deliverdOrder');?>" class="nav-link nav-toggle">
<span class="title">Delivered</span>
</a>
</li>
<?php }?>
<?php if($this->uri->segment(1) && $this->uri->segment(1)=="Cancel") {?>
<li class="nav-item active">
<a href="<?php echo site_url('Orders/cancelOrders');?>" class="nav-link nav-toggle">
<span class="title">Canceld</span>
</a>
</li>
<?php }else {?>
<li class="nav-item">
<a href="<?php echo site_url('Orders/cancelOrders');?>" class="nav-link nav-toggle">
<span class="title">Canceld</span>
</a>
</li>
<?php }?>
<?php if($this->uri->segment(1) && $this->uri->segment(1)=="Closed") {?>
<!-- <li class="nav-item active">
<a href="<?php echo site_url('Orders/closedOrder');?>" class="nav-link nav-toggle">
<span class="title">Closed</span>
</a>
</li> -->
<?php }else {?>
<!-- <li class="nav-item">
<a href="<?php echo site_url('Orders/closedOrder');?>" class="nav-link nav-toggle">
<span class="title">Closed</span>
</a>
</li> -->
<?php }?>
<?php if($this->uri->segment(1) && $this->uri->segment(1)=="Return") {?>
<li class="nav-item active">
<a href="<?php echo site_url('Orders/returnOrder');?>" class="nav-link nav-toggle">
<span class="title">Return</span>
</a>
</li>
<?php }else {?>
<li class="nav-item">
<a href="<?php echo site_url('Orders/returnOrder');?>" class="nav-link nav-toggle">
<span class="title">Return</span>
</a>
</li>
<?php }?>
<?php if($this->uri->segment(1) && $this->uri->segment(1)=="Refund") {?>
<li class="nav-item active">
<a href="<?php echo site_url('Orders/refundOrder');?>" class="nav-link nav-toggle">
<span class="title">Refund</span>
</a>
</li>
<?php }else {?>
<li class="nav-item">
<a href="<?php echo site_url('Orders/refundOrder');?>" class="nav-link nav-toggle">
<span class="title">Refund</span>
</a>
</li>
<?php }?>
    <?php if($this->uri->segment(1) && $this->uri->segment(1)=="deliveryBoyOrder") {?>
            <li class="nav-item active">
                <a href="<?php echo site_url('Orders/deliveryBoyOrder');?>" class="nav-link nav-toggle">
                    <span class="title">Delivery Boy Order</span> 
                </a>
            </li>
            <?php }else {?>
            <li class="nav-item">
                <a href="<?php echo site_url('Orders/deliveryBoyOrder');?>" class="nav-link nav-toggle">
                    <span class="title">Delivery Boy Order</span> 
                </a>
            </li>
            <?php }?>


             <?php if($this->uri->segment(1) && $this->uri->segment(1)=="deliveryBoySummary") {?>
            <li class="nav-item active">
                <a href="<?php echo site_url('Orders/deliveryBoySummary');?>" class="nav-link nav-toggle">
                    <span class="title">Delivery Boy Summary</span> 
                </a>
            </li>
            <?php }else {?>
            <li class="nav-item">
                <a href="<?php echo site_url('Orders/deliveryBoySummary');?>" class="nav-link nav-toggle">
                    <span class="title">Delivery Boy Summary</span> 
                </a>
            </li>
       <?php }?> 


</ul>
</li>


<?php } ?>
	                       
	                    </ul>
	                </div>
                </div>
            </div>
            <!-- end sidebar menu --> 
