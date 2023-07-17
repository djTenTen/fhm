<?php

    $encrypter = \Config\Services::encrypter();

    /*
        * @$arr is the array container for the login control information
        * @foreach to get all the information and push the data on array to be 
        * verified on certain part like add,edit,delete access
    */
    $arr = array();
    $user_model = new \App\Models\User_model; // to access the users_model
    foreach($user_model->getUserAccess($_SESSION['groupid']) as $access){
        array_push($arr, $access['name']);
    }

?>

<div class="container">



    <?php
        // message session thrown from the controller
        if(!empty($_SESSION['user_registered'])){
            echo '<div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Register Success!</h4>
            <p>User has been successfully registered</p>
        </div>';
            unset($_SESSION['user_registered']);
        }
        if(!empty($_SESSION['user_updated'])){
            echo '<div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Update Success!</h4>
            <p>User has been successfully updated</p>
        </div>';
            unset($_SESSION['user_updated']);
        }
        if(!empty($_SESSION['user_deleted'])){
            echo '<div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Delete Success!</h4>
            <p>User has been successfully deleted</p>
        </div>';
            unset($_SESSION['user_deleted']);
        }

        if(!empty($_SESSION['group_added'])){
            echo '<div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Group Registration Success!</h4>
            <p>User group has been successfully registered</p>
        </div>';
            unset($_SESSION['group_added']);
        }

        if(!empty($_SESSION['group_updated'])){
            echo '<div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Update Success!</h4>
            <p>User group has been successfully updated</p>
        </div>';
            unset($_SESSION['group_updated']);
        }
        
    ?>


    <h1> User Management</h1>



    <ul class="nav nav-tabs" id="myTab" role="tablist">

        <?php if(in_array('add-user', $arr)){?>
            <li class="nav-item">
                <a class="nav-link active" id="adduser-tab" data-toggle="tab" href="#adduser" role="tab" aria-controls="adduser" aria-selected="true">Add New</a>
            </li>
        <?php }?>
       
        <li class="nav-item">
            <a class="nav-link" id="viewactive-tab" data-toggle="tab" href="#viewactive" role="tab" aria-controls="viewactive" aria-selected="false">View Active</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="inactiveusers-tab" data-toggle="tab" href="#inactiveusers" role="tab" aria-controls="inactiveusers" aria-selected="false">View Inactive</a>
        </li>
        
    </ul>
    
    <!-- FIRST TAB -->
    <div class="tab-content bd bd-gray-300 bd-t-0 pd-20" id="myTabContent">

        <?php if(in_array('add-user', $arr)){?>
        <div class="tab-pane fade show active" id="adduser" role="tabpanel" aria-labelledby="adduser-tab">
            <h6>Add New User</h6>
                <?= form_open('registeruser');?>
                    <div class="row">

                        <div class="col-lg-6">
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label">Username</label>
                                <div class="col-md-8">
                                    <input class="form-control" type="text" name="username" value="" id="username" onkeydown="btnhiding()" required>
                                    <div id="msg"></div>
                                </div>
                            </div>
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

                        <div class="col-lg-6">
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label">Name</label>
                                <div class="col-md-8">
                                    <input class="form-control" type="text" name="name" value="" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label">Password</label>
                                <div class="col-md-8">
                                    <input class="form-control" type="password" name="password" value="" required>
                                </div>
                            </div>
                        </div>


                        

                        <div class="col-lg-6">
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label">Confirm Password</label>
                                <div class="col-md-8">
                                    <input class="form-control" type="password" name="confirm-password" value="" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label">User Account Type</label>
                                <div class="col-md-8">
                                    <select name="user-account-type" class="custom-select" required>
                                        <option value="" selected>Select Account Type</option>
                                        <!-- grp data from the user_controller -->
                                        <?php
                                            $encrypter = \Config\Services::encrypter();
                                            foreach($grp as $g){
                                        ?>
                                            <option value="<?= $encrypter->encrypt($g['user_group_id']);?>"><?= $g['name'];?></option>

                                        <?php }?>

                                    </select>
                                
                                </div>
                            </div>
                        </div>
                        
                    </div>

                    <button class="btn btn-primary btn-sm mg-r-10" name="submit" type="submit">Submit</button>

                <?= form_close();?>

        </div>
        <?php }?>
        <!-- END OF FIRST TAB -->

        <!-- START OF 2ND TAB -->
        <div class="tab-pane fade <?php if(!in_array('add-user', $arr)){echo 'show active';}?> " id="viewactive" role="tabpanel" aria-labelledby="viewactive-tab">
            <h6>Active Users</h6>
            
            <div class="table-responsive ias mb-0">
                <table class="table table-hover" id="datatable1">
                    <thead>
                        <tr>
                            <th style="width: 1%;">ID</th>
                            <th style="width: 25%;">Username</th>
                            <th style="width: 25%;">Name</th>
                            <th style="width: 25%;">Account Type</th>
                            <th style="width: 1%;">Status</th>
                            <th style="width: 25%;">Added By</th>
                            <th style="width: 1%;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $user_model = new \App\Models\User_model; // to access the users_model
                            foreach($ausr as $au){
                            $added = $user_model->getadder($au['added']);
                        ?>
                        <tr>
                            <td class="align-middle"><?= $au['user_id']; ?></td>
                            <td class="align-middle"><?= $au['username']; ?></td>
                            <td class="align-middle"><?= $au['nameuser']; ?></td>
                            <td class="align-middle"><?= $au['groupname']; ?></td>
                            <td class="align-middle"><span class="badge badge-<?php if($au['tustatus'] == 'active'){ echo 'success'; } else { echo 'danger'; } ?>"><?= ucwords($au['tustatus']); ?></span></td>
                            <td class="align-middle"><?= $added['name'];?></td>
                            <td class="align-middle">

                                <div class="btn-group" role="group">
                                    <!-- VALIDATION OF USERS'S ACCESS -->
                                    <?php if(in_array('edit-user', $arr)){?>
                                        <button type="button" class="btn btn-primary btn-icon btn-sm" data-toggle="modal" data-target="#modaledit<?= $au['user_id']; ?>"><i class="fas fa-edit"></i></button>
                                    <?php }?>
                                    <!-- VALIDATION OF USERS'S ACCESS -->
                                    <?php if(in_array('delete-user', $arr)){?>
                                        <button type="button" class="btn btn-danger btn-icon btn-sm" data-toggle="modal" data-target="#modaldelete<?= $au['user_id']; ?>"><i class="fas fa-times"></i></button>
                                    <?php }?>
                                </div>
                                <!-- MODAL EDIT -->
                                <!-- Modal -->
                                <div class="modal fade" id="modaledit<?= $au['user_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit <?= $au['nameuser']; ?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <!-- ID BEING DECODED AND ENCRYPTED DUE TO THE ERROR ON THE URI ROUTES -->
                                            <?= form_open('user/updateuser/'.str_ireplace(['/','+'],['~','$'],$encrypter->encrypt($au['user_id'])));?>

                                                <div class="col-lg-8">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 col-form-label">Name</label>
                                                        <div class="col-md-8">
                                                            <input value="<?= $au['nameuser']; ?>" class="form-control" type="text" name="name" value="" required>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="col-lg-8">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 col-form-label">Username</label>
                                                        <div class="col-md-8">
                                                            <input value="<?= $au['username']; ?>" class="form-control" type="text" name="username" value="" id="username" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- VALIDATION OF USERS'S ACCESS -->
                                                <?php if(in_array('change-user-password', $arr)){?>
                                                <div class="col-lg-12">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <label class="col-md-3 col-form-label">Password</label>
                                                                <div class="col-md-6">
                                                                    <input class="form-control" type="password" name="password" value="">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <label class="col-md-3 col-form-label">Confirm Password</label>
                                                                <div class="col-md-6">
                                                                    <input class="form-control" type="password" name="confirm-password" value="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php }?>

                                                <div class="col-lg-8">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 col-form-label">User Account Type</label>
                                                        <div class="col-md-8">
                                                            <select name="user-account-type" class="custom-select" required>
                                                                <option value="<?= $encrypter->encrypt($au['user_group_id']); ?>" selected><?= $au['groupname']; ?></option>
                                                                <!-- grp data from the user_controller -->
                                                                <?php foreach($grp as $g){?>
                                                                    <option value="<?= $encrypter->encrypt($g['user_group_id']);?>"><?= $g['name'];?></option>
                                                                <?php }?>
                                                            </select>
                                                        
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                
                                                <div class="col-lg-8">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 col-form-label">Status</label>
                                                        <div class="custom-control custom-switch">
                                                            <input value="inactive" name="status" class="custom-control-label" type="hidden" id="" />
                                                            <input value="active" name="status" type="checkbox" class="custom-control-input" id="customSwitch<?= $au['user_id']; ?>" <?php if($au['tustatus'] == 'active'){echo 'checked';}?>>
                                                            <label class="custom-control-label" for="customSwitch<?= $au['user_id']; ?>">Inactive / Active</label>
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


                                <!-- MODAL DELETE -->
                                <!-- Modal -->
                                <div class="modal fade" id="modaldelete<?= $au['user_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Delete <?= $au['nameuser']; ?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure to delete this user <strong> <?= $au['nameuser']; ?> </strong>?
                                        </div>
                                        <div class="modal-footer">
                                            <!-- ID BEING DECODED AND ENCRYPTED DUE TO THE ERROR ON THE URI ROUTES -->
                                            <?= form_open("user/deleteuser/".str_ireplace(['/','+'],['~','$'],$encrypter->encrypt($au['user_id'])));?>
                                            <button type="submit" class="btn btn-primary">Confirm</button>
                                            <?= form_close()?>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        </div>
                                        </div>
                                    </div>
                                </div>

                            </td>
                        </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>

        </div>
        <!-- END OF 2ND TAB -->
        <!-- START OF 3RD TAB -->
        <div class="tab-pane fade" id="inactiveusers" role="tabpanel" aria-labelledby="inactiveusers-tab">
            <h6>Inactive Users</h6>
            
            
            <div class="table-responsive ias mb-0">
                <table class="table table-hover" id="datatable2">
                    <thead>
                        <tr>
                            <th style="width: 1%;">ID</th>
                            <th style="width: 25%;">Username</th>
                            <th style="width: 25%;">Name</th>
                            <th style="width: 25%;">Account Type</th>
                            <th style="width: 1%;">Status</th>
                            <th style="width: 25%;">Added By</th>
                            <th style="width: 1%;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                            $user_model = new \App\Models\User_model; // to access the users_model
                            foreach($iusr as $au){
                            $added = $user_model->getadder($au['added']);

                        ?>
                        <tr>
                            <td class="align-middle"><?= $au['user_id']; ?></td>
                            <td class="align-middle"><?= $au['username']; ?></td>
                            <td class="align-middle"><?= $au['nameuser']; ?></td>
                            <td class="align-middle"><?= $au['groupname']; ?></td>
                            <td class="align-middle"><span class="badge badge-<?php if($au['tustatus'] == 'active'){ echo 'success'; } else { echo 'danger'; } ?>"><?= ucwords($au['tustatus']); ?></span></td>
                            <td class="align-middle"><?= $added['name'];?></td>
                            <td class="align-middle">

                                <div class="btn-group" role="group">
                                    <!-- VALIDATION OF USERS'S ACCESS -->
                                    <?php if(in_array('edit-user', $arr)){?>
                                        <button type="button" class="btn btn-primary btn-icon btn-sm" data-toggle="modal" data-target="#modaledit<?= $au['user_id']; ?>"><i class="fas fa-edit"></i></button>
                                    <?php }?>
                                    <!-- VALIDATION OF USERS'S ACCESS -->
                                    <?php if(in_array('delete-user', $arr)){?>
                                        <button type="button" class="btn btn-danger btn-icon btn-sm" data-toggle="modal" data-target="#modaldelete<?= $au['user_id']; ?>"><i class="fas fa-times"></i></button>
                                    <?php }?>
                                </div>

                                <!-- MODAL EDIT -->
                                <!-- Modal -->
                                <div class="modal fade" id="modaledit<?= $au['user_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit <?= $au['nameuser']; ?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- ID BEING DECODED AND ENCRYPTED DUE TO THE ERROR ON THE URI ROUTES -->
                                            <?= form_open('user/updateuser/'.str_ireplace(['/','+'],['~','$'],$encrypter->encrypt($au['user_id'])));?>

                                                <div class="col-lg-8">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 col-form-label">Name</label>
                                                        <div class="col-md-8">
                                                            <input value="<?= $au['nameuser']; ?>" class="form-control" type="text" name="name" value="" required>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="col-lg-8">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 col-form-label">Username</label>
                                                        <div class="col-md-8">
                                                            <input value="<?= $au['username']; ?>" class="form-control" type="text" name="username" value="" id="username" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- VALIDATION OF USERS'S ACCESS -->
                                                <?php if(in_array('change-user-password', $arr)){?>
                                                <div class="col-lg-12">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <label class="col-md-3 col-form-label">Password</label>
                                                                <div class="col-md-6">
                                                                    <input class="form-control" type="password" name="password" value="">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <div class="form-group row">
                                                                <label class="col-md-3 col-form-label">Confirm Password</label>
                                                                <div class="col-md-6">
                                                                    <input class="form-control" type="password" name="confirm-password" value="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php }?>

                                                <div class="col-lg-8">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 col-form-label">User Account Type</label>
                                                        <div class="col-md-8">
                                                            <select name="user-account-type" class="custom-select" required>
                                                                <option value="<?= $encrypter->encrypt($au['user_group_id']); ?>" selected><?= $au['groupname']; ?></option>
                                                                <!-- grp data from the user_controller -->
                                                                <?php foreach($grp as $g){?>
                                                                    <option value="<?= $encrypter->encrypt($g['user_group_id']);?>"><?= $g['name'];?></option>
                                                                <?php }?>
                                                            </select>
                                                        
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                
                                                <div class="col-lg-8">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 col-form-label">Status</label>
                                                        <div class="custom-control custom-switch">
                                                            <input value="inactive" name="status" class="custom-control-label" type="hidden" id="" />
                                                            <input value="active" name="status" type="checkbox" class="custom-control-input" id="customSwitch<?= $au['user_id']; ?>" <?php if($au['tustatus'] == 'active'){echo 'checked';}?>>
                                                            <label class="custom-control-label" for="customSwitch<?= $au['user_id']; ?>">Inactive / Active</label>
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

                                <!-- MODAL DELETE -->
                                <!-- Modal -->
                                <div class="modal fade" id="modaldelete<?= $au['user_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Delete <?= $au['nameuser']; ?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure to delete this user <strong> <?= $au['nameuser']; ?> </strong>?
                                        </div>
                                        <div class="modal-footer">
                                            <!-- ID BEING DECODED AND ENCRYPTED DUE TO THE ERROR ON THE URI ROUTES -->
                                            <?= form_open("user/deleteuser/".str_ireplace(['/','+'],['~','$'],$encrypter->encrypt($au['user_id'])));?>
                                            <button type="submit" class="btn btn-primary">Confirm</button>
                                            <?= form_close()?>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END OF MODAL DELETE -->

                            </td>
                        </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>

        </div>
        <!-- END OF 3RD TAB -->

    </div>


       
    
</div>

<!-- FOR THE DATATABLES -->
<script>

    $('#datatable1').DataTable({
    language: {
        searchPlaceholder: 'Search...',
        sSearch: '',
        lengthMenu: '_MENU_ items/page',
    }
    });

    $('#datatable2').DataTable({
    language: {
        searchPlaceholder: 'Search...',
        sSearch: '',
        lengthMenu: '_MENU_ items/page',
    }
    });

</script>