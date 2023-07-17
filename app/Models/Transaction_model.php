<?php
namespace App\Models;
use CodeIgniter\Model;
class Transaction_model extends  Model {

    /*
        * @object $db for the call of database
        * @object $request for the post function method
        * @object $encrypter for the encryption/decryption method
        * @object $time for the current internet time Asia/Singapore based
        * @object $date for the current internet date Asia/Singapore based
    */
    protected $db;
    protected $request;
    protected $encrypter;
    protected $time;
    protected $date;


    /*
        * this function __construct is being executed automatically when this file is loaded
        * load all the methods/object on this function being used by this whole class
        * @this->db for the database connection
        * @this->request for POST request comming from the view
        * @this->encrypter for the encryptor and decryptor
        * @this->time for the time
        * @this->date for the date
    */
    public function __construct(){

        $this->db = \Config\Database::connect('default'); 
        $this->request = \Config\Services::request();
        $this->encrypter = \Config\Services::encrypter(); 
        date_default_timezone_set("Asia/Singapore"); 
        $this->time = date("H:i:s"); 
        $this->date = date("Y-m-d");
    }














}