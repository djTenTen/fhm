<?php 
    $encrypter = \Config\Services::encrypter();
?>
<div class="container">

	<?php
        // Message thrown from the controller
        if(!empty($_SESSION['displayitem_added'])){
            echo '<div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Display Item Registration Success!</h4>
        	<p>Display Item has been successfully added</p>
        </div>';
            unset($_SESSION['displayitem_added']);
        }
        
    ?>

    <h1>Add Display Item</h1>

    <?= form_open("displayitem/save");?>
		<div class="row col-6">
			<div class="col-lg-12">
				<div class="form-group row">
					<label class="col-md-2 col-form-label">Item Name</label>
					<div class="col-md-10">
						<select name="item" class="form-control select2" required>
                            <option value="" selected>Select Item</option>
							<?php foreach($items as $it){?>
                                <option value="<?= $encrypter->encrypt($it['item_id']);?>"><?= $it['name'];?></option>
                            <?php }?>
						</select>
					</div>
				</div>
			</div>

			<div class="col-lg-12">
				<div class="form-group row">
					<label class="col-form-label col-md-2">Warehouse</label>
					<div class="col-md-10">
						<select name="warehouse" class="custom-select" required>
                            <option value="" selected>Select Warehouse</option>
							<?php foreach($warehouse as $wh){?>
                                <option value="<?= $encrypter->encrypt($wh['warehouse_id']);?>"><?= $wh['name'];?></option>
                            <?php }?>
						</select>
					</div>
				</div>
			</div>

		</div>

		<button class="btn btn-primary btn-sm mg-r-10" name="submit" type="submit">Register Display Item</button>

	<?= form_close();?>
</div>