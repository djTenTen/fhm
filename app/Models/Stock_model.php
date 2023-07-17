<?php
namespace App\Models;
use CodeIgniter\Model;
class Stock_model extends  Model {
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
    
    protected $inventory_model;
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
    protected $tblst = "tbl_stock_transfer";
    protected $tblsti = "tbl_stock_transfer_item";
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
        $this->inventory_model = new \App\Models\Inventory_model; //
        date_default_timezone_set("Asia/Singapore"); 
        $this->time = date("H:i:s"); 
        $this->date = date("Y-m-d");

    }


    /**
        * @method gettransferstocks() use to get the stock transfer information based on status
        * @param stats status information of reservation
        * @return stock_transfer->as->multiple_result
    */
    public function gettransferstocks($stats){

        if($stats == 'all'){
            $query = $this->db->query("select tst.*, tu.name as nameuser
            from ".$this->tblst." as tst,".$this->tblu." as tu
            where tst.added_by = tu.user_id");
            return $query->getResultArray();
        }else{
            $query = $this->db->query("select tst.*, tu.name as nameuser
            from ".$this->tblst." as tst,".$this->tblu." as tu
            where tst.added_by = tu.user_id
            and tst.status = '$stats'");
            return $query->getResultArray();
        }

    }


    /**
        * @method countStockTransfer() use to count the quantity transfer information based on id
        * @param stID decrypted data of stock_transfer_id
        * @return stock_transfer->as->single_result
    */
    public function countStockTransfer($stID){

        $query = $this->db->query("select ifnull( (select sum(quantity) from ".$this->tblsti." where stock_transfer_id = $stID), 0) as total");
        return $query->getRowArray();

    }


    /**
        * @method getTransferItems() use to get the transfered items based on id
        * @param stID decrypted data of stock_transfer_id
        * @return stock_transfer->as->multiple_result
    */
    public function getTransferItems($stID){

        $query = $this->db->query("SELECT i.parent_id, i.item_id, i.name, sti.quantity, sti.stock_transfer_item_id
        FROM tbl_stock_transfer_item sti
        INNER JOIN (
            SELECT parent.item_id AS parent_id, ti.item_id, CONCAT(parent.name, ' - ', ti.name) AS name
            FROM tbl_item ti
            INNER JOIN tbl_item parent ON ti.parent = parent.item_id
            WHERE ti.parent != '0'
        ) AS i ON sti.item_id = i.item_id
        WHERE sti.stock_transfer_id = $stID");
        return $query->getResultArray();

    }

    


    /**
        * @method getStockTransfer() use to get the transfered information based on id
        * @param stID decrypted data of stock_transfer_id
        * @return stock_transfer->as->multiple_result
    */
    public function getStockTransfer($stID){

        $stid = $this->encrypter->decrypt(str_ireplace(['~','$'],['/','+'],$stID));

        $query = $this->db->query("select * , tu.name as nameuser 
        from ".$this->tblst." tst,".$this->tblu." as tu 
        where tst.added_by = tu.user_id 
        and stock_transfer_id = $stid");
        return $query->getRowArray();

    }


    /**
        * @method getcountStockTransfer() use to get the stock count of transfered items information
        * @return stock_transfer->as->single_result
    */
    public function getcountStockTransfer(){

        $query = $this->db->query("select 
    
            ifnull ((select count(stock_transfer_id)
            from ".$this->tblst." as tblst
            where tblst.status = 'pending'), 0) as pending,

            ifnull ((select count(stock_transfer_id)
            from ".$this->tblst." as tblst
            where tblst.status = 'completed'), 0) as completed,

            ifnull ((select count(stock_transfer_id)
            from ".$this->tblst." as tblst
            where tblst.status = 'cancelled'), 0) as cancelled,

            ifnull ((select count(stock_transfer_id)
            from ".$this->tblst." as tblst), 0) as stck

        ");

        return $query->getRowArray();

    }


    /**
        * @method saveStockTransfer() use to register the stock transfer information
        * @var data container data of  stock transfer information
        * @var stfid contains stock_transfer_id
        * @var dataitem container data of item information
        * @return sql_execution bool
    */
    public function saveStockTransfer(){
        
        $data = array(
            'transfer_from' => $this->encrypter->decrypt($this->request->getPost("warehouse-from")),
            'transfer_to' => $this->encrypter->decrypt($this->request->getPost("warehouse-to")),
            'transfer_date' => $this->date,
            'status' => 'pending',
            'added_by' => $this->encrypter->decrypt($_SESSION['userID']),
            'added_on' => $this->date.' '.$this->time
        );

        $builderst = $this->db->table($this->tblst);
        $builderst->insert($data);

        $stfid = $this->db->query("select stock_transfer_id from ".$this->tblst." order by stock_transfer_id desc limit 1")->getRowArray();

        foreach($_POST['item'] as $i => $item){
            $dataitem = array(
                'stock_transfer_id' => $stfid['stock_transfer_id'],
                'item_id' => $this->encrypter->decrypt($_POST['item'][$i]),
                'quantity' => $_POST['quantity'][$i],
            );

            $buildersti = $this->db->table($this->tblsti);
            $buildersti->insert($dataitem);
        }

    }


    /**
        * @method updateStockTransfer() use to update the stock transfer information based on id
        * @param stID encrypted data of reservation_id
        * @var stid decrypted data of reservation_id
        * @var data data container of stock transfer information
        * @var dataitem data container of stock transfer item information
        * @return sql_execution bool
    */
    public function updateStockTransfer($stID){

        $stid = $this->encrypter->decrypt(str_ireplace(['~','$'],['/','+'],$stID));

        $data = array(
            'transfer_from' => $this->encrypter->decrypt($this->request->getPost("warehouse-from")),
            'transfer_to' => $this->encrypter->decrypt($this->request->getPost("warehouse-to")),
            'updated_by' => $this->encrypter->decrypt($_SESSION['userID']),
            'updated_on' => $this->date.' '.$this->time
        );

        $builderst = $this->db->table($this->tblst);
        $builderst->where("stock_transfer_id", $stid);
        $builderst->update($data);

        $buildersti = $this->db->table($this->tblsti);
        $buildersti->where("stock_transfer_id", $stid);
        $buildersti->delete();

        foreach($_POST['item'] as $i => $item){
            $dataitem = array(
                'stock_transfer_id' => $stid,
                'item_id' => $this->encrypter->decrypt($_POST['item'][$i]),
                'quantity' => $_POST['quantity'][$i],
            );

            $buildersti->insert($dataitem);
        }

    }


    /**
        * @method markPendingStockTransfer() use to mark pending the stock transfer information based on id
        * @param stID encrypted data of stock_transfer_id
        * @var stid decrypted data of stock_transfer_id
        * @var data container data of stock transfer
        * @return sql_execution bool
    */
    public function markPendingStockTransfer($stID){

        $stid = $this->encrypter->decrypt(str_ireplace(['~','$'],['/','+'],$stID));
        $data = array("status" => 'pending');
        $builderst = $this->db->table($this->tblst);
        $builderst->where("stock_transfer_id", $stid);
        $builderst->update($data);

    }


    /**
        * @method markCompletedStockTransfer() use to mark completed the stock transfer information based on id
        * @param stID encrypted data of stock_transfer_id
        * @var stid decrypted data of stock_transfer_id
        * @var data container data of stock transfer
        * @return sql_execution bool
    */
    public function markCompletedStockTransfer($stID){

        $stid = $this->encrypter->decrypt(str_ireplace(['~','$'],['/','+'],$stID));
        $data = array("status" => 'completed');
        $builderst = $this->db->table($this->tblst);
        $builderst->where("stock_transfer_id", $stid);
        $builderst->update($data);

    }

    
     /**
        * @method markCancelledStockTransfer() use to mark cancelled the stock transfer information based on id
        * @param stID encrypted data of stock_transfer_id
        * @var stid decrypted data of stock_transfer_id
        * @var data container data of stock transfer
        * @return sql_execution bool
    */
    public function markCancelledStockTransfer($stID){

        $stid = $this->encrypter->decrypt(str_ireplace(['~','$'],['/','+'],$stID));
        $data = array("status" => 'cancelled');
        $builderst = $this->db->table($this->tblst);
        $builderst->where("stock_transfer_id", $stid);
        $builderst->update($data);

    }





}