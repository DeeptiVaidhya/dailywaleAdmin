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
      <?php echo $this->session->flashdata('sucessuser');?>
      <?php echo $this->session->flashdata('updateuser');?>
      <?php echo $this->session->flashdata('deleteuser');?>  
      <div class="row">
         <div class="col-md-12">
            <div class="tabbable-line">
               </ul>
               <div class="row">
                  <div class="col-md-12">
                     <div class="card card-box">
                        <div class="card-head">
                           <header>All Vendor</header>
                        </div>
                        <div class="card-body ">
                           <div class="row">
                              <div class="col-md-12 col-sm-12 col-12">
                                 <div class="btn-group pull-right">
                                    <a href="<?php echo site_url('Vendorinfo/vendorAdd');?>" id="addRow" class="btn btn-info">
                                    Add New Vendor <i class="fa fa-plus"></i>
                                    </a>
                                 </div>
                              </div>
                            
                           <div class="table-scrollable">
                              <table class="table table-striped table-bordered table-hover table-checkable order-column valign-middle" id="example4">
                                 <thead>
                                    <tr>
                                       <th>Id</th>
                                       <th>Name</th>
                                       <th>Address</th>
                                       <th>Email</th>
                                       <th>Password</th>
                                       <th>Phon no.</th>
                                       <th>Wallet Amount</th>
                                        <th>Action</th>  
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php 
                                       $i=0;
                                       foreach($vendor as $row){
                                        $i++;
                                        ?>
                                    <tr class="odd gradeX">
                                       <td class="left"><?php echo $i;?></td>
                                       <td class="left"><?php echo ucwords($row['name']);?></td>
                                       <td class="left"><?php echo ucwords($row['address']);?></td>
                                       <td class="left"><?php echo ucwords($row['email']);?></td>
                                       <td class="left"><?php echo $row['pwd'];?></td>
                                       <td class="left"><?php echo $row['phone'];?></td>
                                       <td class="left"><?php echo $row['wallet_amount'];?></td>

                                      <!--  <td class="left"><?php $date=$row['created_at']; echo date('d-m-Y', strtotime($date));?></td>
                                       <td class="left"><?php $date=$row['updated_at']; echo date('d-m-Y', strtotime($date));?></td> -->
                                     
                                       <td style="width:106px;">  
                                      </a> 
                                       <a href="<?php echo site_url('Vendorinfo/vendorProfile/').$row['id'];?>" class="btn btn-danger btn-xs">
                                       <i class="fa fa-eye"></i>
                                       </a>
                                       <a href="<?php echo site_url('Vendorinfo/editvendor/').$row['id'];?>" class="btn btn-primary btn-xs">
                                       <i class="fa fa-pencil"></i>
                                       </a> 
                                       <a href="<?php echo site_url('Vendorinfo/wallet_crdr/').$row['id'];?>"  style="float: right;margin: -2%;    margin-top: 1%;">
                                       <!-- <i class="fa fa-plus"></i> -->
                                       <img src="<?php echo base_url()?>uploads/wallet.png" alt="" width="20px;" />
                                       </a>
                                   
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