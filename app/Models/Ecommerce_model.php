<?php
namespace App\Models;
use CodeIgniter\Model;
class Ecommerce_model extends  Model {
    /** 
        most of the function are being called on coresponding controllers
        others directly called on the views.
        This part where all the query communication to the database ar  e being executed
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
    protected $tbls = "tbl_sales";
    protected $tblsi = "tbl_sales_item";
    protected $tblc = "tbl_customer";
    protected $tblu = "tbl_user";
    protected $tblwh = "tbl_warehouse";
    protected $tbli = "tbl_item";
    protected $tblslaz = "tbl_sales_lazada";
    protected $tblsshop = "tbl_sales_shopee";
    
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
        Lazada sales Module area
        ---------------------------------------------------
        * @method getAllSalesLaz() use to get the lazada sales information based on status
        * @param stats status information of sales
        * @return sales->as->multiple_result
    */
    public function getAllSalesLaz($stats){

        if($stats == 'all'){
            $query = $this->db->query("select ts.* , wh.name as warehouse, tc.name as customer, tu.name as nameuser
            from ".$this->tbls." as ts, ".$this->tblwh." as wh, ".$this->tblc." as tc, ".$this->tblu." as tu
            where ts.warehouse_id = wh.warehouse_id
            and ts.customer_id = tc.customer_id
            and channel = 'lazada'
            and ts.added_by = tu.user_id");
            return $query->getResultArray();
        }else{
            $query = $this->db->query("select ts.* , wh.name as warehouse, tc.name as customer, tu.name as nameuser
            from ".$this->tbls." as ts, ".$this->tblwh." as wh, ".$this->tblc." as tc, ".$this->tblu." as tu
            where ts.warehouse_id = wh.warehouse_id
            and ts.customer_id = tc.customer_id
            and ts.added_by = tu.user_id
            and channel = 'lazada'
            and ts.status = '$stats'
        ");
            return $query->getResultArray();
        }

    }


    /**
        * @method getSales() use to get the sales information based on id
        * @param sID encrypted data of sales_id
        * @var sid decrypted data of sales_id
        * @return sales->as->single_result
    */
    public function getSales($sID){

        $sid = $this->encrypter->decrypt(str_ireplace(['~','$'],['/','+'],$sID));

        $query = $this->db->query("select ts.* , wh.name as warehouse, tc.name as customer, tu.name as nameuser
            from ".$this->tbls." as ts, ".$this->tblwh." as wh, ".$this->tblc." as tc, ".$this->tblu." as tu
            where ts.warehouse_id = wh.warehouse_id
            and ts.customer_id = tc.customer_id
            and ts.added_by = tu.user_id
            and ts.sales_id = $sid
        ");

        return $query->getRowArray();

    }


    /**
        * @method getSalesItem() use to get the sales item information based on id
        * @param sID decrypted data of sales_id
        * @return item->as->multiple_result
    */
    public function getSalesItem($sID){

        $query = $this->db->query("select ".$this->tblsi.".quantity, item.parent_id, item.item_id, item.name, ".$this->tblsi.".price, ".$this->tblsi.".sales_item_id
        from ".$this->tblsi." INNER JOIN (select parent.item_id as parent_id, ".$this->tbli.".item_id, CONCAT(parent.name, ' - ', ".$this->tbli.".name) as name 
        from ".$this->tbli." INNER JOIN (select ".$this->tbli.".item_id, ".$this->tbli.".name 
        from ".$this->tbli.") parent ON ".$this->tbli.".parent = parent.item_id 
        where ".$this->tbli.".parent != '0') item ON ".$this->tblsi.".item_id = item.item_id 
        where ".$this->tblsi.".sales_id = $sID");
        return $query->getResultArray();

    }


    /**
        * @method getCostumer() use to get the customer information based on id
        * @param cID encrypted data of customer_id
        * @var cid decrypted data of customer_id
        * @return customer->as->single_result
    */
    public function getCostumer($cID){

        $cid = $this->encrypter->decrypt(str_ireplace(['~','$'],['/','+'],$cID));

        $query = $this->db->query("select * 
        from ".$this->tblc."
        where customer_id = $cid");
        return $query->getRowArray();

    }


    /**
        * @method getItemsLaz() use to get the lazada items information based on id
        * @param sID encrypted data of sales_id
        * @return lazada_sales->as->multiple_result
    */
    public function getItemsLaz($sID){

        $query = $this->db->query("select si.sales_item_id, si.quantity, i.parent_id, i.item_id, i.name, si.price,
        sl.delivered_date, sl.shipping_fee_collected, sl.shipping_fee_charged, sl.commission_fee, sl.payment_fee, sl.other_fee, sl.other_credit
        from ".$this->tblsi." si INNER JOIN (select parent.item_id AS parent_id, item.item_id, CONCAT(parent.name, ' - ', item.name) AS name
        from ".$this->tbli." item INNER JOIN ".$this->tbli." parent ON item.parent = parent.item_id
        where item.parent != '0') i ON si.item_id = i.item_id
        INNER JOIN ".$this->tblslaz." sl ON si.sales_item_id = sl.sales_item_id
        where si.sales_id = $sID");

        return $query->getResultArray();

    }


    /**
        * @method saveSalesLaz() use to register the lazada sales information
        * @var cn contains customer name
        * @var invdate contains invoice_date
        * @var getuser contains user in customer information
        * @var data data container of sales information
        * @var getlasts contains sales_id
        * @var dataitem data container of sales item information
        * @var getlastsiid contains last sales item id
        * @var itemlaz container data of lazada sales items
        * @var custdata data container of customer data if the customer does not yet exist on the system
        * @return sql_execution bool
    */
    public function saveSalesLaz(){

        $cn = trim($this->request->getPost("customer"));
        $invdate = $this->request->getPost('mm').'/'.$this->request->getPost('dd').'/'.$this->request->getPost('yy');

        $getuser = $this->db->table($this->tblc)->where('name', $cn)->get()->getRowArray();

        if($getuser != null or !empty($getuser)){

            $data = [
                'channel' => 'lazada',
                'invoice_no' => $this->request->getPost("invoice-no"),
                'invoice_date' => $invdate,
                'official_receipt' => $this->request->getPost("official-receipt"),
                'official_receipt_no' => $this->request->getPost("official-receipt-no"),
                'customer_id' => $getuser['customer_id'],
                'address' => $getuser['address'],
                'contact_number' => $getuser['contact_number'],
                'warehouse_id' => $this->encrypter->decrypt($this->request->getPost("warehouse")),
                'payment_method' => $this->request->getPost("payment-method"),
                'payment_status' => 'unpaid',
                'status' => 'pending',
                'added_by' => $this->encrypter->decrypt($_SESSION['userID']),
                'added_on' => $this->date.' '.$this->time
            ];
    
            $this->db->table($this->tbls)->insert($data);

            $getlasts = $this->db->table($this->tbls)->orderBy('sales_id', 'desc')->limit(1)->get()->getRowArray();
    
            foreach($_POST['item'] as $i => $item){
                $dataitem = [
                    'sales_id' => $getlasts['sales_id'],
                    'item_id' => $this->encrypter->decrypt($_POST['item'][$i]),
                    'quantity' => $_POST['quantity'][$i],
                    'price' => $_POST['price'][$i]
                ];

                $this->db->table($this->tblsi)->insert($dataitem);

                $getlastsiid = $this->db->table($this->tblsi)->select('sales_item_id')->orderBy('sales_item_id', 'desc')->limit(1)->get()->getRowArray();

                $itemlaz = [
                    'sales_item_id' => $getlastsiid['sales_item_id'],
                    'shipping_fee_collected' => 0,
                    'shipping_fee_charged' => 0,
                    'commission_fee' => 0,
                    'payment_fee' => 0, 
                    'other_fee' => 0, 
                    'other_credit' => 0
                ];
                $this->db->table($this->tblslaz)->insert($itemlaz);
                
            }

        }else{

            $custdata = [
                'name' => ucfirst($this->request->GetPost("customer")),
                'address' => ucfirst($this->request->GetPost("address")),
                'contact_number' => $this->request->GetPost("contact-number"),
                'type' => 'personal',
                'status' => 'active',
                'added_by' => $this->encrypter->decrypt($_SESSION['userID']),
                'added_on' => $this->date.' '.$this->time
            ];

            $this->db->table($this->tblc)->insert($custdata);

            $reslcust = $this->db->table($this->tblc)->orderBy('customer_id', 'desc')->limit(1)->get()->getRowArray();

            $data = [
                'channel' => 'lazada',
                'invoice_no' => $this->request->getPost("invoice-no"),
                'invoice_date' => $invdate,
                'official_receipt' => $this->request->getPost("official-receipt"),
                'official_receipt_no' => $this->request->getPost("official-receipt-no"),
                'customer_id' => $reslcust['customer_id'],
                'address' => $reslcust['address'],
                'contact_number' => $reslcust['contact_number'],
                'warehouse_id' => $this->encrypter->decrypt($this->request->getPost("warehouse")),
                'payment_method' => $this->request->getPost("payment-method"),
                'payment_status' => 'unpaid',
                'status' => 'pending',
                'added_by' => $this->encrypter->decrypt($_SESSION['userID']),
                'added_on' => $this->date.' '.$this->time
            ];

            $this->db->table($this->tbls)->insert($data);

            $resls = $this->db->table($this->tbls)->orderBy('sales_id', 'desc')->limit(1)->get()->getRowArray();

            foreach($_POST['item'] as $i => $item){
                $dataitem = [
                    'sales_id' => $resls['sales_id'],
                    'item_id' => $this->encrypter->decrypt($_POST['item'][$i]),
                    'quantity' => $_POST['quantity'][$i],
                    'price' => $_POST['price'][$i]
                ];

                $this->db->table($this->tblsi)->insert($dataitem);

                $getlastsiid = $this->db->table($this->tblsi)->select('sales_item_id')->orderBy('sales_item_id', 'desc')->limit(1)->get()->getRowArray();

                $itemlaz = [
                    'sales_item_id' => $getlastsiid['sales_item_id'],
                    'shipping_fee_collected' => 0,
                    'shipping_fee_charged' => 0,
                    'commission_fee' => 0,
                    'payment_fee' => 0, 
                    'other_fee' => 0, 
                    'other_credit' => 0
                ];
                $this->db->table($this->tblslaz)->insert($itemlaz);
            }

        }

    }


    


    


    /**
        * @method updateLazada() use to update the lazada sales information based on id
        * @param sID encrypted data of sales_id
        * @var sid decrypted data of sales_id
        * @var cn contains customer name
        * @var invdate contains invoice_date
        * @var getuser contains user in customer information
        * @var data data container of sales information
        * @var dataitem data container of sales item information
        * @var getlastsiid contains last sales item id
        * @var itemlaz container data of lazada sales items
        * @return sql_execution bool
    */
    public function updateLazada($sID){
        
        
        $sid = $this->encrypter->decrypt(str_ireplace(['~','$'],['/','+'],$sID));
        $cn = trim($this->request->getPost("customer"));
        $invdate = $this->request->getPost('mm').'/'.$this->request->getPost('dd').'/'.$this->request->getPost('yy');
        $getuser = $this->db->query("select * from ".$this->tblc." where name = '$cn'")->getRowArray();

        $data = [
            'invoice_no' => $this->request->getPost("invoice-no"),
            'invoice_date' => $invdate,
            'official_receipt' => $this->request->getPost("official-receipt"),
            'official_receipt_no' => $this->request->getPost("official-receipt-no"),
            'customer_id' => $getuser['customer_id'],
            'address' => $getuser['address'],
            'contact_number' => $getuser['contact_number'],
            'warehouse_id' => $this->encrypter->decrypt($this->request->getPost("warehouse")),
            'delivery_method' => $this->request->getPost("delivery-method"),
            'delivery_fee' => $this->request->getPost("delivery-fee"),
            'payment_method' => $this->request->getPost("payment-method"),
            'updated_by' => $this->encrypter->decrypt($_SESSION['userID']),
            'updated_on' => $this->date.' '.$this->time
        ];

        $this->db->table($this->tbls)->where("sales_id",$sid)->update($data);

        $query = $this->db->table($this->tblsi)->select('sales_item_id')->where('sales_id', $sid)->get()->getResultArray();

        foreach($query as $res){
            $this->db->table($this->tblslaz)->where("sales_item_id", $res['sales_item_id'])->delete();
        }

        $this->db->table($this->tblsi)->where("sales_id",$sid)->delete();

        foreach($_POST['item'] as $i => $item){
            $dataitem = [
                'sales_id' => $sid,
                'item_id' => $this->encrypter->decrypt($_POST['item'][$i]),
                'quantity' => $_POST['quantity'][$i],
                'price' => $_POST['price'][$i]
            ];

            $this->db->table($this->tblsi)->insert($dataitem);

            $getlastsiid = $this->db->table($this->tblsi)->select('sales_item_id')->orderBy('sales_item_id', 'desc')->limit(1)->get()->getRowArray();

            $itemlaz = [
                'sales_item_id' => $getlastsiid['sales_item_id'],
                'shipping_fee_collected' => 0,
                'shipping_fee_charged' => 0,
                'commission_fee' => 0,
                'payment_fee' => 0, 
                'other_fee' => 0, 
                'other_credit' => 0
            ];
            $this->db->table($this->tblslaz)->insert($itemlaz);

        }

    }


    /**
        * @method completeOrderlaz() use to complete the lazada sales information
        * @var siID contains sales item id
        * @var data container data of lazada item sales
        * @return sql_execution bool
    */
    public function completeOrderlaz(){

        foreach($_POST['sales-lazada'] as $i => $item){

            $siID = $_POST['sales-lazada'][$i];
            $data = [
                'delivered_date' => $_POST['delivered-date'][$i],
                'shipping_fee_collected' => $_POST['shipping-fee-collected'][$i],
                'shipping_fee_charged' => $_POST['shipping-fee-charged'][$i],
                'commission_fee' => $_POST['commission-fee'][$i],
                'payment_fee' => $_POST['payment-fee'][$i], 
                'other_fee' => $_POST['other-fee'][$i], 
                'other_credit' => $_POST['other-credit'][$i]
            ];

            $this->db->table($this->tblslaz)->where("sales_item_id", $siID)->update($data);

        }

    }


    /**
        * @method markPendingLazada() use to update the sales information based on id
        * @param sID encrypted data of sales_id
        * @var sid decrypted data of sales_id
        * @return sql_execution bool
    */
    public function markPendingLazada($sID){

        $sid = $this->encrypter->decrypt(str_ireplace(['~','$'],['/','+'],$sID));
        $this->db->table($this->tbls)->where("sales_id", $sid)->update(['status' => 'pending']); 

    }
    

    /**
        * @method markDeliveredLazada() use to update the sales information based on id
        * @param sID encrypted data of sales_id
        * @var sid decrypted data of sales_id
        * @return sql_execution bool
    */
    public function markDeliveredLazada($sID){

        $sid = $this->encrypter->decrypt(str_ireplace(['~','$'],['/','+'],$sID));
        $this->db->table($this->tbls)->where("sales_id", $sid)->update(['status' => 'delivered']); 

    }


    /**
        * @method markCancelledLadaza() use to update the sales information based on id
        * @param sID encrypted data of sales_id
        * @var sid decrypted data of sales_id
        * @return sql_execution bool
    */
    public function markCancelledLadaza($sID){

        $sid = $this->encrypter->decrypt(str_ireplace(['~','$'],['/','+'],$sID));
        $this->db->table($this->tbls)->where("sales_id", $sid)->update(['status' => 'cancelled']); 

    }


    /**
        * @method markMissingLazada() use to update the sales information based on id
        * @param sID encrypted data of sales_id
        * @var sid decrypted data of sales_id
        * @return sql_execution bool
    */
    public function markMissingLazada($sID){

        $sid = $this->encrypter->decrypt(str_ireplace(['~','$'],['/','+'],$sID));
        $this->db->table($this->tbls)->where("sales_id", $sid)->update(['status' => 'missing']); 

    }
    /**
        ---------------------------------------------------
        End of Lazada sales Module area
        ---------------------------------------------------
    */

























    


    /**
        ---------------------------------------------------
        Shopee sales Module area
        ---------------------------------------------------
        * @method getAllSalesShop() use to get the Shopee sales information based on status
        * @param stats status information of sales
        * @return sales->as->multiple_result
    */
    public function getAllSalesShop($stats){

        if($stats == 'all'){
            $query = $this->db->query("select ts.* , wh.name as warehouse, tc.name as customer, tu.name as nameuser
            from ".$this->tbls." as ts, ".$this->tblwh." as wh, ".$this->tblc." as tc, ".$this->tblu." as tu
            where ts.warehouse_id = wh.warehouse_id
            and ts.customer_id = tc.customer_id
            and channel = 'shopee'
            and ts.added_by = tu.user_id");
            return $query->getResultArray();
        }else{
            $query = $this->db->query("select ts.* , wh.name as warehouse, tc.name as customer, tu.name as nameuser
            from ".$this->tbls." as ts, ".$this->tblwh." as wh, ".$this->tblc." as tc, ".$this->tblu." as tu
            where ts.warehouse_id = wh.warehouse_id
            and ts.customer_id = tc.customer_id
            and ts.added_by = tu.user_id
            and channel = 'shopee'
            and ts.status = '$stats'");
            return $query->getResultArray();
        }

    }
    

    /**
        * @method getItemsShop() use to get the Shopee items information based on id
        * @param sID encrypted data of sales_id
        * @return shopee_sales->as->multiple_result
    */
    public function getItemsShop($sID){

        $query = $this->db->query("select si.sales_item_id, si.quantity, i.parent_id, i.item_id, i.name, si.price,
        ss.delivered_date, ss.shipping_fee_collected, ss.shipping_fee_charged,
        ss.transaction_fee, ss.other_fee, ss.other_credit
        from ".$this->tblsi." si INNER JOIN (select parent.item_id AS parent_id, item.item_id, CONCAT(parent.name, ' - ', item.name) AS name
        from ".$this->tbli." item INNER JOIN ".$this->tbli." parent ON item.parent = parent.item_id
        where item.parent != '0') i ON si.item_id = i.item_id INNER JOIN ".$this->tblsshop." ss ON si.sales_item_id = ss.sales_item_id
        where si.sales_id = $sID");

        return $query->getResultArray();

    }


    /**
        * @method saveSalesShop() use to register the shopee sales information
        * @var cn contains customer name
        * @var invdate contains invoice_date
        * @var getuser contains user in customer information
        * @var data data container of sales information
        * @var getlasts contains sales_id
        * @var dataitem data container of sales item information
        * @var getlastsiid contains last sales item id
        * @var itemlaz container data of shopee sales items
        * @var custdata data container of customer data if the customer does not yet exist on the system
        * @return sql_execution bool
    */
    public function saveSalesShop(){

        $cn = trim($this->request->getPost("customer"));
        $invdate = $this->request->getPost('mm').'/'.$this->request->getPost('dd').'/'.$this->request->getPost('yy');

        $getuser = $this->db->query("select * from ".$this->tblc." where name = '$cn'")->getRowArray();
        
        if($getuser != null or !empty($getuser)){

            $data = array(
                'channel' => 'shopee',
                'invoice_no' => $this->request->getPost("invoice-no"),
                'invoice_date' => $invdate,
                'official_receipt' => $this->request->getPost("official-receipt"),
                'official_receipt_no' => $this->request->getPost("official-receipt-no"),
                'customer_id' => $getuser['customer_id'],
                'address' => $getuser['address'],
                'contact_number' => $getuser['contact_number'],
                'warehouse_id' => $this->encrypter->decrypt($this->request->getPost("warehouse")),
                'payment_method' => $this->request->getPost("payment-method"),
                'payment_status' => 'unpaid',
                'status' => 'pending',
                'added_by' => $this->encrypter->decrypt($_SESSION['userID']),
                'added_on' => $this->date.' '.$this->time
            );
    
            $builders = $this->db->table($this->tbls);
            $builders->insert($data);
    
            $getlasts = $this->db->query("select * from ".$this->tbls." order by sales_id desc limit 1")->getRowArray();
    
            foreach($_POST['item'] as $i => $item){
                $dataitem = array(
                    'sales_id' => $getlasts['sales_id'],
                    'item_id' => $this->encrypter->decrypt($_POST['item'][$i]),
                    'quantity' => $_POST['quantity'][$i],
                    'price' => $_POST['price'][$i]
                );

                $buildersi = $this->db->table($this->tblsi);
                $buildersi->insert($dataitem);

                $getlastsiid = $this->db->query("select sales_item_id from ".$this->tblsi." order by sales_item_id desc limit 1")->getRowArray();

                $itemlaz = array(
                    'sales_item_id' => $getlastsiid['sales_item_id'],
                    'shipping_fee_collected' => 0,
                    'shipping_fee_charged' => 0,
                    'transaction_fee' => 0,
                    'other_fee' => 0, 
                    'other_credit' => 0
                );
                $builderlaz = $this->db->table($this->tblsshop);
                $builderlaz->insert($itemlaz);
                
            }

        }else{

            $custdata = array(  
                'name' => ucfirst($this->request->GetPost("customer")),
                'address' => ucfirst($this->request->GetPost("address")),
                'contact_number' => $this->request->GetPost("contact-number"),
                'type' => 'personal',
                'status' => 'active',
                'added_by' => $this->encrypter->decrypt($_SESSION['userID']),
                'added_on' => $this->date.' '.$this->time
            );

            $builderc = $this->db->table($this->tblc);
            $builderc->insert($custdata);

            $reslcust = $this->db->query("select * from ".$this->tblc." order by customer_id desc limit 1")->getRowArray();

            $data = array(
                'channel' => 'shopee',
                'invoice_no' => $this->request->getPost("invoice-no"),
                'invoice_date' => $invdate,
                'official_receipt' => $this->request->getPost("official-receipt"),
                'official_receipt_no' => $this->request->getPost("official-receipt-no"),
                'customer_id' => $reslcust['customer_id'],
                'address' => $reslcust['address'],
                'contact_number' => $reslcust['contact_number'],
                'warehouse_id' => $this->encrypter->decrypt($this->request->getPost("warehouse")),
                'payment_method' => $this->request->getPost("payment-method"),
                'payment_status' => 'unpaid',
                'status' => 'pending',
                'added_by' => $this->encrypter->decrypt($_SESSION['userID']),
                'added_on' => $this->date.' '.$this->time
            );

            $builders = $this->db->table($this->tbls);
            $builders->insert($data);

            $resls = $this->db->query("select * from ".$this->tbls." order by sales_id desc limit 1")->getRowArray();

            foreach($_POST['item'] as $i => $item){
                $dataitem = array(
                    'sales_id' => $resls['sales_id'],
                    'item_id' => $this->encrypter->decrypt($_POST['item'][$i]),
                    'quantity' => $_POST['quantity'][$i],
                    'price' => $_POST['price'][$i]
                );

                $buildersi = $this->db->table($this->tblsi);
                $buildersi->insert($dataitem);

                $getlastsiid = $this->db->query("select sales_item_id from ".$this->tblsi." order by sales_item_id desc limit 1")->getRowArray();

                $itemlaz = array(
                    'sales_item_id' => $getlastsiid['sales_item_id'],
                    'shipping_fee_collected' => 0,
                    'shipping_fee_charged' => 0,
                    'transaction_fee' => 0,
                    'other_fee' => 0, 
                    'other_credit' => 0
                );
                $builderlaz = $this->db->table($this->tblsshop);
                $builderlaz->insert($itemlaz);
            }

        }

    }

    

    /**
        * @method updateShopee() use to update the sales information
        * @param sID encrypted data of sales_id
        * @var sid decrypted data of sales_id
        * @var cn contains customer name
        * @var invdate contains invoice_date
        * @var getuser contains user in customer information
        * @var data data container of sales information
        * @var dataitem data container of sales item information
        * @var getlastsiid contains last sales item id
        * @var itemlaz container data of lazada sales items
        * @return sql_execution bool
    */
    public function updateShopee($sID){
        
        
        $sid = $this->encrypter->decrypt(str_ireplace(['~','$'],['/','+'],$sID));
        $cn = trim($this->request->getPost("customer"));
        $invdate = $this->request->getPost('mm').'/'.$this->request->getPost('dd').'/'.$this->request->getPost('yy');
        $getuser = $this->db->query("select * from ".$this->tblc." where name = '$cn'")->getRowArray();

        $data = array(
            'invoice_no' => $this->request->getPost("invoice-no"),
            'invoice_date' => $invdate,
            'official_receipt' => $this->request->getPost("official-receipt"),
            'official_receipt_no' => $this->request->getPost("official-receipt-no"),
            'customer_id' => $getuser['customer_id'],
            'address' => $getuser['address'],
            'contact_number' => $getuser['contact_number'],
            'warehouse_id' => $this->encrypter->decrypt($this->request->getPost("warehouse")),
            'delivery_method' => $this->request->getPost("delivery-method"),
            'delivery_fee' => $this->request->getPost("delivery-fee"),
            'payment_method' => $this->request->getPost("payment-method"),
            'updated_by' => $this->encrypter->decrypt($_SESSION['userID']),
            'updated_on' => $this->date.' '.$this->time
        );

        $builders = $this->db->table($this->tbls);
        $builders->where("sales_id",$sid);
        $builders->update($data);

        $query = $this->db->query("select sales_item_id from ".$this->tblsi." where sales_id = $sid");
        foreach($query->getResultArray() as $res){
            $builderlaz = $this->db->table($this->tblsshop);
            $builderlaz->where("sales_item_id", $res['sales_item_id']);
            $builderlaz->delete();
        }

        $buildersi = $this->db->table($this->tblsi);
        $buildersi->where("sales_id",$sid);
        $buildersi->delete();

        foreach($_POST['item'] as $i => $item){
            $dataitem = array(
                'sales_id' => $sid,
                'item_id' => $this->encrypter->decrypt($_POST['item'][$i]),
                'quantity' => $_POST['quantity'][$i],
                'price' => $_POST['price'][$i]
            );

            $buildersi = $this->db->table($this->tblsi);
            $buildersi->insert($dataitem);

            $getlastsiid = $this->db->query("select sales_item_id from ".$this->tblsi." order by sales_item_id desc limit 1")->getRowArray();

            $itemshop = array(
                'sales_item_id' => $getlastsiid['sales_item_id'],
                'shipping_fee_collected' => 0,
                'shipping_fee_charged' => 0,
                'transaction_fee' => 0,
                'other_fee' => 0, 
                'other_credit' => 0
            );
            $builderlaz = $this->db->table($this->tblsshop);
            $builderlaz->insert($itemshop);

        }

    }


    /**
        * @method completeOrderShop() use to complete the shopee sales information
        * @var siID contains sales item id
        * @var data container data of shopee item sales
        * @return sql_execution bool
    */
    public function completeOrderShop(){

        $builder = $this->db->table($this->tblsshop);
        foreach($_POST['sales-shopee'] as $i => $item){
            $siID = $_POST['sales-shopee'][$i];
            $data = array(
                'delivered_date' => $_POST['delivered-date'][$i],
                'shipping_fee_collected' => $_POST['shipping-fee-collected'][$i],
                'shipping_fee_charged' => $_POST['shipping-fee-charged'][$i],
                'transaction_fee' => $_POST['transaction-fee'][$i], 
                'other_fee' => $_POST['other-fee'][$i], 
                'other_credit' => $_POST['other-credit'][$i]
            );

            $builder->where("sales_item_id", $siID);
            $builder->update($data);

        }

    }
    

    /**
        * @method markPendingShopee() use to update the sales information based on id
        * @param sID encrypted data of sales_id
        * @var sid decrypted data of sales_id
        * @return sql_execution bool
    */
    public function markPendingShopee($sID){

        $sid = $this->encrypter->decrypt(str_ireplace(['~','$'],['/','+'],$sID));

        $builder = $this->db->table($this->tbls);
        $builder->where("sales_id", $sid);
        $builder->update(['status' => 'pending']); 

    }
    

    /**
        * @method markDeliveredShopee() use to update the sales information based on id
        * @param sID encrypted data of sales_id
        * @var sid decrypted data of sales_id
        * @return sql_execution bool
    */
    public function markDeliveredShopee($sID){

        $sid = $this->encrypter->decrypt(str_ireplace(['~','$'],['/','+'],$sID));

        $builder = $this->db->table($this->tbls);
        $builder->where("sales_id", $sid);
        $builder->update(['status' => 'delivered']); 

    }


    /**
        * @method markCancelledShopee() use to update the sales information based on id
        * @param sID encrypted data of sales_id
        * @var sid decrypted data of sales_id
        * @return sql_execution bool
    */
    public function markCancelledShopee($sID){

        $sid = $this->encrypter->decrypt(str_ireplace(['~','$'],['/','+'],$sID));

        $builder = $this->db->table($this->tbls);
        $builder->where("sales_id", $sid);
        $builder->update(['status' => 'cancelled']); 

    }


    /**
        * @method markMissingShopee() use to update the sales information based on id
        * @param sID encrypted data of sales_id
        * @var sid decrypted data of sales_id
        * @return sql_execution bool
    */
    public function markMissingShopee($sID){

        $sid = $this->encrypter->decrypt(str_ireplace(['~','$'],['/','+'],$sID));

        $builder = $this->db->table($this->tbls);
        $builder->where("sales_id", $sid);
        $builder->update(['status' => 'missing']); 

    }
    /**
        ---------------------------------------------------
        End Shopee sales Module area
        ---------------------------------------------------
    */
    
    
    










}