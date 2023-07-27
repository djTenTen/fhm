<?php
namespace App\Models;
use CodeIgniter\Model;
class Ajax_model extends  Model {
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
    protected $tblu = "tbl_user";
    protected $tblc = "tbl_customer";
    protected $tbls = "tbl_supplier";
    protected $tblsess = "tbl_session";
    protected $tblr = "tbl_reservation";
    protected $tblri = "tbl_reservation_item";
    protected $tblwh = "tbl_warehouse";
    protected $tblst = "tbl_stock_transfer";


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
        ----------------------------------------------------------
        Login Module area
        ----------------------------------------------------------
        AJAX FUNCTION get items on the input/auto search
        * @return items->json_encoded data
    */
    public function getActiveItems(){

        $searchTerm = $_GET['term'];
        $query = $this->db->query("SELECT item.parent_id, item.item_id, item.name, item.wholesale_price, item.retail_price 
        FROM (SELECT parent.item_id AS parent_id, item.item_id, CONCAT(parent.name, ' - ', item.name) AS name, item.wholesale_price, item.retail_price
            FROM tbl_item item
            INNER JOIN tbl_item parent ON item.parent = parent.item_id
            WHERE item.status = 'active'
            ORDER BY name ASC
            ) 
        AS item
        WHERE (item.name LIKE '%".$searchTerm."%')
        ORDER BY item.name ASC");

        $item = array();
        foreach($query->getResultArray() as $row){

            $data = array(
                'value' => $row['name'],
                'id' => $this->encrypter->encrypt($row['item_id']),
                'item_id' => $row['item_id'],
                'identifier' => str_pad($row['item_id'], 6, "0", STR_PAD_LEFT),
                'name' => $row['name'],
                'retail_price' => $row['retail_price'],
                'image' => site_url("public/uploads/".$row['item_id']."jpg")
            );

            array_push($item, $data);
        }
        echo json_encode($item);

    }



    




    /**
        ----------------------------------------------------------
        Customers Module area
        ----------------------------------------------------------
        AJAX FUNCTION get customers on the input/auto search
        * @return customers->json_encoded data
    */
    public function getCustomers(){

        $searchTerm = $_GET['term'];
        
        $query = $this->db->query("SELECT tc.customer_id, tc.name, tc.address, tc.contact_number, tc.email_address 
        FROM ".$this->tblc." tc 
        WHERE tc.name 
        LIKE '%".$searchTerm."%' 
        ORDER BY tc.name ASC");

        $customers = [];
        foreach($query->getResultArray() as $row){
            $data = [
                'value' => $row['name'],
                'id' => $this->encrypter->encrypt($row['customer_id']),
                'customer-id' => $this->encrypter->encrypt($row['customer_id']),
                'address' => ($row['address']),
                'contact-number' => $row['contact_number'],
                'email-address' => $row['email_address'],
            ];
            array_push($customers, $data);
        }

        echo json_encode($customers);

    }


    public function editCustomer($cID){

        $cid = $this->encrypter->decrypt(str_ireplace(['~','$'],['/','+'],$cID));

        $query = $this->db->query("select * from ".$this->tblc." where customer_id = $cid");
        $arr = [];
        foreach($query->getResultArray() as $row){

            if($row['type'] == 'personal'){

                $pers = [
                    'customer_id_e' => $cID,
                    'customer_id' => $row['customer_id'],
                    'name' => $row['name'],
                    'address' => $row['address'],
                    'contact_number' => $row['contact_number'],
                    'email_address' => $row['email_address'],
                    'remarks' => $row['remarks'],
                    'status' => $row['status']
                ];

                array_push($arr, $pers);

            }else{
                
                $corp = [
                    'customer_id_e' => $cID,
                    'customer_id' => $row['customer_id'],
                    'name' => $row['name'],
                    'address' => $row['address'],
                    'contact_number' => $row['contact_number'],
                    'email_address' => $row['email_address'],
                    'remarks' => $row['remarks'],
                    'username' => $cID,
                    'discount' => $row['discount'],
                    'website' => $row['website'],
                    'facebook' => $row['facebook'],
                    'instagram' => $row['instagram'],
                    'lazada' => $row['lazada'],
                    'shopee' => $row['shopee'],
                    'representative_name' => $row['representative_name'],
                    'representative_contact_number' => $row['representative_contact_number'],
                    'representative_email_address' => $row['representative_email_address'],
                    'status' => $row['status']
                ];

                array_push($arr, $corp);
            }

        }

        echo json_encode($arr);

    }






    /**
        ----------------------------------------------------------
        Supplier Module area
        ----------------------------------------------------------
        AJAX FUNCTION get supplier on the input/auto search
        * @return supplier->json_encoded data
    */
    public function getSupplier(){

        $searchTerm = $_GET['term'];

        $query = $this->db->query("select name 
        from ".$this->tbls."
        where status = 'active'
        and name like'%".$searchTerm."%'");
        
        $arr = array();
        foreach($query->getResultArray() as $row){
            array_push($arr, $row['name']);
        }
        echo json_encode($arr);

    }

    public function editSupplier($sID){

        $sid = $this->encrypter->decrypt(str_ireplace(['~','$'],['/','+'],$sID));

        $query = $this->db->query("select * from ".$this->tbls." where supplier_id = $sid");
        $arr = [];
        foreach($query->getResultArray() as $row){

            $data = [
                'supplier_id_e' => $sID,
                'supplier_id' => $row['supplier_id'],
                'name' => $row['name'],
                'address' => $row['address'],
                'contact_number' => $row['contact_number'],
                'contact_person' => $row['contact_person'],
                'position' => $row['position'],
                'remarks' => $row['remarks'],
                'status' => $row['status'],
            ];
            array_push($arr, $data);
            
        }


        echo json_encode($arr);

    }


    
    /**
        ----------------------------------------------------------
        Login Module area
        ----------------------------------------------------------
        check the user's authentication
        * @method checkAuthentication() is being executed during the login of the user
        * @param uID encrypted data of user_id
        * @var ueID decrypted data of user_id
        * @var db loads the connection to the database
        * @var result contains the login information of the user
        * if existed system will let you continue to use the system
        * otherwise it will @return eject and eject you
    */
    public function checkAuthentication(){

        $dsID = $this->encrypter->decrypt($_SESSION['sessionID']);
        $uID = $this->encrypter->decrypt($_SESSION['userID']);
        $system_session = $_SESSION['SysSess'];
        $result = $this->db->query("select * from ".$this->tblsess." where session_id = $dsID and system_session = '$system_session' and id =  $uID");
        
        if($result->getNumRows() > 0){

            $tf = $result->getRowArray();

            $date1 = new \DateTime($tf['log_time']);
            $date2 = new \DateTime($this->date.' '.$this->time);

            $interval = $date2->diff($date1);
            $totalMinutes = ($interval->days * 24 * 60) + ($interval->h * 60) + $interval->i;

            if($totalMinutes >= 30){

                $this->db->table($this->tblsess)->where("session_id", $dsID)->delete();
                $_SESSION['authentication'] = false;
                $this->session->remove(['userID','sessionID','SysSess','name','accounttype','status']);
                $_SESSION['session_timeout'] = 'session_timeout';
                echo "invalid";

            }else{

                echo "valid";

            }

        }else{

            $_SESSION['authentication'] = false;
            //$this->session->remove(['userID','sessionID','SysSess','name','accounttype','status' ,'status']);
            $_SESSION['eject'] = 'eject';
            echo "invalid";

        }

    }


    /**
        AJAX FUNCTION validate username if exist on database
        * @return bool
    */
    public function validateUsername($username){

        $query = "select username from ".$this->tblu." where username = ? limit 1";
        $res = $this->db->query($query, array($username));
        if($res->getNumRows() > 0){ 
            return true;
        }else{
            return false;
        }

    }












    /**
        ----------------------------------------------------------
        Reservation Module area
        ----------------------------------------------------------
        * @method viewReservationDetails() is to get the reservation information based on id
        * @param rID encrypted data of reservation_id
        * @var rid decrypted data of reservation_id
        * @var arr data container of the reservation information
        * @return json_encode
    */
    public function viewReservationDetails($rID){

        $rid = $this->encrypter->decrypt(str_ireplace(['~','$'],['/','+'],$rID));

        $query = $this->db->query("select tr.customer_id,reservation_id,tc.name as customer,tr.address,tr.contact_number,remark,twh.name as warehouse,tr.warehouse_id,delivery_method,delivery_date,delivery_fee,tr.status,tu.name as nameuser,tr.added_on 
        from ".$this->tblr." as tr, ".$this->tblc." as tc, ".$this->tblu." as tu, ".$this->tblwh." as twh
        where tr.customer_id = tc.customer_id
        and tr.warehouse_id = twh.warehouse_id
        and tr.added_by = tu.user_id
        and tr.reservation_id = $rid");

        $arr = [];
        foreach($query->getResultArray() as $row){

            $sub = $this->getsubtotal($rid);

            $data = [
                'reservation_id' => $row['reservation_id'],
                'status' => $row['status'],
                'delivery_method' => $row['delivery_method'],
                'delivery_date' => $row['delivery_date'],
                'delivery_fee' => $row['delivery_fee'],
                'customer' => $row['customer'],
                'address' => $row['address'],
                'contact_number' => $row['contact_number'],
                'subtotal' => $sub['subtotal'],
                'grandtotal' => $sub['subtotal'] + $row['delivery_fee'],
                'remark' => $row['remark'],
                'nameuser' => $row['nameuser'],
                'added_on' => $row['added_on']
            ];

            array_push($arr,$data );
        }

        echo json_encode($arr);

    }

    /**
        * @method viewReservationDetails() is to get the reservation item information based on id
        * @param rID encrypted data of reservation_id
        * @var rid decrypted data of reservation_id
        * @var arr data container of the reservation information
        * @return json_encode
    */
    public function viewReservationItems($rID){

        $rid = $this->encrypter->decrypt(str_ireplace(['~','$'],['/','+'],$rID));
        
        $query2 = $this->db->query("SELECT ri.reservation_item_id, ri.quantity, i.parent_id, i.item_id, i.name, ri.price
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

            $count = 0;
            $grand_total = 0;
            $delivery_fee = 0;
            $arr2 = [];
            foreach($query2->getResultArray() as $ritm){
                $data2 = [
                    'quantity' => $ritm['quantity'],
                    'name' => $ritm['name'],
                    'price' => $ritm['price'],
                    'sub_total' => $ritm['quantity'] * $ritm['price'],
                ];

                array_push($arr2, $data2);
            }

            echo json_encode($arr2);

    }






















    /**
        ----------------------------------------------------------
        Stock Transfer Module area
        ----------------------------------------------------------
        * @method viewSTdetails() is to get the stock transfer information based on id
        * @param stID encrypted data of reservation_id
        * @var stid decrypted data of reservation_id
        * @var arr data container of the reservation information
        * @return json_encode
    */
    public function viewSTdetails($stID){

        $stid = 5;//$this->encrypter->decrypt(str_ireplace(['~','$'],['/','+'],$stID));

        $query = $this->db->query("select * , tu.name as nameuser 
        from ".$this->tblst." tst,".$this->tblu." as tu 
        where tst.added_by = tu.user_id 
        and stock_transfer_id = $stid");
        
        $arr =[];
        foreach($query->getResultArray() as $row){

            $whf = $this->inventory_model->getwarehousename($row['transfer_from']);
            $wht = $this->inventory_model->getwarehousename($row['transfer_to']);

            $data = [
                'stock_transfer_id' => $row['stock_transfer_id'],
                'name' => $whf['name'],
                'stto' => $wht['name'],
                'nameuser' => $row['nameuser'],
                'added_on' => $row['added_on'],
                'status' => $row['status']
            ];

            array_push($arr, $data);

        }

        echo json_encode($arr);

    }


    public function viewSTitems($stID){

        $stid = $this->encrypter->decrypt(str_ireplace(['~','$'],['/','+'],$stID));

        $query = $this->db->query("SELECT i.parent_id, i.item_id, i.name, sti.quantity, sti.stock_transfer_item_id
        FROM tbl_stock_transfer_item sti
        INNER JOIN (
            SELECT parent.item_id AS parent_id, ti.item_id, CONCAT(parent.name, ' - ', ti.name) AS name
            FROM tbl_item ti
            INNER JOIN tbl_item parent ON ti.parent = parent.item_id
            WHERE ti.parent != '0'
        ) AS i ON sti.item_id = i.item_id
        WHERE sti.stock_transfer_id = $stid");

        $arr =[];
        foreach($query->getResultArray() as $row){

            $data = [
                'quantity' => $row['quantity'],
                'name' => $row['name'],
            ];

            array_push($arr, $data);

        }

        echo json_encode($arr);

    }




}