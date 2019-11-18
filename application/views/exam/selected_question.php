<style>
    .width{
        width: max-content;
    }
</style>
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            
        </div>

        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="box box-widget widget-user">
                    <div class="widget-user-header bg-aqua-active">
                        <h3 class="widget-user-username"><?php echo strtoupper($ExamRecords->title); ?></h3>
                        <h5 class="widget-user-desc"><?php echo "Institute :-".$ExamRecords->institute_id; ?></h5>
                        <h5 class="widget-user-desc"><?php echo "Year :-".$ExamRecords->year; ?></h5>
                    </div>

                    <div class="box-footer">
                        <div class="row">
                            <div class="col-sm-3 border-right">
                                <div class="description-block">
                                    <h5 class="description-header"><?php echo $CategoryRecords->name; ?></h5>
                                    <span class="description-text">Category</span>
                                </div>
                            </div>
                            <div class="col-sm-3 border-right">
                                <div class="description-block">
                                    <h5 class="description-header"><?php echo $SubCategoryRecords->name; ?></h5>
                                    <span class="description-text">SubCategory</span>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="description-block">
                                    <h5 class="description-header"><?php echo $ExamRecords->no_of_question; ?></h5>
                                    <span class="description-text">Number Of Questions</span>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="description-block">
                                    <h5 class="description-header"><?php echo $ExamRecords->no_of_question-$count; ?></h5>
                                    <span class="description-text">Remaining Count</span>
                                </div>
                            </div>
                        </div>
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
                        <!-- <th>Id</th> -->
                        <th>Question</th>
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
                        <!-- <td class="width"><?php //echo $record->id ?></td> -->
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
