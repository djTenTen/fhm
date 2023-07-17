<div class="container">

    <?php
        // Message thrown from the controller
        if(!empty($_SESSION['quotation_added'])){
            echo '<div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Quotation Registration Success!</h4>
            <p>Quotation has been successfully registered</p>
        </div>';
            unset($_SESSION['quotation_added']);
        }  
    ?>

    <h1>Add Quotation</h1>


    <div id="add-quotation-page">
        <?= form_open("quotation/register");?>
            <div class="row">
                <div class="col-lg-4">
                    
                    <div class="form-group">
                        <label class="col-form-label">Item Name / SKU / Barcode</label>
                        <input class="form-control disable-enter" type="text" id="item-search" value="" required autofocus>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label">Customer</label>
                        <div class="input-group">
                            <input id="customer-search" class="form-control" type="text" name="name" required="required">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label">Address</label>
                        <div class="input-group">
                            <input class="form-control" type="text" name="address">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label d-block">Custom Header</label>
                        <div class="tinymce"><textarea name="custom-header"></textarea></div>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label d-block">Custom Footer</label>
                        <div class="tinymce"><textarea name="custom-footer"></textarea></div>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label">Remark</label>
                        <textarea name="remarks" class="form-control" rows="5"></textarea>
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary mg-r-10">Add Quotation</button>
                    
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
                                    <td><input class="form-control" type="number" name="discount" value=""></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="text-right align-middle" colspan="4">Delivery Fee</td>
                                    <td><input class="form-control" type="number" name="delivery-fee" value=""></td>
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
