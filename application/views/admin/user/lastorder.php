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
                            
                           <div class="table-scrollable">
                              <table class="table table-striped table-bordered table-hover table-checkable order-column valign-middle" id="example4">
                                 <thead>
                                    <tr>
                                       <th>Id</th>
                                       <th>First Name</th>
                                       <th>Last Name</th>
                                       <th>Email</th>
                                       <th>Mobile No.</th>
                                       <th>Last Order Details</th>
                                       <th>Device Type</th> 
                                       <th>Send Offer For User</th> 
                                       
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php 
                                       $i=0;
                                       foreach($user as $row){
                                       $lastOrder = $this->Model->getLastOrder($row['user_id']);
                                      // echo '<pre>'; print_r($LAST);
                                        $i++;
                                        ?>
                                    <tr class="odd gradeX">
                                       <td class="left"><?php echo $row['user_id'];?></td>
                                       <td class="left"><?php echo ucwords($row['fname']);?></td>
                                       <td class="left"><?php echo ucwords($row['lname']);?></td>
                                       <td class="left"><?php echo ucwords($row['email']);?></td>
                                       <td class="left"><?php echo $row['user_mobile'];?></td>
                                       <td class="left">
                                         <?php if(!empty($lastOrder)){?>
                                          Your Last order of &nbsp;<span style="color:red;"><?php  echo $lastOrder[0]['item_name']; ?></span> <br>on date : <span style="color:red;"><?php echo $lastOrder[0]['date_time'];?></span>
                                        <?php 
                                          $current_date = date('Y-m-d');
                                          if ($lastOrder[0]['date_time'] > $current_date) {
                                           echo '<span style="color:#41fbd9;font-weight:bold;">( Upcoming )</span>';
                                          }elseif ($lastOrder[0]['date_time'] < $current_date) {
                                           echo '<span style="color:#24719e;font-weight:bold;">( Past )</span>';
                                          }else{
                                           echo '<span style="color:#efc6bd;font-weight:bold;">( Today )</span>';  
                                          }
                                         }else{ ?>
                                         <span style="color:#000;font-weight: bold;">Order Not Created</span>
                                        <?php } ?>
                                        <?php  
                                        if(!empty($lastOrder)){
                                          $checkCartStatus = $lastOrder[0]['cart_status']; 
                                          if ($checkCartStatus == '0') {
                                            echo " - Add Cart";
                                          }elseif ($checkCartStatus == '1') {
                                            echo " - Orderd";
                                          }elseif ($checkCartStatus == '2') {
                                            echo " - Cancel";
                                          }elseif ($checkCartStatus == '3') {
                                            echo " - Return";
                                          }elseif ($checkCartStatus == '4') {
                                            echo " - Delivery";
                                          }elseif ($checkCartStatus == '5') {
                                            echo " - Return Accept";
                                          }elseif ($checkCartStatus == '6') {
                                            echo " - Dispatch";
                                          }elseif($checkCartStatus == ''){
                                            echo " - Empty";
                                          }
                                        }else{
                                          
                                        }

                                        $push_message="Dear Customer, No orders from ".date('d M Y', strtotime(' +1 day'))." Please place your ORDERS now! Thanks";
                                        ?>

                                       </td> 
                                       <td class="left"><?php echo $row['device_type'];?></td>
                                       <td>
                                          <button class="btn-success"> Send Offer </button>
                                          <form target="_blank" action="<?php echo site_url('Notification/sendPushNotification');?>" method="post">
                                              <div class="card-body row">          
                                                             <input class = "mdl-textfield__input" type = "hidden"  name="id" value="<?php echo $row['user_id'];?>" style="text-transform: capitalize;" placeholder="ex: 0 (zero) for all user" required>
                                                             <input class = "mdl-textfield__input" type = "hidden"  name="title" value="Order Reminder" style="text-transform: capitalize;" required>
                                                             <input class = "mdl-textfield__input" type = "hidden"  name="message" value="<?php echo $push_message;?>" style="text-transform: capitalize;" required>
                                                             <input class = "mdl-textfield__input" type = "hidden"  name="type" value="android" style="text-transform: capitalize;" required>  
                                                          <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-primary">Submit</button>
                                                    </div>  
                                                    <div class="col-md-3"></div>
                                               </div>
                                          </form>
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