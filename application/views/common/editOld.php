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
                    <form role="form" action="<?php echo base_url().$routeName ?>" method="post" id="editSm" enctype="multipart/form-data">
                        <div class="box-body">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fname">File Name</label>
                                        <input type="text" class="form-control" id="fname" placeholder="File Name" name="fname" value="<?php echo $Info->name; ?>" maxlength="128">
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
                                            <option value="0" >Select...</option>
                                            <?php
                                            if(!empty($SubCategory))
                                            {
                                                foreach ($SubCategory as $rl)
                                                {
                                                    ?>
                                                    <option value="<?php echo $rl->id; ?>" <?php if($rl->id==$Info->subcategory_id){ echo "selected";}?>><?php echo $rl->name ?></option>
                                                    <?php
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
                                    <label for="institute">Institute Name</label>
                                        <select class="form-control" id="institute" name="institute" aria-required="true">
                                            <option value="0" >Select...</option>
                                            <?php
                                            if(!empty($Institute)) {
                                                if($Institute->id){
                                                    ?>
                                                        <option value="<?php echo $Institute->id; ?>" <?php if($Institute->id == $Info->institute_id){ echo "selected"; } ?>><?php echo $Institute->name ?></option>
                                                    <?php
                                                }else{
                                                    foreach ($Institute as $rl) {
                                                        ?>
                                                        <option value="<?php echo $rl->id; ?>"<?php if($rl->id == $Info->institute_id){ echo "selected"; } ?>><?php echo $rl->name ?></option>
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
                                        <label for="year">Year</label>
                                        <input type="number" class="form-control required" value="<?php echo $Info->year; ?>" id="year" name="year" maxlength="4">
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="isPublic">Public Access</label>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="isPublic" id="free" value="0" <?php if($Info->isPublic == 0){ echo "checked"; } ?>>
                                                Free (For All Student)
                                            </label>
                                            
                                            <label>
                                                <input type="radio" name="isPublic" id="paid" value="1" <?php if($Info->isPublic == 1){ echo "checked"; } ?>>
                                                Paid (For Paid Student)
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group" id="amount">
                                        <label for="price">Price(In Rs.)</label>
                                        <input type="text" class="form-control" name="currency-field" id="currency-field" value="<?php echo $Info->price; ?>" data-type="currency" >
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="smFile">Upload File <?php if($redirect != 'video'){echo " ( Only PDF ) ";}else{ echo " ( Only VIDEO ) ";} ?></label>
                                        <input type="file" name="smFile" id="smFile" accept="<?php echo $fileType; ?>" />
                                    </div>
                                    <?php if($Info->url){ ?>
                                    <div class="form-group">
                                        <a class="btn btn-primary" href="<?php echo $Info->url ?>" target="blank">
                                        <?php if($Info->video == 0){ ?>
                                            <i class="fa fa-file-pdf-o"></i>
                                            <span>View PDF</span>
                                        <?php }else{ ?>
                                            <i class="fa fa-file-video-o "></i>
                                            <span> Video </span>
                                        <?php } ?>
                                        </a>
                                    </div>
                                    <?php } ?>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="thumb">Thumbnail ( Only JPG )</label>
                                        <input type="file" name="thumb" id="thumb" accept="image/jpg,image/jpeg,image/png" />
                                    </div>
                                    <?php if($Info->image_url){ ?>
                                    <div class="form-group">
                                        <a class="btn btn-primary" href="<?php echo base_url().$Info->image_url ?>" target="blank">
                                        <?php if(!empty($Info->image_url)){ ?>
                                            <i class="fa fa-file-image-o" aria-hidden="true"></i>
                                            <span>View Thumbnail</span>
                                        <?php } ?>
                                        </a>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                            

                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="desc">Description</label>
                                        <textarea name="desc" id="desc" class="form-control" rows="3" cols="12"><?php echo $Info->description; ?></textarea>
                                        <!-- <input type="text" name="desc" id="desc" /> -->
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
    getAjax('#catname', "#subcat", 'subcat/', "SubCategory", 'name');
    $(document).ready(function(){
        if(document.getElementById("currency-field").value != ''){
            $("#amount").show();
        }else{
            $("#amount").hide();
        }
        
        $("#paid").click(function(){
            $("#amount").show();
        });
        $("#free").click(function(){
            $("#amount").hide();
        });
    });

    $('input[name="number"]').keyup(function(e){
        if (/\D/g.test(this.value)){
            // Filter non-digits from input value.
            this.value = this.value.replace(/\D/g, '');
        }
    });

    $("input[data-type='currency']").on({
        keyup: function() {
        formatCurrency($(this));
        },
        blur: function() { 
        formatCurrency($(this), "blur");
        }
    });


    function formatNumber(n) {
        // format number 1000000 to 1,234,567
        return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
    }


    function formatCurrency(input, blur) {
        // appends $ to value, validates decimal side
        // and puts cursor back in right position.
        
        // get input value
        var input_val = input.val();
        
        // don't validate empty input
        if (input_val === "") { return; }
        
        // original length
        var original_len = input_val.length;

        // initial caret position 
        var caret_pos = input.prop("selectionStart");
            
        // check for decimal
        if (input_val.indexOf(".") >= 0) {

            // get position of first decimal
            // this prevents multiple decimals from
            // being entered
            var decimal_pos = input_val.indexOf(".");

            // split number by decimal point
            var left_side = input_val.substring(0, decimal_pos);
            var right_side = input_val.substring(decimal_pos);

            // add commas to left side of number
            left_side = formatNumber(left_side);

            // validate right side
            right_side = formatNumber(right_side);
            
            // On blur make sure 2 numbers after decimal
            if (blur === "blur") {
            right_side += "00";
            }
            
            // Limit decimal to only 2 digits
            right_side = right_side.substring(0, 2);

            // join number by .
            input_val = left_side + "." + right_side;
            // input_val = "Rs " + left_side + "." + right_side;

        } else {
            // no decimal entered
            // add commas to number
            // remove all non-digits
            input_val = formatNumber(input_val);
            input_val = input_val;
            // input_val = "Rs " + input_val;
            
            // final formatting
            if (blur === "blur") {
            input_val += ".00";
            }
        }
        
        // send updated string to input
        input.val(input_val);

        // put caret back in the right position
        var updated_len = input_val.length;
        caret_pos = updated_len - original_len + caret_pos;
        input[0].setSelectionRange(caret_pos, caret_pos);
    }


</script>