<?php 
    $accounting_model = new \App\Models\Accounting_model;
?>
<div class="container">

    <h1><?= $area;?> Payments</h1>



    <table class="table table-md table-bordered">
		<thead>
			<tr>
				<th style="width: 1%;">ID</th>
				<th style="width: 10%;">Type</th>
				<th style="width: 20%;">Payee</th>
				<th style="width: 10%;">Total Due</th>
				<th style="width: 10%;">Total Paid</th>
				<th style="width: 10%;">Balance Due</th>
				<th style="width: 1%;">Status</th>
				<th style="width: 20%;">Added By</th>
				<th style="width: 20%;">Added On</th>
				<th style="width: 1%;"></th>
			</tr>
		</thead>
		<tbody>
			<?php 
                foreach($paymentsales as $ps){
                $due = $accounting_model->paymentdue($ps['payment_id'],$ps['type']);
            ?>
			<tr>
				<td class="align-middle"><?= $ps['payment_id']; ?></td>
				<td class="align-middle"><?php echo ucwords($ps['type']); ?></td>
				<td class="align-middle"><?= $ps['name']; ?></td>
				<td class="align-middle"><?php if($ps['type'] == 'sales'){ echo number_format($due, 2); } else { echo number_format($due * -1, 2); } ?></td>
				<td class="align-middle"><?php echo number_format($ps['paid'], 2); ?></td>
				<td class="align-middle">
                    <?php 
                        if($ps['type'] == 'sales'){ 
                            echo number_format(($due - $ps['paid']), 2); }
                        else{
                            echo number_format(($due - $ps['paid']) * -1, 2);
                        }
                    ?>
                </td>
				<td class="align-middle"><span class="badge badge-<?php if($ps['status'] == 'completed'){ echo 'success'; } else { echo 'primary'; } ?>"><?php echo ucwords(str_replace("-", " ", $ps['status'])); ?></span></td>
				<td class="align-middle"><?= $ps['added_by']?></td>
				<td class="align-middle"><?php echo date("F d, Y", strtotime($ps['added_on'])); ?></td>
				<td class="align-middle">
					<div class="no-wrap">
						<a href="" class="btn btn-icon btn-primary btn-xs"><i class="fas fa-search"></i></a>
					</div>
				</td>
			</tr>
			<?php }?>
		
		</tbody>
	</table>

</div>