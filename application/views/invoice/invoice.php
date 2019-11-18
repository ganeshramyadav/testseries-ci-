<style>
    table {
        font-family: arial, sans-serif;
        font-size: 14px;
        border-collapse: collapse;
        width: 100%;
    }

    /* td, th { */
    /* th { */
    td {
        border: 1px solid #dddddd80;
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #dddddd80;
    }
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> <?php echo $pageTitle; ?>
        <!-- <small>Add / Edit </small> -->
      </h1>
    </section>
    <!-- Right side column. Contains the navbar and content of the page -->
    <!-- <aside class="right-side"> -->
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Invoice
                <small><?php echo $Orders->id; ?></small>
            </h1>
            <!-- <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
                <li><a href="#">Examples</a></li>
                <li class="active">Invoice</li>
            </ol> -->
        </section>

        <div class="pad margin no-print">
            <div class="alert alert-info" style="margin-bottom: 0!important;">
                <i class="fa fa-info"></i>
                <b>Note:</b> This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
            </div>
        </div>

        <!-- Main content -->
        <section class="content invoice">
            <!-- title row -->
            <div class="row">
                <div class="col-xs-12">
                    <h2 class="page-header">
                        <i class="fa fa-globe"></i> AOA, Inc.
                        <small class="pull-right">Date: <?php echo Date("d/m/Y");?></small>
                    </h2>
                </div><!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
                <!-- <div class="col-sm-4 invoice-col">
                    From
                    <address>
                        <strong>Admin, Inc.</strong><br>
                        795 Folsom Ave, Suite 600<br>
                        San Francisco, CA 94107<br>
                        Phone: (804) 123-5432<br/>
                        Email: info@almasaeedstudio.com
                    </address>
                </div> -->
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    To
                    <address>
                        <strong><?php echo $User->first_name." ".$User->last_name ?></strong><br>
                        <?php echo $User->shipping_address_line_1.", ".$User->shipping_address_line_2; ?><br>
                        <?php echo $User->shipping_address_city.", ".$User->shipping_address_state; ?><br>
                        Pin: <?php echo $User->shipping_address_pincode; ?><br>
                        Phone: <?php echo $User->mobile_phone; ?><br/>
                        Email: <?php echo $User->email; ?>
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col"></div>
                <div class="col-sm-4 invoice-col">
                    <b><?php echo $title." ".$Orders->id; ?></b><br/>
                    <br/>
                    <b>Order ID:</b> <?php echo $Orders->id; ?><br/>
                    <b>Payment Date:</b> <?php echo date("d/m/Y",strtotime($Orders->order_date)); ?><br/>
                    <!-- <b>Account:</b> 968-34567 -->
                </div><!-- /.col -->
            </div><!-- /.row -->

            <!-- Table row -->
            <div class="row">
                <div class="col-xs-12 table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <!-- <th>Type</th> -->
                                <th>Product</th>
                                <th>Serial #</th>
                                <th>Description</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($Items){
                                foreach($Items as $Item){
                            ?>
                                <tr>
                                    <td>
                                        <img src="<?php //if($Item->video == 1){ echo base_url()."assets/images/video.png"; }else{echo base_url()."assets/images/pdf.jpg";} ?>" alt="FileType" height=20px;>
                                    </td>
                                    <!-- <td><?php if($Item->video == 1){ echo "video";}else{ echo "pdf";} ?></td> -->
                                    <td><?php echo $Item->name; ?></td>
                                    <td><?php echo $Item->id; ?></td>
                                    <td><?php echo $Item->description; ?></td>
                                    <td>&#x20a8;<?php echo " ".$Item->price; ?></td>
                                </tr>
                            <?php
                                }
                            }?>
                            <!-- <tr>
                                <td>1</td>
                                <td>Call of Duty</td>
                                <td>455-981-221</td>
                                <td>El snort testosterone trophy driving gloves handsome</td>
                                <td>$64.50</td>
                            </tr> -->

                            <!-- <tr>
                                <td>1</td>
                                <td>Need for Speed IV</td>
                                <td>247-925-726</td>
                                <td>Wes Anderson umami biodiesel</td>
                                <td>$50.00</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Monsters DVD</td>
                                <td>735-845-642</td>
                                <td>Terry Richardson helvetica tousled street art master</td>
                                <td>$10.70</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Grown Ups Blue Ray</td>
                                <td>422-568-642</td>
                                <td>Tousled lomo letterpress</td>
                                <td>$25.99</td>
                            </tr> -->

                        </tbody>
                    </table>
                </div><!-- /.col -->
            </div><!-- /.row -->

            <!-- accepted payments column -->
            <div class="row">
                <div class="col-xs-6">
                    <!-- <p class="lead">Payment Methods:</p>
                    <img src="../../img/credit/visa.png" alt="Visa"/>
                    <img src="../../img/credit/mastercard.png" alt="Mastercard"/>
                    <img src="../../img/credit/american-express.png" alt="American Express"/>
                    <img src="../../img/credit/paypal2.png" alt="Paypal"/>
                    <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                        Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                    </p> -->
                </div>
                <div class="col-xs-6">
                    <!-- <p class="lead">Amount Due 2/22/2014</p> -->
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th style="width:50%">Subtotal:</th>
                                <td>&#x20a8;<?php echo " ".$Orders->amount; ?></td>
                            </tr>
                            <tr>
                                <th>Tax</th>
                                <td>&#x20a8;<?php echo " ".$Orders->tax; ?></td>
                            </tr>
                            <tr>
                                <th>Discount</th>
                                <td>&#x20a8;<?php echo " ".$Orders->discount_amount; ?></td>
                            </tr>
                            <tr>
                                <th>Total:</th>
                                <td>&#x20a8;<?php echo " ".$Orders->amount; ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <!-- this row will not appear when printing -->
            <div class="row no-print">
                <div class="col-xs-12">
                    <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
                    <!-- <button class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Generate PDF</button> -->
                </div>
            </div>
        </section>
    <!-- </aside> -->
</div>