<!--start page content -->
<div class="page-content-wrapper">
   <div class="page-content">
      <div class="page-bar">
         <div class="page-title-breadcrumb">
            <div class=" pull-left">
              <!--  <div class="page-title">User List</div> -->
            </div>
           <!--  <ol class="breadcrumb page-breadcrumb pull-right">
               <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo site_url('welcome/dashboard');?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
               </li>
               <li class="active">User List</li>
            </ol> -->
         </div>
      </div>
      <?php echo $this->session->flashdata('sucesscoupon');?>
      <?php echo $this->session->flashdata('updatecoupon');?>
      <?php echo $this->session->flashdata('deletecouponr');?>  
      <div class="row">
         <div class="col-md-12">
            <div class="tabbable-line">
               </ul>
               <div class="row">
                  <div class="col-md-12">
                     <div class="card card-box">
                        <div class="card-head">
                           <header>All Coupons</header>
                        </div>
                        <div class="card-body ">
                           <div class="row">
                              <div class="col-md-12 col-sm-12 col-12">
                                 <div class="btn-group pull-right">
                                    <a href="<?php echo site_url('Coupon/CreateCoupon');?>" id="addRow" class="btn btn-info">
                                    Add New Coupon <i class="fa fa-plus"></i>
                                    </a>
                                 </div>
                              </div>
                            
                           <div class="table-scrollable">
                              <table class="table table-striped table-bordered table-hover table-checkable order-column valign-middle" id="example4">
                                 <thead>
                                    <tr>
                                       <th>S.NO</th>
                                       <th>Coupon Code</th>
                                       <th>Is One Time</th>
                                       <th>No Of User</th>
                                       <th>Started at</th>
                                       <th>Valid at</th>
                                       <th>Percentage</th>
                                       <th>Max Amount</th>
                                       <th>Is Rand</th>
                                       <th>Min Cart Amount</th>
                                       <th>Action</th>  
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php 
                                       $i=0;
                                       foreach($coupon_list as $row){
                                        $i++;
                                        ?>
                                    <tr class="odd gradeX">
                                       <td class="left"><?php echo $i;?></td>
                                       <td class="left"><?php echo $row['coupon_code'];?></td>
                                       <td class="left"><?php echo $row['is_one_time'];?></td>
                                       <td class="left"><?php echo $row['no_of_user'];?></td>
                                       <td class="left"><?php echo $row['started_at'];?></td>
                                       <td class="left"><?php echo $row['valid_at'];?></td>
                                       <td class="left"><?php echo $row['percentage'];?></td>
                                       <td class="left"><?php echo $row['max_amount'];?></td>
                                       <td class="left"><?php echo $row['is_rand'];?></td>
                                       <td class="left"><?php echo $row['min_cart_amount'];?></td>

                                      <!--  <td class="left"><?php $date=$row['created_at']; echo date('d-m-Y', strtotime($date));?></td>
                                       <td class="left"><?php $date=$row['updated_at']; echo date('d-m-Y', strtotime($date));?></td> -->
                                     
                                       <td style="width:106px;">  
                                      </a> 
                                      <!--  <a href="<?php // echo site_url('Vendorinfo/vendorProfile/').$row['id'];?>" class="btn btn-danger btn-xs">
                                       <i class="fa fa-eye"></i>
                                       </a> -->
                                       <a href="<?php echo site_url('Coupon/editCoupon/').$row['coupon_id'];?>" class="btn btn-primary btn-xs">
                                       <i class="fa fa-pencil"></i>
                                       </a> 
                                     <!--   <a href="<?php // echo site_url('Vendorinfo/wallet_crdr/').$row['id'];?>"  style="float: right;margin: -2%;    margin-top: 1%;">
                                       <i class="fa fa-plus"></i>
                                       <img src="<?php // echo base_url()?>uploads/wallet.png" alt="" width="20px;" />
                                       </a> -->
                                   
                                       <!-- <a href="<?php // echo site_url('Vendorinfo/deleterecord/').$row['id'];?>/vendor/vendor" class="btn btn-danger btn-xs" onclick="return conformDelete()">
                                       <i class="fa fa-trash-o "></i>
                                       </a>  -->
                                       </td> 
                                       </td>
                                    </tr>
                                    <?php } ?>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- end page content