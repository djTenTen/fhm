<div class="container">

    <h1>Add Payment</h1>

    <?= form_open("payment/save")?>
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">Name</label>
                    <div class="col-md-10">
                        <input class="form-control" type="text" name="name" value="" required="">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-2 col-form-label">Type</label>
                    <div class="col-md-10 col-form-label">
                        <div class="custom-control custom-radio mr-3 d-inline-block">
                            <input type="radio" id="type-purchase" name="type" value="purchase" class="custom-control-input typefind">
                            <label class="custom-control-label" for="type-purchase">Purchase</label>
                        </div>

                        <div class="custom-control custom-radio mr-3 d-inline-block">
                            <input type="radio" id="type-sales" name="type" value="sales" class="custom-control-input typefind">
                            <label class="custom-control-label" for="type-sales">Sales</label>
                        </div>
                    </div>
                </div>

                <div class="offset-md-2 mg-b-30">
                    <button type="submit" name="submit" class="btn btn-primary btn-sm mg-r-10">Add Payment</button>
                </div>
            </div>

            <div id="payment-details" class="col-lg-12">
                <div class="row">
                    <div class="col-lg-4">
                        <h5 class="mg-b-25">Unpaid Transaction</h5>

                        <table id="payment-invoice" class="table table-bordered" data-max-row="25">
                            <thead>
                                <tr>
                                    <th style="width: 1%;"></th>
                                    <th style="width: 70%;">Details</th>
                                    <th style="width: 30%;">Total</th>
                                </tr>
                            </thead>
                            <tbody class="inv-purch-sale">
                                
                            </tbody>
                        </table>
                    </div>

                    <div class="col-lg-8 mg-b-20 table-repeater">
                        <h5 class="mg-b-25">Payment Record</h5>

                        <table class="table table-bordered" data-max-row="25">
                            <thead>
                                <tr>
                                    <th style="width: 15%;">Payment Method</th>
                                    <th style="width: 20%;">Amount</th>
                                    <th style="width: 20%;">Check No.</th>
                                    <th style="width: 35%;">Date</th>
                                    <th style="width: 1%;"></th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                                <tr>
                                    <td style="width: 15%;">
                                        <select name="payment-method" class="custom-select" required>
                                            <option value="" selected>Select Payment Method</option>
                                            <!-- FETCH DATA FROM CONTROLLER -->
                                            <?php foreach($paymentmethod as $pm){ ?>
                                            <option value="<?= $pm['name'];?>"><?= ucwords(str_replace("-", " ", $pm['name'])); ?></option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                    <td><input class="form-control" type="text" name="payment-amount[]" value="0"></td>
                                    <td><input class="form-control" type="text" name="payment-check-no[]" value=""></td>
                                    <td>
                                        <div class="row">
                                            <div class="col-4">
                                                <select name="mm[]" class="form-control" required>
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
                                                <select name="dd[]" class="form-control" required>
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
                                                <select name="yy[]" class="form-control" required>
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
                                    </td>
                                    <td><button class="btn btn-icon btn-danger btn-xs remove" type="button" data-action="remove"><i class="fas fa-times"></i></button></td>
                                </tr>
                            </tbody>
                        </table>

                        <button class="btn btn-success btn-sm float-right" type="button" data-action="add-row" id="add-row">Add Row</button>
                </div>
                </div>
            </div>
        </div>
    </form>


</div>




<script>

    $(document).ready(function() {

        $(".typefind").on("change", function() {

            var value = $(this).val();

            $.ajax({
                url: "<?= site_url('payment/getpurchase/')?>" + value,
                method: "GET",
                dataType: 'json',
                success: function(data) {

                    var tblitem = "";
					$.each(data, function(index, item) {

                        tblitem += `
                        <tr>
                            <td><div class="custom-control custom-checkbox custom-checkbox-only"><input type="checkbox" class="custom-control-input" name="id[]" id="id-${item.id}" value="${value}"><label class="custom-control-label" for="id-${item.id}">&nbsp;</label></div></td>
                            <td>
                                <div class="row">
                                    <div class="col-lg-12 row">
                                        <div class="col-lg-5">Invoice No:</div>
                                        <div class="col-lg-7">${item.invoice_no}</div>
                                    </div>

                                    <div class="col-lg-12 row">
                                        <div class="col-lg-5">Name:</div>
                                        <div class="col-lg-7">${item.name}</div>
                                    </div>

                                    <div class="col-lg-12 row">
                                        <div class="col-lg-5">Date:</div>
                                        <div class="col-lg-7">${item.date}</div>
                                    </div>

                                </div>
                            </td>
                            
                            <td class="text-right">${item.date}</td>
                        </tr>
                        `;
                    });

                    $(".inv-purch-sale").html(tblitem);

                },
                error: function() {
                    $(".inv-purch-sale").html("Error loading data");
                }

            });


        });


        $('#add-row').on('click', function () {
            // Adding a row inside the tbody.
            $('#tbody').append(`<tr>
                                    <td>
                                        <select name="payment-method" class="custom-select" required>
                                            <option value="" selected>Select Payment Method</option>
                                            <!-- FETCH DATA FROM CONTROLLER -->
                                            <?php foreach($paymentmethod as $pm){ ?>
                                            <option value="<?= $pm['name'];?>"><?= ucwords(str_replace("-", " ", $pm['name'])); ?></option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                    <td><input class="form-control" type="text" name="payment-amount[]" value="0"></td>
                                    <td><input class="form-control" type="text" name="payment-check-no[]" value=""></td>
                                    <td>
                                        <div class="row">
                                            <div class="col-4">
                                                <select name="mm[]" class="form-control" required>
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
                                                <select name="dd[]" class="form-control" required>
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
                                                <select name="yy[]" class="form-control" required>
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
                                    </td>
                                    <td><button class="btn btn-icon btn-danger btn-xs remove" type="button" data-action="remove"><i class="fas fa-times"></i></button></td>
                                </tr>
            `);
        });

        // jQuery button click event to remove a row.
        $('#tbody').on('click', '.remove', function () {
            var child = $(this).closest('tr').nextAll();
            child.each(function () {
                var id = $(this).attr('id');
                var idx = $(this).children('.row-index').children('p');
                var dig = parseInt(id.substring(1));
                idx.html(`Row ${dig - 1}`);
                $(this).attr('id', `R${dig - 1}`);
            });
            $(this).closest('tr').remove();
            rowIdx--;
        });


    });

</script>