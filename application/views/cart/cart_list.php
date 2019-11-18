<style>
    .span-text-style{
        font-size: 16px;
        font-weight: 700;
    }
    .font-style{
        font-weight: bold;
        font-size: large;
        color: #222d32;
    }
    .fixed_header tbody{
        display:block;
        overflow:auto;
        height:200px;
        width:100%;
    }
    .fixed_header thead tr{
        display:block;
    }
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        
        <div class="row">
            <div class="col-xs-6 text-left">
                <div class="form-group">
                    <h1>
                        <i class="fa fa-users"></i> <?php echo $title; ?>
                    </h1>
                </div>
            </div>
           <!--  <div class="col-xs-6 text-right">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?php //echo base_url() . $routeName; ?>"><i class="fa fa-check-out"></i> Place Your Order</a>
                </div>
            </div> -->
        </div>
    </section>
    <section class="content">
        
        <div class="row">
            <div class="col-md-8" >
                <div class="box" style="overflow-y: scroll; height: 68vh;">
                    <div class="box-body table-responsive scrollTable" style="padding-top:5%">
                        <table class="table table-hover scrollTable" >
                            <thead class="fixed_header">
                                <tr>
                                    <th class="text-center">File Type</th>
                                    <th></th>
                                    <!-- <th>Price</th>
                                    <th>Created On</th> -->
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            
                            <tbody class="fixed_header" >
                                <?php
                                if (!empty($Records)) {
                                    foreach ($Records as $record) {
                                        ?>
                                        <tr>
                                            <?php if(!empty($record->image_url)){ ?>
                                                <td style="text-align: center;"><img src="<?php echo $record->image_url; ?>" alt="FileType" height=100px;></td>
                                            <?php }else{ 
                                                if($record->video == 1){
                                            ?>
                                                <td style="text-align: center;"><img src="<?php echo base_url()."assets/images/video.png"; ?>" alt="FileType" height=100px;></td>
                                            <?php }else{ ?>
                                                <td style="text-align: center;"><img src="<?php echo base_url()."assets/images/pdf.jpg"; ?>" alt="FileType" height=100px;></td>
                                            <?php } }?>
                                            
                                            <td style="vertical-align: middle;">
                                                <?php echo "<spna class='span-text-style'>Name : </spna>".$record->Pname ?>
                                                <?php echo "<br/><spna class='span-text-style'>Price : </spna>".$record->price ?>
                                                <?php echo "<br/><spna class='span-text-style'>Created On : </spna>".date("d-m-Y", strtotime($record->created_at)) ?>
                                            </td>
                                            <td class="text-center" style="vertical-align: middle;">
                                                <?php if(!empty($record->FavId)){ ?>
                                                    <a class="btn btn-sm btn-warning" href="#" title="Favorite"><i class="fa fa-heart line-height" aria-hidden='true'></i></a>
                                                <?php } ?>
                                                <a class="btn btn-sm btn-danger deleteProduct" href="#" data-id="<?php echo $record->id; ?>" data-msg="<?php echo $title; ?>" data-url="<?php echo $deleteUrl; ?>" title="Delete"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    <?php
                                        }
                                    } else { ?>
                                    <td><?php echo "No Recored Found...!" ?></td>
                                <?php }
                                ?>
                            </tbody>
                            
                        </table>
                    </div><!-- /.box-body -->

                    <div class="box-footer clearfix">
                        <?php echo $this->pagination->create_links(); ?>
                    </div>
                </div><!-- /.box -->
            </div>
            
            <div class="col-md-4">
                <?php $this->load->helper("form"); ?>
                <form action="<?php echo base_url().$routeName ?>" method="POST">
                    <div class="box">
                        <div class="box box-solid box-primary" style="border: none !important;">
                            <div class="box-header">
                                <h3 class="box-title">Order Summary</h3>
                                <!-- <div class="box-tools pull-right">
                                    <button class="btn btn-primary btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    <button class="btn btn-primary btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
                                </div> -->
                            </div>
                            <div class="box-body font-style" >
                                <br/>
                                <div class="row">
                                    <div class="col-md-6">Item Amount :</div>
                                    <div class="col-md-6 col-xs-3">
                                        <label id="_amount" ><?php echo $Total->total_amount;?></label>
                                        <input type="hidden" class="form-control" id="amount" name="amount" value="<?php echo $Total->total_amount;?>"/>
                                        
                                        <!-- <label id="amount" onClick="calculation();"><?php //echo $Total->total_amount;?></label> -->
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">You Have a Promo code</div>
                                    <div class="col-md-6">
                                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">
                                            <i class="fa fa-question-circle" aria-hidden="true"></i>
                                        </button>
                                        <!-- <a class="btn btn-primary big-default" href="http://localhost/apis/codeigniter/suraj_exam/study_material/new"><i class="fa fa-question-circle" aria-hidden="true"></i></a> -->
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">Discount :</div>
                                    <div class="col-md-6" >
                                        <label id="_discount" ><?php echo $Discount;?></label>
                                        <input type="hidden" class="form-control" id="discount" name="discount" value="<?php echo $Discount;?>"/>
                                        
                                        <!-- <?php //echo $Discount;?> -->
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">Tax :</div>
                                    <div class="col-md-6">
                                        <label id="_tax" ><?php echo $Tax;?></label>
                                        <input type="hidden" class="form-control" id="tax" name="tax" value="<?php echo $Tax;?>"/>
                                        
                                        <!-- <?php //echo $Tax;?> -->
                                    </div>
                                </div>
                                <hr style="border-top: 12px solid #3c8dbc;"/>
                                <div class="row" style="font-size: 17pt;">
                                    <div class="col-md-6">Grand Total :</div>
                                    <div class="col-md-6" >
                                    Rs. <label id="_total"></label>
                                    </div>
                                </div>
                                
                            </div><!-- /.box-body -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="box-body">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-block" style="font-size: 13pt; font-weight: 800;"><i class="fa fa-check-out"></i>PLACE YOUR ORDER</button>
                            </div>
                            <!-- <a style="font-size: 13pt; font-weight: 800;" class="btn btn-primary btn-block" href="http://localhost/apis/codeigniter/suraj_exam/study_material/new"><i class="fa fa-check-out"></i> PLACE YOUR ORDER</a> -->
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal fade" id="modal-default" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                            <h4 class="modal-title">Promo Code</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <input type="text" placeholder="Enter Code..." style="float:right;"/>
                                </div>
                                <div class="col-sm-6" id="checkPromo">
                                    <i class="fa fa-check-circle" aria-hidden="true" style="font-size: 20pt; color: rgb(0, 166, 90);"></i>
                                    <i class="fa fa-times-circle" aria-hidden="true" style="font-size: 20pt; color: rgb(221, 75, 57);"></i>
                                </div>
                            </div>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
            <!-- /.modal-dialog -->
            </div>
        </div>
    </section>
</div>
<!-- <script type="text/javascript" src="<?php //echo base_url(); 
                                            ?>assets/js/common.js" charset="utf-8"></script> -->
<script src="<?php echo base_url().'assets/js/delete.js'; ?>" type="text/javascript"></script>
<script type="text/javascript">

    function calculation() {
        var amount = document.getElementById("amount").value;
        // var _amount = document.getElementById("_amount").innerText;
        var discount = document.getElementById("discount").value;
        var tax = document.getElementById("tax").value;
        var total = amount-(discount+tax);
        document.getElementById("_total").innerText = total;
    }
    jQuery(document).ready(function() {
        calculation();
        // var amount = document.getElementById("amount").value;
        // var discount = document.getElementById("discount").value;
        // var tax = document.getElementById("tax").value;
        // var total = document.getElementById("total").value;
    });
</script>