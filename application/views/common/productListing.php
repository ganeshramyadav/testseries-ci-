<link href="<?php echo base_url(); ?>assets/css/listing.css" rel="stylesheet" type="text/css" />
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-users"></i> <?php echo $title; ?>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?php echo base_url() . $routeName; ?>"><i class="fa fa-plus"></i> Add New</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-md-12 col-sm-12">
                <div class="box">
                    <div class="box-header" style="text-align: -webkit-center;">
                        <?php $this->load->helper("form"); ?>
                        <form action="<?php echo base_url() . $route ?>" method="POST" id="searchList">

                            <div class="input-group">
                                <div class="row" style="margin-left: 0px !important; padding-top: 2%;">

                                    <div class="col-md-2">
                                        <div class="input-group">
                                            <!-- <label for="institute">Institute</label> -->
                                            <select class="form-control js-example-basic-single" id="institute" name="institute">
                                                <option value="0">Select Institute...</option>
                                                <?php
                                                if (!empty($Institute)) {
                                                    if (isset($Institute->id)) {
                                                        ?>
                                                        <option value="<?php echo $Institute->id; ?>" <?php if ($Institute->id == $institute) {
                                                                                                                    echo "selected";
                                                                                                                } ?>><?php echo $Institute->name ?></option>
                                                        <?php
                                                            } else {
                                                                foreach ($Institute as $rl) {
                                                                    ?>
                                                            <option value="<?php echo $rl->id; ?>" <?php if ($rl->id == $institute) {
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
                                    <div class="col-md-2">
                                        <div class="input-group">
                                            <!-- <label for="year">Year</label> -->
                                            <select class="form-control" id="year" name="year">
                                                <option value="0">Select Year...</option>
                                                <?php
                                                if (!empty($Year)) {
                                                    if (isset($Year->year)) {
                                                        ?>
                                                        <option value="<?php echo $Year->year; ?>" <?php if ($Year->year == $year) {
                                                                                                                echo "selected";
                                                                                                            } ?>><?php echo $Year->year ?></option>
                                                        <?php
                                                            } else {
                                                                foreach ($Year as $rl) {
                                                                    ?>
                                                            <option value="<?php echo $rl->year; ?>" <?php if ($rl->year == $year) {
                                                                                                                        echo "selected";
                                                                                                                    } ?>><?php echo $rl->year ?></option>
                                                <?php
                                                        }
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
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
                                    <div class="col-md-3">
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

                                    <div class="col-md-3">
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
                            </div>
                        </form>
                        <!-- </div> -->
                    </div>

                    <div class="col-md-12 col-sm-12">
                    <?php
                            if (!empty($Records)) {
                                foreach ($Records as $record) {
                    ?>
                        <div class="col-md-3 col-sm-6">
                            <div class="product-grid3">
                                <div class="product-image3">
                                    <a href="#">
                                        <img class="pic-1" src="<?php if(!empty($record->image_url)){ echo base_url().$record->image_url;}else{ echo $defaultImg;} ?>">
                                        <!-- <img class="pic-1" src="http://bestjquery.com/tutorial/product-grid/demo4/images/img-1.jpg"> -->
                                        <img class="pic-2" src="<?php if(!empty($record->image_url)){ echo base_url().$record->image_url;}else{ echo $defaultImg;} ?>">
                                    </a>
                                    <ul class="social">
                                    <?php 
                                        if($roleId == 1){
                                            if(!empty($record->favId)){
                                                echo "<li ><a href='#' class='deleteProduct' data-id='$record->favId' data-msg='My Favorite List' data-url='favorite' title='Delete'><i class='fa fa-heart line-height' aria-hidden='true'></i></a></li>";
                                            }else{
                                                echo "<li ><a href='#' class='addFavorite' data-id='$record->id' data-msg='My Favorite List' data-url='favorite' title='Add'><i class='fa fa-heart line-height' aria-hidden='true'></i></a></li>";
                                            }

                                            if ($record->isPublic == 1) {
                                                echo "<li onclick='openModal($record->id)'><a href='#'><i class='fa fa-shopping-cart line-height'></i></a></li>";
                                            } else {
                                                echo "<li><a href='$record->url' target='_blank'><i class='fa fa-download line-height'></i></a></li>";
                                            }
                                        }
                                        /* if($roleId == 1){
                                            echo "<li ><a href=".base_url() . $editRoute . $record->id."><i class='fa fa-pencil line-height' ></i></a></li>
                                            <li ><a class='deleteProduct' href='#' data-id=".$record->id." data-msg=".$title."><i class='fa fa-trash line-height'></i></a></li>";
                                        } */

                                        /* if($roleId == 1){

                                        } */
                                    ?>
                                        
                                        
                                    </ul>
                                    <?php if(!empty($record->favId)){ ?>
                                        <span class="product-new-label" ><i class='fa fa-heart line-height' aria-hidden='true'></i></span>
                                    <?php }else{ ?>
                                    <span class="product-new-label">New</span>
                                    <?php } ?>
                                </div>
                                <div class="product-content">
                                    <h3 class="title"><a href="#"><?php echo $record->name; ?></a></h3>
                                    <span class=""><?php echo $record->CatName; ?></span>
                                    <span class=""><?php echo $record->SubcatName." ( ".$record->year." )"; ?></span>
                                    <!--  -->
                                    <p></p>
                                    <div class="price">
                                        <?php if($record->isPublic == 0){ echo "Free"; }else{?>
                                        <i class="fa fa-inr line-height"></i><?php echo $record->price; } ?>
                                        <!-- <span><i class="fa fa-inr line-height"></i><?php //echo $record->name; ?></span> -->
                                    </div>
                                    <ul class="rating">
                                        <li class="fa fa-star"></li>
                                        <li class="fa fa-star"></li>
                                        <li class="fa fa-star"></li>
                                        <li class="fa fa-star disable"></li>
                                        <li class="fa fa-star disable"></li>
                                    </ul>
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
<!-- <script type="text/javascript" src="<?php //echo base_url(); 
                                            ?>assets/js/common.js" charset="utf-8"></script> -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/dropdown.js" charset="utf-8"></script>
<script src="<?php echo base_url(); ?>assets/js/ajax.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/delete.js" type="text/javascript"></script>
<script type="text/javascript">
    var recordContent = <?php echo json_encode($Records); ?>;


    function openModal(id) {
        var record = recordContent.find(x => x.id == id);
        var _html = `<div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span></button>
                                <h4 class="modal-title"></h4>
                            </div>
                            <div class="modal-body">
                                
                                <p>Name :${record.name}</p>
                                <p>Price :-${record.price}</p>

                                <input type="hidden" id="name_${record.id}" value="${record.name}">
                                <input type="hidden" id="price_${record.id}" value="${record.price}">
                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" onClick="addToCartAjax(${record.id});" >Add To Cart</button>
                            </div>`;
        document.getElementById('model-content').innerHTML = _html;
        $('#modal-default').modal({
            show: true
        });
    }


    jQuery(document).ready(function() {



        jQuery('ul.pagination li a').click(function(e) {
            e.preventDefault();
            var link = jQuery(this).get(0).href;
            var value = link.substring(link.lastIndexOf('/') + 1);
            jQuery("#searchList").attr("action", baseURL + "<?php echo $route; ?>/" + value);
            jQuery("#searchList").submit();
        });
        jQuery('#reset').click(function(e) {
            // document.getElementById("institute").val() = 0;
            document.getElementById("institute").value = '0';
            // e.preventDefault();
            // jQuery("#institute").val() = 0;
        });




    });

    function addToCartAjax(element) {
        var name = document.getElementById("name_" + element).value;
        var price = document.getElementById("price_" + element).value;
        if (name != '' || price != 0) {
            $.ajax({
                type: "POST",
                // dataType : "json",
                url: baseURL + "addToCart/" + element,
                data: {
                    name: name,
                    price: price
                },
                success: function(response) {
                    let res = jQuery.parseJSON(response);
                    alert(res.msg);
                    if(res.status == true){
                        location.reload();
                    }
                    $('#modal-default').modal({
                        show: false
                    });

                },
                error: function(err) {
                    alert('Something went wront , please try again');
                }
            });
        }
    }
    getAjax('#category', "#subcategory", 'subcat/', "SubCategory", 'name');
    // addToCartAjax('#add-to-cart-7');
</script>