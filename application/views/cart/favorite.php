<link href="<?php echo base_url(); ?>assets/css/listing.css" rel="stylesheet" type="text/css" />

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-users"></i> <?php echo $title; ?>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12 col-md-12 col-sm-12">
                <div class="box">
                    <div class="box-header" style="text-align: -webkit-center;">
                        <?php $this->load->helper("form"); ?>
                        <form action="<?php echo base_url() . $route ?>" method="POST" id="searchList">

                            <div class="input-group">
                                <div class="row" style="margin-left: 0px !important; padding-top: 2%;">

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
                                // pre($record);
                    ?>
                        <div class="col-md-3 col-sm-6">
                            <div class="product-grid3">
                                <div class="product-image3">
                                    <a href="#">
                                        <?php 
                                            if(!empty($record->image_url)){ 
                                                $img_url = base_url().$record->image_url;
                                            }else{
                                                if($record->video == 1){
                                                    $img_url = base_url().$video;
                                                }else{
                                                    $img_url = base_url().$pdf;
                                                }
                                            }
                                        ?>
                                        <img class="pic-1" src="<?php echo $img_url ?>">
                                        <!-- <img class="pic-1" src="http://bestjquery.com/tutorial/product-grid/demo4/images/img-1.jpg"> -->
                                        <img class="pic-2" src="<?php echo $img_url ?>">
                                    </a>
                                    <ul class="social">
                                    <?php 
                                        // echo "<a class='btn btn-sm btn-danger deleteProduct' href='#' data-id='1' data-msg='My Cart' data-url='shopping_cart' title='Delete'><i class='fa fa-trash'></i></a>";
                                        echo "<li ><a href='#' class='btn-danger deleteProduct' data-id='$record->id' data-msg='My Favorite List' data-url='$deleteUrl' title='Delete'><i class='fa fa-trash line-height' aria-hidden='true'></i></a></li>";
                                        if ($record->isPublic == 1) {
                                            echo "<li onclick='openModal($record->product_id)'><a href='#'><i class='fa fa-shopping-cart line-height'></i></a></li>";
                                        } else {
                                            echo "<li><a href='$record->url' target='_blank'><i class='fa fa-download line-height'></i></a></li>";
                                        }
                                    ?>
                                        
                                        
                                    </ul>
                                    
                                    <span class="product-new-label" ><i class='fa fa-heart line-height' aria-hidden='true'></i></span>
                                    
                                </div>
                                <div class="product-content">
                                    <h3 class="title"><a href="#"><?php echo $record->Pname; ?></a></h3>
                                    <span class=""><?php echo $record->CatName; ?></span>
                                    <span class=""><?php echo $record->SubcatName." ( ".$record->year." )"; ?></span>
                                    
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
</script>