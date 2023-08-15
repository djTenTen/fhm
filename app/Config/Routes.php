<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Login_controller');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();

/*
 * --------------------------------------------------------------------
 * All request is directed here at route, page display, update, add, delete of data are going through this route
 * --------------------------------------------------------------------
 */
$routes->get('/error', 'Login_controller::errors');
/**
    All Routes from the uri are going to the controllers
*/


/**
    Login Page
*/
$routes->get('/', 'Login_controller::loginpage');

/**
    authentication
*/
$routes->post('/authenticate', 'Login_controller::authenticate');
$routes->post('/logout', 'Login_controller::Logout'  ,['filter' => 'auth']);

/**
    Dasboard Landing Page after successfull login
*/
$routes->get('/dashboard', 'Dashboard_controller::dashboard' ,['filter' => 'auth']);

/**
    User Management
*/
$routes->get('/user/usermanagement', 'User_controller::usermanagement' ,['filter' => 'auth']);
$routes->post('/user/registeruser', 'User_controller::registerUser' ,['filter' => 'auth']);
$routes->post('/user/updateuser/(:any)', 'User_controller::updateUser/$1' ,['filter' => 'auth']);
$routes->post('/user/deleteuser/(:any)', 'User_controller::deleteUser/$1' ,['filter' => 'auth']);
$routes->post('/user/addgroup', 'User_controller::addGroup' ,['filter' => 'auth']);
$routes->post('/user/updategroup/(:any)', 'User_controller::updateGroup/$1' ,['filter' => 'auth']);

/**
    User Management
*/
$routes->get('/employee/view/(:any)', 'User_controller::viewEmployee/$1' ,['filter' => 'auth']);
$routes->get('/employee/add', 'User_controller::addEmployee' ,['filter' => 'auth']);
$routes->get('/employee/group', 'User_controller::group' ,['filter' => 'auth']);
$routes->get('/employee/myprofile', 'User_controller::myProfile' ,['filter' => 'auth']);
$routes->post('/employee/save', 'User_controller::saveEmployee' ,['filter' => 'auth']);
$routes->post('/employee/update/(:any)', 'User_controller::updateEmployee/$1' ,['filter' => 'auth']);
$routes->post('/employee/updatemyprofile', 'User_controller::updatemyProfile' ,['filter' => 'auth']);

/**
    System Settings
*/
$routes->get('/systemsettings', 'System_controller::systemSettings' ,['filter' => 'auth']);
$routes->post('/ejectuser/(:any)', 'System_controller::ejectUser/$1' ,['filter' => 'auth']);
$routes->post('/updatesystemsettings/(:any)', 'System_controller::udpateSystemSettings/$1' ,['filter' => 'auth']);

/**
    Suppliers Management
*/
$routes->get('/supplier/view', 'Supplier_controller::supplier' ,['filter' => 'auth']);
$routes->get('/supplier/add', 'Supplier_controller::supplieradd' ,['filter' => 'auth']);
$routes->post('/supplier/save', 'Supplier_controller::saveSupplier' ,['filter' => 'auth']);
$routes->post('/supplier/update/(:any)', 'Supplier_controller::updateSupplier/$1' ,['filter' => 'auth']);

/**
    Customers Management
*/
$routes->get('/costumer/view', 'Customer_controller::costumers' ,['filter' => 'auth']);
$routes->get('/costumer/add', 'Customer_controller::addCustomer' ,['filter' => 'auth']);
$routes->post('/costumer/register', 'Customer_controller::registerCustomer' ,['filter' => 'auth']);
$routes->post('/costumer/update/(:any)', 'Customer_controller::updateCustomer/$1' ,['filter' => 'auth']);
$routes->post('/costumer/updatescorporate/(:any)', 'Customer_controller::updateCorporate/$1' ,['filter' => 'auth']);


/**
    Warehouse Management
*/
$routes->get('/warehouse/view', 'Warehouse_controller::warehouse' ,['filter' => 'auth']);
$routes->get('/warehouse/add', 'Warehouse_controller::addWarehouse' ,['filter' => 'auth']);
$routes->post('/warehouse/update/(:any)', 'Warehouse_controller::updatesWarehouse/$1' ,['filter' => 'auth']);
$routes->post('/warehouse/register', 'Warehouse_controller::registerWarehouse' ,['filter' => 'auth']);


/**
    Item Management
*/
$routes->get('/item/view/(:any)', 'Item_controller::item/$1' ,['filter' => 'auth']);
$routes->get('/item/viewcategory', 'Item_controller::category' ,['filter' => 'auth']);
$routes->get('/item/add', 'Item_controller::addItem' ,['filter' => 'auth']);
$routes->get('/item/edit/(:any)', 'Item_controller::editItem/$1' ,['filter' => 'auth']);
$routes->post('/item/update/(:any)', 'Item_controller::updateItem/$1' ,['filter' => 'auth']);
$routes->post('/item/updatecategory/(:any)', 'Item_controller::updateCategory/$1' ,['filter' => 'auth']);
$routes->post('/item/deactivatecategory/(:any)', 'Item_controller::deactivateCategory/$1' ,['filter' => 'auth']);
$routes->post('/item/registercategory', 'Item_controller::registerCategory' ,['filter' => 'auth']);
$routes->post('/item/register', 'Item_controller::registerItem' ,['filter' => 'auth']);


/**
    Inventory
*/
$routes->get('/inventory/view/(:any)', 'Inventory_controller::inventory/$1' ,['filter' => 'auth']);


/**
    Sales: Reservation Management
*/
$routes->get('/reservation/add', 'Sales_controller::addReservation' ,['filter' => 'auth']);
$routes->get('/reservation/view/(:any)', 'Sales_controller::reservation/$1' ,['filter' => 'auth']);
$routes->get('/reservation/edit/(:any)/(:any)', 'Sales_controller::editReservation/$1/$2' ,['filter' => 'auth']);
$routes->post('/reservation/register', 'Sales_controller::registerReservation' ,['filter' => 'auth']);
$routes->post('/reservation/update/(:any)', 'Sales_controller::updateReservation/$1' ,['filter' => 'auth']);
$routes->get('/reservation/printdispatch/(:any)', 'Sales_controller::printDispatch/$1' ,['filter' => 'auth']);
/**
    Sales: Quotation Management
*/
$routes->get('/quotation/view', 'Sales_controller::quotation' ,['filter' => 'auth']);
$routes->get('/quotation/add', 'Sales_controller::addQuotation' ,['filter' => 'auth']);
$routes->get('/quotation/edit/(:any)', 'Sales_controller::editQuotation/$1' ,['filter' => 'auth']);
$routes->post('/quotation/register', 'Sales_controller::registerQuotation' ,['filter' => 'auth']);
$routes->post('/quotation/update/(:any)', 'Sales_controller::updateQuotation/$1' ,['filter' => 'auth']);
$routes->get('/quotation/printquotation/(:any)', 'Sales_controller::printQuotation/$1' ,['filter' => 'auth']);
$routes->get('/quotation/computedelivery', 'Sales_controller::computeDelivery' ,['filter' => 'auth']);

/**
    Sales Management
*/
$routes->get('/sales/view/(:any)', 'Sales_controller::sales/$1' ,['filter' => 'auth']);
$routes->get('/sales/add', 'Sales_controller::addSales' ,['filter' => 'auth']);
$routes->get('/sales/edit/(:any)/(:any)', 'Sales_controller::editSales/$1/$2' ,['filter' => 'auth']);
$routes->post('/sales/register', 'Sales_controller::registerSales' ,['filter' => 'auth']);
$routes->post('/sales/update/(:any)', 'Sales_controller::updateSales/$1' ,['filter' => 'auth']);
$routes->post('/sales/markdeliveredsales/(:any)', 'Sales_controller::markDeliveredSales/$1' ,['filter' => 'auth']);
$routes->post('/sales/markcancelledsales/(:any)', 'Sales_controller::markCancelledSales/$1' ,['filter' => 'auth']);
$routes->post('/sales/markmissingsales/(:any)', 'Sales_controller::markMissingSales/$1' ,['filter' => 'auth']);

/**
    Purchase Management
*/
$routes->get('/purchase/add', 'Purchase_controller::addPurchase' ,['filter' => 'auth']);
$routes->get('/purchase/view/(:any)', 'Purchase_controller::purchase/$1' ,['filter' => 'auth']);
$routes->get('/purchase/edit/(:any)', 'Purchase_controller::editPurchase/$1' ,['filter' => 'auth']);
$routes->post('/purchase/register', 'Purchase_controller::registerPurchase' ,['filter' => 'auth']);
$routes->post('/purchase/updatepurchase/(:any)', 'Purchase_controller::updatePurchase/$1' ,['filter' => 'auth']);
$routes->post('/purchase/markpending/(:any)', 'Purchase_controller::markPending/$1' ,['filter' => 'auth']);
$routes->post('/purchase/markdelivered/(:any)', 'Purchase_controller::markDelivered/$1' ,['filter' => 'auth']);
$routes->post('/purchase/markcancelled/(:any)', 'Purchase_controller::markCancelled/$1' ,['filter' => 'auth']);

/**
    Stock Transfer Management
*/
$routes->get('/stocktransfer/add', 'Stock_controller::addStockTransfer' ,['filter' => 'auth']);
$routes->get('/stocktransfer/view/(:any)', 'Stock_controller::viewStockTransfer/$1' ,['filter' => 'auth']);
$routes->get('/stocktransfer/edit/(:any)', 'Stock_controller::editStockTransfer/$1' ,['filter' => 'auth']);
$routes->post('/stocktransfer/save', 'Stock_controller::saveStockTransfer' ,['filter' => 'auth']);
$routes->post('/stocktransfer/update/(:any)', 'Stock_controller::updateStockTransfer/$1' ,['filter' => 'auth']);
$routes->post('/stocktransfer/markpending/(:any)', 'Stock_controller::markPendingStockTransfer/$1' ,['filter' => 'auth']);
$routes->post('/stocktransfer/markcompleted/(:any)', 'Stock_controller::markCompletedStockTransfer/$1' ,['filter' => 'auth']);
$routes->post('/stocktransfer/markcancelled/(:any)', 'Stock_controller::markCancelledStockTransfer/$1' ,['filter' => 'auth']);
$routes->get('/stocktransfer/printstocktransfer/(:any)', 'Stock_controller::printStockTransfer/$1' ,['filter' => 'auth']);

/**
    Store: Damage Item Management
*/
$routes->get('/damageitem/view/(:any)', 'Store_controller::viewDamageItem/$1' ,['filter' => 'auth']);
$routes->get('/damageitem/add', 'Store_controller::addDamageItem' ,['filter' => 'auth']);
$routes->get('/damageitem/edit/(:any)', 'Store_controller::editDamageItem/$1' ,['filter' => 'auth']);
$routes->post('/damageitem/save', 'Store_controller::saveDamageItem' ,['filter' => 'auth']);
$routes->post('/damageitem/update/(:any)', 'Store_controller::updateDamageItem/$1' ,['filter' => 'auth']);
$routes->post('/damageitem/markpending/(:any)', 'Store_controller::markpendingDamageItem/$1' ,['filter' => 'auth']);
$routes->post('/damageitem/markreplaced/(:any)', 'Store_controller::markreplacedDamageItem/$1' ,['filter' => 'auth']);
$routes->post('/damageitem/marksold/(:any)', 'Store_controller::marksoldDamageItem/$1' ,['filter' => 'auth']);
/**
    Store: Display Item Management
*/
$routes->get('/displayitem/view/(:any)', 'Store_controller::viewDisplayItem/$1' ,['filter' => 'auth']);
$routes->get('/displayitem/add', 'Store_controller::addDisplayItem' ,['filter' => 'auth']);
$routes->post('/displayitem/save', 'Store_controller::saveDisplayItem' ,['filter' => 'auth']);
$routes->post('/displayitem/markdisplayed/(:any)', 'Store_controller::markdisplayedDisplayItem/$1' ,['filter' => 'auth']);
$routes->post('/displayitem/marksold/(:any)', 'Store_controller::marksoldDisplayItem/$1' ,['filter' => 'auth']);
/**
    Store: Catalog Management
*/
$routes->get('/catalog/add', 'Store_controller::addContent' ,['filter' => 'auth']);
$routes->get('/catalog/addcontent/', 'Store_controller::addContent' ,['filter' => 'auth']);
$routes->get('/catalog/sections/', 'Store_controller::sections' ,['filter' => 'auth']);
$routes->post('/catalog/savesection/', 'Store_controller::saveSection' ,['filter' => 'auth']);
$routes->post('/catalog/savecontent/', 'Store_controller::saveContent' ,['filter' => 'auth']);

/**
    Ecommerce: Lazada Sales Management
*/
$routes->get('/lazada/view/(:any)', 'Ecommerce_controller::viewLazada/$1' ,['filter' => 'auth']);
$routes->get('/lazada/add/', 'Ecommerce_controller::addLazada' ,['filter' => 'auth']);
$routes->get('/lazada/edit/(:any)', 'Ecommerce_controller::editLazada/$1' ,['filter' => 'auth']);
$routes->post('/lazada/save/', 'Ecommerce_controller::saveSalesLaz' ,['filter' => 'auth']);
$routes->post('/lazada/update/(:any)', 'Ecommerce_controller::updateLazada/$1' ,['filter' => 'auth']);
$routes->post('/lazada/markpending/(:any)', 'Ecommerce_controller::markPendingLazada/$1' ,['filter' => 'auth']);
$routes->post('/lazada/markdelivered/(:any)', 'Ecommerce_controller::markDeliveredLazada/$1' ,['filter' => 'auth']);
$routes->post('/lazada/markcancelled/(:any)', 'Ecommerce_controller::markCancelledLadaza/$1' ,['filter' => 'auth']);
$routes->post('/lazada/markmissing/(:any)', 'Ecommerce_controller::markMissingLazada/$1' ,['filter' => 'auth']);
$routes->post('/lazada/completeorder', 'Ecommerce_controller::completeOrderLaz' ,['filter' => 'auth']);
/**
    Ecommerce: Shopee Sales Management
*/
$routes->get('/shopee/view/(:any)', 'Ecommerce_controller::viewShopee/$1' ,['filter' => 'auth']);
$routes->get('/shopee/add/', 'Ecommerce_controller::addShopee' ,['filter' => 'auth']);
$routes->get('/shopee/edit/(:any)', 'Ecommerce_controller::editShopee/$1' ,['filter' => 'auth']);
$routes->post('/shopee/save/', 'Ecommerce_controller::saveSalesShop' ,['filter' => 'auth']);
$routes->post('/shopee/update/(:any)', 'Ecommerce_controller::updateShopee/$1' ,['filter' => 'auth']);
$routes->post('/shopee/markpending/(:any)', 'Ecommerce_controller::markPendingShopee/$1' ,['filter' => 'auth']);
$routes->post('/shopee/markdelivered/(:any)', 'Ecommerce_controller::markDeliveredShopee/$1' ,['filter' => 'auth']);
$routes->post('/shopee/markcancelled/(:any)', 'Ecommerce_controller::markCancelledShopee/$1' ,['filter' => 'auth']);
$routes->post('/shopee/markmissing/(:any)', 'Ecommerce_controller::markMissingShopee/$1' ,['filter' => 'auth']);
$routes->post('/shopee/completeorder', 'Ecommerce_controller::completeOrderShop' ,['filter' => 'auth']);

/**
    Accounting: Bank Management
*/
$routes->get('/bank/view/', 'Accounting_controller::bankAccount' ,['filter' => 'auth']);
$routes->post('/bank/save/', 'Accounting_controller::saveBankAccount' ,['filter' => 'auth']);
$routes->post('/bank/update/(:any)', 'Accounting_controller::updateBank/$1' ,['filter' => 'auth']);
/**
    Accounting: Expense Management
*/
$routes->get('/expense/view/(:any)', 'Accounting_controller::viewExpense/$1' ,['filter' => 'auth']);
$routes->get('/expense/add/', 'Accounting_controller::addExpense' ,['filter' => 'auth']);
$routes->get('/expense/edit/(:any)', 'Accounting_controller::editExpense/$1' ,['filter' => 'auth']);
$routes->get('/expense/printvoucher/(:any)', 'Accounting_controller::printVoucher/$1' ,['filter' => 'auth']);
$routes->get('/expense/expensecategory', 'Accounting_controller::expenseCategory' ,['filter' => 'auth']);
$routes->post('/expense/save/', 'Accounting_controller::saveExpense' ,['filter' => 'auth']);
$routes->post('/expense/saveexpensecategory/', 'Accounting_controller::saveExpenseCategory' ,['filter' => 'auth']);
$routes->post('/expense/updateexpensecategory/(:any)', 'Accounting_controller::updateExpenseCategory/$1' ,['filter' => 'auth']);
$routes->post('/expense/update/(:any)', 'Accounting_controller::updateExpense/$1' ,['filter' => 'auth']);
$routes->post('/expense/markpending/(:any)', 'Accounting_controller::updateExpensePending/$1' ,['filter' => 'auth']);
$routes->post('/expense/markverified/(:any)', 'Accounting_controller::updateExpenseVerified/$1' ,['filter' => 'auth']);
$routes->post('/expense/markcancelled/(:any)', 'Accounting_controller::updateExpenseCancelled/$1' ,['filter' => 'auth']);
/**
    Accounting: Payment Management
*/
$routes->get('/payment/view/(:any)', 'Accounting_controller::viewPayment/$1' ,['filter' => 'auth']);
$routes->get('/payment/add', 'Accounting_controller::addPayment' ,['filter' => 'auth']);
$routes->post('/payment/save', 'Accounting_controller::savePayment' ,['filter' => 'auth']);


/**
    Ajax Routes
*/
$routes->get('/getitem', 'Ajax_controller::getActiveItems' ,['filter' => 'auth']);
$routes->post('/validateusername', 'Ajax_controller::validateUsername' ,['filter' => 'auth']);
$routes->get('/getcustomers', 'Ajax_controller::getCustomers' ,['filter' => 'auth']);
$routes->get('/getsupplier', 'Ajax_controller::getSupplier' ,['filter' => 'auth']);
$routes->get('/checkauthentication', 'Ajax_controller::checkAuthentication');
$routes->get('/supplier/edit/(:any)', 'Ajax_controller::editSupplier/$1' ,['filter' => 'auth']);
$routes->get('/customer/edit/(:any)', 'Ajax_controller::editCustomer/$1' ,['filter' => 'auth']);
$routes->get('/reservation/viewreservationdetails/(:any)', 'Ajax_controller::viewReservationDetails/$1' ,['filter' => 'auth']);
$routes->get('/reservation/viewreservationitems/(:any)', 'Ajax_controller::viewReservationItems/$1' ,['filter' => 'auth']);
$routes->get('/stocktransfer/viewstdetails/(:any)', 'Ajax_controller::viewSTdetails/$1' ,['filter' => 'auth']);
$routes->get('/stocktransfer/viewstitems/(:any)', 'Ajax_controller::viewSTitems/$1' ,['filter' => 'auth']);
$routes->get('/payment/getpurchase/(:any)', 'Ajax_controller::getPurchase/$1' ,['filter' => 'auth']);
$routes->get('/items/viewvariations/(:any)', 'Ajax_controller::viewVariations/$1' ,['filter' => 'auth']);
$routes->get('/quotation/getquotationitem/(:any)', 'Ajax_controller::getQuotationItem/$1' ,['filter' => 'auth']);
$routes->get('/purchase/getpurchasedetails/(:any)', 'Ajax_controller::getPurchaseDetails/$1' ,['filter' => 'auth']);
$routes->get('/purchase/getpurchaseitems/(:any)', 'Ajax_controller::getPurchaseItems/$1' ,['filter' => 'auth']);
$routes->get('/expense/viewstdetails/(:any)', 'Ajax_controller::viewExpenseDetails/$1' ,['filter' => 'auth']);
$routes->get('/expense/viewsummary/(:any)', 'Ajax_controller::viewExpenseSummary/$1' ,['filter' => 'auth']);
$routes->get('/expense/paymenthistory/(:any)', 'Ajax_controller::viewpaymentHistory/$1' ,['filter' => 'auth']);
$routes->get('/sales/viewdetails/(:any)', 'Ajax_controller::viewSalesDetails/$1' ,['filter' => 'auth']);
$routes->get('/sales/viewitems/(:any)', 'Ajax_controller::viewSalesItems/$1' ,['filter' => 'auth']);


/**
    API Routes
*/
$routes->get('/api/content/(:any)/(:any)', 'Api_controller::getAPIContent/$1/$2');
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
