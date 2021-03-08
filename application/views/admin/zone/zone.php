start page content -->
<div class="page-content-wrapper">
   <div class="page-content">
      <div class="page-bar">
         <div class="page-title-breadcrumb">
            <div class=" pull-left">
              <!--  <div class="page-title">Zone List</div> -->
            </div>
            <!-- <ol class="breadcrumb page-breadcrumb pull-right">
               <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo site_url('welcome/dashboard');?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
               </li>
               <li class="active">Zone List</li>
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
                           <header>All Zone</header>
                        </div>
                        <div class="card-body ">
                           <div class="row">
                              <div class="col-md-12 col-sm-12 col-12">
                                 <div class="btn-group pull-right">
                                    <a href="<?php echo site_url('Zone/zoneAdd');?>" id="addRow" class="btn btn-info">
                                    Add New Zone <i class="fa fa-plus"></i>
                                    </a>
                                 </div>
                              </div>
                            
                           <div class="table-scrollable">
                              <table class="table table-striped table-bordered table-hover table-checkable order-column valign-middle" id="example4">
                                 <thead>
                                    <tr>
                                       <th>Id</th>
                                       <th>City Name</th>
                                       <th>zone Name</th>
                                       <th>Online Status</th>                                       
                                        <th> Action </th>  
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php 
                                       $i=0;
                                       foreach($zone as $row){
                                        $i++;
                                        ?>
                                    <tr class="odd gradeX">
                                       <td class="left"><?php echo $i;?></td>
                                       <td class="left"><?php echo ucwords($row['city_name']);?></td>
                                       <td class="left"><?php echo ucwords($row['zone_name']);?></td>
                                       <?php 
                                          if ($row['is_status']=='Online') { ?>
                                             <td class="left"><a href="<?php echo site_url('Zone/user_active/')?><?php echo $row['zone_id']; ?>" value="<?php echo $row['is_status'];?>"  class='btn btn-primary' style="margin: 0px 0px 0px 70px;">Online</a></td>
                                          <?php }else{ ?>
                                              <td class="left"><a href="<?php echo site_url('Zone/user_deactive/')?><?php echo $row['zone_id']; ?>" value="<?php echo $row['is_status'];?>" class='btn btn-danger'  style="margin: 0px 0px 0px 70px;">Offline</a></td>
                                          <?php }
                                       ?>
                                       
                                       
                                       <td>   
                                          <a href="<?php echo site_url('Zone/editzone/').$row['zone_id'];?>" class="btn btn-primary btn-xs">
                                          <i class="fa fa-pencil"></i>
                                          </a> 
                                           
                                        <!--   <a href="<?php echo site_url('Zone/deleterecord/').$row['zone_id'];?>/zone/Zone" class="btn btn-danger btn-xs" onclick="return conformDelete()">
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