<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Profile Management</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link href='http://fonts.googleapis.com/css?family=Marcellus' rel='stylesheet' type='text/css'>
  <!-- <link href="http://localhost/CodeIgniter/css/styles.css" rel="stylesheet" type="text/css"> -->

  <!-- input mask -->
   <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
   <script type="text/javascript" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>

</head>
<style>
.savechangebtn{
  border-radius: 0px;
  background-color: #2AA7AB;
  color: white;
  padding: 8px;
  width: 150%;
}
.savechangebtn:hover
{
    background-color: #2AA7AB;
    color: #fff;
   width: 150%;
    border-radius: 0px;

}
.cancle_btn{
  border: 1px solid black;
  width: 417%;
}

.cancle_btn a, .cancle_btn a:hover {
    color: #000;
    font-size: 16px;
}
a:hover, a:visited, a:link, a:active
{
    text-decoration: none;
}

</style>
<body class="hold-transition skin-blue sidebar-mini centered" style="background: #ECECEC;">
<!-- start page content -->

<div class="page-content-wrapper">
    <div class="page-content">
      <div class="page">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Edit Vendor profile </div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="<?php echo site_url('Vendor/dashboard');?>">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>
                   
                    <li class="active">Edit Vendor Profile</li>
                </ol>
            </div>
        </div>
        <div class="profilepage" style="background: #fff;">
          <div class="container">
            <div class="row">
              <form class="form-horizontal" name="form" role="form" method="post" action="<?php echo 'uploadProfile'?>" enctype="multipart/form-data">
                  <?php //print_r($vendorDetail); 
                  foreach($vendorDetail as $row){
                  //echo $row['name'];
                  }?>
                  <div class="col-md-2"> 
                      <div class = "user-profile" style="margin-right:-55%;">
                       <div class = "form-group">  
                            <img src="<?php echo base_url();?>/<?php echo  $row['profile'];?>" style="height: 200px;width:200px; margin-bottom: 20px; margin-top:50px;    margin-left: 36px;" alt="" >
                        </div>
                        <div class = "form-group">   
                           <input class = "form-control" type = "hidden" name="picture1"  value="<?php echo  $row['profile']; ?>"  > 
                           <input class = "form-control" type = "file" name="picture" id = "id"  style="padding: 2px;margin-left: 22px"  accept="image/gif, image/jpeg, image/jpg, image/png" > 
                          <span class="intro" id="errorprofile"></span>
                          <a href="<?php echo base_url();?>/<?php echo  $row['profile'];?>"></a>              
                       </div>    
                    </div>
                   </div>   
                  <div class="col-md-10 personal-profile" style="padding-left: 330px;">
                    <?php echo$this->session->flashdata('msg'); ?>
                    <h3 style="text-align:center;"><b>Profile</b></h3>
                      <div class="form-group">
                        <div class="col-lg-12">
                          <input class="form-control  custom-input" name="name" type="text" value="<?php echo  $row['name']; ?>"  placeholder="Please Enter a Name">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-lg-12">
                          <input class="form-control  custom-input" type="text"  value="<?php echo  $row['address']; ?>" name="address"  placeholder="Please Enter a Address">
                        </div>
                      </div>  
                      <div class="form-group">
                      <div class="col-lg-12">
                        <input class="form-control custom-input" name="email" type="email" value="<?php echo  $row['email']; ?>"  placeholder="Please Enter a  Email">
                      </div>
                      </div>
                      <div class="form-group">
                        <div class="col-lg-12">
                          <input class="form-control custom-input" name="phone" type="text" value="<?php echo  $row['phone']; ?>"   placeholder="Please Enter a Phone number">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-lg-12">
                          <input class="form-control custom-input" name="pwd" type="password" value="<?php echo  $row['pwd']; ?>"   placeholder="Please Enter a password">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-4 savebutton">
                          <input type="submit" class="btn savechangebtn"  onclick=" return validatedate(document.form.dob)" value="Save Changes"     >
                        </div>
                        <div class="col-md-4" style="padding-left:125px; " >
                            <button class="btn cancle_btn" style="border-radius: 0px;" > <a href="<?php echo base_url(); ?>index.php/Vendor/dashboard"> cancel </a> 
                        </div>
                      </div>
                </div>         
              </form>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>



