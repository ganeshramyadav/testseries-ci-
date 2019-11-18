<?php $this->load->view('home/header'); ?>
<style>
    body{
        background-color: #555961 !important;
    }
    .callout-card{
        background-color: white;
        border-radius: 14px;
        border-left:0px !important;
    }
    .btn-app{
        width: 100% !important;
        font-weight: 800 !important;
        font-size: xx-large !important;
        padding: inherit !important;
        border-radius: 30px !important;
        background-color: #86440bdb !important;
        color: #fbfbfb !important;
        border: 1px solid #ce6711 !important;
    }
    .btn-app:hover {
        background: #ffcf9fa3 !important;
        color: #1f1b1be0 !important;
        border-color: #aaa !important;
    }
    .text{
        color:#fbfbfb;
    }
</style>
    <div class="container">

        <!-- <div class="box-body">
            <a class="btn btn-app">
            <i class="fa fa-edit"></i> Edit
            </a>
            <a class="btn btn-app">
            <i class="fa fa-play"></i> Play
            </a>
            <a class="btn btn-app">
            <i class="fa fa-repeat"></i> Repeat
            </a>
            <a class="btn btn-app">
            <i class="fa fa-pause"></i> Pause
            </a>
            <a class="btn btn-app">
            <i class="fa fa-save"></i> Save
            </a>
            <a class="btn btn-app">
            <span class="badge bg-yellow">3</span>
            <i class="fa fa-bullhorn"></i> Notifications
            </a>
            <a class="btn btn-app">
            <span class="badge bg-green">300</span>
            <i class="fa fa-barcode"></i> Products
            </a>
            <a class="btn btn-app">
            <span class="badge bg-purple">891</span>
            <i class="fa fa-users"></i> Users
            </a>
            <a class="btn btn-app">
            <span class="badge bg-teal">67</span>
            <i class="fa fa-inbox"></i> Orders
            </a>
            <a class="btn btn-app">
            <span class="badge bg-aqua">12</span>
            <i class="fa fa-envelope"></i> Inbox
            </a>
            <a class="btn btn-app">
            <span class="badge bg-red">531</span>
            <i class="fa fa-heart-o"></i> Likes
            </a>
        </div> -->



            <div class="login-logo">
                <a href="#" ><span class="text"><b></b><br>Admin System</span></a>
            </div>
        
        <div class="login-box">
            <div class="row">
                <div class="box-body">
                    <a class="btn btn-app" href="<?php echo base_url().'login'; ?>">
                    <!-- <a class="btn btn-app" href="<?php //echo base_url().'testing'; ?>"> -->
                        <!-- <i class="fa fa-edit"></i> --> 
                        Guest User
                    </a>
                </div>
                <!-- <div class="callout callout-card">
                    <button type="button" class="btn btn-block btn-default btn-lg">Default</button>
                </div> -->
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="box-body">
                        <a class="btn btn-app" >
                            <!-- <i class="fa fa-edit"></i>  -->
                            TS
                        </a>
                    </div>
                    <!-- <div class="callout callout-card">
                        <button type="button" class="btn btn-block btn-default btn-lg">Default</button>
                    </div> -->
                </div>
                <div class="col-md-6">
                    <div class="box-body">
                        <a class="btn btn-app">
                            <!-- <i class="fa fa-edit"></i>  -->
                            SM
                        </a>
                    </div>
                    <!-- <div class="callout callout-card">
                        <button type="button" class="btn btn-block btn-default btn-lg">Default</button>
                        
                    </div> -->
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="box-body">
                        <a class="btn btn-app">
                            <!-- <i class="fa fa-edit"></i>  -->
                            CA
                        </a>
                    </div>
                    <!-- <div class="callout callout-card">
                        <button type="button" class="btn btn-block btn-default btn-lg">Default</button>
                    </div> -->
                </div>
                <div class="col-md-6">
                    <div class="box-body">
                        <a class="btn btn-app">
                            <!-- <i class="fa fa-edit"></i>  -->
                            Videos
                        </a>
                    </div>
                    <!-- <div class="callout callout-card">
                        <button type="button" class="btn btn-block btn-default btn-lg">Default</button>
                    </div> -->
                </div>
            </div>

            <div class="row">
                <div class="box-body">
                    <a class="btn btn-app">
                        <!-- <i class="fa fa-edit"></i>  -->
                        DF
                    </a>
                </div>
                <!-- <div class="callout callout-card">
                    <button type="button" class="btn btn-block btn-default btn-lg">Default</button>
                </div> -->
            </div>
        </div>
    </div>
  <div class="login-box">

      
     
<!-- 

  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <form action="../../index2.html" method="post">
      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false" style="position: relative;"><input type="checkbox" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> Remember Me
            </label>
          </div>
        </div>
        
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        
      </div>
    </form>

    <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
        Google+</a>
    </div>
    

    <a href="#">I forgot my password</a><br>
    <a href="register.html" class="text-center">Register a new membership</a>
    </div>
-->
  
   
  </div>


<?php $this->load->view('home/footer'); ?>