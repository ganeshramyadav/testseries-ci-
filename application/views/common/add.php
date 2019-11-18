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
                    <form role="form" id="addSm" action="<?php echo base_url().$routeName ?>" method="post" enctype="multipart/form-data">
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
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="subcat">Sub Category</label>
                                        <select class="form-control" id="subcat" name="subcat" aria-required="true">
                                            <option value="0" >Select...</option>
                                            
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
                                    <label for="institute">Institute Name</label>
                                        <select class="form-control" id="institute" name="institute" aria-required="true">
                                            <option value="0" >Select...</option>
                                            <?php
                                            if(!empty($Institute)) {
                                                if(isset($Institute->id)){
                                                    ?>
                                                        <option value="<?php echo $Institute->id; ?>" ><?php echo $Institute->name ?></option>
                                                    <?php
                                                    }else{
                                                    foreach ($Institute as $rl) {
                                                        ?>
                                                        <option value="<?php echo $rl->id; ?>"><?php echo $rl->name ?></option>
                                                        <?php
                                                    }
                                                }
                                            } 
                                            ?>
                                        </select>
                                        <!-- <label for="uploaderName">Uploader Name</label>
                                        <select class="form-control" id="uploaderName" name="uploaderName" aria-required="true">
                                            <option value="0" >Select...</option>
                                            <?php
                                            /* if(!empty($Users))
                                            {
                                                foreach ($Users as $rl)
                                                {
                                                    ?>
                                                    <option value="<?php echo $rl->id; ?>"><?php echo $rl->first_name." ".$rl->last_name ?></option>
                                                    <?php
                                                }
                                            }  */
                                            ?>
                                        </select> -->
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="year">Year</label>
                                        <input type="number" class="form-control required" value="<?php echo set_value('year'); ?>" id="year" name="year" maxlength="4">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
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
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="smFile">Upload File</label>
                                        <input type="file" name="smFile" id="smFile" accept="<?php echo $fileType; ?>" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="thumb">Thumbnail ( Only JPG )</label>
                                        <input type="file" name="thumb" id="thumb" accept="image/jpg,image/jpeg,image/png"/>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="desc">Description</label>
                                        <textarea name="desc" id="desc" class="form-control" rows="3" cols="12"><?php echo set_value('desc'); ?></textarea>
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
<!-- <script src="<?php echo base_url(); ?>assets/js/addSm.js" type="text/javascript"></script> -->
<script src="<?php echo base_url(); ?>assets/js/ajax.js" type="text/javascript"></script>

<script type="text/javascript">
    /* function getAjax(parent, child, url, option, name){
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
    } */
    getAjax('#catname', "#subcat", 'subcat/', "SubCategory", 'name');
    $(document).ready(function(){
        $("#amount").hide();
        $("#paid").click(function(){
            $("#amount").show();
        });
        $("#free").click(function(){
            $("#amount").hide();
            document.getElementById("currency-field").value = '';
        });
    });

    /* function checkNum() {
        var myField = document.getElementById("price");
        var reg = /\d{1,10}(\.\d{1,2})?/;
        if (reg.test(myField.value)){
            // alert("Nice job! That's real currency!");
        }else{
            alert("Fill the Correct Amount!");
            document.getElementById("currency-field").value = '';
        } 
    } */

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