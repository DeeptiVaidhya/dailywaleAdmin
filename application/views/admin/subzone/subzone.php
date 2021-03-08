<!--start page content -->
<div class="page-content-wrapper">
   <div class="page-content">
      <div class="page-bar">
         <div class="page-title-breadcrumb">
            <div class=" pull-left">
               <!-- <div class="page-title">Subzone List</div> -->
            </div>
           <!--  <ol class="breadcrumb page-breadcrumb pull-right">
               <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo site_url('welcome/dashboard');?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
               </li>
               <li class="active">Subzone List</li>
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
                           <header>All Subzone</header>
                        </div>
                        <div class="card-body ">
                           <div class="row">
                              <div class="col-md-12 col-sm-12 col-12">
                                 <div class="btn-group pull-right">
                                    <a href="<?php echo site_url('Subzone/subzoneAdd');?>" id="addRow" class="btn btn-info">
                                    Add New Subzone <i class="fa fa-plus"></i>
                                    </a>
                                 </div>
                              </div>
                            
                           <div class="table-scrollable">
                              <table class="table table-striped table-bordered table-hover table-checkable order-column valign-middle" id="example4">
                                 <thead>
                                    <tr>
                                       <th>Id</th>
                                       <th>Zone Name</th>
                                       <th>Subzone Name</th>
                                        <th>Online Status</th>
                                       <!-- <th>Created_At</th>
                                       <th>Updated_At</th> -->
                                        <th> Action </th>  
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php 
                                       $i=0;
                                       foreach($subzone as $row){
                                        $i++;
                                        ?>
                                    <tr class="odd gradeX">
                                       <td class="left"><?php echo $i;?></td>
                                       <td class="left"><?php echo ucwords($row['zone_name']);?></td>
                                       <td class="left"><?php echo ucwords($row['subzone_name']);?></td>
                                       <?php 
                                          if ($row['is_status']=='Online') { ?>
                                             <td class="left"><a href="<?php echo site_url('Subzone/user_active/')?><?php echo $row['subzone_id']; ?>" value="<?php echo $row['is_status'];?>"  class='btn btn-primary' style="margin: 0px 0px 0px 70px;">Online</a></td>
                                          <?php }else{ ?>
                                              <td class="left"><a href="<?php echo site_url('Subzone/user_deactive/')?><?php echo $row['subzone_id']; ?>" value="<?php echo $row['is_status'];?>" class='btn btn-danger'  style="margin: 0px 0px 0px 70px;">Offline</a></td>
                                          <?php }
                                       ?>

                                      <!--  <td class="left"><?php $date=$row['created_at']; echo date('d-m-Y', strtotime($date));?></td>
                                       <td class="left"><?php $date=$row['updated_at']; echo date('d-m-Y', strtotime($date));?></td>
                                        -->
                                       <td>   
                                          <a href="<?php echo site_url('Subzone/editsubzone/').$row['subzone_id'];?>" class="btn btn-primary btn-xs">
                                          <i class="fa fa-pencil"></i>
                                          </a> 
                                       
                                          <!-- <a href="<?php echo site_url('Subzone/deleterecord/').$row['subzone_id'];?>/subzone/Subzone" class="btn btn-danger btn-xs" onclick="return conformDelete()">
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