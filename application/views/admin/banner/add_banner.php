<!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Add Banner</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo site_url('welcome/dashboard');?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                               
                                <li class="active">Add Banner</li>
                            </ol>
                        </div>
                    </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="card-box">
                  <div class="card-head">
                    <header>Banner Information</header>

                 <?php echo $this->session->flashdata('Banner');?>    
                               
                  </div>
                <form action="<?php echo site_url('Banner/add_banner');?>" method="post" >
                  <div class="card-body row">
                          <div  class="col-lg-6 p-t-20"> 
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">

                                <select class = "mdl-textfield__input" name="banner_type">
                                  <option value="">Select type</option>
                                  <option value="Home">Home</option>
                                  <option value="Category">Category</option>
                                </select>
                                 <label class = "mdl-textfield__label" >Banner_type</label>
                                  <span class="intro" id="errorStatename"></span>
                              </div>
                          </div>


                          <div  class="col-lg-6 p-t-20"> 
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">

                                <select class = "mdl-textfield__input" name="application_type">
                                  <option value="">Select type</option>
                                  <option value="Service">Service</option>
                                  <option value="Subscription">Subscription</option>
                                </select>
                                 <label class = "mdl-textfield__label" >Application_type</label>
                                  <span class="intro" id="errorStatename"></span>
                              </div>
                          </div>
                          <div class="col-lg-6 p-t-20"> 
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                 <select class = "mdl-textfield__input" id = "freename" name="item_name" style="text-transform: capitalize;">
                                  <?php 
                                
                                  foreach ($item as $key) { ?>
                                    <option value="<?php echo $key['item_id'];?>"><?php echo $key['item_name'];?></option>
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

                                 <input class = "mdl-textfield__input" type = "file" name="picture" id = "profile" accept="image/gif, image/jpeg, image/jpg, image/png" >
                          
                                   <span class="intro" id="errorprofile"></span>
                              </div>
                          </div>

                          <div class="col-lg-6 p-t-20"> 
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                 <select class = "mdl-textfield__input" id="sub_cat" name="sub_cat" style="text-transform: capitalize;">
                                  <option value="1">--- Select ---</option>
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
                </div>
              </div>
            </div> 
         </div>
       </div>
            <!-- end page content -->
        <script>
   function validation(){ 

   var freename =document.getElementById('freename').value;
   if(freename.length==""){
   
   document.getElementById('errorname').innerHTML = "Please Enter Company Name!";
   return false;
   }
 
   var email =document.getElementById('email').value;
   if(email.length==""){
   
   document.getElementById('erroremail').innerHTML = "Please Enter Email!";
   return false;
   }

    var email=/^\w+[\+\.\w-]*@([\w-]+\.)*\w+[\w-]*\.([a-z]{2,4}|\d+)$/i
   var email=email.test(document.getElementById("email").value);
   if(email==false)
   {
   
   document.getElementById('erroremail').innerHTML = "Please Enter valid Email id !";
   return false;
   }

  
   var add =document.getElementById('Estabilish date').value;
   if(add.length==""){
   
   document.getElementById('errorLink').innerHTML = "Please Enter Estabilish date!";
   return false;
   }

}
 </script>

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