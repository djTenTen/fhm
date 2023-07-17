<?php
    $encrypter = \Config\Services::encrypter();
    $arr = array();
    $user_model = new \App\Models\User_model; // to access the users_model
    foreach($user_model->getUserAccess($_SESSION['groupid']) as $access){
        array_push($arr, $access['name']);
    }
?>
<div class="container">

    <?php 
        if(!empty($_SESSION['employee_updated'])){
            echo '<div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Update Success!</h4>
            <p>Employee has been successfully updated</p>
        </div>';
            unset($_SESSION['employee_updated']);
        }
    ?>

    <h1><?= $state;?> Employees</h1>


    <table class="table table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Contact</th>
                <th>Date Hired</th>
                <th>Status</th>
                <th>Assigned Warehouse</th>
                <th>Account Type</th>
                <th>Agency</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($employee as $emp){?>
                <tr>
                    <td><?= $emp['user_id'];?></td>
                    <td><?= $emp['nameuser'];?></td>
                    <td><?= $emp['contact_number'];?></td>
                    <td><?= $emp['date_hired'];?></td>
                    <td><?= $emp['status'];?></td>
                    <td><?= $emp['warehouse'];?></td>
                    <td><?= $emp['groupname'];?></td>
                    <td><?= $emp['agency'];?></td>
                    <td>
                        <?php if(in_array('edit-employee', $arr)){?>
                            <!-- BUTTON FOR MODAL EDIT EMPLOYEE -->
                            <button type="button" class="btn btn-primary btn-sm btn-icon" data-toggle="modal" data-target="#editemployee<?= $emp['user_id'];?>"><i class="fas fa-edit"></i></button>
                            <!-- MODAL EDIT -->
                            <!-- Modal -->
                            <div class="modal fade" id="editemployee<?= $emp['user_id'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit employee <?= $emp['nameuser'];?> ?</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <?= form_open('employee/update/'.str_ireplace(['/','+'],['~','$'],$encrypter->encrypt($emp['user_id'])));?>

                                            <div class="row">
                                                <h5 class="col-lg-12 mg-b-30">Personal Information</h5>

                                                <div class="form-group col-lg-6">
                                                    <label class="d-block">First Name</label>
                                                    <input value="<?= $emp['first_name'];?>" type="text" class="form-control" name="first-name" value="" required autofocus>
                                                </div>

                                                <div class="form-group col-lg-2">
                                                    <label class="d-block">Middle Name</label>
                                                    <input value="<?= $emp['middle_name'];?>" type="text" class="form-control" name="middle-name" value="" >
                                                </div>

                                                <div class="form-group col-lg-4">
                                                    <label class="d-block">Last Name</label>
                                                    <input value="<?= $emp['last_name'];?>" type="text" class="form-control" name="last-name" value="" required>
                                                </div>

                                                <div class="form-group col-lg-8">
                                                    <label class="d-block">Address</label>
                                                    <input value="<?= $emp['address'];?>" type="text" class="form-control" name="address" value="">
                                                </div>

                                                <div class="form-group col-lg-4">
                                                    <label class="d-block">Email</label>
                                                    <input value="<?= $emp['email'];?>" type="email" class="form-control" name="email" value="" required>
                                                </div>

                                                <div class="form-group col-lg-2">
                                                    <label class="d-block">Contact Number</label>
                                                    <input value="<?= $emp['contact_number'];?>" type="text" class="form-control" name="contact-number" value="">
                                                </div>

                                                <div class="form-group col-lg-2">
                                                    <label class="d-block">Gender</label>
                                                    <div class="col-form-label">
                                                        <div class="custom-control custom-radio mg-r-10 d-inline-block">
                                                            <input type="radio" class="custom-control-input" id="gender-male" name="gender" value="male" <?php if($emp['gender'] == 'male'){echo 'checked';}?>>
                                                            <label class="custom-control-label" for="gender-male">Male</label>
                                                        </div>

                                                        <div class="custom-control custom-radio d-inline-block">
                                                            <input type="radio" class="custom-control-input" id="gender-female" name="gender" value="female" <?php if($emp['gender'] == 'female'){echo 'checked';}?>>
                                                            <label class="custom-control-label" for="gender-female">Female</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group col-lg-2">
                                                    <label class="d-block">Birthday</label>
                                                    <input type="date" class="form-control" name="birthday" value="<?= $emp['birthday'];?>" required>
                                                </div>

                                                <div class="form-group col-lg-3">
                                                    <label class="d-block">Username</label>
                                                    <div>
                                                        <input class="form-control" type="text" name="username" value="<?= $emp['username'];?>" id="username" onkeydown="btnhiding()" readonly>
                                                        <div id="msg"></div>
                                                    </div>
                                                </div>
                                                <?php if(in_array('change-user-password', $arr)){?>
                                                <div class="form-group col-lg-3">
                                                    <label class="d-block">Password</label>
                                                    <input type="password" name="password" class="form-control" value="" >
                                                </div>
                                                <?php }?>


                                                <h5 class="col-lg-12 mg-t-30 mg-b-30">Employment Records</h5>

                                                <div class="form-group col-lg-3">
                                                    <label class="d-block">ID Number</label>
                                                    <label class="d-block">-</label>
                                                </div>

                                                <div class="form-group col-lg-3">
                                                    <label class="d-block">Position</label>
                                                    <input value="<?= $emp['position'];?>" type="text" class="form-control" name="position" value="">
                                                </div>

                                                <div class="form-group col-lg-3">
                                                    <label class="d-block">Salary</label>
                                                    <input value="<?= $emp['salary'];?>" type="number" class="form-control" name="salary" value="" required>
                                                </div>

                                                <div class="form-group col-lg-3">
                                                    <label class="d-block">Salary Type</label>
                                                    <div class="col-form-label">
                                                        <div class="custom-control custom-radio mg-r-10 d-inline-block">
                                                            <input type="radio" class="custom-control-input" id="salary-type-day" name="salary-type" value="daily" <?php if($emp['salary_type'] == 'daily'){echo 'checked';}?>>
                                                            <label class="custom-control-label" for="salary-type-day">Day</label>
                                                        </div>

                                                        <div class="custom-control custom-radio d-inline-block">
                                                            <input type="radio" class="custom-control-input" id="salary-type-month" name="salary-type" value="month" <?php if($emp['salary_type'] == 'month'){echo 'checked';}?>>
                                                            <label class="custom-control-label" for="salary-type-month">Month</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-3">
                                                    <label class="d-block">Status</label>
                                                    <div class="custom-control custom-switch">
                                                        <input value="inactive" name="status" class="custom-control-label" type="hidden" id="" />
                                                        <input value="active" name="status" type="checkbox" class="custom-control-input" id="customSwitch<?= $emp['user_id']; ?>" <?php if($emp['status'] == 'active'){echo 'checked';}?>>
                                                        <label class="custom-control-label" for="customSwitch<?= $emp['user_id']; ?>">Inactive / Active</label>
                                                    </div>
                                                </div>

                                                <div class="form-group col-lg-3">
                                                    <label class="d-block">Assigned Warehouse</label>
                                                    <select name="assigned-warehouse" class="custom-select" required>
                                                        <option value="<?= $encrypter->encrypt($emp['warehouse_id'])?>" selected><?= $emp['warehouse'];?></option>
                                                        <?php foreach($warehouse as $whf){?>
                                                            <option value="<?= $encrypter->encrypt($whf['warehouse_id'])?>"><?= $whf['name'];?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>

                                                <div class="form-group col-lg-3">
                                                    <label class="d-block">Assigned Agency</label>
                                                    <select name="assigned-agency" class="custom-select" required>
                                                        <option value="<?= $encrypter->encrypt($emp['agency_id'])?>" selected><?= $emp['agency'];?></option>
                                                        <?php foreach($agency as $a){?>
                                                            <option value="<?= $encrypter->encrypt($a['agency_id'])?>"><?= $a['name'];?></option>
                                                        <?php }?>
                                                    </select>
                                                </div>

                                                <div class="form-group col-lg-3">
                                                    <label class="d-block">Account Type</label>
                                                    <select name="account-type" class="custom-select" required>
                                                        <option value="" selected>Select Account Type</option>
                                                        <option value="<?= $encrypter->encrypt($emp['user_group_id'])?>" selected><?= $emp['groupname'];?></option>
                                                        <?php foreach($grp as $g){ ?>
                                                            <option value="<?= $encrypter->encrypt($g['user_group_id']);?>"><?= $g['name'];?></option>
                                                        <?php }?>
                                                    </select>
                                                </div>
                                                

                                                <h5 class="col-lg-12 mg-t-30 mg-b-30">Government Records</h5>

                                                <div class="form-group col-lg-4">
                                                    <label class="d-block">SSS Number</label>
                                                    <input value="<?= $emp['sss_number'];?>" type="text" class="form-control" name="sss-number" value="">
                                                </div>

                                                <div class="form-group col-lg-4">
                                                    <label class="d-block">Philhealth Number</label>
                                                    <input value="<?= $emp['philhealth_number'];?>" type="text" class="form-control" name="philhealth-number" value="">
                                                </div>

                                                <div class="form-group col-lg-4">
                                                    <label class="d-block">Pag-ibig Number</label>
                                                    <input value="<?= $emp['pagibig_number'];?>" type="text" class="form-control" name="pagibig-number" value="">
                                                </div>

                                                <div class="form-group col-lg-4">
                                                    <label class="d-block">Barangay Clearance</label>
                                                    <input value="<?= $emp['brgy_clearance'];?>" type="text" class="form-control" data-type="datepicker" name="barangay-clearance" value="">
                                                </div>

                                                <div class="form-group col-lg-4">
                                                    <label class="d-block">NBI / Police Clearance</label>
                                                    <input value="<?= $emp['nbi_clearance'];?>" type="text" class="form-control" data-type="datepicker" name="nbi-clearance" value="">
                                                </div>

                                                <h5 class="col-lg-12 mg-t-30 mg-b-30">Emergency Contact Person</h5>

                                                <div class="form-group col-lg-4">
                                                    <label class="d-block">Name</label>
                                                    <input value="<?= $emp['emergency_contact_person'];?>" type="text" class="form-control" name="emergency-contact-person" value="">
                                                </div>

                                                <div class="form-group col-lg-4">
                                                    <label class="d-block">Contact Number</label>
                                                    <input value="<?= $emp['emergency_contact_number'];?>" type="text" class="form-control" name="emergency-contact-number" value="">
                                                </div>

                                                <div class="form-group col-lg-4">
                                                    <label class="d-block">Relation</label>
                                                    <select name="emergency-contact-relation" class="form-control form-control-sm" required>
                                                        <option value="<?= $emp['emergency_contact_relation'];?>" selected><?= $emp['emergency_contact_relation'];?></option>
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
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Update Employee</button>
                                        <?= form_close()?>
                                        <button type="button" class="btn btn-info">Generate Employee ID</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END OF MODAL EDIT -->
                        <?php }?>
                    </td>
                </tr>
            <?php }?>
        </tbody>
    </table>

</div>