<?php
    $encrypter = \Config\Services::encrypter(); // access to the encryptor
?>
<div class="container">


    <h1>Edit Purchase</h1>

    <div id="add-reservation-page">
        <!-- $pid declared from the Controller -->
        <?= form_open("purchase/update/".$pid);?>
            <div class="row">
                <div class="col-lg-3">
                    <!-- PURCHASE INFORMATION STARTS HERE -->
                    <div class="form-group">
                        <label class="col-form-label">Item Name / SKU / Barcode</label>
                        <input class="form-control disable-enter" type="text" id="item-search" value="" autofocus>
                    </div>
                    <!-- $purchase declared from the controller -->
                    <div class="form-group">
                        <label class="col-form-label">Invoice Number</label>
                        <input value="<?= $purchase['invoice_no']?>" class="form-control" type="text" name="invoice-no" value="" required>
                    </div>
                   
                    <div class="form-group">
                        <label class="col-form-label">Supplier</label>
                        <input value="<?= $purchase['name']?>" class="form-control" id="supplier-search" type="text" name="supplier" required>
                    </div>
                
                    <div class="form-group">
                        <label class="col-form-label">Deliver to:</label>
                        <select name="warehouse" class="custom-select" required>
                            <option value="<?= $encrypter->encrypt($purchase['warehouse_id'])?>" selected><?= $purchase['warehouse']?></option>
                            <!-- FETCH DATA FROM CONTROLLER -->
                            <?php foreach($warehouse as $wh){?>
                                <option value="<?= $encrypter->encrypt($wh['warehouse_id'])?>"><?= $wh['name'];?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label">Payment Method</label>
                        <select name="payment-method" class="custom-select" required>
                            <option value="<?= $purchase['payment_method']?>" selected><?= $purchase['payment_method']?></option>
                            <!-- FETCH DATA FROM CONTROLLER -->
                            <?php foreach($paymentmethod as $pm){ ?>
                            <option value="<?= $pm['name'];?>"><?= ucwords(str_replace("-", " ", $pm['name'])); ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary btn-sm mg-r-10">Update Purchase</button>
                </div>
                <!-- PURCHASE INFORMATION ENDS HERE -->

                <!-- PURCHASE ITEMS STARTS HERE -->
                <div class="col-lg-9">
                    <div id="item-list-table" class="table-responsive mg-b-40">
                        <table class="table table-md table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10%">Quantity</th>
                                    <th style="width: 40%" colspan="2">Description</th>
                                    <th style="width: 20%">Price</th>
                                    <th style="width: 20%">Sub-Total</th>
                                    <th style="width: 1%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $sub = 0;
                                    $count = 0;
                                    foreach($puritems as $items){
                                        $sub += ($items['quantity'] * $items['price']);
                                        $count += $items['quantity'];
                                ?>
                                    <tr data-identifier="">
                                        <td class="align-middle">
                                            <input type="hidden" name="purchase-item[]" value="<?= $encrypter->encrypt($items['purchase_item_id']); ?>">
                                            <input type="hidden" name="item[]" value="<?php echo $encrypter->encrypt($items['item_id']); ?>">
                                            <input class="form-control text-center" type="number" name="quantity[]" value="<?= $items['quantity']; ?>" min="0" style="min-width: 100px;" required>
                                        </td>
                                        <td class="align-middle">
                                            
                                        </td>
                                        <td class="align-middle"><?= $items['name']; ?></td>
                                        <td class="align-middle"><input class="form-control text-center" type="number" name="price[]" value="<?= $items['price']; ?>" min="0" step="0.01" style="min-width: 120px;" required></td>
                                        <td data-name="total" class="align-middle"><?= number_format($sub, 2); ?></td>
                                        <td class="align-middle"><button class="btn btn-icon btn-danger btn-xs remove" type="button" data-action="remove"><i class="fas fa-times"></i></button></td>
                                    </tr>
                                <?php }?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td class="text-center" data-name="item-count"><?= $count;?></td>
                                    <td class="text-right" colspan="3">Subtotal</td>
                                    <td data-name="subtotal"><?= number_format($sub,2);?></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="text-right align-middle" colspan="4">Grand Total</td>
                                    <td data-name="grand-total"><?= number_format($sub,2);?></td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <!-- PURCHASE ITEMS ENDS HERE -->
            </div>
        <?= form_close();?>
    </div>

</div>

<script>
  

    $(document).ready(function(e){
        
        $("#item-search").autocomplete({
            source: "<?= site_url('getitem');?>"
        });

        $("#supplier-search").autocomplete({
            source: "<?= site_url('getsupplier');?>"
        });

    });

</script>