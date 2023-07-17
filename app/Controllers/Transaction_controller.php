<?php 
namespace App\Controllers;
use CodeIgniter\API\ResponseTrait;
class Transaction_controller extends BaseController{
    /** 
        All Display function has user validation of authentication
        if the user rejected/ejected it will return on the login page.
        It checks if user has session and authenticated
    */


    /**
        Properties being used on this file
        * @property inventory_model to load the inventory model
        * @property request for the post function method
    */
    protected $inventory_model;
    protected $request;

    
    /**
        * @method __construct()is being executed automatically when this file is loaded
        * load all the methods/object to the properties of this class
    */
    public function __construct(){

        \Config\Services::session();
        $this->inventory_model = new \App\Models\Inventory_model; 
        $this->request = \Config\Services::Request();
        helper(['form', 'url']);

    }













}