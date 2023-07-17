<div class="container">

    <?php
        // Message thrown from the controller
        if(!empty($_SESSION['warehouse_register'])){
            echo '<div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Warehouse Registration Success!</h4>
            <p>Warehouse has been successfully registered</p>
        </div>';
            unset($_SESSION['warehouse_register']);
        }

    ?>

    <h1>Add Warehouse</h1>

    
    <?= form_open('warehouse/register');?>

        <div class="row">

            <div class="col-lg-12">
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">Name</label>
                    <div class="col-md-10">
                        <input class="form-control" type="text" name="name" value="" required>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">Address</label>
                    <div class="col-md-10">
                        <input class="form-control" type="text" name="address" value="">
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">Contact Number</label>
                    <div class="col-md-10">
                        <input class="form-control" type="text" name="contact-number" value="">
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">Email Address</label>
                    <div class="col-md-10">
                        <input class="form-control" type="email" name="email-address" value="">
                    </div>
                </div>
            </div>

        </div>

        <button class="btn btn-primary btn-sm mg-r-10" name="submit" type="submit">Register</button>

    <?= form_close();?>

</div>