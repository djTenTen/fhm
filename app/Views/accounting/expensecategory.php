<?php
    $encrypter = \Config\Services::encrypter();
    $accounting_model = new \App\Models\Accounting_model;
?>
<div class="container">
    
    <?php
        // Message thrown from the controller
        if(!empty($_SESSION['expensecategory_added'])){
            echo '<div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Expense Category Registration Success!</h4>
            <p>Expense Category has been successfully registered</p>
        </div>';
            unset($_SESSION['expensecategory_added']);
        }

    ?>

    <h1>Expense Category Management</h1>


    <div class="row">

        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4"></h4>

                    <?= form_open('expense/save');?>
                        
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Name</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" name="name" value="" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Parent</label>
                            <div class="col-md-10">
                                <select name="parent" class="custom-select" required>
                                    <option value="<?= $encrypter->encrypt(0)?>">Select Parent Category</option>
                                    <?php foreach($parentcategory as $pcate){?>
                                        <option value="<?= $encrypter->encrypt($pcate['expense_category_id'])?>"><?= $pcate['name']?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>

                        <button class="btn btn-primary btn-sm mg-r-10" name="submit" type="submit">Register</button>

                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="table-responsive mb-0">
                <table class="table table-md table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 50%">Name</th>
                            <th style="width: 50%">Count</th>
                            <th style="width: 1%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php foreach($parentcategory as $cate){?>
                            <tr>
                                <td class="align-middle"><?= $cate['name'];?></td>
                                <td class="align-middle"></td>
                                <td class="align-middle">
                                    <div class="no-wrap">
                                        <a href="" class="btn btn-icon btn-primary btn-xs"><i class="fas fa-edit"></i></a>
                                        <a href=""><i class="fas fa-times"></i></a>
                                    </div>
                                </td>
                            </tr>
                            <?php foreach($accounting_model->getChildCategory($cate['expense_category_id']) as $chcate){?>
                            <tr>
                                <td class="align-middle"> ― <?= $chcate['name'];?></td>
                                <td class="align-middle"></td>
                                <td class="align-middle">
                                    <div class="no-wrap">
                                        <a href=""><i class="fas fa-edit"></i></a>
                                        <a href="" class="confirm-link btn btn-icon btn-danger btn-xs"><i class="fas fa-times"></i></a>
                                    </div>
                                </td>
                            </tr>
                            <?php }?>
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>

        
    </div>

</div>