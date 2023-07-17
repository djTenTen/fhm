<?php
namespace App\Models;
use CodeIgniter\Model;
class Store_model extends  Model {
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
    protected $tbldi = "tbl_damage_item";
    protected $tbldpi = "tbl_display_item";
    protected $tblcs = "tbl_catalog_section";
    protected $tblc = "tbl_catalog";

    
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
        ---------------------------------------------------
        Damage Module area
        ---------------------------------------------------
        * @method getItems() use to get the item information
        * @return sales->as->multiple_result
    */
    public function viewSections(){
        
        $query = $this->db->query("select * from ". $this->tblcs);
        return $query->getResultArray();

    }

    public function saveSection(){
        
        $data = [
            'section_name' => ucfirst($this->request->getPost("section-name")),
            'part' => ucfirst($this->request->getPost("part")),
            'status' => 'active',
            'added_by' => $this->encrypter->decrypt($_SESSION['userID']),
            'added_on' => $this->date.' '.$this->time
        ];

        $this->db->table($this->tblcs)->insert($data);

    }
    
    public function saveContent(){

        $data = [
            'content_name' => ucfirst($this->request->getPost("content-name")),
            'description' => ucfirst($this->request->getPost("description")),
            'catalog_section_id' => $this->encrypter->decrypt($this->request->getPost("section")),
            'item_category_id' => $this->encrypter->decrypt($this->request->getPost("category")),
            'status' => 'active',
            'added_by' => $this->encrypter->decrypt($_SESSION['userID']),
            'added_on' => $this->date.' '.$this->time
        ];
        $this->db->table($this->tblc)->insert($data);
        $last = $this->db->query("select catalog_id from ".$this->tblc." order by catalog_id desc limit 1")->getRowArray();
		$filename = $last['catalog_id'].".jpg";
		move_uploaded_file($this->request->getFile("photo"), getcwd()."/public/content/". $filename);

    }



    /**
        ---------------------------------------------------
        End of Damage Module area
        ---------------------------------------------------
    */





    /**
        ---------------------------------------------------
        Damage Module area
        ---------------------------------------------------
        * @method getItems() use to get the item information
        * @return sales->as->multiple_result
    */
    public function getItems(){

        $query = $this->db->query("SELECT i.parent_id, i.item_id, i.name, i.wholesale_price, i.retail_price
        FROM (
            SELECT parent.item_id AS parent_id, ti.item_id, CONCAT(parent.name, ' - ', ti.name) AS name, ti.wholesale_price, ti.retail_price
            FROM tbl_item ti
            INNER JOIN tbl_item parent ON ti.parent = parent.item_id
            WHERE ti.status = 'active'
            ORDER BY name ASC
        ) AS i
        ORDER BY i.name ASC");

        return $query->getResultArray();
        
    }
    

    /**
        * @method viewEditDamageItems() use to get the damage item information based on id
        * @param diID encrypted data of damage_item_id
        * @var diid decrypted data of damage_item_id
        * @return sales->as->single_result
    */
    public function viewEditDamageItems($diID){

        $diid = $this->encrypter->decrypt(str_ireplace(['~','$'],['/','+'],$diID));

        $query = $this->db->query("SELECT di.damage_item_id, di.reference_number, di.warehouse_id, i.item_id, i.name AS item, di.description, di.classification, i.retail_price, di.status, u.added_by, di.added_on, u2.updated_by, di.updated_on
        FROM tbl_damage_item di
        INNER JOIN tbl_user u ON di.added_by = u.user_id
        LEFT JOIN tbl_user u2 ON di.updated_by = u2.user_id
        INNER JOIN (
            SELECT parent.item_id AS parent_id, ti.item_id, CONCAT(parent.name, ' - ', ti.name) AS name, ti.retail_price
            FROM tbl_item ti
            INNER JOIN tbl_item parent ON ti.parent = parent.item_id
            WHERE ti.parent != 0
        ) AS i ON di.item_id = i.item_id
        WHERE di.damage_item_id = $diid");

        return $query->getRowArray();

    }

    /**
        * @method viewdamageitem() use to get the damage item information based on status
        * @param state status of damage items
        * @return sales->as->multiple_result
    */
    public function viewdamageitem($state){

        if($state == 'all'){
            $query = $this->db->query("SELECT di.damage_item_id, di.reference_number, w.name AS warehouse, i.name AS item, di.description, di.classification, i.retail_price, di.status, u.added_by, di.added_on
            FROM tbl_damage_item di
            INNER JOIN tbl_user u ON di.added_by = u.user_id
            INNER JOIN tbl_item i ON di.item_id = i.item_id
            INNER JOIN tbl_warehouse w ON di.warehouse_id = w.warehouse_id
            WHERE i.parent != '0'
            ORDER BY di.damage_item_id DESC");
            
            return $query->getResultArray();
        }else{
            $query = $this->db->query("SELECT di.damage_item_id, di.reference_number, w.name AS warehouse, i.name AS item, di.description, di.classification, i.retail_price, di.status, u.added_by, di.added_on
            FROM tbl_damage_item di
            INNER JOIN tbl_user u ON di.added_by = u.user_id
            INNER JOIN tbl_item i ON di.item_id = i.item_id
            INNER JOIN tbl_warehouse w ON di.warehouse_id = w.warehouse_id
            WHERE di.status = '$state'
              AND i.parent != '0'
            ORDER BY di.damage_item_id DESC");
            
            return $query->getResultArray();
        }

    }


    /**
        * @method saveDamageItem() use to register the damage item information
        * @var data container data of damage item
        * @var getdid contains damage_item_id for the generation of reference number
        * @var dir contains string path for the picture upload
        * @var c for the count of loop
        * @return sql_execution bool
    */
    public function saveDamageItem(){

        $data = array(
            'warehouse_id' => $this->encrypter->decrypt($this->request->getPost("warehouse")),
            'item_id' => $this->encrypter->decrypt($this->request->getPost("item")),
            'description' => ucfirst($this->request->getPost("description")),
            'classification' => $this->request->getPost("classification"),
            'status' => "pending", 
            'added_by' => $this->encrypter->decrypt($_SESSION['userID']),
            'added_on' => $this->date.' '.$this->time
        );

        $builder = $this->db->table($this->tbldi);
        $builder->insert($data);

        $getdid = $this->db->query("select damage_item_id,item_id from ".$this->tbldi." order by damage_item_id desc limit 1")->getRowArray();

        $builder->where("damage_item_id", $getdid['damage_item_id']);
        $builder->update(['reference_number' => "DMG".date("Ymd").$this->encrypter->decrypt($this->request->getPost("item")).$getdid['damage_item_id']]);

        $dir = APPPATH.'views/store/uploads/'.$getdid['damage_item_id'];
        mkdir($dir, 0777, true);
        $c = 0;
        foreach($_FILES['gallery']['name'] as $i => $key){
            // Upload main photo
            $c++;
            $filetype = "jpg";
            $filename = $this->encrypter->decrypt($this->request->getPost("item"))."-".$c.".".$filetype;
            move_uploaded_file($_FILES['gallery']['tmp_name'][$i], $dir."/". $filename);
        }

    }


    /**
        * @method updateDamageItem() use to update the damage item information
        * @param diID encrypted data of damage_item_id
        * @var diid decrypted data of damage_item_id
        * @var data container data of damage item
        * @return sql_execution bool
    */
    public function updateDamageItem($diID){

        $diid = $this->encrypter->decrypt(str_ireplace(['~','$'],['/','+'],$diID));

        $data = array(
            'warehouse_id' => $this->encrypter->decrypt($this->request->getPost("warehouse")),
            'description' => ucfirst($this->request->getPost("description")),
            'classification' => $this->request->getPost("classification"),
            'updated_by' => $this->encrypter->decrypt($_SESSION['userID']),
            'updated_on' => $this->date.' '.$this->time
        );

        $builder = $this->db->table($this->tbldi);
        $builder->where("damage_item_id", $diid);
        $builder->update($data);    

    }


    /**
        * @method marksoldDamageItem() use to mark sold the damage item information
        * @param diID encrypted data of damage_item_id
        * @var diid decrypted data of damage_item_id
        * @return sql_execution bool
    */
    public function marksoldDamageItem($diID){

        $diid = $this->encrypter->decrypt(str_ireplace(['~','$'],['/','+'],$diID));

        $builder = $this->db->table($this->tbldi);
        $builder->where("damage_item_id", $diid);
        $builder->update(['status' => 'sold']); 

    }


    /**
        * @method markpendingDamageItem() use to mark pending the damage item information
        * @param diID encrypted data of damage_item_id
        * @var diid decrypted data of damage_item_id
        * @return sql_execution bool
    */
    public function markpendingDamageItem($diID){

        $diid = $this->encrypter->decrypt(str_ireplace(['~','$'],['/','+'],$diID));

        $builder = $this->db->table($this->tbldi);
        $builder->where("damage_item_id", $diid);
        $builder->update(['status' => 'pending']); 

    }


    /**
        * @method markreplacedDamageItem() use to mark replaced the damage item information
        * @param diID encrypted data of damage_item_id
        * @var diid decrypted data of damage_item_id
        * @return sql_execution bool
    */
    public function markreplacedDamageItem($diID){

        $diid = $this->encrypter->decrypt(str_ireplace(['~','$'],['/','+'],$diID));

        $builder = $this->db->table($this->tbldi);
        $builder->where("damage_item_id", $diid);
        $builder->update(['status' => 'replaced']); 

    }
    /**
        ---------------------------------------------------
        End of Damage Module area
        ---------------------------------------------------
    */



















     /**
        ---------------------------------------------------
        Display Module area
        ---------------------------------------------------
        * @method viewDisplayItems() use to get the display item information based on status
        * @param state status of display items
        * @return sales->as->multiple_result
    */
    public function viewDisplayItems($state){
        if($state == 'all'){

            $query = $this->db->query("SELECT di.display_item_id, di.reference_number, w.name AS warehouse, i.name AS item, di.status, u.added_by, di.added_on, i.retail_price
            FROM tbl_display_item di
            INNER JOIN tbl_user u ON di.added_by = u.user_id
            INNER JOIN tbl_item i ON di.item_id = i.item_id
            INNER JOIN tbl_warehouse w ON di.warehouse_id = w.warehouse_id
            WHERE i.parent != '0'
            ORDER BY di.display_item_id DESC");
            
            return $query->getResultArray();

        }else{

            $query = $this->db->query("SELECT di.display_item_id, di.reference_number, w.name AS warehouse, i.name AS item, di.status, u.added_by, di.added_on, i.retail_price
            FROM tbl_display_item di
            INNER JOIN tbl_user u ON di.added_by = u.user_id
            INNER JOIN tbl_item i ON di.item_id = i.item_id
            INNER JOIN tbl_warehouse w ON di.warehouse_id = w.warehouse_id
            WHERE di.status = '$state' AND i.parent != '0'
            ORDER BY di.display_item_id DESC");
            
            return $query->getResultArray();

        }

    }


    /**
        * @method saveDisplayItem() use to register the display item information
        * @var data container data of display item
        * @var getdid contains display_item_id for the generation of reference number
        * @return sql_execution bool
    */
    public function saveDisplayItem(){

        $data = array(
            'warehouse_id' => $this->encrypter->decrypt($this->request->getPost("warehouse")),
            'item_id' => $this->encrypter->decrypt($this->request->getPost("item")),
            'status' => 'displayed',
            'added_by' => $this->encrypter->decrypt($_SESSION['userID']),
            'added_on' => $this->date.' '.$this->time
        );

        $builder = $this->db->table($this->tbldpi);
        $builder->insert($data);

        $getdid = $this->db->query("select display_item_id,item_id from ".$this->tbldpi." order by display_item_id desc limit 1")->getRowArray();

        $builder->where("display_item_id", $getdid['display_item_id']);
        $builder->update(['reference_number' => "DP".date("Ymd").$this->encrypter->decrypt($this->request->getPost("item")).$getdid['display_item_id']]);
    
    }


    /**
        * @method markdisplayedDisplayItem() use to mark displayed the display item information
        * @param diID encrypted data of display_item_id
        * @var diid decrypted data of display_item_id
        * @return sql_execution bool
    */
    public function markdisplayedDisplayItem($diID){

        $diid = $this->encrypter->decrypt(str_ireplace(['~','$'],['/','+'],$diID));

        $builder = $this->db->table($this->tbldpi);
        $builder->where("display_item_id", $diid);
        $builder->update(['status' => 'displayed']);

    }


    /**
        * @method marksoldDisplayItem() use to mark sold the display item information
        * @param diID encrypted data of display_item_id
        * @var diid decrypted data of display_item_id
        * @return sql_execution bool
    */
    public function marksoldDisplayItem($diID){

        $diid = $this->encrypter->decrypt(str_ireplace(['~','$'],['/','+'],$diID));

        $builder = $this->db->table($this->tbldpi);
        $builder->where("display_item_id", $diid);
        $builder->update(['status' => 'sold']);

    }
    /**
        ---------------------------------------------------
        End of Display Module area
        ---------------------------------------------------
    */

    
}