<!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Edit Banner details</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo site_url('welcome/dashboard');?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                               
                                <li class="active">Edit Banner details</li>
                            </ol>
                        </div>
                    </div>
						<div class="row">
							<div class="col-sm-12">
								<div class="card-box">
									<div class="card-head">
										<header>Banner Information</header>
										
				                       
									</div>
                  <?php echo $this->session->flashdata('Banner');?>
									<?php 
                  // print_r($records);exit; 
                  // foreach ($records as $row) { 
                    // print_r($row);exit;
                    ?>

                  <form action="<?php echo site_url('Banner/banner_Edit');?>" method="post" enctype="multipart/form-data">
                  <input class = "mdl-textfield__input" type = "hidden" id = "Name" name="id" value="<?php echo $records->banner_id;?>">
									<div class="card-body row">
                       <div class="col-lg-6 p-t-20">
                         <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                            <select class = "mdl-textfield__input" name="banner_type" value="<?php echo $records->banner_type;?>" style="text-transform: capitalize;">
                                
                                <option value="<?php echo $records->banner_type;?>">Select type</option>
                                <option <?php if($records->banner_type=='Home'){ echo'selected'; } ?> value="Home">Home</option>
                                <option <?php if($records->banner_type=='Category'){ echo'selected'; } ?> value="Category">Category</option>
                              </select>
                              
                               <label class = "mdl-textfield__label">Banner type</label>
                                <span class="intro" id="errorname"></span>
                            </div>
                        </div> 

                        <div class="col-lg-6 p-t-20">
                         <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                            <select class = "mdl-textfield__input" name="application_type" value="<?php echo $records->application_type;?>" style="text-transform: capitalize;">
                                
                                <option value="<?php echo $records->banner_type;?>">Select type</option>
                                <option <?php if($records->application_type=='Service'){ echo'selected'; } ?> value="Service">Service</option>
                                <option <?php if($records->application_type=='Subscription'){ echo'selected'; } ?> value="Subscription">Subscription</option>
                              </select>
                              
                               <label class = "mdl-textfield__label">Application type</label>
                                <span class="intro" id="errorname"></span>
                            </div>
                        </div> 


                        <div class="col-lg-6 p-t-20"> 
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                 <select class = "mdl-textfield__input" id = "freename" name="item_name" style="text-transform: capitalize;">
                                  <?php 
                                  $iid = $records->item_id;
                                  foreach ($item as $key) { ?>
                                    <option <?php if($key['item_id']==$iid){ echo'selected'; } ?> value="<?php echo $key['item_id'];?>"><?php echo $key['item_name'];?></option>
                                  <?php }
                                  ?>
                                 </select>
                                 <label class = "mdl-textfield__label" >item Name</label>
                                  <span class="intro" id="errorname"></span>
                              </div>
                          </div>   

							           <div class="col-lg-6 p-t-20"> 
                          <label class = "mdl-textfield__label" style="margin-left: 14px;" >image</label>
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">         
                                 <input class = "mdl-textfield__input" type = "file" name="picture" id = "image" value="<?php echo $records->image;?>" accept="image/gif, image/jpeg, image/jpg, image/png">
                                  <span class="intro" id="errorprofile"></span>
                                 <a href="<?php echo base_url();?>uploads/user/<?php echo $records->image;?>">
                                 <img src="<?php echo base_url();?>uploads/user/<?php echo $records->image;?>" alt="" style="height: 60px;width: 60px;margin-left:  200px;margin-top:-104px;"></a>
                              </div>
                          </div>  

                          <div class="col-lg-6 p-t-20"> 
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                 <select class = "mdl-textfield__input" id="sub_cat" name="sub_cat" style="text-transform: capitalize;">
                                  <?php 
                                   $catId = $records->sub_cat_id;
                                   foreach ($subcat as $c) {
                                     if ($catId == $c['sub_cat_id']) {?>
                                       <option value="<?php echo $c['sub_cat_id'];?>" selected><?php echo $c['sub_cat_name'];?></option>
                                     <?php }
                                   }
                                  ?>
                                 
                                 </select>
                                 <label class = "mdl-textfield__label" >Item Category Name</label>
                                  <span class="intro" id="errorname"></span>
                              </div>
                           </div>
                
								         <div class="col-lg-12 p-t-20 text-center"> 
							              	<button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-primary">Submit</button>
											
							            </div>
								    	</div>
                      </form>
                     <?php 
                   // } 
                   ?>
								</div>
							</div>
						</div> 
         </div>
       </div>
       
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script type="text/javascript">
$(document).ready(function()
 {
    $("#freename").on('change', function() {
        var level = $(this).val();
        if(level){
            $.ajax ({                
                type: 'GET',
                url: '<?php echo base_url(); ?>index.php/Banner/getSubCat/'+level,
                success: function(data){
                var obj = JSON.parse(data); 
                  if(obj.length>0){
                   $("#sub_cat option").remove();
                  for(var i=0; i<obj.length; i++){
                    $('#sub_cat').append("<option value='"+obj[i].sub_cat_id+"' >"+obj[i].sub_cat_name+"</option>");
                  }
               }
              }
            });
        }
    });         
});
</script>        