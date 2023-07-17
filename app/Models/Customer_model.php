<?php
namespace App\Models;
use CodeIgniter\Model;
class Customer_model extends  Model {
    /** 
        most of the function are being called on coresponding controllers
        others directly called on the views.
        This part where all the query communication to the database are being executed
        * @var builder is use for the query builder
    */


    /**
        Properties being used on this file
        * @property db to load the database connection
        * @property request for the post function method
        * @property encrypter use for encryption
        * @property time load current internet time Asia/Singapore based
        * @property date load current internet date Asia/Singapore based
    */
    protected $db;
    protected $request;
    protected $encrypter;
    protected $time;
    protected $date;

    /**
        * @property declared table used on the model, ci4 intends to declared table this way
    */
    protected $tblc = "tbl_customer";


    /**
        * @method __construct()is being executed automatically when this file is loaded
        * load all the methods/object to the properties of this class
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
        * @method getActiveCostumers() use to get all active costumers
        * @return costumers->as->multiple_result
    */
    public function getActiveCostumers(){

        $query = $this->db->query("select * 
        from ".$this->tblc." 
        where status='active' 
        and type = 'personal' ");
        return $query->getResultArray();

    }


    /**
        * @method getInactiveCostumers() use to get all inactive costumers
        * @return costumers->as->multiple_result
    */
    public function getInactiveCostumers(){

        $query = $this->db->query("select * 
        from ".$this->tblc." 
        where status='inactive' 
        and type = 'personal'");
        return $query->getResultArray();

    }

    /**
        * @method getCorporateCostumer() use to get all corporate costumers
        * @return costumers->as->multiple_result
    */
    public function getCorporateCostumer(){
        $query = $this->db->query("select * 
        from ".$this->tblc." 
        where type = 'corporate'");
        return $query->getResultArray();
    }


    /**
        * @method registerCustomer() use to register customers information
        * @var data->true registration of personal customer information
        * @var data->false registration of corporate customer information
        * @return sql_execution bool
    */
    public function registerCustomer(){

        if($this->request->GetPost("type") == 'personal'){
            $data = [ 
                'name' => ucfirst($this->request->GetPost("name")),
                'address' => ucfirst($this->request->GetPost("address")),
                'contact_number' => $this->request->GetPost("contact-number"),
                'email_address' => $this->request->GetPost("email-address"),
                'type' => $this->request->GetPost("type"),
                'status' => $this->request->GetPost("status"),
                'remarks' => ucfirst($this->request->GetPost("remarks")),
                'status' => 'active',
                'added_by' => $this->encrypter->decrypt($_SESSION['userID']),
                'added_on' => $this->date.' '.$this->time
            ];
        }else{
            $data = [
                'name' => ucfirst($this->request->GetPost("name")),
                'address' => ucfirst($this->request->GetPost("address")),
                'contact_number' => $this->request->GetPost("contact-number"),
                'email_address' => $this->request->GetPost("email-address"),
                'type' => $this->request->GetPost("type"),
                'status' => $this->request->GetPost("status"),
                'remarks' => ucfirst($this->request->GetPost("remarks")),
                'status' => 'active',
                'added_by' => $this->encrypter->decrypt($_SESSION['userID']),
                'added_on' => $this->date.' '.$this->time,
                'username' => $this->request->GetPost("username"),
                'password' => $this->encrypter->encrypt($this->request->getPost('password')),
                'discount' => $this->request->GetPost("discount"),
                'website' => $this->request->GetPost("website"),
                'facebook' => $this->request->GetPost("facebook"),
                'instagram' => $this->request->GetPost("instagram"),
                'lazada' => $this->request->GetPost("lazada"),
                'shopee' => $this->request->GetPost("shopee"),
                'representative_name' => ucfirst($this->request->GetPost("corporate-contact-person")),
                'representative_contact_number' => $this->request->GetPost("corporate-contact-number"),
                'representative_email_address' => $this->request->GetPost("corporate-email-address")
            ];
        }

        $this->db->table($this->tblc)->insert($data);

    }


    /**
        * @method updateCustomer() use to update customers information
        * @param cID encrypted data of customer_id
        * @var cid decrypted data of customer_id
        * @var data container data of customer information
        * @return sql_execution bool
    */
    public function updateCustomer($cID){

        $cid = $this->encrypter->decrypt(str_ireplace(['~','$'],['/','+'],$cID));

        $data = [
            'name' => ucfirst($this->request->GetPost("name")),
            'address' => ucfirst($this->request->GetPost("address")),
            'contact_number' => $this->request->GetPost("contact-number"),
            'email_address' => $this->request->GetPost("email-address"),
            'status' => $this->request->GetPost("status"),
            'remarks' => ucfirst($this->request->GetPost("remarks")),
            'updated_by' => $this->encrypter->decrypt($_SESSION['userID']),
            'updated_on' => $this->date.' '.$this->time
        ];

        $this->db->table($this->tblc)->where("customer_id", $cid)->update($data);

    }


    /**
        * @method updateCorporate() use to update customers information
        * @param cID encrypted data of customer_id
        * @var cid decrypted data of customer_id
        * @var data->true container data of corporate customer information without password
        * @var data->false container data of corporate customer information with password
        * @return sql_execution bool
    */
    public function updateCorporate($cID){
        $cid = $this->encrypter->decrypt(str_ireplace(['~','$'],['/','+'],$cID));

        if(empty($this->request->getPost('password')) or  $this->request->getPost('password') == '' or  $this->request->getPost('password') == null){
        
            $data = [
                'name' => ucfirst($this->request->GetPost("name")),
                'address' => ucfirst($this->request->GetPost("address")),
                'contact_number' => $this->request->GetPost("contact-number"),
                'email_address' => $this->request->GetPost("email-address"),
                'status' => $this->request->GetPost("status"),
                'remarks' => ucfirst($this->request->GetPost("remarks")),
                'updated_by' => $this->encrypter->decrypt($_SESSION['userID']),
                'updated_on' => $this->date.' '.$this->time,
                'discount' => $this->request->GetPost("discount"),
                'website' => $this->request->GetPost("website"),
                'facebook' => $this->request->GetPost("facebook"),
                'instagram' => $this->request->GetPost("instagram"),
                'lazada' => $this->request->GetPost("lazada"),
                'shopee' => $this->request->GetPost("shopee"),
                'representative_name' => ucfirst($this->request->GetPost("corporate-contact-person")),
                'representative_contact_number' => $this->request->GetPost("corporate-contact-number"),
                'representative_email_address' => $this->request->GetPost("corporate-email-address")
            ];

        }else{

            $data = [
                'name' => ucfirst($this->request->GetPost("name")),
                'address' => ucfirst($this->request->GetPost("address")),
                'contact_number' => $this->request->GetPost("contact-number"),
                'email_address' => $this->request->GetPost("email-address"),
                'status' => $this->request->GetPost("status"),
                'remarks' => ucfirst($this->request->GetPost("remarks")),
                'updated_by' => $this->encrypter->decrypt($_SESSION['userID']),
                'updated_on' => $this->date.' '.$this->time,
                'password' => $this->encrypter->encrypt($this->request->getPost('password')),
                'discount' => $this->request->GetPost("discount"),
                'website' => $this->request->GetPost("website"),
                'facebook' => $this->request->GetPost("facebook"),
                'instagram' => $this->request->GetPost("instagram"),
                'lazada' => $this->request->GetPost("lazada"),
                'shopee' => $this->request->GetPost("shopee"),
                'representative_name' => ucfirst($this->request->GetPost("corporate-contact-person")),
                'representative_contact_number' => $this->request->GetPost("corporate-contact-number"),
                'representative_email_address' => $this->request->GetPost("corporate-email-address")
            ];

        }

        $this->db->table($this->tblc)->where("customer_id", $cid)->update($data);

    }




















}