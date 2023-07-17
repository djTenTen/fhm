<?php 
namespace App\Controllers;
use CodeIgniter\API\ResponseTrait;
class Warehouse_controller extends BaseController{
    /** 
        All Display function has user validation of authentication
        if the user rejected/ejected it will return on the login page.
        It checks if user has session and authenticated
    */

    /**
        Properties being used on this file
        * @property warehouse_model to load the warehouse model
        * @property request for the post function method
    */
    protected $warehouse_model;
    protected $request;


    /**
        * @method __construct()is being executed automatically when this file is loaded
        * load all the methods/object to the properties of this class
    */
    public function __construct(){

        \Config\Services::session();
        $this->warehouse_model = new \App\Models\Warehouse_model;
        $this->request = \Config\Services::Request();
        helper(['form', 'url']);

    }


    /**
        * @method warehouse() use to display the warehouse page
        * @var data->awarehouse contains the active warehouse information
        * @var data->iwarehouse contains the inactive warehouse information
        * being displayed on the sales page
        * @var page is the name of the php file
        * @var data->title displays the title on the Tab browser
    */
    public function warehouse(){

        // main content
        $page = 'warehouse';
        $data['title'] = 'Warehouse Management';

        $data['awarehouse'] = $this->warehouse_model->getActiveWarehouse();
        $data['iwarehouse'] = $this->warehouse_model->getInactiveWarehouse();

        echo view('includes/header', $data);
        echo view('warehouse/'.$page, $data);
        echo view('includes/footer');

    }



    /**
        * @method addWarehouse() use to display the warehouse adding page
        * @var page is the name of the php file
        * @var data->title displays the title on the Tab browser
    */
    public function addWarehouse(){

        // main content
        $page = 'addwarehouse';
        $data['title'] = 'Warehouse Management';

        echo view('includes/header', $data);
        echo view('warehouse/'.$page, $data);
        echo view('includes/footer');

    }


    /**
        * @method updatesWarehouse() is use to route the update of warehouse to the model
        * @param wID encypted data of warehouse_id
        * @var session->warehouse_updated the msg display on the Interface
        * @return to->warehouse page
    */
    public function updatesWarehouse($wID){

        $this->warehouse_model->updatesWarehouse($wID);
        $_SESSION['warehouse_updated'] = 'warehouse_updated';
        return redirect()->to(site_url('warehouse/view'));

    }


    /**
        * @method registerWarehouse() is use to route the registration of warehouse to the model
        * @var session->warehouse_updated the msg display on the Interface
        * @return to->warehouse page
    */
    public function registerWarehouse(){

        $this->warehouse_model->registerWarehouse();
        $_SESSION['warehouse_register'] = 'warehouse_register';
        return redirect()->to(site_url('warehouse/add'));

    }





    
















}