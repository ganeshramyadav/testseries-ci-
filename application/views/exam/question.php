

<link href="<?php echo base_url(); ?>assets/css/listing.css" rel="stylesheet" type="text/css" />
<style>
    .width{
        width:1px;
    }
    .img{
        width: 377px;
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
    .social{
        bottom:-16px !important;
    }
    .product-grid3 .social li a{
        width: 30px !important;
        height: 30px !important;
        line-height: 30px !important;
    }
    .line-height {
        line-height: 1.5 !important;
    }
</style>

<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <div class="box-footer no-padding">
                        <ul class="nav nav-stacked widget-user-image">
                            <li>
                                <?php if(!empty($ExamRecords->image_url)){ ?>
                                    <img class='img' src = <?php echo base_url().$ExamRecords->image_url; ?> alt='User Avatar'>
                                <?php }else{
                                    ?>
                                    <img class="img" src=<?php echo base_url()."assets/images/pdf.jpg" ?> alt="User Avatar">
                                <?php } ?>
                            </li>
                        </ul>
                    </div>
            </div>
            <div class="col-md-6 col-sm-6">
                <div class="box box-widget widget-user-2">
                    <div class="widget-user-header bg-yellow">
                        <h3 class="username"><?php echo strtoupper($ExamRecords->title)." ( ".$ExamRecords->year." ) "; ?></h3>
                        <h5 class="desc"><?php echo "Institute :-".$ExamRecords->institute_id; ?></h5>
                        <h5 class="desc"><?php echo "Created By :-".$ExamRecords->created_by; ?></h5>
                    </div>
                    <div class="col-md-12 col-sm-12 box-footer no-padding">
                        <ul class="nav nav-stacked">
                            <li><a href="#">Number Of Questions <span class="pull-right badge bg-blue"><?php echo $ExamRecords->no_of_question; ?></span></a></li>
                            <li><a href="#">Remaining Count <span class="pull-right badge bg-aqua" id="remaing"><?php echo $ExamRecords->no_of_question-$count; ?></span></a></li>
                            <li><a href="#">Active<span class="pull-right badge bg-green"><?php echo ($ExamRecords->active ? 'Active' : 'InActive'); ?></span></a></li>
                            <li><a href="#">Duration <span class="pull-right badge bg-red"><?php echo $ExamRecords->duration; ?></span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 col-md-12">
                <div class="box">
                    <div class="box-header" style="text-align: -webkit-center;">
                        <?php $this->load->helper("form"); ?>
                            <form action="<?php echo base_url() . $route?>" method="POST" id="searchList">

                                <div class="row" style="margin-left: 0px !important; padding-top: 2%;">
                                    <input type="hidden" name="examId" class="input-sm pull-left" value="<?php echo $ExamRecords->id; ?>"/>
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
                                                                                                                } ?>><?php echo $Category->name ?></option>
                                                        <?php
                                                            } else {
                                                                foreach ($Category as $rl) {
                                                                    ?>
                                                            <option value="<?php echo $rl->id; ?>" <?php if ($rl->id == $category) {
                                                                                                                    echo "selected";
                                                                                                                } ?>><?php echo $rl->name ?></option>
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
                                                                                                                } ?>><?php echo $SubCategory->name ?></option>
                                                        <?php
                                                            } else {
                                                                foreach ($SubCategory as $rl) {
                                                                    ?>
                                                            <option value="<?php echo $rl->id; ?>" <?php if ($rl->id == $subcategory) {
                                                                                                                    echo "selected";
                                                                                                                } ?>><?php echo $rl->name ?></option>
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
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tr>
                            <?php if($ExamRecords->no_of_question-$count > 0){
                                echo "<th>Select</th>";
                            } ?>
                                <th>Question</th>
                                <th>Category</th>
                                <th>SubCategory</th>
                            </tr>
                            <?php
                            if(!empty($Records))
                            {
                                foreach($Records as $record)
                                {
                            ?>
                            <tr>
                                <?php if($ExamRecords->no_of_question-$count > 0){ ?>
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
                                <td class="width"><?php echo $record->question ?></td>
                                <td class="width"><?php echo $record->catName ?></td>
                                <td class="width"><?php echo $record->subName ?></td>
                            </tr>
                            <?php
                                }
                                
                            }else{
                                echo "<tr><td>No Records Found!</td></tr>";
                            }
                            ?>
                        </table>
                    
                    </div>
                    <div class="box-footer clearfix">
                        <?php echo $this->pagination->create_links(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/delete.js" charset="utf-8"></script>
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
    
    <?php if($ExamRecords->no_of_question-$count > 0){ ?>
        function stickyheaddsadaer(obj,questionId) {
            var x = document.getElementById("remaing").innerHTML; 
            var examId = <?php echo $ExamRecords->id; ?>;
            var ajax = 'ajax';

            if($(obj).is(":checked")){
                if(x <= 0){
                    alert("You Can't Add More Questions...");
                    // fetching the checkbox by id 
                    var doc = document.getElementById(questionId);
                    // changing the state of checkbox to checked 
                    doc.checked = false; 
                    // document.getElementById("'"+questionId+"'");
                }else{
                    $.ajax({
                        type : "POST",
                        dataType : "json",
                        data : { examId : examId, questionId : questionId, ajax : ajax },
                        url: "<?php echo base_url() ?>exam/question/new/addNew",
                        success: function(data){
                            if(data.status == "FALSE"){
                                alert("Somthing Went Wrong.");
                            }else if(data.status == "TRUE"){
                                document.getElementById("remaing").innerHTML = x - 1;
                            }
                        },
                        error: function(error){
                            alert("ERROR: INTERNET DISCONNECTED");
                        }
                    });
                }
            }else{
                $.ajax({
                    type : "POST",
                    dataType : "json",
                    data : { examId : examId, questionId : questionId, ajax : ajax },
                    url: "<?php echo base_url() ?>exam/question/delete",
                    success: function(data){
                        if(data.status == "FALSE"){
                            alert("Somthing Went Wrong.");
                        }else if(data.status == "TRUE"){
                            var minus = val(x) + 1;
                            document.getElementById("remaing").innerHTML = minus;
                        }else{
                            alert("You Have Not Permissions Perform the Delete Action.");
                        }
                    },
                    error: function(error){
                        alert("ERROR: INTERNET DISCONNECTED");
                    }
                });
            }
        }
    <?php } ?>

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
