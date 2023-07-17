<?php 
$encrypter = \Config\Services::encrypter();
?>
<div class="container">

    <?php
        // Message thrown from the controller
        if(!empty($_SESSION['user_eject'])){
            echo '<div class="alert alert-success" role="alert">
            <h4 class="alert-heading">User Ejected Success!</h4>
            <p>User has been successfully ejected</p>
        </div>';
            unset($_SESSION['user_eject']);
        }

        if(!empty($_SESSION['system_update'])){
            echo '<div class="alert alert-success" role="alert">
            <h4 class="alert-heading">System Update Success!</h4>
            <p>System has been successfully updated</p>
        </div>';
            unset($_SESSION['system_update']);
        }

    ?>

    <h1>System Management</h1>



    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="adduser-tab" data-toggle="tab" href="#systemsettings" role="tab" aria-controls="systemsettings" aria-selected="true">System Settings</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="viewactive-tab" data-toggle="tab" href="#accesslogs" role="tab" aria-controls="accesslogs" aria-selected="false">Access Logs</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="inactiveusers-tab" data-toggle="tab" href="#activeusers" role="tab" aria-controls="activeusers" aria-selected="false">User Sessions</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="usergroup-tab" data-toggle="tab" href="#usergroup" role="tab" aria-controls="usergroup" aria-selected="false">Coming soon...</a>
        </li>
    </ul>
    
   
    <div class="tab-content bd bd-gray-300 bd-t-0 pd-20" id="myTabContent">
         <!-- FIRST TAB -->
        <div class="tab-pane fade show active" id="systemsettings" role="tabpanel" aria-labelledby="adduser-tab">
            <h6>System Settings</h6>

                <?php foreach($settings as $set){?>

                    <?= form_open_multipart("updatesystemsettings/".str_ireplace(['/','+'],['~','$'],$encrypter->encrypt($set['option_id'])));?>
                        <div class="form-group row">
                            <div class="col-lg-3">
                                <label class="col-form-label"><?= ucwords(str_replace("-", " ", $set['name'])); ?></label>
                            </div>
            
                            <div class="col-lg-4">
                                <?php if($set['name'] == 'site-logo'){?>
                                    <input type="file" class="form-control"  name="photo" /> 
                                <?php }else{?>
                                    <textarea class="form-control" name="value" rows="2"><?= $set['value']?></textarea>
                                <?php }?>
                            </div>

                            <div class="col-lg-1">
                                <button type="submit" name="submit" class="btn btn-primary btn-sm"><i class='far fa-save'></i></button>
                            </div>

                        </div>
                    <?= form_close();?>

                <?php }?>
            
        </div>
        <!-- END OF FIRST TAB -->

        <!-- START OF 2ND TAB -->
        <div class="tab-pane fade" id="accesslogs" role="tabpanel" aria-labelledby="viewactive-tab">
            <h6>Access Logs</h6>

            <table class="table table-sm table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Type</th>
                        <th>Username</th>
                        <th>Log</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($accesslogs as $al){?>
                        <tr>
                            <td><?= $al['access_log_id'];?></td>
                            <td><?= $al['type'];?></td>
                            <td><?= $al['username'];?></td>
                            <td><?= $al['log_time'];?></td>
                        </tr>
                    <?php }?>
                </tbody>
            </table>

        </div>
        <!-- END OF 2ND TAB -->
        <!-- START OF 3RD TAB -->
        <div class="tab-pane fade" id="activeusers" role="tabpanel" aria-labelledby="inactiveusers-tab">
            <h6>User Sessions</h6>

            <table class="table table-sm table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($onlineusers as $al){
                        
                        ?>
                        <tr>
                            <td><?= $al['session_id'];?></td>
                            <td><?= $al['nameuser'];?></td>
                            <td><?= $al['type'];?></td>
                            <td><?= $al['log_time'];?></td>
                            <td>
                                <button type="button" class="btn btn-danger btn-icon btn-sm" data-toggle="modal" data-target="#modaleject<?= $al['session_id']; ?>"><i class="fas fa-times"></i> Eject</button>
                                <!-- MODAL EJECT -->
                                <!-- Modal -->
                                <div class="modal fade" id="modaleject<?= $al['session_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Eject <?= $al['nameuser']; ?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure to eject the session of this user <strong> <?= $al['nameuser']; ?> </strong>?
                                        </div>
                                        <div class="modal-footer">
                                            <?= form_open("ejectuser/".str_ireplace(['/','+'],['~','$'],$encrypter->encrypt($al['session_id'])));?>
                                            <button type="submit" class="btn btn-primary">Eject</button>
                                            <?= form_close()?>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php }?>
                </tbody>
            </table>
            
        </div>
        <!-- END OF 3RD TAB -->
        
        <!-- START OF 4TH TAB -->
        <div class="tab-pane fade" id="usergroup" role="tabpanel" aria-labelledby="usergroup-tab">
            <h6>coming soon...</h6>
        </div>
        <!-- END OF 4TH TAB -->
    </div>

</div>