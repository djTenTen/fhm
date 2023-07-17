<?php 
    $encrypter = \Config\Services::encrypter();
?>
<div class="container">

	<?php	
        // Message thrown from the controller
        if(!empty($_SESSION['damageitem_added'])){
            echo '<div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Damage Item Registration Success!</h4>
			<p>Damage Item has been successfully added</p>
        </div>';
            unset($_SESSION['damageitem_added']);
        }
    ?>

    <h1>Add Damage item</h1>

    <?= form_open_multipart("damageitem/save");?>
    <form method="post" enctype="multipart/form-data">
		<div class="row">
			<div class="col-lg-6">
				<div class="form-group row">
					<label class="col-md-4 col-form-label">Item Name</label>
					<div class="col-md-8">
						<select name="item" class="form-control select2" required>
							<option value="" selected>Select Item</option>
							<?php foreach($items as $it){?>
                                <option value="<?= $encrypter->encrypt($it['item_id']);?>"><?= $it['name'];?></option>
                            <?php }?>
						</select>
					</div>
				</div>
			</div>

			<div class="col-lg-6">
				<div class="form-group row">
					<label class="col-form-label col-md-4">Warehouse</label>
					<div class="col-md-8">
						<select name="warehouse" class="custom-select" required>
							<option value="" selected>Select Warehouse</option>
							<?php foreach($warehouse as $wh){?>
                                <option value="<?= $encrypter->encrypt($wh['warehouse_id']);?>"><?= $wh['name'];?></option>
                            <?php }?>
						</select>
					</div>
				</div>
			</div>

			<div class="col-lg-6">
				<div class="form-group row">
					<label class="col-md-4 col-form-label">Description</label>
					<div class="col-md-8">
						<input type="text" class="form-control" name="description">
					</div>
				</div>
			</div>

			<div class="col-lg-6">
				<div class="form-group row">
					<label class="col-md-4 col-form-label">Gallery</label>
					<div class="col-md-8">
						<div class="custom-file">
							<input type="file" class="custom-file-input" name="gallery[]" multiple>
							<label class="custom-file-label">Choose file</label>
						</div>
					</div>
				</div>
			</div>

			<div class="col-lg-6">
				<div class="form-group row">
					<label class="col-md-4 col-form-label">Classification</label>
					<div class="col-md-8">
						<div class="col-form-label">
							<div class="custom-control custom-radio d-inline-block mg-r-15">
								<input type="radio" id="classification-a" name="classification" value="a" class="custom-control-input" checked>
								<label class="custom-control-label" for="classification-a">A</label>
							</div>

							<div class="custom-control custom-radio d-inline-block mg-r-15">
								<input type="radio" id="classification-b" name="classification" value="b" class="custom-control-input">
								<label class="custom-control-label" for="classification-b">B</label>
							</div>

							<div class="custom-control custom-radio d-inline-block mg-r-15">
								<input type="radio" id="classification-c" name="classification" value="c" class="custom-control-input">
								<label class="custom-control-label" for="classification-c">C</label>
							</div>

							<div class="custom-control custom-radio d-inline-block mg-r-15">
								<input type="radio" id="classification-d" name="classification" value="d" class="custom-control-input">
								<label class="custom-control-label" for="classification-d">D</label>
							</div>

							<div class="custom-control custom-radio d-inline-block">
								<input type="radio" id="classification-e" name="classification" value="e" class="custom-control-input">
								<label class="custom-control-label" for="classification-e">E</label>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>			

		<button class="btn btn-primary btn-sm mg-r-10" name="submit" type="submit">Register Damage Item</button>

	</form>

</div>
