<?php 
    $encrypter = \Config\Services::encrypter();
?>
<div class="container">

    <h1>Edit Quotation</h1>


    <div id="add-quotation-page">
        <?= form_open("quotation/update/".$qid);?>
            <div class="row">
                <div class="col-lg-4">
                    
                    <div class="form-group">
                        <label class="col-form-label">Item Name / SKU / Barcode</label>
                        <input class="form-control disable-enter" type="text" id="item-search" value="" required autofocus>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label">Customer</label>
                        <div class="input-group">
                            <input value="<?= $qdata['customer'];?>" id="customer-search" class="form-control" type="text" name="name" required="required">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label">Address</label>
                        <div class="input-group">
                            <input value="<?= $qdata['address'];?>" class="form-control" type="text" name="address">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label d-block">Custom Header</label>
                        <div class="tinymce"><textarea name="custom-header"><?= $qdata['custom_header'];?></textarea></div>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label d-block">Custom Footer</label>
                        <div class="tinymce"><textarea name="custom-footer"><?= $qdata['custom_footer'];?></textarea></div>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label">Remark</label>
                        <textarea name="remarks" class="form-control" rows="5"><?= $qdata['remarks'];?></textarea>
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary mg-r-10">Update Quotation</button>
                
                </div>

                <div class="col-lg-8">
                    <div id="item-list-table" class="table-responsive mb-40">
                        <table class="table table-md table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10%">Quantity</th>
                                    <th style="width: 60%" colspan="2">Description</th>
                                    <th style="width: 15%">Price</th>
                                    <th style="width: 15%">Sub-Total</th>
                                    <th style="width: 1%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- DISPLAY ALL THE ITEMS BASED ON THE QUOTATION -->
                            <?php foreach($item as $row){?>
                                <tr>
                                    <td class="align-middle text-center">
                                        <input type="hidden" name="quotation-item[]" value="<?= $encrypter->encrypt($row['quotation_item_id']); ?>">
                                        <input type="hidden" name="item[]" value="<?= $encrypter->encrypt($row['item_id']); ?>">
                                        <input class="form-control text-center" type="number" name="quantity[]" value="<?= $row['quantity'] ?>" min="0" style="min-width: 100px;" required>
                                    </td>
                                    <td class="align-middle" style="width: 1%;">
                                        
                                    </td>
                                    <td class="align-middle"><?= $row['name']; ?></td>
                                    <td class="align-middle"><input class="form-control text-center" type="number" name="price[]" value="<?= $row['price']; ?>" min="0" step="0.01" style="min-width: 120px;" required=""></td>
                                    <td class="align-middle"><?php echo number_format(0, 2); ?></td>
                                    <td class="align-middle">
                                        <button class="btn btn-icon btn-danger btn-xs remove" type="button" data-action="remove"><i class="fas fa-times" aria-hidden="true"></i></button>
                                    </td>
                                </tr>
                            <?php }?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td class="text-center" data-name="item-count">0</td>
                                    <td class="text-right" colspan="3">Subtotal</td>
                                    <td data-name="subtotal">0.00</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="text-right align-middle" colspan="4">Discount</td>
                                    <td><input class="form-control" type="number" name="discount" value="<?= $qdata['discount'];?>"></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="text-right align-middle" colspan="4">Delivery Fee</td>
                                    <td><input class="form-control" type="number" name="delivery-fee" value="<?= $qdata['delivery_fee'];?>"></td>
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


<script type="text/javascript">
  

    $(document).ready(function(e){
        
        $("#item-search").autocomplete({
            source: "<?= site_url('getitem');?>"
        });

        $("#customer-search").autocomplete({
            source: "<?= site_url('getcustomers');?>"
        });

    });

    tinymce.init({
		selector: 'textarea.tinymce',
		height: 300,
		resize: false,
		force_br_newlines : true,
		force_p_newlines : false,
	});

</script>
