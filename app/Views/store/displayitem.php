<?php
    $encrypter = \Config\Services::encrypter();
?>
<div class="container">

    <?php
        // Message thrown from the controller
        if(!empty($_SESSION['displayitem_displayed'])){
            echo '<div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Display Item Displayed Success!</h4>
            <p>Display Item has been successfully set to Display</p>
        </div>';
            unset($_SESSION['displayitem_displayed']);
        }

        if(!empty($_SESSION['displayitem_sold'])){
            echo '<div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Display Item Sold Success!</h4>
            <p>Display Item has been successfully set to sold</p>
        </div>';
            unset($_SESSION['displayitem_sold']);
        }
        
    ?>  

    <h1>Display Items</h1>

    <table class="table table-md table-bordered">
		<thead>
			<tr>
				<th style="width: 1%;">ID</th>
				<th style="width: 10%;">Reference No.</th>
				<th style="width: 15%;">Warehouse</th>
				<th style="width: 40%;">Item Name</th>
				<th style="width: 1%;">Status</th>
				<th style="width: 15%;">Added By</th>
				<th style="width: 20%;">Added On</th>
				<th style="width: 1%;"></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($display as $disp){?>
			<tr>
				<td><?= $disp['display_item_id']; ?></td>
				<td><?= $disp['reference_number']; ?></td>
				<td><?= $disp['warehouse']; ?></td>
				<td><?= $disp['item']; ?></td>
				<td><span class="badge badge-<?php if($disp['status'] == 'displayed'){echo 'primary';}else{echo 'success';}?>"><?= $disp['status'];?></span></td>
				<td><?= $disp['added_by']; ?></td>
				<td><?= $disp['added_on']; ?></td>
				<td>
                    <div class="btn-group">
                        <button type="button" class="btn btn-icon btn-success btn-xs" data-toggle="modal" data-target="#modalview<?= $disp['display_item_id']; ?>"><i class="fas fa-eye"></i></button>
					</div>

					<!-- MODAL VIEW -->
                    <div class="modal fade" id="modalview<?= $disp['display_item_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Display Item <?= $disp['item']; ?></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <table class="table table-bordered mb-4">
                                    <tbody>
                                        <tr>
                                            <td style="width: 20%">ID</td>
                                            <td style="width: 30%"><?= $disp['display_item_id']; ?></td>

                                            <td style="width: 20%">Status</td>
                                            <td style="width: 30%"><span class="badge badge-<?php if($disp['status'] == 'displayed'){echo 'primary';}else{echo 'success';}?>"><?= $disp['status'];?></span></td>
                                        </tr>
                                        <tr>
                                            <td>Reference Number</td>
                                            <td colspan="3"><?= $disp['reference_number']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Item Name</td>
                                            <td colspan="3"><?= $disp['item']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Warehouse</td>
                                            <td colspan="3"><?= $disp['warehouse']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Price</td>
                                            <td colspan="3"><?= number_format($disp['retail_price'], 2); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Added By</td>
                                            <td><?= $disp['added_by']; ?></td>

                                            <td>Added On</td>
                                            <td><?= $disp['added_on']; ?></td>
                                        </tr>
                                        
                                    </tbody>
                                </table>
                                
                            </div>
                            <div class="modal-footer">
                                <?= form_open("displayitem/markdisplayed/".str_ireplace(['/','+'],['~','$'],$encrypter->encrypt($disp['display_item_id'])))?>
                                    <button type="submit" class="btn btn-primary">Mark Displayed</button>
                                <?= form_close()?>
                                <?= form_open("displayitem/marksold/".str_ireplace(['/','+'],['~','$'],$encrypter->encrypt($disp['display_item_id'])))?>
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
			<?php   
				}
			?>
		</tbody>
	</table>

</div>