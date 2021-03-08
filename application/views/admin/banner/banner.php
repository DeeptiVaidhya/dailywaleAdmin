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
                           <header>All Banner</header>
                        </div>
                        <div class="card-body ">
                           <div class="row">
                              <div class="col-md-12 col-sm-12 col-12">
                                 <div class="btn-group pull-right">
                                    <a href="<?php echo site_url('Banner/banner_Add');?>" id="addRow" class="btn btn-info">
                                    Add New Banner <i class="fa fa-plus"></i>
                                    </a>
                                 </div>
                              </div>
                            
                           <div class="table-scrollable">
                              <table class="table table-striped table-bordered table-hover table-checkable order-column valign-middle" id="example4">
                                 <thead>
                                   <tr>
                                       <th>Id</th>
                                       <th>Banner Type</th>
                                       <th>Application Type</th>
                                       <th>Item Name</th>
                                       <th>Item SubCategory</th>
                                       <th>Images</th>
                                       <th> Action </th>  
                                    </tr>
                                 </thead>
                                 <tbody class="row_position">
                                    <?php 
                                       $i=0;
                                        foreach($banner as $row){
                                        $i++;
                                        ?>
                                    <tr class="odd gradeX" id="<?php echo $row['banner_id'] ?>">
                                       <td class="left"><?php echo $i;?></td>
                                       <td class="left"><?php echo ucwords($row['banner_type']);?></td>
                                       <td class="left"><?php echo ucwords($row['application_type']);?></td>
                                       <td class="left"><?php echo ucwords($row['item_name']);?></td>
                                       <td class="left"><?php echo ucwords($row['sub_cat_name']);?></td>
                                       <td class="left"><center><img src="<?php echo base_url()?>/uploads/user/<?php echo $row['image'];?>" height="50px;" width="50px"></center></td>
                                       <td>   
                                       <a href="<?php echo site_url('Banner/edit_banner/').$row['banner_id'];?>"" class="btn btn-primary btn-xs">
                                       <i class="fa fa-pencil"></i>
                                       </a>  
                                     
                                       <!-- <a href="<?php echo site_url('Banner/deleterecord/').$row['banner_id'];?>/banners/Banner" class="btn btn-danger btn-xs" onclick="return conformDelete()">
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
<!-- end page content-->
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
            updateBanner(selectedData);
        }
    });


    function updateBanner(data) {
        $.ajax({
            url:"<?php echo base_url(); ?>index.php/Banner/top_banner",
            type:'post',
            dataType : "json",
            data:{position:data},
            success:function(data){
                swal("Your Banner successfully drag.");
               // alert('Your Item successfully saved');
            }
        })
    }
</script>