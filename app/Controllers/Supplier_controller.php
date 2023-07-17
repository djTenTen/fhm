<?php
namespace App\Controllers;
use CodeIgniter\API\ResponseTrait;
class Supplier_controller extends BaseController{
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
    protected $supplier_model;
    protected $request;


    /**
        * @method __construct()is being executed automatically when this file is loaded
        * load all the methods/object to the properties of this class
    */
    public function __construct(){

        \Config\Services::session();
        $this->supplier_model = new \App\Models\Supplier_model; 
        $this->request = \Config\Services::Request();

    }


    /**
        * @method supplier() use to display the supplier page
        * @var data->activesupp contains the active supplier information
        * @var data->inactivesupp contains the active inactive supplier information
        * being displayed on the sales page
        * @var page is the name of the php file
        * @var data->title displays the title on the Tab browser
    */
    public function supplier(){

        $page = 'supplier';
        $data['title'] = 'Suppliers';

        $data['activesupp'] = $this->supplier_model->viewActiveSupplier();
        $data['inactivesupp'] = $this->supplier_model->viewInactiveSupplier();
        
        echo view('includes/header', $data);
        echo view('supplier/'.$page, $data);
        echo view('includes/footer');
    
    }


    /**
        * @method supplieradd() use to display the adding page of supplier
        * @var page is the name of the php file
        * @var data->title displays the title on the Tab browser
    */
    public function supplieradd(){

        $page = 'addsupplier';
        $data['title'] = 'Add Suppliers';
        
        echo view('includes/header', $data);
        echo view('supplier/'.$page, $data);
        echo view('includes/footer');

    }


    /**
        * @method updateSupplier() is use to route the update of supplier to the model
        * @param sID encypted data of supplier_id
        * @var session->update_supplier the msg display on the Interface
        * @return to->supplier page
    */
    public function updateSupplier($sID){

        $this->supplier_model->updateSupplier($sID);
        $_SESSION['update_supplier'] = 'update_supplier';
        return redirect()->to(site_url('supplier/view'));

    }


    /**
        * @method saveSupplier() is use to route the registration of supplier to the model
        * @var session->add_supplier the msg display on the Interface
        * @return to->supplieradd page
    */
    public function saveSupplier(){

        $this->supplier_model->saveSupplier();
        $_SESSION['add_supplier'] = 'add_supplier';
        return redirect()->to(site_url('supplier/add'));

    }


    


    


}