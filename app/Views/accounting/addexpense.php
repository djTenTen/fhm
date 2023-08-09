<?php
    $encrypter = \Config\Services::encrypter();
?>

<div class="container">

    <?php
        // Message thrown from the controller
        if(!empty($_SESSION['expense_added'])){
            echo '<div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Expense Added Successfully!</h4>
            <p>Expense has been successfully added</p>
        </div>';
            unset($_SESSION['expense_added']);
        }
        
    ?>

    <h1>Add Expense</h1>

    <div id="add-expense-page">
        <?= form_open("expense/save");?>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" value="" required autofocus>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Date</label>
                        <div class="col-sm-10">
                            <div class="row">
                                <div class="col-4">
                                    <select name="mme" class="form-control" required>
                                        <option value="<?= date("m")?>" selected><?= date("F")?></option>
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
                                    <select name="dde" class="form-control" required>
                                        <option value="<?= date("d")?>" selected><?= date("d")?></option>
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
                                    <select name="yye" class="form-control" required>
                                        <option value="<?= date("Y")?>" selected><?= date("Y")?></option>
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
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Remarks</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="remarks" rows="5"></textarea>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 mg-t-20">
                    <div class="mg-b-20 table-repeater">
                        <table class="table table-bordered" data-max-row="12">
                            <thead>
                                <tr>
                                    <th style="width: 30%;">Category</th>
                                    <th style="width: 35%;">Description</th>
                                    <th style="width: 35%;">Amount</th>
                                    <th style="width: 1%;"></th>
                                </tr>
                            </thead>
                            <tbody id="texpense">
                                <tr>
                                    <td>
                                        <select name="expense-category[]" class="custom-select" required>
                                            <option value="">Select Expense Category</option>
                                            <?php foreach($category as $cate){?>
                                                <option value="<?= $encrypter->encrypt($cate['expense_category_id']);?>"><?= $cate['name']?></option>
                                            <?php }?>
                                        </select>
                                    </td>
                                    <td><input class="form-control" type="text" name="expense-description[]" value="" required></td>
                                    <td><input class="form-control" type="text" name="expense-amount[]" value="" required></td>
                                    <td><button class="btn btn-icon btn-danger btn-xs" type="button" data-action="remove"><i class="fas fa-times"></i></button></td>
                                </tr>
                            </tbody>
                        </table>

                        <button class="btn btn-primary float-right" type="button" id="addreserveitem">Add Row</button>
                    </div>
                </div>

                <div id="payment-method-form" class="col-lg-12">
                    <div class="mg-b-20 table-repeater">
                        <h5 class="mg-b-15">Payment Details</h5>

                        <table class="table table-bordered" data-max-row="12">
                            <thead>
                                <tr>
                                    <th style="width: 30%;">Payment Method</th>
                                    <th style="width: 35%;">Description / Date</th>
                                    <th style="width: 35%;">Amount</th>
                                    <th style="width: 1%;"></th>
                                </tr>
                            </thead>
                            <tbody id="tpaymentdetails">
                                <tr>
                                    <td>
                                        <select name="payment-method[]" class="custom-select">
                                            <option value="">Select Payment Method</option>
                                            <?php foreach($paymentmethod as $pm){ ?>
                                                <option value="<?= $pm['name'];?>"><?= ucwords(str_replace("-", " ", $pm['name'])); ?></option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                    <td data-name="description">

                                        <div class="row">
                                            <div class="col-4">
                                                <select name="mmp[]" class="form-control" required>
                                                    <option value="<?= date("m")?>" selected><?= date("F")?></option>
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
                                                <select name="ddp[]" class="form-control" required>
                                                    <option value="<?= date("d")?>" selected><?= date("d")?></option>
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
                                                <select name="yyp[]" class="form-control" required>
                                                    <option value="<?= date("Y")?>" selected><?= date("Y")?></option>
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

                                        <div data-name="check" class="d-none mg-t-5">

                                            <div class="mg-b-10">
                                                <label>Bank Account</label>
                                                <select name="payment-bank-account[]" class="form-control">
                                                    <option value="">Select Bank</option>
                                                    <?php foreach($bank as $bk){?>
                                                        <option value="<?= $encrypter->encrypt($bk['bank_account_id']);?>"><?= $bk['name']?></option>
                                                    <?php }?>
                                                </select>
                                            </div>

                                            <div class="mg-b-10">
                                                <label>Payee</label>
                                                <input type="text" class="form-control" name="payment-check-payee[]" value="">
                                            </div>

                                            <div class="mg-b-10">
                                                <label>Check Number</label>
                                                <input type="text" class="form-control" name="payment-check-number[]" value="">
                                            </div>
                                        </div>

                                    </td>
                                    <td><input class="form-control" type="text" name="payment-amount[]" value="" required></td>
                                    <td><button class="btn btn-icon btn-danger btn-xs remove" type="button" data-action="remove"><i class="fas fa-times"></i></button></td>
                                </tr>
                            </tbody>
                        </table>

                        <button class="btn btn-primary float-right" type="button" id="addpaymentdetails">Add Row</button>
                    </div>
                </div>
            </div>

            <button type="submit" name="save" class="btn btn-primary mr-2">Register Expense</button>
        <?= form_close();?>
    </div>

</div>



<script>
    $(document).ready(function () {

        // Denotes total number of rows
        var rowIdx1 = 0;
        // jQuery button click event to add a row
        $('#addreserveitem').on('click', function () {
            // Adding a row inside the tbody.
            $('#texpense').append(`<tr>
                <td>
                    <select name="expense-category[]" class="custom-select" required>
                        <option value="">Select Expense Category</option>
                        <?php foreach($category as $cate){?>
                            <option value="<?= $encrypter->encrypt($cate['expense_category_id']);?>"><?= $cate['name']?></option>
                        <?php }?>
                    </select>
                </td>
                <td><input class="form-control" type="text" name="expense-description[]" value="" required></td>
                <td><input class="form-control" type="text" name="expense-amount[]" value="" required></td>
                <td><button class="btn btn-icon btn-danger btn-xs remove" type="button" data-action="remove"><i class="fas fa-times"></i></button></td>
            </tr>`);
        });

        // jQuery button click event to remove a row.
        $('#texpense').on('click', '.remove', function () {
            var child = $(this).closest('tr').nextAll();
            child.each(function () {
            var id = $(this).attr('id');
            var idx = $(this).children('.row-index').children('p');
            var dig = parseInt(id.substring(1));
            idx.html(`Row ${dig - 1}`);
            $(this).attr('id', `R${dig - 1}`);
            });
            $(this).closest('tr').remove();
            rowIdx1--;
        });


        // Denotes total number of rows
        var rowIdx2 = 0;
        // jQuery button click event to add a row
        $('#addpaymentdetails').on('click', function () {
            // Adding a row inside the tbody.
            $('#tpaymentdetails').append(`<tr>
                <td>
                    <select name="payment-method[]" class="custom-select">
                        <option value="">Select Payment Method</option>
                        <?php foreach($paymentmethod as $pm){ ?>
                            <option value="<?= $pm['name'];?>"><?= ucwords(str_replace("-", " ", $pm['name'])); ?></option>
                        <?php } ?>
                    </select>
                </td>
                <td data-name="description">
                    <div class="row">
                        <div class="col-4">
                            <select name="mmp[]" class="form-control" required>
                                <option value="<?= date("m")?>" selected><?= date("F")?></option>
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
                            <select name="ddp[]" class="form-control" required>
                                <option value="<?= date("d")?>" selected><?= date("d")?></option>
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
                            <select name="yyp[]" class="form-control" required>
                                <option value="<?= date("Y")?>" selected><?= date("Y")?></option>
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


                    <div data-name="check" class="d-none mg-t-5">
                        <div class="mg-b-10">
                            <label>Bank Account</label>
                            <select name="payment-bank-account[]" class="form-control">
                                <option value="">Select Bank</option>
                                <?php foreach($bank as $bk){?>
                                    <option value="<?= $encrypter->encrypt($bk['bank_account_id']);?>"><?= $bk['name']?></option>
                                <?php }?>
                            </select>
                        </div>
                        <div class="mg-b-10">
                            <label>Payee</label>
                            <input type="text" class="form-control" name="payment-check-payee[]" value="">
                        </div>
                        <div class="mg-b-10">
                            <label>Check Number</label>
                            <input type="text" class="form-control" name="payment-check-number[]" value="">
                        </div>
                    </div>
                </td>
                <td><input class="form-control" type="text" name="payment-amount[]" value="" required></td>
                <td><button class="btn btn-icon btn-danger btn-xs remove" type="button" data-action="remove"><i class="fas fa-times"></i></button></td>`);
        });

        // jQuery button click event to remove a row.
        $('#tpaymentdetails').on('click', '.remove', function () {
            var child = $(this).closest('tr').nextAll();
            child.each(function () {
            var id = $(this).attr('id');
            var idx = $(this).children('.row-index').children('p');
            var dig = parseInt(id.substring(1));
            idx.html(`Row ${dig - 1}`);
            $(this).attr('id', `R${dig - 1}`);
            });
            $(this).closest('tr').remove();
            rowIdx1--;
        });



    });
</script>