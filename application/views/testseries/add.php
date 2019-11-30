<div class="content-wrapper">
    <!-- Content Header (Page header) -->
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
                        <h3 class="box-title">Examination Details</h3>
                    </div>
                    <!-- form start -->
                    <?php $this->load->helper("form"); ?>
                    <form role="form" id="add" action="<?php echo base_url().$routeName ?>" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="title">Test Series Name</label>
                                        <input type="text" class="form-control" id="title" placeholder="Test Series Name" name="title" value="<?php echo set_value('title'); ?>" maxlength="128">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="noe">Number Of Examination</label>
                                        <input type="number" class="form-control" id="noe" placeholder="Number Of Examination" name="noe" value="<?php echo set_value('no_of_exam'); ?>" >
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="isPublic">Public Access</label>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="isPublic" id="free" value="1">
                                                Free (For All Student)
                                            </label>
                                            <p></p>
                                            <label>
                                                <input type="radio" name="isPublic" id="paid" value="0">
                                                Paid (For Paid Student)
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group" id="amount">
                                        <label for="currency-field">Price(In Rs.)</label>
                                        <p></p>
                                        <input type="text" class="form-control" name="currency-field" id="currency-field" value="<?php echo set_value('price'); ?>" data-type="currency" >
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="thumb">Thumbnail ( Only JPG )</label>
                                        <input type="file" name="thumb" id="thumb" accept="image/jpg,image/jpeg,image/png" />
                                    </div>
                                    <!-- <?php if($Info->image_url){ ?>
                                    <div class="form-group">
                                        <a class="btn btn-primary" href="<?php echo base_url().$Info->image_url ?>" target="blank">
                                        <?php if(!empty($Info->image_url)){ ?>
                                            <i class="fa fa-file-image-o" aria-hidden="true"></i>
                                            <span>View Thumbnail</span>
                                        <?php } ?>
                                        </a>
                                    </div>
                                    <?php } ?> -->
                                </div>
                            </div>

                            <!--<div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="subcat">Sub Category</label>
                                        <select class="form-control" id="subcat" name="subcat" aria-required="true">
                                            <option value="0">Select...</option>
                                            <?php
                                            if(!empty($SubCategory)) {
                                                if($SubCategory->id){
                                                ?>
                                                    <option value="<?php echo $SubCategory->id; ?>" <?php if($SubCategory->id == set_value('subcat')) {echo "selected=selected";} ?>><?php echo $SubCategory->name ?></option>
                                                <?php
                                                }else{
                                                    foreach ($SubCategory as $rl) {
                                                        ?>
                                                        <option value="<?php echo $rl->id; ?>" <?php if($rl->id == set_value('subcat')) {echo "selected=selected";} ?>><?php echo $rl->name ?></option>
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
                                            <option value="0" >Inactive</option>
                                            <option value="1" >Active</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="noq">Number Of Questions</label>
                                        <input type="number" class="form-control" id="noq" placeholder="Number Of Questions" name="noq" value="<?php echo set_value('noq'); ?>" >
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="duration">Exam Duration (In Mintes)</label>
                                        <input type="number" class="form-control" id="duration" placeholder="Exam Duration" name="duration" value="<?php echo set_value('duration'); ?>">
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
                            </div> -->
                            
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

<script type="text/javascript">
    $(document).ready(function(){
        var editUserForm = $("#add");
        var validator = editUserForm.validate({
            rules:{
                title :{ required : true },
                noe :{ required : true, digits : true }
            },
            messages:{
                title :{ required : "This field is required" },
                noe : { required : "This field is required", digits : "Please enter numbers only" }
            }
        });
    });

    $(document).ready(function(){
        if(document.getElementById("currency-field").value > 0){
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
