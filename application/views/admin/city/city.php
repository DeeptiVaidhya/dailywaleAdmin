start page content -->
<div class="page-content-wrapper">
   <div class="page-content">
      <div class="page-bar">
         <div class="page-title-breadcrumb">
            <div class=" pull-left">
              <!--  <div class="page-title">City List</div> -->
            </div>
            <!-- <ol class="breadcrumb page-breadcrumb pull-right">
               <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo site_url('welcome/dashboard');?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
               </li>
               <li class="active">City List</li>
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
                           <header>All City</header>
                        </div>
                        <div class="card-body ">
                           <div class="row">
                              <div class="col-md-12 col-sm-12 col-12">
                                 <div class="btn-group pull-right">
                                    <a href="<?php echo site_url('City/CityAdd');?>" id="addRow" class="btn btn-info">
                                    Add New City <i class="fa fa-plus"></i>
                                    </a>
                                 </div>
                              </div>
                            
                            <div class="table-scrollable">
                              <table class="table table-striped table-bordered table-hover table-checkable order-column valign-middle" id="example4">
                                 <thead>
                                    <tr>
                                       <th>Id</th>
                                       <th>state Name</th>
                                       <th>City Name</th>
                                        <th>Online Status</th>
                                        <th> Action </th>  
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php 
                                       $i=0;
                                       foreach($city as $row){
                                        $i++;
                                        ?>
                                    <tr class="odd gradeX">
                                       <td class="left"><?php echo $row['city_id'];?></td>
                                       <td class="left"><?php echo ucwords($row['state_name']);?></td>
                                       <td class="left"><?php echo ucwords($row['city_name']);?></td>
                                       <?php 
                                          if ($row['is_status']=='Online') { ?>
                                             <td class="left"><a href="<?php echo site_url('City/user_active/')?><?php echo $row['city_id']; ?>" value="<?php echo $row['is_status'];?>"  class='btn btn-primary' style="margin: 0px 0px 0px 70px;">Online</a></td>
                                          <?php }else{ ?>
                                              <td class="left"><a href="<?php echo site_url('City/user_deactive/')?><?php echo $row['city_id']; ?>" value="<?php echo $row['is_status'];?>" class='btn btn-danger'  style="margin: 0px 0px 0px 70px;">Offline</a></td>
                                          <?php }
                                       ?>
                                       
                                       <td>   
	                                       <a href="<?php echo site_url('City/editcity/').$row['city_id'];?>" class="btn btn-primary btn-xs">
	                                       <i class="fa fa-pencil"></i>
	                                       </a> 
	                                       
	                                       <!-- <a href="<?php echo site_url('City/deleterecord/').$row['city_id'];?>/city/City" class="btn btn-danger btn-xs" onclick="return conformDelete()">
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