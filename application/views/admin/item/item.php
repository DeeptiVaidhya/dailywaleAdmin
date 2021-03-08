start page content -->
<div class="page-content-wrapper">
   <div class="page-content">
      <div class="page-bar">
         <div class="page-title-breadcrumb">
            <div class=" pull-left">
              <!--  <div class="page-title">Category List</div> -->
            </div>
            <!-- <ol class="breadcrumb page-breadcrumb pull-right">
               <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo site_url('welcome/dashboard');?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
               </li>
               <li class="active">Category List</li>
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
                  
                     <?php 
                        for ($i=0; $i <=$item_count ; $i++) {
                              $number=$i*500;
                          ?>
                           
                           <div class="col-md-1 col-sm-1 col-1" style="float:left;">
                              <div class="btn-group">
                                 <a href="<?php echo site_url('Item/itemPagination/'.$number);?>" id="addRow" class="btn btn-info">
                                 Page <?php echo $i;?></i>
                                 </a>
                              </div>
                           </div>
                     <?php } ?>
                     <div class="col-md-12">
                     <div class="card card-box">
                        <div class="card-head">
                           <header>All Item</header>
                        </div>
                        <div class="card-body ">
                           <div class="row">

                              <div class="col-md-12 col-sm-12 col-12">
                                 <div class="btn-group pull-right">
                                    <a href="<?php echo site_url('Item/item_Add');?>" id="addRow" class="btn btn-info">
                                    Add Item Category <i class="fa fa-plus"></i>
                                    </a>
                                 </div>
                              </div>
                            
                           <div class="table-scrollable">
                              <table class="table table-striped table-bordered table-hover table-checkable order-column valign-middle" id="example4">
                                 <thead>
                                   <tr>
                                       <th>Id</th>
                                       <th>Item Name</th>
                                       <th>Vendor</th>
                                       <th>Sub Catgory</th>
                                       <th>Image</th>
                                       <th>Description</th>
                                       <th>Quantity Desc</th>
                                       <th>Price</th>
                                       <th>Item Discount</th>
                                       <th>Customer Packaging</th>
                                       <th>Customer Delivery</th>
                                       <th>Customer Tax</th>
                                       <th>Seller Packaging</th>
                                       <th>Seller Delivery</th>
                                       <th>Schedule</th> 
                                       <th>Delivery Days</th> 
                                       <th>CGSTIN</th>
                                       <th>SGSTIN</th>
                                       <th>Remark</th>
                                       <th>Unit</th>
                                       <th>Out of Stock</th>
                                       <th>Online</th>
                                       <th>Available(6 to 12)</th> 
                                       <th> Action </th>  
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php 
                                       $i=0;
                                       foreach($item as $row){
                                        $i++;
                                        ?>
                                   <tr class="odd gradeX">
                                       <td class="left"><?php echo $row['item_id'];?></td>

                                       <td class="left"><?php echo ucwords($row['item_name']);?></td>
                                       <td class="left"><?php echo $row['name'];?></td> 
                                       <td class="left"><?php echo ucwords($row['sub_cat_name']);?></td>
                                    
                                       <td class="left"><center>
                                       <?php if($row['item_images'] == ''){ ?>
                                          <img src="<?php echo base_url()?>/uploads/user/thumnail.png" height="50px;" width="50px">
                                       <?php }else{?>
                                          <img src="<?php echo base_url()?>/uploads/user/<?php echo $row['item_images'];?>" height="50px;" width="50px">
                                       <?php } ?>   
                                       </center></td>

                                       <td class="left"><?php echo $row['item_desc'];?></td>
                                       <td class="left"><?php echo $row['item_quantity_desc'];?></td>
                                       <td class="left"><?php echo $row['item_price'];?></td>
                                       <td class="left"><?php echo $row['item_discount'];?></td>
                                       <td class="left"><?php echo $row['packaging'];?></td>
                                       <td class="left"><?php echo $row['delivery'];?></td>
                                       <td class="left"><?php echo $row['tax'];?></td>
                                       <td class="left"><?php echo $row['seller_packaging'];?></td>
                                       <td class="left"><?php echo $row['seller_delivery'];?></td>
                                       <td class="left"><?php if($row['is_schedule']==0){ echo'yes'; }else{ echo 'No'; }?></td>
                                       <td class="left"><?php echo $row['delivery_days'];?></td>
                                       <td class="left"><?php echo $row['cgstin'];?></td>
                                       <td class="left"><?php echo $row['sgstin'];?></td>
                                       <td class="left"><?php echo $row['remark'];?></td>
                                       <td class="left"><?php echo $row['item_unit'];?></td>
                                       <td class="left"><?php if($row['is_out_of_stock']==0){ echo'yes'; }else{ echo 'No'; }?></td>
                                       <?php 
                                          if ($row['is_online']=='yes') { ?>
                                             <td class="left"><a href="<?php echo site_url('Item/user_active/')?><?php echo $row['item_id']; ?>" value="<?php echo $row['is_online'];?>" class='btn btn-primary' style="margin: 0px 0px 0px 10px;">Online</a></td>
                                          <?php }else{ ?>
                                              <td class="left"><a href="<?php echo site_url('Item/user_deactive/')?><?php echo $row['item_id']; ?>" value="<?php echo $row['is_online'];?>" class='btn btn-danger'  style="margin: 0px 0px 0px 10px;">Offline</a></td>
                                          <?php }
                                       ?>
                                        <td class="left"><?php echo $row['is_available_six_to_twl'];?></td> 
                                       <td>
                                       <a href="<?php echo site_url('Item/edit_item/').$row['item_id'];?>" class="btn btn-primary btn-xs">
                                       <i class="fa fa-pencil"></i>
                                       </a> 
                                       <a href="<?php echo site_url('Item/item_Add/').$row['item_id'];?>" class="btn btn-primary btn-xs">
                                       <i class="fa fa-copy"></i>
                                       </a>
                                    
                                       <!-- <a href="<?php echo site_url('Item/deleterecord/').$row['item_id'];?>/item/Item" class="btn btn-danger btn-xs" onclick="return conformDelete()">
                                       <i class="fa fa-trash-o "></i>
                                       </a> -->
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