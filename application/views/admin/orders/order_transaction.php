<!--start page content -->
<div class="page-content-wrapper">
   <div class="page-content">
      <div class="page-bar">
         <div class="page-title-breadcrumb">
            <div class=" pull-left">
              <!--  <div class="page-title">User List</div> -->
            </div>
         </div>
      </div>
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
                           <div class="table-scrollable">
                              <table class="table table-striped table-bordered table-hover table-checkable order-column valign-middle" id="example4">
                                 <thead>
                                    <tr>
                                       <th>Trans Id</th>
                                       <th>Name</th>
                                      <!--  <th>Amount</th> -->
                                      <!--  <th>Pay By</th> -->
                                       <th>Type</th>
                                       <th>Date</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php 
                                       $i=0;
                                       foreach($transaction as $row){
                                           $results = $this->db->query("SELECT * FROM transaction WHERE user_id = '".$row['user_id']."' ORDER BY trans_id DESC LIMIT 0,1")->result_array();
                                        $i++;
                                        ?>
                                    <tr class="odd gradeX">
                                      <td class="left"><?php echo $row['trans_id'];?></td>
                                        <td class="left"><?php
                                          $where = array('user_id' =>$row['user_id']);
                                          $user = $this->Model->selectAllById('user',$where);?>
                                          <?php echo $user->fname.' '.$user->lname ?></td>
                                      <!--  <td class="left"><?php echo ucwords($row['amount']);?></td> -->
                                      <!--  <td class="left"><?php echo ucwords($row['pay_by']);?></td> -->
                                       <td class="left"><?php echo ucwords($row['detail']);?></td>
                                       <!-- <td class="left"><?php echo date("Y-m-d", strtotime($results[0]['date_time']));?></td> -->
                                       <td class="left">
                                          <?php
                                          if (empty($results)) {
                                             echo 'Order not start yet';
                                          }else{
                                           echo '<i class="fa fa-inr"></i> '. $results[0]['amount'] .' Pay By - ('. $results[0]['pay_by'] .') On Date : '. $transaction_date = date("Y-m-d", strtotime($results[0]['date_time']));
                                          }
                                          ?>
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