<?php
    $sales_model = new \App\Models\Sales_model; // to access the sales_model
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
        if(!empty($_SESSION['sales_updated'])){
            echo '<div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Update Success!</h4>
            <p>Sales has been successfully Updated</p>
        </div>';
            unset($_SESSION['sales_updated']);
        }
        if(!empty($_SESSION['sales_delivered'])){
            echo '<div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Update Success!</h4>
            <p>Sales has been successfully set to Delivered</p>
        </div>';
            unset($_SESSION['sales_delivered']);
        }
        if(!empty($_SESSION['sales_cancelled'])){
            echo '<div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Update Success!</h4>
            <p>Sale has been successfully set to Cancelled</p>
        </div>';
            unset($_SESSION['sales_cancelled']);
        }
        if(!empty($_SESSION['sales_missing'])){
            echo '<div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Update Success!</h4>
            <p>Sales has been successfully set to Missing</p>
        </div>';
            unset($_SESSION['sales_missing']);
        }
    ?>
    
    <h1><?= $stats; ?> Sales</h1>



    <table class="table table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Invoice No.</th>
                <th>Warehouse</th>
                <th>Customer</th>
                <th>Subtotal</th>
                <th>Date</th>
                <th>Status</th>
                <th>Payment</th>
                <th>Added By</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                foreach($sales as $as){
                    $sub = $sales_model->getSubtotalSales($as['sales_id']);
            ?>
            <tr>
                <td><?= $as['sales_id'];?></td>
                <td><?= $as['invoice_no'];?></td>
                <td><?= $as['warehouse'];?></td>
                <td><?= $as['customer'];?></td>
                <td><?= number_format($sub['subtotal'], 2);?></td>
                <td><?= $as['invoice_date'];?></td>
                <td><span class="badge badge-<?php if($as['status'] == 'delivered'){echo 'success';}elseif($as['status'] == 'cancelled'){echo 'warning';}elseif($as['status'] == 'missing'){echo 'danger';}?>"><?= str_replace("-", " ", ucwords($as['status'])); ?></span></td>
                <td><span class="badge badge-<?php if($as['payment_status'] == 'unpaid'){echo 'danger';}else{echo 'success';}?>"><?= ucwords($as['payment_status']);?></span></td>
                <td><?= $as['nameuser'];?></td>
                <td>
                    <div class="btn-group">
                        <button type="button" class="btn btn-success btn-icon btn-sm load-data" data-toggle="modal" data-target="#modalview" data-sales-id="<?= str_ireplace(['/','+'],['~','$'],$encrypter->encrypt($as['sales_id'])); ?>"><i class="fas fa-eye"></i></button>
                        <?php if(in_array('edit-sales', $arr)){?>
                            <a href="<?= site_url().'sales/edit/'.str_ireplace(['/','+'],['~','$'],$encrypter->encrypt($as['sales_id'])); ?>/<?= str_ireplace(['/','+'],['~','$'],$encrypter->encrypt($as['customer_id']));?>" class="btn btn-primary btn-icon btn-sm"><i class="fas fa-edit"></i></a>
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
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Sales</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">

            <table class="table table-bordered mb-4">
                <tbody class="salesdetails">
                    
                    
                </tbody>
            </table>
        
            <table class="table table-bordered mb-4">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 10%">Quantity</th>
                        <th class="text-center" style="width: 55%" colspan="2">Description</th>
                        <th class="text-center" style="width: 10%">Price</th>
                        <th class="text-center" style="width: 15%">Sub-Total</th>
                    </tr>
                </thead>
                <tbody class="salesitems">
                    
                </tbody>
                <tfoot class="salesfoot">
                    
                </tfoot>
            </table>
        </div>
        
        <div class="modal-footer">
            <form id="mdelivered" action="" method="post">
                <button type="submit" class="btn btn-primary">Mark Delivered</button>
            </form>
            <form id="mcancelled" action="" method="post">
                <button type="submit" class="btn btn-warning">Mark Cancelled</button>
            </form>
            <form id="mmissing" action="" method="post">
                <button type="submit" class="btn btn-danger">Mark Missing</button>
            </form>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Ok</button>
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
            var sID = $(this).data('sales-id');
            // Fetch data using AJAX

            var span;
            $.ajax({
                url: "<?= site_url('sales/viewdetails/')?>" + sID,  // Replace with your actual data endpoint URL
                method: "GET",
                dataType: 'json',
                beforeSend: function() {
                    $(".modal-body").html("Loading...");
                },
                success: function(data) {

                    $('#mdelivered').attr('action', "<?= site_url("sales/markdeliveredsales/");?>" + sID);
                    $('#mcancelled').attr('action', "<?= site_url("sales/markcancelledsales/");?>" + sID);
                    $('#mmissing').attr('action', "<?= site_url("sales/markmissingsales/");?>" + sID);


                    if(data.status == 'delivered'){
                        span = `<span class="badge badge-success">${ data.status }</span>`;
                    }else if(data.status == 'missing'){
                        span = `<span class="badge badge-danger">${ data.status }</span>`;
                    }else if(data.status == 'cancelled'){
                        span = `<span class="badge badge-warning">${ data.status }</span>`;
                    }

                    // Populate the modal body with the fetched data
                    $(".salesdetails").html(
                        `
                        <tr>
                            <td style="width: 20%">ID</td>
                            <td style="width: 30%">${ data.sales_id}</td>

                            <td style="width: 20%">Status</td>
                            <td style="width: 30%">${span}</td>
                        </tr>
                        <tr>
                            <td>Invoice No.</td>
                            <td>${ data.invoice_no}</td>
                            <td>Invoice Date</td>
                            <td>${ data.invoice_date}</td>
                        </tr>
                        <tr>
                            <td>Official Receipt</td>
                            <td>${ data.official_receipt}</td>
                            <td>Official Receipt No.</td>
                            <td>${ data.official_receipt_no}</td>
                        </tr>
                        <tr>
                            <td>Warehouse</td>
                            <td>${ data.warehouse}</td>
                            <td>Payment Status</td>
                            <td>${data.payment_status}</td>
                        </tr>
                        <tr>
                            <td>Customer</td>
                            <td>${ data.customer}</td>
                            <td>Delivery Method</td>
                            <td>${ data.delivery_method}</td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td colspan="3">${ data.address}</td>
                        </tr>
                        <tr>
                            <td>Contact Number</td>
                            <td colspan="3">${ data.contact_number}</td>
                        </tr>
                        <tr>
                            <td>Added By</td>
                            <td>${ data.nameuser}</td>

                            <td>Added On</td>
                            <td>${ data.added_on}</td>
                        </tr>
                        `
                    );

                },
                error: function() {
                    // Handle error if the data fetch fails
                    $(".modal-body").html("Error loading data");
                }

            });
            
            $.ajax({

                url: "<?= site_url('sales/viewitems/')?>" + sID,  // Replace with your actual data endpoint URL
                method: "GET",
                dataType: 'json',
                success: function(data) {

                    var tableHTML = "";
                    var count = 0;
                    var subtotal = 0;
                    $.each(data, function(index, item) {

                        count += parseInt(item.quantity);
                        subtotal += parseInt(item.quantity) * parseInt(item.price);

                        tableHTML += `
                            <tr>
                                <td class="align-middle text-center">${item.quantity}</td>
                                <td style="width: 1%;">
                                    
                                </td>
                                <td class="align-middle">${item.name}</td>
                                <td class="align-middle text-right">${numberformat(item.price)}</td>
                                <td class="align-middle text-right">${numberformat(parseInt(item.quantity) * parseInt(item.price))}</td>
                            </tr>
                        `;

                    });

                    $(".salesitems").html(tableHTML);


                    $(".salesfoot").html(
                        `
                        <tr>
                            <td class="text-center">${count}</td>
                            <td class="text-right" colspan="3">Subtotal</td>
                            <td class="text-right">${numberformat(subtotal)}</td>
                        </tr>
                        <tr>
                            <td colspan="4" class="text-right">Delivery Fee</td>
                            <td class="text-right"></td>
                        </tr>
                        <tr>
                            <td colspan="4" class="text-right">Grand Total</td>
                            <td class="text-right"></td>
                        </tr>
                        `
                    );

                },
                error: function() {
                    // Handle error if the data fetch fails
                    $(".modal-body").html("Error loading data");
                }

            });

        });

    });

</script>



