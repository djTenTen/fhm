<?php
namespace App\Models;
use CodeIgniter\Model;
class System_model extends  Model {
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
    protected $tblal = "tbl_access_log";
    protected $tblu = "tbl_user";
    protected $tblug = "tbl_user_group";
    protected $tblo = "tbl_option";
    protected $tbls = "tbl_session";


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
        * @method getAccessLogs() use to get the access logs information of users
        * @return access_logs->as->multiple_result
    */
    public function getAccessLogs(){

        $query = $this->db->query("select * from ".$this->tblal.",tbl_user where ".$this->tblal.".id = tbl_user.user_id order by access_log_id desc");
        return $query->getResultArray();

    }


    /**
        * @method getOnlineUsers() use to get users login information
        * @return users->as->multiple_result
    */
    public function getOnlineUsers(){

        $query = $this->db->query("select ts.*, tu.name as nameuser
        from ".$this->tblu." as tu, ".$this->tbls." as ts
        where tu.user_id = ts.id
        and user_id != 2
        and isdeleted != 1");
        return $query->getResultArray();
   
    }


    /**
        * @method getsettings() use to get the system settings information
        * @return options->as->multiple_result
    */
    public function getsettings(){

        $query = $this->db->query("select * from ".$this->tblo."");
        return $query->getResultArray();

    }


    /**
        * @method ejectUser() use to eject the user from the session on the system
        * @param uID encrypted data of user_id
        * @var uid decrypted data of user_id
        * @return sql_execution bool
    */
    public function ejectUser($sID){

        $sid = $this->encrypter->decrypt(str_ireplace(['~','$'],['/','+'],$sID));
        $this->db->table($this->tbls)->where("session_id", $sid)->delete();
        
    }


    /**
        * @method getPaymentMethod() use get the payment method settings of the system
        * @var res contains payment-method information
        * @return payment_method->json_decoded data
    */
    public function getPaymentMethod(){

        $query = $this->db->query("select value 
        from  ".$this->tblo." 
        where name = 'payment-method'");

        $res = $query->getRowArray();        
        return json_decode($res['value'], true); 

    }


    public function udpateSystemSettings($oID){

        $oid = $this->encrypter->decrypt(str_ireplace(['~','$'],['/','+'],$oID));
        $builder = $this->db->table($this->tblo);
        $builder->where("option_id",$oid);

        if(!empty($this->request->getFile("photo"))){
            $fname = $_FILES['photo'];
            $builder->update(['value' => $fname['name']]);
            move_uploaded_file($fname['tmp_name'], getcwd()."/asset/image/". $fname['name']);
        }else{
            $builder->update(['value' => $this->request->getPost("value")]);
        }   

    }

    public function getLogo(){

        $query = $this->db->query("SELECT * FROM ".$this->tblo." WHERE name = 'site-logo'");
        return $query->getRowArray();
        
    }

    public function getSiteName(){

        $query = $this->db->query("SELECT * FROM ".$this->tblo." WHERE name = 'site-name'");
        return $query->getRowArray();
        
    }
    
}