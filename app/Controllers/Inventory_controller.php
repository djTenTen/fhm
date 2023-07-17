<?php 
namespace App\Controllers;
use CodeIgniter\API\ResponseTrait;
class Inventory_controller extends BaseController{
    /** 
        All Display function has user validation of authentication
        if the user rejected/ejected it will return on the login page
        It checks if user has session and authenticated
    */


    /**
        Properties being used on this file
        * @property inventory_model to load the inventory model
        * @property warehouse_model to load the warehouse model
        * @property login_model to load the login model
        * @property request for the post function method
    */
    protected $inventory_model;
    protected $warehouse_model;
    protected $request;


    /**
        * @method __construct()is being executed automatically when this file is loaded
        * load all the methods/object to the properties of this class
    */
    public function __construct(){

        \Config\Services::session();
        $this->inventory_model = new \App\Models\Inventory_model; // to access the inventory_model
        $this->warehouse_model = new \App\Models\Warehouse_model; // to access the warehouse_model
        $this->request = \Config\Services::Request(); // for the POST request from the view
        helper(['form', 'url']);

    }


    /**
        * @method inventory() is to view the inventory page
        * @param filter reference for the display on inventory page
        * @var data->acostumer contains items information
        * @var data->warehouse contains warehouse information
        * being displayed on the customer page
        * @var data->title displays the title on the Tab browser
    */

    public function inventory($filter){

        // main content
        $page = 'inventory';
        $data['title'] = 'Iventory Management';

        $data['items'] = $this->inventory_model->getActiveItems($filter);
        $data['warehouse'] = $this->warehouse_model->getActiveWarehouse();

        echo view('includes/header', $data);
        echo view('inventory/'.$page, $data);
        echo view('includes/footer');

    }






















}