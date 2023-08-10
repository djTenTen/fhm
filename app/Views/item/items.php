<?php 
    $encrypter = \Config\Services::encrypter();
    $arr = array();
    $user_model = new \App\Models\User_model; // to access the users_model
    $item_model = new \App\Models\Item_model; // to access the item_model
    foreach($user_model->getUserAccess($_SESSION['groupid']) as $access){
        array_push($arr, $access['name']);
    }
?>
<div class="container">

    

    <h1>Items</h1>

    <table class="table table-sm table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Name</th>
                <th>Tags</th>
                <th>Category</th>
                <th>Variation</th>
                <th>Action</th>
            </tr>       
        </thead>
        <tbody>
            <!-- VIEWS OF THE ACTIVE ITEMS -->
            <?php foreach($items as $ai){
                $count = $item_model->getVariationCount($ai['item_id']);
                $tg = json_decode($ai['tags']);
                ?>
                <tr>
                    <td><?= $ai['item_id'];?></td>
                    <td></td>
                    <td><?= $ai['itemname'];?></td>
                        
                    <td><?php if(!empty($ai['tags'])){?> <?php foreach($tg as $t){?><span class="badge badge-primary"><?= ucwords($t); ?></span> <?php }?> <?php }else{echo ucwords($ai['tags']);}?></td>
                    <td><?= $ai['catename'];?></td>  
                    <td><?= $count['varcount'];?></td>       
                    <td><span class="badge badge-<?php if($ai['itemstatus'] == 'active'){ echo 'success'; } else { echo 'danger'; } ?>"><?= ucwords($ai['itemstatus']); ?></span></td>
                    <td>
                        <div class="btn-group">
                            <?php if(in_array('edit-item', $arr)){?>
                                <button type="button" class="btn btn-success btn-icon btn-sm load-data" data-toggle="modal" data-target="#modalview" data-item-id="<?= str_ireplace(['/','+'],['~','$'],$encrypter->encrypt($ai['item_id'])); ?>"><i class="fas fa-eye"></i></button>
                                <a href="<?= site_url().'item/edit/'.str_ireplace(['/','+'],['~','$'],$encrypter->encrypt($ai['item_id'])); ?>" class="btn btn-primary btn-icon btn-sm"><i class="fas fa-edit"></i></a>
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
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Variations</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <table class="table table-hover table-sm">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Color</th>
                        <th>Wholesale Price</th>
                        <th>Retail Price</th>
                    </tr>
                </thead>
                <tbody class="tbitem">

                </tbody>
            </table>          
            
        </div>
        <div class="modal-footer">
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
            var iID = $(this).data('item-id');
            // Fetch data using AJAX

			$.ajax({
                url: "<?= site_url('items/viewvariations/')?>" + iID,  // Replace with your actual data endpoint URL
                method: "GET",
                dataType: 'json',
                success: function(data) {

					var tblitem = "";
					$.each(data, function(index, item) {

                        tblitem += `
                        <tr>
                            <td>${item.item_id}</td>
                            <td>${item.name}</td>
                            <td>${item.color}</td>
                            <td>${item.wholesale_price}</td>
                            <td>${item.retail_price}</td>
                        </tr>
                        `;
                    });

                    $(".tbitem").html(tblitem);

                },
                error: function() {
                    // Handle error if the data fetch fails
                    $(".tbitem").html("Error loading data");
                }

            });

        });

    });

</script>