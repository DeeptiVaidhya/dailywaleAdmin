start page content -->
<div class="page-content-wrapper">
   <div class="page-content">
      <div class="page-bar">
         <div class="page-title-breadcrumb">
            <div class=" pull-left">
               <!-- <div class="page-title">Service Provider List</div> -->
            </div>
            <!-- <ol class="breadcrumb page-breadcrumb pull-right">
               <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo site_url('welcome/dashboard');?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
               </li>
               <li class="active">Service Provider List</li>
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
                           <header>All Service Provider</header>
                        </div>
                        <div class="card-body ">
                           <div class="row">
                              <div class="col-md-12 col-sm-12 col-12">
                                 <div class="btn-group pull-right">
                                    <a href="<?php echo site_url('Service_provider/services_Add');?>" id="addRow" class="btn btn-info">
                                    Add Service Provider Category <i class="fa fa-plus"></i>
                                    </a>
                                 </div>
                              </div>
                            
                           <div class="table-scrollable">
                              <table class="table table-striped table-bordered table-hover table-checkable order-column valign-middle" id="example4">
                                 <thead>
                                    <tr>
                                       <th>Id</th>
                                       <th>Vendor</th>
                                       <th>Provider Name</th>
                                       <th>Tittle</th>
                                       <th>Description</th>                                       
                                       <th>Pre_booking_price</th>
                                       <th> Action </th>  
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php 
                                       $i=0;
                                       foreach($service_pro as $row){
                                        $i++;
                                        ?>
                                    <tr class="odd gradeX">
                                       <td class="left"><?php echo $i;?></td>
                                       <td class="left"><?php echo ucwords($row['name']);?></td>
                                       <td class="left"><?php echo ucwords($row['item_name']);?></td>
                                       <td class="left"><?php echo ucwords($row['title']);?></td>
                                       <td class="left"><?php echo ucwords($row['description']);?></td>
                                        <td class="left"><?php echo ucwords($row['pre_booking_price']);?></td> 
                                       <td>
                                          <a href="<?php echo site_url('Service_provider/edit_services/').$row['service_id'];?>"" class="btn btn-primary btn-xs">
                                          <i class="fa fa-pencil"></i>
                                          </a> 
                                        
                                          <!-- <a href="<?php echo site_url('Service_provider/deleterecord/').$row['service_id'];?>/Service_provider/Service_provider" class="btn btn-danger btn-xs" onclick="return conformDelete()">
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