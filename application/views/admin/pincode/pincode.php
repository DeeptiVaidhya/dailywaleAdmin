start page content -->
<div class="page-content-wrapper">
   <div class="page-content">
      <div class="page-bar">
         <div class="page-title-breadcrumb">
            <div class=" pull-left">
              <!--  <div class="page-title">Pincode List</div> -->
            </div>
            <!-- <ol class="breadcrumb page-breadcrumb pull-right">
               <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo site_url('welcome/dashboard');?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
               </li>
               <li class="active">Pincode List</li>
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
                           <header>All Pincode</header>
                        </div>
                        <div class="card-body ">
                           <div class="row">
                              <div class="col-md-12 col-sm-12 col-12">
                                 <div class="btn-group pull-right">
                                    <a href="<?php echo site_url('Pincode/pincode_Add');?>" id="addRow" class="btn btn-info">
                                    Add New Pincode <i class="fa fa-plus"></i>
                                    </a>
                                 </div>
                              </div>
                            
                           <div class="table-scrollable">
                              <table class="table table-striped table-bordered table-hover table-checkable order-column valign-middle" id="example4">
                                 <thead>
                                    <tr>
                                       <th>Id</th>
                                       <th>Subzone Id</th>
                                       <th>Pincode No</th>
                                       <th>Created At</th>
                                       <th>updated At</th>
                                        <th>Action</th>  
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php 
                                       $i=0;
                                       foreach($pincode as $row){
                                        $i++;
                                        ?>
                                    <tr class="odd gradeX">
                                       <td class="left"><?php echo $i;?></td>
                                        <td class="left">
                                           <?php foreach ($subzone as $key) {
                                           $sub_zone_id=$key['subzone_id'];
                                     
                                        ?>
                                          <?php if ($sub_zone_id==$row['sub_zone_id']) {
                                          echo $key['subzone_name'];
                                       };?>
                                       <?php } ?>
                                       </td>
                                      <td class="left"><?php echo $row['pincode_no'];?></td>
                                       <td class="left"><?php $date=$row['created_at']; echo date('d-m-Y', strtotime($date));?></td>
                                       <td class="left"><?php $date=$row['updated_at']; echo date('d-m-Y', strtotime($date));?></td>
                                       
                                       
                                       <td>   
                                       <a href="<?php echo site_url('Pincode/edit_pincode/').$row['pincodeID'];?>"" class="btn btn-primary btn-xs">
                                       <i class="fa fa-pencil"></i>
                                       </a> 
                                       
                                       <!-- <a href="<?php echo site_url('Pincode/deleterecord/').$row['pincodeID'];?>/pincode/Pincode" class="btn btn-danger btn-xs" onclick="return conformDelete()">
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