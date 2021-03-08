<!-- start page content  -->
<div class="page-content-wrapper">
   <div class="page-content">
      <div class="page-bar">
         <div class="page-title-breadcrumb">
            <div class=" pull-left">
               <div class="page-title">Item List</div>
            </div>
            <ol class="breadcrumb page-breadcrumb pull-right">
               <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo site_url('welcome/dashboard');?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
               </li>
               <li class="active">Item List</li>
            </ol>
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
                           <header>All Item</header>
                        </div>
                        <div class="card-body ">
                           <div class="row">
                              <!-- <div class="col-md-12 col-sm-12 col-12">
                                 <div class="btn-group pull-right">
                                    <a href="<?php echo site_url('Vendor/item_Add');?>" id="addRow" class="btn btn-info">
                                    Add Item Category <i class="fa fa-plus"></i>
                                    </a>
                                 </div>
                              </div> -->
                            
                           <div class="table-scrollable">
                              <table class="table table-striped table-bordered table-hover table-checkable order-column valign-middle" id="example4">
                                 <thead>
                                    <tr>
                                       <th>Item Id</th>
                                       <th>Item Name</th>
<!--                                        <th>Vendor</th> -->
                                       <th>Sub Catgory</th>
                                       <th>Image</th>
                                       <th>Description</th>
                                       <th>Price</th>
                                       <th>Unit</th>
                                       <th>Is Out of Stock</th>
                                       <th>Tax</th>
                                       <th>Is Online</th> 
                                       <!-- <th> Action </th>  --> 
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php 
                                       $i=0;
                                       foreach($item as $row){
                                        $i++;
                                        ?>
                                    <tr class="odd gradeX">
                                       <td class="left"><?php echo $i;?></td>

                                       <td class="left"><?php echo ucwords($row['item_name']);?></td>
                                       <!-- <td class="left"><?php echo $row['name'];?></td>  -->
                                       <td class="left"><?php echo ucwords($row['sub_cat_name']);?></td>
                                    
                                       <td class="left"><center><img src="<?php echo base_url()?>/uploads/user/<?php echo $row['item_images'];?>" height="50px;" width="50px"></center></td>

                                       <td class="left"><?php echo $row['item_desc'];?></td>

                                       <td class="left"><?php echo ucwords($row['item_price']);?></td>

                                       <td class="left"><?php echo ucwords($row['item_unit']);?></td>
                                       <td class="left"><?php echo $row['is_out_of_stock'];?></td>
                                       <td class="left"><?php echo ucwords($row['tax']);?></td>
                                       <td class="left"><?php echo $row['is_online'];?></td>
                                       
                                       <!-- <td>
                                       <a href="<?php echo site_url('Vendor/edit_item/').$row['item_id'];?>"" class="btn btn-primary btn-xs">
                                       <i class="fa fa-pencil"></i>
                                       </a> 
                                       <td>  
                                       <a href="<?php echo site_url('Vendor/deleterecord/').$row['item_id'];?>/item/Item" class="btn btn-danger btn-xs" onclick="return conformDelete()">
                                       <i class="fa fa-trash-o "></i>
                                       </a>
                                       </td>  -->
                                       
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