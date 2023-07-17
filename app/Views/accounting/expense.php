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
                        	<button type="button" class="btn btn-success btn-icon btn-xs" data-toggle="modal" data-target="#modalview<?= $exp['expense_id']; ?>"><i class="fas fa-eye"></i></button>
							<?php if(in_array('edit-expense', $arr)){?>
								<a href="<?= site_url().'expense/edit/'.str_ireplace(['/','+'],['~','$'],$encrypter->encrypt($exp['expense_id'])); ?>" class="btn btn-primary btn-icon btn-xs"><i class="fas fa-edit"></i></a>
							<?php }?>
						</div>

						<!-- MODAL VIEW -->
						<div class="modal fade" id="modalview<?= $exp['expense_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
										<tbody>
											<tr>
												<td style="width: 20%">ID</td>
												<td style="width: 30%"><?= $exp['expense_id']; ?></td>
												<td style="width: 20%">Status</td>
												<td style="width: 30%">
													<?php if($exp['status'] == 'pending'){ ?>
													<span class="badge badge-primary">Pending</span>
													<?php } else if($exp['status'] == 'verified'){ ?>
													<span class="badge badge-success">Verified</span>
													<?php } else if($exp['status'] == 'cancelled'){ ?>
													<span class="badge badge-danger">Cancelled</span>
													<?php } ?>
												</td>
											</tr>
											<tr>
												<td>Name</td>
												<td><?= $exp['name']; ?></td>
												<td>Date</td>
												<td><?= $exp['date']; ?></td>
											</tr>
											<tr>
												<td>Remarks</td>
												<td colspan="3"><?= $exp['remarks']; ?></td>
											</tr>
											<tr>
												<td>Added By</td>
												<td><?= $exp['nameuser']; ?></td>

												<td>Added On</td>
												<td><?= $exp['added_on']; ?></td>
											</tr>

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
										<tbody>
											<?php
												$subtotal = 0;
												foreach($accounting_model->getSummaryExpense($exp['expense_id']) as $summ){
												$subtotal += $summ['amount'];
											?>
											<tr>
												<td><?= $summ['category']; ?></td>
												<td><?= $summ['description']; ?></td>
												<td class="text-right"><?= number_format($summ['amount'], 2); ?></td>
											</tr>
											<?php }?>
										</tbody>
										<tfoot>
											<tr>
												<td colspan="2" class="text-right">Total</td>
												<td class="text-right"><?php echo number_format($subtotal, 2); ?></td>
											</tr>
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
										<tbody>
											<?php
												$subtotalpayment = 0;
												foreach($accounting_model->paymentHistory($exp['expense_id']) as $ph){
												$subtotalpayment += $ph['amount'];
											?>
											<tr>
												<td><?= ucfirst(str_replace("-", " ", $ph['method'])); ?></td>
												<td>
													<table class="wd-100p">
														<tbody>
															<tr>
																<td class="wd-35p">Date</td>
																<td class="wd-65p"><?= $ph['date']; ?></td>
															</tr>
															<?php if($ph['method'] == 'check'){ ?>
															<tr>
																<td>Account</td>
																<td class="wd-50p"><?= $ph['bank_account']; ?></td>
															</tr>
															<tr>
																<td>Payee</td>
																<td><?= $ph['check_payee']; ?></td>
															</tr>
															<tr>
																<td>Check Number</td>
																<td><?= $ph['check_number']; ?></td>
															</tr>
															<?php } ?>
														</tbody>
													</table>
												</td>
												<td class="text-center">
													<?php if($ph['status'] == 'pending'){ ?>
													<span class="badge badge-primary">Pending</span>
													<?php } else if($ph['status'] == 'verified'){ ?>
													<span class="badge badge-success">Verified</span>
													<?php } else if($ph['status'] == 'cancelled'){ ?>
													<span class="badge badge-danger">Cancelled</span>
													<?php } ?>
												</td>
												<td class="text-right"><?= number_format($ph['amount'], 2); ?></td>
												<td>
													<?php if($ph['status'] == 'pending'){ ?>
													<div class="no-wrap">
														<?php if($ph['method'] == 'check'){ ?>
														<a href="" class="btn btn-icon btn-primary btn-xs" target="_blank"><i class="fas fa-print"></i></a>
														<?php } ?>
													<?php } ?>
													</div>
												</td>
											</tr>
											<?php
												}
											?>
										</tbody>
										<tfoot>
											<tr>
												<td colspan="3" class="text-right">Total</td>
												<td class="text-right"><?= number_format($subtotalpayment, 2); ?></td>
												<td></td>
											</tr>
										</tfoot>
									</table>
																						
									
								</div>
								<div class="modal-footer">

									<?= form_open("expense/markpending/".str_ireplace(['/','+'],['~','$'],$encrypter->encrypt($exp['expense_id'])))?>
										<button type="submit" class="btn btn-primary">Mark Pending</button>
									<?= form_close()?>
									<?= form_open("expense/markverified/".str_ireplace(['/','+'],['~','$'],$encrypter->encrypt($exp['expense_id'])))?>
										<button type="submit" class="btn btn-success">Mark Verified</button>
									<?= form_close()?>
									<?= form_open("expense/markcancelled/".str_ireplace(['/','+'],['~','$'],$encrypter->encrypt($exp['expense_id'])))?>
										<button type="submit" class="btn btn-danger">Mark Cancelled</button>
									<?= form_close()?>
									<a href="<?= site_url();?>expense/printvoucher/<?= str_ireplace(['/','+'],['~','$'],$encrypter->encrypt($exp['expense_id']))?>" target="_blank" class="btn btn-primary">Print Voucher</a>

									<button type="button" class="btn btn-secondary" data-dismiss="modal">Ok</button>
								</div>
								</div>
							</div>
						</div>
						<!-- END OF MODAL VIEW -->



					</div>
				</td>
			</tr>
			<?php }?>
		</tbody>
	</table>

</div>