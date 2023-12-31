<?php
    $encrypter = \Config\Services::encrypter();
?>
<div class="container">

    <?php
        // Message thrown from the controller
        if(!empty($_SESSION['employee_added'])){
            echo '<div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Employee Registration Success!</h4>
            <p>Employee has been successfully registered</p>
        </div>';
            unset($_SESSION['employee_added']);
        }
        
    ?>

    <h1>Add Employee</h1>

    <?= form_open("employee/save");?>

        <div class="row">
            <h5 class="col-lg-12 mg-b-30">Personal Information</h5>

            <div class="form-group col-lg-6">
                <label class="d-block">First Name</label>
                <input type="text" class="form-control" name="first-name" value="" required autofocus>
            </div>

            <div class="form-group col-lg-2">
                <label class="d-block">Middle Name</label>
                <input type="text" class="form-control" name="middle-name" value="">
            </div>

            <div class="form-group col-lg-4">
                <label class="d-block">Last Name</label>
                <input type="text" class="form-control" name="last-name" value="" required>
            </div>

            <div class="form-group col-lg-8">
                <label class="d-block">Address</label>
                <input type="text" class="form-control" name="address" value="">
            </div>

            <div class="form-group col-lg-4">
                <label class="d-block">Email</label>
                <input type="email" class="form-control" name="email" value="" required>
            </div>

            <div class="form-group col-lg-2">
                <label class="d-block">Contact Number</label>
                <input type="text" class="form-control" name="contact-number" value="">
            </div>

            <div class="form-group col-lg-2">
                <label class="d-block">Gender</label>
                <div class="col-form-label">
                    <div class="custom-control custom-radio mg-r-10 d-inline-block">
                        <input type="radio" class="custom-control-input" id="gender-male" name="gender" value="male" checked>
                        <label class="custom-control-label" for="gender-male">Male</label>
                    </div>

                    <div class="custom-control custom-radio d-inline-block">
                        <input type="radio" class="custom-control-input" id="gender-female" name="gender" value="female">
                        <label class="custom-control-label" for="gender-female">Female</label>
                    </div>
                </div>
            </div>

            <div class="form-group col-lg-2">
                <label class="d-block">Birthday</label>
                <input type="date" class="form-control" name="birthday" value="" required>
            </div>

            <div class="form-group col-lg-3">
                <label class="d-block">Username</label>
                <div>
                    <input class="form-control" type="text" name="username" value="" id="username" onkeydown="btnhiding()" required>
                    <div id="msg"></div>
                </div>
            </div>

            <div class="form-group col-lg-3">
                <label class="d-block">Password</label>
                <input type="password" name="password" class="form-control" value="" required>
            </div>

            <h5 class="col-lg-12 mg-t-30 mg-b-30">Employment Records</h5>

            <div class="form-group col-lg-3">
                <label class="d-block">ID Number</label>
                <label class="d-block">-</label>
            </div>

            <div class="form-group col-lg-3">
                <label class="d-block">Position</label>
                <input type="text" class="form-control" name="position" value="">
            </div>

            <div class="form-group col-lg-3">
                <label class="d-block">Date Hired</label>
                <input type="date" class="form-control" name="date-hired" value="">
            </div>

            <div class="form-group col-lg-3">
                <label class="d-block">Salary</label>
                <input type="number" class="form-control" name="salary" value="" required>
            </div>

            <div class="form-group col-lg-3">
                <label class="d-block">Salary Type</label>
                <div class="col-form-label">
                    <div class="custom-control custom-radio mg-r-10 d-inline-block">
                        <input type="radio" class="custom-control-input" id="salary-type-day" name="salary-type" value="daily" checked>
                        <label class="custom-control-label" for="salary-type-day">Day</label>
                    </div>

                    <div class="custom-control custom-radio d-inline-block">
                        <input type="radio" class="custom-control-input" id="salary-type-month" name="salary-type" value="month">
                        <label class="custom-control-label" for="salary-type-month">Month</label>
                    </div>
                </div>
            </div>

            <div class="form-group col-lg-3">
                <label class="d-block">Assigned Warehouse</label>
                <select name="assigned-warehouse" class="custom-select" required>
                    <option value="" selected>Select Warehouse</option>
                    <?php foreach($warehouse as $whf){?>
                        <option value="<?= $encrypter->encrypt($whf['warehouse_id'])?>"><?= $whf['name'];?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group col-lg-3">
                <label class="d-block">Assigned Agency</label>
                <select name="assigned-agency" class="custom-select" required>
                    <option value="" selected>Select Agency</option>
                    <?php foreach($agency as $a){?>
                        <option value="<?= $encrypter->encrypt($a['agency_id'])?>"><?= $a['name'];?></option>
                    <?php }?>
                </select>
            </div>

            <div class="form-group col-lg-3">
                <label class="d-block">Account Type</label>
                <select name="account-type" class="custom-select" required>
                    <option value="" selected>Select Account Type</option>
                    <!-- grp data from the user_controller -->
                    <?php foreach($grp as $g){ ?>
                        <option value="<?= $encrypter->encrypt($g['user_group_id']);?>"><?= $g['name'];?></option>
                    <?php }?>
                </select>
            </div>

            <h5 class="col-lg-12 mg-t-30 mg-b-30">Government Records</h5>

            <div class="form-group col-lg-4">
                <label class="d-block">SSS Number</label>
                <input type="text" class="form-control" name="sss-number" value="">
            </div>

            <div class="form-group col-lg-4">
                <label class="d-block">Philhealth Number</label>
                <input type="text" class="form-control" name="philhealth-number" value="">
            </div>

            <div class="form-group col-lg-4">
                <label class="d-block">Pag-ibig Number</label>
                <input type="text" class="form-control" name="pagibig-number" value="">
            </div>

            <div class="form-group col-lg-4">
                <label class="d-block">Barangay Clearance</label>
                <input type="text" class="form-control" data-type="datepicker" name="barangay-clearance" value="">
            </div>

            <div class="form-group col-lg-4">
                <label class="d-block">NBI Clearance</label>
                <input type="text" class="form-control" data-type="datepicker" name="nbi-clearance" value="">
            </div>

            <div class="form-group col-lg-4">
                <label class="d-block">Police Clearance</label>
                <input type="text" class="form-control" data-type="datepicker" name="nbi-clearance" value="">
            </div>

            <h5 class="col-lg-12 mg-t-30 mg-b-30">Emergency Contact Person</h5>

            <div class="form-group col-lg-4">
                <label class="d-block">Name</label>
                <input type="text" class="form-control" name="emergency-contact-person" value="">
            </div>

            <div class="form-group col-lg-4">
                <label class="d-block">Contact Number</label>
                <input type="text" class="form-control" name="emergency-contact-number" value="">
            </div>

            <div class="form-group col-lg-4">
                <label class="d-block">Relation</label>
                <select name="emergency-contact-relation" class="form-control form-control-sm" required>
                    <option value="Father">Father</option>
                    <option value="Mother">Mother</option>
                    <option value="Brother">Brother</option>
                    <option value="Sister">Sister</option>
                    <option value="Husband">Husband</option>
                    <option value="Wife">Wife</option>
                    <option value="Uncle">Uncle</option>
                    <option value="Auntie">Auntie</option>
                    <option value="Grandfather">Grandfather</option>
                    <option value="Grandmother">Grandmother</option>
                    <option value="Stepfather">Stepfather</option>
                    <option value="Stepmother">Stepmother</option>
                </select>
            </div>

        </div>

        <div class="mg-t-20">
            <button class="btn btn-primary mg-r-15" name="submit" type="submit">Register Employee</button>
        </div>
        
    <?= form_close();?>

</div>


<script>
    // ajax function for uservalidation
    $(document).ready(function() {
        $("#username").on("input", function(e) {
            $('#msg').hide();
            if ($('#username').val() == null || $('#username').val() == "") {
                $('#msg').show();
                $("#msg").html("Username is a required field.").css("color", "red");
            }else {
                $.ajax({
                    type: 'post',
                    url: "<?= site_url('validateusername');//site_url('user/check_username_availability') ?>",
                    data: JSON.stringify({username: $('#username').val()}),
                    contentType: 'application/json; charset=utf-8',
                    dataType: 'html',
                    cache: false,
                    beforeSend: function (f) {
                        $('#msg').show();
                        $('#msg').html('Checking...');
                    },
                    success: function(msg) {
                        $('#msg').show();
                        $("#msg").html(msg);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        $('#msg').show();
                        $("#msg").html(textStatus + " " + errorThrown);
                    }
                });
            }
        });
    });
</script>