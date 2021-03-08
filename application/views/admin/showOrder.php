<!-- start page content  -->
<div class="page-content-wrapper">
   <div class="page-content">
      <div class="page-bar">
         <div class="page-title-breadcrumb">
            <div class=" pull-left">
              <!--  <div class="page-title">Item List</div> -->
            </div>
           <!--  <ol class="breadcrumb page-breadcrumb pull-right">
               <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo site_url('welcome/dashboard');?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
               </li>
               <li class="active">Item List</li>
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
                           <header>Show All Order</header>
                        </div>
                        <div class="card-body ">
                           <div class="row">
                              <!-- <div class="col-md-12 col-sm-12 col-12">
                                 <div class="btn-group pull-right">
                                    <a href="<?php echo site_url('Item/item_Add');?>" id="addRow" class="btn btn-info">
                                    Show Add Order <i class="fa fa-plus"></i>
                                    </a>
                                 </div>
                              </div> -->
                            
                           <div class="table-scrollable">
                              <table class="table table-striped table-bordered table-hover table-checkable order-column valign-middle" id="example4">
                                 <thead>
                                    <tr>
                                       <th>Id</th>
                                       <th>User fname</th>
                                       <th>User lname</th>
                                       <th>Total Amount</th>
                                       <!-- <th> Action </th>   -->
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php 
                                       $i=0;
                                       foreach($showOrder as $row){
                                        $i++;
                                        ?>
                                    <tr class="odd gradeX">
                                       <td class="left"><?php echo $i;?></td>
                                       <?php 
                                       $wheredata=array('user_id'=>$row['user_id']);
                                       $result=$this->Model->selectdata('user',$wheredata);
                                       foreach ($result as $value) {
                                          $username=$value['fname'];
                                          // $itemname=$value['lname'];
                                          $userid=$value['user_id'];
                                       }
                                       ?>
                                       <td class="left"><?php if($userid==$row['user_id']){echo $username; };?></td>
                                       <?php 
                                       $wheredata=array('user_id'=>$row['user_id']);
                                       $result=$this->Model->selectdata('user',$wheredata);
                                       foreach ($result as $value) {
                                          $username=$value['lname'];
                                          // $itemname=$value['lname'];
                                          $userid=$value['user_id'];
                                       }
                                       ?>
                                       <td class="left"><?php if($userid==$row['user_id']){echo $username; };?></td>
                                      <!--  <td class="left"><?php echo ucwords($row['name']);?></td> -->
                                       <td class="left"><?php echo $row['total_amount'];?></td>
                                     <!--   <td class="left"><center><img src="<?php echo base_url()?>/uploads/user/<?php echo $row['item_images'];?>" height="50px;" width="50px"></center></td>
 -->
                                       

                                       
                                       
                                       <!-- <td>
                                       
                                       <a href="<?php echo site_url('ShowOrder/updateStatus/'.'1'.'/'.$row['order_id']);?>" class="btn btn-primary" value="<?php echo $row['status'];?>"><i class="glyphicon glyphicon-ok">Acceped</i>
                                        </a>
                                       <a href="<?php echo site_url('ShowOrder/updateStatus/'.'3'.'/'.$row['order_id']);?>"" class="btn btn-danger">
                                       <i class="glyphicon glyphicon-ok"></i>cencel
                                       </a> 
                                        
                                       </td> 
                                        -->
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