<?php
namespace App\Models;
use CodeIgniter\Model;
class Item_model extends  Model {
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
    protected $tbli = "tbl_item";
    protected $tblic = "tbl_item_category";


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
        * @method getItems() use to get the items information based on status
        * @param stats status information of items
        * @return item->as->multiple_result
    */
    public function getItems($stats){

        $query = $this->db->query("select tic.name as catename,tags, ti.name as itemname, ti.item_id, ti.status as itemstatus
        from ".$this->tblic." as tic,".$this->tbli." as ti
        where tic.item_category_id = ti.item_category_id
        and  ti.parent = 0
        and ti.status = '$stats'");
        return $query->getResultArray();

    }

    
    /**
        * @method getEditItem() use to get the items information based on id
        * @param iID encrypted data of item_id
        * @var iid decrypted data of item_id
        * @return item->as->single_result
    */
    public function getEditItem($iID){

        $iid = $this->encrypter->decrypt(str_ireplace(['~','$'],['/','+'],$iID));

        $query = $this->db->query("select tic.name as catename, ti.name as itemname, ti.item_id, ti.status as itemstatus, ti.item_category_id, ti.stock_level
        from ".$this->tblic." as tic,".$this->tbli." as ti
        where tic.item_category_id = ti.item_category_id
        and ti.item_id = $iid");
        return $query->getRowArray();

    }


    /**
        * @method getEditVariationItems() use to get the variation items information based on id
        * @param iID encrypted data of item_id
        * @var iid decrypted data of item_id
        * @return item->as->multiple_result
    */
    public function getEditVariationItems($iID){

        $iid = $this->encrypter->decrypt(str_ireplace(['~','$'],['/','+'],$iID));

        $query = $this->db->query("select name,color,wholesale_price,retail_price,item_id
        from ".$this->tbli."
        where parent = $iid");
        return $query->getResultArray();

    }



    /**
        * @method getVariationItems() use to get the variation items information based on id
        * @param iid decrypted data of item_id
        * @return item->as->multiple_result
    */
    public function getVariationItems($iid){

        $query = $this->db->query("select name,color,wholesale_price,retail_price,item_id
        from ".$this->tbli."
        where parent = $iid");
        return $query->getResultArray();

    }


    /**
        * @method getVariationCount() use to get the variation count items information based on id
        * @param iid decrypted data of item_id
        * @return item->as->single_result
    */
    public function getVariationCount($iid){

        $query = $this->db->query("select count(parent) as varcount from ".$this->tbli." where parent = $iid");
        return $query->getRowArray();

    }


    /**
        * @method getCategory() use to get the category items information
        * @return category->as->multiple_result
    */
    public function getCategory(){

        $query = $this->db->query("select * from ".$this->tblic." where status = 'active'");
        return $query->getResultArray();

    }


    /**
        * @method countCategory() use to get the count category items information based on name
        * @param cate contains of category name
        * @return item->as->single_result
    */
    public function countCategory($cate){

        $query = $this->db->query("select count(ti.item_category_id) as countcate
        from ".$this->tbli." as ti
        where ti.item_category_id in (select item_category_id from ".$this->tblic." where name = '$cate')
        and status = 'active'");
        return $query->getRowArray();

    }


    /**
        * @method updateCategory() use to update category information
        * @param cID encrypted data of category_id
        * @var cid decrypted data of category_id
        * @var data container data of category information
        * @return sql_execution bool
    */
    public function updateCategory($cID){

        $cid = $this->encrypter->decrypt(str_ireplace(['~','$'],['/','+'],$cID));

        $data = array(
            'name' => ucfirst($this->request->getPost("name")),
            'updated_by' => $this->encrypter->decrypt($_SESSION['userID']),
            'updated_on' => $this->date.' '.$this->time
        );

        $builder = $this->db->table($this->tblic);
        $builder->where("item_category_id", $cid);
        $builder->update($data);

    }


    /**
        * @method deactivateCategory() use to deactivate category information
        * @param cID encrypted data of category_id
        * @var cid decrypted data of category_id
        * @var data container data of category information
        * @return sql_execution bool
    */
    public function deactivateCategory($cID){

        $cid = $this->encrypter->decrypt(str_ireplace(['~','$'],['/','+'],$cID));

        $data = array(
            'status' => 'inactive',
            'updated_by' => $this->encrypter->decrypt($_SESSION['userID']),
            'updated_on' => $this->date.' '.$this->time
        );

        $builder = $this->db->table($this->tblic);
        $builder->where("item_category_id", $cid);
        $builder->update($data);

    }


    /**
        * @method registerCategory() use to register category information
        * @var data container data of category information
        * @return sql_execution bool
    */
    public function registerCategory(){

        $data = array(
            'name' => ucfirst($this->request->getPost("name")),
            'status' => 'active',
            'added_by' => $this->encrypter->decrypt($_SESSION['userID']),
            'added_on' => $this->date.' '.$this->time
        );

        $builder = $this->db->table($this->tblic);
        $builder->insert($data);

    }


    /**
        * @method registerItem() use to register item information
        * @var data1 container data of parent items information
        * @var rescount contains parent item_id
        * @var filetype_filename for the image upload
        * @var data2 container data of child/variation items information
        * @var rescount2 contains child/variation item_id
        * @return sql_execution bool
    */
    public function registerItem(){

        $t = array();
        foreach(explode(',',$this->request->getPost("tag-name")) as $r){
            array_push($t, $r);
        }

        $data1 = array(
            'item_category_id' => $this->encrypter->decrypt($this->request->getPost("category")),
            'parent' => 0,
            'name' => ucfirst($this->request->getPost("name")),
            'description' => ucfirst($this->request->getPost("description")),
            'tags' => json_encode($t),
            'stock_level' => $this->request->getPost("stock-level"),
            'status' => 'active',
            'added_by' => $this->encrypter->decrypt($_SESSION['userID']),
            'added_on' => $this->date.' '.$this->time
        );

        $builder = $this->db->table($this->tbli);
        $builder->insert($data1);

        $rescount = $this->db->query("select item_id from ".$this->tbli." order by item_id desc limit 1")->getRowArray();
        $iid = $rescount['item_id'];
        // Upload main photo
		$filetype = "jpg";
		$filename = $iid.".".$filetype;
		move_uploaded_file($this->request->getFile("main-photo"), getcwd()."/public/uploads/". $filename);
		
        foreach($_POST['variation-name'] as $i => $var){

            $data2 = array(
                'parent' => $iid,
                'name' => $_POST['variation-name'][$i],
                'color' => $_POST['variation-color'][$i],
                'wholesale_price' => $_POST['wholesale-price'][$i],
                'retail_price' => $_POST['retail-price'][$i],
                'status' => 'active',
                'added_by' => $this->encrypter->decrypt($_SESSION['userID']),
                'added_on' => $this->date.' '.$this->time
            );

            $builder->insert($data2);
            $rescount2 = $this->db->query("select item_id from ".$this->tbli."  where parent = $iid order by item_id desc limit 1")->getRowArray();
            // Upload variations photo
            $filetype = "jpg";
            $filename = $rescount2['item_id'].".".$filetype;
            move_uploaded_file($_FILES['image']['tmp_name'][$i], getcwd()."/public/uploads/". $filename);

        }

    }


    /**
        * @method updateItem() use to register item information
        * @param iID encrypted data of item_id
        * @var iid decrypted data of item_id
        * @var data1 container data of parent items information
        * @var data2 container data of child/variation items information
        * @return sql_execution bool
    */
    public function updateItem($iID){
        $iid = $this->encrypter->decrypt(str_ireplace(['~','$'],['/','+'],$iID));

        $data1 = array(
            'item_category_id' => $this->encrypter->decrypt($this->request->getPost("category")),
            'parent' => 0,
            'name' => ucfirst($this->request->getPost("name")),
            'stock_level' => $this->request->getPost("stock-level"),
            'status' => $this->request->getPost("status"),
            'updated_by' => $this->encrypter->decrypt($_SESSION['userID']),
            'updated_on' => $this->date.' '.$this->time
        );

        $builder = $this->db->table($this->tbli);
        $builder->where("item_id", $iid);
        $builder->update($data1);

        foreach($_POST['variation-name'] as $i => $var){

            $data2 = array(
                'name' => $_POST['variation-name'][$i],
                'color' => $_POST['variation-color'][$i],
                'wholesale_price' => $_POST['wholesale-price'][$i],
                'retail_price' => $_POST['retail-price'][$i],
                'updated_by' => $this->encrypter->decrypt($_SESSION['userID']),
                'updated_on' => $this->date.' '.$this->time
            );

            $builder->where("item_id", $this->encrypter->decrypt($_POST['varid'][$i]));
            $builder->update($data2);

        }

    }


}