<?php
    $encrypter = \Config\Services::encrypter(); // access to the encryptor
?>
<div class="container">

    <?php
        // Message thrown from the controller
        if(!empty($_SESSION['bank_added'])){
            echo '<div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Bank Details Registration Success!</h4>
            <p>Bank details has been successfully registered</p>
        </div>';
            unset($_SESSION['bank_added']);
        }

        if(!empty($_SESSION['bank_updated'])){
            echo '<div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Updated Success!</h4>
            <p>Bank details has been successfully updated</p>
        </div>';
            unset($_SESSION['bank_updated']);
        }

        
    ?>

    <h1>Bank Account Management</h1>
    

    <div class="row">
        <div class="col-lg-6">

            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4"></h4>
                    <?= form_open('bank/save');?>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Name</label>
                            <div class="col-md-9">
                                <input class="form-control" type="text" name="name" value="" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Account Number</label>
                            <div class="col-md-9">
                                <input class="form-control" type="text" name="account-number" value="" required>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-sm mg-r-10" name="submit" type="submit">Register Bank Account</button>
                    <?= form_close();?>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="table-responsive mb-0">
                <table class="table table-md table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 50%">Name</th>
                            <th style="width: 50%">Account Number</th>
                            <th style="width: 50%">Status</th>
                            <th style="width: 1%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($bank as $ba){?>
                        <tr>
                            <td class="align-middle"><?= $ba['name']; ?></td>
                            <td class="align-middle"><?= $ba['account_number']; ?></td>
                            <td class="align-middle"><?= $ba['status']; ?></td>
                            <td class="align-middle">

                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary btn-icon btn-sm" data-toggle="modal" data-target="#modaledit<?= $ba['bank_account_id']; ?>"><i class="fas fa-edit"></i></button>
                                </div>

                                <!-- MODAL EDIT -->
                                <!-- Modal -->
                                <div class="modal fade" id="modaledit<?= $ba['bank_account_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">  
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Bank <?= $ba['name'];?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- ID BEING DECODED AND ENCRYPTED DUE TO THE ERROR ON THE URI ROUTES -->
                                            <?= form_open('bank/update/'.str_ireplace(['/','+'],['~','$'],$encrypter->encrypt($ba['bank_account_id'])));?>

                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Name</label>
                                                <div class="col-md-9">
                                                    <input class="form-control" type="text" name="name" value="<?= $ba['name']; ?>" required>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Account Number</label>
                                                <div class="col-md-9">
                                                    <input class="form-control" type="text" name="account-number" value="<?= $ba['account_number']; ?>" required>
                                                </div>
                                            </div>

                                            
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Status</label>
                                                <div class="custom-control custom-switch">
                                                    <input value="inactive" name="status" class="custom-control-label" type="hidden" id="" />
                                                    <input value="active" name="status" type="checkbox" class="custom-control-input" id="customSwitch<?= $ba['bank_account_id']; ?>" <?php if($ba['status'] == 'active'){echo 'checked';}?>>
                                                    <label class="custom-control-label" for="customSwitch<?= $ba['bank_account_id']; ?>">Inactive / Active</label>
                                                </div>
                                            </div>
                                        

                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                            <?= form_close();?>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END OF MODAL EDIT -->


                            </td>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>