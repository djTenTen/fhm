<?php 
    $encrypter = \Config\Services::encrypter();
?>
<div class="container">

    <?php
        // Message thrown from the controller
        if(!empty($_SESSION['stocktransfer_added'])){
            echo '<div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Stock Transfer Registration Success!</h4>
            <p>Stock Transfer has been successfully registered</p>
        </div>';
            unset($_SESSION['stocktransfer_added']);
        }
    ?>

    <h1>Add Stock Transfer</h1>

    <div id="add-stock-transfer-page">
        <?= form_open("stocktransfer/save");?>

            <div class="row">
                <div class="col-lg-3">
 
                    <div class="form-group">
                        <label class="col-form-label">Item Name / SKU / Barcode</label>
                        <input class="form-control disable-enter" type="text" id="item-search" value="" required autofocus>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label">Transfer From</label>
                        <select name="warehouse-from" class="custom-select" required>
                            <option value="" selected>Select Warehouse</option>
                            <!-- FETCH DATA FROM MODEL -->
                            <?php foreach($warehouse as $whf){?>
                                <option value="<?= $encrypter->encrypt($whf['warehouse_id'])?>"><?= $whf['name'];?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label">Transfer To</label>
                        <select name="warehouse-to" class="custom-select" required>
                            <option value="" selected>Select Warehouse</option>
                            <!-- FETCH DATA FROM MODEL -->
                            <?php foreach($warehouse as $wht){?>
                                <option value="<?= $encrypter->encrypt($wht['warehouse_id'])?>"><?= $wht['name'];?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary btn-sm mg-r-10">Register Stock Transfer</button>
                
                </div>

                <div class="col-lg-9">
                    <div id="item-list-table" class="table-responsive mb-40">
                        <table class="table table-md table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 1%"></th>
                                    <th class="align-middle" colspan="2" style="width: 70%">Description</th>
                                    <th class="align-middle" style="width: 30%">Quantity</th>
                                    <th style="width: 1%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td class="align-middle text-right" colspan="3">Total</td>
                                    <td data-name="total" class="align-middle text-center">0</td>
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

    });

</script>