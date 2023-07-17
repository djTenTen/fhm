<?php
namespace App\Models;
use CodeIgniter\Model;
class Purchase_model extends  Model {
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
    protected $tblp = "tbl_purchase";
    protected $tblpi = "tbl_purchase_item";
    protected $tblu = "tbl_user";
    protected $tblwh = "tbl_warehouse";
    protected $tbli = "tbl_item";
    protected $tbls = "tbl_supplier";


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
        * @method getAllPurchase() use to get the purchase information based on status
        * @param stats status information of purchase
        * @return purchase->as->multiple_result
    */
    public function getAllPurchase($stats){

        if($stats == 'all'){
            $query = $this->db->query("select *,ts.name,tp.status,tu.name as nameuser, wh.name as warehouse
            from ".$this->tbls." as ts,".$this->tblp." as tp, ".$this->tblu." as tu, ".$this->tblwh." as wh
            where ts.supplier_id = tp.supplier_id
            and tp.warehouse_id = wh.warehouse_id
            and tp.added_by = tu.user_id");
            return $query->getResultArray();
        }else{
            $query = $this->db->query("select *,ts.name,tp.status,tu.name as nameuser, wh.name as warehouse
            from ".$this->tbls." as ts,".$this->tblp." as tp, ".$this->tblu." as tu, ".$this->tblwh." as wh
            where ts.supplier_id = tp.supplier_id
            and tp.warehouse_id = wh.warehouse_id
            and tp.added_by = tu.user_id
            and tp.status = '$stats'");
            return $query->getResultArray();
        }

    }


    /**
        * @method countPurchase() use to get the count information of purchase 
        * @return purchase->as->single_result
    */
    public function countPurchase(){

        $query = $this->db->query("select 
    
            ifnull ((select count(supplier_id)
            from ".$this->tblp." as tblp
            where tblp.status = 'pending'), 0) as pending,

            ifnull ((select count(supplier_id)
            from ".$this->tblp." as tblp
            where tblp.status = 'delivered'), 0) as delivered,

            ifnull ((select count(supplier_id)
            from ".$this->tblp." as tblp
            where tblp.status = 'cancelled'), 0) as cancelled,

            ifnull ((select count(supplier_id)
            from ".$this->tblp." as tblp), 0) as purch

        ");

        return $query->getRowArray();

    }
   

    /**
        * @method countPurchase() use to get the count information of purchase based on id
        * @param pid decrypted data of purchase_id
        * @return purchase->as->single_result
    */
    public function getCount($pid){

        $query = $this->db->query("select 
        ifnull ((select sum(quantity)
        from ".$this->tblpi." as tpi
        where tpi.purchase_id = $pid), 0) as qty,

        ifnull ((select sum(quantity * price)
        from ".$this->tblpi." as tpi
        where tpi.purchase_id = $pid), 0) as subtotal
        ");

        return $query->getRowArray();

    }


    /**
        * @method getPurchase() use to get the information of purchase based on id
        * @param pID = encrypted data of purchase_id
        * @var pid = decrypted data of purchase_id
        * @return purchase->as->single_result
    */
    public function getPurchase($pID){

        $pid = $this->encrypter->decrypt(str_ireplace(['~','$'],['/','+'],$pID));

        $query = $this->db->query("select *,ts.name,tp.status,tu.name as nameuser, wh.name as warehouse,tp.warehouse_id
        from ".$this->tbls." as ts,".$this->tblp." as tp, ".$this->tblu." as tu, ".$this->tblwh." as wh
        where ts.supplier_id = tp.supplier_id
        and tp.warehouse_id = wh.warehouse_id
        and tp.added_by = tu.user_id
        and tp.purchase_id = $pid");

        return $query->getRowArray();
    }


    /**
        * @method getPurchaseItems() use to get the information of purchase items based on id
        * @param pID = decrypted data of purchase_id
        * @return purchase->as->multiple_result
    */
    public function getPurchaseItems($pID){

        $query = $this->db->query("SELECT pi.purchase_item_id, pi.quantity, i.parent_id, i.item_id, i.name, pi.price, i.retail_price, i.wholesale_price
        FROM tbl_purchase_item pi
        INNER JOIN (
            SELECT parent.item_id AS parent_id, ti.item_id, CONCAT(parent.name, ' - ', ti.name) AS name, ti.retail_price, ti.wholesale_price
            FROM tbl_item ti
            INNER JOIN tbl_item parent ON ti.parent = parent.item_id
            WHERE ti.parent != '0'
        ) AS i ON pi.item_id = i.item_id
        WHERE pi.purchase_id = $pID");

        return $query->getResultArray();
        
    }


    /**
        * @method registerPurchase() use to register purchase information
        * @var sid contains supplier_id
        * @var data data container of purchase information
        * @var pid contains purchase_id
        * @var dataitem data container of purchase intem information
        * @return sql_execution bool
    */
    public function registerPurchase(){

        $sid = $this->db->query("select supplier_id from ".$this->tbls." where name = '".$this->request->getPost("supplier")."' limit 1")->getRowArray();

        $data = array(
            'invoice_no' => $this->request->getPost("invoice-no"),
            'invoice_date' => $this->date,
            'supplier_id' => $sid['supplier_id'],
            'warehouse_id' => $this->encrypter->decrypt($this->request->getPost("warehouse")),
            'payment_method' => $this->request->getPost("payment-method"),
            'payment_status' => 'unpaid',
            'arrival_date' => $this->date,
            'status' => 'pending',
            'added_by' => $this->encrypter->decrypt($_SESSION['userID']),
            'added_on' => $this->date.' '.$this->time
        );

        $builderp = $this->db->table($this->tblp);
        $builderp->insert($data);

        $pid = $this->db->query("select purchase_id from ".$this->tblp." order by purchase_id desc limit 1")->getRowArray();
        
        foreach($_POST['item'] as $i => $item){
            $dataitem = array(
                'purchase_id' => $pid['purchase_id'],
                'item_id' => $this->encrypter->decrypt($_POST['item'][$i]),
                'quantity' => $_POST['quantity'][$i],
                'price' => $_POST['price'][$i]
            );

            $builderpi = $this->db->table($this->tblpi);
            $builderpi->insert($dataitem);
        }

    }


    /**
        * @method updatePurchase() use to update purchase information
        * @param pID = encrypted data of purchase_id
        * @var pid = decrypted data of purchase_id
        * @var sid contains supplier_id
        * @var data data container of purchase information
        * @var dataitem data container of purchase intem information
        * @return sql_execution bool
    */
    public function updatePurchase($pID){

        $pid = $this->encrypter->decrypt(str_ireplace(['~','$'],['/','+'],$pID));
        $sid = $this->db->query("select supplier_id from ".$this->tbls." where name = '".$this->request->getPost("supplier")."' limit 1")->getRowArray();
        
        $data = array(
            'invoice_no' => $this->request->getPost("invoice-no"),
            'supplier_id' => $sid['supplier_id'],
            'warehouse_id' => $this->encrypter->decrypt($this->request->getPost("warehouse")),
            'payment_method' => $this->request->getPost("payment-method"),
            'status' => 'pending',
            'updated_by' => $this->encrypter->decrypt($_SESSION['userID']),
            'updated_on' => $this->date.' '.$this->time
        );

        $builderp = $this->db->table($this->tblp);
        $builderp->where("purchase_id", $pid);
        $builderp->update($data);

        $builderpi = $this->db->table($this->tblpi);
        $builderpi->where("purchase_id", $pid);
        $builderpi->delete();

        foreach($_POST['item'] as $i => $item){
            $dataitem = array(
                'purchase_id' => $pid,
                'item_id' => $this->encrypter->decrypt($_POST['item'][$i]),
                'quantity' => $_POST['quantity'][$i],
                'price' => $_POST['price'][$i]
            );

            $builderpi->insert($dataitem);
        }

    }


        /**
        * @method markPending() use to update the purchase information
        * @param pID = encrypted data of purchase_id
        * @var pid = decrypted data of purchase_id
        * @var data = container of data
        * @return sql_execution bool
    */
    public function markPending($pID){

        $pid = $this->encrypter->decrypt(str_ireplace(['~','$'],['/','+'],$pID));

        $data = array('status' => 'pending');

        $buildder = $this->db->table($this->tblp);
        $buildder->where("purchase_id", $pid);
        $buildder->update($data);

    }


    /**
        * @method markDelivered() use to update the purchase information
        * @param pID = encrypted data of purchase_id
        * @var pid = decrypted data of purchase_id
        * @var data = container of data
        * @return sql_execution bool
    */
    public function markDelivered($pID){

        $pid = $this->encrypter->decrypt(str_ireplace(['~','$'],['/','+'],$pID));

        $data = array('status' => 'delivered');

        $buildder = $this->db->table($this->tblp);
        $buildder->where("purchase_id", $pid);
        $buildder->update($data);

    }


    /**
        * @method markCancelled() use to update the purchase information
        * @param pID = encrypted data of purchase_id
        * @var pid = decrypted data of purchase_id
        * @var data = container of data
        * @return sql_execution bool
    */
    public function markCancelled($pID){

        $pid = $this->encrypter->decrypt(str_ireplace(['~','$'],['/','+'],$pID));

        $data = array('status' => 'cancelled');

        $buildder = $this->db->table($this->tblp);
        $buildder->where("purchase_id", $pid);
        $buildder->update($data);

    }

    
    






}