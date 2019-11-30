
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
            <!-- <?php //pre($ExamRecords); ?> -->
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
                <div class="box-header">
                    <?php if($ExamRecords->no_of_question-$count > 0){ ?>
                        <form action="<?php echo base_url().$routeName ?>" method="POST">
                            <div class="input-group">
                                <input type="hidden" name="examId" value="<?php echo $ExamRecords->id; ?>" />
                                <div class="input-group-btn">
                                    <button class="btn btn-primary text-right"><i class="fa fa-plus"></i>  Add New</button>
                                </div>
                            </div>
                        </form>
                    <?php }else{ echo '<h3 class="box-title"> Selected Question\'s List </h3>'; }?>
                    <div class="box-tools">
                        <form action="<?php echo base_url().$route ?>" method="POST" id="searchList">
                            <div class="input-group">
                                <input type="hidden" name="examId" value="<?php echo $ExamRecords->id; ?>" />
                                <input type="text" name="searchText" value="<?php echo $searchText; ?>" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search"/>
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-default searchList"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tr>
                                <th></th>
                                <th>Question</th>
                                <th>Category</th>
                                <th>SubCategory</th>
                                <th class="text-center">Actions</th>
                            </tr>
                            <?php
                            if(!empty($Records))
                            {
                                foreach($Records as $record)
                                {
                            ?>
                            <tr>
                                
                                <td class="width"></td>
                                <td class="width"><?php echo $record->question ?></td>
                                <td class="width"><?php echo $record->catName ?></td>
                                <td class="width"><?php echo $record->subName ?></td>
                                <td class="width text-center">
                                    <a class="btn btn-sm btn-danger deleteProduct" data-toggle="tooltip" data-placement="top" href="#" data-id="<?php echo $record->id; ?>" data-msg='Question in selected exam' data-url='<?php echo $delete ?>' title="Delete"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            <?php
                                }
                                
                            }else{
                                echo "<tr><td>No Records Found!</td></tr>";
                            }
                            ?>
                        </table>
                    
                    </div>
                <!-- <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                        <th class="text-center">Question</th>
                        <th class="text-center">Category</th>
                        <th class="text-center">SubCategory</th>
                        
                        <th class="text-center">Actions</th>
                    </tr>
                    <?php
                    if(!empty($Records))
                    {
                        foreach($Records as $record)
                        {
                    ?>
                    <tr>
                        <td class="width"><?php echo $record->question ?></td>
                        <td class="width"><?php echo $record->catName ?></td>
                        <td class="width"><?php echo $record->subName ?></td>
                        <td class="text-center">
                            <a class="btn btn-sm btn-danger deleteProduct" data-toggle="tooltip" data-placement="top" title="Remove" href="#" data-id="<?php echo $record->id; ?>" data-msg='Question in selected exam' data-url='<?php echo $delete ?>' title="Delete"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php
                        }
                    }
                    ?>
                  </table>

                </div> -->
                <div class="box-footer clearfix">
                    <?php echo $this->pagination->create_links(); ?>
                </div>
              </div>
            </div>
        </div>
    </section>
</div>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/delete.js" charset="utf-8"></script>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('ul.pagination li a').click(function (e) {
            e.preventDefault();
            var link = jQuery(this).get(0).href;
            var value = link.substring(link.lastIndexOf('/') + 1);
            jQuery("#searchList").attr("action", baseURL + "<?php echo $route;?>/" + value);
            jQuery("#searchList").submit();
        });
    });
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
