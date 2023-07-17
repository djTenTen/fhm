<?php
    $encrypter = \Config\Services::encrypter();
    $sales_model = new \App\Models\Sales_model; // to access the item_model
?>
<div class="contianer">


    <?php
        // Message thrown from the controller
        if(!empty($_SESSION['reservation_added'])){
            echo '<div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Reservation Registration Success!</h4>
            <p>Reservation has been successfully registered</p>
        </div>';
            unset($_SESSION['reservation_added']);
        }
    ?>

    <h1>Add Reservation</h1>

    <div id="add-reservation-page">
        <?= form_open("reservation/register");?>
            <div class="row">
                <div class="col-lg-3">

                    <div class="form-group">
                        <label class="col-form-label">Item Name / SKU / Barcode</label>
                        <input class="form-control disable-enter" type="text" id="item-search" value="" required autofocus>
                    </div>

                    <div class="autocomplete" data-initialize="true" data-source="<?= site_url('getcustomers')?>">
                        <div class="form-group">
                            <label class="col-form-label">Customer</label>
                            <div class="input-group">
                                <input class="form-control" id="customer-search" type="text" name="customer" data-autocomplete-search="true" data-autocomplete-toggle="true" data-autocomplete-force-select="false" required="required">
                                <input type='hidden' name="customer-id" value="" required="required">
                                <div class="input-group-append button">
                                    <span class="input-group-text"><i class="fas fa-times"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-form-label">Address</label>
                            <div class="input-group">
                                <input class="form-control" type="text" name="address" required="required">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-form-label">Contact Number</label>
                            <div class="input-group">
                                <input class="form-control" type="text" name="contact-number" required="required">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label">Delivery Date</label>
                        <div class="row">
                            <div class="col-4">
                                <select name="mm" class="form-control" required>
                                    <option value="" >Month</option>
                                    <option value="01">January</option>
                                    <option value="02">February</option>
                                    <option value="03">March</option>
                                    <option value="04">April</option>
                                    <option value="05">May</option>
                                    <option value="06" selected>June</option>
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
                                    <option value="" selected>Day</option>
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
                                    <option value="2023" selected>2023</option>
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

                    <div class="form-group">
                        <label class="col-form-label">Delivery Method</label>
                        <div class="col-form-label">
                            <div class="custom-control custom-radio mr-3 d-inline-block">
                                <input type="radio" id="delivery-method-pickup" name="delivery-method" value="pickup" class="custom-control-input" checked="">
                                <label class="custom-control-label" for="delivery-method-pickup">Pickup</label>
                            </div>

                            <div class="custom-control custom-radio d-inline-block">
                                <input type="radio" id="delivery-method-delivery" name="delivery-method" value="delivery" class="custom-control-input">
                                <label class="custom-control-label" for="delivery-method-delivery">Delivery</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label">Warehouse</label>
                        <select name="warehouse" class="custom-select" required>
                            <option value="" selected>Select Warehouse</option>
                            <!-- FETCH DATA FROM MODEL -->
                            <?php foreach($warehouse as $wh){?>
                                <option value="<?= $encrypter->encrypt($wh['warehouse_id'])?>"><?= $wh['name'];?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label">Remarks</label>
                        <textarea name="remark" class="form-control" rows="5"></textarea>
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary mg-r-10">Add Reservation</button>
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

        $("#customer-search").autocomplete({
            source: "<?= site_url('getcustomers');?>"
        });

    });

</script>