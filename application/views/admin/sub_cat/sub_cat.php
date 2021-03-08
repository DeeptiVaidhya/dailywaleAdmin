start page content -->
<div class="page-content-wrapper">
   <div class="page-content">
      <div class="page-bar">
         <div class="page-title-breadcrumb">
            <div class=" pull-left">
              <!--  <div class="page-title">Category List</div> -->
            </div>
            <!-- <ol class="breadcrumb page-breadcrumb pull-right">
               <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo site_url('welcome/dashboard');?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
               </li>
               <li class="active">Category List</li>
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
                           <header>All SubCategory</header>
                        </div>
                        <div class="card-body ">
                           <div class="row">
                              <div class="col-md-12 col-sm-12 col-12">
                                 <div class="btn-group pull-right">
                                    <a href="<?php echo site_url('Sub_cat/sub_cat_Add');?>" id="addRow" class="btn btn-info">
                                    Add New SubCategory <i class="fa fa-plus"></i>
                                    </a>
                                 </div>
                              </div>
                            
                           <div class="table-scrollable">
                              <table class="table table-striped table-bordered table-hover table-checkable order-column valign-middle" id="example4">
                                 <thead>
                                    <tr>
                                       <th>Id</th>
                                       <th>Cat Name</th>
                                       <th>Sub_cat Name</th>
                                       <th>Icon</th>
                                       <th>Online Status</th>
                                        <th> Action </th>  
                                    </tr>
                                 </thead>
                                 <tbody class="row_position">
                                    <?php 
                                       $i=0;
                                        foreach($sub_cat as $row){
                                        $i++;
                                        ?>
                                    <tr class="odd gradeX" id="<?php echo $row['sub_cat_id']; ?>">
                                       <td class="left"><?php echo $i;?></td>
                                       <td class="left"><?php echo ucwords($row['cat_name']);?></td>
                                       </td>
                                       <td class="left"><?php echo ucwords($row['sub_cat_name']);?></td>
                                       <td class="left"><center><img src="<?php echo base_url()?>/uploads/user/<?php echo $row['icon'];?>" height="50px;" width="50px"></center></td>
                                       <?php 
                                          if ($row['is_status']=='Online') { ?>
                                             <td class="left"><a href="<?php echo site_url('Sub_cat/user_active/')?><?php echo $row['sub_cat_id']; ?>" value="<?php echo $row['is_status'];?>"  class='btn btn-primary' style="margin: 0px 0px 0px 70px;">Online</a></td>
                                          <?php }else{ ?>
                                              <td class="left"><a href="<?php echo site_url('Sub_cat/user_deactive/')?><?php echo $row['sub_cat_id']; ?>" value="<?php echo $row['is_status'];?>" class='btn btn-danger'  style="margin: 0px 0px 0px 70px;">Offline</a></td>
                                          <?php }
                                       ?>
                                       <td> 

                                       <a href="<?php echo site_url('Sub_cat/edit_sub_cat/').$row['sub_cat_id'];?>" class="btn btn-primary btn-xs">
                                       <i class="fa fa-pencil"></i>
                                       </a> 
                                     
                                       <!-- <a href="<?php echo site_url('Sub_cat/deleterecord/').$row['cat_id'];?>/sub_cat/Sub_cat" class="btn btn-danger btn-xs" onclick="return conformDelete()">
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
<!-- end page content -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
    $( ".row_position" ).sortable({
        delay: 150,
        stop: function() {
            var selectedData = new Array();
            $('.row_position>tr').each(function() {
                selectedData.push($(this).attr("id"));
            });
            updateSubCategory(selectedData);
        }
    });


    function updateSubCategory(data) {
        $.ajax({
            url:"<?php echo base_url(); ?>index.php/Sub_cat/top_subcategory",
            type:'post',
            dataType : "json",
            data:{position:data},
            success:function(data){
                swal("Your SubCategory successfully drag.");
               // alert('Your Item successfully saved');
            }
        })
    }
</script>