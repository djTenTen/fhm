<?php 
    $encrypter = \Config\Services::encrypter();
    $sales_model = new \App\Models\Sales_model; // to access the sales_model
    $rsv = $sales_model->countReservation();

    $arr = array();
	$user_model = new \App\Models\User_model; // to access the users_model
	foreach($user_model->getUserAccess($_SESSION['groupid']) as $access){
		array_push($arr, $access['name']);
	}
?>

<div class="container">

    <?php
        // Message thrown from the controller
        if(!empty($_SESSION['reservation_updated'])){
            echo '<div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Update Success!</h4>
            <p>Reservation has been successfully Updated</p>
        </div>';
            unset($_SESSION['reservation_updated']);
        }
    ?>

    <h1><?= $idf; ?> Reservation</h1>


    <table class="table table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Warehouse</th>
                <th>Customer</th>
                <th>Delivery Method</th>
                <th>Delivery Date</th>
                <th>Subtotal</th>
                <th>Status</th>
                <th>Added By</th>
                <th>Added On</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <!-- FETCH ALL THE RESERVATIONS -->
            <?php foreach($reserve as $o){
            $sub = $sales_model->getsubtotal($o['reservation_id']);?>
            <tr>
                <td><?= $o['reservation_id'];?></td>
                <td><?= $o['warehouse'];?></td>
                <td><?= $o['customer'];?></td>
                <td><?= $o['delivery_method'];?></td>
                <td><?= $o['delivery_date'];?></td>
                <td><?= $o['delivery_fee'] + $sub['subtotal'];?></td>
                <td><?= $o['status'];?></td>
                <td><?= $o['nameuser'];?></td>
                <td><?= $o['added_on'];?></td>
                <td>

                    <div class="btn-group">
                        <button type="button" class="btn btn-success btn-icon btn-sm load-data" data-toggle="modal" data-target="#modalview" data-reservation-id="<?= str_ireplace(['/','+'],['~','$'],$encrypter->encrypt($o['reservation_id'])); ?>"><i class="fas fa-eye"></i></button>
                        <?php if(in_array('edit-sales', $arr)){?>
                            <a href="<?= site_url().'reservation/edit/'.str_ireplace(['/','+'],['~','$'],$encrypter->encrypt($o['reservation_id'])); ?>/<?= str_ireplace(['/','+'],['~','$'],$encrypter->encrypt($o['customer_id']));?>" class="btn btn-primary btn-icon btn-sm"><i class="fas fa-edit"></i></a>
                        <?php }?>
                    </div>
  
                </td>
            </tr>
            <?php }?>
        </tbody>
    </table>

  
</div>



<!-- MODAL VIEW -->
<!-- Modal -->
<div class="modal fade" id="modalview" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Reservation</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row1">

            </div>

            <table class="table table-bordered mg-b-20">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 10%">Quantity</th>
                        <th class="text-center" style="width: 55%" colspan="2">Description</th>
                        <th class="text-center" style="width: 10%">Price</th>
                        <th class="text-center" style="width: 15%">Sub-Total</th>
                    </tr>
                </thead>
                <tbody class="items">
                    <!-- FETCH ALL THE ITEMS RESERVED -->
                
                </tbody>
                <tfoot class="data-foot">
                    
                </tfoot>
            </table>     
        
        <div class="modal-footer">
            <a href="<?= site_url()?>reservation/printdispatch/" target="_blank" class="btn btn-info" id="printdispatch">Print Dispatch</a>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Ok</button>
        </div>
        </div>
    </div>
</div>
<!-- END OF MODAL VIEW -->





<script>

    $(document).ready(function() {
        // When the button is clicked, show the modal and load the data
        $(".load-data").on("click", function() {
            // Show the modal
            var rID = $(this).data('reservation-id');
            // Fetch data using AJAX

            var span;
            $.ajax({
                url: "<?= site_url('reservation/viewreservationdetails/')?>" + rID,  // Replace with your actual data endpoint URL
                method: "GET",
                dataType: 'json',
                success: function(data) {

                    $('#printdispatch').attr('href', "<?= site_url("reservation/printdispatch/");?>" + rID);

                    if(data[0].status == 'open'){
                        span = `<span class="badge badge-primary">${ data[0].status }</span>`;
                    }else if(data[0].status == 'ready'){
                        span = `<span class="badge badge-warning">${ data[0].status }</span>`;
                    }else if(data[0].status == 'completed'){
                        span = `<span class="badge badge-success">${ data[0].status }</span>`;
                    }else if(data[0].status == 'cancelled'){
                        span = `<span class="badge badge-danger">${ data[0].status }</span>`;
                    }

                    // Populate the modal body with the fetched data
                    $(".row1").html(
                        `
                        <table class="table table-bordered mg-b-20">
                            <tbody>
                                <tr>
                                    <td style="width: 20%">ID</td>
                                    <td style="width: 30%">${ data[0].reservation_id }</td>

                                    <td style="width: 20%">Status</td>
                                    <td style="width: 30%">${ span }</td>
                                </tr>
                                <tr>
                                    <td style="width: 20%">Delivery Method</td>
                                    <td style="width: 30%">${ data[0].delivery_method }</td>

                                    <td style="width: 20%">Delivery Date</td>
                                    <td style="width: 30%">${ data[0].delivery_date }</td>
                                </tr>
                                <tr>
                                    <td>Customer</td>
                                    <td colspan="3">${ data[0].customer }</td>
                                </tr>
                                <tr>
                                    <td>Address</td>
                                    <td colspan="3">${ data[0].address }</td>
                                </tr>
                                <tr>
                                    <td>Contact Number</td>
                                    <td colspan="3">${ data[0].contact_number }</td>
                                </tr>
                                <tr>
                                    <td>Remarks</td>
                                    <td colspan="3">${ data[0].remark }</td>
                                </tr>
                                <tr>
                                    <td>Added By</td>
                                    <td>${ data[0].nameuser }</td>

                                    <td>Added On</td>
                                    <td>${ data[0].added_on }</td>
                                </tr>
                                
                            </tbody>
                        </table>
                        `
                    );

                    $(".data-foot").html(
                        `
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-right" colspan="3">Subtotal</td>
                                <td class="text-right">${ data[0].subtotal }</td>
                            </tr>
                            <tr>
                                <td colspan="4" class="text-right">Delivery Fee</td>
                                <td class="text-right">${ data[0].delivery_fee }</td>
                            </tr>
                            <tr>
                                <td colspan="4" class="text-right">Grand Total</td>
                                <td class="text-right">${ data[0].grandtotal }</td>
                            </tr>
                        `
                    );

                },
                error: function() {
                    // Handle error if the data fetch fails
                    $(".modal-body").html("Error loading data");
                }

            });
            
            $.ajax({

                url: "<?= site_url('reservation/viewreservationitems/')?>" + rID,  // Replace with your actual data endpoint URL
                method: "GET",
                dataType: 'json',
                success: function(data) {

                    var tableHTML = "";

                    $.each(data, function(index, item) {

                        tableHTML += `
                            <tr>
                                <td class="align-middle text-center">${item.quantity}</td>
                                <td style="width: 1%;">
                                    
                                </td>
                                <td class="align-middle">${item.name}</td>
                                <td class="align-middle text-right">${item.price}</td>
                                <td class="align-middle text-right">${item.sub_total}</td>
                            </tr>
                        `;

                    });

                    $(".items").html(tableHTML);

                },
                error: function() {
                    // Handle error if the data fetch fails
                    $(".modal-body").html("Error loading data");
                }

            });

        });

    });

</script>