<?php
    $sales_model = new \App\Models\Sales_model; // to access the sales_model
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
        if(!empty($_SESSION['sales_updated'])){
            echo '<div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Update Success!</h4>
            <p>Sales has been successfully Updated</p>
        </div>';
            unset($_SESSION['sales_updated']);
        }
        if(!empty($_SESSION['sales_delivered'])){
            echo '<div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Update Success!</h4>
            <p>Sales has been successfully set to Delivered</p>
        </div>';
            unset($_SESSION['sales_delivered']);
        }
        if(!empty($_SESSION['sales_cancelled'])){
            echo '<div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Update Success!</h4>
            <p>Sale has been successfully set to Cancelled</p>
        </div>';
            unset($_SESSION['sales_cancelled']);
        }
        if(!empty($_SESSION['sales_missing'])){
            echo '<div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Update Success!</h4>
            <p>Sales has been successfully set to Missing</p>
        </div>';
            unset($_SESSION['sales_missing']);
        }
    ?>
    
    <h1><?= $stats; ?> Sales</h1>



    <table class="table table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Invoice No.</th>
                <th>Warehouse</th>
                <th>Customer</th>
                <th>Subtotal</th>
                <th>Date</th>
                <th>Status</th>
                <th>Payment</th>
                <th>Added By</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                foreach($sales as $as){
                    $sub = $sales_model->getSubtotalSales($as['sales_id']);
            ?>
            <tr>
                <td><?= $as['sales_id'];?></td>
                <td><?= $as['invoice_no'];?></td>
                <td><?= $as['warehouse'];?></td>
                <td><?= $as['customer'];?></td>
                <td><?= number_format($sub['subtotal'], 2);?></td>
                <td><?= $as['invoice_date'];?></td>
                <td><span class="badge badge-<?php if($as['status'] == 'delivered'){echo 'success';}elseif($as['status'] == 'cancelled'){echo 'warning';}elseif($as['status'] == 'missing'){echo 'danger';}?>"><?= str_replace("-", " ", ucwords($as['status'])); ?></span></td>
                <td><span class="badge badge-<?php if($as['payment_status'] == 'unpaid'){echo 'danger';}else{echo 'success';}?>"><?= ucwords($as['payment_status']);?></span></td>
                <td><?= $as['nameuser'];?></td>
                <td>
                    <div class="btn-group">
                        <button type="button" class="btn btn-success btn-icon btn-sm" data-toggle="modal" data-target="#modalview<?= $as['sales_id']; ?>"><i class="fas fa-eye"></i></button>
                        <?php if(in_array('edit-sales', $arr)){?>
                            <a href="<?= site_url().'sales/edit/'.str_ireplace(['/','+'],['~','$'],$encrypter->encrypt($as['sales_id'])); ?>/<?= str_ireplace(['/','+'],['~','$'],$encrypter->encrypt($as['customer_id']));?>" class="btn btn-primary btn-icon btn-sm"><i class="fas fa-edit"></i></a>
                        <?php }?>
                    </div>

                        <!-- MODAL VIEW -->
                    <div class="modal fade" id="modalview<?= $as['sales_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Purchase</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <table class="table table-bordered mb-4">
                                    <tbody>
                                        <tr>
                                            <td style="width: 20%">ID</td>
                                            <td style="width: 30%"><?= $as['sales_id']; ?></td>

                                            <td style="width: 20%">Status</td>
                                            <td style="width: 30%"><span class="badge badge-<?php if($as['status'] == 'delivered'){echo 'success';}elseif($as['status'] == 'cancelled'){echo 'warning';}elseif($as['status'] == 'missing'){echo 'danger';}?>"><?= str_replace("-", " ", ucwords($as['status'])); ?></span></td>
                                        </tr>
                                        <tr>
                                            <td>Invoice No.</td>
                                            <td><?= $as['invoice_no']; ?></td>
                                            <td>Invoice Date</td>
                                            <td><?= $as['invoice_date'];?></td>
                                        </tr>
                                        <tr>
                                            <td>Official Receipt</td>
                                            <td><?= $as['official_receipt'];?></td>
                                            <td>Official Receipt No.</td>
                                            <td><?= $as['official_receipt_no']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Warehouse</td>
                                            <td><?= $as['warehouse']; ?></td>
                                            <td>Payment Status</td>
                                            <td><span class="badge badge->"><?= ucwords($as['payment_status']); ?></span></td>
                                        </tr>
                                        <tr>
                                            <td>Customer</td>
                                            <td><?= $as['customer']; ?></td>
                                            <td>Delivery Method</td>
                                            <td><?= ucwords($as['delivery_method']); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Address</td>
                                            <td colspan="3"><?= $as['address']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Contact Number</td>
                                            <td colspan="3"><?= $as['contact_number']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Added By</td>
                                            <td><?= $as['nameuser']; ?></td>

                                            <td>Added On</td>
                                            <td><?= $as['added_on']; ?></td>
                                        </tr>
                                        
                                    </tbody>
                                </table>
                            
                                <table class="table table-bordered mb-4">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 10%">Quantity</th>
                                            <th class="text-center" style="width: 55%" colspan="2">Description</th>
                                            <th class="text-center" style="width: 10%">Price</th>
                                            <th class="text-center" style="width: 15%">Sub-Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $count = 0;
                                            $subtotal = 0;
                                            foreach($sales_model->getSalesItem($as['sales_id']) as $item){
                                            $count += $item['quantity'];
                                        ?>
                                        <tr>
                                            <td class="align-middle text-center"><?= $item['quantity'];?></td>
                                            <td style="width: 1%;">
                                                
                                            </td>
                                            <td class="align-middle"><?= $item['name'];?></td>
                                            <td class="align-middle text-right"><?= number_format($item['price'], 2); ?></td>
                                            <td class="align-middle text-right"><?= number_format($item['quantity'] * $item['price'], 2); ?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td class="text-center"><?= $count; ?></td>
                                            <td class="text-right" colspan="3">Subtotal</td>
                                            <td class="text-right"><?= number_format($sub['subtotal'], 2); ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" class="text-right">Delivery Fee</td>
                                            <td class="text-right"><?= number_format($as['delivery_fee'], 2); ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" class="text-right">Grand Total</td>
                                            <td class="text-right"><?= number_format(($as['delivery_fee'] + $sub['subtotal']), 2); ?></td>
                                        </tr>
                                    </tfoot>
                                </table>
                                
                                
                            </div>
                            <div class="modal-footer">

                                <?= form_open("sales/markdeliveredsales/".str_ireplace(['/','+'],['~','$'],$encrypter->encrypt($as['sales_id'])))?>
                                    <button type="submit" class="btn btn-primary">Mark Delivered</button>
                                <?= form_close()?>
                                <?= form_open("sales/markcancelledsales/".str_ireplace(['/','+'],['~','$'],$encrypter->encrypt($as['sales_id'])))?>
                                    <button type="submit" class="btn btn-warning">Mark Cancelled</button>
                                <?= form_close()?>
                                <?= form_open("sales/markmissingsales/".str_ireplace(['/','+'],['~','$'],$encrypter->encrypt($as['sales_id'])))?>
                                    <button type="submit" class="btn btn-danger">Mark Missing</button>
                                <?= form_close()?>
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

