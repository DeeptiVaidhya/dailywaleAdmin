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
                           <header>Notification</header>
                        </div>
                        <div class="card-body ">
                           
                            
                           <div class="table-scrollable">
                              <table class="table table-striped table-bordered table-hover table-checkable order-column valign-middle" id="example4">
                                 <thead>
                                    <tr>
                                       <th>Id</th>
                                       <th>Message</th>
                                        <th>Action</th>  
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php 
                                       $i=0;
                                       foreach($users as $row){
                                        $i++;
                                        ?>
                                    <tr class="odd gradeX">
                                       <td class="left"><?php echo $row['id'];?></td>
                                       <td class="left"><?php echo ucwords($row['message']);?></td>                                     
                                       <td>   
                                       <a href="<?php echo site_url('Notification/editnotification/').$row['id'];?>" class="btn btn-primary btn-xs">
                                       <i class="fa fa-pencil"></i>
                                       </a> 
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
