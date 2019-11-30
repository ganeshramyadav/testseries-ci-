
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
                                <img class="img" src=<?php echo base_url()."assets/content/video/public/31/4f0c82644419f6979da0d8ff1ca2d9b1.jpg" ?> alt="User Avatar">
                            </li>
                        </ul>
                    </div>
            </div>
            <div class="col-md-6 col-sm-6">
                <div class="box box-widget widget-user-2">
                    <div class="widget-user-header bg-yellow">
                        <h3 class="username"><?php echo strtoupper($SeriesRecord->Name); ?></h3>
                        <h5 class="desc"><?php echo "Institute :-".$SeriesRecord->institute_id; ?></h5>
                        <h5 class="desc"><?php echo "Created By :-".$SeriesRecord->created_by; ?></h5>
                    </div>
                    <div class="col-md-12 col-sm-12 box-footer no-padding">
                        <ul class="nav nav-stacked">
                            <li><a href="#">Number Of Exam <span class="pull-right badge bg-blue"><?php echo $SeriesRecord->no_of_exam; ?></span></a></li>
                            <li><a href="#">Remaining Count <span class="pull-right badge bg-aqua" id="remaing"><?php echo $SeriesRecord->no_of_exam-$count; ?></span></a></li>
                            <li><a href="#">Public<span class="pull-right badge bg-green"><?php if($SeriesRecord->isPublic == 1){ echo "YES";}else{ echo "Paid"; } ?></span></a></li>
                            <li><a href="#">Price <span class="pull-right badge bg-red"><i id='changeClassName' class='fa fa-inr line-height' aria-hidden='true'></i><?php echo "  ".number_format($SeriesRecord->price, 2); ?></span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <?php if($type == 'selected'){
            $this->load->view('testseries/selected');
        }else if($type == 'select'){
            $this->load->view('testseries/select');
        } ?>
        
        
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
