<?php 
    $encrypter = \Config\Services::encrypter();
    $inventory_model = new \App\Models\Inventory_model; // to access the inventory_model
    $stock_model = new \App\Models\Stock_model; // to access the stock_model
    $arr = array();
	$user_model = new \App\Models\User_model; // to access the users_model
	foreach($user_model->getUserAccess($_SESSION['groupid']) as $access){
		array_push($arr, $access['name']);
	}
?>
<div class="container"> 

    <?php
        // Message thrown from the controller
        if(!empty($_SESSION['stocktransfer_updated'])){
            echo '<div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Update Success!</h4>
            <p>Stock Transfer has been successfully Updated</p>
        </div>';
            unset($_SESSION['stocktransfer_updated']);
        }
        if(!empty($_SESSION['stocktransfer_pending'])){
            echo '<div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Update Success!</h4>
            <p>Stock Transfer has been successfully set to Pending</p>
        </div>';
            unset($_SESSION['stocktransfer_pending']);
        }
        if(!empty($_SESSION['stocktransfer_completed'])){
            echo '<div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Update Success!</h4>
            <p>Stock Transfer has been successfully set to Completed</p>
        </div>';
            unset($_SESSION['stocktransfer_completed']);
        }
        if(!empty($_SESSION['stocktransfer_cancelled'])){
            echo '<div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Update Success!</h4>
            <p>Stock Transfer has been successfully set to Cancelled</p>
        </div>';
            unset($_SESSION['stocktransfer_cancelled']);
        }

    ?>

    <h1><?= $stats;?> Stock Transfer</h1>

    <table class="table table-md table-bordered">
		<thead>
			<tr>
				<th style="width: 1%;">ID</th>
				<th style="width: 10%;">Date</th>
				<th style="width: 20%;">From</th>
				<th style="width: 20%;">To</th>
				<th style="width: 10%;">Quantity</th>
				<th style="width: 1%;">Status</th>
				<th style="width: 20%;">Added By</th>
				<th style="width: 20%;">Added On</th>
				<th style="width: 1%;">Action</th>
			</tr>
		</thead>
		<tbody>
			<?php 
                foreach($stocktransfer as $st){
                    $whf = $inventory_model->getwarehousename($st['transfer_from']);
                    $wht = $inventory_model->getwarehousename($st['transfer_to']);
                    $itmcount = $stock_model->countStockTransfer($st['stock_transfer_id']);
            ?>
			<tr>
				<td class="align-middle"><?= $st['stock_transfer_id'];?></td>
				<td class="align-middle"><?= $st['transfer_date'];?></td>
				<td class="align-middle"><?= $whf['name'];?></td>
				<td class="align-middle"><?= $wht['name'];?></td>
				<td class="align-middle"><?= $itmcount['total'];?></td>
				<td class="align-middle"><span class="badge badge-<?php if($st['status'] == 'pending'){echo 'danger';}elseif($st['status'] == 'cancelled'){echo 'warning';}elseif($st['status'] == 'completed'){echo 'success';}?>"><?= ucwords(str_replace("-", " ", $st['status'])); ?></span></td>
				<td class="align-middle"><?= $st['nameuser'];?></td>
				<td class="align-middle"><?= $st['added_on']?></td>
				<td class="align-middle">
					<div class="btn-group">
						<?php if(in_array('edit-stock-transfer', $arr) and $st['status'] != 'completed'){?>
                            <a href="<?= site_url();?>stocktransfer/edit/<?= str_ireplace(['/','+'],['~','$'],$encrypter->encrypt($st['stock_transfer_id']));?>" class="btn btn-icon btn-primary btn-xs"><i class="fas fa-edit"></i></a>
						<?php } ?>
                            <button type="button" class="btn btn-icon btn-success btn-xs load-data" data-toggle="modal" data-target="#modalview" data-st-id="<?= str_ireplace(['/','+'],['~','$'],$encrypter->encrypt($st['stock_transfer_id']))?>"><i class="fas fa-eye"></i></button>
					</div>
				</td>
			</tr>
			<?php }?>
		</tbody>
	</table>


</div>





<!-- MODAL VIEW -->
<div class="modal fade" id="modalview" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Purchase</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            
            <div class="row1"></div>
    
            <table class="table table-bordered mg-b-20">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 1%;"></th>
                        <th class="text-center" colspan="2" style="width: 80%;">Name</th>
                        <th class="text-center" style="width: 20%;">Quantity</th>
                    </tr>
                </thead>
                <tbody class="stockitem">
                    
                </tbody>
                <tfoot class="stockfooter">
                   
                </tfoot>
            </table>
            
            
        </div>
        <div class="modal-footer">
            <a id="printsttransfer" href="" target="_blank" class="btn btn-info">Print Stock Transfer</a>
            <form id="mpending" action="" method="post">
                <button type="submit" class="btn btn-danger">Mark Pending</button>
            </form>
            <form id="mcomlete" action="" method="post">
                <button type="submit" class="btn btn-success">Mark Completed</button>
            </form>
            <form id="mcancel" action="" method="post">
                <button type="submit" class="btn btn-warning">Mark Cancelled</button>
            </form>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Ok</button>
        </div>
        </div>
    </div>
</div>
<!-- END OF MODAL VIEW -->





<script>

    $(document).ready(function() {
        // When the button is clicked, show the modal and load the data
        $(".load-data").on("click", function() {
            // Show the modal
            var stID = $(this).data('st-id');
            // Fetch data using AJAX
            
            $('#mpending').attr('action', "<?= site_url("stocktransfer/markpending/");?>" + stID);
            $('#mcomlete').attr('action', "<?= site_url("stocktransfer/markcompleted/");?>" + stID);
            $('#mcancel').attr('action', "<?= site_url("stocktransfer/markcancelled/");?>" + stID);
            $('#printsttransfer').attr('href', "<?= site_url("stocktransfer/printstocktransfer/");?>" + stID);

            var span;
            $.ajax({
                url: "<?= site_url('stocktransfer/viewstdetails/')?>" + stID,  // Replace with your actual data endpoint URL
                method: "GET",
                dataType: 'json',
                success: function(data) {

                    if(data.status == 'pending'){
                        span = `<span class="badge badge-danger">${ data.status }</span>`;
                    }else if(data.status == 'ready'){
                        span = `<span class="badge badge-warning">${ data.status }</span>`;
                    }else if(data.status == 'completed'){
                        span = `<span class="badge badge-success">${ data.status }</span>`;
                    }else if(data.status == 'cancelled'){
                        span = `<span class="badge badge-danger">${ data.status }</span>`;
                    }

                    // Populate the modal body with the fetched data
                    $(".row1").html(
                        `
                        <table class="table table-bordered mg-b-20">
                            <tbody>
                                <tr>
                                    <td style="width: 20%;">ID</td>
                                    <td style="width: 30%;">${ data.stock_transfer_id}</td>

                                    <td style="width: 20%;">Status</td>
                                    <td style="width: 30%;">${span}</span></td>
                                </tr>
                                <tr>
                                    <td>From</td>
                                    <td colspan="3">${data.stfrom}</td>
                                </tr>
                                <tr>
                                    <td>To</td>
                                    <td colspan="3">${data.stto}</td>
                                </tr>
                                <tr>
                                    <td>Added By</td>
                                    <td>${data.nameuser}</td>
                                    <td>Added On</td>
                                    <td>${data.added_on}</td>
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

                url: "<?= site_url('stocktransfer/viewstitems/')?>" + stID, // Replace with your actual data endpoint URL
                method: "GET",
                dataType: 'json',
                success: function(data) {

                    var tableHTML = "";
                    var count = 0;
                    $.each(data, function(index, item) {

                        tableHTML += `
                            <tr>
                                <td class="align-middle">${item.quantity}</td>
                                <td style="width: 1%;">
                                    
                                </td>
                                <td class="align-middle">${item.name}</td>
                                <td class="align-middle text-center">${item.quantity}</td>
                            </tr>

                        `;

                        count += parseInt(item.quantity);
                    });

                    $(".stockitem").html(tableHTML);


                    $(".stockfooter").html(
                        `
                            <tr>
                                <th class="text-right" colspan="3">Total</th>
                                <td class="text-center">${count}</td>
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