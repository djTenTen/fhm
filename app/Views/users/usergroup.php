<?php
    $encrypter = \Config\Services::encrypter();
    $arr = array();
    $user_model = new \App\Models\User_model; // to access the users_model
    foreach($user_model->getUserAccess($_SESSION['groupid']) as $access){
        array_push($arr, $access['name']);
    }
?>
<div class="container">

    <h1>User Group Management</h1>

        <!-- BUTTON FOR MODAL ADDING GROUP -->
        <button type="button" class="btn btn-success btn-icon" data-toggle="modal" data-target="#addgroupuser">Add Group</button>
        <!-- MODAL DELETE -->
        <!-- Modal -->
        <div class="modal fade" id="addgroupuser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add a User Group</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <?= form_open('user/addgroup');?>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Name</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" name="groupname" value="" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Level</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" name="grouplevel" value="" max="9" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Modules</label>
                            <div class="col-md-10">
                                <div class="row">
                                    <!-- diplay of the parent module -->
                                    <?php foreach($prntmodule as $pm){?>
                                        <div class="col-md-4 mb-3 category-parent">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="module[]" data-submodule="false" class="custom-control-input" value="<?= $encrypter->encrypt($pm['module_id']);?>" id="module-<?= $pm['name'];?>">
                                                <label class="custom-control-label" for="module-<?= $pm['name'];?>"><?= ucwords(str_replace("-", " ", $pm['name'])); ?></label>
                                            </div>
                                            <!-- diplay of the child module -->
                                            <?php foreach($user_model->getChildModule($pm['module_id']) as $cm){?>
                                                <div class="ml-3 custom-control custom-checkbox">
                                                    <input type="checkbox" name="module[]" data-submodule="true" class="custom-control-input" value="<?= $encrypter->encrypt($cm['module_id']);?>" id="module-<?= $cm['name'];?>">
                                                    <label class="custom-control-label" for="module-<?= $cm['name'];?>"><?= ucwords(str_replace("-", " ", $cm['name'])); ?></label>
                                                </div>
                                            <?php }  ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save Group</button>
                    <?= form_close()?>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
                </div>
            </div>
        </div>
        <!-- END OF MODAL DELETE -->

        <div id="access-control-page" class="row">
            <div class="col-lg-12">
                <div class="table-responsive mb-0">
                    <table class="table table-md table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 50%">User Group</th>
                                <th style="width: 20%">Level</th>
                                <th style="width: 20%">Modules</th>
                                <th style="width: 1%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                /*
                                    *$grp from user controller who fetch the data from the user model
                                    *$c for parent and c2 for child module, for the echo of check if match on the loop
                                */
                                foreach($grp as $egu){
                                $resegu = $user_model->countModuleGroup($egu['user_group_id']);
                                $c = '';
                                $c2 = '';
                            ?>
                            <tr>
                                <td><?= $egu['name'];?></td>
                                <td><?= $egu['level'];?></td>
                                <td><?= $resegu["countgroup"];?></td>
                                <td>
                                    <!-- BUTTON FOR MODAL ADDING GROUP -->
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editgroupuser<?= $egu['user_group_id'];?>"><i class="fas fa-edit"></i></button>
                                    <!-- MODAL DELETE -->
                                    <!-- Modal -->
                                    <div class="modal fade" id="editgroupuser<?= $egu['user_group_id'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit <?= $egu['name'];?> Group</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- ID BEING DECODED AND ENCRYPTED DUE TO THE ERROR ON THE URI ROUTES -->
                                                <?= form_open('user/updategroup/'.str_ireplace(['/','+'],['~','$'],$encrypter->encrypt($egu['user_group_id'])));?>

                                                    <div class="form-group row">
                                                        <label class="col-md-2 col-form-label">Name</label>
                                                        <div class="col-md-10">
                                                            <input class="form-control" type="text" name="groupname" value="<?= $egu['name'];?>" required>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-md-2 col-form-label">Level</label>
                                                        <div class="col-md-10">
                                                            <input class="form-control" type="text" name="grouplevel" value="<?= $egu['level'];?>" max="9" required>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-md-2 col-form-label">Modules</label>
                                                        <div class="col-md-10">
                                                            <div class="row">
                                                                <!-- diplay of the parent module -->
                                                                <?php 

                                                                    /**
                                                                        ----------------------- structure --------------------------
                                                                        foreach(group){
                                                                            foreach(parent module){
                                                                                foreach(checking parent module){
                                                                                    if(){}else{}
                                                                                }
                                                                                foreach(child module){
                                                                                    foreach(checking child module){
                                                                                        if(){}else{}
                                                                                    }
                                                                                }
                                                                            }
                                                                        }
                                                                        * $prntmodule from user controller who fetch the data from the user model
                                                                        * foreach(check epm) is the loop for checking if match on the loop for the parent module
                                                                        * it breaks the loop if the loop detected a match then it will proceed on the next set of group
                                                                    */
                                                                    foreach($prntmodule as $epm){

                                                                        foreach($user_model->checkGroupAccess($egu['user_group_id']) as $checkepm){
                                                                            if($checkepm['module_id'] == $epm['module_id']){ $c = 'checked';break; }else{ $c = '';}
                                                                        }

                                                                    ?>
                                                                    <div class="col-md-4 mb-3 category-parent">
                                                                        <div class="custom-control custom-checkbox">
                                                                            <input type="checkbox" name="module[]" data-submodule="false" class="custom-control-input" value="<?= $encrypter->encrypt($epm['module_id']);?>" id="module-<?= $epm['name'].$egu['user_group_id'].$epm['module_id'];?>" <?= $c;?>>
                                                                            <label class="custom-control-label" for="module-<?= $epm['name'].$egu['user_group_id'].$epm['module_id'];?>"><?= ucwords(str_replace("-", " ", $epm['name'])); ?></label>
                                                                        </div>
                                                                        <!-- diplay of the child module -->
                                                                        <?php 
                                                                            /*
                                                                                * @function getChildModule is to get the Chil Module base on the Parent module loaded on the first loop
                                                                                * foreach(check ecm) is the loop for checking if match on the loop for the parent module
                                                                                * it breaks the loop if the loop detected a match then it will proceed on the next set of group
                                                                            */
                                                                            foreach($user_model->getChildModule($epm['module_id']) as $ecm){

                                                                                foreach($user_model->checkGroupAccess($egu['user_group_id']) as $checkecm){
                                                                                    if($checkecm['module_id'] == $ecm['module_id']){$c2 = 'checked';break;}else{ $c2 = '';}
                                                                                }

                                                                        ?>

                                                                            <div class="ml-3 custom-control custom-checkbox">
                                                                                <input type="checkbox" name="module[]" data-submodule="true" class="custom-control-input" value="<?= $encrypter->encrypt($ecm['module_id']);?>" id="module-<?= $ecm['name'].$egu['user_group_id'].$ecm['module_id'];?>" <?= $c2?>>
                                                                                <label class="custom-control-label" for="module-<?= $ecm['name'].$egu['user_group_id'].$ecm['module_id'];?>"><?= ucwords(str_replace("-", " ", $ecm['name'])); ?></label>
                                                                            </div>
                                                                        <?php } ?>
                                                                    </div>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                    </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Update Group</button>
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

        </div>

</div>