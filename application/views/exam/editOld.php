<div class="content-wrapper">
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> <?php echo $title; ?>
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
                    <form role="form" action="<?php echo base_url().$routeName ?>" method="post" id="edit">
                        <div class="box-body">

                        <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input type="text" class="form-control" id="title" placeholder="File Name" name="title" value="<?php echo $Info->title; ?>" maxlength="128">
                                        <input type="hidden" value="<?php echo $Info->id; ?>" name="Id" id="Id" />
                                    </div>
                                    
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="catname">Category</label>
                                        <select class="form-control" id="catname" name="catname" aria-required="true">
                                            <option value="0" >Select...</option>
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
                                        <!-- <label for="ubu">Upload By User</label>
                                        <select class="form-control" id="ubu" name="ubu" aria-required="true">
                                            <option value="0" >Select...</option> 
                                            <?php
                                            /*if(!empty($Users))
                                            {
                                                foreach ($Users as $rl)
                                                {
                                                    ?>
                                                    <option value="<?php echo $rl->userId; ?>" <?php if($rl->userId == $Info->user_id) {echo "selected=selected";} ?>><?php echo $rl->name ?></option>
                                                    <?php
                                                }
                                            } */
                                            ?>
                                        </select> -->
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="subcat">Sub Category</label>
                                        <select class="form-control" id="subcat" name="subcat" aria-required="true">
                                            <option value="0">Select...</option>
                                            <?php
                                            if(!empty($SubCategory)) {
                                                if($SubCategory->id){
                                                ?>
                                                    <option value="<?php echo $SubCategory->id; ?>" <?php if($SubCategory->id == $Info->subcategory_id){ echo "selected"; } ?>><?php echo $SubCategory->name ?></option>
                                                <?php
                                                }else{
                                                    foreach ($SubCategory as $rl) {
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

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="noq">Number Of Questions</label>
                                        <input type="number" class="form-control" id="noq" placeholder="Number Of Questions" name="noq" value="<?php echo $Info->no_of_question; ?>" >
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="duration">Exam Duration (In Mintes)</label>
                                        <input type="number" class="form-control" id="duration" placeholder="Exam Duration" name="duration" value="<?php echo $Info->duration; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="year">Year</label>
                                        <input type="number" class="form-control required" value="<?php echo $Info->year; ?>" id="year" name="year" maxlength="4">
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
    getAjax('#catname', "#subcat", 'examsubcat/', "...", 'name');
    $(document).ready(function(){
        var editUserForm = $("#edit");
        var validator = editUserForm.validate({
            rules:{
                title :{ required : true },
                noq :{ required : true, digits : true },
                duration :{ required : true, digits : true },
                catname : { required : true, selected : true},
                subcat : { required : true, selected : true}
            },
            messages:{
                title :{ required : "This field is required" },
                noq : { required : "This field is required", digits : "Please enter numbers only" },
                duration : { required : "This field is required", digits : "Please enter numbers only" },
			    catname : { required : "This field is required", selected : "Please select atleast one option" },
			    subcat : { required : "This field is required", selected : "Please select atleast one option" }
            }
        });
    });

</script>