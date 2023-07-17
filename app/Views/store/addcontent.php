<?php 
    $encrypter = \Config\Services::encrypter();
?>
<div class="container">

    <h1>Add Content</h1>

        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4"></h4>

                        <?= form_open_multipart('catalog/savecontent')?>

                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label class="d-block">Content Name</label>
                                    <input type="text" class="form-control" name="content-name" value="" required>
                                </div>

                                <div class="form-group col-lg-6">
                                    <label class="d-block">Description</label>
                                    <input type="text" class="form-control" name="description" value="" required>
                                </div>

                                <div class="form-group col-lg-6">
                                    <label class="d-block">Photo</label>
                                    <input type="file" class="form-control" name="photo" value="">
                                </div>
                                
                                <div class="form-group col-lg-6">
                                    <label class="d-block">Section</label>
                                    <select name="section" id="" class="form-control" required>
                                        <option value="" selected>Select Section</option>
                                        <?php foreach($section as $sc){?>
                                        <option value="<?= $encrypter->encrypt($sc['catalog_section_id']);?>"><?= $sc['section_name'].'->'.$sc['part'];?></option>
                                        <?php }?>
                                    </select>
                                </div>

                                <div class="form-group col-lg-6">
                                    <label class="d-block">Category</label>
                                    <select name="category" id="" class="form-control" required>
                                        <option value="" selected>Select Category</option>
                                        <?php foreach($cate as $categ){?>
                                        <option value="<?= $encrypter->encrypt($categ['item_category_id']);?>"><?= $categ['name'];?></option>
                                        <?php }?>
                                    </select>
                                </div>

                                
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Save Section</button>
                        
                        <?= form_close();?>

                    </div>
                </div>
            </div>
            
        </div>

</div>