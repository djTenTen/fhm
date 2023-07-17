<?php
    $encrypter = \Config\Services::encrypter(); // access to the encryptor
?>
<div class="contianer">

    <?php
        // Message thrown from the controller
        if(!empty($_SESSION['purchase_added'])){
            echo '<div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Purchase Registration Success!</h4>
            <p>Purchase has been successfully registered</p>
        </div>';
            unset($_SESSION['purchase_added']);
        }        
    ?>

    <h1>Add Purchase</h1>

    <div id="add-reservation-page">
        <?= form_open("purchase/register");?>
            <div class="row">
                <div class="col-lg-3">

                    <div class="form-group">
                        <label class="col-form-label">Item Name / SKU / Barcode</label>
                        <input class="form-control disable-enter" type="text" id="item-search" value="" required autofocus>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label">Invoice Number</label>
                        <input class="form-control" type="text" name="invoice-no" value="" required>
                    </div>
                   
                    <div class="form-group">
                        <label class="col-form-label">Supplier</label>
                        <input class="form-control" id="supplier-search" type="text" name="supplier" required>
                    </div>
                
                    <div class="form-group">
                        <label class="col-form-label">Deliver to:</label>
                        <select name="warehouse" class="custom-select" required>
                            <option value="" selected>Select Warehouse</option>
                            <!-- FETCH DATA FROM CONTROLLER -->
                            <?php foreach($warehouse as $wh){?>
                                <option value="<?= $encrypter->encrypt($wh['warehouse_id'])?>"><?= $wh['name'];?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label">Payment Method</label>
                        <select name="payment-method" class="custom-select" required>
                            <option value="" selected>Select Payment Method</option>
                            <!-- FETCH DATA FROM CONTROLLER -->
                            <?php foreach($paymentmethod as $pm){ ?>
                            <option value="<?= $pm['name'];?>"><?= ucwords(str_replace("-", " ", $pm['name'])); ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary btn-sm mg-r-10">Add Purchase</button>
                </div>

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
                                
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td class="text-center" data-name="item-count">0</td>
                                    <td class="text-right" colspan="3">Subtotal</td>
                                    <td data-name="subtotal">0.00</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="text-right align-middle" colspan="4">Delivery Fee</td>
                                    <td>
                                        <input class="form-control" type="number" name="delivery-fee" required="required" disabled value="0">
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="text-right align-middle" colspan="4">Grand Total</td>
                                    <td data-name="grand-total">0.00</td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
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