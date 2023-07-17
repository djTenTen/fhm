<?php
    $purchase_model = new \App\Models\Purchase_model; // to access the Purchase_model
    $encrypter = \Config\Services::encrypter(); // access to the encryptor
    $arr = array();
	$user_model = new \App\Models\User_model; // to access the users_model
	foreach($user_model->getUserAccess($_SESSION['groupid']) as $access){
		array_push($arr, $access['name']);
	}
?>
<div class="container">

    <?php
        // Message thrown from the controller
        if(!empty($_SESSION['purchase_updated'])){
            echo '<div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Update Success!</h4>
            <p>Purchase has been successfully Updated</p>
        </div>';
            unset($_SESSION['purchase_updated']);
        }
        if(!empty($_SESSION['purchase_pending'])){
            echo '<div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Update Success!</h4>
            <p>Purchase has been successfully set to Pending</p>
        </div>';
            unset($_SESSION['purchase_pending']);
        }
        if(!empty($_SESSION['purchase_delivered'])){
            echo '<div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Update Success!</h4>
            <p>Purchase has been successfully set to Delivered</p>
        </div>';
            unset($_SESSION['purchase_delivered']);
        }
        if(!empty($_SESSION['purchase_cancelled'])){
            echo '<div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Update Success!</h4>
            <p>Purchase has been successfully set to Cancelled</p>
        </div>';
            unset($_SESSION['purchase_cancelled']);
        }
    ?>

    <h1><?= $stats;?> Purchase</h1>


    <table class="table table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Date</th>
                <th>Invoice No.</th>
                <th>Supplier</th>
                <th>Quantity</th>
                <th>Subtotal</th>
                <th>Status</th>
                <th>Payment</th>
                <th>Added By</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                foreach($purchase as $ap){
                    $p = $purchase_model->getCount($ap['purchase_id']);
            ?>
            <tr>
                <td><?= $ap['purchase_id'];?></td>
                <td><?= $ap['invoice_date'];?></td>
                <td><?= $ap['invoice_no'];?></td>
                <td><?= $ap['name'];?></td>
                <td><?= $p['qty'];?></td>
                <td><?= number_format($p['subtotal'],2);?></td>
                <td><span class="badge badge-<?php if($ap['status']=='pending'){echo 'primary';}elseif($ap['status']=='delivered'){echo 'success';}elseif($ap['status']=='cancelled'){echo 'danger';}?>"><?= $ap['status'];?></span></td>
                <td><?= $ap['payment_status'];?></td>
                <td><?= $ap['nameuser'];?></td>
                <td>
                    <div class="btn-group">
                        <button type="button" class="btn btn-success btn-icon btn-sm" data-toggle="modal" data-target="#modalview<?= $ap['purchase_id']; ?>"><i class="fas fa-eye"></i></button>
                        <?php if(in_array('edit-purchase', $arr)){?>
                            <a href="<?= site_url().'/purchase/edit/'.str_ireplace(['/','+'],['~','$'],$encrypter->encrypt($ap['purchase_id'])); ?>" class="btn btn-primary btn-icon btn-sm"><i class="fas fa-edit"></i></a>
                        <?php }?>
                    </div>

                    <!-- MODAL VIEW -->
                        <!-- Modal -->
                        <div class="modal fade" id="modalview<?= $ap['purchase_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Purchase</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- TABLE VIEW FOR PURCHASE INFORMATION -->
                                    <table class="table table-bordered mb-4">
                                        <tbody>
                                            <tr>
                                                <td style="width: 20%">ID</td>
                                                <td style="width: 30%"><?= $ap['purchase_id'];?></td>
                                                <td style="width: 20%">Deliver To:</td>
                                                <td style="width: 30%"><?= $ap['warehouse'];?></td>
                                            </tr>

                                            <tr>
                                                <td>Invoice No.</td>
                                                <td><?= $ap['invoice_no'];?></td>
                                                <td>Invoice Date</td>
                                                <td><?= $ap['invoice_date'];?></td>

                                            </tr>

                                            <tr>
                                                <td>Supplier</td>
                                                <td colspan="3"><?= $ap['name'];?></td>
                                            </tr>

                                            <tr>
                                                <td>Status</td>
                                                <td colspan="3"><span class="badge badge-<?php if($ap['status']=='pending'){echo 'primary';}elseif($ap['status']=='delivered'){echo 'success';}elseif($ap['status']=='cancelled'){echo 'danger';}?>"><?= $ap['status'];?></span></td>
                                            </tr>

                                            <tr>
                                                <td>Payment Terms</td>
                                                <td colspan="3"><?php echo ucwords(str_replace("-", " ", $ap['payment_method'])); ?></td>
                                            </tr>

                                            <tr>
                                                <td>Added By</td>
                                                <td><?= $ap['nameuser'];?></td>
                                                <td>Added On</td>
                                                <td><?= $ap['added_on'];?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <!-- END OF TABLE VIEW FOR PURCHASE INFORMATION -->

                                    <!-- TABLE VIEW FOR PURCHASE ITEM INFORMATION -->
                                    <table class="table table-bordered mg-b-30">
                                        <thead>
                                                <tr>
                                                <th style="width: 10%">Quantity</th>
                                                <th style="width: 45%" colspan="2">Description</th>
                                                <th style="width: 10%">Price</th>
                                                <th style="width: 15%">Sub-Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $count = 0;
                                                $gtotal = 0;
                                                $rv = 0;
                                                $wv = 0;
                                                foreach($purchase_model->getPurchaseItems($ap['purchase_id']) as $pitems){
                                                $gtotal += ($pitems['quantity'] * $pitems['price']);
                                                $count += $pitems['quantity'];
                                                $rv += ($pitems['quantity'] * $pitems['retail_price']);
                                                $wv += ($pitems['quantity'] * $pitems['wholesale_price']);
                                            ?>
                                            <tr>
                                                <td class="align-middle text-center"><?= $pitems['quantity'];?></td>
                                                <td class="align-middle" style="width: 1%;">
                                                    
                                                </td>
                                                <td class="align-middle"><?= $pitems['name'];?></td>
                                                <td class="text-right align-middle"><?php echo number_format($pitems['price'], 2); ?></td>
                                                <td class="text-right align-middle"><?= number_format($pitems['quantity'] * $pitems['price'], 2); ?></td>
                                            </tr>
                                            <?php
                                                }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td class="text-center"><?= $count; ?></td>
                                                <td class="text-right" colspan="3">Grand Total</td>
                                                <td class="text-right"><?= number_format($gtotal, 2); ?></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                
                                    <div class="row mg-b-30">
                                        <div class="col-lg-6 tx-24">Retail Value: <?= number_format($rv, 2) ?></div>
                                        <div class="col-lg-6 tx-24">Wholesale Value: <?= number_format($wv, 2) ?></div>
                                    </div>

                                    <!-- END OF TABLE VIEW FOR PURCHASE ITEM INFORMATION -->
                                </div>
                                <div class="modal-footer">
                                    <?= form_open("markpending/".str_ireplace(['/','+'],['~','$'],$encrypter->encrypt($ap['purchase_id'])))?>
                                        <button type="submit" class="btn btn-danger">Mark Pending</button>
                                    <?= form_close()?>
                                    <?= form_open("markdelivered/".str_ireplace(['/','+'],['~','$'],$encrypter->encrypt($ap['purchase_id'])))?>
                                        <button type="submit" class="btn btn-success">Mark Delivered</button>
                                    <?= form_close()?>
                                    <?= form_open("markcancelled/".str_ireplace(['/','+'],['~','$'],$encrypter->encrypt($ap['purchase_id'])))?>
                                        <button type="submit" class="btn btn-warning">Mark Cancelled</button>
                                    <?= form_close()?>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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