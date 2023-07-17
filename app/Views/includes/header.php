<?php
	$session = \Config\Services::session();
	$sales_model = new \App\Models\Sales_model; // to access the sales_model
	$purchase_model = new \App\Models\Purchase_model; // to access the purchase_model
	$stock_model = new \App\Models\Stock_model; // to access the stock_model
	$system_model = new \App\Models\System_model; 
	$logo = $system_model->getLogo();
	$siteName = $system_model->getSiteName();
	$arr = array();
	$user_model = new \App\Models\User_model; // to access the users_model
	foreach($user_model->getUserAccess($_SESSION['groupid']) as $access){
		array_push($arr, $access['name']);
	}
	
?>

<!DOCTYPE html>
<html lang="en">
<head>

	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Favicon -->
	<link rel="shortcut icon" type="image/x-icon" href="<?= site_url(); ?>asset/image/favicon.png">
	<title><?= $title;?> | <?= $siteName['value'];?></title>
	
	<!-- Vendor CSS -->
	<link href="<?= site_url(); ?>vendor/fontawesome/css/all.min.css" rel="stylesheet">
	<!-- DashForge CSS -->
	<link rel="stylesheet" href="<?= site_url(); ?>asset/css/style.css">
	<link rel="stylesheet" href="<?= site_url(); ?>theme/assets/css/dashforge.css">
	<link rel="stylesheet" href="<?= site_url(); ?>theme/lib/ionicons/css/ionicons.min.css">
	<!-- Vendor Scripts -->      
	<script src="<?= site_url(); ?>theme/lib/jquery/jquery.min.js"></script>
	<script src="<?= site_url(); ?>theme/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="<?= site_url(); ?>theme/lib/perfect-scrollbar/perfect-scrollbar.min.js"></script>
	<script src="<?= site_url(); ?>theme/lib/feather-icons/feather.min.js"></script>

	<!-- select2 -->
	<link rel='stylesheet' href='<?= site_url(); ?>plugin/select2/css/select2.min.css' type='text/css'>
	<script type='text/javascript' src='<?= site_url();?>plugin/select2/js/select2.full.min.js'></script>


	<link href="<?= site_url(); ?>theme/lib/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet">
	<script src="<?= site_url(); ?>theme/lib/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
	<!-- ajax library -->
	<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
	<!-- jQuery UI library -->
	
	<!-- <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script> -->

	<!-- tinymce  -->
	<script src="<?= site_url(); ?>plugin/tinymce/js/tinymce.min.js"></script>
	<script src="<?= site_url(); ?>plugin/jquery-ui/jquery-ui.min.js"></script>
	<link rel="stylesheet" href="<?= site_url(); ?>plugin/jquery-ui/jquery-ui.theme.min.css"/>
	<link rel="stylesheet" href="<?= site_url(); ?>plugin/jquery-ui/jquery-ui.min.css"/>

	<!-- datatable library -->
	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
	<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>

	<!-- Template Scripts -->
	<script src="<?= site_url(); ?>theme/assets/js/dashforge.js"></script>
	<script src="<?= site_url(); ?>theme/assets/js/dashforge.aside.js"></script>
	<!-- Font Awesome -->
	<script src="https://kit.fontawesome.com/c29453de59.js" crossorigin="anonymous"></script>
	<!-- Chartjs -->
	<script src="<?= site_url(); ?>vendor/chartjs/chart.js"></script>
	<!-- Page JS -->
	<script src="<?= site_url(); ?>asset/js/main.min.js"></script>
	<script src="<?= site_url(); ?>asset/js/main.js"></script>
	<script src="<?= site_url(); ?>asset/js/page.js"></script>


	<script>
		function validateSession() {
			$.ajax({
				url: "<?= site_url('checkauthentication');?>",
				type: "GET",
				success: function(response) {
					// Handle the response from the server
					if (response === "invalid") {
						window.location.reload();
					}

				}
			});
		}

		$(document).ready(function() {
			// Call validateSession() every 2 seconds
			setInterval(validateSession, 1000);
		});
	</script>


</head>

<body>

<aside class="aside aside-fixed">
	<div class="aside-header">
		<a href="" class="aside-logo" >
		<img src="<?= site_url(); ?>asset/image/<?= $logo['value'];?>" alt="" srcset="" style="max-width: 160px;">
		
		<div class="d-block wd-80p"></div></a>
		<a href="" class="aside-menu-link">
			<i data-feather="menu"></i>
			<i data-feather="x"></i>
		</a>
	</div>

	<div class="aside-body">
		<ul class="nav nav-aside">

			<li class="nav-label">Dashboard </li>

				<li class="nav-item">
					<a href="" class="nav-link"><i class="fa-duotone fa-gauge-simple-low"></i> <span>Dashboard</span></a>
				</li>

			<?php if(in_array('customer-management', $arr) or in_array('supplier-management', $arr)){?>
			<li class="nav-label">Customer Relations</li>

				<?php if(in_array('supplier-management', $arr)){?>
				<li class="nav-item with-sub <?php if(str_contains(uri_string(), 'supplier')){echo 'active ';}?>">
					<a class="nav-link" data-toggle="collapse" href="#collapssupp" role="button" aria-expanded="false" aria-controls="collapseExample">
						<i class="fa-duotone fa-user-group"></i>
						<span>Supplier</span>
					</a>
					<div class="collapse mg-t-5" id="collapssupp">
					<ul>
						<li class="nav-item">
							<a class="nav-item" href="<?= site_url('/supplier/view'); ?>">View Supplier</a></li>
						<?php if(in_array('add-supplier', $arr)){?>
						<li class="nav-item">
							<a class="nav-item" href="<?= site_url('/supplier/add'); ?>">Add New</a></li>
						<?php }?>
					</ul>
				</div>
					
				</li>


				<?php }?>
				<?php if(in_array('customer-management', $arr)){?>
				<li class="nav-item with-sub <?php if(str_contains(uri_string(), 'costumer')){echo 'active ';}?>">
					<a class="nav-link" data-toggle="collapse" href="#collapsecostumer" role="button" aria-expanded="false" aria-controls="collapseExample">
						<i class="fa-duotone fa-users"></i>
						<span>Customer</span>
					</a>
					<div class="collapse mg-t-5" id="collapsecostumer">
					<ul>
						<li class="nav-item">
							<a class="nav-item" href="<?= site_url('/costumer/view'); ?>">View Costumers</a></li>
						<?php if(in_array('add-customer', $arr)){?>
						<li class="nav-item">
							<a class="nav-item" href="<?= site_url('/costumer/add'); ?>">Add New</a></li>
						<?php }?>
					</ul>
					</div>
				</li>
				
				<?php }?>
			<?php }?>

			<?php if(in_array('warehouse-management', $arr) or in_array('item-management', $arr) or in_array('inventory-management', $arr) or in_array('inventory-management', $arr) or in_array('purchase-management', $arr) or in_array('sales-management', $arr) or in_array('stock-transfer-management', $arr)){?>
			<li class="nav-label">Supply Chain</li>

				<?php if(in_array('warehouse-management', $arr)){?>
					<li class="nav-item with-sub <?php if(str_contains(uri_string(), 'warehouse')){echo 'active';}?>">
						<a class="nav-link" data-toggle="collapse" href="#collapsewarehouse" role="button" aria-expanded="false" aria-controls="collapseExample">
							<i class="fa-duotone fa-warehouse-full"></i>
							<span>Warehouse</span>
						</a>
						<div class="collapse mg-t-5" id="collapsewarehouse">
						<ul>
							<li class="nav-item"><a class="nav-item" href="<?= site_url('/warehouse/view');?>">View Warehouse</a></li>
							<?php if(in_array('add-warehouse', $arr)){?>
							<li class="nav-item"><a class="nav-item" href="<?= site_url('/warehouse/add'); ?>">Add New</a></li>
							<?php }?>
						</ul>
					</div>
					</li>

					
				<?php }?>

				<?php if(in_array('item-management', $arr)){?>
				<li class="nav-item with-sub <?php if(str_contains(uri_string(), 'item')){echo 'active';}?>">
					<a class="nav-link" data-toggle="collapse" href="#collapseitem" role="button" aria-expanded="false" aria-controls="collapseExample">
						<i class="fa-duotone fa-boxes-stacked"></i>
						<span>Item</span>
					</a>
					<div class="collapse mg-t-5" id="collapseitem">
					<ul>	
						<li class="nav-item"><a class="nav-item" href="<?= site_url('/item/view/active'); ?>">View Active</a></li>
						<li class="nav-item"><a class="nav-item" href="<?= site_url('/item/view/inactive'); ?>">View Inactive</a></li>
						<li class="nav-item"><a class="nav-item" href="<?= site_url('/item/add'); ?>">Add New</a></li>
						<li class="nav-item"><a class="nav-item" href="<?= site_url('/item/viewcategory'); ?>">Category</a></li>
					</ul>
				</div>
				</li>
				
				<?php }?>


				<?php if(in_array('inventory-management', $arr)){?>
				<li class="nav-item with-sub <?php if(str_contains(uri_string(), 'inventory')){echo 'active';}?>">
					<a class="nav-link" data-toggle="collapse" href="#collapseinventory" role="button" aria-expanded="false" aria-controls="collapseExample">
						<i class="fa-duotone fa-pallet-boxes"></i>
						<span>Inventory</span>
					</a>
					<div class="collapse mg-t-5" id="collapseinventory">
					<ul>
						<li class="nav-item"><a class="nav-item" href="<?= site_url('/inventory/view/all'); ?>">View Inventory</a></li>
					</ul>
				</div>
				</li>
				
				<?php }?>

				<?php if(in_array('inventory-management', $arr)){?>
				<li class="nav-item with-sub <?php if(str_contains(uri_string(), 'transactions')){echo 'active';}?>">
					<a class="nav-link" data-toggle="collapse" href="#collapsetransaction" role="button" aria-expanded="false" aria-controls="collapseExample">
						<i class="fas fa-layer-group"></i>
						<span>Transactions</span>
					</a>
					<div class="collapse mg-t-5" id="collapsetransaction">
					<ul>
						<li class="nav-item"><a class="nav-item" href="<?= site_url('/purchasetransactions'); ?>">Purchase Transactions</a></li>
						<li class="nav-item"><a class="nav-item" href="<?= site_url('/salestransactions'); ?>">Sales Transactions</a></li>
						<li class="nav-item"><a class="nav-item" href="<?= site_url('/transfertransactions'); ?>">Transfer Transactions</a></li>
					</ul>
				</div>
				</li>
				
				<?php }?>

				<?php if(in_array('sales-management', $arr)){?>
				<li class="nav-item with-sub <?php if(str_contains(uri_string(), 'reservation')){echo 'active';}?>">
					<a class="nav-link" data-toggle="collapse" href="#collapsereservation" role="button" aria-expanded="false" aria-controls="collapseExample">
						<i class="fa-duotone fa-list-check"></i>	
						<span>Reservation</span>
					</a>
					<div class="collapse mg-t-5" id="collapsereservation">
					<ul><?php $rsv = $sales_model->countReservation();?>
						<li class="nav-item"><a class="nav-item" href="<?= site_url('/reservation/view/all'); ?>">View All (<?= $rsv['reserv'];?>)</a></li>
						<li class="nav-item"><a class="nav-item" href="<?= site_url('/reservation/view/open'); ?>">View Open (<?= $rsv['open'];?>)</a></li>
						<li class="nav-item"><a class="nav-item" href="<?= site_url('/reservation/view/ready'); ?>">View Ready (<?= $rsv['ready'];?>)</a></li>
						<li class="nav-item"><a class="nav-item" href="<?= site_url('/reservation/view/completed'); ?>">View Completed (<?= $rsv['completed'];?>)</a></li>
						<li class="nav-item"><a class="nav-item" href="<?= site_url('/reservation/view/cancelled'); ?>">View Cancelled (<?= $rsv['cancelled'];?>)</a></li>
						<?php if(in_array('add-sales', $arr)){?>
							<li class="nav-item"><a class="nav-item" href="<?= site_url('/reservation/add'); ?>">Add New</a></li>
						<?php }?>
					</ul>
				</div>
				</li>
				
				<?php }?>

				<?php if(in_array('sales-management', $arr)){?>
				<li class="nav-item with-sub <?php if(str_contains(uri_string(), 'quotation')){echo 'active';}?>">
					<a class="nav-link" data-toggle="collapse" href="#collapsequotation" role="button" aria-expanded="false" aria-controls="collapseExample">
						<i class="fa-duotone fa-file-word"></i>
						<span>Quotation</span>
					</a>
					<div class="collapse mg-t-5" id="collapsequotation">
					<ul>
						<li class="nav-item"><a class="nav-item" href="<?= site_url('/quotation/view'); ?>">View Quotation</a></li>
						<?php if(in_array('add-sales', $arr)){?>
							<li class="nav-item"><a class="nav-item" href="<?= site_url('/quotation/add'); ?>">Add New</a></li>
						<?php }?>
					</ul>
				</div>
				</li>
				
				<?php }?>

				<?php if(in_array('purchase-management', $arr)){?>
				<li class="nav-item with-sub <?php if(str_contains(uri_string(), 'purchase')){echo 'active';}?>">
					<a class="nav-link" data-toggle="collapse" href="#collapsepurchase" role="button" aria-expanded="false" aria-controls="collapseExample">
						<i class="fa-duotone fa-truck-ramp-couch"></i>
						<span>Purchase</span>
					</a>
					<div class="collapse mg-t-5" id="collapsepurchase">
					<ul> <?php $rsv = $purchase_model->countPurchase();?>
						<li class="nav-item"><a class="nav-item" href="<?= site_url('/purchase/view/all'); ?>">View All (<?= $rsv['purch'];?>)</a></li>
						<li class="nav-item"><a class="nav-item" href="<?= site_url('/purchase/view/pending'); ?>">View Pending (<?= $rsv['pending'];?>)</a></li>
						<li class="nav-item"><a class="nav-item" href="<?= site_url('/purchase/view/delivered'); ?>">View Delivered (<?= $rsv['delivered'];?>)</a></li>
						<li class="nav-item"><a class="nav-item" href="<?= site_url('/purchase/view/cancelled'); ?>">View Cancelled< (<?= $rsv['cancelled'];?>)</a></li>
						<li class="nav-item"><a class="nav-item" href="<?= site_url('/purchase/add'); ?>">Add Purchase</a></li>
					</ul>
				</div>
				</li>
				
				<?php }?>

				<?php if(in_array('sales-management', $arr)){?>
				<li class="nav-item with-sub <?php if(str_contains(uri_string(), 'sales')){echo 'active';}?>">
					<a class="nav-link" data-toggle="collapse" href="#collapsesales" role="button" aria-expanded="false" aria-controls="collapseExample">
						<i class="fa-duotone fa-cash-register"></i>
						<span>Sales</span>
					</a>
					<div class="collapse mg-t-5" id="collapsesales">
					<ul><?php $sls = $sales_model->countSales();?>
						<li class="nav-item"><a class="nav-item" href="<?= site_url('/sales/view/all'); ?>">View All (<?= $sls['sales']; ?>)</a></li>
						<li class="nav-item"><a class="nav-item" href="<?= site_url('/sales/view/delivered'); ?>">View Delivered (<?= $sls['delivered']; ?>)</a></li>
						<li class="nav-item"><a class="nav-item" href="<?= site_url('/sales/view/cancelled'); ?>">View Cancelled (<?= $sls['cancelled']; ?>)</a></li>
						<li class="nav-item"><a class="nav-item" href="<?= site_url('/sales/view/missing'); ?>">View Missing (<?= $sls['missing']; ?>)</a></li>
						<?php if(in_array('add-sales', $arr)){?>
							<li class="nav-item"><a class="nav-item" href="<?= site_url('/sales/add'); ?>">Add New</a></li>
						<?php }?>
					</ul>
				</div>
				</li>
				
				<?php }?>

				<?php if(in_array('stock-transfer-management', $arr)){?>
				<li class="nav-item with-sub <?php if(str_contains(uri_string(), 'stocktransfer')){echo 'active';}?>">
					<a class="nav-link" data-toggle="collapse" href="#collapsestocktransfer" role="button" aria-expanded="false" aria-controls="collapseExample">
						<i class="fa-duotone fa-arrow-right-arrow-left"></i>
						<span>Stock Transfer</span>
					</a>
					<div class="collapse mg-t-5" id="collapsestocktransfer">
					<ul><?php $stk = $stock_model->getcountStockTransfer();?>
						<li class="nav-item"><a class="nav-item" href="<?= site_url('/stocktransfer/view/all'); ?>">View All (<?= $stk['stck'];?>)</a></li>
						<li class="nav-item"><a class="nav-item" href="<?= site_url('/stocktransfer/view/pending'); ?>">View Pending (<?= $stk['pending'];?>)</a></li>
						<li class="nav-item"><a class="nav-item" href="<?= site_url('/stocktransfer/view/completed'); ?>">View Completed (<?= $stk['completed'];?>)</a></li>
						<li class="nav-item"><a class="nav-item" href="<?= site_url('/stocktransfer/view/cancelled'); ?>">View Cancelled (<?= $stk['cancelled'];?>)</a></li>
						<?php if(in_array('add-stock-transfer', $arr)){?>
							<li class="nav-item"><a class="nav-item" href="<?= site_url('/stocktransfer/add'); ?>">Add New</a></li>
						<?php }?>	
					</ul>	
				</div>
				</li>
				
				<?php }?>

			<?php }?>

			<?php if(in_array('damage-item-management', $arr) or in_array('display-item-management', $arr)){?>
			<li class="nav-label">Store Management</li>

				<?php if(in_array('display-item-management', $arr)){?>
				<li class="nav-item with-sub <?php if(str_contains(uri_string(), 'Catalog')){echo 'active';}?>">
					<a class="nav-link" data-toggle="collapse" href="#collapsecatalog" role="button" aria-expanded="false" aria-controls="collapseExample">
						<i class="fa-duotone fa-rectangle-history"></i>
						<span>Catalog</span>
					</a>
					<div class="collapse mg-t-5" id="collapsecatalog">
					<ul>
						<li class="nav-item"><a class="nav-item" href="<?= site_url('/catalog/view/all'); ?>">View All</a></li>
						<li class="nav-item"><a class="nav-item" href="<?= site_url('/catalog/add'); ?>">Add New</a></li>
						<li class="nav-item"><a class="nav-item" href="<?= site_url('/catalog/addcontent'); ?>">Add Contents</a></li>
						<li class="nav-item"><a class="nav-item" href="<?= site_url('/catalog/sections'); ?>">Sections</a></li>
					</ul>
				</div>
				</li>
				<?php }?>
				
				<?php if(in_array('damage-item-management', $arr)){?>
				<li class="nav-item with-sub <?php if(str_contains(uri_string(), 'damageitem')){echo 'active';}?>">
					<a class="nav-link" data-toggle="collapse" href="#collapsedamageitem" role="button" aria-expanded="false" aria-controls="collapseExample">
						<i class="fa-duotone fa-square-fragile"></i>
						<span>Damage Item</span>
					</a>
					<div class="collapse mg-t-5" id="collapsedamageitem">
					<ul>
						<li class="nav-item"><a class="nav-item" href="<?= site_url('/damageitem/view/all'); ?>">View All</a></li>
						<li class="nav-item"><a class="nav-item" href="<?= site_url('/damageitem/view/pending'); ?>">View Pending</a></li>
						<li class="nav-item"><a class="nav-item" href="<?= site_url('/damageitem/view/sold'); ?>">View Sold</a></li>
						<li class="nav-item"><a class="nav-item" href="<?= site_url('/damageitem/view/replaced'); ?>">View Replaced</a></li>
						<li class="nav-item"><a class="nav-item" href="<?= site_url('/damageitem/add');?>">Add New</a></li>	
					</ul>
				</div>
				</li>
				
				<?php }?>
				<?php if(in_array('display-item-management', $arr)){?>
				<li class="nav-item with-sub <?php if(str_contains(uri_string(), 'displayitem')){echo 'active';}?>">
					<a class="nav-link" data-toggle="collapse" href="#collapsedisplayitem" role="button" aria-expanded="false" aria-controls="collapseExample">
						<i class="fa-duotone fa-shelves"></i>
						<span>Display Item</span>
					</a>
					<div class="collapse mg-t-5" id="collapsedisplayitem">
					<ul>
						<li class="nav-item"><a class="nav-item" href="<?= site_url('/displayitem/view/all'); ?>">View All</a></li>
						<li class="nav-item"><a class="nav-item" href="<?= site_url('/displayitem/view/displayed'); ?>">View Displayed</a></li>
						<li class="nav-item"><a class="nav-item" href="<?= site_url('/displayitem/view/sold'); ?>">View Sold</a></li>
						<li class="nav-item"><a class="nav-item" href="<?= site_url('/displayitem/add'); ?>">Add New</a></li>
					</ul>
				</div>
				</li>
				
				<?php }?>
			<?php }?>

			<?php if(in_array('sales-management', $arr)){?>
			<li class="nav-label">E-Commerce</li>

				<li class="nav-item with-sub <?php if(str_contains(uri_string(), 'lazada')){echo 'active';}?>">
					<a class="nav-link" data-toggle="collapse" href="#collapselazada" role="button" aria-expanded="false" aria-controls="collapseExample">
						<i class="fak fa-lazada"></i>
						<span>Lazada</span>
					</a>
					<div class="collapse mg-t-5" id="collapselazada">
					<ul>
						<li class="nav-item"><a class="nav-item" href="<?= site_url('/lazada/view/all'); ?>">View All</a></li>
						<li class="nav-item"><a class="nav-item" href="<?= site_url('/lazada/view/pending'); ?>">View pending</a></li>
						<li class="nav-item"><a class="nav-item" href="<?= site_url('/lazada/view/delivered'); ?>">View delivered</a></li>
						<li class="nav-item"><a class="nav-item" href="<?= site_url('/lazada/view/cancelled'); ?>">View cancelled</a></li>
						<li class="nav-item"><a class="nav-item" href="<?= site_url('/lazada/view/missing'); ?>">View missing</a></li>
						<li class="nav-item"><a class="nav-item" href="<?= site_url('/lazada/add'); ?>">Add New</a></li>
					</ul>
				</div>
				</li>
				

				<li class="nav-item with-sub <?php if(str_contains(uri_string(), 'shopee')){echo 'active';}?>">
					<a class="nav-link" data-toggle="collapse" href="#collapseshopee" role="button" aria-expanded="false" aria-controls="collapseExample">
						<i class="fak fa-shopee"></i>
						<span>Shopee</span>
					</a>
					<div class="collapse mg-t-5" id="collapseshopee">
					<ul>
						<li class="nav-item"><a class="nav-item" href="<?= site_url('/shopee/view/all'); ?>">View All</a></li>
						<li class="nav-item"><a class="nav-item" href="<?= site_url('/shopee/view/pending'); ?>">View pending</a></li>
						<li class="nav-item"><a class="nav-item" href="<?= site_url('/shopee/view/delivered'); ?>">View delivered</a></li>
						<li class="nav-item"><a class="nav-item" href="<?= site_url('/shopee/view/cancelled'); ?>">View cancelled</a></li>
						<li class="nav-item"><a class="nav-item" href="<?= site_url('/shopee/view/missing'); ?>">View missing</a></li>
						<li class="nav-item"><a class="nav-item" href="<?= site_url('/shopee/add'); ?>">Add New</a></li>
					</ul>
				</div>
				</li>
				
			<?php }?>

			<?php if(in_array('expense-management', $arr) or in_array('bank-account-management', $arr)){?>
			<li class="nav-label">Accounting</li>

				<?php if(in_array('bank-account-management', $arr)){?>
				<li class="nav-item with-sub <?php if(str_contains(uri_string(), 'bank')){echo 'active';}?>">
					<a class="nav-link" data-toggle="collapse" href="#collapsebank" role="button" aria-expanded="false" aria-controls="collapseExample">
						<i class="fa-duotone fa-bank"></i>
						<span>Bank Account</span>
					</a>
					<div class="collapse mg-t-5" id="collapsebank">
					<ul>
						<li class="nav-item"><a class="nav-item" href="<?= site_url('/bank/view'); ?>">Bank</a></li>
					</ul>
				</div>
				</li>
				
				<?php }?>

				<?php if(in_array('expense-management', $arr)){?>
				<li class="nav-item with-sub <?php if(str_contains(uri_string(), 'expense')){echo 'active';}?>">
					<a class="nav-link" data-toggle="collapse" href="#collapseexpenses" role="button" aria-expanded="false" aria-controls="collapseExample">
						<i class="fa-duotone fa-file-invoice-dollar"></i>
						<span>Expenses</span>
					</a>
					<div class="collapse mg-t-5" id="collapseexpenses">
					<ul>
						<li class="nav-item"><a class="nav-item" href="<?= site_url('/expense/view/all'); ?>">View All</a></li>
						<li class="nav-item"><a class="nav-item" href="<?= site_url('/expense/view/pending'); ?>">View Pending</a></li>
						<li class="nav-item"><a class="nav-item" href="<?= site_url('/expense/view/completed'); ?>">View Completed</a></li>
						<li class="nav-item"><a class="nav-item" href="<?= site_url('/expense/view/cancelled'); ?>">View Cancelled</a></li>
						<li class="nav-item"><a class="nav-item" href="<?= site_url('/expense/add'); ?>">Add New</a></li>
						<li class="nav-item"><a class="nav-item" href="<?= site_url('/expense/expensecategory'); ?>">Category</a></li>
					</ul>
				</div>
				</li>
				<li class="nav-item with-sub <?php if(str_contains(uri_string(), 'payment')){echo 'active';}?>">
					<a class="nav-link" data-toggle="collapse" href="#collapseexpenses" role="button" aria-expanded="false" aria-controls="collapseExample">
						<i class="fa-duotone fa-money-check-pen"></i>
						<span>Payment</span>
					</a>
					<div class="collapse mg-t-5" id="collapseexpenses">
					<ul>
						<li class="nav-item"><a class="nav-item" href="<?= site_url('/payment/view/all'); ?>">View All</a></li>
						<li class="nav-item"><a class="nav-item" href="<?= site_url('/payment/view/purchase'); ?>">View Purchase</a></li>
						<li class="nav-item"><a class="nav-item" href="<?= site_url('/payment/view/sales'); ?>">View Sales</a></li>
						<li class="nav-item"><a class="nav-item" href="<?= site_url('/payment/view/expense'); ?>">View Expense</a></li>
						<li class="nav-item"><a class="nav-item" href="<?= site_url('/payment/payable'); ?>">View Payable</a></li>
						<li class="nav-item"><a class="nav-item" href="<?= site_url('/payment/receivable'); ?>">View Recievable</a></li>
						<li class="nav-item"><a class="nav-item" href="<?= site_url('/payment/add'); ?>">Add New</a></li>
					</ul>
				</div>
				</li>
				
				<?php }?>
			<?php }?>
			<?php if(in_array('employee-management', $arr) || in_array('fleet-management', $arr)){ ?>
			<li class="nav-label">Operations</li>

				<?php if(in_array('employee-management', $arr)){?>
				<li class="nav-item with-sub <?php if(str_contains(uri_string(), 'employee')){echo 'active';}?>">
					<a class="nav-link" data-toggle="collapse" href="#collapseemployee" role="button" aria-expanded="false" aria-controls="collapseExample">
						<i class="fa-duotone fa-user"></i>
						<span>Employee</span>
					</a>
					<div class="collapse mg-t-5" id="collapseemployee">
					<ul>
						<li class="nav-item"><a class="nav-item" href="<?= site_url('/employee/view/all'); ?>">View All</a></li>
						<li class="nav-item"><a class="nav-item" href="<?= site_url('/employee/view/active'); ?>">View Active</a></li>
						<li class="nav-item"><a class="nav-item" href="<?= site_url('/employee/view/inactive'); ?>">View Inactive</a></li>
						<?php if(in_array('add-employee', $arr)){?>
						<li class="nav-item"><a class="nav-item" href="<?= site_url('/employee/add'); ?>">Add New</a></li>
						<?php }?>
						<?php if(in_array('access-control-list', $arr)){?>
						<li class="nav-item"><a class="nav-item" href="<?= site_url('/employee/group'); ?>">Group</a></li>
						<?php }?>
					</ul>
				</div>
				</li>
				
				<?php }?>

				<li class="nav-item with-sub <?php if(str_contains(uri_string(), 'dailytmimerecord')){echo 'active';}?>">
					<a class="nav-link" data-toggle="collapse" href="#collapsedtr" role="button" aria-expanded="false" aria-controls="collapseExample">
						<i class="fa-light fa-fingerprint"></i>
						<span>Daily Time Record</span>
					</a>
					<div class="collapse mg-t-5" id="collapsedtr">
					<ul>
						<li class="nav-item"><a class="nav-item" href="#">View All</a></li>
						<li class="nav-item"><a class="nav-item" href="#">View -</a></li>
						<li class="nav-item"><a class="nav-item" href="#">Add New</a></li>
						<li class="nav-item"><a class="nav-item" href="#">Category</a></li>
					</ul>
				</div>
				</li>
				
				<li class="nav-item with-sub <?php if(str_contains(uri_string(), 'fleet')){echo 'active';}?>">
					<a class="nav-link" data-toggle="collapse" href="#collapsefleet" role="button" aria-expanded="false" aria-controls="collapseExample">
						<i class="fa-duotone fa-truck-moving"></i>
						<span>Fleet</span>
					</a>
					<div class="collapse mg-t-5" id="collapsefleet">
					<ul>
						<li class="nav-item"><a class="nav-item" href="#">View All</a></li>
						<li class="nav-item"><a class="nav-item" href="#">View -</a></li>
						<li class="nav-item"><a class="nav-item" href="#">Add New</a></li>
						<li class="nav-item"><a class="nav-item" href="#">Category</a></li>
					</ul>
				</div>
				</li>
				



				<li class="nav-item with-sub <?php if(str_contains(uri_string(), 'livetracking')){echo 'active';}?>">
					<a class="nav-link" data-toggle="collapse" href="#collapsefleettracking" role="button" aria-expanded="false" aria-controls="collapseExample">
						<i class="fa-light fa-location-arrow"></i>
						<span>Live Tracking</span>
					</a>
					<div class="collapse mg-t-5" id="collapsefleettracking">
					<ul>
						<li class="nav-item"><a class="nav-item" href="#">View All</a></li>
						<li class="nav-item"><a class="nav-item" href="#">View -</a></li>
						<li class="nav-item"><a class="nav-item" href="#">Add New</a></li>
						<li class="nav-item"><a class="nav-item" href="#">Category</a></li>
					</ul>
				</div>
				</li>
				
			<?php }?>

			<li class="nav-label">Reports</li>
				<li class="nav-item with-sub <?php if(str_contains(uri_string(), 'generatechart')){echo 'active';}?>">
					<a class="nav-link" data-toggle="collapse" href="#collapsegenchart" role="button" aria-expanded="false" aria-controls="collapseExample">
						<i class="fa-duotone fa-chart-area"></i>
						<span>Generate Chart</span>
					</a>
					<div class="collapse mg-t-5" id="collapsegenchart">
					<ul>
						<li class="nav-item"><a class="nav-item" href="#">View All</a></li>
						<li class="nav-item"><a class="nav-item" href="#">View -</a></li>
						<li class="nav-item"><a class="nav-item" href="#">Add New</a></li>
						<li class="nav-item"><a class="nav-item" href="#">Category</a></li>
					</ul>
				</div>
				</li>
				
			
				<li class="nav-item with-sub <?php if(str_contains(uri_string(), 'generatereport')){echo 'active';}?>">
					<a class="nav-link" data-toggle="collapse" href="#collapsegenreport" role="button" aria-expanded="false" aria-controls="collapseExample">
						<i class="fa-duotone fa-file-lines"></i>
						<span>Generate Report</span>
					</a>
					<div class="collapse mg-t-5" id="collapsegenreport">
					<ul>
						<li class="nav-item"><a class="nav-item" href="#">View All</a></li>
						<li class="nav-item"><a class="nav-item" href="#">View -</a></li>
						<li class="nav-item"><a class="nav-item" href="#">Add New</a></li>
						<li class="nav-item"><a class="nav-item" href="#">Category</a></li>
					</ul>
				</div>
				</li>
				
		</ul>
	</div>
</aside>

<div class="content ht-100v pd-0">
	<div class="content-header">
		<div>&nbsp;</div>
		<nav class="nav">
			<div class="dropdown dropdown-profile">
				<a href="#" class="dropdown-link" data-toggle="dropdown" data-display="static">
					<div class="avatar avatar-sm"><img src="<?php echo site_url(); ?>asset/image/avatar.jpg" class="rounded-circle mx-auto"></div>
				</a><!-- dropdown-link -->
				<div class="dropdown-menu dropdown-menu-right tx-13">
					<div class="avatar avatar-lg mg-b-15 mx-auto"><img src="<?php echo site_url(); ?>asset/image/avatar.jpg" class="rounded-circle"></div>

					<h6 class="mg-b-5 tx-semibold text-center"><?= $_SESSION['name'];?></h6>
					<p class="mg-b-25 tx-12 tx-color-03 text-center"><?= $_SESSION['groupname'];?></p>

					<a href="<?= site_url(); ?>employee/myprofile" class="dropdown-item"><i class="fa-duotone fa-user mr-2"></i> View Profile</a>
					<a href="<?= site_url(); ?>employee/myactivities" class="dropdown-item"><i class="fa-duotone fa-user mr-2"></i> My Activities</a>
					
					<div class="dropdown-divider"></div>

					<a href="<?= site_url(); ?>systemsettings" class="dropdown-item"><i class="fa-duotone fa-gears mr-2"></i> System Settings</a>
					<a href="<?= site_url(); ?>user/usermanagement" class="dropdown-item"><i class="fa-duotone fa-users mr-2"></i> User Management</a>
					
					<div class="dropdown-divider"></div>
					
					<a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal"><i class="fa-duotone fa-right-from-bracket mr-2"></i>Sign Out</a>

				</div><!-- dropdown-menu -->
			</div><!-- dropdown -->
		</nav>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="logoutModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				Are you sure to Sign Out?
			</div>
			<div class="modal-footer">
				<?= form_open("logout");?>
					<button type="submit" class="btn btn-primary">Confirm</button>
				<?= form_close();?>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
			</div>
			</div>
		</div>
	</div>
	<!-- END OF MODAL VIEW -->


	<div class="content-body">
		<div class="mg-b-20 mg-lg-b-25 mg-xl-b-30">
			<div>
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb breadcrumb-style1 mg-b-10">
					<li class="breadcrumb-item"><?= $title;?></li>
					<li class="breadcrumb-item active" aria-current="page"><a href=""><span class="tx-primary"></span></a></li>
					</ol>
				</nav>
				<h4 class="mg-b-30 tx-spacing--1"></h4>
			</div>
		</div>