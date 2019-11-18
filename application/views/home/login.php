
<?php $this->load->view('home/header'); ?>
<style>
.btn-social{
    color: #ffffff !important;
    padding-left: 10px !important;
    border-radius: 30px;
}
.btn-social>:first-child {
    left: unset !important;
    right: 0 !important;
}
.text{
    font-weight: 500;
    font-size: large;
}
.form-control{
    border-radius: 30px;
    font-size: 16pt;
}
.login-box-body{
    background: #c16733a3 !important;
    border-radius: 33px;
    color: #ece2e2 !important;
}
.btn-sign{
    background: #86440bdb !important;
    border-color: #6d3509eb !important;
}
.btn-flat{
    border-radius: 30px !important;
}
.btn-flat:hover{
    background: #ffcf9fa3 !important;
    color: #1f1b1be0 !important;
    border-color: #aaa !important;
}
.text-color{
    color: #ffffff !important;
}

</style>
    <link href="<?php echo base_url(); ?>assets/css/blue.css" rel="stylesheet" type="text/css" />
    <div class="login-box">
    <div class="login-box-body">
        <p class="login-box-msg text">Welcome to AOA</p>

        <?php $this->load->helper('form'); ?>
        <div class="row">
            <div class="col-md-12">
                <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
            </div>
        </div>
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

        <form action="<?php echo base_url(); ?>loginMe" method="post">
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
            <!-- /.col -->
            <div class="col-xs-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat btn-sign">Sign In</button>
            </div>
            <!-- /.col -->
        </div>
        </form>

        <div class="social-auth-links text-center">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-social btn-facebook btn-flat">
            Sign in using Facebook
            <i class="fa fa-facebook"></i> </a>
        <a href="#" class="btn btn-block btn-social btn-google btn-flat">
            Sign in using Google+
            <i class="fa fa-google-plus"></i> </a>
        </div>
        <!-- /.social-auth-links -->

        <a href="#" class="text-color">I forgot my password</a><br>
        <a href="<?php echo base_url().'register'; ?>" class="text-color">Register a new membership</a>
        </div>
    </div>
    <!-- <script src=<?php //echo base_url()."assets/js/icheck.min.js"?>></script> -->
<?php $this->load->view('home/footer'); ?>