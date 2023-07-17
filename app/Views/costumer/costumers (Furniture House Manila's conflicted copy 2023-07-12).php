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
        if(!empty($_SESSION['customer_updated'])){
            echo '<div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Update Success!</h4>
            <p>Costumer has been successfully updated</p>
        </div>';
            unset($_SESSION['customer_updated']);
        }

        if(!empty($_SESSION['corporate_updated'])){
            echo '<div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Update Success!</h4>
            <p>Corporate has been successfully updated</p>
        </div>';
            unset($_SESSION['corporate_updated']);
        }

    ?>

    <h1>Customer</h1>

    <!-- TABS -->
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="activecostumer-tab" data-toggle="tab" href="#activecostumer" role="tab" aria-controls="activecostumer" aria-selected="true">Active</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="inactivecostumer-tab" data-toggle="tab" href="#inactivecostumer" role="tab" aria-controls="inactivecostumer" aria-selected="false">Inactive</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="corporate-tab" data-toggle="tab" href="#corporate" role="tab" aria-controls="corporate" aria-selected="false">Corporate</a>
        </li>
    </ul>
    
   
    <div class="tab-content bd bd-gray-300 bd-t-0 pd-20" id="myTabContent">
        <!-- FIRST TAB -->
        <div class="tab-pane fade show active" id="activecostumer" role="tabpanel" aria-labelledby="activecostumer-tab">
            <h6>Active Costumers</h6>

            <table class="table table-sm table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Contact</th>                            
                        <th>Status</th>
                        <th>Added By</th>
                        <th>Added On</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($acostumer as $ac){
                        $adder = $user_model->getadder($ac['added_by']);?>
                        <tr>
                            <td><?= $ac['customer_id'];?></td>
                            <td><?= $ac['name'];?></td>
                            <td><?= $ac['address'];?></td>  
                            <td><?= $ac['contact_number'];?></td>       
                            <td><span class="badge badge-<?php if($ac['status'] == 'active'){ echo 'success'; } else { echo 'danger'; } ?>"><?= ucwords($ac['status']); ?></span></td>
                            <td><?= $adder['name'];?></td>
                            <td><?= $ac['added_on'];?></td>
                            <td>
                                <?php if(in_array('edit-customer', $arr)){?>
                                    <button type="button" class="btn btn-primary btn-icon btn-sm load-data" data-toggle="modal" data-target="#modaledit" data-customer-id="<?= str_ireplace(['/','+'],['~','$'],$encrypter->encrypt($ac['customer_id']))?>"><i class="fas fa-edit"></i></button>
                                <?php }?>

                            </td>
                        </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>
        <!-- END OF FIRST TAB -->
                                    
        <!-- START OF 2ND TAB -->
        <div class="tab-pane fade" id="inactivecostumer" role="tabpanel" aria-labelledby="inactivecostumer-tab">
            <h6>Inactive Costumers</h6>

            <table class="table table-sm table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Contact</th>                            
                        <th>Status</th>
                        <th>Added By</th>
                        <th>Added On</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($icostumer as $iac){
                        $adder = $user_model->getadder($iac['added_by']);?>
                        <tr>
                            <td><?= $iac['customer_id'];?></td>
                            <td><?= $iac['name'];?></td>
                            <td><?= $iac['address'];?></td>  
                            <td><?= $iac['contact_number'];?></td>       
                            <td><span class="badge badge-<?php if($iac['status'] == 'active'){ echo 'success'; } else { echo 'danger'; } ?>"><?= ucwords($iac['status']); ?></span></td>
                            <td><?= $adder['name'];?></td>
                            <td><?= $iac['added_on'];?></td>
                            <td>
                                <?php if(in_array('edit-customer', $arr)){?>
                                    <button type="button" class="btn btn-primary btn-icon btn-sm" data-toggle="modal" data-target="#modaledit" data-customer-id="<?= str_ireplace(['/','+'],['~','$'],$encrypter->encrypt($iac['customer_id']))?>"><i class="fas fa-edit"></i></button>
                                <?php }?>

                            </td>
                        </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>
        <!-- END OF 2ND TAB -->

        <!-- MODAL EDIT -->
        <!-- Modal -->
        <div class="modal fade" id="modaledit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header">  
                    <h5 class="modal-title" id="exampleModalLabel">Edit Customer </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- ID BEING DECODED AND ENCRYPTED DUE TO THE ERROR ON THE URI ROUTES -->
                     
                    
                    <form id="myform" action="" method="post">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label">Name</label>
                                <div class="col-md-8">
                                    <input class="form-control name" type="text" name="name" value="" >
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label">Address</label>
                                <div class="col-md-8">
                                    <input class="form-control address" type="text" name="address" value="" >
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
                                <label class="col-md-4 col-form-label">E-mail Address</label>
                                <div class="col-md-8">
                                    <input class="form-control email-address" type="text" name="email-address" value="">
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
                                    <input value="inactive" name="status" class="custom-control-label ac" type="hidden" id="" />
                                    <input value="active" name="status" type="checkbox" class="custom-control-input iac" id="customSwitch<?= $ac['customer_id']; ?>" <?php if($ac['status'] == 'active'){echo 'checked';}?>>
                                    <label class="custom-control-label" for="customSwitch<?= $ac['customer_id']; ?>">Inactive / Active</label>
                                </div>
                            </div>
                        </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    <?= form_close();?>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
                </div>
            </div>
        </div>
        <!-- END OF MODAL EDIT -->

        <!-- START OF 3RD TAB -->
        <div class="tab-pane fade" id="corporate" role="tabpanel" aria-labelledby="corporate-tab">
            <h6>Corporate Costumers</h6>

            <table class="table table-sm table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Contact</th>                            
                        <th>Status</th>
                        <th>Added By</th>
                        <th>Added On</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($corporate as $acorp){?>
                        <tr>
                            <td><?= $acorp['customer_id'];?></td>
                            <td><?= $acorp['name'];?></td>
                            <td><?= $acorp['address'];?></td>  
                            <td><?= $acorp['contact_number'];?></td>       
                            <td><span class="badge badge-<?php if($acorp['status'] == 'active'){ echo 'success'; } else { echo 'danger'; } ?>"><?= ucwords($acorp['status']); ?></span></td>
                            <td><?= $adder['name'];?></td>
                            <td><?= $acorp['added_on'];?></td>
                            <td>
                                <?php if(in_array('edit-customer', $arr)){?>
                                    <button type="button" class="btn btn-primary btn-icon btn-sm" data-toggle="modal" data-target="#modaledit" data-customer-id="<?= str_ireplace(['/','+'],['~','$'],$encrypter->encrypt($iac['customer_id']))?>"><i class="fas fa-edit"></i></button>
                                <?php }?>

                                <!-- MODAL EDIT -->
                                <!-- Modal -->
                                <div class="modal fade" id="modaledit<?= $acorp['customer_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">  
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Customer <?= $acorp['name'];?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- ID BEING DECODED AND ENCRYPTED DUE TO THE ERROR ON THE URI ROUTES -->
                                            <?= form_open('costumer/updatescorporate/'.str_ireplace(['/','+'],['~','$'],$encrypter->encrypt($acorp['customer_id'])));?>

                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group row">
                                                    <label class="col-md-4 col-form-label">Name</label>
                                                    <div class="col-md-8">
                                                        <input class="form-control" type="text" name="name" value="<?= $acorp['name'];?>" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group row">
                                                    <label class="col-md-4 col-form-label">Address</label>
                                                    <div class="col-md-8">
                                                        <input class="form-control" type="text" name="address" value="<?= $acorp['address'];?>" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group row">
                                                    <label class="col-md-4 col-form-label">Contact Number</label>
                                                    <div class="col-md-8">
                                                        <input class="form-control" type="text" name="contact-number" value="<?= $acorp['contact_number'];?>">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group row">
                                                    <label class="col-md-4 col-form-label">E-mail Address</label>
                                                    <div class="col-md-8">
                                                        <input class="form-control" type="email" name="email-address" value="<?= $acorp['email_address'];?>">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group row">
                                                    <label class="col-md-4 col-form-label">Remarks</label>
                                                    <div class="col-md-8">
                                                        <input class="form-control" type="text" name="remarks" value="<?= $acorp['remarks'];?>">
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- for corp -->
                                                <div class="col-lg-6">
                                                    <div class="form-group row">
                                                        <label class="col-md-4 col-form-label">Username</label>
                                                        <div class="col-md-8">
                                                            <input class="form-control" type="text" name="username" value="<?= $acorp['username'];?>" readonly>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group row">
                                                        <label class="col-md-4 col-form-label">Password</label>
                                                        <div class="col-md-8">
                                                            <input class="form-control" type="text" name="password" value="" >
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group row">
                                                        <label class="col-md-4 col-form-label">Discount</label>
                                                        <div class="col-md-8">
                                                            <input class="form-control" type="number" name="discount" value="<?= $acorp['discount'];?>" >
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group row">
                                                        <label class="col-md-4 col-form-label">Website</label>
                                                        <div class="col-md-8">
                                                            <input class="form-control" type="text" name="website" value="<?= $acorp['website'];?>" >
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group row">
                                                        <label class="col-md-4 col-form-label">Facebook</label>
                                                        <div class="col-md-8">
                                                            <input class="form-control" type="text" name="facebook" value="<?= $acorp['facebook'];?>" >
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group row">
                                                        <label class="col-md-4 col-form-label">Instagram</label>
                                                        <div class="col-md-8">
                                                            <input class="form-control" type="text" name="instagram" value="<?= $acorp['instagram'];?>" >
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group row">
                                                        <label class="col-md-4 col-form-label">Lazada</label>
                                                        <div class="col-md-8">
                                                            <input class="form-control" type="text" name="lazada" value="<?= $acorp['lazada'];?>" >
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group row">
                                                        <label class="col-md-4 col-form-label">Shopee</label>
                                                        <div class="col-md-8">
                                                            <input class="form-control" type="text" name="shopee" value="<?= $acorp['shopee'];?>" >
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group row">
                                                        <label class="col-md-4 col-form-label">Authorized Representative</label>
                                                        <div class="col-md-8">
                                                            <input class="form-control" type="text" name="corporate-contact-person" value="<?= $acorp['representative_name'];?>" >
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group row">
                                                        <label class="col-md-4 col-form-label">Contact Number</label>
                                                        <div class="col-md-8">
                                                            <input class="form-control" type="text" name="corporate-contact-number" value="<?= $acorp['representative_contact_number'];?>" >
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group row">
                                                        <label class="col-md-4 col-form-label">Email Address</label>
                                                        <div class="col-md-8">
                                                            <input class="form-control" type="text" name="corporate-email-address" value="<?= $acorp['representative_email_address'];?>" >
                                                        </div>
                                                    </div>
                                                </div>

                                

                                                <div class="col-lg-6">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 col-form-label">Status</label>
                                                        <div class="custom-control custom-switch">
                                                            <input value="inactive" name="status" class="custom-control-label" type="hidden" id="" />
                                                            <input value="active" name="status" type="checkbox" class="custom-control-input" id="customSwitch<?= $acorp['customer_id']; ?>" <?php if($acorp['status'] == 'active'){echo 'checked';}?>>
                                                            <label class="custom-control-label" for="customSwitch<?= $acorp['customer_id']; ?>">Inactive / Active</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                            <?= form_close();?>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END OF MODAL EDIT -->
                            </td>
                        </tr>
                    <?php }?>
                </tbody>
            </table>            

        </div>
        <!-- END OF 3RD TAB -->
    </div>

</div>

<script>

            $(document).ready(function() {
                // When the button is clicked, show the modal and load the data
                $(".load-data").on("click", function() {
                    // Show the modal
                    var suppID = $(this).data('customer-id');
                    // Fetch data using AJAX

                    $.ajax({
                        url: "<?= site_url('costumer/edit/')?>" + suppID,  // Replace with your actual data endpoint URL
                        method: "GET",
                        dataType: 'json',
                        success: function(data) {
                     
                            // Populate the modal body with the fetched data
                            $(".name").val(data[0].name);
                            $(".address").val(data[0].address);
                            $(".contact-number").val(data[0].contact_number);
                            $(".email-address").val(data[0].email_address);
                            $(".remarks").val(data[0].remarks);

                            console.log(data[0].email_address);

                            //for corp

                            $(".username").val(data[0].name);
                            $(".discount").val(data[0].address);
                            $(".website").val(data[0].contact_number);
                            $(".facebook").val(data[0].email_address);
                            $(".instagram").val(data[0].remarks);
                            $(".lazada").val(data[0].name);
                            $(".shopee").val(data[0].address);
                            $(".representative_name").val(data[0].contact_number);
                            $(".representative_contact_number").val(data[0].email_address);
                            $(".representative_email_address").val(data[0].remarks);

                            $('#myform').attr('action', "<?= site_url("supplier/update/");?>" + data[0].supplier_id_e);

                            if(data[0].status == 'active'){
                                $(".ac").prop('checked', true);
                            }else{
                                $(".iac").prop('checked', true);
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