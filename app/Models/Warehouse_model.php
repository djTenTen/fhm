<?php
namespace App\Models;
use CodeIgniter\Model;
class Warehouse_model extends  Model {
    /** 
        most of the function are being called on coresponding controllers
        others directly called on the views.
        This part where all the query communication to the database are being executed
        * @var builder is use for the query builder
    */

    /** 
        Properties being used on this file
        * @property db for the call of database
        * @property request for the post function method
        * @property encrypter for the encryption/decryption method
        * @property time for the current internet time Asia/Singapore based
        * @property date for the current internet date Asia/Singapore based
    */
    protected $db;
    protected $request;
    protected $encrypter;
    protected $time;
    protected $date;


    /**
        * ---------------------------------------------------
        * @property declared table used on the model, ci4 intends to declared table this way
        * ---------------------------------------------------
    */
    protected $tblwh = "tbl_warehouse";
    protected $tblu = "tbl_user";


    /**
        * @method func __construct() is being executed automatically when this file is loaded
        * load all the methods/object on the property of class above and used by other @method
    */
    public function __construct(){

        $this->db = \Config\Database::connect('default'); 
        $this->request = \Config\Services::request();
        $this->encrypter = \Config\Services::encrypter(); 
        date_default_timezone_set("Asia/Singapore"); 
        $this->time = date("H:i:s"); 
        $this->date = date("Y-m-d");

    }


    /**
        * @method getActiveWarehouse() use to get active warehouse information
        * @return warehouse->as->multiple_result
    */
    public function getActiveWarehouse(){

        $query = $this->db->table($this->tblwh.' wh')
                ->select('wh.*, tu.name as nameuser')
                ->join($this->tblu.' tu', 'wh.added_by = tu.user_id', 'inner')
                ->where('wh.status', 'active')
                ->get();

        return $query->getResultArray();

    }


    /**
        * @method getInactiveWarehouse() use to get inactive warehouse information
        * @return warehouse->as->multiple_result
    */
    public function getInactiveWarehouse(){

        $query = $this->db->table($this->tblwh.' wh')
                ->select('wh.*, tu.name as nameuser')
                ->join($this->tblu.' tu', 'wh.added_by = tu.user_id', 'inner')
                ->where('wh.status', 'inactive')
                ->get();

        return $query->getResultArray();

    }


    /**
        * @method registerWarehouse() use to register warehouse information
        * @var data contains data information of the warehouse
        * @return sql_execution bool
    */
    public function registerWarehouse(){

        $data = array(
            'name' => ucfirst($this->request->getPost("name")),
            'address' => ucfirst($this->request->getPost("address")),
            'contact_number' => $this->request->getPost("contact-number"),
            'email_address' => $this->request->getPost("email-address"),
            'status' => 'active',
            'added_by' => $this->encrypter->decrypt($_SESSION['userID']),
            'added_on' => $this->date.' '.$this->time
        );

        $this->db->table($this->tblwh)->insert($data);

    }

    
    /**
        * @method updatesWarehouse() use to update warehouse information based on id
        * @param wID encrypted data of warehouse_id
        * @var wid decrypted data of warehouse_id
        * @var data contains data information of the warehouse
        * @return sql_execution bool
    */
    public function updatesWarehouse($wID){

        $wid = $this->encrypter->decrypt(str_ireplace(['~','$'],['/','+'],$wID));

        $data = array(
            'name' => ucfirst($this->request->getPost("name")),
            'address' => ucfirst($this->request->getPost("address")),
            'contact_number' => $this->request->getPost("contact-number"),
            'email_address' => $this->request->getPost("email-address"),
            'status' => $this->request->getPost("status"),
            'updated_by' => $this->encrypter->decrypt($_SESSION['userID']),
            'updated_on' => $this->date.' '.$this->time
        );

        $this->db->table($this->tblwh)->where("warehouse_id",$wid)->update($data);

    }

    


    























}