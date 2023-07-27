<?php 
namespace App\Controllers;
use CodeIgniter\API\ResponseTrait;
use TCPDF; // PDF Library
class Accounting_controller extends BaseController{
    /** 
        All Display function has user validation of authentication
        if the user rejected/ejected it will return on the login page.
        It checks if user has session and authenticated
    */

    
    /**
        Properties being used on this file
        * @property system_model to load the system model
        * @property accounting_model to load the accounting model
        * @property request for the post function method
        * @property encrypter use for encryption
    */
    protected $system_model;
    protected $accounting_model;
    protected $request;
    protected $encrypter;
    

    /**
        * @method __construct()is being executed automatically when this file is loaded
        * load all the methods/object to the properties of this class
    */
    public function __construct(){

        \Config\Services::session();
        $this->system_model = new \App\Models\System_model;
        $this->accounting_model = new \App\Models\Accounting_model;
        $this->request = \Config\Services::Request();
        $this->encrypter = \Config\Services::encrypter(); 
        helper(['form', 'url']);

    }


    /**
        ----------------------------------------------------------
        Expense Module area
        ----------------------------------------------------------
        * @method viewExpense() use to display the expense page
        * @param state contains data submitted which expense should be displayed
        * @var data->state contains the expense sub information
        * @var data->expense contains the expense information
        * @var data->category contains the expense category information
        * @var data->paymentmethod contains the system default payment method
        * @var data->bank contains bank accounts information
        * being displayed on the expense  page
        * @var page is the name of the php file
        * @var data->title displays the title on the Tab browser
    */
    public function viewExpense($state){

        // main content
        $page = 'expense';
        $data['title'] = 'Expense Management';

        $data['state'] = ucfirst($state);
        
        $data['expense'] = $this->accounting_model->getExpense($state);
        $data['category'] = $this->accounting_model->getCategory();
        $data['paymentmethod'] = $this->system_model->getPaymentMethod();
        $data['bank'] = $this->accounting_model->getBankAccount();

        echo view('includes/header', $data);
        echo view('accounting/'.$page, $data);
        echo view('includes/footer');
    
    }


    /**
        * @method addExpense() use to display the expense adding page
        * @var data->expense contains the expense information
        * @var data->category contains the expense category information
        * @var data->paymentmethod contains the system default payment method
        * @var data->bank contains bank accounts information
        * being displayed on the expense page
        * @var page is the name of the php file
        * @var data->title displays the title on the Tab browser
    */
    public function addExpense(){

        // main content
        $page = 'addexpense';
        $data['title'] = 'Expense Management';

        $data['category'] = $this->accounting_model->getCategory();
        $data['paymentmethod'] = $this->system_model->getPaymentMethod();
        $data['bank'] = $this->accounting_model->getBankAccount();

        echo view('includes/header', $data);
        echo view('accounting/'.$page, $data);
        echo view('includes/footer');

    }


    /**
        * @method editExpense() use to display the expense edit page
        * @param eID encrypted data of expense id
        * @var data->eID passing the data from @param eID
        * @var data->exp contains the expense information
        * @var data->summexpense contains the expense summary information
        * @var data->phistory contains payment history of expense
        * @var data->ddate cropping the date
        * @var data->category contains the expense category information
        * @var data->paymentmethod contains the system default payment method
        * @var data->bank contains bank accounts information
        * being displayed on the expense page
        * @var page is the name of the php file
        * @var data->title displays the title on the Tab browser
    */
    public function editExpense($eID){

        // main content
        $page = 'editexpense';
        $data['title'] = 'Expense Management';
        
        $data['eID'] = $eID;

        $data['exp'] = $this->accounting_model->viewExpense($eID);
        $data['summexpense'] = $this->accounting_model->getSummaryExpense($this->encrypter->decrypt(str_ireplace(['~','$'],['/','+'],$eID)));
        $data['phistory'] = $this->accounting_model->paymentHistory($this->encrypter->decrypt(str_ireplace(['~','$'],['/','+'],$eID)));
        
        $data['ddate'] = explode('-', $data['exp']['date']);

        $data['category'] = $this->accounting_model->getCategory();
        $data['paymentmethod'] = $this->system_model->getPaymentMethod();
        $data['bank'] = $this->accounting_model->getBankAccount();

        echo view('includes/header', $data);
        echo view('accounting/'.$page, $data);
        echo view('includes/footer');

    }


    /**
        * @method printVoucher() use to print the voucher to pdf
        * @param eID encrypted data of expense id
        * @var data->exp contains the expense information
        * @var data->summexpense contains the expense summary information
        * @var data->phistory contains payment history of expense
        * being displayed on the expense page
        * @var page is the name of the php file
        * @var data->title displays the title on the Tab browser
    */
    public function printVoucher($eID){

        $page = 'printvoucher';

        $data['exp'] = $this->accounting_model->viewExpense($eID);
        $data['summexpense'] = $this->accounting_model->getSummaryExpense($this->encrypter->decrypt(str_ireplace(['~','$'],['/','+'],$eID)));
        $data['phistory'] = $this->accounting_model->paymentHistory($this->encrypter->decrypt(str_ireplace(['~','$'],['/','+'],$eID)));

        view('accounting/'.$page, $data);

    }


    /**
        * @method saveExpense() is use to route the registration of expense to the model
        * @var session->expense_added the msg display on the Interface
        * @return to->addexpense page
    */
    public function saveExpense(){

        $this->accounting_model->saveExpense();
        $_SESSION['expense_added'] = 'expense_added';
        return redirect()->to(site_url('expense/add'));

    }


    /**
        * @method updateExpense() is use to route the update of expense to the model
        * @var session->expense_updated the msg display on the Interface
        * @return to->expense page
    */
    public function updateExpense($eID){

        $this->accounting_model->updateExpense($eID);
        $_SESSION['expense_updated'] = 'expense_updated';
        return redirect()->to(site_url('expense/view/all'));

    }


    /**
        * @method updateExpensePending() is use to route the update of expense to the model
        * @var session->expense_pending the msg display on the Interface
        * @return to->expense page
    */
    public function updateExpensePending($eID){

        $this->accounting_model->updateExpensePending($eID);
        $_SESSION['expense_pending'] = 'expense_pending';
        return redirect()->to(site_url('expense/view/pending'));

    }


    /**
        * @method updateExpenseVerified() is use to route the update of expense to the model
        * @var session->expense_completed the msg display on the Interface
        * @return to->expense page
    */
    public function updateExpenseVerified($eID){

        $this->accounting_model->updateExpenseVerified($eID);
        $_SESSION['expense_completed'] = 'expense_completed';
        return redirect()->to(site_url('expense/view/verified'));

    }


    /**
        * @method updateExpenseCancelled() is use to route the update of expense to the model
        * @var session->expense_cancelled the msg display on the Interface
        * @return to->expense page
    */
    public function updateExpenseCancelled($eID){

        $this->accounting_model->updateExpenseCancelled($eID);
        $_SESSION['expense_cancelled'] = 'expense_cancelled';
        return redirect()->to(site_url('expense/view/cancelled'));

    }


    
    
    

    









    
    public function viewPayment($area){

        // main content
        $page = 'payment';
        $data['title'] = 'Payment Management';
        
        $data['area'] = ucfirst($area);

        $data['paymentsales'] = $this->accounting_model->viewPaymentSales($area);

        echo view('includes/header', $data);
        echo view('accounting/'.$page, $data);
        echo view('includes/footer');

    }


























    /**
        ----------------------------------------------------------
        Expense category Module area
        ----------------------------------------------------------
        * @method viewExpense() use to display the expense page
        * @param state contains data submitted which expense should be displayed
        * @var data->state contains the expense sub information
        * @var data->expense contains the expense information
        * @var data->category contains the expense category information
        * @var data->paymentmethod contains the system default payment method
        * @var data->bank contains bank accounts information
        * being displayed on the expense  page
        * @var page is the name of the php file
        * @var data->title displays the title on the Tab browser
    */
    public function expenseCategory(){

        // main content
        $page = 'expensecategory';
        $data['title'] = 'Expense Category Management';

        $data['category'] = $this->accounting_model->getCategory();
        $data['parentcategory'] = $this->accounting_model->getParentCategory();

        echo view('includes/header', $data);
        echo view('accounting/'.$page, $data);
        echo view('includes/footer');

    }
    

    public function saveExpenseCategory(){

        $this->accounting_model->saveExpenseCategory();
        $_SESSION['expensecategory_added'] = 'expensecategory_added';
        return redirect()->to(site_url('expense/expensecategory'));

    }





    






















    public function bankAccount(){

        // main content
        $page = 'bankaccount';
        $data['title'] = 'Bank Account Management';

        $data['bank'] = $this->accounting_model->getBankAccount();

        

        echo view('includes/header', $data);
        echo view('accounting/'.$page, $data);
        echo view('includes/footer');
    
    }




    public function saveBankAccount(){

        $this->accounting_model->saveBankAccount();
        $_SESSION['bank_added'] = 'bank_added';
        return redirect()->to(site_url('bank/view'));

    }


    public function updateBank($bID){

        $this->accounting_model->updateBank($bID);
        $_SESSION['bank_updated'] = 'bank_updated';
        return redirect()->to(site_url('bank/view'));

    }




























    

}