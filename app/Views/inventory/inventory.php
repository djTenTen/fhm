<?php
    $item_model = new \App\Models\Item_model; // to access the item_model
    $inventory_model = new \App\Models\Inventory_model; // to access the inventory_model
?>
<div class="container">


    <h1>Inventory Management</h1>

    <div class="btn-group">
        <!-- DISPLAY ALL THE FILTERS CATEGORY -->
        <?php foreach($item_model->getCategory() as $icat){?>
            <a href="<?= site_url('inventory/viewinventory/'.$icat['name'])?>" class="btn btn-dark btn-sm"><?= $icat['name'] ?></a>
        <?php }?>
    </div>

    <div class="table-responsive mb-0">
		<table class="table table-bordered table-md">
			<thead>
				<tr>
					<td style="width: 1%;">Photo</td>
					<td style="width: 10%;">Category</td>
					<td style="width: 15%;">Name</td>
                    <td style="width: 30%;">Variations</td>
					<td style="width: 10%;">Retail Price</td>
					<td style="width: 10%;">Inventory</td>
				</tr>
			</thead>
			<tbody>
                <!-- DISPLAY ALL THE ITEMS -->
				<?php foreach($items as $i){?>
				<tr>
					<td><img src="<?= site_url('public/uploads/'.$i['item_id'].'.jpg');?>" class="d-block simplebox" style="max-width: 100px;"></td>
					<td class="text-center"><?= $i['catename'];?></td>
					<td class="bg-black-2"><?= $i['itemname'];?></td>
                    <!-- VARIATION PART -->
                    <td class="">
                        <?php 
                            // DISPLAY ALL THE VARIATIONS BASED ON THE PARENT ITEM
                            foreach($item_model->getVariationItems($i['item_id']) as $vicn){
                                // GET THE ITEM INFORMATION LIKE, PURCHASE,DAMAGE,SALES AND DISPLAY
                                $instk = $inventory_model->getaboutitem($vicn['item_id']);
                                ?>
                            <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#modalview<?= $vicn['item_id']; ?>"></button>
                            <span class="badge badge-pill" style="background-color:<?= $vicn['color']?>;">color</span> <span><?= $vicn['name'];?></span><br>

                            <!-- MODAL VIEW -->
                            <!-- Modal -->
                            <div class="modal fade" id="modalview<?= $vicn['item_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Variations of <?= $i['itemname'];?> - <?= $vicn['name'];?></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- FIRST ROW -->
                                        <div class="row">
                                            <div class="col-3">
                                                <img src="<?= site_url('public/uploads/559.jpg');?>" alt="" style="max-width: 150px;">
                                            </div>
                                            <div class="col-9">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td>ID</td>
                                                            <td><?= $vicn['item_id'];?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Color</td>
                                                            <td style="background-color:<?= $vicn['color'];?>;"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Name</td>
                                                            <td><?= $vicn['name'];?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Retail Price</td>
                                                            <td><?= $vicn['retail_price'];?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Total Inventory</td>
                                                            <td><?= $instk['qtyitem'] - $instk['salesitem'];?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- END OF FIRST ROW -->

                                        <!-- 2ND ROW -->
                                            <h4>Warehouses</h4>
                                            <div class="row">
                                            <!-- DISPLAY ALL THE WAREHOUSE -->
                                            <?php foreach($warehouse as $wh){
                                                // DISPLAY DATA INFO ABOUT ITEM BASED ON THE WAREHOUSE
                                                $stkcount =  $inventory_model->getstockcount($vicn['item_id'],$wh['warehouse_id']);
                                                ?>
                                                <div class="col-4">
                                                    <table class="table table-primary">
                                                        <thead>
                                                            <tr>
                                                                <th>Warehouse</th>
                                                                <th><?= $wh['name']?></th>
                                                            </tr>
                                                        </thead>    
                                                        <tbody>
                        
                                                            <tr>
                                                                <td>Onhand</td>
                                                                <td>
                                                                    <?php 
                                                                     
                                                                        if($stkcount['stcktransferfrom'] != 0){
                                                                            $qtyitem = $stkcount['qtyitem'] - $stkcount['stcktransferfrom'];
                                                                        }else{
                                                                            $qtyitem = $stkcount['qtyitem'] + $stkcount['stcktransferto'];
                                                                        }
                                                                    ?>
                                                                    <?= $qtyitem - $stkcount['salesitem'];?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Display</td>
                                                                <td><?= $stkcount['displayitem'];?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Damage</td>
                                                                <td><?= $stkcount['damageitem'];?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Available</td>
                                                                <td><?= $qtyitem - ($stkcount['displayitem'] + $stkcount['damageitem'] + $stkcount['salesitem']);?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            <?php }?>
                                            </div>
                                        <!-- END OF 2ND ROW -->

                                        <div class="row">
                                            <!-- 3RD ROW PURCHASE AREA -->
                                            <div class="col-6">
                                                <h3>Purchase History</h3>
                                                <table class="table table-secondary">
                                                    <thead>
                                                        <tr>
                                                            <th>Date</th>
                                                            <th>Invoice No.</th>
                                                            <th>Warehouse</th>
                                                            <th>Quantity</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <!-- DISPLAY OF ALL THE PURCHACE TRANSACTION -->
                                                        <?php foreach($inventory_model->getpurchasetrasaction($vicn['item_id']) as $pt){?>
                                                            <tr>
                                                                <td><?= $pt['invoice_date']?></td>
                                                                <td><?= $pt['invoice_no']?></td>
                                                                <td><?= $pt['name']?></td>
                                                                <td><?= $pt['quantity']?></td>
                                                            </tr>
                                                        <?php }?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- END OF 3RD ROW  PURCHASE AREA -->

                                            <!-- 4TH ROW SALES AREA-->
                                            <div class="col-6">
                                                <h3>Sales History</h3>
                                                <table class="table table-success">
                                                    <thead>
                                                        <tr>
                                                            <th>Date</th>
                                                            <th>Invoice No.</th>
                                                            <th>Warehouse</th>
                                                            <th>Quantity</th>
                                                            <th>Method</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach($inventory_model->getsalestrasaction($vicn['item_id']) as $st){?>
                                                            <tr>
                                                                <td><?= $st['invoice_date']?></td>
                                                                <td><?= $st['invoice_no']?></td>
                                                                <td><?= $st['name']?></td>
                                                                <td><?= $st['quantity']?></td>
                                                                <td><?= $st['delivery_method']?></td>
                                                            </tr>
                                                        <?php }?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- END OF 4TH ROW SALES AREA -->
                                        </div>

                                            <!-- 5TH ROW TRANSFER AREA -->
                                            <div class="col-12">
                                                    <h3>Transfer History</h3>
                                                    <table class="table table-info">
                                                        <thead>
                                                            <tr>
                                                                <th>Date</th>
                                                                <th>From Warehouse</th>
                                                                <th>To Warehouse</th>
                                                                <th>Quantity</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php foreach($inventory_model->gettransfertransaction($vicn['item_id']) as $tt){
                                                            $whnf =  $inventory_model->getwarehousename($tt['transfer_from']);
                                                            $whnt =  $inventory_model->getwarehousename($tt['transfer_to']);
                                                            ?>
                                                            <tr>
                                                                <td><?= $tt['transfer_date']?></td>
                                                                <td><?= $whnf['name']?></td>
                                                                <td><?= $whnt['name']?></td>
                                                                <td><?= $tt['quantity']?></td>
                                                            </tr>
                                                        <?php }?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <!-- END OF 5TH ROW TRANSFER AREA -->
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Ok</button>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END OF MODAL VIEW -->
                        
                        
                        <?php }?>
                    </td>
                    <!-- END VARIATION -->

                    <!-- RETAIL PRICE -->
                    <td class="">
                        <?php foreach($item_model->getVariationItems($i['item_id']) as $virp){?>
                           <?= $virp['retail_price'];?><br>
                        <?php }?>
                    </td>
                    <!-- END OF RETAIL PRICE -->

                    <!-- INVENTORY -->
                    <td>
                        <?php $qty = 0;
                            // DISPLAY OF ITEM VARIATIONS
                            foreach($item_model->getVariationItems($i['item_id']) as $vistk){
                                $stk = $inventory_model->getaboutitem($vistk['item_id']);
                                $total = $stk['qtyitem'] - ($stk['damageitem'] + $stk['displayitem'] + $stk['salesitem']);
                                $qty += $total;

                        ?>
                                <?= $total;?><br>
                
                        <?php }?>
                        <br>
                        <hr>
                        Total: <?= $qty;?>
                    </td>
                    <!-- END OF INVENTORY -->
                <?php }?>
				</tr>
			</tbody>
		</table>
	</div>

</div>








