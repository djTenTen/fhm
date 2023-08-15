<?php
namespace App\Models;
use CodeIgniter\Model;
class Inventory_model extends  Model {
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
    protected $tbldmi = "tbl_damage_item";
    protected $tbldsi = "tbl_display_item";
    protected $tblp = "tbl_purchase";
    protected $tblpi = "tbl_purchase_item";
    protected $tbls = "tbl_sales";
    protected $tblsi = "tbl_sales_item";
    protected $tblst = "tbl_stock_transfer";
    protected $tblsti = "tbl_stock_transfer_item";
    protected $tblwh = "tbl_warehouse";
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
        * @method getaboutitem() use to get the items information based on id
        * @param iID decrypted data of item_id
        * @return item->as->single_result
    */
    public function getaboutitem($iID){

        $query = $this->db->query("select 
        ifnull((select sum(quantity) from ".$this->tblpi." as tpi,".$this->tblp." as tp where item_id = $iID and tpi.purchase_id = tp.purchase_id and status = 'delivered'), 0) as qtyitem,
        ifnull((select count(damage_item_id) from ".$this->tbldmi." where item_id = $iID),0) as damageitem,
        ifnull((select count(display_item_id) from ".$this->tbldsi." where item_id = $iID),0) as displayitem,
        ifnull((select sum(quantity) from ".$this->tblsi." where item_id = $iID),0) as salesitem
        ");
        return $query->getRowArray();

    }

    /**
        * @method getstockcount() use to get the items count information based on id
        * @param iID decrypted data of item_id
        * @param wID decrypted data of warehouse_id
        * @return item->as->single_result
    */
    public function getstockcount($iID,$wID){

        $query = $this->db->query("select 
        ifnull((select sum(quantity)
        from ".$this->tblpi." as tpi, ".$this->tblp." as tp
        where tpi.purchase_id = tp.purchase_id
        and tp.warehouse_id = $wID
        and tpi.item_id = $iID), 0) as qtyitem, 

        ifnull((select count(damage_item_id) from ".$this->tbldmi." where item_id = $iID and warehouse_id = $wID),0) as damageitem,

        ifnull((select count(display_item_id) from ".$this->tbldsi." where item_id = $iID and warehouse_id = $wID),0) as displayitem,
        
        ifnull((select sum(quantity)
        from ".$this->tblsi." as tsi, ".$this->tbls." as ts
        where tsi.sales_id = ts.sales_id
        and ts.warehouse_id = $wID
        and tsi.item_id = $iID), 0) as salesitem,

        ifnull((select sum(quantity)
        from ".$this->tblsti." as tsti, ".$this->tblst." as tst
        where tsti.stock_transfer_id = tst.stock_transfer_id
        and tst.transfer_from = $wID
        and tsti.item_id = $iID), 0) as stcktransferfrom,

        ifnull((select sum(quantity)
        from ".$this->tblsti." as tsti, ".$this->tblst." as tst
        where tsti.stock_transfer_id = tst.stock_transfer_id
        and tst.transfer_to = $wID
        and tsti.item_id = $iID), 0) as stcktransferto
        ");

        return $query->getRowArray();

    }


    /**
        * @method getActiveItems() use to get the items information based on category
        * @param filter  contains category item
        * @return item->as->multiple_result
    */
    public function getActiveItems($filter){

        if($filter == 'all'){
            $query = $this->db->query("select tic.name as catename, ti.name as itemname, ti.item_id, ti.status as itemstatus
            from ".$this->tblic." as tic,".$this->tbli." as ti
            where tic.item_category_id = ti.item_category_id
            and  ti.parent = 0
            and ti.status = 'active'
            order by ti.name asc");
        }else{
            $query = $this->db->query("select tic.name as catename, ti.name as itemname, ti.item_id, ti.status as itemstatus
            from ".$this->tblic." as tic,".$this->tbli." as ti
            where tic.item_category_id = ti.item_category_id
            and  ti.parent = 0
            and ti.status = 'active'
            and tic.name = '$filter'
            order by ti.name asc");
        }
        
        return $query->getResultArray();

    }


    /**
        * @method getpurchasetrasaction() use to get the item purchase information based on id
        * @param iID decrypted data of item_id
        * @return item->as->multiple_result
    */
    public function getpurchasetrasaction($iID){

        $query = $this->db->query("select invoice_date,invoice_no,name,quantity
        from ".$this->tblp." as tp, ".$this->tblwh." as tw,".$this->tblpi." as tpi
        where tp.warehouse_id = tw.warehouse_id
        and tp.purchase_id = tpi.purchase_id
        and tpi.item_id = $iID");
        return $query->getResultArray();

    }


    /**
        * @method getsalestrasaction() use to get the item sales information based on id
        * @param iID decrypted data of item_id
        * @return item->as->multiple_result
    */
    public function getsalestrasaction($iID){

        $query = $this->db->query("select invoice_date,invoice_no,name,quantity,delivery_method
        from ".$this->tbls." as ts, ".$this->tblwh." as tw,".$this->tblsi." as tsi
        where ts.warehouse_id = tw.warehouse_id
        and ts.sales_id = tsi.sales_id
        and tsi.item_id = $iID");
        return $query->getResultArray();

    }



    /**
        * @method gettransfertransaction() use to get the item transfer information based on id
        * @param iID decrypted data of item_id
        * @return item->as->multiple_result
    */
    public function gettransfertransaction($iID){

        $query = $this->db->query("select transfer_date,transfer_from,transfer_to,quantity
        from ".$this->tblst." as tst, ".$this->tblsti." as tsti
        where tst.stock_transfer_id = tsti.stock_transfer_id
        and tsti.item_id = $iID");
        return $query->getResultArray();

    }

    /**
        * @method getwarehousename() use to get the warehouse name based on id
        * @param wid decrypted data of warehouse_id
        * @return warehouse->as->single_result
    */
    public function getwarehousename($wid){


        $query = $this->db->table($this->tblwh)
                    ->select('name')
                    ->where('warehouse_id', $wid)
                    ->get();
                    
        return $query->getRowArray();

    }























}