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
                        <h3 class="widget-user-username"><?php echo strtoupper($SeriesRecord->Name); ?></h3>
                        <h5 class="widget-user-desc"><?php echo "Institute :-".$SeriesRecord->institute_id; ?></h5>
                        <h5 class="widget-user-desc"><?php echo "Price :-".$SeriesRecord->price; ?></h5>
						<h5 class="widget-user-desc"><?php echo "Created By :-".$SeriesRecord->created_by; ?></h5>
                    </div>

                    <div class="box-footer">
                        <div class="row">
                            <div class="col-sm-3 border-right">
                                <div class="description-block">
                                    <h5 class="description-header"><?php if($SeriesRecord->isPublic == 1){ echo "YES";}else{ echo "Paid"; } ?></h5>
                                    <span class="description-text">Public</span>
                                </div>
                            </div>
                            <!--<div class="col-sm-3 border-right">
                                <div class="description-block">
                                    <h5 class="description-header"><?php //echo $SubCategoryRecords->name; ?></h5>
                                    <span class="description-text">SubCategory</span>
                                </div>
                            </div>-->
                            <div class="col-sm-3">
                                <div class="description-block">
                                    <h5 class="description-header"><?php echo $SeriesRecord->no_of_exam; ?></h5>
                                    <span class="description-text">Number Of Questions</span>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="description-block">
                                    <h5 class="description-header"><?php echo $SeriesRecord->no_of_exam-$count; ?></h5>
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
                    <?php if($SeriesRecord->no_of_exam-$count > 0){ ?>
                        <form action="<?php echo base_url().$routeName ?>" method="POST">
                            <div class="input-group">
                                <input type="hidden" name="seriesId" value="<?php echo $SeriesRecord->id; ?>" />
                                <div class="input-group-btn">
                                    <button class="btn btn-primary text-right"><i class="fa fa-plus"></i>  Add New</button>
                                </div>
                            </div>
                        </form>
                    <?php }else{ echo '<h3 class="box-title"> Selected Examination\'s List </h3>'; }?>
                    <div class="box-tools">
                        <form action="<?php echo base_url().$route ?>" method="POST" id="searchList">
                            <div class="input-group">
                                <input type="hidden" name="seriesId" value="<?php echo $SeriesRecord->id; ?>" />
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
                            // pre($record);
                    ?>
                    <tr>
                        <!-- <td class="width"><?php //echo $record->id ?></td> -->
                        <td class="text-center"><?php echo $record->title ?></td>
                        <td class="text-center"><?php echo $record->CategoryName ?></td>
                        <td class="text-center"><?php echo $record->SubcategoryName ?></td>
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
                        echo "<tr><td class='text-center'>No Records Found!</td></tr>";
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
