<?php 
namespace App\Controllers;
use CodeIgniter\API\ResponseTrait;
use TCPDF; // PDF Library
class Purchase_controller extends BaseController{
    /** 
        All Display function has user validation of authentication
        if the user rejected/ejected it will return on the login page.
        It checks if user has session and authenticated
    */


    /**
        Properties being used on this file
        * @property purchase_model to load the purchase model
        * @property warehouse_model to load the warehouse model
        * @property system_model to load the system model
        * @property request for the post function method
        * @property encrypter use for encryption
    */
    protected $purchase_model;
    protected $warehouse_model;
    protected $system_model;
    protected $request;
    protected $encrypter;


    /**
        * @method __construct()is being executed automatically when this file is loaded
        * load all the methods/object to the properties of this class
    */
    public function __construct(){

        \Config\Services::session();
        $this->purchase_model = new \App\Models\Purchase_model;
        $this->warehouse_model = new \App\Models\Warehouse_model;
        $this->system_model = new \App\Models\System_model;
        $this->request = \Config\Services::Request();
        $this->encrypter = \Config\Services::encrypter(); 
        helper(['form', 'url']);

    }


    /** 
        * @method purchase() use to display the purchase page
        * @param stats contains data submitted which purchase should be displayed
        * @var data->purchase contains the purchase information
        * @var data->stats contains the current data of purchase
        * being displayed on the purchase page
        * @var page is the name of the php file
        * @var data->title displays the title on the Tab browser
    */
    public function purchase($stats){

        // main content
        $page = 'purchase';
        $data['title'] = 'Purchase Management';

        $data['stats'] = ucfirst($stats);
        $data['purchase'] = $this->purchase_model->getAllPurchase($stats);

        echo view('includes/header', $data);
        echo view('purchase/'.$page, $data);
        echo view('includes/footer');

    }


    /** 
        * @method addPurchase() use to display the adding purchase page
        * @var data->warehouse contains the warehouse information
        * @var data->paymentmethod contains the system settings information
        * being displayed on the purchase page
        * @var page is the name of the php file
        * @var data->title being load on the header section and displays the title(Tab Display)
    */
    public function addPurchase(){
 
        // main content
        $page = 'addpurchase';
        $data['title'] = 'Purchase Management';

        $data['warehouse'] = $this->warehouse_model->getActiveWarehouse();
        $data['paymentmethod'] = $this->system_model->getPaymentMethod();

        echo view('includes/header', $data);
        echo view('purchase/'.$page, $data);
        echo view('includes/footer');

    }


    /** 
        * @method editPurchase() use to display the edit purchase page
        * @param pID encrypted data of purchase_id
        * @var data->pid passing the value from @param pID and display on the post update
        * @var data->warehouse contains the warehouse information
        * @var data->paymentmethod contains the system settings information
        * @var data->purchase contains the specific purchase information
        * @var data->puritems contains the specific purchase items information
        * being displayed on the purchase page
        * @var page is the name of the php file
        * @var data->title being load on the header section and displays the title(Tab Display)
    */
    public function editPurchase($pID){

        // main content
        $page = 'editpurchase';
        $data['title'] = 'Purchase Management';

        $data['pid'] = $pID;
        $data['warehouse'] = $this->warehouse_model->getActiveWarehouse();
        $data['paymentmethod'] = $this->system_model->getPaymentMethod();
        $data['purchase'] = $this->purchase_model->getPurchase($pID);
        $data['puritems'] = $this->purchase_model->getPurchaseItems($this->encrypter->decrypt(str_ireplace(['~','$'],['/','+'],$pID)));
        
        echo view('includes/header', $data);
        echo view('purchase/'.$page, $data);
        echo view('includes/footer');

    }


    /**
        * @method registerPurchase() is use to route the registration of purchase to the model
        * @var session->purchase_added the msg display on the Interface
        * @return to->addpurchase page
    */
    public function registerPurchase(){

        $this->purchase_model->registerPurchase();
        $_SESSION['purchase_added'] = 'purchase_added';
        return redirect()->to(site_url('purchase/add'));

    }


    /**
        * @method updatePurchase() is use to route the update of purchase to the model
        * @param pID encypted data of purchase_id
        * @var session->purchase_updated the msg display on the Interface
        * @return to->purchase page
    */
    public function updatePurchase($pID){

        $this->purchase_model->updatePurchase($pID);
        $_SESSION['purchase_updated'] = 'purchase_updated';
        return redirect()->to(site_url('purchase/view/all'));

    }
    

    /**
        * @method markPending() is use to route the update of purchase to the model
        * @param pID encypted data of purchase_id
        * @var session->purchase_pending the msg display on the Interface
        * @return to->purchase page
    */
    public function markPending($pID){
        $this->purchase_model->markPending($pID);
        $_SESSION['purchase_pending'] = 'purchase_pending';
        return redirect()->to(site_url('purchase/view/pending'));
    }


    /**
        * @method markDelivered() is use to route the update of purchase to the model
        * @param pID encypted data of purchase_id
        * @var session->purchase_delivered the msg display on the Interface
        * @return to->purchase page
    */
    public function markDelivered($pID){
        $this->purchase_model->markDelivered($pID);
        $_SESSION['purchase_delivered'] = 'purchase_delivered';
        return redirect()->to(site_url('purchase/view/delivered'));
    }


    /**
        * @method markDelivered() is use to route the update of purchase to the model
        * @param pID encypted data of purchase_id
        * @var session->purchase_cancelled the msg display on the Interface
        * @return to->purchase page
    */
    public function markCancelled($pID){
        $this->purchase_model->markCancelled($pID);
        $_SESSION['purchase_cancelled'] = 'purchase_cancelled';
        return redirect()->to(site_url('purchase/view/cancelled'));
    }


}