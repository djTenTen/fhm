<?php 
namespace App\Controllers;
use CodeIgniter\API\ResponseTrait;
class Item_controller extends BaseController{
    /** 
        All Display function has user validation of authentication
        if the user rejected/ejected it will return on the login page.
        It checks if user has session and authenticated
    */


    /**
        Properties being used on this file
        * @property item_model to load the item model
        * @property login_model to load the login model
        * @property request for the post function method
    */
    protected $item_model;
    protected $request;


    /**
        * @method __construct()is being executed automatically when this file is loaded
        * load all the methods/object to the properties of this class
    */
    public function __construct(){

        \Config\Services::session();
        $this->item_model = new \App\Models\Item_model;
        $this->request = \Config\Services::Request();
        helper(['form', 'url']);

    }


    /**
        * @method addItem() is to view the adding page of item
        * @var data->category contains item category information
        * @var page is the name of the php file
        * @var data->title displays the title on the Tab browser
    */
    public function addItem(){

        // main content
        $page = 'additems';
        $data['title'] = 'Add Item';

        $data['category'] = $this->item_model->getCategory();

        echo view('includes/header', $data);
        echo view('item/'.$page, $data);
        echo view('includes/footer');
    
    }


    /**
        * @method item() is to view the item page
        * @param stats reference for the display on item page
        * @var data->acostumer contains items information
        * @var data->warehouse contains warehouse information
        * being displayed on the customer page
        * @var page is the name of the php file
        * @var data->title displays the title on the Tab browser
    */
    public function item($stats){

        // main content
        $page = 'items';
        $data['title'] = 'Item Management';

        $data['items'] = $this->item_model->getItems($stats);

        echo view('includes/header', $data);
        echo view('item/'.$page, $data);
        echo view('includes/footer');

    }


    /**
        * @method editItem() is to view the editing item page
        * @param iID the encrypted data of item_id
        * @var data->iid contains the encrypted data from iID
        * @var data->items contains items information
        * @var data->vars contains variation items information
        * @var data->category contains category items information
        * being displayed on the customer page
        * @var page is the name of the php file
        * @var data->title displays the title on the Tab browser
    */
    public function editItem($iID){

        // main content
        $page = 'edititem';
        $data['title'] = 'Item Management';

        $data['iid'] = $iID;
        $data['items'] = $this->item_model->getEditItem($iID);
        $data['vars'] = $this->item_model->getEditVariationItems($iID);
        $data['category'] = $this->item_model->getCategory();

        echo view('includes/header', $data);
        echo view('item/'.$page, $data);
        echo view('includes/footer');
    
    }


    /**
        * @method category() is to view the item's category page
        * @var data->category contains item category information
        * @var page is the name of the php file
        * @var data->title displays the title on the Tab browser
    */
    public function category(){

        // main content
        $page = 'category';
        $data['title'] = 'Category Management';
        $data['category'] = $this->item_model->getCategory();

        echo view('includes/header', $data);
        echo view('item/'.$page, $data);
        echo view('includes/footer');
    
    }


    /**
        * @method updateItem() is use to route the update of item to the model
        * @param iID is the encrypted data of item_id
        * @var session->item_updated the msg display on the Interface
        * @return to->edititem page
    */
    public function updateItem($iID){

        $this->item_model->updateItem($iID);
        $_SESSION['item_updated'] = 'item_updated';
        return redirect()->to(site_url('item/edit/'.$iID));

    }


    /**
        * @method updateCategory() is use to route the update of category to the model
        * @param cID is the encrypted data of category_id
        * @var session->category_updated the msg display on the Interface
        * @return to->category page
    */
    public function updateCategory($cID){

        $this->item_model->updateCategory($cID);
        $_SESSION['category_updated'] = 'category_updated';
        return redirect()->to(site_url('item/viewcategory'));

    }


    /**
        * @method deactivateCategory() is use to route the deactivation of category to the model
        * @param cID is the encrypted data of category_id
        * @var session->category_deactivated the msg display on the Interface
        * @return to->category page
    */
    public function deactivateCategory($cID){

        $this->item_model->deactivateCategory($cID);
        $_SESSION['category_deactivated'] = 'category_deactivated';
        return redirect()->to(site_url('item/viewcategory'));

    }


    /**
        * @method registerCategory() is use to route the registration of category to the model
        * @var session->category_deactivated the msg display on the Interface
        * @return to->category page
    */
    public function registerCategory(){

       $this->item_model->registerCategory();
        $_SESSION['category_registered'] = 'category_registered';
        return redirect()->to(site_url('item/viewcategory'));

    }


    /**
        * @method registerItem() is use to route the registration of item to the model
        * @var session->item_registered the msg display on the Interface
        * @return to->additem page
    */
    public function registerItem(){

        $this->item_model->registerItem();
        $_SESSION['item_registered'] = 'item_registered';
        return redirect()->to(site_url('item/add'));

    }


    


















}