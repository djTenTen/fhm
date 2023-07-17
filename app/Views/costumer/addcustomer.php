<div class="container">

    <?php
        // Message thrown from the controller
        if(!empty($_SESSION['customer_added'])){
            echo '<div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Customer Registration Success!</h4>
        	<p>Costumer has been successfully registered</p>
        </div>';
            unset($_SESSION['customer_added']);
        }

    ?>

    <h1>Add Costumer</h1>

    <?= form_open('costumer/register');?>
    <div class="row">
		<div class="col-lg-6">
			<div class="form-group row">
				<label class="col-md-4 col-form-label">Name</label>
				<div class="col-md-8">
					<input class="form-control" type="text" name="name" required>
				</div>
			</div>
		</div>

		<div class="col-lg-6">
			<div class="form-group row">
				<label class="col-md-4 col-form-label">Address</label>
				<div class="col-md-8">
					<input class="form-control" type="text" name="address" required>
				</div>
			</div>
		</div>

		<div class="col-lg-6">
			<div class="form-group row">
				<label class="col-md-4 col-form-label">Contact Number</label>
				<div class="col-md-8">
					<input class="form-control" type="text" name="contact-number" >
				</div>
			</div>
		</div>

		<div class="col-lg-6">
			<div class="form-group row">
				<label class="col-md-4 col-form-label">E-mail Address</label>
				<div class="col-md-8">
					<input class="form-control" type="email" name="email-address" >
				</div>
			</div>
		</div>

		<div class="col-lg-6">
			<div class="form-group row">
				<label class="col-md-4 col-form-label">Type</label>
				<div class="col-md-8 col-form-label">
					<div class="custom-control custom-radio d-inline-block mr-2">
						<input type="radio" name="type" class="custom-control-input" value="personal" id="customer-type-personal" data-panels="#customer-type" checked>
						<label class="custom-control-label" for="customer-type-personal">Personal</label>
					</div>

					<div class="custom-control custom-radio d-inline-block">
						<input type="radio" name="type" class="custom-control-input" value="corporate" id="customer-type-corporate" data-panels="#customer-type">
						<label class="custom-control-label" for="customer-type-corporate">Corporate</label>
					</div>
				</div>
			</div>
		</div>

		<div class="col-lg-6">
			<div class="form-group row">
				<label class="col-md-4 col-form-label">Remarks</label>
				<div class="col-md-8">
					<input class="form-control" type="text" name="remarks" value="<?php if(isset($_POST['remarks'])){ echo $_POST['remarks']; } ?>">
				</div>
			</div>
		</div>

	</div>

	<div id="customer-type" class="panels mt-3" data-panels-initialize="true" data-panels-target="input[name='type']">
		<div id="corporate">
			<h4 class="card-title-desc mb-3">Additional Information</h4>

			<div class="row">
				<div class="col-lg-6">
					<div class="form-group row">
						<label class="col-md-4 col-form-label">Username</label>
						<div class="col-md-8">
							<input class="form-control" type="text" name="username" value="<?php if(isset($_POST['username'])){ echo $_POST['username']; } ?>" disabled>
						</div>
					</div>
				</div>

				<div class="col-lg-6">
					<div class="form-group row">
						<label class="col-md-4 col-form-label">Password</label>
						<div class="col-md-8">
							<input class="form-control" type="text" name="password" value="<?php if(isset($_POST['password'])){ echo $_POST['password']; } ?>" disabled>
						</div>
					</div>
				</div>

				<div class="col-lg-6">
					<div class="form-group row">
						<label class="col-md-4 col-form-label">Discount</label>
						<div class="col-md-8">
							<input class="form-control" type="number" name="discount" value="<?php if(isset($_POST['discount'])){ echo $_POST['discount']; } ?>" disabled>
						</div>
					</div>
				</div>

				<div class="col-lg-6">
					<div class="form-group row">
						<label class="col-md-4 col-form-label">Website</label>
						<div class="col-md-8">
							<input class="form-control" type="text" name="website" value="<?php if(isset($_POST['website'])){ echo $_POST['website']; } ?>" disabled>
						</div>
					</div>
				</div>

				<div class="col-lg-6">
					<div class="form-group row">
						<label class="col-md-4 col-form-label">Facebook</label>
						<div class="col-md-8">
							<input class="form-control" type="text" name="facebook" value="<?php if(isset($_POST['facebook'])){ echo $_POST['facebook']; } ?>" disabled>
						</div>
					</div>
				</div>

				<div class="col-lg-6">
					<div class="form-group row">
						<label class="col-md-4 col-form-label">Instagram</label>
						<div class="col-md-8">
							<input class="form-control" type="text" name="instagram" value="<?php if(isset($_POST['instagram'])){ echo $_POST['instagram']; } ?>" disabled>
						</div>
					</div>
				</div>

				<div class="col-lg-6">
					<div class="form-group row">
						<label class="col-md-4 col-form-label">Lazada</label>
						<div class="col-md-8">
							<input class="form-control" type="text" name="lazada" value="<?php if(isset($_POST['lazada'])){ echo $_POST['lazada']; } ?>" disabled>
						</div>
					</div>
				</div>

				<div class="col-lg-6">
					<div class="form-group row">
						<label class="col-md-4 col-form-label">Shopee</label>
						<div class="col-md-8">
							<input class="form-control" type="text" name="shopee" value="<?php if(isset($_POST['shopee'])){ echo $_POST['shopee']; } ?>" disabled>
						</div>
					</div>
				</div>

				<div class="col-lg-6">
					<div class="form-group row">
						<label class="col-md-4 col-form-label">Authorized Representative</label>
						<div class="col-md-8">
							<input class="form-control" type="text" name="corporate-contact-person" value="<?php if(isset($_POST['corporate-contact-person'])){ echo $_POST['corporate-contact-person']; } ?>" disabled>
						</div>
					</div>
				</div>

				<div class="col-lg-6">
					<div class="form-group row">
						<label class="col-md-4 col-form-label">Contact Number</label>
						<div class="col-md-8">
							<input class="form-control" type="text" name="corporate-contact-number" value="<?php if(isset($_POST['corporate-contact-number'])){ echo $_POST['corporate-contact-number']; } ?>" disabled>
						</div>
					</div>
				</div>

				<div class="col-lg-6">
					<div class="form-group row">
						<label class="col-md-4 col-form-label">Email Address</label>
						<div class="col-md-8">
							<input class="form-control" type="text" name="corporate-email-address" value="<?php if(isset($_POST['corporate-email-address'])){ echo $_POST['corporate-email-address']; } ?>" disabled>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>

	<button class="btn btn-primary btn-sm mg-r-10" name="submit" type="submit">Submit</button>  
    <?= form_close();?>
</div>