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

    

    <h1>Items</h1>

    <table class="table table-sm table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Name</th>
                <th>Tags</th>
                <th>Category</th>
                <th>Variation</th>
                <th>Action</th>
            </tr>       
        </thead>
        <tbody>
            <!-- VIEWS OF THE ACTIVE ITEMS -->
            <?php foreach($items as $ai){
                $count = $item_model->getVariationCount($ai['item_id']);
                $tg = json_decode($ai['tags']);
                ?>
                <tr>
                    <td><?= $ai['item_id'];?></td>
                    <td></td>
                    <td><?= $ai['itemname'];?></td>
                        
                    <td><?php if(!empty($ai['tags'])){?> <?php foreach($tg as $t){?><span class="badge badge-primary"><?= ucwords($t); ?></span> <?php }?> <?php }else{echo ucwords($ai['tags']);}?></td>
                    <td><?= $ai['catename'];?></td>  
                    <td><?= $count['varcount'];?></td>       
                    <td><span class="badge badge-<?php if($ai['itemstatus'] == 'active'){ echo 'success'; } else { echo 'danger'; } ?>"><?= ucwords($ai['itemstatus']); ?></span></td>
                    <td>
                        <!-- THIS IS THE BUTTON AREA WHERE IT CAN DISPLAY ALL THE VARIATIONS PER ITEM AND REDIRECT TO THE EDITING ITEM PAGE -->
                        <div class="btn-group">
                            <?php if(in_array('edit-item', $arr)){?>
                                <button type="button" class="btn btn-success btn-icon btn-sm" data-toggle="modal" data-target="#modalview<?= $ai['item_id']; ?>"><i class="fas fa-eye"></i></button>
                                <a href="<?= site_url().'item/edit/'.str_ireplace(['/','+'],['~','$'],$encrypter->encrypt($ai['item_id'])); ?>" class="btn btn-primary btn-icon btn-sm"><i class="fas fa-edit"></i></a>
                            <?php }?>
                        </div>
                        
                        <!-- MODAL VIEW -->
                        <!-- Modal -->
                        <div class="modal fade" id="modalview<?= $ai['item_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Variations of <?= $ai['itemname'];?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <table class="table table-hover table-sm">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Color</th>
                                                <th>Wholesale Price</th>
                                                <th>Retail Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- DISPLAY OF VARIATIONS ITEM ON THE MODAL PER PARENT ITEM-->
                                            <?php foreach($item_model->getVariationItems($ai['item_id']) as $vars){?>
                                                <tr>
                                                    <td><?= $vars['item_id'];?></td>
                                                    <td><?= $vars['name'];?></td>
                                                    <td><?= $vars['color'];?></td>
                                                    <td><?= $vars['wholesale_price'];?></td>
                                                    <td><?= $vars['retail_price'];?></td>
                                                </tr>
                                            <?php }?>
                                        </tbody>
                                    </table>          
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Ok</button>
                                </div>
                                </div>
                            </div>
                        </div>
                        <!-- END OF MODAL VIEW -->

                    </td>
                </tr>
            <?php }?>
        </tbody>
    </table>

   

</div>