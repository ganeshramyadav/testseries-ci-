<div class="content-wrapper">
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> <?php echo $pageTitle; ?>
      </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-8">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title"> Details</h3>
                    </div>
                    <?php $this->load->helper("form"); ?>
                    <form role="form" action="<?php echo base_url().$routeName ?>" method="post" id="edit" enctype="multipart/form-data">
                        <div class="box-body">

                            <div class="row">
                                <?php if($redirect == "subcategory" || $redirect == "examsubcategory"){?>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="catname">Category</label>
                                            <select class="form-control" id="catname" name="catname" aria-required="true">
                                                
                                                <?php
                                                if(!empty($Category)) {
                                                    if($Category->id){
                                                    ?>
                                                        <option value="<?php echo $Category->id; ?>" <?php if($Category->id == $Info->category_id){ echo "selected"; } ?>><?php echo $Category->name ?></option>
                                                    <?php
                                                    }else{
                                                        foreach ($Category as $rl) {
                                                            ?>
                                                            <option value="<?php echo $rl->id; ?>" <?php if($rl->id == $Info->category_id){ echo "selected"; } ?>><?php echo $rl->name ?></option>
                                                            <?php
                                                        }
                                                    }
                                                } 
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <?php }?>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" placeholder="Name" name="name" value="<?php echo $Info->name; ?>" maxlength="128">
                                        <input type="hidden" value="<?php echo $Info->id; ?>" name="Id" id="Id" />
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select class="form-control" id="status" name="status" >
                                            <option value="0" <?php if($Info->active == 0){ echo "selected"; } ?>>Inactive</option>
                                            <option value="1" <?php if($Info->active == 1){ echo "selected"; } ?>>Active</option>
                                        </select>
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

<!-- <script src="<?php //echo base_url(); ?>assets/js/editSm.js" type="text/javascript"></script> -->
<script src="<?php echo base_url(); ?>assets/js/ajax.js" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function(){
        var editUserForm = $("#edit");
        var validator = editUserForm.validate({
            rules:{
                name :{ required : true }
            },
            messages:{
                name :{ required : "This field is required" }
            }
        });
    });

</script>