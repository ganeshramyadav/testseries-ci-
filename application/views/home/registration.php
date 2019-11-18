<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>CodeInsect | Admin System Log in</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />

   
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
      
    <style>
      /* .body{
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
      } */
      /* .backImg{
        background-image: url(https://www.tomswallpapers.com/large/201702/97538.jpg);
      } */

      /* Style the tab */
      .tab {
        float: left;
        width: 30%;
        border-radius: 20px;
        padding:0 10px 0 10px;
      }
      .tablinks{
        font-weight: 700;
        color: #ffce9b;
      }

      /* Style the buttons inside the tab */
      .tab button {
        display: block;
        background-color: inherit;
        color: white;
        padding: 22px 16px;
        width: 100%;
        border: none;
        outline: none;
        text-align: left;
        cursor: pointer;
        transition: 0.3s;
        font-size: 17px;
      }

      /* Change background color of buttons on hover */
      .tab button:hover {
        background-color: #ddd;
      }

      /* Create an active/current "tab button" class */
      .tab button.active {
        background-color: #352817
        ;
      }

      /* Style the tab content */
      .tabcontent {
        padding: 0px 12px;
        border-left: none;
        background-color: #35281787;
      }
      .width-half{
        width: 60%;
      }

      .form-control{
        font-size: 18px;
        color: #ffffff !important;
        background-color: #311705cf !important;
        border: 1px solid #cccccc21 !important;
      }
      .text-color{
        color:#ffffff;
        font-size: 14pt;
      }
      </style>
  
  </head>
  <body class="hold-transition login-page backImg body">
    <div class="login-box" style="margin: 3% auto 0 auto;">
      <div class="login-logo">
        <a href="#"><span class="text-color"><b>Registration</b><br>Admin System</span></a>
      </div><!-- /.login-logo -->
    </div><!-- /.login-box -->

    <div class="login-box width-half" style="margin: 3% auto 0 auto;">
      <!-- <div class="tab">
        <button class="tablinks" onclick="openTab(event, 'Students')" id="defaultOpen">For Student Registration</button>
        <button class="tablinks" onclick="openTab(event, 'Institutes')">For Institute</button>
      </div> -->
      <div class="row">
        <div class="col-md-12">
          <div id="Students" class="tabcontent">
            <?php $this->load->view('home/studentWizard'); ?>
          </div>
        </div>
        <div class="row">
          <?php $this->load->helper('form'); ?>
            <!-- <div class="row"> -->
                <div class="col-md-4">
                    <?php echo validation_errors('<div class="alert alert-danger style="background-color:#381d06 !important;" alert-dismissable">', ' <button type="button" class="close" style="color:white;" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                </div>
            <!-- </div> -->
            <?php
            $this->load->helper('form');
            $error = $this->session->flashdata('error');
            if($error)
            {
                ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $error; ?>                    
                </div>
            <?php }
            $success = $this->session->flashdata('success');
            if($success)
            {
                ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $success; ?>                    
                </div>
          <?php } ?>



      
        </div>
      </div>
      <!-- <div class="row"> -->
       
        <!-- </div> -->
    <!-- </div> -->

    <div class="login-box">
        
    </div>
    <script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script>
      function openTab(evt, tabName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
          tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
          tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(tabName).style.display = "block";
        evt.currentTarget.className += " active";
      }

      // Get the element with id="defaultOpen" and click on it
      document.getElementById("defaultOpen").click();
    </script>
    <script>
     $(document).ready(function(){
        $("#studentsform").hide();
        $("#institutesform").hide();
        $('#regType').on('change', function() {
        if ( this.value == '1'){
            $("#studentsform").show();
            $("#institutesform").hide();
        } else if ( this.value == '2') {
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