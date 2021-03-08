<!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">DailyOrder Information</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo site_url('welcome/dashboard');?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                               
                                <li class="active">DailyOrder Information</li>
                            </ol>
                        </div>
                    </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="card-box">
                  <div class="card-head">
                    <header>DailyOrder Information</header>

                 <?php echo $this->session->flashdata('Banner');?>    
                               
                  </div>
                <form action="<?php echo site_url('OrderReport/dailyorder');?>" method="post" >
                 
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="card-box">
                        <div class="card-head">
                          <!-- <header>Date Picker </header> -->
                        </div>
                        <div class="card-body ">
                          <div class="col-lg-6 p-t-20">
                            <div class="form-control-wrapper">
                              <input type="date" id="date" class="floating-label mdl-textfield__input"  placeholder="Date" onchange="getval(this.value);">
                            </div>

                          </div>
                        </div>
                      </div>
                    
                    </div>
                  </div>
                    <div class="col-lg-12 p-t-20"> 
                      <div  id="getdate"> 
                      </div>
                    </div>
          
                  <!-- <div class="card-body row">
                          
                         <div  class="col-lg-6 p-t-20"> 
                         <label class = "mdl-textfield__label" >Date</label>
                            <div class = "mdl-textfield mdl-js-textfield mdl-textfield-floating-label txt-full-width">
                              <input class = "mdl-textfield__input" type = "date" id = "date" name="order_date" style="text-transform: capitalize;" onchange="getval(this.value);">
                              
                              <span class="intro" id="errorStatename"></span>
                            </div>
                          </div>
                          <div class="col-lg-12 p-t-20"> 
                            <div  id="getdate"> 
                            </div>
                          </div>

                     </div> -->
                 </form>
              </div>
           </div>
        </div> 
     </div>
  </div>
            <!-- end page content -->
 <script type="text/javascript">
   function getval(value){
  
      $.ajax({
        type: "POST",
        url: "<?php echo site_url('OrderReport/fetchdata2');?>",
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
 