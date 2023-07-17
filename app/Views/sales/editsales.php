<?php 
    $encrypter = \Config\Services::encrypter(); // access to the encryptor
?>
<div class="container">

    <h1>Edi Sales</h1>

    <div id="add-sales-page">
        <?= form_open("sales/update/".$sid);?>
            <div class="row">
                <div class="col-lg-3">
                            
                    <div class="form-group">
                        <label class="col-form-label">Item Name / SKU / Barcode</label>
                        <input class="form-control disable-enter" type="text" id="item-search" value="" autofocus>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label">Invoice Number</label>
                        <input value="<?= $sales['invoice_no'];?>" class="form-control" type="text" name="invoice-no" value="" required>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label">Transaction Date</label>
                        <div class="row">
                            <div class="col-4">
                                <select name="mm" class="form-control" required>
                                    <option value="<?= $ddate[1];?>"  selected><?= date("F",mktime(0, 0, 0, $ddate[1], 10));?></option>
                                    <option value="01">January</option>
                                    <option value="02">February</option>
                                    <option value="03">March</option>
                                    <option value="04">April</option>
                                    <option value="05">May</option>
                                    <option value="06">June</option>
                                    <option value="07">July</option>
                                    <option value="08">August</option>
                                    <option value="09">September</option>
                                    <option value="10">October</option>
                                    <option value="11">November</option>
                                    <option value="12">December</option>
                                </select>
                            </div>/

                            <div class="col-3">
                                <select name="dd" class="form-control" required>
                                    <option value="<?= $ddate[2];?>" selected><?= $ddate[2];?></option>
                                    <option value="01">01</option>
                                    <option value="02">02</option>
                                    <option value="03">03</option>
                                    <option value="04">04</option>
                                    <option value="05">05</option>
                                    <option value="06">06</option>
                                    <option value="07">07</option>
                                    <option value="08">08</option>
                                    <option value="09">09</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                    <option value="14">14</option>
                                    <option value="15">15</option>
                                    <option value="16">16</option>
                                    <option value="17">17</option>
                                    <option value="18">18</option>
                                    <option value="19">19</option>
                                    <option value="20">20</option>
                                    <option value="21">21</option>
                                    <option value="22">22</option>
                                    <option value="23">23</option>
                                    <option value="24">24</option>
                                    <option value="25">25</option>
                                    <option value="26">26</option>
                                    <option value="27">27</option>
                                    <option value="28">28</option>
                                    <option value="29">29</option>
                                    <option value="30">30</option>
                                    <option value="31">31</option>
                                </select>
                            </div>/
                            <div class="col-4">
                                <select name="yy" class="form-control" required>
                                    <option value="<?= $ddate[0];?>" selected><?= $ddate[0];?></option>
                                    <option value="2024">2024</option>
                                    <option value="2025">2025</option>
                                    <option value="2026">2026</option>
                                    <option value="2027">2027</option>
                                    <option value="2028">2028</option>
                                    <option value="2029">2029</option>
                                    <option value="2030">2030</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="autocomplete" data-initialize="true" data-source="<?= site_url('getcustomers')?>">
                        <div class="form-group">
                            <label class="col-form-label">Customer</label>
                            <div class="input-group">
                                <input value="<?= $customer['name'];?>" class="form-control" id="customer-search" type="text" name="customer" data-autocomplete-search="true" data-autocomplete-toggle="true" data-autocomplete-force-select="false">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-form-label">Address</label>
                            <div class="input-group">
                                <input value="<?= $customer['address'];?>" class="form-control" type="text" name="address" required="required">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-form-label">Contact Number</label>
                            <div class="input-group">
                                <input value="<?= $customer['contact_number'];?>" class="form-control" type="text" name="contact-number" required="required">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label">Delivery Method</label>
                        <div class="col-form-label">
                            <div class="custom-control custom-radio mr-3 d-inline-block">
                                <input type="radio" id="delivery-method-pickup" name="delivery-method" value="pickup" class="custom-control-input" <?php if($sales['delivery_method']  == 'pickup'){echo 'checked';}?>>
                                <label class="custom-control-label" for="delivery-method-pickup">Pickup</label>
                            </div>

                            <div class="custom-control custom-radio d-inline-block">
                                <input type="radio" id="delivery-method-delivery" name="delivery-method" value="delivery" class="custom-control-input" <?php if($sales['delivery_method']  == 'delivery'){echo 'checked';}?>>
                                <label class="custom-control-label" for="delivery-method-delivery">Delivery</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label">Official Receipt</label>
                        <div class="col-form-label">
                            <div class="custom-control custom-radio mr-3 d-inline-block">
                                <input type="radio" id="official-receipt-yes" name="official-receipt" value="yes" class="custom-control-input" <?php if($sales['official_receipt']  == 'yes'){echo 'checked';}?>>
                                <label class="custom-control-label" for="official-receipt-yes">Yes</label>
                            </div>

                            <div class="custom-control custom-radio d-inline-block">
                                <input type="radio" id="official-receipt-no" name="official-receipt" value="no" class="custom-control-input" <?php if($sales['official_receipt']  == 'no'){echo 'checked';}?>>
                                <label class="custom-control-label" for="official-receipt-no">No</label>
                            </div>
                        </div>
                        <div class="input-group">
                            <input value="<?= $sales['official_receipt_no'];?>" class="form-control" type="number" name="official-receipt-no" value="" required="required" <?php if($sales['official_receipt']  == 'disabled'){echo 'checked';}?>>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Warehouse</label>
                        <select name="warehouse" class="custom-select" required>
                            <option value="<?= $encrypter->encrypt($sales['warehouse_id']);?>" selected><?= $sales['warehouse'];?></option>
                            <!-- FETCH DATA FROM CONTROLLER -->
                            <?php foreach($warehouse as $wh){?>
                                <option value="<?= $encrypter->encrypt($wh['warehouse_id'])?>"><?= $wh['name'];?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label">Payment Terms</label>
                        <select name="payment-method" class="custom-select" required>
                            <option value="<?= $sales['payment_method']?>" selected><?= str_replace("-", " ", $sales['payment_method']);?></option>
                            <!-- FETCH DATA FROM CONTROLLER -->
                            <?php foreach($paymentmethod as $pm){ ?>
                            <option value="<?= $pm['name'];?>"><?= ucwords(str_replace("-", " ", $pm['name'])); ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary mr-2">Update Sales</button>
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
                                <?php 
                                    $count = 0;
                                    $subtotal = 0;
                                    foreach($salesitem as $si){
                                        $subtotal += ($si['quantity'] * $si['price']);
                                        $count += $si['quantity'];
                                ?>
                                <tr>
                                    <td class="align-middle">
                                        <input type="hidden" name="sales-item[]" value="<?= $encrypter->encrypt($si['sales_item_id']); ?>">
                                        <input type="hidden" name="item[]" value="<?= $encrypter->encrypt($si['item_id']); ?>">
                                        <input class="form-control text-center" type="number" name="quantity[]" value="<?= $si['quantity']; ?>" min="0" style="min-width: 100px;" required>
                                    </td>
                                    <td class="align-middle" style="width: 1%;">
                                        
                                    </td>
                                    <td class="align-middle"><?= $si['name']; ?></td>
                                    <td class="align-middle"><input class="form-control text-center" type="number" name="price[]" value="<?= $si['price']; ?>" min="0" step="0.01" style="min-width: 120px;" required></td>
                                    <td data-name="total" class="align-middle"><?php echo number_format($si['quantity'] * $si['price'], 2); ?></td>
                                    <td class="align-middle"><button class="btn btn-danger btn-sm btn-icon remove" type="button" data-action="remove"><i class="fas fa-times"></i></button></td>
                                </tr>
                                <?php }?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td class="text-center" data-name="item-count"><?= $count;?></td>
                                    <td class="text-right" colspan="3">Subtotal</td>
                                    <td data-name="subtotal"><?= $subtotal;?></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="text-right align-middle" colspan="4">Delivery Fee</td>
                                    <td>
                                        <input value="<?= $sales['delivery_fee'];?>" class="form-control" type="number" name="delivery-fee" required="required" disabled value="0">
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="text-right align-middle" colspan="4">Grand Total</td>
                                    <td data-name="grand-total"><?= $subtotal + $sales['delivery_fee'];?></td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </form>		
    </div>

</div>


<script>
  

    $(document).ready(function(e){
        
        $("#item-search").autocomplete({
            source: "<?= site_url('getitem');?>"
        });

        $("#customer-search").autocomplete({
            source: "<?= site_url('getcustomers');?>"
        });

    });

</script>