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
                           <header>All Wallets History</header>
                        </div>
                       <!--  <div class="card-body ">
                           <div class="row">
                              <div class="col-md-12 col-sm-12 col-12">
                                 <div class="btn-group pull-right">
                                    <a href="<?php echo site_url('User/userAdd');?>" id="addRow" class="btn btn-info">
                                    Add New Wallet Amount <i class="fa fa-plus"></i>
                                    </a>
                                 </div>
                              </div> -->
                            
                           <div class="table-scrollable">
                              <table class="table table-striped table-bordered table-hover table-checkable order-column valign-middle" id="example4">
                                 <thead>
                                    <tr>
                                       <th>Id</th>
                                       <th>Name</th>
                                       <th>Mobile No.</th>
                                       <th>Wallet Amount</th>
                                       <th>Last Transection</th>
                                       <th>Action</th>
                                        
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php 
                                       $i=0;
                                       foreach($wallet as $row){
                                           $results = $this->db->query("SELECT * FROM transaction WHERE user_id = '".$row['user_id']."' ORDER BY trans_id DESC LIMIT 0,1")->result_array();
                                            //print_r($results); 

                                          
                                           // $originalDate = $results[0]['date_time'];
                                           // $transaction_date = date("Y-m-d", strtotime($originalDate));  
                                           // $transaction_date = $results[0]['date_time'];

                                        $i++;
                                        ?>
                                    <tr class="odd gradeX">
                                       <td class="left"><?php echo $row['user_id'];?></td>
                                       <td class="left"><?php echo ucwords($row['fname'])." ".ucwords($row['lname']);?></td>
                                       <td class="left"><?php echo ucwords($row['user_mobile']);?></td>
                                       <td class="left"><?php echo $row['wallet_amount'];?></td>
                                       <td class="left">
                                          <?php
                                          if (empty($results)) {
                                             echo 'Order not start yet';
                                          }else{
                                           echo '<i class="fa fa-inr"></i> '. $results[0]['amount'] .' Pay By - ('. $results[0]['pay_by'] .') On Date : '. $transaction_date = date("Y-m-d", strtotime($results[0]['date_time']));
                                          }
                                          ?>
                                       </td>
                                       <td>   
                                       <a href="<?php echo site_url('Wallet_amount/walletAdd/').$row['user_id'];?>" class="btn btn-primary btn-xs">
                                       <i class="fa fa-plus"></i>
                                       </a> 
                                       <a href="<?php echo site_url('User/viewrecord/').$row['user_id'];?>" class="btn btn-danger btn-xs">
                                       <i class="fa fa-eye"></i>
                                       </a>
                                       <!-- <a href="<?php echo site_url('User/deleterecord/').$row['user_id'];?>/user/User" class="btn btn-danger btn-xs" onclick="return conformDelete()">
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