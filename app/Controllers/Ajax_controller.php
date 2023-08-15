<?php 
namespace App\Controllers;
use CodeIgniter\API\ResponseTrait;
use TCPDF; // PDF Library
class Ajax_controller extends BaseController{
    /** 
        This is the Ajax Controller route request from the uri
    */

    
    /**
        Properties being used on this file
        * @property ajax_model to load the ajax model
        * @property request for the post function method
        * @property encrypter use for encryption
    */
    protected $ajax_model;
    protected $request;
    protected $encrypter;
    

    /**
        * @method __construct()is being executed automatically when this file is loaded
        * load all the methods/object to the properties of this class
    */
    public function __construct(){

        \Config\Services::session();
        $this->ajax_model = new \App\Models\Ajax_model;
        $this->request = \Config\Services::Request();
        $this->encrypter = \Config\Services::encrypter(); 
        helper(['form', 'url']);

    }








    

    /**
        ----------------------------------------------------------
        Items Module area
        ----------------------------------------------------------
        for the active items
        * @return item data
    */
    public function getActiveItems(){

        return $this->ajax_model->getActiveItems();

    }

    public function viewVariations($iID){

        return $this->ajax_model->viewVariations($iID);

    }











    
    /**
        ----------------------------------------------------------
        Users Module area
        ----------------------------------------------------------
        validation of username if exist
        * @return htmlcontent data
    */
    public function validateUsername() {

        $requestBody = json_decode($this->request->getBody());
		$username = $requestBody->username;
			
		if ('post' === $this->request->getMethod() && $username) {
			$result = $this->ajax_model->validateUsername($username);
			if ($result === true) {
				echo '<span style="color:red;">Username already taken</span>';
			} else {
				echo '<span style="color:green;">Username Available</span>';
			}
		} else {
			echo '<span style="color:red;">You must enter username</span>';
		}

	}









    /**
        ----------------------------------------------------------
        Customers Module area
        ----------------------------------------------------------
        gets all the customers information
        * @return customer data
    */
    public function getCustomers(){

        return $this->ajax_model->getCustomers();

    }
    /**
        gets the specific customer information
        * @return customer data
    */
    public function editCustomer($cID){
        return $this->ajax_model->editCustomer($cID);
    }




    /**
        ____________________________________________________
        
        Supplier Area
        ____________________________________________________
        get all the supplier information
        * @return supplier data
    */
    public function getSupplier(){
        return $this->ajax_model->getSupplier();
    }

    /**
        get the specific supplier information
        * @return supplier data
    */
    public function editSupplier($suppID){
        return $this->ajax_model->editSupplier($suppID);
    }





    /**
        ----------------------------------------------------------
        Login Module area
        ----------------------------------------------------------
        check the user's authentication
        * @return invalid data
    */
    public function checkAuthentication(){

        $res = $this->ajax_model->checkAuthentication();
        
        if($res == 'invalid'){
            return $res;
        }

    }







    /**
        ----------------------------------------------------------
        Reservation Module area
        ----------------------------------------------------------
        gets the specific reservation information
        * @return reservation data
    */
    public function viewReservationDetails($rID){

        return $this->ajax_model->viewReservationDetails($rID);

    }
    /**
        gets the specific reservation item information
        * @return reservation_item data
    */
    public function viewReservationItems($rID){

        return $this->ajax_model->viewReservationItems($rID);

    }

















    /**
        ----------------------------------------------------------
        Quotation Module area
        ----------------------------------------------------------
        * @return reservation data
    */
    public function getQuotationItem($qID){

        return $this->ajax_model->getQuotationItem($qID);

    }



















    /**
        ----------------------------------------------------------
        Purchase Module area
        ----------------------------------------------------------
        * @return reservation data
    */
    public function getPurchaseDetails($pID){

        return $this->ajax_model->getPurchaseDetails($pID);

    }

    public function getPurchaseItems($pID){

        return $this->ajax_model->getPurchaseItems($pID);

    }




    
    



















    /**
        ----------------------------------------------------------
        Expense Module area
        ----------------------------------------------------------
    */
    public function viewExpenseDetails($eID){

        return $this->ajax_model->viewExpenseDetails($eID);

    }


    public function viewExpenseSummary($eID){

        return $this->ajax_model->viewExpenseSummary($eID);
        
    }


    public function viewpaymentHistory($eID){

        return $this->ajax_model->viewpaymentHistory($eID);
        
    }

    


    
















    /**
        ----------------------------------------------------------
        Sales Module area
        ----------------------------------------------------------
    */
    public function viewSalesDetails($sID){

        return $this->ajax_model->viewSalesDetails($sID);

    }

    public function viewSalesItems($sID){

        return $this->ajax_model->viewSalesItems($sID);

    }








    











    




    /**
        ----------------------------------------------------------
        Stock Module area
        ----------------------------------------------------------
        gets the specific stock transfer information
        * @return stock_transfer data
    */
    public function viewSTdetails($stID){
        $this->ajax_model->viewSTdetails($stID);
    }

    /**
        gets the specific stock transfer item information
        * @return stock_transfer_item data
    */
    public function viewSTitems($stID){
        $this->ajax_model->viewSTitems($stID);
    }




















    /**
        ----------------------------------------------------------
        Payment Module area
        ----------------------------------------------------------
        * @return purchase data
    */
    public function getPurchase($type){
        $this->ajax_model->getPurchase($type);
    }


    
    


}