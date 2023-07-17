<?php
namespace App\Models;
use CodeIgniter\Model;
class Accounting_model extends  Model {
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
    protected $tblba = "tbl_bank_account";
    protected $tblec = "tbl_expense_category";
    protected $tble = "tbl_expense";
    protected $tblei = "tbl_expense_item";
    protected $tblp = "tbl_payment";
    protected $tblpd = "tbl_payment_detail";
    protected $tblpi = "tbl_payment_item";
    protected $tblu = "tbl_user";


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
        Expense Module area
        ---------------------------------------------------
        * @method getExpense() use to get the expense information based on status
        * @param state status information of expense
        * @return expense->as->multiple_result
    */
    public function getExpense($state){

        if($state == 'all'){

            $query = $this->db->query("SELECT e.remarks,e.expense_id,e.date,e.name,SUM(i.amount) AS total,e.status,u.added_by,e.added_on,u.name AS nameuser
            FROM ".$this->tble." e
            LEFT JOIN ".$this->tblei." i ON e.expense_id = i.expense_id
            INNER JOIN ".$this->tblu." u ON e.added_by = u.user_id
            GROUP BY e.expense_id
            ORDER BY e.added_on DESC");

            return $query->getResultArray();

        }else{

            $query = $this->db->query("SELECT e.remarks,e.expense_id,e.date,e.name,SUM(i.amount) AS total,e.status,u.added_by,e.added_on,u.name AS nameuser
            FROM ".$this->tble." e
            LEFT JOIN ".$this->tblei." i ON e.expense_id = i.expense_id
            INNER JOIN ".$this->tblu." u ON e.added_by = u.user_id
            WHERE e.status = '$state'
            GROUP BY e.expense_id
            ORDER BY e.added_on DESC");

            return $query->getResultArray();

        }

    }


    /**
        * @method viewExpense() use to get expense information based on id
        * @param eID decrypted data of expense_id
        * @return expense->as->single_result
    */
    public function viewExpense($eID){

        $eid = $this->encrypter->decrypt(str_ireplace(['~','$'],['/','+'],$eID));

        $query = $this->db->query("SELECT e.remarks,e.expense_id,e.date,e.name,SUM(i.amount) AS total,e.status,u.added_by,e.added_on,u.name AS nameuser
            FROM ".$this->tble." e
            LEFT JOIN ".$this->tblei." i ON e.expense_id = i.expense_id
            INNER JOIN ".$this->tblu." u ON e.added_by = u.user_id
            WHERE e.expense_id = $eid
            GROUP BY e.expense_id
            ORDER BY e.added_on DESC");

        return $query->getRowArray();

    }


    /**
        * @method getSummaryExpense() use to get summary expense information based on id
        * @param eID decrypted data of expense_id
        * @return expense->as->multiple_result
    */
    public function getSummaryExpense($eID){

        $query = $this->db->query("SELECT ei.expense_item_id,ec.name AS category,ei.description,ei.amount,ei.expense_category_id
        FROM ".$this->tblei." ei
        INNER JOIN ".$this->tblec." ec ON ei.expense_category_id = ec.expense_category_id
        WHERE ei.expense_id = '$eID'");

        return $query->getResultArray();

    }


    /**
        * @method paymentHistory() use to get history payment  information based on expense_id
        * @param eID decrypted data of expense_id
        * @return payment_history->as->multiple_result
    */
    public function paymentHistory($eID){

        $query = $this->db->query("SELECT pd.payment_id,pd.payment_detail_id,pd.bank_account_id,pd.date,pd.method,CONCAT(ba.name, ' (', ba.account_number, ')') AS bank_account,pd.check_payee,pd.check_number,pd.amount,pd.status
        FROM ".$this->tblpd." pd
        INNER JOIN 
        (SELECT p.payment_id 
        FROM ".$this->tblp." p INNER JOIN ".$this->tblpi." pi ON p.payment_id = pi.payment_id 
        WHERE pi.id = '$eID' AND p.type = 'expense' ) 
        payment ON pd.payment_id = payment.payment_id
        LEFT JOIN ".$this->tblba." ba ON pd.bank_account_id = ba.bank_account_id");
        return $query->getResultArray();

    }


    /**
        * @method saveExpense() use to register the expense information
        * @var ed contains expense date
        * @var expense[] data container of expense information
        * @var lastexp contains expense_id
        * @var expenseitem[] data container of expense item information
        * @var payment[] data container of payment information
        * @var lastpayment contains payment_id
        * @var custdata data container of customer data if the customer does not yet exist on the system
        * @return sql_execution bool
    */
    public function saveExpense(){

        $ed = $this->request->getPost('mme').'/'.$this->request->getPost('dde').'/'.$this->request->getPost('yye');

        $expense = [
            'name' => ucfirst($this->request->getPost('name')),
            'date' => $ed,
            'remarks' => $this->request->getPost('remarks'),
            'status' => 'pending',
            'added_by' => $this->encrypter->decrypt($_SESSION['userID']),
            'added_on' => $this->date.' '.$this->time
        ];

        $this->db->table($this->tble)->insert($expense);

        $lastexp = $this->db->table($this->tble)->select('expense_id')->orderBy('expense_id', 'desc')->limit(1)->get()->getRowArray();

        foreach($_POST['expense-category'] as $i => $val){
            $expenseitem = [
                'expense_id' => $lastexp['expense_id'],
                'expense_category_id' => $this->encrypter->decrypt($_POST['expense-category'][$i]),
                'description' => $_POST['expense-description'][$i],
                'amount' => $_POST['expense-amount'][$i]
            ];
            $this->db->table($this->tblei)->insert($expenseitem);
        }

        $payment = [
            'name' => ucfirst($this->request->getPost('name')),
            'type' => 'expense',
            'status' => 'pending',
            'added_by' => $this->encrypter->decrypt($_SESSION['userID']),
            'added_on' => $this->date.' '.$this->time
        ];

        $this->db->table($this->tblp)->insert($payment);

        $lastpayment = $this->db->table($this->tblp)->select('payment_id')->orderBy('payment_id', 'desc')->limit(1)->get()->getRowArray();

        foreach($_POST['payment-method'] as $i => $val){

            $pd = $_POST['mmp'][$i].'/'.$_POST['ddp'][$i].'/'.$_POST['yyp'][$i];

            if($_POST['payment-method'][$i] == 'check'){
                $expenseitem = [
                    'payment_id' => $lastpayment['payment_id'],
                    'date' => $pd,
                    'method' => $_POST['payment-method'][$i],
                    'bank_account_id' => $this->encrypter->decrypt($_POST['payment-bank-account'][$i]),
                    'check_payee' => $_POST['payment-check-payee'][$i],
                    'check_number' => $_POST['payment-check-number'][$i],
                    'amount' => $_POST['payment-amount'][$i],
                    'status' => 'pending'
                ];

            }else{
                $expenseitem = [
                    'payment_id' => $lastpayment['payment_id'],
                    'date' => $pd,
                    'method' => $_POST['payment-method'][$i],
                    'amount' => $_POST['payment-amount'][$i],
                    'status' => 'pending'
                ];
            }
            $this->db->table($this->tblpd)->insert($expenseitem);
        }

        $pi = [
            'payment_id' => $lastpayment['payment_id'],
            'id' => $lastexp['expense_id']
        ];
        
        $this->db->table($this->tblpi)->insert($pi);

    }


    /**
        * @method updateExpense() use to update the expense information
        * @param eID encrypted data of expense_id
        * @var eid decrypted data of expense_id
        * @var pid decrypted data of payment_id
        * @var ed contains expense date
        * @var expense[] data container of expense information
        * @var lastexp contains expense_id
        * @var expenseitem[] data container of expense item information
        * @var payment[] data container of payment information
        * @var lastpayment contains payment_id
        * @var custdata data container of customer data if the customer does not yet exist on the system
        * @return sql_execution bool
    */
    public function updateExpense($eID){

        $eid = $this->encrypter->decrypt(str_ireplace(['~','$'],['/','+'],$eID));
        $pid = $this->encrypter->decrypt($this->request->getPost('payment-id'));
        $ed = $this->request->getPost('mme').'/'.$this->request->getPost('dde').'/'.$this->request->getPost('yye');

        $expense = [
            'name' => ucfirst($this->request->getPost('name')),
            'date' => $ed,
            'remarks' => $this->request->getPost('remarks'),
            'updated_by' => $this->encrypter->decrypt($_SESSION['userID']),
            'updated_on' => $this->date.' '.$this->time
        ];

        $this->db->table($this->tble)->where("expense_id", $eid)->update($expense);

        $this->db->table($this->tblei)->where("expense_id", $eid)->delete();

        foreach($_POST['expense-category'] as $i => $val){
            
            $expenseitem = [
                'expense_id' => $eid,
                'expense_category_id' => $this->encrypter->decrypt($_POST['expense-category'][$i]),
                'description' => $_POST['expense-description'][$i],
                'amount' => $_POST['expense-amount'][$i]
            ];

            $this->db->table($this->tblei)->insert($expenseitem);
            
        }

        $payment = [
            'name' => ucfirst($this->request->getPost('name')),
            'updated_by' => $this->encrypter->decrypt($_SESSION['userID']),
            'updated_on' => $this->date.' '.$this->time
        ];

        $this->db->table($this->tblp)->where("payment_id", $pid)->update($payment);

        $this->db->table($this->tblpd)->where("payment_id", $pid)->delete();


        foreach($_POST['payment-method'] as $i => $val){

            $pd = $_POST['mmp'][$i].'/'.$_POST['ddp'][$i].'/'.$_POST['yyp'][$i];

            if($_POST['payment-method'][$i] == 'check'){
                $expenseitem = [
                    'payment_id' => $pid,
                    'date' => $pd,
                    'method' => $_POST['payment-method'][$i],
                    'status' => 'pending',
                    'bank_account_id' => $this->encrypter->decrypt($_POST['payment-bank-account'][$i]),
                    'check_payee' => $_POST['payment-check-payee'][$i],
                    'check_number' => $_POST['payment-check-number'][$i],
                    'amount' => $_POST['payment-amount'][$i],
                ];

            }else{
                $expenseitem = [
                    'payment_id' => $pid,
                    'date' => $pd,
                    'method' => $_POST['payment-method'][$i],
                    'amount' => $_POST['payment-amount'][$i],
                ];
            }

            $this->db->table($this->tblpd)->insert($expenseitem);
            
        }


    }

    public function updateExpensePending($eID){

        $eid = $this->encrypter->decrypt(str_ireplace(['~','$'],['/','+'],$eID));
        $this->db->table($this->tble)->where("expense_id",$eid)->update(['status' => 'pending']);

    }

    public function updateExpenseVerified($eID){

        $eid = $this->encrypter->decrypt(str_ireplace(['~','$'],['/','+'],$eID));
        $this->db->table($this->tble)->where("expense_id",$eid)->update(['status' => 'verified']);

    }


    public function updateExpenseCancelled($eID){

        $eid = $this->encrypter->decrypt(str_ireplace(['~','$'],['/','+'],$eID));
        $this->db->table($this->tble)->where("expense_id",$eid)->update(['status' => 'cancelled']);

    }























    public function viewPaymentSales($area){

        if($area == 'all'){
            $query = $this->db->query("SELECT p.payment_id, p.type, p.name, pd.total as paid, p.status, u.name AS added_by, p.added_on
            FROM ".$this->tblp." p LEFT JOIN 
            (SELECT payment_id, SUM(amount) AS total ".$this->tblpd." WHERE status = 'verified' GROUP BY  payment_id) pd 
            ON p.payment_id = pd.payment_id
            LEFT JOIN ".$this->tblu." u ON p.added_by = u.user_id
            ORDER BY p.added_on DESC");
    
            return $query->getResultArray();
        }else{
            $query = $this->db->query("SELECT p.payment_id, p.type, p.name, pd.total as paid, p.status, u.name AS added_by, p.added_on
            FROM ".$this->tblp." p LEFT JOIN 
            (SELECT payment_id, SUM(amount) AS total FROM ".$this->tblpd." WHERE status = 'verified' GROUP BY  payment_id) pd 
            ON p.payment_id = pd.payment_id
            LEFT JOIN ".$this->tblu." u ON p.added_by = u.user_id
            WHERE p.type = '$area'
            ORDER BY p.added_on DESC");
    
            return $query->getResultArray();
        }

    }


    public function paymentdue($pID,$area){

        $payment_due = 0;
        $query1 = $this->db->query("SELECT * FROM ".$this->tblp." WHERE payment_id = $pID");
    
        foreach($query1->getResultArray() as $q1){

            if($area == 'purchase'){

                $query2 = $this->db->query("SELECT p.purchase_id, COALESCE(pi.subtotal, 0) as total
                FROM ".$this->tblp." p
                LEFT JOIN (SELECT purchase_id, SUM(quantity * price) AS subtotal FROM tbl_purchase_item GROUP BY purchase_id) 
                pi ON p.purchase_id = pi.purchase_id
                WHERE p.purchase_id = ".$q1['id']." ");

            }elseif($area == 'sales'){

                $query2 = $this->db->query("SELECT s.sales_id, COALESCE((s.delivery_fee + si.subtotal), 0) AS total
                FROM  tbl_sales s
                LEFT JOIN ( SELECT sales_id, SUM(quantity * price) AS subtotal FROM tbl_sales_item GROUP BY sales_id) 
                si ON s.sales_id = si.sales_id
                WHERE s.sales_id = ".$q1['id']." ");

            }elseif($area == 'expense'){

                $query2 = $this->db->query("SELECT e.expense_id, COALESCE(ei.subtotal, 0) as total FROM 
                tbl_expense e LEFT JOIN (SELECT expense_id, SUM(amount) AS subtotal FROM tbl_expense_item GROUP BY expense_id)
                ei ON e.expense_id = ei.expense_id
                WHERE e.expense_id = ".$q1['id']." ");

            }

            foreach($query2->getResultArray() as $res){
                $payment_due += $res['total'];
            }

        }

        return $payment_due;
        

    }

























    public function getCategory(){

        $query = $this->db->query("select * from ".$this->tblec." where status='active'");
        return $query->getResultArray();

    }

    public function getParentCategory(){

        $query = $this->db->query("select * from ".$this->tblec." where status='active' and parent = 0");
        return $query->getResultArray();

    }

    public function getChildCategory($ecID){

        $query = $this->db->query("select * from ".$this->tblec." where status='active' and parent = $ecID");
        return $query->getResultArray();

    }

    public function saveExpenseCategory(){
        
        $data = [
            'name' => $this->request->getPost("name"),
            'parent' => $this->encrypter->decrypt($this->request->getPost("parent")),
            'status' => 'active',
            'added_by' => $this->encrypter->decrypt($_SESSION['userID']),
            'added_on' => $this->date.' '.$this->time
        ];

        $this->db->table($this->tblec)->insert($data);

    }




































    public function getBankAccount(){

        $query = $this->db->query("select * from ".$this->tblba."  ");
        return $query->getResultArray();

    }


    public function saveBankAccount(){

        $data = [
            'name' => ucfirst($this->request->getPost("name")),
            'account_number' => $this->request->getPost("account-number"),
            'status' => 'active',
            'added_by' => $this->encrypter->decrypt($_SESSION['userID']),
            'added_on' => $this->date.' '.$this->time
        ];

        $this->db->table($this->tblba)->insert($data);

    }


    public function updateBank($bID){

        $bid = $this->encrypter->decrypt(str_ireplace(['~','$'],['/','+'],$bID));

        $data = [
            'name' => ucfirst($this->request->getPost("name")),
            'account_number' => $this->request->getPost("account-number"),
            'status' =>  $this->request->getPost("status"),
            'updated_by' => $this->encrypter->decrypt($_SESSION['userID']),
            'updated_on' => $this->date.' '.$this->time
        ];

        $this->db->table($this->tblba)->where("bank_account_id", $bid)->update($data);


    }














}