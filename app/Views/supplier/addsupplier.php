<div class="container">

    <?php
        // Message thrown from the controller
        if(!empty($_SESSION['add_supplier'])){
            echo '<div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Supplier Registration Success!</h4>
            <p>Supplier has been successfully registered</p>
        </div>';
            unset($_SESSION['add_supplier']);
        }

    ?>

    <h1>Add Supplier</h1>


    <?= form_open('supplier/save');?>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group row">
                    <label class="col-md-4 col-form-label">Name</label>
                    <div class="col-md-8">
                        <input class="form-control" type="text" name="name"  required>
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
                        <input class="form-control" type="text" name="contact-number" required>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form-group row">
                    <label class="col-md-4 col-form-label">Contact Person</label>
                    <div class="col-md-8">
                        <input class="form-control" type="text" name="contact-person" >
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form-group row">
                    <label class="col-md-4 col-form-label">Position</label>
                    <div class="col-md-8">
                        <input class="form-control" type="text" name="position" >
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form-group row">
                    <label class="col-md-4 col-form-label">Remarks</label>
                    <div class="col-md-8">
                        <input class="form-control" type="text" name="remarks" >
                    </div>
                </div>
            </div>


            <button class="btn btn-success" type="submit">Register Supplier</button>
        </div>
    <?= form_close();?>

</div>