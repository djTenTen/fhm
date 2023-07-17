<?php
namespace App\Controllers;
use CodeIgniter\API\ResponseTrait;
class Ecommerce_controller extends BaseController{
    /** 
        All Display function has user validation of authentication
        if the user rejected/ejected it will return on the login page.
        It checks if user has session and authenticated
    */

    
    /**
        Properties being used on this file
        * @property supplier_model to load the supplier model
        * @property login_model to load the login model
        * @property request for the post function method
    */
    protected $warehouse_model;
    protected $system_model;
    protected $ecommerce_model;
    protected $request;
    protected $encrypter;


    /**
        * @method __construct()is being executed automatically when this file is loaded
        * load all the methods/object to the properties of this class
    */
    public function __construct(){

        \Config\Services::session();
        $this->warehouse_model = new \App\Models\Warehouse_model;
        $this->system_model = new \App\Models\System_model;
        $this->ecommerce_model = new \App\Models\Ecommerce_model; 
        $this->request = \Config\Services::Request();
        $this->encrypter = \Config\Services::encrypter(); 

    }


    /**
        ---------------------------------------------------
        Lazada sales Module area
        ---------------------------------------------------
    */
    public function addLazada(){

        // main content
        $page = 'addlazada';
        $data['title'] = 'Lazada Sales Management';

        $data['warehouse'] = $this->warehouse_model->getActiveWarehouse();
        $data['paymentmethod'] = $this->system_model->getPaymentMethod();

        echo view('includes/header', $data);
        echo view('ecommerce/'.$page, $data);
        echo view('includes/footer');
    
    }

    public function viewLazada($stats){

        // main content
        $page = 'lazadasales';
        $data['title'] = 'Lazada Sales Management';
        $data['stats'] = ucfirst($stats);
        $data['sales'] = $this->ecommerce_model->getAllSalesLaz($stats);

        echo view('includes/header', $data);
        echo view('ecommerce/'.$page, $data);
        echo view('includes/footer');
    
    }

    public function editLazada($sID,$cID){

        // main content
        $page = 'editlazada';
        $data['title'] = 'Sales Management';

        $data['sid'] = $sID;
        $data['warehouse'] = $this->warehouse_model->getActiveWarehouse();
        $data['paymentmethod'] = $this->system_model->getPaymentMethod();
        $data['sales'] = $this->ecommerce_model->getSales($sID);
        $data['ddate'] = explode('/', $data['sales']['invoice_date']);
        $data['salesitem'] = $this->ecommerce_model->getSalesItem($this->encrypter->decrypt(str_ireplace(['~','$'],['/','+'],$sID)));
        $data['customer'] = $this->ecommerce_model->getCostumer($cID);
        

        echo view('includes/header', $data);
        echo view('ecommerce/'.$page, $data);
        echo view('includes/footer');
    
    }

    

    public function saveSalesLaz(){

        $this->ecommerce_model->saveSalesLaz();
        $_SESSION['saleslaz_added'] = 'saleslaz_added';
        return redirect()->to(site_url('lazada/add'));

    }


    public function updateLazada($sID){

        $this->ecommerce_model->updateLazada($sID);
        $_SESSION['saleslaz_updated'] = 'saleslaz_updated';
        return redirect()->to(site_url('lazada/view/all'));

    }


    public function markPendingLazada($sID){

        $this->ecommerce_model->markPendingLazada($sID);
        $_SESSION['saleslaz_pending'] = 'saleslaz_pending';
        return redirect()->to(site_url('lazada/view/pending'));

    }

    public function markDeliveredLazada($sID){

        $this->ecommerce_model->markDeliveredLazada($sID);
        $_SESSION['saleslaz_delivered'] = 'saleslaz_delivered';
        return redirect()->to(site_url('lazada/view/delivered'));

    }

    public function markCancelledLadaza($sID){

        $this->ecommerce_model->markCancelledLadaza($sID);
        $_SESSION['saleslaz_cancelled'] = 'saleslaz_cancelled';
        return redirect()->to(site_url('lazada/view/cancelled'));

    }

    public function markMissingLazada($sID){

        $this->ecommerce_model->markMissingLazada($sID);
        $_SESSION['saleslaz_missing'] = 'saleslaz_missing';
        return redirect()->to(site_url('lazada/view/missing'));

    }


    public function completeOrderLaz(){

        $this->ecommerce_model->completeOrderLaz();
        $_SESSION['saleslaz_completeorder'] = 'saleslaz_completeorder';
        return redirect()->to(site_url('lazada/view/all'));

    }

    
    /**
        ---------------------------------------------------
        End of Lazada sales Module area
        ---------------------------------------------------
    */



    

    
    
    


    /**
        ---------------------------------------------------
        Shopee sales Module area
        ---------------------------------------------------
    */

    public function addShopee(){

        // main content
        $page = 'addshopee';
        $data['title'] = 'Shopee Sales Management';

        $data['warehouse'] = $this->warehouse_model->getActiveWarehouse();
        $data['paymentmethod'] = $this->system_model->getPaymentMethod();

        echo view('includes/header', $data);
        echo view('ecommerce/'.$page, $data);
        echo view('includes/footer');

    }


    public function viewShopee($stats){

        // main content
        $page = 'shopeesales';
        $data['title'] = 'Shopee Sales Management';
        $data['stats'] = ucfirst($stats);
        $data['sales'] = $this->ecommerce_model->getAllSalesShop($stats);

        echo view('includes/header', $data);
        echo view('ecommerce/'.$page, $data);
        echo view('includes/footer');

    }

    public function editShopee($sID,$cID){

        // main content
        $page = 'editshopee';
        $data['title'] = 'Sales Management';

        $data['sid'] = $sID;
        $data['warehouse'] = $this->warehouse_model->getActiveWarehouse();
        $data['paymentmethod'] = $this->system_model->getPaymentMethod();
        $data['sales'] = $this->ecommerce_model->getSales($sID);
        $data['ddate'] = explode('/', $data['sales']['invoice_date']);
        $data['salesitem'] = $this->ecommerce_model->getSalesItem($this->encrypter->decrypt(str_ireplace(['~','$'],['/','+'],$sID)));
        $data['customer'] = $this->ecommerce_model->getCostumer($cID);
        
        echo view('includes/header', $data);
        echo view('ecommerce/'.$page, $data);
        echo view('includes/footer');

    }

    public function saveSalesShop(){

        $this->ecommerce_model->saveSalesShop();
        $_SESSION['salesshop_added'] = 'salesshop_added';
        return redirect()->to(site_url('shopee/add'));

    }
    
    public function updateShopee($sID){

        $this->ecommerce_model->updateShopee($sID);
        $_SESSION['salesshop_updated'] = 'salesshop_updated';
        return redirect()->to(site_url('shopee/view/all'));

    }


    public function markPendingShopee($sID){

        $this->ecommerce_model->markPendingshopee($sID);
        $_SESSION['salesshop_pending'] = 'salesshop_pending';
        return redirect()->to(site_url('shopee/view/pending'));

    }

    public function markDeliveredShopee($sID){

        $this->ecommerce_model->markDeliveredshopee($sID);
        $_SESSION['salesshop_delivered'] = 'salesshop_delivered';
        return redirect()->to(site_url('shopee/view/delivered'));

    }

    public function markCancelledShopee($sID){

        $this->ecommerce_model->markCancelledShopee($sID);
        $_SESSION['salesshop_cancelled'] = 'salesshop_cancelled';
        return redirect()->to(site_url('shopee/view/cancelled'));

    }

    public function markMissingShopee($sID){

        $this->ecommerce_model->markMissingShopee($sID);
        $_SESSION['salesshop_missing'] = 'salesshop_missing';
        return redirect()->to(site_url('shopee/view/missing'));

    }

    public function completeOrderShop(){

        $this->ecommerce_model->completeOrderShop();
        $_SESSION['salesshop_completeorder'] = 'salesshop_completeorder';
        return redirect()->to(site_url('shopee/view/all'));

    }
    
    /**
        ---------------------------------------------------
        End Shopee sales Module area
        ---------------------------------------------------
    */


}