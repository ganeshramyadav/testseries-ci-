


<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="box">
            <div class="box-header">
                <?php $this->load->helper("form"); ?>
                <!-- <div class="box-header"> -->
                <?php if($SeriesRecord->no_of_exam-$count > 0){ ?>
                    <form action="<?php echo base_url().$routeName ?>" method="POST">
                        <div class="input-group">
                            <input type="hidden" name="seriesId" value="<?php echo $SeriesRecord->id; ?>" />
                            <div class="input-group-btn">
                                <button class="btn btn-primary text-right"><i class="fa fa-plus"></i> Add New</button>
                            </div>
                        </div>
                    </form>
                <?php } ?>
            </div>

            <div class="col-md-12 col-sm-12">
                <?php
                        if (!empty($Records)) {
                            foreach ($Records as $record){
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
                                    echo "<li ><a href='#' class='deleteProduct' data-id='$record->id' data-msg='My Favorite List' data-url='favorite' title='Delete'><i id='changeClassName' class='fa fa-minus line-height' aria-hidden='true'></i></a></li>";
                                }
                                /* if($roleId == 1){
                                    echo "<li ><a href=".base_url() . $editRoute . $record->id."><i class='fa fa-pencil line-height' ></i></a></li>
                                    <li ><a class='deleteProduct' href='#' data-id=".$record->id." data-msg=".$title."><i class='fa fa-trash line-height'></i></a></li>";
                                } */
                            ?>
                            </ul>
                        </div>
                        <div class="product-content">
                            <h3 class="titles"><a href="#"><?php echo $record->title." ( ".$record->year." )"; ?></a></h3>
                            <span class=""><?php echo $record->CategoryName; ?></span>
                            <span class=""><?php echo $record->SubcategoryName; ?></span>
                            <div class="">
                                <ul class="" style=" list-style: none; padding-left: initial;">
                                    <li>No Of Questions : - <?php echo $record->no_of_question; ?></li>
                                    <li>Duration : - <?php echo $record->duration; ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <?php       }
                        }else{
                            echo "<div class='row' style='text-align:center;'><b>No Records Found!</b></div>";
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


<!-- <div class="row">
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
</div> -->