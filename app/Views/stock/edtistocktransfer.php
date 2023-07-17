<?php 
    $encrypter = \Config\Services::encrypter();
    $inventory_model = new \App\Models\Inventory_model; // to access the inventory_model
    $whfs = $inventory_model->getwarehousename($st['transfer_from']);
    $whts = $inventory_model->getwarehousename($st['transfer_to']);
?>
<div class="container">

    <h1>Edit Stock Transfer</h1>

    <div id="add-stock-transfer-page">
        <?= form_open("stocktransfer/update/".$stid);?>

            <div class="row">
                <div class="col-lg-3">
 
                    <div class="form-group">
                        <label class="col-form-label">Item Name / SKU / Barcode</label>
                        <input class="form-control disable-enter" type="text" id="item-search" value="" autofocus>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-form-label">Transfer From</label>
                        <select name="warehouse-from" class="custom-select" required>
                            <option value="<?= $encrypter->encrypt($st['transfer_from'])?>" selected><?= $whfs['name'];?></option>
                            <!-- FETCH DATA FROM MODEL -->
                            <?php foreach($warehouse as $whf){?>
                                <option value="<?= $encrypter->encrypt($whf['warehouse_id'])?>"><?= $whf['name'];?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label">Transfer To</label>
                        <select name="warehouse-to" class="custom-select" required>
                            <option value="<?= $encrypter->encrypt($st['transfer_to'])?>" selected><?= $whts['name'];?></option>
                                <!-- FETCH DATA FROM MODEL -->
                                <?php foreach($warehouse as $wht){?>
                                    <option value="<?= $encrypter->encrypt($wht['warehouse_id'])?>"><?= $wht['name'];?></option>
                                <?php } ?>
                            </select>
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary btn-sm mg-r-10">Update Stock Transfer</button>
                
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
                                <?php 
                                    $count = 0;
                                    foreach($item as $itm){
                                    $count += $itm['quantity'];
                                ?>
                                    <tr>
                                        <td class="align-middle text-center"><?= $itm['quantity'];?></td>
                                        <td class="align-middle" style="width: 1%;">
                                            
                                        </td>
                                        <td class="align-middle">
                                            <input type="hidden" name="stock-transfer[]" value="<?= $encrypter->encrypt($itm['stock_transfer_item_id']); ?>">
                                            <input type="hidden" name="item[]" value="<?= $encrypter->encrypt($itm['item_id']); ?>">
                                            <?php echo $itm['name']; ?>
                                        </td>
                                        <td class="align-middle"><input class="form-control text-center" type="number" name="quantity[]" value="<?= $itm['quantity'];?>" min="0" style="min-width: 120px;" required=""></td>
                                        <td class="align-middle">
                                            
                                        </td>
                                    </tr>
                                <?php }?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td class="align-middle text-right" colspan="3">Total</td>
                                    <td data-name="total" class="align-middle text-center"><?= $count;?></td>
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