<?php
namespace App\Models;
use CodeIgniter\Model;
class Sales_model extends  Model {
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
    protected $tbls = "tbl_sales";
    protected $tblsi = "tbl_sales_item";
    protected $tblr = "tbl_reservation";
    protected $tblri = "tbl_reservation_item";
    protected $tblc = "tbl_customer";
    protected $tblu = "tbl_user";
    protected $tblwh = "tbl_warehouse";
    protected $tbli = "tbl_item";
    protected $tblq = "tbl_quotation";
    protected $tblqi = "tbl_quotation_item";


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
        Sales Module area
        ---------------------------------------------------
        * @method getAllSales() use to get the sales information based on status
        * @param stats status information of sales
        * @return sales->as->multiple_result
    */
    public function getAllSales($stats){

        if($stats == 'all'){
            $query = $this->db->query("select ts.* , wh.name as warehouse, tc.name as customer, tu.name as nameuser
            from ".$this->tbls." as ts, ".$this->tblwh." as wh, ".$this->tblc." as tc, ".$this->tblu." as tu
            where ts.warehouse_id = wh.warehouse_id
            and ts.customer_id = tc.customer_id
            and channel is null
            and ts.added_by = tu.user_id");
            return $query->getResultArray();
        }else{
            $query = $this->db->query("select ts.* , wh.name as warehouse, tc.name as customer, tu.name as nameuser
            from ".$this->tbls." as ts, ".$this->tblwh." as wh, ".$this->tblc." as tc, ".$this->tblu." as tu
            where ts.warehouse_id = wh.warehouse_id
            and ts.customer_id = tc.customer_id
            and ts.added_by = tu.user_id
            and channel is null
            and ts.status = '$stats'
        ");
            return $query->getResultArray();
        }

    }


    /**
        * @method getSubtotalSales() use to get subtotal of the sales information based on id
        * @param sID decrypted data of sales_id
        * @return sales->as->single_result
    */
    public function getSubtotalSales($sID){

        $query = $this->db->query("select ifnull ((select sum(quantity * price)
            from  ".$this->tblsi."
            where sales_id = $sID), 0) as subtotal
            ");
        return $query->getRowArray();
    }


    /**
        * @method getSalesItem() use to get the sales item information based on id
        * @param sID decrypted data of sales_id
        * @return item->as->multiple_result
    */
    public function getSalesItem($sID){

        $query = $this->db->query("SELECT si.sales_item_id,si.quantity,i.parent_id,i.item_id,i.name,si.price
        FROM tbl_sales_item si
        INNER JOIN (SELECT parent.item_id AS parent_id, it.item_id,CONCAT(parent.name, ' - ', it.name) AS name,it.wholesale_price,it.retail_price
            FROM tbl_item it INNER JOIN(SELECT item_id,name FROM tbl_item) parent ON it.parent = parent.item_id ORDER BY name ASC) i 
            ON si.item_id = i.item_id
        WHERE si.sales_id = $sID");
        return $query->getResultArray();    

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
        * @method countSales() use to count the sales information
        * @return sales->as->single_result
    */
    public function countSales(){

        $query = $this->db->query("select 
        
            ifnull ((select count(sales_id)
            from ".$this->tbls." as tbls
            where tbls.status = 'delivered'), 0) as delivered,

            ifnull ((select count(sales_id)
            from ".$this->tbls." as tbls
            where tbls.status = 'cancelled'), 0) as cancelled,

            ifnull ((select count(sales_id)
            from ".$this->tbls." as tbls
            where tbls.status = 'missing'), 0) as missing,

            ifnull ((select count(sales_id)
            from ".$this->tbls." as tbls), 0) as sales

        ");

        return $query->getRowArray();

    }


    /**
        * @method registerSales() use to register the sales information
        * @var cn contains customer name
        * @var invdate contains invoice_date
        * @var getuser contains user in customer information
        * @var data data container of sales information
        * @var getlasts contains sales_id
        * @var dataitem data container of sales item information
        * @var custdata data container of customer data if the customer does not yet exist on the system
        * @return sql_execution bool
    */
    public function registerSales(){
        
        $cn = trim($this->request->getPost("customer"));
        $invdate = $this->request->getPost('yy').'-'.$this->request->getPost('mm').'-'.$this->request->getPost('dd');

        $getuser = $this->db->query("select * from ".$this->tblc." where name = '$cn'")->getRowArray();
        
        if($getuser != null or !empty($getuser)){

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
                'payment_status' => 'unpaid',
                'status' => 'delivered',
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
                'invoice_no' => $this->request->getPost("invoice-no"),
                'invoice_date' => $invdate,
                'official_receipt' => $this->request->getPost("official-receipt"),
                'official_receipt_no' => $this->request->getPost("official-receipt-no"),
                'customer_id' => $reslcust['customer_id'],
                'address' => $reslcust['address'],
                'contact_number' => $reslcust['contact_number'],
                'warehouse_id' => $this->encrypter->decrypt($this->request->getPost("warehouse")),
                'delivery_method' => $this->request->getPost("delivery-method"),
                'delivery_fee' => $this->request->getPost("delivery-fee"),
                'payment_method' => $this->request->getPost("payment-method"),
                'payment_status' => 'unpaid',
                'status' => 'delivered',
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
            }

        }

    }


    /**
        * @method updateSales() use to update the sales information
        * @param sID encrypted data of sales_id
        * @var sid decrypted data of sales_id
        * @var cn contains customer name
        * @var invdate contains invoice_date
        * @var getuser contains user in customer information
        * @var data data container of sales information
        * @var dataitem data container of sales item information
        * @return sql_execution bool
    */
    public function updateSales($sID){
        
        $sid = $this->encrypter->decrypt(str_ireplace(['~','$'],['/','+'],$sID));
        $cn = trim($this->request->getPost("customer"));
        $invdate = $this->request->getPost('yy').'-'.$this->request->getPost('mm').'-'.$this->request->getPost('dd');
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
        }

    }


    /**
        * @method markDeliveredSales() use to update the sales information based on id
        * @param sID encrypted data of sales_id
        * @var sid decrypted data of sales_id
        * @return sql_execution bool
    */
    public function markDeliveredSales($sID){

        $sid = $this->encrypter->decrypt(str_ireplace(['~','$'],['/','+'],$sID));

        $data = array('status' => 'delivered');

        $buildder = $this->db->table($this->tbls);
        $buildder->where("sales_id", $sid);
        $buildder->update($data);

    }


    /**
        * @method markCancelledSales() use to update the sales information based on id
        * @param sID encrypted data of sales_id
        * @var sid decrypted data of sales_id
        * @return sql_execution bool
    */
    public function markCancelledSales($sID){

        $sid = $this->encrypter->decrypt(str_ireplace(['~','$'],['/','+'],$sID));

        $data = array('status' => 'cancelled');

        $buildder = $this->db->table($this->tbls);
        $buildder->where("sales_id", $sid);
        $buildder->update($data);

    }


    /**
        * @method markMissingSales() use to update the sales information based on id
        * @param sID encrypted data of sales_id
        * @var sid decrypted data of sales_id
        * @return sql_execution bool
    */
    public function markMissingSales($sID){

        $sid = $this->encrypter->decrypt(str_ireplace(['~','$'],['/','+'],$sID));

        $data = array('status' => 'missing');

        $buildder = $this->db->table($this->tbls);
        $buildder->where("sales_id", $sid);
        $buildder->update($data);

    }
    /**
        ---------------------------------------------------
        End of Sales Module area
        ---------------------------------------------------
    */


















    


    /**
        ---------------------------------------------------
        Reservation Module area
        ---------------------------------------------------
        * @method getCostumer() use to get the customer information based on id
        * @param cID encrypted data of reservation_id
        * @var cid decrypted data of reservation_id
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
        * @method getReservation() use to get the reservation information based on id
        * @param rID encrypted data of reservation_id
        * @var rid decrypted data of reservation_id
        * @return reservation->as->single_result
    */
    public function getReservation($rID){

        $rid = $this->encrypter->decrypt(str_ireplace(['~','$'],['/','+'], $rID));

        $query = $this->db->query("select tr.customer_id,reservation_id,tc.name as customer,tr.address,tr.contact_number,remark,twh.name as warehouse,tr.warehouse_id,delivery_method,delivery_date,delivery_fee,tr.status,tu.name as nameuser,tr.added_on 
        from ".$this->tblr." as tr, ".$this->tblc." as tc, ".$this->tblu." as tu, ".$this->tblwh." as twh
        where tr.customer_id = tc.customer_id
        and tr.warehouse_id = twh.warehouse_id
        and tr.added_by = tu.user_id
        and tr.reservation_id = $rid");
        return $query->getRowArray();

    }

    public function countItems($rID){

        $rid = $this->encrypter->decrypt(str_ireplace(['~','$'],['/','+'], $rID));
        $query = $this->db->query("select ifnull((select sum(quantity) from ".$this->tblri." where reservation_id = $rid),0) as ricount");
        return $query->getRowArray();

    }


    /**
        * @method countReservation() use to count the reservation information
        * @return reservation->as->single_result
    */
    public function countReservation(){

        $query = $this->db->query("select ifnull ((select count(customer_id)
            from ".$this->tblr." as tblr
            where tblr.status = 'open'), 0) as open,

            ifnull ((select count(customer_id)
            from ".$this->tblr." as tblr
            where tblr.status = 'ready'), 0) as ready,

            ifnull ((select count(customer_id)
            from ".$this->tblr." as tblr
            where tblr.status = 'completed'), 0) as completed,

            ifnull ((select count(customer_id)
            from ".$this->tblr." as tblr
            where tblr.status = 'cancelled'), 0) as cancelled,

            ifnull ((select count(customer_id)
            from ".$this->tblr." as tblr), 0) as reserv

        ");

        return $query->getRowArray();

    }


    /**
        * @method getAllReservation() use to get the reservation information based on status
        * @param stats status information of reservation
        * @return reservation->as->multiple_result
    */
    public function getAllReservation($stats){

        if($stats == 'all'){
            $query = $this->db->query("select tr.customer_id,reservation_id,tc.name as customer,tr.address,tr.contact_number,remark,twh.name as warehouse,delivery_method,delivery_date,delivery_fee,tr.status,tu.name as nameuser,tr.added_on 
            from ".$this->tblr." as tr, ".$this->tblc." as tc, ".$this->tblu." as tu, ".$this->tblwh." as twh
            where tr.customer_id = tc.customer_id
            and tr.warehouse_id = twh.warehouse_id
            and tr.added_by = tu.user_id");
            return $query->getResultArray();
        }else{
            $query = $this->db->query("select tr.customer_id,reservation_id,tc.name as customer,tr.address,tr.contact_number,remark,twh.name as warehouse,delivery_method,delivery_date,delivery_fee,tr.status,tu.name as nameuser,tr.added_on 
            from ".$this->tblr." as tr, ".$this->tblc." as tc, ".$this->tblu." as tu, ".$this->tblwh." as twh
            where tr.customer_id = tc.customer_id
            and tr.warehouse_id = twh.warehouse_id
            and tr.added_by = tu.user_id
            and tr.status = '$stats'");
            return $query->getResultArray();
        }

    }


    /**
        * @method getReserveItem() use to get the reservation item information based on id
        * @param rid decrypted data of reservation_id
        * @return item->as->multiple_result
    */
    public function getReserveItem($rid){

        $query = $this->db->query("SELECT ri.reservation_item_id, ri.quantity, i.parent_id, i.item_id, i.name, ri.price
        FROM tbl_reservation_item AS ri
        INNER JOIN (
            SELECT parent.item_id AS parent_id, ti.item_id, CONCAT(parent.name, ' - ', ti.name) AS name, ti.wholesale_price, ti.retail_price
            FROM tbl_item AS ti
            INNER JOIN (
                SELECT item_id, name
                FROM tbl_item
            ) AS parent ON ti.parent = parent.item_id
            ORDER BY name ASC
        ) AS i ON ri.item_id = i.item_id
        WHERE ri.reservation_id = $rid");
        return $query->getResultArray();

    }


    /**
        * @method getsubtotal() use to get the count of reservation item information based on id
        * @param rid decrypted data of reservation_id
        * @return item->as->single_result
    */
    public function getsubtotal($rid){

        $query = $this->db->query("select sum(quantity * price) as subtotal from ".$this->tblri." where reservation_id = $rid");
        return $query->getRowArray();

    }


    /**
        * @method registerReservation() use to register the sales information
        * @var cn contains customer name
        * @var deliveryDate contains delivery date
        * @var getuser contains user in customer information
        * @var data data container of sales information
        * @var reslres contains reservation_id
        * @var dataitem data container of sales item information
        * @var custdata data container of customer data if the customer does not yet exist on the system
        * @var reslcust contains customer data
        * @return sql_execution bool

    */
    public function registerReservation(){

        $cn = trim($this->request->getPost("customer"));
        $deliveryDate = $this->request->getPost('yy').'-'.$this->request->getPost('mm').'-'.$this->request->getPost('dd');

        $resuser = $this->db->query("select * from ".$this->tblc." where name = '$cn'")->getRowArray();

        if($resuser != null or !empty($resuser)){

            $data = array(
                'customer_id' => $resuser['customer_id'],
                'address' => $resuser['address'],
                'contact_number' => $resuser['contact_number'],
                'delivery_method' => $this->request->getPost("delivery-method"),
                'delivery_fee' => $this->request->getPost("delivery-fee"),
                'delivery_date' => $deliveryDate,
                'warehouse_id' => $this->encrypter->decrypt($this->request->getPost("warehouse")),
                'remark' => $this->request->getPost("remark"),
                'status' => 'open',
                'added_by' => $this->encrypter->decrypt($_SESSION['userID']),
                'added_on' => $this->date.' '.$this->time
            );
    
            $buildertr = $this->db->table($this->tblr);
            $buildertr->insert($data);
    
            $reslres = $this->db->query("select * from ".$this->tblr." order by reservation_id desc limit 1")->getRowArray();
    
            foreach($_POST['item'] as $i => $item){
                $dataitem = array(
                    'reservation_id' => $reslres['reservation_id'],
                    'item_id' => $this->encrypter->decrypt($_POST['item'][$i]),
                    'quantity' => $_POST['quantity'][$i],
                    'price' => $_POST['price'][$i]
                );
    
                $buildertri = $this->db->table($this->tblri);
                $buildertri->insert($dataitem);
    
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
                'customer_id' => $reslcust['customer_id'],
                'address' => $reslcust['address'],
                'contact_number' => $reslcust['contact_number'],
                'delivery_method' => $this->request->getPost("delivery-method"),
                'delivery_fee' => $this->request->getPost("delivery-fee"),
                'delivery_date' => $deliveryDate,
                'warehouse_id' => $this->encrypted->decrypt($this->request->getPost("warehouse")),
                'remark' => $this->request->getPost("remark"),
                'status' => 'open',
                'added_by' => $this->encrypter->decrypt($_SESSION['userID']),
                'added_on' => $this->date.' '.$this->time
            );

            $buildertr = $this->db->table($this->tblr);
            $buildertr->insert($data);

            $reslres = $this->db->query("select * from ".$this->tblr." order by reservation_id desc limit 1")->getRowArray();

            foreach($_POST['item'] as $i => $item){
                $dataitem = array(
                    'reservation_id' => $reslres['reservation_id'],
                    'item_id' => $this->encrypter->decrypt($_POST['item'][$i]),
                    'quantity' => $_POST['quantity'][$i],
                    'price' => $_POST['price'][$i]
                );

                $buildertri = $this->db->table($this->tblri);
                $buildertri->insert($dataitem);
            }

        }
        
    }



    /**
        * @method updateReservation() use to update the reservation information based on id
        * @param rID encrypted data of reservation_id
        * @var rid decrypted data of reservation_id
        * @var deliveryDate contains delivery date
        * @var data data container of sales information
        * @var dataitem data container of sales item information
        * @return sql_execution bool
    */
    public function updateReservation($rID){

        $rid = $this->encrypter->decrypt(str_ireplace(['~','$'],['/','+'],$rID));

        $deliveryDate = $this->request->getPost('yy').'-'.$this->request->getPost('mm').'-'.$this->request->getPost('dd');

        $data = array(
            'customer_id' => $this->request->getPost("customer-id"),
            'address' => $this->request->getPost("address"),
            'contact_number' => $this->request->getPost("contact-number"),
            'delivery_method' => $this->request->getPost("delivery-method"),
            'delivery_fee' => $this->request->getPost("delivery-fee"),
            'delivery_date' => $deliveryDate,
            'warehouse_id' => $this->encrypter->decrypt($this->request->getPost("warehouse")),
            'remark' => $this->request->getPost("remark"),
            'updated_by' => $this->encrypter->decrypt($_SESSION['userID']),
            'updated_on' => $this->date.' '.$this->time
        );


        $builder = $this->db->table($this->tblr);
        $builder->where("reservation_id",$rid);
        $builder->update($data);

        $builderi = $this->db->table($this->tblri);
        $builderi->where("reservation_id",$rid);
        $builderi->delete();

        foreach($_POST['item'] as $i => $item){

            $dataitem = array(
                'reservation_id' => $rid,
                'item_id' => $this->encrypter->decrypt($_POST['item'][$i]),
                'quantity' => $_POST['quantity'][$i],
                'price' => $_POST['price'][$i]
            );

            $buildertri = $this->db->table($this->tblri);
            $buildertri->insert($dataitem);

        }


    }
    /**
        ---------------------------------------------------
        End of Reservation Module area
        ---------------------------------------------------
    */












    


    /**
        ---------------------------------------------------
        Quotation Module area
        ---------------------------------------------------
        
        * @method getQuotations() use to get the quotation information
        * @return quotation->as->multiple_result

    */
    public function getQuotations(){

        $query = $this->db->query("select * ,tu.name as nameuser, tq.name as customer
        from ".$this->tblq." as tq,".$this->tblu." as tu
        where tq.added_by = tu.user_id
        ");
        return $query->getResultArray();

    }


    /**
        * @method getSubtotalQuotation() use to count the quotation information based on id
        * @param qID decrypted data of quotation_id
        * @return quotation->as->single_result
    */
    public function getSubtotalQuotation($qID){

        $query = $this->db->query("select sum(quantity * price) as subtotal from  ".$this->tblqi." where quotation_id = $qID");
        return $query->getRowArray();

    }


    /**
        * @method getQuotationData() use to get the quotation information based on id
        * @param qID decrypted data of quotation_id
        * @return quotation->as->single_result
    */
    public function getQuotationData($qID){

        $qid = $this->encrypter->decrypt(str_ireplace(['~','$'],['/','+'], $qID));

        $query = $this->db->query("select * ,tu.name as nameuser, tq.name as customer
        from ".$this->tblq." as tq,".$this->tblu." as tu
        where tq.added_by = tu.user_id
        and tq.quotation_id = $qid
        ");
        return $query->getRowArray();

    }


    /**
        * @method getQuotationItem() use to get the quotation item information based on id
        * @param qID encrypted data of quotation_id
        * @var qid decrypted data of quotation_id
        * @return item->as->single_result
    */
    public function getQuotationItem($qID){

        $qid = $this->encrypter->decrypt(str_ireplace(['~','$'],['/','+'], $qID));

        $query = $this->db->query("SELECT tbl_quotation_item.quotation_item_id, tbl_quotation_item.quantity, item.parent_id, item.item_id, item.name, tbl_quotation_item.price 
        FROM tbl_quotation_item INNER JOIN (SELECT parent.item_id as parent_id, tbl_item.item_id, CONCAT(parent.name, ' - ', tbl_item.name) as name 
        FROM tbl_item INNER JOIN (SELECT tbl_item.item_id, tbl_item.name FROM tbl_item) parent ON tbl_item.parent = parent.item_id 
        WHERE tbl_item.parent != '0') item ON tbl_quotation_item.item_id = item.item_id WHERE tbl_quotation_item.quotation_id = $qid");
        return $query->getResultArray();

    }


    /**
        * @method registerQuotation() use to register the quotation information
        * @var qdata data container of the quotation
        * @var reslq contains quotation_id
        * @var dataitem data container of the quotation item
        * @return sql_execution bool
    */
    public function registerQuotation(){

        $qdata = array(  
            'name' => ucfirst($this->request->GetPost("name")),
            'address' => ucfirst($this->request->GetPost("address")),
            'custom_header' => $this->request->GetPost("custom-header"),
            'custom_footer' => $this->request->GetPost("custom-footer"),
            'discount' => $this->request->GetPost("discount"),
            'delivery_fee' => $this->request->GetPost("delivery-fee"),
            'remarks' => $this->request->GetPost("remarks"),
            'added_by' => $this->encrypter->decrypt($_SESSION['userID']),
            'added_on' => $this->date.' '.$this->time
        );

        $builderq = $this->db->table($this->tblq);
        $builderq->insert($qdata);

        $reslq = $this->db->query("select * from ".$this->tblq." order by quotation_id desc limit 1")->getRowArray();
        
        foreach($_POST['item'] as $i => $item){
            $dataitem = array(
                'quotation_id' => $reslq['quotation_id'],
                'item_id' => $this->encrypter->decrypt($_POST['item'][$i]),
                'quantity' => $_POST['quantity'][$i],
                'price' => $_POST['price'][$i]
            );

            $builderqi = $this->db->table($this->tblqi);
            $builderqi->insert($dataitem);
        }

    }



    /**
        * @method updateQuotation() use to update the quotation information
        * @param qID encrypted data of quotation_id
        * @var qid decrypted data of quotation_id
        * @var qdata data container of the quotation
        * @var dataitem data container of the quotation item
        * @return sql_execution bool
    */
    public function updateQuotation($qID){

        $qid = $this->encrypter->decrypt(str_ireplace(['~','$'],['/','+'], $qID));

        $qdata = array(  
            'name' => ucfirst($this->request->GetPost("name")),
            'address' => ucfirst($this->request->GetPost("address")),
            'custom_header' => $this->request->GetPost("custom-header"),
            'custom_footer' => $this->request->GetPost("custom-footer"),
            'discount' => $this->request->GetPost("discount"),
            'delivery_fee' => $this->request->GetPost("delivery-fee"),
            'remarks' => $this->request->GetPost("remarks"),
            'updated_by' => $this->encrypter->decrypt($_SESSION['userID']),
            'updated_on' => $this->date.' '.$this->time
        );

        $builderq = $this->db->table($this->tblq);
        $builderq->where("quotation_id", $qid);
        $builderq->update($qdata);

        $builderi = $this->db->table($this->tblqi);
        $builderi->where("quotation_id",$qid);
        $builderi->delete();

        foreach($_POST['item'] as $i => $item){
            $dataitem = array(
                'quotation_id' => $qid,
                'item_id' => $this->encrypter->decrypt($_POST['item'][$i]),
                'quantity' => $_POST['quantity'][$i],
                'price' => $_POST['price'][$i]
            );

            $builderqi = $this->db->table($this->tblqi);
            $builderqi->insert($dataitem);
        }

   }
    /**
        ---------------------------------------------------
        End of Reservation Module area
        ---------------------------------------------------
    */












}