
			<!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Dashboard</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="index.html">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Dashboard</li>
                            </ol>
                        </div>
                    </div>
                   <!-- start widget -->
					<div class="state-overview">
							<div class="row">
						        <div class="col-xl-3 col-md-6 col-12">
						          <div class="info-box bg-b-green">
						            <span class="info-box-icon push-bottom"><i class="material-icons">group</i></span>
						            <div class="info-box-content">
						              <span class="info-box-text">Country</span>
						              <span class="info-box-number"><?php if($user){
						              	echo $user;}else{echo '0';}?></span>						
						            </div>
						            <!-- /.info-box-content -->
						          </div>
						          <!-- /.info-box -->
						        </div>
						        <!-- /.col -->
						        <div class="col-xl-3 col-md-6 col-12">
						          <div class="info-box bg-b-yellow">
						            <span class="info-box-icon push-bottom"><i class="material-icons">person</i></span>
						            <div class="info-box-content">
						              <span class="info-box-text">State</span>
						              <span class="info-box-number"><?php if($state){
						              	echo $state;}else{echo '0';}?></span>
						              
						            </div>
						            <!-- /.info-box-content -->
						          </div>
						          <!-- /.info-box -->
						        </div>
						        <!-- ............................. -->
						         <div class="col-xl-3 col-md-6 col-12">
						          <div class="info-box bg-b-yellow">
						            <span class="info-box-icon push-bottom"><i class="material-icons">person</i></span>
						            <div class="info-box-content">
						              <span class="info-box-text">City</span>
						              <span class="info-box-number"><?php if($city){
						              	echo $city;}else{echo '0';}?></span>
						             
						            </div>
						            <!-- /.info-box-content -->
						          </div>
						          <!-- /.info-box -->
						        </div>
						        <!-- /.col -->
						        <div class="col-xl-3 col-md-6 col-12">
						          <div class="info-box bg-b-blue">
						            <span class="info-box-icon push-bottom"><i class="material-icons">school</i></span>
						            <div class="info-box-content">
						              <span class="info-box-text">Zone</span>
						              <span class="info-box-number"><?php if($zone){
						              	echo $zone;}else{echo '0';}?></span>
						              
						            </div>
						            <!-- /.info-box-content -->
						          </div>
						          <!-- /.info-box -->
						        </div>
						        <!-- /.col -->
						        <div class="col-xl-3 col-md-6 col-12">
						          <div class="info-box bg-b-pink">
						            <span class="info-box-icon push-bottom"><i class="material-icons">monetization_on</i></span>
						            <div class="info-box-content">
						              <span class="info-box-text">Subzone</span>
						              <span class="info-box-number"><?php if($subzone){
						              	echo $subzone;}else{echo '0';}?></span><span></span>
						            </div>				
						        </div>						  
						    </div>

						     <div class="col-xl-3 col-md-6 col-12">
						          <div class="info-box bg-b-blue">
						            <span class="info-box-icon push-bottom"><i class="material-icons">school</i></span>
						            <div class="info-box-content">
						              <span class="info-box-text">Category</span>
						              <span class="info-box-number"><?php if($category){
						              	echo $category;}else{echo '0';}?></span>
						              
						            </div>
						          </div>
						        </div>

						        <div class="col-xl-3 col-md-6 col-12">
						          <div class="info-box bg-b-blue">
						            <span class="info-box-icon push-bottom"><i class="material-icons">school</i></span>
						            <div class="info-box-content">
						              <span class="info-box-text">Subcategoy</span>
						              <span class="info-box-number"><?php if($sub_cat){
						              	echo $sub_cat;}else{echo '0';}?></span>
						              
						            </div>
						          </div>
						       </div>
						        
						         <div class="col-xl-3 col-md-6 col-12">
						          <div class="info-box bg-b-blue">
						            <span class="info-box-icon push-bottom"><i class="material-icons">school</i></span>
						            <div class="info-box-content">
						              <span class="info-box-text">Item</span>
						              <span class="info-box-number"><?php if($item){
						              	echo $item;}else{echo '0';}?></span>
						            </div>
						          </div>
						        </div> 

						         <div class="col-xl-3 col-md-6 col-12">
						          <div class="info-box bg-b-blue">
						            <span class="info-box-icon push-bottom"><i class="material-icons">school</i></span>
						            <div class="info-box-content">
						              <span class="info-box-text">Banner</span>
						              <span class="info-box-number"><?php if($banner){
						              	echo $banner;}else{echo '0';}?></span>
						            </div>
						         </div>
						      </div>  
						      <div class="col-xl-3 col-md-6 col-12">
						          <div class="info-box bg-b-blue">
						            <span class="info-box-icon push-bottom"><i class="material-icons">school</i></span>
						            <div class="info-box-content">
						              <span class="info-box-text">Popular Item</span>
						              <span class="info-box-number"><?php if($pop_items){
						              	echo $pop_items;}else{echo '0';}?></span>
						            </div>
						         </div>
						      </div>  
                        </div>
                    </div>
                 </div>
            </div>     
            <!-- end chat sidebar -->
        </div>
        <!-- end page container -->
      