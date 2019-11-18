<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> <?php echo $pageTitle; ?>
        <!-- <small>Add / Edit </small> -->
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
                    <form role="form" action="<?php echo base_url().$routeName ?>" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label for="catname">Category</label>
                                        <select class="form-control" id="catname" name="catname" aria-required="true">
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
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label for="subcat">Sub Category</label>
                                        <select class="form-control" id="subcat" name="subcat" aria-required="true">
                                            <option value="0" >Select...</option>
                                            
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="year">Year</label>
                                        <input type="number" class="form-control required" value="<?php echo set_value('year'); ?>" id="year" name="year" maxlength="4">
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

                            <!-- <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="isPublic">Public Access</label>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="isPublic" id="free" value="0" checked>
                                                Free (For All Student)
                                            </label>
                                            <label>
                                                <input type="radio" name="isPublic" id="paid" value="1">
                                                Paid (For Paid Student)
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group" id="amount">
                                        <label for="price">Price(In Rs.)</label>
                                        <input type="text" class="form-control" name="currency-field" id="currency-field" value="" data-type="currency" >
                                    </div>
                                </div>
                            </div> -->
                            
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="question">Question's</label>
                                        <div class='box-body pad'>
                                            <!-- <form> -->
                                                <textarea id="question" name="question" rows="5" cols="50">
                                                    
                                                </textarea>
                                            <!-- </form> -->
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-6">
                                                <label for="answer1">Option A</label>
                                            </div>
                                            <div class="col-md-6 col-sm-6">
                                                <!-- class="radio"  -->
                                                <div class="form-group has-success">
                                                    <label for="options">
                                                        <input type="radio" name="options" value="1" >
                                                        Currect Answer
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                            
                                        <div class='box-body pad'>
                                            <!-- <form> -->
                                                <textarea id="answer1" name="answer1" rows="5" cols="50">
                                                    
                                                </textarea>
                                            <!-- </form> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-6">
                                                <label for="answer1">Option B</label>
                                            </div>
                                            <div class="col-md-6 col-sm-6">
                                                <!-- class="radio"  -->
                                                <div class="form-group has-success">
                                                    <label for="options">
                                                        <input type="radio" name="options" value="2" >
                                                        Currect Answer
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class='box-body pad'>
                                            <!-- <form> -->
                                                <textarea id="answer2" name="answer2" rows="5" cols="50">
                                                    
                                                </textarea>
                                            <!-- </form> -->
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-6">
                                                <label for="answer1">Option C</label>
                                            </div>
                                            <div class="col-md-6 col-sm-6">
                                                <!-- class="radio"  -->
                                                <div class="form-group has-success">
                                                    <label for="options">
                                                        <input type="radio" name="options" value="3" >
                                                        Currect Answer
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class='box-body pad'>
                                            <!-- <form> -->
                                                <textarea id="answer3" name="answer3" rows="5" cols="50">
                                                    
                                                </textarea>
                                            <!-- </form> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        
                                        <div class="row">
                                            <div class="col-md-6 col-sm-6">
                                                <label for="answer4">Option D</label>
                                            </div>
                                            <div class="col-md-6 col-sm-6">
                                                <!-- class="radio"  -->
                                                <div class="form-group has-success">
                                                    <label for="options">
                                                        <input type="radio" name="options" value="4" >
                                                        Currect Answer
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class='box-body pad'>
                                            <!-- <form> -->
                                                <textarea id="answer4" name="answer4" rows="5" cols="50">
                                                    
                                                </textarea>
                                            <!-- </form> -->
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="desc">Description</label>
                                        <div class='box-body pad'>
                                            <!-- <form> -->
                                                <textarea id="desc" name="desc" rows="5" cols="50">
                                                    <?php echo set_value('desc'); ?>
                                                </textarea>
                                            <!-- </form> -->
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- /.box-body -->
    
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
<!-- <script src="<?php //echo base_url(); ?>assets/js/addSm.js" type="text/javascript"></script> -->
<script src="<?php echo base_url(); ?>assets/js/ajax.js" type="text/javascript"></script>
<!-- CK Editor -->
<script src="<?php echo base_url(); ?>assets/dist/js/ckeditor/ckeditor.js" type="text/javascript"></script>

<script type="text/javascript">
    getAjax('#catname', "#subcat", 'subcat/', "SubCategory", 'name');
    $(function() {
        CKEDITOR.replace('question');
        CKEDITOR.replace('answer1');
        CKEDITOR.replace('answer2');
        CKEDITOR.replace('answer3');
        CKEDITOR.replace('answer4');
        CKEDITOR.replace('desc');
    });
</script>