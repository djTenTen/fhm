<?php

namespace App\Controllers;
use CodeIgniter\API\ResponseTrait;
class Dashboard_controller extends BaseController{

    protected $login_model;

    public function __construct(){
        \Config\Services::session();
        $this->login_model = new \App\Models\Login_model; // to access the login_model
    }

    public function dashboard(){

        $page = 'dashboard';

        //title display on the browser's tab
        $data['title'] = 'Furniture House Manila - Dashboard';

        //fecthing/constructing the page from header to body and to footer
        echo view('includes/header', $data);
        echo view('dashboard/'.$page, $data);
        echo view('includes/footer');

    }



}