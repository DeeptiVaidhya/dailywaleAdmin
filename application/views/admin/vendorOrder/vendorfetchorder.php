                           <div class="table-scrollable">
                              <table class="table table-striped table-bordered table-hover table-checkable order-column valign-middle" id="example4">
                                 <thead>
                                    <tr>
                                       <th>Name</th>
                                       <th>Email</th>
                                       <th>Address</th>
                                       <th>Item name</th>
                                      
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php 
                                       $i=0;
                                       foreach($data as $row){
                                        $i++;
                                        ?>
                                    <tr class="odd gradeX">
                                       <td class="left"><?php echo $row['name'];?></td>
                                       <td class="left"><?php echo $row['email'];?></td>
                                       <td class="left"><?php echo $row['address'];?></td>
                                       <?php 
                                       $wheredata=array('item_id'=>$row['item_id']);
                                       $result=$this->Model->selectdata('item',$wheredata);
                                       foreach ($result as $value) {
                                          $itemname=$value['item_name'];
                                          $itemid=$value['item_id'];
                                       }

                                       ?>
                                       <td class="left"><?php if($itemid==$row['item_id']){echo $itemname; };?></td>
                                    </tr>
                                    <?php } ?>
                                 </tbody>
                              </table>
                           </div>