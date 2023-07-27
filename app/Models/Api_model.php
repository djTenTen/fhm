<?php
namespace App\Models;
use CodeIgniter\Model;
class Api_model extends  Model {
    /** 
        API MODULE
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
    protected $tblst = "tbl_stock_transfer";
    protected $tblcs = "tbl_catalog_section";
    protected $tblc = "tbl_catalog";
    protected $tblic = "tbl_item_category";


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



    public function getAPIContent($section,$part){

        $query = $this->db->query("select c.*, cs.section_name, cs.part, ic.name as category
        from ".$this->tblc." c,".$this->tblcs." cs ,".$this->tblic." ic
        where c.catalog_section_id = cs.catalog_section_id
        and c.item_category_id = ic.item_category_id
        and c.status = 'active'
        and cs.section_name = '$section'
        and cs.part = '$part'");
        
        $arr = [];
        $key = 0;
        foreach($query->getResultArray() as $row){
            $data = [
                'key' => $key,
                'content_name' => $row['content_name'],
                'description' => $row['description'],
                'category' => $row['category'],
                'catalog_section_id' => $row['catalog_section_id'],
                'catalog_id' => $row['catalog_id'],
                'imgurl' => site_url('public/content/').$row['catalog_id'].'.JPG'
            ];

            $key ++;
            array_push($arr, $data);
        }

        return $arr;

    }









}