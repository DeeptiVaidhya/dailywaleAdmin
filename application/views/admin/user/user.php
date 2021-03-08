<style>
body {font-family: Arial;}
.table td, .table th, .card .table td, .card .table th, .card .dataTable td, .card .dataTable th{
  padding: 8px;
}
.table thead tr th{
  font-size: 14px;
}
.table tbody tr td{
  font-size: 14px;
}
.btn.btn-xs {
    font-size: 10px;
    padding: 2px 3px;
}
body {
  
  font-size: 15px;
  font-weight: 400;
  line-height: 1.2;
 
}
label {
   
    margin-bottom: 0.5rem;
}
/* Style the tab */
.tab {
    overflow: hidden;
    border: 1px solid #ccc;
    background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
.tab button {
    background-color: inherit;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 5px 72px;
    transition: 0.3s;
    font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
    background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
    background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
    display: none;
    padding: 6px 12px;
    border: 1px solid #ccc;
    border-top: none;
}
</style>

<!--start page content -->
<div class="page-content-wrapper">
   <div class="page-content">
      <div class="page-bar">
         <div class="page-title-breadcrumb">
            <div class=" pull-left">
              <!--  <div class="page-title">User List</div> -->
            </div>
           <!--  <ol class="breadcrumb page-breadcrumb pull-right">
               <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo site_url('welcome/dashboard');?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
               </li>
               <li class="active">User List</li>
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
                           <header>All User</header>
                        </div>
                        <div class="card-body ">
                           <div class="row">
                              <div class="col-md-12 col-sm-12 col-12">
                                 <div class="btn-group pull-right">
                                    <a href="<?php echo site_url('User/userAdd');?>" id="addRow" class="btn btn-info">
                                    Add New User <i class="fa fa-plus"></i>
                                    </a>
                                 </div>
                              </div>
                            
                           <div class="table-scrollable">
                              <table class="table table-striped table-bordered table-hover table-checkable order-column valign-middle" id="example4">
                                 <thead>
                                    <tr>
                                       <th>Id</th>
                                       <th>First Name</th>
                                       <th>Last Name</th>
                                       <th>Email</th>
                                       <th>Mobile No.</th>
                                       <th>Address</th>
                                      <!--  <th>Subzone</th> -->
                                       <th>City Name</th>
                                       <th>Wallet Amount</th>
                                       <th> Action </th>  
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php 
                                       $i=0;
                                       foreach($user as $row){
                                        $i++;
                                        $subzonId = $row['subzone_id'];
                                        $zonId = $row['zone_id'];
                                        $CityId = $row['city_id'];
                                        ?>
                                    <tr class="odd gradeX">
                                       <td class="left"><?php echo $row['user_id'];?></td>
                                       <td class="left"><?php echo ucwords($row['fname']);?></td>
                                       
                                       <td class="left"><?php echo ucwords($row['lname']);?></td>
                                       
                                       <td class="left"><?php echo ucwords($row['email']);?></td>
                                       <td class="left"><?php echo $row['user_mobile'];?></td>
                                       <td class="left">
                                      <?php echo ucwords($row['address']);?>&nbsp;/
                                        <?php foreach ($zone as $zon) {
                                         $ZoneId =  $zon['zone_id'];
                                        if ($zonId == $ZoneId) {?>
                                      <?php echo ucwords($zon['zone_name']);?>&nbsp;/
                                      <?php } }?>

                                        <?php 
                                            foreach ($subzone as $sub) {
                                             $subZoneId =  $sub['subzone_id'];
                                              if ($subzonId == $subZoneId) {
                                                echo ucwords($sub['subzone_name']);
                                              }
                                            }
                                        ?>
                                      </td>
                                     <!--  <td><?php // echo ucwords($sub['subzone_name']);?></td> -->
                                     
                                      <td class="left"><?php 
                                                foreach ($City as $Cname) {
                                                $cityId= $Cname['city_id'];
                                              if ($cityId == $CityId) {?>
                                              <?php echo ucwords($Cname['city_name']);}?>
                                              <?php }?>  
                                      </td>

                                      

                                       <td class="left"><i class="fa fa-inr"></i>&nbsp;<?php echo $row['wallet_amount'];?></td>                                     
                                       <td>   
                                       <a href="<?php echo site_url('User/edituser/').$row['user_id'];?>" class="btn btn-primary btn-xs">
                                       <i class="fa fa-pencil"></i>
                                       </a> 
                                       <a href="<?php echo site_url('User/viewrecord/').$row['user_id'];?>" class="btn btn-danger btn-xs">
                                       <i class="fa fa-eye"></i>
                                       </a>
                                       </td> 
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