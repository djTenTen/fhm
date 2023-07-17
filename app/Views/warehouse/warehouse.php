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
        // Message thrown from the controller
        if(!empty($_SESSION['warehouse_updated'])){
            echo '<div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Update Success!</h4>
            <p>Warehouse has been successfully updated</p>
        </div>';
            unset($_SESSION['warehouse_updated']);
        }

    ?>

    <h1>Warehouse Management</h1>


    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="activewarehouse-tab" data-toggle="tab" href="#activewarehouse" role="tab" aria-controls="activewarehouse" aria-selected="true">Active</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="inactivewarehouse-tab" data-toggle="tab" href="#inactivewarehouse" role="tab" aria-controls="inactivewarehouse" aria-selected="false">Inactive</a>
        </li>
    </ul>
    
   
    <div class="tab-content bd bd-gray-300 bd-t-0 pd-20" id="myTabContent">
        <!-- FIRST TAB -->
        <div class="tab-pane fade show active" id="activewarehouse" role="tabpanel" aria-labelledby="activewarehouse-tab">
            <h6>Active Warehouse</h6>

            <table class="table table-sm table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Status</th>                            
                        <th>Added By</th>
                        <th>Added On</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($awarehouse as $awh){?>
                        <tr>
                            <td><?= $awh['warehouse_id'];?></td>
                            <td><?= $awh['name'];?></td>
                            <td><?= $awh['address'];?></td>       
                            <td><span class="badge badge-<?php if($awh['status'] == 'active'){ echo 'success'; } else { echo 'danger'; } ?>"><?= ucwords($awh['status']); ?></span></td>
                            <td><?= $awh['nameuser'];?></td>
                            <td><?= $awh['added_on'];?></td>
                            <td>
                                <?php if(in_array('edit-warehouse', $arr)){?>
                                    <button type="button" class="btn btn-primary btn-icon btn-sm" data-toggle="modal" data-target="#modaledit<?= $awh['warehouse_id']; ?>"><i class="fas fa-edit"></i></button>
                                <?php }?>

                                <!-- MODAL EDIT -->
                                <!-- Modal -->
                                <div class="modal fade" id="modaledit<?= $awh['warehouse_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">  
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Customer <?= $awh['name'];?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- ID BEING DECODED AND ENCRYPTED DUE TO THE ERROR ON THE URI ROUTES -->
                                            <?= form_open('warehouse/update/'.str_ireplace(['/','+'],['~','$'],$encrypter->encrypt($awh['warehouse_id'])));?>
                                            
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group row">
                                                        <label class="col-md-2 col-form-label">Name</label>
                                                        <div class="col-md-10">
                                                            <input class="form-control" type="text" name="name" value="<?= $awh['name'];?>" required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="form-group row">
                                                        <label class="col-md-2 col-form-label">Address</label>
                                                        <div class="col-md-10">
                                                            <input class="form-control" type="text" name="address" value="<?= $awh['address'];?>">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="form-group row">
                                                        <label class="col-md-2 col-form-label">Contact Number</label>
                                                        <div class="col-md-10">
                                                            <input class="form-control" type="text" name="contact-number" value="<?= $awh['contact_number'];?>">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="form-group row">
                                                        <label class="col-md-2 col-form-label">Email Address</label>
                                                        <div class="col-md-10">
                                                            <input class="form-control" type="email" name="email-address" value="<?= $awh['email_address'];?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group row">
                                                    <label class="col-md-3 col-form-label">Status</label>
                                                    <div class="custom-control custom-switch">
                                                        <input value="inactive" name="status" class="custom-control-label" type="hidden" id="" />
                                                        <input value="active" name="status" type="checkbox" class="custom-control-input" id="customSwitch<?= $awh['warehouse_id']; ?>" <?php if($awh['status'] == 'active'){echo 'checked';}?>>
                                                        <label class="custom-control-label" for="customSwitch<?= $awh['warehouse_id']; ?>">Inactive / Active</label>
                                                    </div>
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
        <!-- END OF FIRST TAB -->
                                    
        <!-- START OF 2ND TAB -->
        <div class="tab-pane fade" id="inactivewarehouse" role="tabpanel" aria-labelledby="inactivewarehouse-tab">
            <h6>Inactive Warehouse</h6>

            <table class="table table-sm table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Status</th>                            
                        <th>Added By</th>
                        <th>Added On</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($iwarehouse as $iawh){?>
                        <tr>
                            <td><?= $iawh['warehouse_id'];?></td>
                            <td><?= $iawh['name'];?></td>
                            <td><?= $iawh['address'];?></td>       
                            <td><span class="badge badge-<?php if($iawh['status'] == 'active'){ echo 'success'; } else { echo 'danger'; } ?>"><?= ucwords($iawh['status']); ?></span></td>
                            <td><?= $iawh['nameuser'];?></td>
                            <td><?= $iawh['added_on'];?></td>
                            <td>
                                <?php if(in_array('edit-warehouse', $arr)){?>
                                    <button type="button" class="btn btn-primary btn-icon btn-sm" data-toggle="modal" data-target="#modaledit<?= $iawh['warehouse_id']; ?>"><i class="fas fa-edit"></i></button>
                                <?php }?>

                                <!-- MODAL EDIT -->
                                <!-- Modal -->
                                <div class="modal fade" id="modaledit<?= $iawh['warehouse_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">  
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Customer <?= $iawh['name'];?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- ID BEING DECODED AND ENCRYPTED DUE TO THE ERROR ON THE URI ROUTES -->
                                            <?= form_open('warehouse/update/'.str_ireplace(['/','+'],['~','$'],$encrypter->encrypt($iawh['warehouse_id'])));?>
                                            
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group row">
                                                        <label class="col-md-2 col-form-label">Name</label>
                                                        <div class="col-md-10">
                                                            <input class="form-control" type="text" name="name" value="<?= $iawh['name'];?>" required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="form-group row">
                                                        <label class="col-md-2 col-form-label">Address</label>
                                                        <div class="col-md-10">
                                                            <input class="form-control" type="text" name="address" value="<?= $iawh['address'];?>">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="form-group row">
                                                        <label class="col-md-2 col-form-label">Contact Number</label>
                                                        <div class="col-md-10">
                                                            <input class="form-control" type="text" name="contact-number" value="<?= $iawh['contact_number'];?>">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="form-group row">
                                                        <label class="col-md-2 col-form-label">Email Address</label>
                                                        <div class="col-md-10">
                                                            <input class="form-control" type="email" name="email-address" value="<?= $iawh['email_address'];?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group row">
                                                    <label class="col-md-3 col-form-label">Status</label>
                                                    <div class="custom-control custom-switch">
                                                        <input value="inactive" name="status" class="custom-control-label" type="hidden" id="" />
                                                        <input value="active" name="status" type="checkbox" class="custom-control-input" id="customSwitch<?= $iawh['warehouse_id']; ?>" <?php if($iawh['status'] == 'active'){echo 'checked';}?>>
                                                        <label class="custom-control-label" for="customSwitch<?= $iawh['warehouse_id']; ?>">Inactive / Active</label>
                                                    </div>
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
        <!-- END OF 2ND TAB -->

    </div>

</div>