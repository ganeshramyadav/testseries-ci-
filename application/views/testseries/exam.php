<!-- iCheck for checkboxes and radio inputs -->
<!-- <link href="<?php echo base_url() ?>assets/css/iCheck/all.css" rel="stylesheet" type="text/css" /> -->
<link href="<?php echo base_url(); ?>assets/css/listing.css" rel="stylesheet" type="text/css" />
<style>
    .width{
        width:1px;
    }
    .img{
        width: 221px;
        height: auto;
        padding: 2%;
    }
    .bg-yellow{
        padding: 2px !important;
    }
    .bg-yellow,.widget-user-image{
        text-align: center;
    }
    /* .nav>li>a, */
    .badge{
        font: -webkit-mini-control;
    }
</style>
<div class="content-wrapper">
    <section class="content">

        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="box box-widget widget-user-2">
                    <div class="widget-user-header bg-yellow">
                        <h3 class="username"><?php echo strtoupper($SeriesRecord->Name); ?></h3>
                        <h5 class="desc"><?php echo "Institute :-".$SeriesRecord->institute_id; ?></h5>
                        <h5 class="desc"><?php echo "Created By :-".$SeriesRecord->created_by; ?></h5>
                    </div>
                    <div class="col-md-6 col-sm-6 box-footer no-padding">
                        <ul class="nav nav-stacked widget-user-image">
                            <li>
                                <img class="img" src=<?php echo base_url()."assets/content/video/public/31/4f0c82644419f6979da0d8ff1ca2d9b1.jpg" ?> alt="User Avatar">
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6 col-sm-6 box-footer no-padding">
                        <ul class="nav nav-stacked">
                            <li><a href="#">Number Of Exam <span class="pull-right badge bg-blue"><?php echo $SeriesRecord->no_of_exam; ?></span></a></li>
                            <li><a href="#">Remaining Count <span class="pull-right badge bg-aqua" id="remaing"><?php echo $SeriesRecord->no_of_exam-$count; ?></span></a></li>
                            <li><a href="#">Public<span class="pull-right badge bg-green"><?php if($SeriesRecord->isPublic == 1){ echo "YES";}else{ echo "Paid"; } ?></span></a></li>
                            <li><a href="#">Price <span class="pull-right badge bg-red"><?php echo $SeriesRecord->price; ?></span></a></li>
                            
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group box-title input-group-btn">
                    
                </div>
            </div>
            <div class="col-sm-12 col-md-12">
                <div class="box">
                    <div class="box-header" style="text-align: -webkit-center;">
                        <?php $this->load->helper("form"); ?>
                        <form action="<?php echo base_url() . $route?>" method="POST" id="searchList">

                                <div class="row" style="margin-left: 0px !important; padding-top: 2%;">
                                    <input type="hidden" name="examId" class="input-sm pull-left" value="<?php echo $SeriesRecord->id; ?>"/>

                                    <div class="col-md-4">
                                        <div class="input-group">
                                            <select class="form-control" id="category" name="category" aria-required="true">
                                                <option value="0">Select Category...</option>
                                                <?php
                                                if (!empty($Category)) {
                                                    if (isset($Category->id)) {
                                                        ?>
                                                        <option value="<?php echo $Category->id; ?>" <?php if ($Category->id == $category) {
                                                                                                                    echo "selected";
                                                                                                                } ?>><?php echo strtoupper($Category->name )?></option>
                                                        <?php
                                                            } else {
                                                                foreach ($Category as $rl) {
                                                                    ?>
                                                            <option value="<?php echo $rl->id; ?>" <?php if ($rl->id == $category) {
                                                                                                                    echo "selected";
                                                                                                                } ?>><?php echo strtoupper($rl->name )?></option>
                                                <?php
                                                        }
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group">
                                            <select class="form-control" id="subcategory" name="subcategory" aria-required="true">
                                                <option value="0">Select SubCategory...</option>
                                                <?php
                                                if (!empty($SubCategory)) {
                                                    if (isset($SubCategory->id)) {
                                                        ?>
                                                        <option value="<?php echo $SubCategory->id; ?>" <?php if ($SubCategory->id == $subcategory) {
                                                                                                                    echo "selected";
                                                                                                                } ?>><?php echo strtoupper($SubCategory->name) ?></option>
                                                        <?php
                                                            } else {
                                                                foreach ($SubCategory as $rl) {
                                                                    ?>
                                                            <option value="<?php echo $rl->id; ?>" <?php if ($rl->id == $subcategory) {
                                                                                                                    echo "selected";
                                                                                                                } ?>><?php echo strtoupper($rl->name )?></option>
                                                <?php
                                                        }
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="input-group">
                                            <div class="col-md-8">
                                                <input type="text" name="searchText" value="<?php echo $searchText; ?>" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search" />
                                            </div>
                                            <div class="col-md-4">
                                                <div class="input-group-btn">
                                                    <button class="btn btn-sm btn-primary searchList" style="float: right;"><i class="fa fa-search"></i> Search</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </form>
                    </div>
                    <!-- <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tr>
                            <?php if($SeriesRecord->no_of_exam-$count > 0){
                                echo "<th>Select</th>";
                            } ?>
                                <th class="text-center">Title</th>
                                <th class="text-center">Category</th>
                                <th class="text-center">SubCategory</th>
                                <th class="text-center">No Of Questions</th>
                                <th class="text-center">Duration</th>
                                <th class="text-center">Year</th>
                                <th class="text-center">Actions</th>
                            </tr>
                            <?php
                            if(!empty($Records))
                            {
                                foreach($Records as $record)
                                {
                            ?>
                            <tr>
                                <?php if($SeriesRecord->no_of_exam-$count > 0){ ?>
                                    <td class="width">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label>
                                                    <input type="checkbox" name="questionId" id="<?php echo $record->id ?>" onchange="stickyheaddsadaer(this, <?php echo $record->id ?>)"/>
                                                </label>
                                            </div>
                                        </div>
                                    </td>
                                <?php } ?>
                                <td class="text-center"><?php echo strtoupper($record->title )?></td>
                                <td class="text-center"><?php echo strtoupper($record->catName) ?></td>
                                <td class="text-center"><?php echo strtoupper($record->subName) ?></td>
                                <td class="text-center"><?php echo $record->no_of_question ?></td>
                                <td class="text-center"><?php echo $record->duration ?></td>
                                <td class="text-center"><?php echo $record->year ?></td>
                                <td class="text-center">
                                    <a class="btn btn-sm btn-danger deleteProduct" data-toggle="tooltip" data-placement="top" title="Remove" href="#" data-id="<?php echo $record->id; ?>" data-msg='Exam in selected TestSeries' data-url='<?php echo $delete ?>' title="Delete"><i class="fa fa-trash"></i></a>
                                </td>
                                
                            </tr>
                            <?php
                                }
                                
                            }else{
                                echo "<tr><td>No Records Found!</td></tr>";
                            }
                            ?>
                        </table>
                    </div> -->

                    <div class="col-md-12 col-sm-12">
                        <?php
                                if (!empty($Records)) {
                                    foreach ($Records as $record) {
                                        // pre($record);
                        ?>
                        <div class="col-md-3 col-sm-6">
                            <div class="product-grid3">
                                <div class="product-image3">
                                    <a href="#">
                                        <img class="pic-1" src="<?php if(!empty($record->image_url)){ echo base_url().$record->image_url;}else{ echo $defaultImg;} ?>">
                                        <img class="pic-2" src="<?php if(!empty($record->image_url)){ echo base_url().$record->image_url;}else{ echo $defaultImg;} ?>">
                                    </a>
                                    <ul class="social">
                                    <?php 
                                        if($roleId == 1){
                                            /* if(!empty($record->favId)){
                                                echo "<li ><a href='#' class='deleteProduct' data-id='$record->favId' data-msg='My Favorite List' data-url='favorite' title='Delete'><i class='fa fa-heart line-height' aria-hidden='true'></i></a></li>";
                                            }else{
                                                echo "<li ><a href='#' class='addFavorite' data-id='$record->id' data-msg='My Favorite List' data-url='favorite' title='Add'><i class='fa fa-heart line-height' aria-hidden='true'></i></a></li>";
                                            } */

                                            /* if ($record->isPublic == False) {
                                                echo "<li onclick='openModal($record->id)'><a href='#'><i class='fa fa-shopping-cart line-height'></i></a></li>";
                                            } else {
                                                echo "<li><a href='$record->url' target='_blank'><i class='fa fa-download line-height'></i></a></li>";
                                            } */
                                        }
                                        /* if($roleId == 1){
                                            echo "<li ><a href=".base_url() . $editRoute . $record->id."><i class='fa fa-pencil line-height' ></i></a></li>
                                            <li ><a class='deleteProduct' href='#' data-id=".$record->id." data-msg=".$title."><i class='fa fa-trash line-height'></i></a></li>";
                                        } */

                                        /* if($roleId == 1){

                                        } */
                                    ?>
                                    </ul>
                                    <!-- <?php //if(!empty($record->favId)){ ?>
                                        <span class="product-new-label" ><i class='fa fa-heart line-height' aria-hidden='true'></i></span>
                                    <?php //}else{ ?>
                                    <span class="product-new-label">New</span>
                                    <?php //} ?> -->
                                </div>
                                <div class="product-content">
                                    <h3 class="titles"><a href="#"><?php echo $record->title." ( ".$record->year." )"; ?></a></h3>
                                    <span class=""><?php echo $record->catName; ?></span>
                                    <span class=""><?php echo $record->subName; ?></span>
                                    <div class="">
                                        <ul class="" style=" list-style: none; padding-left: initial;">
                                            <li>No Of Questions : - <?php echo $record->no_of_question; ?></li>
                                            <li>Duration : - <?php echo $record->duration; ?></li>
                                        </ul>
                                    </div>
                                    <!-- <ul class="rating">
                                        <li class="fa fa-star"></li>
                                        <li class="fa fa-star"></li>
                                        <li class="fa fa-star"></li>
                                        <li class="fa fa-star disable"></li>
                                        <li class="fa fa-star disable"></li>
                                    </ul> -->
                                </div>
                            </div>
                        </div>
                        <?php       }
                                }
                        ?>
                    </div>

                    <div class="modal fade" id="modal-default" style="display: none;">
                        <div class="modal-dialog">
                            <div class="modal-content" id="model-content">

                            </div>
                        </div>
                    </div>
                    <div class="box-footer clearfix">
                        <?php echo $this->pagination->create_links(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/ajax.js" charset="utf-8"></script>
<script type="text/javascript">

    getAjax('#category', "#subcategory", 'subcat/', "SubCategory", 'name');
    jQuery(document).ready(function(){
        jQuery('ul.pagination li a').click(function (e) {
            e.preventDefault();
            var link = jQuery(this).get(0).href;
            var value = link.substring(link.lastIndexOf('/') + 1);
            jQuery("#searchList").attr("action", baseURL + "<?php echo $route;?>/"+ value);
            jQuery("#searchList").submit();
        });
    });
    
    <?php if($SeriesRecord->no_of_exam-$count > 0){ ?>
        function stickyheaddsadaer(obj,examId) {
            var x = document.getElementById("remaing").innerHTML; 
            var seriesId = <?php echo $SeriesRecord->id; ?>;
            var ajax = 'ajax';
            
            if($(obj).is(":checked")){
                if(x <= 0){
                    alert("You Can't Add More Questions...");
                    // fetching the checkbox by id 
                    var doc = document.getElementById(examId);
                    // changing the state of checkbox to checked 
                    doc.checked = false; 
                    // document.getElementById("'"+questionId+"'");
                }else{
                    document.getElementById("remaing").innerHTML = x - 1;
                    /* $.ajax({
                        type : "POST",
                        dataType : "json",
                        data : { seriesId : seriesId, examId : examId, ajax : ajax },
                        url: "<?php echo base_url() ?>testseries/exam/new/addNew",
                        success: function(data){
                            if(data.status == "FALSE"){
                                doc.checked = false;
                                alert("Somthing Went Wrong.");
                            }else if(data.status == "TRUE"){
                                document.getElementById("remaing").innerHTML = x - 1;
                            }
                        },
                        error: function(error){
                            doc.checked = false;
                            alert("ERROR: INTERNET DISCONNECTED");
                        }
                    }); */
                }
            }else{
                var minus = x.value + 1;
                document.getElementById("remaing").innerHTML = minus;
               /*  $.ajax({
                    type : "POST",
                    dataType : "json",
                    data : { seriesId : seriesId, examId : examId, ajax : ajax },
                    url: "<?php echo base_url() ?>testseries/exam/delete",
                    success: function(data){
                        if(data.status == "FALSE"){
                            doc.checked = false;
                            alert("Somthing Went Wrong.");
                        }else if(data.status == "TRUE"){
                            var minus = x.value + 1;
                            document.getElementById("remaing").innerHTML = minus;
                        }
                    },
                    error: function(error){
                        doc.checked = false;
                        alert("ERROR: INTERNET DISCONNECTED");
                    }
                }); */
            }
            
        }
    <?php } ?>

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
