                           <div class="table-scrollable">
                              <table class="table table-striped table-bordered table-hover table-checkable order-column valign-middle" id="example4">
                                 <thead>
                                    <tr>
                                       <th>Order Id</th>
                                       <th>Zone name</th>
                                       <th>Name</th>
                                    
                                      
                                       
                                      
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php 
                                       $i=0;
                                       foreach($data as $row){
                                        $i++;
                                        ?>
                                    <tr class="odd gradeX">
                                       <td class="left"><?php echo $row['order_id'];?></td>
                                       
                                       
                                      <!--  <td class="left"><?php echo $row['address'];?></td> -->
                                       <?php 
                                       $wheredata=array('zone_id'=>$row['zone']);
                                       $result=$this->Model->selectdata('zone',$wheredata);
                                       foreach ($result as $value) {
                                          $zonename=$value['zone_name'];
                                          $zoneid=$value['zone_id'];
                                       }
                                       ?>
                                       <td class="left"><?php if($zoneid==$row['zone']){echo $zonename; };?></td>
                                       <td class="left"><?php echo $row['name'];?></td>
                                      <!--  <td class="left"><?php echo $row['qty'];?></td>
                                       <td class="left"><?php echo $row['price'];?></td> -->
                                    </tr>
                                    <?php } ?>
                                 </tbody>
                              </table>
                           </div>