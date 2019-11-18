<?php
    // echo "<pre>";
    // print_r($Info);
    // print_r($Users);

?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Study Material
        <small>Add / Edit </small>
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
                
                
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title"> Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                    <form role="form" action="<?php echo base_url() ?>editSm" method="post" id="editSm" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="fname">File Name</label>
                                        <input type="text" class="form-control" id="fname" placeholder="File Name" name="fname" value="<?php echo $Info->name; ?>" maxlength="128">
                                        <input type="hidden" value="<?php echo $Info->id; ?>" name="smId" id="smId" />
                                    </div>
                                    
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="ubu">Upload By User</label>
                                        <select class="form-control" id="ubu" name="ubu" aria-required="true">
                                            <option value="0" >Select...</option>
                                            <?php
                                             if(!empty($Users))
                                            {
                                                foreach ($Users as $rl)
                                                {
                                                    ?>
                                                    <option value="<?php echo $rl->userId; ?>" <?php if($rl->userId == $Info->user_id) {echo "selected=selected";} ?>><?php echo $rl->name ?></option>
                                                    <?php
                                                }
                                            } 
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="subname">Subject's Name</label>
                                        <input type="text" class="form-control" id="subname" placeholder="Subject's Name" name="subname" value="<?php echo $Info->subject; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="catname">Category Name</label>
                                        <input type="text" class="form-control" id="catname" placeholder="Category Name" name="catname" value="<?php echo $Info->category; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="smFile">Upload File</label>
                                        <input type="file" name="smFile" id="smFile" />
                                        <!-- <label style="color:#690808;"><?php //if($Info->url){ echo $Info->id.'.pdf is Exist.';} ?></label> -->
                                    </div>
                                    <?php if($Info->url){ ?>
                                    <div class="form-group">
                                        <a class="btn btn-primary" href="<?php echo $Info->url ?>" target="blank">
                                            <i class="fa fa-file-pdf-o"></i>
                                            <span>View PDF</span>
                                        </a>
                                    </div>
                                    <?php } ?>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select class="form-control" id="status" name="status" >
                                            <option value="0" <?php if($Info->status == 0){ echo "selected"; } ?>>Inactive</option>
                                            <option value="1" <?php if($Info->status == 1){ echo "selected"; } ?>>Active</option>
                                        </select>
                                    </div>
                                </div>    
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                    </div>
                                </div>
                               
                            </div>
                        </div><!-- /.box-body -->
    
                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="Submit" />
                            <input type="reset" class="btn btn-default" value="Reset" />
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <?php
                    $this->load->helper('form');
                    $error = $this->session->flashdata('error');
                    if($error)
                    {
                ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('error'); ?>                    
                </div>
                <?php } ?>
                <?php  
                    $success = $this->session->flashdata('success');
                    if($success)
                    {
                ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
                <?php } ?>
                
                <div class="row">
                    <div class="col-md-12">
                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                    </div>
                </div>
            </div>
        </div>    
    </section>
</div>

<script src="<?php echo base_url(); ?>assets/js/editSm.js" type="text/javascript"></script>