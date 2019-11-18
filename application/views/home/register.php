<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>CodeInsect | Admin System Log in</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <style>
        body {
            overflow-y: hidden !important;
        }
    </style>
  </head>
  <body class="hold-transition login-page">
    <div class="login-box" style="margin: auto !important;">
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

        <p class="login-box-msg" style="font-weight: 800;">
            <a href="<?php echo base_url().'login' ?>" class="text-center">I already have a membership</a>
        </p>

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script>
      // Get the element with id="defaultOpen" and click on it
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