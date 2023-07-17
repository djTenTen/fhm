<?php
namespace App\Controllers;
use CodeIgniter\API\ResponseTrait;

class Api_controller extends BaseController{

    use ResponseTrait;


    /**
        Properties being used on this file
        * @property supplier_model to load the supplier model
        * @property request for the post function method
    */
    protected $api_model;
    protected $request;
    protected $encrypter;


    /**
        * @method __construct()is being executed automatically when this file is loaded
        * load all the methods/object to the properties of this class
    */
    public function __construct(){

        \Config\Services::session();
        $this->api_model = new \App\Models\Api_model; 
        $this->request = \Config\Services::Request();
        $this->encrypter = \Config\Services::encrypter(); 
        

    }

    public function getAPIContent($section,$part){

        $this->response->setHeader('Access-Control-Allow-Origin', '*');

        $data = $this->api_model->getAPIContent($section,$part);
        return $this->respond($data);

    }


    // public function show($id){
        
    //     return "Showing";

    // }











}