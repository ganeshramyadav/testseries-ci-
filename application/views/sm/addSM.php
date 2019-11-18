<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> <?php echo $pageTitle; ?>
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
                        <h3 class="box-title">Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <?php $this->load->helper("form"); ?>
                    <form role="form" id="addSm" action="<?php echo base_url() ?>addNewSm" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="fname">Full Name</label>
                                        <input type="text" class="form-control required" value="<?php echo set_value('fname'); ?>" id="fname" name="fname" maxlength="128">
                                    </div>
                                    
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="subname">Subject's Name</label>
                                        <select class="form-control" id="subname" name="subname" aria-required="true">
                                            <option value="0" >Select...</option>
                                            <?php
                                             if(!empty($Category))
                                            {
                                                foreach ($Category as $rl)
                                                {
                                                    ?>
                                                    <option value="<?php echo $rl->id; ?>"><?php echo $rl->name ?></option>
                                                    <?php
                                                }
                                            } 
                                            ?>
                                        </select>
                                    </div>
                                    <!-- <div class="form-group">
                                        <label for="ubu">Upload By User</label>
                                        <input type="text" class="form-control required" value="<?php echo set_value('fname'); ?>" id="uploadBy" name="fname" maxlength="128">
                                    </div> -->
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="subcat">Category Name</label>
                                        <select class="form-control" id="subcat" name="subcat" aria-required="true">
                                            <option value="0" >Select...</option>
                                            <?php
                                             /* if(!empty($SubCategory))
                                            {
                                                foreach ($SubCategory as $rl)
                                                {
                                                    ?>
                                                    <option value="<?php echo $rl->id; ?>"><?php echo $rl->name ?></option>
                                                    <?php
                                                }
                                            }  */
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select class="form-control" id="status" name="status" >
                                            <option value="0" >Inactive</option>
                                            <option value="1" >Active</option>
                                        </select>
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
                                </div>
                                <div class="col-md-6">
                                    
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
<script src="<?php echo base_url(); ?>assets/js/addSm.js" type="text/javascript"></script>

<script type="text/javascript">

    function getAjax(parent, child, url, option, name){
        $(parent).change(function(e){
            if(this.value != '' || this.value != 0){
                $.ajax({
                    type: "POST",
                    url : baseURL+url+this.value,
                    success: function (response) {
                        let res = jQuery.parseJSON(response);
                        $(child).empty();
                        $(child).append('<option value="">Select '+ option +'</option>');
                        // console.log(res);
                        
                        $(res).each(function (ind,val) {
                            var branchesList='<option value="'+val.id +'">'+val[name]+'</option>';
                            $(child).append(branchesList);
                        });
                    }
                });
            }
        });
    }
    getAjax('#subname', "#subcat", 'subcat/', "SubCategory", 'name');

</script>