<?php 
namespace App\Controllers;
use CodeIgniter\API\ResponseTrait;
use TCPDF; // PDF Library
class Sales_controller extends BaseController{
    /** 
        All Display function has user validation of authentication
        if the user rejected/ejected it will return on the login page.
        It checks if user has session and authenticated
    */

    
    /**
        Properties being used on this file
        * @property sales_model to load the sales model
        * @property warehouse_model to load the warehouse model
        * @property system_model to load the system model
        * @property request for the post function method
        * @property encrypter use for encryption
    */
    protected $sales_model;
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
        $this->sales_model = new \App\Models\Sales_model;
        $this->warehouse_model = new \App\Models\Warehouse_model;
        $this->system_model = new \App\Models\System_model;
        $this->request = \Config\Services::Request();
        $this->encrypter = \Config\Services::encrypter(); 
        helper(['form', 'url']);

    }


    /**
        ----------------------------------------------------------
        Sales Module area
        ----------------------------------------------------------

        * @method sales() use to display the sales page
        * @param stats contains data submitted which sales should be displayed
        * @var data->sales contains the sales information
        * @var data->stats contains the current data of sales
        * being displayed on the sales page
        * @var page is the name of the php file
        * @var data->title displays the title on the Tab browser
    */
    public function sales($stats){

        // main content
        $page = 'sales';
        $data['title'] = 'Sales Management';
        $data['stats'] = ucfirst($stats);

        $data['sales'] = $this->sales_model->getAllSales($stats);
        
        echo view('includes/header', $data);
        echo view('sales/'.$page, $data);
        echo view('includes/footer');
    
    }


    /**
        * @method addSales() use to display the adding page of sales
        * @var data->warehouse contains the warehouse information
        * @var data->paymentmethod contains data from the system settings
        * being displayed on the sales page
        * @var page is the name of the php file
        * @var data->title displays the title on the Tab browser
    */
    public function addSales(){

        // main content
        $page = 'addsales';
        $data['title'] = 'Sales Management';

        $data['warehouse'] = $this->warehouse_model->getActiveWarehouse();
        $data['paymentmethod'] = $this->system_model->getPaymentMethod();

        echo view('includes/header', $data);
        echo view('sales/'.$page, $data);
        echo view('includes/footer');

    }


    /** 
        * @method editSales() use to display the edit sales page
        * @param sID encrypted data of sales_id
        * @param cID encrypted data of customer_id
        * @var data->sid passing the value from @param sID and display on the post update
        * @var data->warehouse contains the warehouse information
        * @var data->paymentmethod contains the system settings information
        * @var data->sales contains the specific sales information
        * @var data->salesitem contains the specific sales items information
        * @var data->ddate contains trimed data of date from sales
        * being displayed on the edit sales page
        * @var page is the name of the php file
        * @var data->title being load on the header section and displays the title(Tab Display)
    */
    public function editSales($sID,$cID){

        // main content
        $page = 'editsales';
        $data['title'] = 'Sales Management';

        $data['sid'] = $sID;
        $data['warehouse'] = $this->warehouse_model->getActiveWarehouse();
        $data['paymentmethod'] = $this->system_model->getPaymentMethod();
        $data['sales'] = $this->sales_model->getSales($sID);
        $data['ddate'] = explode('-', $data['sales']['invoice_date']);
        $data['salesitem'] = $this->sales_model->getSalesItem($this->encrypter->decrypt(str_ireplace(['~','$'],['/','+'],$sID)));
        $data['customer'] = $this->sales_model->getCostumer($cID);

        echo view('includes/header', $data);
        echo view('sales/'.$page, $data);
        echo view('includes/footer');

    }


    /**
        * @method registerSales() is use to route the registration of sales to the model
        * @var session->sales_added the msg display on the Interface
        * @return to->addsales page
    */
    public function registerSales(){

        $this->sales_model->registerSales();
        $_SESSION['sales_added'] = 'sales_added';
        return redirect()->to(site_url('sales/add'));

    }


    /**
        * @method updateSales() is use to route the update of sales to the model
        * @param sID encypted data of sales_id
        * @var session->sales_added the msg display on the Interface
        * @return to->sales page
    */
    public function updateSales($sID){

        $this->sales_model->updateSales($sID);
        $_SESSION['sales_updated'] = 'sales_updated';
        return redirect()->to(site_url('sales/view/all'));

    }


    /**
        * @method markDeliveredSales() is use to route the update of sales to the model
        * @param sID encypted data of sales_id
        * @var session->sales_delivered the msg display on the Interface
        * @return to->sales page
    */
    public function markDeliveredSales($sID){

        $this->sales_model->markDeliveredSales($sID);
        $_SESSION['sales_delivered'] = 'sales_delivered';
        return redirect()->to(site_url('sales/view/delivered'));

    }


    /**
        * @method markCancelledSales() is use to route the update of sales to the model
        * @param sID encypted data of sales_id
        * @var session->sales_cancelled the msg display on the Interface
        * @return to->sales page
    */
    public function markCancelledSales($sID){

        $this->sales_model->markCancelledSales($sID);
        $_SESSION['sales_cancelled'] = 'sales_cancelled';
        return redirect()->to(site_url('sales/view/cancelled'));

    }


    /**
        * @method markMissingSales() is use to route the update of sales to the model
        * @param sID encypted data of sales_id
        * @var session->sales_missing the msg display on the Interface
        * @return to->sales page
    */
    public function markMissingSales($sID){

        $this->sales_model->markMissingSales($sID);
        $_SESSION['sales_missing'] = 'sales_missing';
        return redirect()->to(site_url('sales/view/missing'));

    }
    /**
        ----------------------------------------------------------
        End of Sales Module area
        ----------------------------------------------------------
    */
    
    
    











    




    /**
        ----------------------------------------------------------
        Reservation Module area
        ----------------------------------------------------------

        * @method reservation() use to display the reservation page
        * @param stats contains data submitted which reservation should be displayed
        * @var data->reserve contains the reservation information
        * @var data->idf contains the current data of reservation
        * being displayed on the reservation page
        * @var page is the name of the php file
        * @var data->title displays the title on the Tab browser
    */
    public function reservation($stats){

        // main content
        $page = 'reservation';
        $data['title'] = 'Reservation Management';
        $data['idf'] = ucfirst($stats);
        $data['reserve'] = $this->sales_model->getAllReservation($stats);

        echo view('includes/header', $data);
        echo view('sales/'.$page, $data);
        echo view('includes/footer');
    
    }

   

    /**
        * @method addReservation() use to display the registration page of reservation
        * @var data->warehouse contains the warehouse information
        * being displayed on the sales page
        * @var page is the name of the php file
        * @var data->title displays the title on the Tab browser
    */
    public function addReservation(){

        // main content
        $page = 'addreservation';
        $data['title'] = 'Reservation Management';

        $data['warehouse'] = $this->warehouse_model->getActiveWarehouse();

        echo view('includes/header', $data);
        echo view('sales/'.$page, $data);
        echo view('includes/footer');
    
    }


    /** 
        * @method editReservation() use to display the edit reservation page
        * @param rid encrypted data of reservation_id
        * @param cid encrypted data of customer_id
        * @var data->urid passing the value from @param rid and display on the post update
        * @var data->cmtr contains the specific customer information
        * @var data->rsrv contains the specific reservation information
        * @var data->item contains the specific reservation items information
        * @var data->ddate contains trimed data of date from sales
        * @var data->rid contains decrypted data of @param rid
        * being displayed on the edit sales page
        * @var page is the name of the php file
        * @var data->title being load on the header section and displays the title(Tab Display)
    */
    public function editReservation($rid,$cid){

        // main content
        $page = 'editreservation';
        $data['title'] = 'Reservation Management';
        $data['urid'] = $rid;

        $data['warehouse'] = $this->warehouse_model->getActiveWarehouse();
        $data['ctmr'] = $this->sales_model->getCostumer($cid);
        $data['rsrv'] = $this->sales_model->getReservation($rid);
        $data['ddate'] = explode('-', $data['rsrv']['delivery_date']);
        $data['rid'] =  $this->encrypter->decrypt(str_ireplace(['~','$'],['/','+'],$rid));
        $data['item'] = $this->sales_model->getReserveItem($this->encrypter->decrypt(str_ireplace(['~','$'],['/','+'],$rid)));

        echo view('includes/header', $data);
        echo view('sales/'.$page, $data);
        echo view('includes/footer');

    }
    

    /** 
        * @method printDispatch() use to display the pdf print of dispatch item from reservation
        * @param rID encrypted data of reservation_id
        * @var data->rdata contains reservation information based on id
        * @var data->count contains the count of items via reservation based on id
        * @var data->subtotal contains the sum of quantity x price of the items based on id
        * @var data->ritem contains the reservation item based on id
        * being displayed on the edit sales page
        * @var page is the name of the php file
    */
    public function printDispatch($rID){

        $page = 'printdispatchform';
        
        $data['rdata'] = $this->sales_model->getReservation($rID);
        $data['count'] = $this->sales_model->countItems($rID);
        $data['subtotal'] = $this->sales_model->getsubtotal($this->encrypter->decrypt(str_ireplace(['~','$'],['/','+'],$rID)));
        $data['ritem'] = $this->sales_model->getReserveItem($this->encrypter->decrypt(str_ireplace(['~','$'],['/','+'],$rID)));

        view('sales/'.$page, $data);
        
    }


    /**
        * @method registerReservation() is use to route the registration of reservation to the model
        * @var session->reservation_added the msg display on the Interface
        * @return to->addreservation page
    */
    public function registerReservation(){

        $this->sales_model->registerReservation();
        $_SESSION['reservation_added'] = 'reservation_added';
        return redirect()->to(site_url('reservation/add'));

    }


    /**
        * @method updateReservation() is use to route the update of reservation to the model
        * @param rID encypted data of reservation_id
        * @var session->reservation_updated the msg display on the Interface
        * @return to->reservation page
    */
    public function updateReservation($rID){

        $this->sales_model->updateReservation($rID);
        $_SESSION['reservation_updated'] = 'reservation_updated';
        return redirect()->to(site_url('reservation/view/all'));

    }
    /**
        ----------------------------------------------------------
        End of Reservation Module area
        ----------------------------------------------------------
    */














    /**
        ----------------------------------------------------------
        Quotation Module area
        ----------------------------------------------------------

        * @method quotation() use to display the quotation page
        * @var data->quotation contains the quotation information
        * being displayed on the reservation page
        * @var page is the name of the php file
        * @var data->title displays the title on the Tab browser
    */
    public function quotation(){
        
        // main content
        $page = 'quotation';
        $data['title'] = 'Quotation Management';

        $data['quotation'] = $this->sales_model->getQuotations();

        echo view('includes/header', $data);
        echo view('sales/'.$page, $data);
        echo view('includes/footer');

    }


    /**
        * @method addQuotation() use to display the registration of quotation page
        * @var page is the name of the php file
        * @var data->title displays the title on the Tab browser
    */
    public function addQuotation(){

        // main content
        $page = 'addquotation';
        $data['title'] = 'Quotation Management';

        echo view('includes/header', $data);
        echo view('sales/'.$page, $data);
        echo view('includes/footer');
    
    }


    /** 
        * @method editQuotation() use to display the edit quotaion page
        * @param qID encrypted data of quotation_id
        * @var data->qid passing the value from @param qID and display on the post update
        * @var data->item contains the specific quotation items information
        * @var data->qdata contains the specific quotation information
        * being displayed on the edit sales page
        * @var page is the name of the php file
        * @var data->title being load on the header section and displays the title(Tab Display)
    */
    public function editQuotation($qID){

        // main content
        $page = 'editquotation';
        $data['title'] = 'Quotation Management';

        $data['qid'] = $qID;
        $data['item'] = $this->sales_model->getQuotationItem($qID);
        $data['qdata'] = $this->sales_model->getQuotationData($qID);
        
        echo view('includes/header', $data);
        echo view('sales/'.$page, $data);
        echo view('includes/footer');
    
    }


    /** 
        * @method printQuotation() use to display the pdf print of quotation
        * @param qID encrypted data of quotation_id
        * @var data->qdata contains quotation information based on id
        * @var data->qitem contains the quotation item based on id
        * being displayed on the edit sales page
        * @var page is the name of the php file
    */
    public function printQuotation($qID){

        $page = 'printquotation';
        
        $data['qdata'] = $this->sales_model->getQuotationData($qID);
        $data['qitem'] = $this->sales_model->getQuotationItem($qID);

        view('sales/'.$page, $data);
        
    }


    /**
        * @method registerQuotation() is use to route the registration of quotation to the model
        * @var session->quotation_added the msg display on the Interface
        * @return to->addquotation page
    */
    public function registerQuotation(){
        
        $this->sales_model->registerQuotation();
        $_SESSION['quotation_added'] = 'quotation_added';
        return redirect()->to(site_url('quotation/add'));

    }

    
    /**
        * @method updateQuotation() is use to route the update of quotation to the model
        * @param qID encypted data of quptaion_id
        * @var session->quotation_updated the msg display on the Interface
        * @return to->quotation page
    */
    public function updateQuotation($qID){

        $this->sales_model->updateQuotation($qID);
        $_SESSION['quotation_updated'] = 'quotation_updated';
        return redirect()->to(site_url('quotation/view'));

    }







    public function computeDelivery(){

        // main content
        $page = 'computelocation';
        $data['title'] = 'Compute Location';

        echo view('includes/header', $data);
        echo view('sales/'.$page, $data);
        echo view('includes/footer');

    }














}