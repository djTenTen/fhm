<?php 
    $encrypter = \Config\Services::encrypter();
    $arr = array();
    $user_model = new \App\Models\User_model; // to access the users_model
    foreach($user_model->getUserAccess($_SESSION['groupid']) as $access){
        array_push($arr, $access['name']);
    }
?>
<div class="container">

    <?php
        // Message thrown from the controller
        if(!empty($_SESSION['update_supplier'])){
            echo '<div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Update Success!</h4>
            <p>Supplier has been successfully updated</p>
        </div>';
            unset($_SESSION['update_supplier']);
        }

    ?>

    <h1>Suppliers</h1>

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="activesupplier-tab" data-toggle="tab" href="#activesupplier" role="tab" aria-controls="activesupplier" aria-selected="true">Active</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="inactivesupplier-tab" data-toggle="tab" href="#inactivesupplier" role="tab" aria-controls="inactivesupplier" aria-selected="false">Inactive</a>
        </li>
    </ul>
    
   
    <div class="tab-content bd bd-gray-300 bd-t-0 pd-20" id="myTabContent">
         <!-- FIRST TAB -->
        <div class="tab-pane fade show active" id="activesupplier" role="tabpanel" aria-labelledby="activesupplier-tab">
            <h6>Active Suppliers</h6>

            <table class="table table-sm table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Contact</th>
                        <th>Status</th> 
                        <th>Added By</th>
                        <th>Action</th>
                    </tr>       
                </thead>
                <tbody>
                    <?php foreach($activesupp as $as){?>
                        <tr>
                            <td><?= $as['supplier_id'];?></td>
                            <td><?= $as['name'];?></td>
                            <td><?= $as['address'];?></td>  
                            <td><?= $as['contact_number'];?></td>       
                            <td><span class="badge badge-<?php if($as['status'] == 'active'){ echo 'success'; } else { echo 'danger'; } ?>"><?= ucwords($as['status']); ?></span></td>
                            <td><?= $as['nameuser'];?></td>
                            <td>
                                <?php if(in_array('edit-supplier', $arr)){?>
                                    <button type="button" class="btn btn-primary btn-icon btn-sm load-data" data-toggle="modal" data-target="#modaledit" data-supplier-id="<?= str_ireplace(['/','+'],['~','$'],$encrypter->encrypt($as['supplier_id']))?>"><i class="fas fa-edit"></i></button>
                                <?php }?>
                            </td>
                        </tr>
                    <?php }?>
                </tbody>
            </table>


        </div>
        <!-- END OF FIRST TAB -->

        <!-- START OF 2ND TAB -->
        <div class="tab-pane fade" id="inactivesupplier" role="tabpanel" aria-labelledby="inactivesupplier-tab">
            <h6>Inactive Suppliers</h6>

            <table class="table table-sm table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Contact</th>
                        <th>Status</th>
                        <th>Added By</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($inactivesupp as $ias){?>
                        <tr>
                        <td><?= $ias['supplier_id'];?></td>
                            <td><?= $ias['name'];?></td>
                            <td><?= $ias['address'];?></td>  
                            <td><?= $ias['contact_number'];?></td>       
                            <td><span class="badge badge-<?php if($ias['status'] == 'active'){ echo 'success'; } else { echo 'danger'; } ?>"><?= ucwords($ias['status']); ?></span></td>
                            <td><?= $ias['nameuser'];?></td>
                            <td>
                            <?php if(in_array('edit-supplier', $arr)){?>
                                    <button type="button" class="btn btn-primary btn-icon btn-sm load-data" data-toggle="modal" data-target="#modaledit" data-supplier-id="<?= str_ireplace(['/','+'],['~','$'],$encrypter->encrypt($ias['supplier_id']))?>"><i class="fas fa-edit"></i></button>
                                <?php }?>
                            </td>
                        </tr>
                    <?php }?>
                </tbody>
            </table>

            

        </div>
        <!-- END OF 2ND TAB -->
    </div>

</div>



        

        <!-- MODAL EDIT -->
        <!-- Modal -->
        <div class="modal fade" id="modaledit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit supplier</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    
                    <div class="modal-body">
                        <form id="myform" action="" method="post">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Name</label>
                                    <div class="col-md-8">
                                        <input class="form-control name" type="text" name="name" value="" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Address</label>
                                    <div class="col-md-8">
                                        <input class="form-control address" type="text" name="address" value="">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Contact Number</label>
                                    <div class="col-md-8">
                                        <input class="form-control contact-number" type="text" name="contact-number" value="">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Contact Person</label>
                                    <div class="col-md-8">
                                        <input class="form-control contact-person" type="text" name="contact-person" value="">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Position</label>
                                    <div class="col-md-8">
                                        <input class="form-control position" type="text" name="position" value="">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Remarks</label>
                                    <div class="col-md-8">
                                        <input class="form-control remarks" type="text" name="remarks" value="">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Status</label>
                                    <div class="custom-control custom-switch">
                                        <input value="inactive" name="status" class="custom-control-label sti" type="hidden" id="" />
                                        <input value="active" name="status" type="checkbox" class="custom-control-input sta" id="customSwitch">
                                        <label class="custom-control-label" for="customSwitch">Inactive / Active</label>
                                    </div>
                                </div>
                            </div>

                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                        </form>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- END OF MODAL EDIT -->


        <script>

            $(document).ready(function() {
                // When the button is clicked, show the modal and load the data
                $(".load-data").on("click", function() {
                    // Show the modal
                    var suppID = $(this).data('supplier-id');
                    // Fetch data using AJAX

                    $.ajax({
                        url: "<?= site_url('supplier/edit/')?>" + suppID,  // Replace with your actual data endpoint URL
                        method: "GET",
                        dataType: 'json',
                        success: function(data) {
                     
                            // Populate the modal body with the fetched data
                            $(".name").val(data[0].name);
                            $(".address").val(data[0].address);
                            $(".contact-number").val(data[0].contact_number);
                            $(".contact-person").val(data[0].contact_person);
                            $(".position").val(data[0].position);
                            $(".remarks").val(data[0].remarks);

                            $('#myform').attr('action', "<?= site_url("supplier/update/");?>" + data[0].supplier_id_e);

                            if(data[0].status == 'active'){
                                $(".sta").prop('checked', true);
                            }else{
                                $(".sti").prop('checked', true);
                            }

                        },
                        error: function() {
                            // Handle error if the data fetch fails
                            $(".modal-body").html("Error loading data");
                        }
                    });

                });

            });

        </script>






        