<!-- start page content -->
<div class="page-content-wrapper">
   <div class="page-content">
      <div class="tabbable-line">
               <div class="row">
                  <div class="col-md-12">
                     <div class="card card-box">
                        <div class="card-head">
                           <header>All Wallet History</header>
                           
                        </div>
                        <div class="card-body ">  
                           <div class="table-scrollable">
                              <table class="table table-striped table-bordered table-hover table-checkable order-column valign-middle" id="example4">
                                 <thead>
                                    <tr>
                                       <th>S. No.</th>
                                       <th>Discription</th>
                                       <th>Date time</th>
                                       <th>Amount</th> 
                                     </tr>
                                 </thead>
                                 <tbody>                            
                                   
                                    <?php 
                                       $i=0;
                                       foreach($payment as $row){ 
                                       $i++;
                                    ?>
                                    <tr class="odd gradeX"  >
                                       <td class="left"><?php echo $i;?></td>
                                       <td class="left"> <?php echo ucwords($row['discription']);?></td>
                                       <td class="left"> <?php echo ucwords($row['date_time']);?></td>                      
                                       <td class="left"><i class="fa fa-inr"></i> <?php echo ucwords($row['amount']);?> / -</td> 
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
