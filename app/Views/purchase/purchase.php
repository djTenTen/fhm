<?php
    $purchase_model = new \App\Models\Purchase_model; // to access the Purchase_model
    $encrypter = \Config\Services::encrypter(); // access to the encryptor
    $arr = array();
	$user_model = new \App\Models\User_model; // to access the users_model
	foreach($user_model->getUserAccess($_SESSION['groupid']) as $access){
		array_push($arr, $access['name']);
	}
?>
<div class="container">

    <?php
        // Message thrown from the controller
        if(!empty($_SESSION['purchase_updated'])){
            echo '<div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Update Success!</h4>
            <p>Purchase has been successfully Updated</p>
        </div>';
            unset($_SESSION['purchase_updated']);
        }
        if(!empty($_SESSION['purchase_pending'])){
            echo '<div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Update Success!</h4>
            <p>Purchase has been successfully set to Pending</p>
        </div>';
            unset($_SESSION['purchase_pending']);
        }
        if(!empty($_SESSION['purchase_delivered'])){
            echo '<div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Update Success!</h4>
            <p>Purchase has been successfully set to Delivered</p>
        </div>';
            unset($_SESSION['purchase_delivered']);
        }
        if(!empty($_SESSION['purchase_cancelled'])){
            echo '<div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Update Success!</h4>
            <p>Purchase has been successfully set to Cancelled</p>
        </div>';
            unset($_SESSION['purchase_cancelled']);
        }
    ?>

    <h1><?= $stats;?> Purchase</h1>


    <table class="table table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Date</th>
                <th>Invoice No.</th>
                <th>Supplier</th>
                <th>Quantity</th>
                <th>Subtotal</th>
                <th>Status</th>
                <th>Payment</th>
                <th>Added By</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                foreach($purchase as $ap){
                    $p = $purchase_model->getCount($ap['purchase_id']);
            ?>
            <tr>
                <td><?= $ap['purchase_id'];?></td>
                <td><?= $ap['invoice_date'];?></td>
                <td><?= $ap['invoice_no'];?></td>
                <td><?= $ap['name'];?></td>
                <td><?= $p['qty'];?></td>
                <td><?= number_format($p['subtotal'],2);?></td>
                <td><span class="badge badge-<?php if($ap['status']=='pending'){echo 'primary';}elseif($ap['status']=='delivered'){echo 'success';}elseif($ap['status']=='cancelled'){echo 'danger';}?>"><?= $ap['status'];?></span></td>
                <td><?= $ap['payment_status'];?></td>
                <td><?= $ap['nameuser'];?></td>
                <td>
                    <div class="btn-group">
                        <button type="button" class="btn btn-success btn-icon btn-sm load-data" data-toggle="modal" data-target="#modalview" data-purchase-id="<?= str_ireplace(['/','+'],['~','$'],$encrypter->encrypt($ap['purchase_id'])); ?>"><i class="fas fa-eye"></i></button>
                        <?php if(in_array('edit-purchase', $arr)){?>
                            <a href="<?= site_url().'/purchase/edit/'.str_ireplace(['/','+'],['~','$'],$encrypter->encrypt($ap['purchase_id'])); ?>" class="btn btn-primary btn-icon btn-sm"><i class="fas fa-edit"></i></a>
                        <?php }?>
                    </div>
                </td>
            </tr>
            <?php }?>
        </tbody>
    </table>

</div>



<!-- MODAL VIEW -->
<!-- Modal -->
<div class="modal fade" id="modalview" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Purchase</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <!-- TABLE VIEW FOR PURCHASE INFORMATION -->
           <div class="row1"></div>


           <!-- TABLE VIEW FOR PURCHASE ITEM INFORMATION -->
           <table class="table table-bordered mg-b-30">
                <thead>
                        <tr>
                        <th style="width: 10%">Quantity</th>
                        <th style="width: 45%" colspan="2">Description</th>
                        <th style="width: 10%">Price</th>
                        <th style="width: 15%">Sub-Total</th>
                    </tr>
                </thead>
                <tbody class="pitems">
  
                </tbody>
                <tfoot class="fitems">
                    
                </tfoot>
            </table>

            <div class="rvwv row">
                
            </div>
           
        </div>
        <div class="modal-footer">
            <form id="mpending" action="" method="post">
                <button type="submit" class="btn btn-danger">Mark Pending</button>
            </form>

            <form id="mdelivered" action="" method="post">
                <button type="submit" class="btn btn-success">Mark Delivered</button>
            </form>

            <form id="mcancelled" action="" method="post">
                <button type="submit" class="btn btn-warning">Mark Cancelled</button>
            </form>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
</div>
<!-- END OF MODAL VIEW -->



<script>

    function numberformat(num){
        return Number(num).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    }

    $(document).ready(function() {
        // When the button is clicked, show the modal and load the data
        $(".load-data").on("click", function() {
            // Show the modal
            var pID = $(this).data('purchase-id');
            // Fetch data using AJAX

            $('#mpending').attr('action', "<?= site_url("purchase/markpending/");?>" + pID);
            $('#mdelivered').attr('action', "<?= site_url("purchase/markdelivered/");?>" + pID);
            $('#mcancelled').attr('action', "<?= site_url("purchase/markcancelled/");?>" + pID);

            var span;
            $.ajax({
                url: "<?= site_url('purchase/getpurchasedetails/')?>" + pID,  // Replace with your actual data endpoint URL
                method: "GET",
                dataType: 'json',
                success: function(data) {

                    if(data.status == 'pending'){
                        span = `<span class="badge badge-primary">${ data.status }</span>`;
                    }else if(data.status == 'delivered'){
                        span = `<span class="badge badge-success">${ data.status }</span>`;
                    }else if(data.status == 'cancelled'){
                        span = `<span class="badge badge-danger">${ data.status }</span>`;
                    }

                    // Populate the modal body with the fetched data
                    $(".row1").html(
                        `
                        <table class="table table-bordered mb-4">
                            <tbody>
                                <tr>
                                    <td style="width: 20%">ID</td>
                                    <td style="width: 30%">${ data.purchase_id}</td>
                                    <td style="width: 20%">Deliver To:</td>
                                    <td style="width: 30%">${ data.warehouse}</td>
                                </tr>

                                <tr>
                                    <td>Invoice No.</td>
                                    <td>${ data.invoice_no}</td>
                                    <td>Invoice Date</td>
                                    <td>${ data.invoice_date}</td>

                                </tr>

                                <tr>
                                    <td>Supplier</td>
                                    <td colspan="3">${ data.supplier}</td>
                                </tr>

                                <tr>
                                    <td>Status</td>
                                    <td colspan="3">${span}</td>
                                </tr>

                                <tr>
                                    <td>Payment Terms</td>
                                    <td colspan="3">${ data.payment_method}</td>
                                </tr>

                                <tr>
                                    <td>Added By</td>
                                    <td>${ data.nameuser}</td>
                                    <td>Added On</td>
                                    <td>${ data.added_on}</td>
                                </tr>
                            </tbody>
                        </table>
                        `
                    );

                },
                error: function() {
                    // Handle error if the data fetch fails
                    $(".modal-body").html("Error loading data");
                }

            });

            $.ajax({
                url: "<?= site_url('purchase/getpurchaseitems/')?>" + pID,  // Replace with your actual data endpoint URL
                method: "GET",
                dataType: 'json',
                success: function(data) {

                    var tableHTML = "";
                    var rv = 0;
                    var wv = 0;
                    var qty = 0;
                    var subtotal = 0;
                    $.each(data, function(index, item) {
                        rv += parseInt(item.quantity * item.retail_price);
                        wv += parseInt(item.quantity * item.wholesale_price);
                        qty += parseInt(item.quantity);
                        subtotal += parseInt(item.quantity * item.price);
                        tableHTML += `
                            <tr>
                                <td class="align-middle text-center">${ item.quantity}</td>
                                <td class="align-middle" style="width: 1%;">
                                    
                                </td>
                                <td class="align-middle">${ item.name}</td>
                                <td class="text-right align-middle">${ numberformat(item.price)}</td>
                                <td class="text-right align-middle">₱ ${ numberformat(item.quantity * item.price)}</td>
                            </tr>
                        `;

                    });

                    $(".pitems").html(tableHTML);

                    $(".fitems").html(`
                        <tr>
                            <td class="text-center">${qty}</td>
                            <td class="text-right" colspan="3">Grand Total</td>
                            <td class="text-right">₱ ${ numberformat(subtotal)}</td>
                        </tr>
                    `);

                    $(".rvwv").html(`
                        <div class="col-lg-6 tx-24">Retail Value:₱ ${ numberformat(rv)}</div>
                        <div class="col-lg-6 tx-24">Wholesale Value:₱ ${ numberformat(wv)}</div>
                    `);
                },
                error: function() {
                    // Handle error if the data fetch fails
                    $(".modal-body").html("Error loading data");
                }

            });

        });

    });

</script>

