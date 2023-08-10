<?php
    $encrypter = \Config\Services::encrypter();
    $sales_model = new \App\Models\Sales_model; // to access the item_model
	$arr = array();
	$user_model = new \App\Models\User_model; // to access the users_model
	foreach($user_model->getUserAccess($_SESSION['groupid']) as $access){
		array_push($arr, $access['name']);
	}
?>
<div class="container">

	<?php
        // Message thrown from the controller
        if(!empty($_SESSION['quotation_updated'])){
            echo '<div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Update Success!</h4>
            <p>Quotation has been successfully Updated</p>
        </div>';
            unset($_SESSION['quotation_updated']);
        }
    ?>

    <h1>Quotation Management</h1>

    <table class="table table-md table-bordered">
		<thead>
			<tr>
				<th style="width: 1%;">ID</th>
				<th style="width: 20%;">Name</th>
				<th style="width: 20%;">Address</th>
				<th style="width: 20%;">Subtotal</th>
				<th style="width: 20%;">Discount</th>
				<th style="width: 20%;">Added By</th>
				<th style="width: 1%;"></th>
			</tr>
		</thead>
		<tbody>
			<!-- FETCH ALL THE QUOTATIONS -->
			<?php 
                foreach($quotation as $quo){
                $sub = $sales_model->getSubtotalQuotation($quo['quotation_id']);
            ?>
			<tr>
				<td><?= $quo['quotation_id'];?></td>
				<td><?= $quo['customer'];?></td>
				<td><?= $quo['address'];?></td>
				<td><?= $sub['subtotal'];?></td>
				<td><?= $quo['discount'];?></td>
				<td><?= $quo['nameuser'];?></td>
				<td class="align-middle no-wrap">
					<div class="btn-group">
						<?php if(in_array('edit-sales', $arr)){?>
							<button type="button" class="btn btn-success btn-icon btn-sm load-data" data-toggle="modal" data-target="#modalview" data-quotation-id="<?= str_ireplace(['/','+'],['~','$'],$encrypter->encrypt($quo['quotation_id'])); ?>"><i class="fas fa-eye"></i></button>
							<a href="<?= site_url()?>quotation/edit/<?= str_ireplace(['/','+'],['~','$'],$encrypter->encrypt($quo['quotation_id']));?>" class="btn btn-icon btn-primary btn-sm"><i class="fas fa-edit"></i></a>
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
				<h5 class="modal-title" id="exampleModalLabel">Quotation</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">

				<table class="table table-hover" style="font-size: 14px;">
					<thead>
						<tr>
							<th style="width: 10%;">Quantity</th>
							<th colspan="2" style="width: 50%;">Item</th>
							<th style="width: 15%;">Unit Price</th>
							<th style="width: 15%;">Subtotal</th>
						</tr>
					</thead>
					<tbody class="qitem">

							
					</tbody>
					<tfoot class="data-foot">
						
					</tfoot>
						
				</table>
				
			</div>
			<div class="modal-footer">
				<a id="printquotation" href="" class="btn btn-info" target="_blank">Print Quotation</a>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Ok</button>
			</div>
			</div>
		</div>
	</div>
	<!-- END OF MODAL VIEW -->



<script>

    function numberformat(num){
        return Number(num).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    }

    $(document).ready(function() {
        // When the button is clicked, show the modal and load the data
        $(".load-data").on("click", function() {

            var qID = $(this).data('quotation-id');

			$('#printquotation').attr('href', "<?= site_url("quotation/printquotation/");?>" + qID);

			$.ajax({
                url: "<?= site_url('quotation/getquotationitem/')?>" + qID,  // Replace with your actual data endpoint URL
                method: "GET",
                dataType: 'json',
                success: function(data) {

					var tableHTML = "";
					var gtotal = 0;
                    $.each(data, function(index, item) {
						gtotal += parseInt(item.subtotal);
                        tableHTML += `
							<tr>
								<td class="align-middle text-center">${item.quantity}</td>
								<td class="align-middle" style="width: 1%;">

								</td>
								<td class="align-middle">${item.name}</td>
								<td class="align-middle">${item.price}</td>
								<td class="align-middle">₱ ${numberformat(item.subtotal)}</td>
					
							</tr>
                        `;

                    });

                    $(".qitem").html(tableHTML);
                
                    $(".data-foot").html(
                        `
						<tr>
							<td class="text-right" colspan="4">Grand Total</td>
							<td data-name="grand-total">₱ ${ numberformat(gtotal)}</td>
						</tr>
                        `
                    );

                },
                error: function() {
                    // Handle error if the data fetch fails
                    $(".modal-body").html("Error loading data");
                }

            });
            
        });

    });

</script>