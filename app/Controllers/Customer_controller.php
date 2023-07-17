<?php 
namespace App\Controllers;
use CodeIgniter\API\ResponseTrait;
class Customer_controller extends BaseController{
    /** 
        All Display function has user validation of authentication
        if the user rejected/ejected it will return on the login page
        It checks if user has session and authenticated
    */


    /**
        Properties being used on this file
        * @property login_model to load the login model
        * @property customer_model to load the customer model
        * @property request for the post function method
    */
    protected $customer_model;
    protected $request;


    /**
        * @method __construct()is being executed automatically when this file is loaded
        * load all the methods/object to the properties of this class
    */
    public function __construct(){
        \Config\Services::session();
        $this->customer_model = new \App\Models\Customer_model; 
        $this->request = \Config\Services::Request();
        helper(['form', 'url']);

    }


    /**
        * @method costumers() is to view the customer page
        * @var data->acostumer->icostumer->corporate are all customers information records 
        * being displayed on the customer page
        * @var page is the name of the php file
        * @var data->title displays the title on the Tab browser
    */
    public function costumers(){

        // Main content
        $page = 'costumers';
        $data['title'] = 'Costumer Management';

        $data['acostumer'] = $this->customer_model->getActiveCostumers();
        $data['icostumer'] = $this->customer_model->getInactiveCostumers();
        $data['corporate'] = $this->customer_model->getCorporateCostumer();
        
        echo view('includes/header', $data);
        echo view('costumer/'.$page, $data);
        echo view('includes/footer');
    

    }


    /**
        * @method addCustomer() is to view the adding page of customers
        * @var page is the name of the php file
        * @var data->title displays the title on the Tab browser
    */
    public function addCustomer(){

        // Main content
        $page = 'addcustomer';
        $data['title'] = 'Add Customer';

        echo view('includes/header', $data);
        echo view('costumer/'.$page, $data);
        echo view('includes/footer');

    }


    /**
        * @method registerCustomer()  is use to route the registration of customer to the model
        * @var session->customer_added the msg display on the Interface
        * @return to->addcustomer page
    */
    public function registerCustomer(){

        $this->customer_model->registerCustomer();
        $_SESSION['customer_added'] = 'customer_added';
        return redirect()->route('costumer/add');

    }


    /**
        * @method updateCustomer() is use to route the update of customer to the model
        * @param cID is the encrypted data of customer_id
        * @var session->customer_updated the msg display on the Interface
        * @return to->costumer page
    */
    public function updateCustomer($cID){

        $this->customer_model->updateCustomer($cID);
        $_SESSION['customer_updated'] = 'customer_updated';
        return redirect()->route('costumer/view');

    }

    
    /**
        * @method updateCorporate() is use to route the update of corporate customer to the model
        * @param cID is the encrypted data of customer_id
        * @var session->customer_updated the msg display on the Interface
        * @return to->costumer page
    */
    public function updateCorporate($cID){

        $this->customer_model->updateCorporate($cID);
        $_SESSION['corporate_updated'] = 'corporate_updated';
        return redirect()->route('costumer/view');

    }


    







}