<?php
namespace App\Models;
use CodeIgniter\Model;
class Supplier_model extends  Model {
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
    protected $tbls = "tbl_supplier";
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
        * @method viewActiveSupplier() use to get the active supplier's information
        * @return supplier->as->multiple_result
    */
    public function viewActiveSupplier(){

        $query = $this->db->query("select ts.* , tu.name as nameuser 
        from ".$this->tbls." ts, ".$this->tblu." tu 
        where ts.status = 'active'
        and ts.added_by = tu.user_id");
        return $query->getResultArray();

    }


    /**
        * @method viewInactiveSupplier() use to get the inactive supplier's information
        * @return supplier->as->multiple_result
    */
    public function viewInactiveSupplier(){

        $query = $this->db->query("select ts.* , tu.name as nameuser 
        from ".$this->tbls." ts, ".$this->tblu." tu 
        where ts.status = 'inactive'
        and ts.added_by = tu.user_id");
        return $query->getResultArray();

    }


    /**
        * @method updateSupplier() use to update the supplier's information
        * @param sID encrypted data of supplier_id
        * @var sir decrypted data of supplier_id
        * @var data data container of supplier information
        * @return sql_execution bool
    */
    public function updateSupplier($sID){

        $sid = $this->encrypter->decrypt(str_ireplace(['~','$'],['/','+'],$sID));

        $data = [
            'name' => ucfirst($this->request->getPost("name")),
            'address' => ucfirst($this->request->getPost("address")),
            'contact_number' => $this->request->getPost("contact-number"),
            'contact_person' => ucfirst($this->request->getPost("contact-person")),
            'position' => ucfirst($this->request->getPost("position")),
            'remarks' => ucfirst($this->request->getPost("remarks")),
            'status' => $this->request->getPost("status"),
            'updated_by' => $this->encrypter->decrypt($_SESSION['userID']),
            'updated_on' => $this->date.' '.$this->time
        ];

        $this->db->table($this->tbls)->where("supplier_id", $sid)->update($data);

    }


    /**
        * @method saveSupplier() use to register the supplier's information
        * @var data data container of supplier information
        * @return sql_execution bool
    */
    public function saveSupplier(){

        $data = [
            'name' => ucfirst($this->request->getPost("name")),
            'address' => ucfirst($this->request->getPost("address")),
            'contact_number' => $this->request->getPost("contact-number"),
            'contact_person' => ucfirst($this->request->getPost("contact-person")),
            'position' => ucfirst($this->request->getPost("position")),
            'remarks' => ucfirst($this->request->getPost("remarks")),
            'status' => 'active',
            'added_by' => $this->encrypter->decrypt($_SESSION['userID']),
            'added_on' => $this->date.' '.$this->time
        ];
        $this->db->table($this->tbls)->insert($data);

    }


    



















}