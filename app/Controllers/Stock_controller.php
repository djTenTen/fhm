<?php
namespace App\Controllers;
use CodeIgniter\API\ResponseTrait;
class Stock_controller extends BaseController{
    /** 
        All Display function has user validation of authentication
        if the user rejected/ejected it will return on the login page.
        It checks if user has session and authenticated
    */

    
    /**
        Properties being used on this file
        * @property supplier_model to load the supplier model
        * @property request for the post function method
    */
    protected $warehouse_model;
    protected $stock_model;
    protected $request;
    protected $encrypter;


    /**
        * @method __construct()is being executed automatically when this file is loaded
        * load all the methods/object to the properties of this class
    */
    public function __construct(){

        \Config\Services::session();
        $this->warehouse_model = new \App\Models\Warehouse_model;
        $this->stock_model = new \App\Models\Stock_model; 
        $this->request = \Config\Services::Request();
        $this->encrypter = \Config\Services::encrypter(); 

    }


    /**
        * @method addStockTransfer() use to display the adding page of stock transfer
        * @var data->warehouse contains the warehouse information
        * being displayed on the stock transfer page
        * @var page is the name of the php file
        * @var data->title displays the title on the Tab browser
    */
    public function addStockTransfer(){

        $page = 'addstocktransfer';
        $data['title'] = 'Stock Transfer';
        $data['warehouse'] = $this->warehouse_model->getActiveWarehouse();
        
        echo view('includes/header', $data);
        echo view('stock/'.$page, $data);
        echo view('includes/footer');
    
    }


    /**
        * @method viewStockTransfer() use to display the stock transfer page
        * @param stats contains data submitted which stock transfer should be displayed
        * @var data->stocktransfer contains the current data of stock transfer
        * @var data->warehouse contains the warehouse information
        * being displayed on the stock transfer page
        * @var page is the name of the php file
        * @var data->title displays the title on the Tab browser
    */
    public function viewStockTransfer($stats){

        $page = 'stocktransfer';
        $data['title'] = 'Stock Transfer';

        $data['stats'] = ucfirst($stats);
        $data['stocktransfer'] = $this->stock_model->gettransferstocks($stats);                
        $data['warehouse'] = $this->warehouse_model->getActiveWarehouse();
        
        echo view('includes/header', $data);
        echo view('stock/'.$page, $data);
        echo view('includes/footer');
    
    }


    /** 
        * @method editStockTransfer() use to display the edit stock transfer page
        * @param stID encrypted data of stock_transfer_id
        * @var data->stid passing the value from @param stID and display on the post update
        * @var data->warehouse contains the warehouse information
        * @var data->st contains the stock transfer data information
        * @var data->item contains stock transfer items
        * being displayed on the edit stock transfer page
        * @var page is the name of the php file
        * @var data->title being load on the header section and displays the title(Tab Display)
    */
    public function editStockTransfer($stID){

        $page = 'edtistocktransfer';
        $data['title'] = 'Stock Transfer';            

        $data['stid'] = $stID;
        $data['warehouse'] = $this->warehouse_model->getActiveWarehouse();
        $data['st'] = $this->stock_model->getStockTransfer($stID);
        $data['item'] = $this->stock_model->getTransferItems($this->encrypter->decrypt(str_ireplace(['~','$'],['/','+'],$stID)));      
    
        echo view('includes/header', $data);
        echo view('stock/'.$page, $data);
        echo view('includes/footer');

    }


    /** 
        * @method printStockTransfer() use to display the pdf print of stock transfer
        * @param stID encrypted data of stock_transfer_id
        * @var data->stdata contains transfer information based on id
        * @var data->stitem contains transfer items based on id
        * being displayed on the edit sales page
        * @var page is the name of the php file
    */
    public function printStockTransfer($stID){

        $page = 'printstocktransfer';
        
        $data['stdata'] = $this->stock_model->getStockTransfer($stID);
        $data['stitem'] = $this->stock_model->getTransferItems($this->encrypter->decrypt(str_ireplace(['~','$'],['/','+'],$stID)));

        view('stock/'.$page, $data);
        
    }


    /**
        * @method saveStockTransfer() is use to route the registration of stock transfer to the model
        * @var session->stocktransfer_added the msg display on the Interface
        * @return to->addstocktransfer page
    */
    public function saveStockTransfer(){

        $this->stock_model->saveStockTransfer();
        $_SESSION['stocktransfer_added'] = 'stocktransfer_added';
        return redirect()->to(site_url('stocktransfer/add'));

    }


    /**
        * @method updateStockTransfer() is use to route the update of stock transfer to the model
        * @param stID encypted data of stock_transfer_id
        * @var session->stocktransfer_updated the msg display on the Interface
        * @return to->viewstocktransfer/all page
    */
    public function updateStockTransfer($stID){

        $this->stock_model->updateStockTransfer($stID);
        $_SESSION['stocktransfer_updated'] = 'stocktransfer_updated';
        return redirect()->to(site_url('stocktransfer/view/all'));

    }
    

    /**
        * @method markPendingStockTransfer() is use to route the update of stock transfer to the model
        * @param stID encypted data of stock_transfer_id
        * @var session->stocktransfer_pending the msg display on the Interface
        * @return to->viewstocktransfer/pending page
    */
    public function markPendingStockTransfer($stID){

        $this->stock_model->markPendingStockTransfer($stID);
        $_SESSION['stocktransfer_pending'] = 'stocktransfer_pending';
        return redirect()->to(site_url('stocktransfer/view/pending'));

    }


    /**
        * @method markCompletedStockTransfer() is use to route the update of stock transfer to the model
        * @param stID encypted data of stock_transfer_id
        * @var session->stocktransfer_completed the msg display on the Interface
        * @return to->viewstocktransfer/completed page
    */
    public function markCompletedStockTransfer($stID){

        $this->stock_model->markCompletedStockTransfer($stID);
        $_SESSION['stocktransfer_completed'] = 'stocktransfer_completed';
        return redirect()->to(site_url('stocktransfer/view/completed'));

    }


    /**
        * @method markCancelledStockTransfer() is use to route the update of stock transfer to the model
        * @param stID encypted data of stock_transfer_id
        * @var session->stocktransfer_cancelled the msg display on the Interface
        * @return to->viewstocktransfer/cancelled page
    */
    public function markCancelledStockTransfer($stID){

        $this->stock_model->markCancelledStockTransfer($stID);
        $_SESSION['stocktransfer_cancelled'] = 'stocktransfer_cancelled';
        return redirect()->to(site_url('stocktransfer/view/cancelled'));

    }





    
    
    



}