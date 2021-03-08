start page content -->
<div class="page-content-wrapper">
   <div class="page-content">
      <div class="page-bar">
         <div class="page-title-breadcrumb">
            <div class=" pull-left">
              <!--  <div class="page-title">Popular Service List</div> -->
            </div>
            <!-- <ol class="breadcrumb page-breadcrumb pull-right">
               <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo site_url('welcome/dashboard');?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
               </li>
               <li class="active">Popular Service List</li>
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
                           <header>All Popular Service</header>
                        </div>
                        <div class="card-body ">
                           <div class="row">
                              <div class="col-md-12 col-sm-12 col-12">
                                 <div class="btn-group pull-right">
                                    <a href="<?php echo site_url('Pop_services/pop_ser_Add');?>" id="addRow" class="btn btn-info">
                                    Add New Popular Service <i class="fa fa-plus"></i>
                                    </a>
                                 </div>
                              </div>
                            
                           <div class="table-scrollable">
                              <table class="table table-striped table-bordered table-hover table-checkable order-column valign-middle" id="example4">
                                 <thead>
                                    <tr>
                                       <th>Id</th>
                                       <th>Service Title</th>
                                      
                                       
                                        <th> Action </th>  
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php 
                                       $i=0;
                                       foreach($pop_services as $row){
                                        $i++;
                                        ?>
                                    <tr class="odd gradeX">
                                       <td class="left"><?php echo $i;?></td>
                                        <td class="left">
                                           <?php foreach ($service as $key) {
                                           $service_id=$key['service_id'];
                                     
                                        ?>
                                          <?php if ($service_id==$row['service_id']) {
                                          echo $key['title'];
                                       };?>
                                       <?php } ?>
                                       </td>
                                      
                                      <!--  <td class="left"><?php echo ucwords($row['valid_date']);?></td>
                                       <td class="left"><?php $date=$row['created_at']; echo date('d-m-Y', strtotime($date));?></td> -->
                                       
                                       
                                       <td>
                                       <?php if ($row['boost_status'] == '1' ) { ?>
                                        
                                           <a href="<?php echo site_url('Pop_services/edit_pop_services/').$row['pop_ser_id'];?>"" class="btn btn-primary btn-xs">
                                            <i class="fa fa-pencil"></i>
                                           </a> 

                                           <button type="button" class="btn btn-primary btn-xs" style="text-transform: capitalize;"  disabled>Boosted</button>
                                        
                                        <?php } else{ ?>   
                                         
                                           <a href="<?php echo site_url('Pop_services/edit_pop_services/').$row['pop_ser_id'];?>"" class="btn btn-primary btn-xs">
                                            <i class="fa fa-pencil"></i>
                                           </a> 

                                           <a href="<?php echo site_url('Pop_services/boost_item_pop_services/').$row['pop_ser_id'];?>"" class="btn btn-primary btn-xs" style="text-transform: capitalize;" >Boost
                                           </a>

                                        <?php } ?>  
                                         <!-- <a href="<?php echo site_url('Pop_services/deleterecord/').$row['pop_ser_id'];?>/popular_services/Pop_services" class="btn btn-danger btn-xs" onclick="return conformDelete()">
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