<?php
	$encrypter = \Config\Services::encrypter(); // access to the encryptor
	$accounting_model = new \App\Models\Accounting_model; // access to the accounting model
	$arr = array();
	$user_model = new \App\Models\User_model; // to access the users_model
	foreach($user_model->getUserAccess($_SESSION['groupid']) as $access){
		array_push($arr, $access['name']);
	}
?>
<div class="container">

	<?php
        // Message thrown from the controller
		if(!empty($_SESSION['expense_updated'])){
            echo '<div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Update Success!</h4>
        	<p>Expense has been successfully Updated</p>
        </div>';
            unset($_SESSION['expense_updated']);
        }

        if(!empty($_SESSION['expense_pending'])){
            echo '<div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Update Success!</h4>
        	<p>Expense has been successfully set to Pending</p>
        </div>';
            unset($_SESSION['expense_pending']);
        }

		if(!empty($_SESSION['expense_completed'])){
            echo '<div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Update Success!</h4>
        	<p>Expense has been successfully set to Verified</p>
        </div>';
            unset($_SESSION['expense_completed']);
        }

		if(!empty($_SESSION['expense_cancelled'])){
            echo '<div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Update Success!</h4>
        	<p>Expense has been successfully set to Cancelled</p>
        </div>';
            unset($_SESSION['expense_cancelled']);
        }
        
    ?>

    <h1><?= $state;?> Expense</h1>


    <table class="table table-md table-checkbox table-bordered">
		<thead>
			<tr>
				<th style="width: 1%;">ID</th>
				<th style="width: 15%;">Date</th>
				<th style="width: 30%;">Payee</th>
				<th style="width: 15%;">Total</th>
				<th style="width: 1%;">Status</th>
				<th style="width: 20%;">Added By</th>
				<th style="width: 20%;">Added On</th>
				<th style="width: 1%;"></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($expense as $exp){?>
			<tr>
				<td class="align-middle"><?= $exp['expense_id']; ?></td>
				<td class="align-middle"><?= $exp['date']; ?></td>
				<td class="align-middle"><?= $exp['name']; ?></td>
				<td class="align-middle"><?= number_format($exp['total'], 2); ?></td>
				<td class="align-middle">			
					<?php if($exp['status'] == 'pending'){ ?>
					<span class="badge badge-primary">Pending</span>
					<?php } else if($exp['status'] == 'verified'){ ?>
					<span class="badge badge-success">Verified</span>
					<?php } else if($exp['status'] == 'cancelled'){ ?>
					<span class="badge badge-danger">Cancelled</span>
					<?php } ?>
				</td>
				<td class="align-middle"><?= $exp['nameuser']; ?></td>
				<td class="align-middle"><?= $exp['added_on']; ?></td>  
				<td class="align-middle">
					<div class="no-wrap">

						<div class="btn-group">
							<button type="button" class="btn btn-icon btn-success btn-xs load-data" data-toggle="modal" data-target="#modalview" data-expense-id="<?= str_ireplace(['/','+'],['~','$'],$encrypter->encrypt($exp['expense_id']))?>"><i class="fas fa-eye"></i></button>
							<?php if(in_array('edit-expense', $arr)){?>
								<a href="<?= site_url().'expense/edit/'.str_ireplace(['/','+'],['~','$'],$encrypter->encrypt($exp['expense_id'])); ?>" class="btn btn-primary btn-icon btn-xs"><i class="fas fa-edit"></i></a>
							<?php }?>
						</div>

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
			<h5 class="modal-title" id="exampleModalLabel"><?= $exp['date']; ?> Expense</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="modal-body">

			<table class="table table-bordered mb-4">
				<tbody class="row1">
					
				</tbody>
			</table>

			<h4 class="mg-b-15 tx-spacing--1">Summary</h4>

			<table class="table table-bordered mb-4">
				<thead>
					<tr>
						<td style="width: 25%;">Category</td>
						<td style="width: 50%;">Description</td>
						<td style="width: 25%;">Amount</td>
					</tr>
				</thead>
				<tbody class="row2">
					
				</tbody>
				<tfoot class="row2foot">
					
				</tfoot>
			</table>


			<h4 class="mg-b-15 tx-spacing--1">Payment History</h4>

			<table class="table table-bordered mb-4">
				<thead>
					<tr>
						<td style="width: 15%;">Payment Method</td>
						<td style="width: 50%;">Details</td>
						<td style="width: 15%;">Status</td>
						<td style="width: 20%;">Amount</td>
						<td style="width: 1%;"></td>
					</tr>
				</thead>
				<tbody class="row3">
					
				</tbody>
				<tfoot class="row3foot">
					
				</tfoot>
			</table>
																
		</div>
		<div class="modal-footer">

			<form id="mpending" action="" method="post">
                <button type="submit" class="btn btn-danger">Mark Pending</button>
            </form>
            <form id="mverified" action="" method="post">
                <button type="submit" class="btn btn-success">Mark Verified</button>
            </form>
            <form id="mcancel" action="" method="post">
                <button type="submit" class="btn btn-warning">Mark Cancelled</button>
            </form>
			
			<a id="printvoucher" href="" target="_blank" class="btn btn-info">Print Voucher</a>
            
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Ok</button>
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
            var eID = $(this).data('expense-id');
            // Fetch data using AJAX
            
            $('#mpending').attr('action', "<?= site_url("expense/markpending/");?>" + eID);
            $('#mverified').attr('action', "<?= site_url("expense/markverified/");?>" + eID);
            $('#mcancel').attr('action', "<?= site_url("expense/markcancelled/");?>" + eID);
            $('#printvoucher').attr('href', "<?= site_url("expense/printvoucher/");?>" + eID);

            var span;
            $.ajax({
                url: "<?= site_url('expense/viewstdetails/')?>" + eID,  // Replace with your actual data endpoint URL
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
                        <tr>
							<td style="width: 20%">ID</td>
							<td style="width: 30%">${data.expense_id}</td>
							<td style="width: 20%">Status</td>
							<td style="width: 30%">
								${span}
							</td>
						</tr>
						<tr>
							<td>Name</td>
							<td>${data.name}</td>
							<td>Date</td>
							<td>${data.date}</td>
						</tr>
						<tr>
							<td>Remarks</td>
							<td colspan="3">${data.remarks}</td>
						</tr>
						<tr>
							<td>Added By</td>
							<td>${data.nameuser}</td>

							<td>Added On</td>
							<td>${data.added_on}</td>
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

                url: "<?= site_url('expense/viewsummary/')?>" + eID, // Replace with your actual data endpoint URL
                method: "GET",
                dataType: 'json',
                success: function(data) {

                    var tableHTML = "";
                    var totalsumm = 0;
                    $.each(data, function(index, item) {

                        tableHTML += `
							<tr>
								<td>${ item.category }</td>
								<td>${ item.description}</td>
								<td class="text-right"> ${ numberformat(item.amount)}</td>
							</tr>
                        `;

                        totalsumm += parseInt(item.amount);
                    });

                    $(".row2").html(tableHTML);

                    $(".row2foot").html(
                        `
						<tr>
							<td colspan="2" class="text-right">Total</td>
							<td class="text-right">₱ ${ numberformat(totalsumm)}</td>
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

				url: "<?= site_url('expense/paymenthistory/')?>" + eID, // Replace with your actual data endpoint URL
				method: "GET",
				dataType: 'json',
				success: function(data) {

					var tableHTML = "";
					var totalsumm = 0;
					var span = '';
					$.each(data, function(index, item) {
						var tr = '';

						if(item.status == 'pending'){
                        	span = `<span class="badge badge-primary">${ item.status }</span>`;
						}else if(item.status == 'verified'){
							span = `<span class="badge badge-success">${ item.status }</span>`;
						}else if(item.status == 'Cancelled'){
							span = `<span class="badge badge-danger">${ item.status }</span>`;
						}


						if(item.method == 'check'){
							tr = `
								<tr>
									<td>Account</td>
									<td class="wd-50p">${item.bank_account}</td>
								</tr>
								<tr>
									<td>Payee</td>
									<td>${item.check_payee}</td>
								</tr>
								<tr>
									<td>Check Number</td>
									<td>${item.check_number}</td>
								</tr>
							`;
						}

						tableHTML += `
							<tr>
								<td>${item.method}</td>
								<td>
									<table class="wd-100p">
										<tbody>
											<tr>
												<td class="wd-35p">Date</td>
												<td class="wd-65p">${item.date}</td>
											</tr>
											${tr}
										</tbody>
									</table>
								</td>
								<td class="text-center">
									${span}
								</td>
								<td class="text-right">₱ ${ numberformat(item.amount)}</td>
								<td>
									
								</td>
							</tr>
						`;

						totalsumm += parseInt(item.amount);
					});

					$(".row3").html(tableHTML);

					$(".row3foot").html(
						`
						<tr>
							<td colspan="3" class="text-right">Total</td>
							<td class="text-right">₱ ${ numberformat(totalsumm)}</td>
							<td></td>
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