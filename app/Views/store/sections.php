<div class="container">

    <?php	
        // Message thrown from the controller
        if(!empty($_SESSION['section_added'])){
            echo '<div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Catalog Section registration success!</h4>
			<p>Catalog section has been successfully added</p>
        </div>';
            unset($_SESSION['section_added']);
        }
    ?>


    <h1>Sections Management</h1>

        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4"></h4>

                        <?= form_open('catalog/savesection')?>

                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label class="d-block">Section Name</label>
                                    <input type="text" class="form-control" name="section-name" value="">
                                </div>

                                <div class="form-group col-lg-6">
                                    <label class="d-block">Part</label>
                                    <input type="text" class="form-control" name="part" value="">
                                </div>
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Save Section</button>
                        
                        <?= form_close();?>

                    </div>
                </div>
            </div>
            

            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        
                        <table class="table table-md table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Part</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($section as $sec){?>
                                <tr>
                                    <td><?= $sec['catalog_section_id'];?></td>
                                    <td><?= $sec['section_name'];?></td>
                                    <td><?= $sec['part'];?></td>
                                    <td><?= $sec['status'];?></td>
                                    <td></td>
                                </tr>
                                <?php }?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

        </div>

</div>