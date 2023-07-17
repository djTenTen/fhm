<div class="container">

    <?php 
        if(!empty($_SESSION['myproflie_updated'])){
            echo '<div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Update Success!</h4>
            <p>Profile has been successfully updated</p>
        </div>';
            unset($_SESSION['myproflie_updated']);
        }
    ?>

    <h1>My Profile</h1>

    <?= form_open("employee/updatemyprofile");?>

        <div class="row">
            
            <h5 class="col-lg-12 mg-b-30">Personal Information</h5>

                <div class="form-group col-lg-6">
                    <label class="d-block">First Name</label>
                    <input value="<?= $pf['first_name'];?>" type="text" class="form-control" name="first-name" value="" required autofocus>
                </div>

                <div class="form-group col-lg-2">
                    <label class="d-block">Middle Name</label>
                    <input value="<?= $pf['middle_name'];?>" type="text" class="form-control" name="middle-name" value="" >
                </div>

                <div class="form-group col-lg-4">
                    <label class="d-block">Last Name</label>
                    <input value="<?= $pf['last_name'];?>" type="text" class="form-control" name="last-name" value="" required>
                </div>

                <div class="form-group col-lg-8">
                    <label class="d-block">Address</label>
                    <input value="<?= $pf['address'];?>" type="text" class="form-control" name="address" value="">
                </div>

                <div class="form-group col-lg-4">
                    <label class="d-block">Email</label>
                    <input value="<?= $pf['email'];?>" type="email" class="form-control" name="email" value="" required>
                </div>

                <div class="form-group col-lg-2">
                    <label class="d-block">Contact Number</label>
                    <input value="<?= $pf['contact_number'];?>" type="text" class="form-control" name="contact-number" value="">
                </div>

                <div class="form-group col-lg-2">
                    <label class="d-block">Gender</label>
                    <div class="col-form-label">
                        <div class="custom-control custom-radio mg-r-10 d-inline-block">
                            <input type="radio" class="custom-control-input" id="gender-male" name="gender" value="male" <?php if($pf['gender'] == 'male'){echo 'checked';}?>>
                            <label class="custom-control-label" for="gender-male">Male</label>
                        </div>

                        <div class="custom-control custom-radio d-inline-block">
                            <input type="radio" class="custom-control-input" id="gender-female" name="gender" value="female" <?php if($pf['gender'] == 'female'){echo 'checked';}?>>
                            <label class="custom-control-label" for="gender-female">Female</label>
                        </div>
                    </div>
                </div>

                <div class="form-group col-lg-2">
                    <label class="d-block">Birthday</label>
                    <input type="date" class="form-control" name="birthday" value="<?= $pf['birthday'];?>" required>
                </div>

                <div class="form-group col-lg-3">
                    <label class="d-block">Username</label>
                    <div>
                        <input class="form-control" type="text" name="username" value="<?= $pf['username'];?>" id="username" onkeydown="btnhiding()" readonly>
                        <div id="msg"></div>
                    </div>
                </div>

                <div class="form-group col-lg-3">
                    <label class="d-block">Password</label>
                    <input type="password" name="password" class="form-control" value="" >
                </div>

                <h5 class="col-lg-12 mg-t-30 mg-b-30">Employment Records</h5>

                <div class="form-group col-lg-3">
                    <label class="d-block"><strong>ID Number</strong></label>
                    <label class="d-block">-</label>
                </div>

                <div class="form-group col-lg-3">
                    <label class="d-block"><strong>Position</strong></label>
                    <label class="d-block"><?= $pf['position'];?></label>
                </div>

                <div class="form-group col-lg-3">
                    <label class="d-block"><strong>Leaves</strong></label>
                    <label class="d-block">0</label>
                </div>

                <div class="form-group col-lg-3">
                    <label class="d-block"><strong>Vacation Leaves</strong></label>
                    <label class="d-block">0</label>
                </div>

                <div class="form-group col-lg-3">
                    <label class="d-block"><strong>Absents</strong></label>
                    <label class="d-block">0</label>
                </div>

                <div class="form-group col-lg-3">
                    <label class="d-block"><strong>Salary</strong></label>
                    <label class="d-block"><?= $pf['salary'];?></label>
                </div>

                <div class="form-group col-lg-3">
                    <label class="d-block"><strong>Salary Type</strong></label>
                    <label class="d-block"><?= $pf['salary_type'];?></label>
                </div>

                <div class="form-group col-lg-3">
                    <label class="d-block"><strong>Status</strong></label>
                    <label class="d-block"><?= $pf['status'];?></label>
                </div>

                <div class="form-group col-lg-3">
                    <label class="d-block"><strong>Assigned Warehouse</strong></label>
                    <label class="d-block"><?= $pf['warehouse'];?></label>
                </div>

                <div class="form-group col-lg-3">
                    <label class="d-block"><strong>Assigned Agency</strong></label>
                    <label class="d-block"><?= $pf['agency'];?></label>
                </div>

                <div class="form-group col-lg-3">
                    <label class="d-block"><strong>Account Type</strong></label>
                    <label class="d-block"><?= $pf['groupname'];?></label>
                </div>

                <h5 class="col-lg-12 mg-t-30 mg-b-30">Government Records</h5>

                <div class="form-group col-lg-3">
                    <label class="d-block">SSS Number</label>
                    <label class="d-block"><?= $pf['sss_number'];?></label>
                </div>


                <div class="form-group col-lg-3">
                    <label class="d-block">Philhealth Number</label>
                    <label class="d-block"><?= $pf['philhealth_number'];?></label>
                </div>

                <div class="form-group col-lg-3">
                    <label class="d-block">Pag-ibig Number</label>
                    <label class="d-block"><?= $pf['pagibig_number'];?></label>
                </div>

                <div class="form-group col-lg-3">
                    <label class="d-block">Barangay Clearance</label>
                    <label class="d-block"><?= $pf['brgy_clearance'];?></label>
                </div>

                <div class="form-group col-lg-3">
                    <label class="d-block">NBI / Police Clearance</label>
                    <label class="d-block"><?= $pf['nbi_clearance'];?></label>
                </div>


                <h5 class="col-lg-12 mg-t-30 mg-b-30">Emergency Contact Person</h5>

                <div class="form-group col-lg-4">
                    <label class="d-block">Name</label>
                    <input value="<?= $pf['emergency_contact_person'];?>" type="text" class="form-control" name="emergency-contact-person" value="">
                </div>

                <div class="form-group col-lg-4">
                    <label class="d-block">Contact Number</label>
                    <input value="<?= $pf['emergency_contact_number'];?>" type="text" class="form-control" name="emergency-contact-number" value="">
                </div>

                <div class="form-group col-lg-4">
                    <label class="d-block">Relation</label>
                    <select name="emergency-contact-relation" class="form-control form-control-sm" required>
                        <option value="<?= $pf['emergency_contact_relation'];?>" selected><?= $pf['emergency_contact_relation'];?></option>
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


        </div>

        <div class="mg-t-20">
            <button class="btn btn-primary mg-r-15" name="submit" type="submit">Update My Information</button>
        </div>
        
    <?= form_close();?>
</div>