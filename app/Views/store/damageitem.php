<?php
    $encrypter = \Config\Services::encrypter();
?>
<div class="container">

	<?php	
        // Message thrown from the controller
        if(!empty($_SESSION['damageitem_updated'])){
            echo '<div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Update Success!</h4>
			<p>Damage Item has been successfully updated</p>
        </div>';
            unset($_SESSION['damageitem_updated']);
        }

		if(!empty($_SESSION['damageitem_pending'])){
            echo '<div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Update Success!</h4>
            <p>Damage Item has been successfully set to Pending</p>
        </div>';
            unset($_SESSION['damageitem_pending']);
        }

		if(!empty($_SESSION['damageitem_replaced'])){
            echo '<div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Update Success!</h4>
            <p>Damage Item has been successfully set to Replaced</p>
        </div>';
            unset($_SESSION['damageitem_replaced']);
        }

		if(!empty($_SESSION['damageitem_sold'])){
            echo '<div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Update Success!</h4>
            <p>Damage Item has been successfully set to Sold</p>
        </div>';
            unset($_SESSION['damageitem_sold']);
        }
    ?>

    <h1><?= $state;?> Damage Items</h1>

    <table class="table table-md table-bordered">
		<thead>
			<tr>
				<th style="width: 1%;">ID</th>
				<th style="width: 10%;">Reference No.</th>
				<th style="width: 15%;">Warehouse</th>
				<th style="width: 25%;">Item Name</th>
				<th style="width: 25%;">Description</th>
				<th style="width: 10%;">Price</th>
				<th style="width: 1%;">Status</th>
				<th style="width: 15%;">Added On</th>
				<th style="width: 1%;"></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($damage as $dmg){
                switch ($dmg['classification']) {
                    case 'a': $price = $dmg['retail_price'] * 0.9; break;
                    case 'b': $price = $dmg['retail_price'] * 0.8; break;
                    case 'c': $price = $dmg['retail_price'] * 0.7; break;
                    case 'd': $price = $dmg['retail_price'] * 0.6; break;
                    case 'e': $price = $dmg['retail_price'] * 0.5; break;
                }    
            ?>

			<tr>
				<td class="align-middle"><?= $dmg['damage_item_id']; ?></td>
				<td class="align-middle"><?= $dmg['reference_number']; ?></td>
				<td class="align-middle"><?= $dmg['warehouse']; ?></td>
				<td class="align-middle"><?= $dmg['item']; ?></td>
				<td class="align-middle"><?= $dmg['description']; ?></td>
				<td class="align-middle"><?= $price; ?></td>
				<td class="align-middle"><span class="badge badge-<?php if($dmg['status'] == 'pending'){echo 'danger';}elseif($dmg['status'] == 'sold'){echo 'success';}elseif($dmg['status'] == 'replaced'){echo 'warning';}?>"><?= $dmg['status'];?></span></td>
				<td class="align-middle"><?= $dmg['added_on']; ?></td>
				<td class="align-middle">
                    <div class="btn-group">
                        <a href="<?= site_url();?>damageitem/edit/<?= str_ireplace(['/','+'],['~','$'],$encrypter->encrypt($dmg['damage_item_id']));?>" class="btn btn-icon btn-primary btn-xs"><i class="fas fa-edit"></i></a>
                        <button type="button" class="btn btn-icon btn-success btn-xs" data-toggle="modal" data-target="#modalview<?= $dmg['damage_item_id']; ?>"><i class="fas fa-eye"></i></button>
					</div>


					<!-- MODAL VIEW -->
                    <div class="modal fade" id="modalview<?= $dmg['damage_item_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Damage Item <?= $dmg['item']; ?></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

								<table class="table table-bordered mb-4">
									<tbody>
										<tr>
											<td style="width: 20%">ID</td>
											<td style="width: 30%"><?= $dmg['damage_item_id']; ?></td>

											<td style="width: 20%">Status</td>
											<td style="width: 30%"><span class="badge badge-<?php if($dmg['status'] == 'pending'){echo 'danger';}elseif($dmg['status'] == 'sold'){echo 'success';}elseif($dmg['status'] == 'replaced'){echo 'warning';}?>"><?= $dmg['status'];?></span></td>
										</tr>
										<tr>
											<td>Reference Number</td>
											<td colspan="3"><?= $dmg['reference_number']; ?></td>
										</tr>
										<tr>
											<td>Item Name</td>
											<td colspan="3"><?= $dmg['item']; ?></td>
										</tr>
										<tr>
											<td>Description</td>
											<td colspan="3"><?= $dmg['description']; ?></td>
										</tr>
										<tr>
											<td>Classification</td>
											<td colspan="3"><?= strtoupper($dmg['classification']); ?></td>
										</tr>
										<tr>
											<td>Price</td>
											<td colspan="3"><span class="line-through mg-r-10"><?= number_format($dmg['retail_price'], 2); ?></span><?= number_format($price, 2) ?></td>
										</tr>
										<tr>
											<td>Gallery</td>
											<td colspan="3" class="vertical-align: top;">
												
											</td>
										</tr>
										<tr>
											<td>Added By</td>
											<td><?= $dmg['added_by']; ?></td>

											<td>Added On</td>
											<td><?= $dmg['added_on']; ?></td>
										</tr>
										
									</tbody>
								</table>
                                
                            </div>
                            <div class="modal-footer">
                                <?= form_open("damageitem/markpending/".str_ireplace(['/','+'],['~','$'],$encrypter->encrypt($dmg['damage_item_id'])))?>
                                    <button type="submit" class="btn btn-danger">Mark Pending</button>
                                <?= form_close()?>
                                <?= form_open("damageitem/markreplaced/".str_ireplace(['/','+'],['~','$'],$encrypter->encrypt($dmg['damage_item_id'])))?>
                                    <button type="submit" class="btn btn-warning">Mark Replaced</button>
                                <?= form_close()?>
                                <?= form_open("damageitem/marksold/".str_ireplace(['/','+'],['~','$'],$encrypter->encrypt($dmg['damage_item_id'])))?>
                                    <button type="submit" class="btn btn-success">Mark Sold</button>
                                <?= form_close()?>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Ok</button>
                            </div>
                            </div>
                        </div>
                    </div>
                    <!-- END OF MODAL VIEW -->

				</td>
			</tr>
			<?php }?>
		</tbody>
	</table>

</div>