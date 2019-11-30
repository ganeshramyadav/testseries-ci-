

<div class="row">
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
                                    echo "<li ><a href='#' class='deleteProduct' data-id='$record->id' data-msg='My Favorite List' data-url='favorite' title='Delete'><i id='changeClassName' class='fa fa-plus line-height' aria-hidden='true'></i></a></li>";
                                    echo "<li ><a href='#' class='deleteProduct' data-id='$record->id' data-msg='My Favorite List' data-url='favorite' title='Delete'><i id='changeClassName' class='fa fa-minus line-height' aria-hidden='true'></i></a></li>";
                                }
                                /* if($roleId == 1){
                                    echo "<li ><a href=".base_url() . $editRoute . $record->id."><i class='fa fa-pencil line-height' ></i></a></li>
                                    <li ><a class='deleteProduct' href='#' data-id=".$record->id." data-msg=".$title."><i class='fa fa-trash line-height'></i></a></li>";
                                } */

                                /* if($roleId == 1){

                                } */
                            ?>
                            </ul>
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