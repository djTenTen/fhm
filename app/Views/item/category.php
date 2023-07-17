<?php 
    $encrypter = \Config\Services::encrypter();
    $arr = array();
    $user_model = new \App\Models\User_model; // to access the users_model
    $item_model = new \App\Models\Item_model; // to access the item_model
    foreach($user_model->getUserAccess($_SESSION['groupid']) as $access){
        array_push($arr, $access['name']);
    }
?>

<div class="container">

    <?php
        // Message thrown from the controller
        if(!empty($_SESSION['category_updated'])){
            echo '<div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Update Success!</h4>
            <p>Category has been successfully updated</p>
        </div>';
            unset($_SESSION['category_updated']);
        }

        if(!empty($_SESSION['category_registered'])){
            echo '<div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Registration Success!</h4>
            <p>Category has been successfully registered</p>
        </div>';
            unset($_SESSION['category_registered']);
        }

        if(!empty($_SESSION['category_deactivated'])){
            echo '<div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Deactivation Success!</h4>
            <p>Category has been successfully deactivated</p>
        </div>';
            unset($_SESSION['category_deactivated']);
        }
        
    ?>

    <h1>Category</h1>

    <div class="row">

        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4"></h4>

                    <?= form_open("item/registercategory");?>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Name</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" name="name" value="" required>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-sm mg-r-10" name="submit" type="submit">Register</button>

                    <?= form_close();?>
                    </form>

                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="table-responsive table-hover">
                <table class="table table-md table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 50%">Name</th>
                            <th style="width: 50%">Status</th>
                            <th style="width: 50%">Count</th>
                            <th style="width: 1%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- CATEGORY DATA BEING DISPLAYED ON THE TABLE -->
                        <?php foreach($category as $c){
                            $count = $item_model->countCategory($c['name'])?>
                            <tr>
                                <td class="align-middle"><?= $c['name'];?></td>
                                <td class="align-middle"><span class="badge badge-<?php if($c['status'] == 'active'){ echo 'success'; } else { echo 'danger'; } ?>"><?= ucwords($c['status']); ?></span></td>
                                <td class="align-middle"><?= $count['countcate'];?></td>
                                <td class="align-middle">

                                    <div class="btn-group" role="group">
                                        <!-- VALIDATION OF USERS'S ACCESS -->
                                        <?php if(in_array('edit-item', $arr)){?>
                                            <button type="button" class="btn btn-primary btn-icon btn-sm" data-toggle="modal" data-target="#modaledit<?= $c['item_category_id']; ?>"><i class="fas fa-edit"></i></button>
                                            <button type="button" class="btn btn-secondary btn-icon btn-sm" data-toggle="modal" data-target="#modaldelete<?= $c['item_category_id']; ?>"><i class="fas fa-times"></i></button>
                                        <?php }?>
                                    </div>

                                    <!-- MODAL EDIT -->
                                    <!-- Modal -->
                                    <div class="modal fade" id="modaledit<?= $c['item_category_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit <?= $c['name']; ?></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- ID BEING DECODED AND ENCRYPTED DUE TO THE ERROR ON THE URI ROUTES -->
                                                <?= form_open('item/updatecategory/'.str_ireplace(['/','+'],['~','$'],$encrypter->encrypt($c['item_category_id'])));?>

                                                    <div class="col-lg-8">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 col-form-label">Name</label>
                                                            <div class="col-md-8">
                                                                <input value="<?= $c['name']; ?>" class="form-control" type="text" name="name" value="" required>
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
                                    <div class="modal fade" id="modaldelete<?= $c['item_category_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Disable <?= $c['name']; ?></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure to disable this category <strong> <?= $c['name']; ?> </strong>?
                                            </div>
                                            <div class="modal-footer">
                                                <!-- ID BEING DECODED AND ENCRYPTED DUE TO THE ERROR ON THE URI ROUTES -->
                                                <?= form_open("item/deactivatecategory/".str_ireplace(['/','+'],['~','$'],$encrypter->encrypt($c['item_category_id'])));?>
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
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>

        
    </div>

</div>