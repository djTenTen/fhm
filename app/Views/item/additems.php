<?php
    $encrypter = \Config\Services::encrypter();
?>
<div class="container">


    <?php
        // Message thrown from the controller
        if(!empty($_SESSION['item_registered'])){
            echo '<div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Item Registration Success!</h4>
            <p>Item has been successfully registered</p>
        </div>';
            unset($_SESSION['item_registered']);
        }
    ?>

    <h1>Item Registration</h1>
    

    <?= form_open_multipart("item/register");?>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group row">
                    <label class="col-md-4 col-form-label">Name</label>
                    <div class="col-md-8">
                        <input class="form-control" type="text" name="name" value="" required>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form-group row">
                    <label class="col-md-4 col-form-label">Description</label>
                    <div class="col-md-8">
                        <input class="form-control" type="text" name="description" value="" required>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form-group row">
                    <label class="col-md-4 col-form-label">Tags</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" id="tags" value="" name="tag-name" data-role="tagsinput">
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="form-group row">
                    <label class="col-md-4 col-form-label">Category</label>
                    <div class="col-md-8">
                        <select name="category" class="custom-select" required>
                            <option value="" selected> Select Category</option>
                            <!-- CATEGORY INFORMATION -->
                            <?php foreach($category as $c){?>
                                <option value="<?= $encrypter->encrypt($c['item_category_id'])?>"><?= $c['name'];?></option>
                            <?php }?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form-group row">
                    <label class="col-md-4 col-form-label">Stock Level</label>
                    <div class="col-md-8">
                        <input class="form-control" type="number" name="stock-level" value="" min="0" required>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form-group row">
                    <label class="col-md-4 col-form-label">Main Photo</label>
                    <div class="col-md-8">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="main-photo">
                            <label class="custom-file-label">Choose file</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="mg-b-20 table-repeater">
                    <h5 class="mg-b-15">Variation / Descriptions</h5>

                    <table class="table table-bordered" data-max-row="50">
                        <thead>
                            <tr>
                                <th style="width: 25%;">Image</th>
                                <th style="width: 25%;">Name</th>
                                <th style="width: 7%;">Color</th>
                                <th style="width: 25%;">Wholesale Price</th>
                                <th style="width: 25%;">Retail Price</th>
                                <th style="width: 1%;">Action</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            <tr>
                                <td>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="image[]">
                                        <label class="custom-file-label">Choose file</label>
                                    </div>
                                </td>
                                <td><input class="form-control" type="text" name="variation-name[]" value="" required></td>
                                <td><input class="form-control" type="color" name="variation-color[]" value=""  ></td>
                                <td><input class="form-control" type="text" name="wholesale-price[]" value="" required></td>
                                <td><input class="form-control" type="text" name="retail-price[]" value="" required></td>
                                <td><button class="btn btn-icon btn-danger btn-xs remove" type="button" data-action="remove"><i class="fas fa-times"></i></button></td>
                            </tr>
                        </tbody>
                    </table>
                
                    <button class="btn btn-success btn-sm float-right" type="button" data-action="add-row" id="add-row">Add Row</button>

                </div>
            </div>
        </div>

        <button class="btn btn-primary mg-r-10" name="submit" type="submit">Register Item</button>
    <?= form_close();?>











<script>
    $(document).ready(function () {


        $("#tags").tagsinput('items');


        // Denotes total number of rows
        var rowIdx = 0;
        // jQuery button click event to add a row
        $('#add-row').on('click', function () {
            // Adding a row inside the tbody.
            $('#tbody').append(`<tr>
                <td>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="image[]">
                        <label class="custom-file-label">Choose file</label>
                    </div>
                </td>
                <td><input class="form-control" type="text" name="variation-name[]" value="" required></td>
                <td><input class="form-control" type="color" name="variation-color[]" value=""  ></td>
                <td><input class="form-control" type="text" name="wholesale-price[]" value="" required></td>
                <td><input class="form-control" type="text" name="retail-price[]" value="" required></td>
                <td><button class="btn btn-icon btn-danger btn-xs remove" type="button" data-action="remove"><i class="fas fa-times"></i></button></td>
            </tr>`);
        });

        // jQuery button click event to remove a row.
        $('#tbody').on('click', '.remove', function () {

            // Getting all the rows next to the row
            // containing the clicked button
            var child = $(this).closest('tr').nextAll();

            // Iterating across all the rows 
            // obtained to change the index
            child.each(function () {

            // Getting <tr> id.
            var id = $(this).attr('id');

            // Getting the <p> inside the .row-index class.
            var idx = $(this).children('.row-index').children('p');

            // Gets the row number from <tr> id.
            var dig = parseInt(id.substring(1));

            // Modifying row index.
            idx.html(`Row ${dig - 1}`);

            // Modifying row id.
            $(this).attr('id', `R${dig - 1}`);
            });

            // Removing the current row.
            $(this).closest('tr').remove();

            // Decreasing total number of rows by 1.
            rowIdx--;
        });
    });
</script>


</div>