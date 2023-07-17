<?php
    $encrypter = \Config\Services::encrypter();
    $inventory_model = new \App\Models\Inventory_model; // to access the inventory_model
    $whn = $inventory_model->getwarehousename($damage['warehouse_id']);
?>
<div class="container">

    <h1>Edit Damage Item</h1>

    <?= form_open_multipart("damageitem/update/".$diid);?>
		<div class="row">
			<div class="col-lg-6">
				<div class="form-group row">
					<label class="col-md-4 col-form-label">Item Name</label>
					<div class="col-md-8">
						<select name="item" class="form-control select2" disabled>
                            <option value="<?= $encrypter->encrypt($damage['item_id']);?>" selected><?= $damage['item'];?></option>
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
							<option value="<?= $encrypter->encrypt($damage['warehouse_id']);?>" selected><?= $whn['name'];?></option>
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
						<input type="text" class="form-control" name="description" value="<?= $damage['description'];?>">
					</div>
				</div>
			</div>

			<!-- <div class="col-lg-6">
				<div class="form-group row">
					<label class="col-md-4 col-form-label">Gallery</label>
					<div class="col-md-8">
						<div class="custom-file">
							<input type="file" class="custom-file-input" name="gallery[]" multiple>
							<label class="custom-file-label">Choose file</label>
						</div>
					</div>
				</div>
			</div> -->

			<div class="col-lg-6">
				<div class="form-group row">
					<label class="col-md-4 col-form-label">Classification</label>
					<div class="col-md-8">
						<div class="col-form-label">
							<div class="custom-control custom-radio d-inline-block mg-r-15">
								<input type="radio" id="classification-a" name="classification" value="a" class="custom-control-input" <?php if($damage['classification'] == 'a'){echo 'checked';}?>>
								<label class="custom-control-label" for="classification-a">A</label>
							</div>

							<div class="custom-control custom-radio d-inline-block mg-r-15">
								<input type="radio" id="classification-b" name="classification" value="b" class="custom-control-input" <?php if($damage['classification'] == 'b'){echo 'checked';}?>>
								<label class="custom-control-label" for="classification-b">B</label>
							</div>

							<div class="custom-control custom-radio d-inline-block mg-r-15">
								<input type="radio" id="classification-c" name="classification" value="c" class="custom-control-input" <?php if($damage['classification'] == 'c'){echo 'checked';}?>>
								<label class="custom-control-label" for="classification-c">C</label>
							</div>

							<div class="custom-control custom-radio d-inline-block mg-r-15">
								<input type="radio" id="classification-d" name="classification" value="d" class="custom-control-input" <?php if($damage['classification'] == 'd'){echo 'checked';}?>>
								<label class="custom-control-label" for="classification-d">D</label>
							</div>

							<div class="custom-control custom-radio d-inline-block">
								<input type="radio" id="classification-e" name="classification" value="e" class="custom-control-input" <?php if($damage['classification'] == 'e'){echo 'checked';}?>>
								<label class="custom-control-label" for="classification-e">E</label>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>

		<button class="btn btn-primary btn-sm mg-r-10" name="submit" type="submit">Update Damage Item</button>
		
	<?= form_close();?>

</div>