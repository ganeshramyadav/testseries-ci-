
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
    .btn-circle {
        width: 30px;
        height: 30px;
        text-align: center;
        padding: 6px 0;
        font-size: 12px;
        line-height: 1.428571429;
        border-radius: 15px;
    }
    .btn-danger{
        background-color: #dd4b39 !important;
    }
</style>
<div class="content-wrapper">
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> <?php echo $title ?>
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?php echo base_url().$routeName; ?>"><i class="fa fa-plus"></i> Add New</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-md-12 col-sm-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title"> </h3>
                    <div class="box-tools">
                        <form action="<?php echo base_url().$route ?>" method="POST" id="searchList">
                            <div class="input-group">
                              <input type="text" name="searchText" value="<?php echo $searchText; ?>" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search"/>
                              <div class="input-group-btn">
                                <button class="btn btn-sm btn-default searchList"><i class="fa fa-search"></i></button>
                              </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                      <thead>
                        <?php
                            if(!empty($Records))
                            {
                        ?>
                        <tr>
                            <th>Title</th>
                            <th>Category</th>
                            <th>SubCategory</th>
                            <th>Institute</th>
                            <th>No of Question's</th>
                            <th>Duration(in Mintes)</th>
                            <th>year</th>
                            <th>Active</th>
                            <th>Created On</th>
                            <th >Actions</th>
                        </tr>
                            <?php }else{ 
                                echo "<tr><th>Record</th></tr>";
                            }?>
                      </thead>
                    
                    <?php
                    if(!empty($Records))
                    {
                        foreach($Records as $record)
                        {
                    ?>
                    <tr>
                        <td ><?php echo $record->title; ?></td>
                        <td ><?php echo $record->catName ?></td>
                        <td ><?php echo $record->subName ?></td>
                        <td ><?php echo $record->name ?></td>
                        <td ><?php echo $record->no_of_question ?></td>
                        <td ><?php echo $record->duration ?></td>
                        <td ><?php echo $record->year ?></td>
                        <td ><?php echo $record->active ?></td>
                        <td ><?php echo date("d-m-Y", strtotime($record->created_at)) ?></td>
                        <td >
                            <div class="row" style="width: 70%;">
                                <div class="col-md-4 col-sm-4">
                                    <form action="<?php echo base_url().$route."/" ?>" method="POST">
                                        <input type="hidden" name="examId" value="<?php echo $record->id; ?>" />
                                        <button class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="View More..."><i class="fa fa-eye"></i></button>
                                    </form>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <a class="btn btn-sm btn-info" href="<?php echo base_url().$editRoute.$record->id; ?>" title="Edit"><i class="fa fa-pencil"></i></a>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <a class="btn btn-sm btn-danger delete" href="#" data-userid="<?php echo $record->id; ?>" title="Delete"><i class="fa fa-trash"></i></a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php
                        }
                    }else{
                        echo "<tr><td>No Record Found...!</td></tr>";
                    }
                    ?>
                  </table>
                </div> -->

                <div class="box-body col-md-12 col-sm-12">
                    <?php
                            if (!empty($Records)) {
                                foreach ($Records as $record){
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
                                        ?>
                                        <li>
                                            <form action="<?php echo base_url().$route."/" ?>" method="POST">
                                                <input type="hidden" name="examId" value="<?php echo $record->id; ?>" />
                                                <button style="margin-top: -7px;" class="btn btn-sm btn-success btn-circle" data-toggle="tooltip" data-placement="top" title="View More..."><i class="fa fa-eye"></i></button>
                                            </form>
                                        </li>
                                        <li>
                                            <a class="" href="<?php echo base_url().$editRoute.$record->id; ?>" title="Edit" data-toggle="tooltip" data-placement="top" >
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                        </li>

                                        
                                        <li>
                                            <a href='#' class='deleteProduct btn-danger' data-id='$record->id' data-msg='Examination List' data-url='exam' title='Delete' data-toggle="tooltip" data-placement="top">
                                                <i id='changeClassName' class='fa fa-trash line-height' aria-hidden='true'></i>
                                            </a>
                                        </li>
                                <?php
                                    }
                                ?>
                                </ul>
                            </div>
                            <div class="product-content">
                                <h3 class="titles"><a href="#"><?php echo $record->title."( ".$record->year." )"; ?></a></h3>
                                <span class=""><?php echo $record->catName; ?></span>
                                <span class=""><?php echo $record->subName; ?></span>
                                <div class="">
                                    <ul class="" style=" list-style: none; padding-left: initial;">
                                        <li>Institute Name : - <?php echo $record->institute_id; ?></li>
                                        <li>No Of Question : - <?php echo $record->no_of_question; ?></li>
                                        <li>Duration : - <?php echo $record->duration." (In Minutes)"; ?></li>
                                        <li>Status : - <?php echo strtoupper($record->active); ?></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php       }
                            }else{
                                echo "No Records Found!";
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
<!-- <script type="text/javascript" src="<?php //echo base_url(); ?>assets/js/common.js" charset="utf-8"></script> -->
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
