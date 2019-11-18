<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>CodeInsect | Admin System Log in</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  </head>
  <body class="hold-transition login-page">
    <div class="login-box" style="margin: 1% auto !important;">
      <div class="login-logo">
        <a href="#"><b>AOA</b><br>Onlie Study System</a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg" style="font-weight: 800; font-size: x-large;">SignUp</p>
        <?php $this->load->helper('form'); ?>
        <div class="row">
            <div class="col-md-12">
                <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
            </div>
        </div>
        <?php
        // $this->load->helper('form');
        $error = $this->session->flashdata('error');
        if($error) {
            ?>
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $error; ?>
            </div
        <?php }
        $success = $this->session->flashdata('success');
        if($success) {
            ?>
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $success; ?>                    
            </div>
        <?php } ?>

        <?php $this->load->view('home/studentWizard'); ?>

        <!-- <form action="<?php //echo base_url().'registerMe'?>" method="post">
            <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="Name" name="name">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="email" class="form-control" placeholder="Email"  name="email">
                <span class="glyphicon glyphicon-envelope form-control-feedback" ></span>
            </div>
            <div class="form-group has-feedback">
                <input type="text" class="form-control required digits" id="mobile" pattern="[6789][0-9]{9}" name="mobile" maxlength="10" minlength="10" placeholder="Mobile Number" />
                <span class="glyphicon glyphicon-phone-alt form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Password" name="password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback">
                <input type="cpassword" class="form-control" placeholder="Confirm Password" name="cpassword">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-4" style="float: right;">
                <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
                </div>
            </div>
        </form> -->


        <p class="login-box-msg" style="font-weight: 800;">
            <a href="<?php echo base_url().'login' ?>" class="text-center">I already have a membership</a>
        </p>
        <!-- <form action="<?php // echo base_url(); ?>registerMe" method="post">
          <div class="form-group has-feedback">
            <input type="email" class="form-control" placeholder="Email" name="email" required />
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Password" name="password" required />
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">
              <div class="checkbox icheck">
                <label>
                  <input type="checkbox"> Remember Me
                </label>
              </div>
            </div>
            <div class="col-xs-4">
              <input type="submit" class="btn btn-primary btn-block btn-flat" value="Sign In" />
            </div>
          </div>
        </form>

        <a href="<?php echo base_url() ?>forgotPassword">Forgot Password</a><br>
         -->
        
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script>
      // Get the element with id="defaultOpen" and click on it
    // document.getElementById("defaultOpen").click();
    $(document).ready(function(){
        $("#studentsform").hide();
        $("#institutesform").hide();
        $('#regType').on('change', function() {
        if ( this.value == '1'){
            $("#studentsform").show();
            $("#institutesform").hide();
        } else if ( this.value == '2' ) {
            $("#institutesform").show();
            $("#studentsform").hide();
        }else{
          $("#studentsform").hide();
          $("#institutesform").hide();
        }
        });
    }); 
    </script>
  </body>
</html>