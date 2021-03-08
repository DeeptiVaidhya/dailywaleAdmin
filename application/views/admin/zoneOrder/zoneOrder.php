  <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Zone Order</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo site_url('welcome/dashboard');?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                               
                                <li class="active">Zone Order</li>
                            </ol>
                        </div>
                    </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="card-box">
                  <div class="card-head">
                    <header>Zone Order Information</header>

                 <?php echo $this->session->flashdata('Subzone');?>    
                               
                  </div>
                <form action="<?php echo site_url('OrderReport/zoneorder');?>" method="post" >
                    <div class="card-body row">
                      <div class="col-lg-6 p-t-20"> 
                          <div class = "mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                                 <label class = "mdl-textfield__label" style="margin-top: -4%;">zone Name</label>
                                 <select class = "mdl-textfield__input" id = "freename" name="zone_name" style="text-transform: capitalize;" onchange="getval(this.value);">
                                  <option value="">Select Zone</option>
                                  <?php 
                                  foreach ($zone as $key) { ?>
                                    <option value="<?php echo $key['zone_id'];?>"><?php echo $key['zone_name'];?></option>
                                  <?php }
                                  ?>
                                 </select>
                                  <span class="intro" id="errorname"></span>
                              </div>
                            </div>
                            <div class="col-lg-12 p-t-20"> 
                              <div  id="getdate"> 
                              </div>
                            </div>
                      </div>
                 </form>
             </div>
         </div>
     </div> 
 </div>

 <script type="text/javascript">
   function getval(value){
  
      $.ajax({
        type: "POST",
        url: "<?php echo site_url('OrderReport/fetchdata');?>",
        data: "value1="+value,
      success: function(data){
       if(data){
          document.getElementById("getdate").innerHTML = data;
        }else{

        }
      }
      });
   }
 </script>

<!--  <script type="text/javascript">
  function sendmessage(oid){
    /*alert('hi');
    alert(oid);*/
      $.ajax({
      type:'GET',
      url: "sendmessage.php",
      data:"oid="+oid+"&method=CustomOrder",
      success: function(response){
        console.log(response);
        if (response==1) {
              alert('Your barcode is empty!');
              // console.log('done');
           // location.reload();
            } else if(response==0){
              alert('Your Order status not Dispached!');
            }
            else if(response==2){
              alert('Send message on mobile!');
            }
      }
    });
  }
</script> -->