<?php
namespace App\Controllers;
use CodeIgniter\API\ResponseTrait;
class Store_controller extends BaseController{
    /** 
        All Display function has user validation of authentication
        if the user rejected/ejected it will return on the login page.
        It checks if user has session and authenticated
    */

    
    /**
        Properties being used on this file
        * @property supplier_model to load the supplier model
        * @property request for the post function method
    */
    protected $item_model;
    protected $warehouse_model;
    protected $store_model;
    protected $request;
    protected $encrypter;


    /**
        * @method __construct()is being executed automatically when this file is loaded
        * load all the methods/object to the properties of this class
    */
    public function __construct(){

        \Config\Services::session();
        $this->item_model = new \App\Models\Item_model;
        $this->warehouse_model = new \App\Models\Warehouse_model;
        $this->store_model = new \App\Models\Store_model; 
        $this->request = \Config\Services::Request();
        $this->encrypter = \Config\Services::encrypter(); 

    }




    /**
        ----------------------------------------------------------
        Catalog Module area
        ----------------------------------------------------------
    */
    public function sections(){

        $page = 'sections';
        $data['title'] = 'Sections';

        $data['section'] = $this->store_model->viewSections();

        echo view('includes/header', $data);
        echo view('store/'.$page, $data);
        echo view('includes/footer');

    }

    public function addContent(){

        $page = 'addcontent';
        $data['title'] = 'Add Content';

        $data['section'] = $this->store_model->viewSections();
        $data['cate'] = $this->item_model->getCategory();

        echo view('includes/header', $data);
        echo view('store/'.$page, $data);
        echo view('includes/footer');

    }


    public function saveSection(){

        $this->store_model->saveSection();
        $_SESSION['section_added'] = 'section_added';
        return redirect()->to(site_url('catalog/sections'));

    }

    public function saveContent(){

        $this->store_model->saveContent();
        $_SESSION['content_added'] = 'content_added';
        return redirect()->to(site_url('catalog/addcontent'));

    }

    


    /**
        ----------------------------------------------------------
        End of Damage Module area
        ----------------------------------------------------------
    */

























    /**
        ----------------------------------------------------------
        Damage Module area
        ----------------------------------------------------------

        * @method addDamageItem() use to display the adding page of damage item
        * @var data->items contains the item information
        * @var data->warehouse contains warehouse information
        * being displayed on the damage item page
        * @var page is the name of the php file
        * @var data->title displays the title on the Tab browser
    */
    public function addDamageItem(){

        $page = 'adddamageitem';
        $data['title'] = 'Damage Items';

        $data['items'] = $this->store_model->getItems();
        $data['warehouse'] = $this->warehouse_model->getActiveWarehouse();

        echo view('includes/header', $data);
        echo view('store/'.$page, $data);
        echo view('includes/footer');

    }


    /**
        * @method viewDamageItem() use to display the damage item page
        * @param state contains data submitted which damage item should be displayed
        * @var data->state passing data from the @param state
        * @var data->damage contains the current data of damage item
        * being displayed on the damage item page
        * @var page is the name of the php file
        * @var data->title displays the title on the Tab browser
    */
    public function viewDamageItem($state){

        $page = 'damageitem';
        $data['title'] = 'Damage Items';
        
        $data['state'] = ucfirst($state);
        $data['damage'] = $this->store_model->viewdamageitem($state);

        echo view('includes/header', $data);
        echo view('store/'.$page, $data);
        echo view('includes/footer');
    
    }


    /** 
        * @method editDamageItem() use to display the edit damge item page
        * @param diID encrypted data of sales_id
        * @var data->diid passing the value from @param diID and display on the post update
        * @var data->damage contains the data of damage
        * @var data->items contains the information of items damage
        * @var data->warehouse contains warehouse information
        * being displayed on the edit damage item page
        * @var page is the name of the php file
        * @var data->title being load on the header section and displays the title(Tab Display)
    */
    public function editDamageItem($diID){

        $page = 'editdamageitem';
        $data['title'] = 'Damage Items';
        
        $data['diid'] = $diID;

        $data['damage'] = $this->store_model->viewEditDamageItems($diID);

        $data['items'] = $this->store_model->getItems();
        $data['warehouse'] = $this->warehouse_model->getActiveWarehouse();

        echo view('includes/header', $data);
        echo view('store/'.$page, $data);
        echo view('includes/footer');
    
    }


    /**
        * @method saveDamageItem() is use to route the registration of damage item to the model
        * @var session->damageitem_added the msg display on the Interface
        * @return to->adddamageitem page
    */
    public function saveDamageItem(){

        $this->store_model->saveDamageItem();
        $_SESSION['damageitem_added'] = 'damageitem_added';
        return redirect()->to(site_url('damageitem/adddamageitem'));

    }
    

    /**
        * @method updateDamageItem() is use to route the update of damage item to the model
        * @param diID encypted data of damage_item_id
        * @var session->damageitem_updated the msg display on the Interface
        * @return to->viewdamageitem/all page
    */
    public function updateDamageItem($diID){

        $this->store_model->updateDamageItem($diID);
        $_SESSION['damageitem_updated'] = 'damageitem_updated';
        return redirect()->to(site_url('damageitem/viewdamageitem/all'));

    }


    /**
        * @method markpendingDamageItem() is use to route the update of damage item to the model
        * @param diID encypted data of damage_item_id
        * @var session->damageitem_pending the msg display on the Interface
        * @return to->viewdamageitem/pending page
    */
    public function markpendingDamageItem($diID){

        $this->store_model->markpendingDamageItem($diID);
        $_SESSION['damageitem_pending'] = 'damageitem_pending';
        return redirect()->to(site_url('damageitem/viewdamageitem/pending'));

    }


    /**
        * @method markreplacedDamageItem() is use to route the update of damage item to the model
        * @param diID encypted data of damage_item_id
        * @var session->damageitem_replaced the msg display on the Interface
        * @return to->viewdamageitem/replaced page
    */
    public function markreplacedDamageItem($diID){

        $this->store_model->markreplacedDamageItem($diID);
        $_SESSION['damageitem_replaced'] = 'damageitem_replaced';
        return redirect()->to(site_url('damageitem/viewdamageitem/replaced'));

    }


    /**
        * @method marksoldDamageItem() is use to route the update of damage item to the model
        * @param diID encypted data of damage_item_id
        * @var session->damageitem_sold the msg display on the Interface
        * @return to->viewdamageitem/sold page
    */
    public function marksoldDamageItem($diID){

        $this->store_model->marksoldDamageItem($diID);
        $_SESSION['damageitem_sold'] = 'damageitem_sold';
        return redirect()->to(site_url('damageitem/viewdamageitem/sold'));

    }
    
    /**
        ----------------------------------------------------------
        End of Damage Module area
        ----------------------------------------------------------
    */
    
























    /**
        ----------------------------------------------------------
        Display Module area
        ----------------------------------------------------------
        * @method addDisplayItem() use to display the adding page of display item
        * @var data->items contains the item information
        * @var data->warehouse contains warehouse information
        * being displayed on the display item page
        * @var page is the name of the php file
        * @var data->title displays the title on the Tab browser
    */
    public function addDisplayItem(){

        $page = 'adddisplayitem';
        $data['title'] = 'Display Items';

        $data['items'] = $this->store_model->getItems();
        $data['warehouse'] = $this->warehouse_model->getActiveWarehouse();

        echo view('includes/header', $data);
        echo view('store/'.$page, $data);
        echo view('includes/footer');
    
    }


    /**
        * @method viewDisplayItem() use to display the display item page
        * @param state contains data submitted which display item should be displayed
        * @var data->state passing data from the @param state
        * @var data->display contains the current data of display item
        * being displayed on the display item page
        * @var page is the name of the php file
        * @var data->title displays the title on the Tab browser
    */
    public function viewDisplayItem($state){

        $page = 'displayitem';
        $data['title'] = 'Display Items';
        
        $data['state'] = ucfirst($state);
        $data['display'] = $this->store_model->viewDisplayItems($state);

        echo view('includes/header', $data);
        echo view('store/'.$page, $data);
        echo view('includes/footer');

    }
    

    /**
        * @method saveDisplayItem() is use to route the registration of display item to the model
        * @var session->displayitem_added the msg display on the Interface
        * @return to->adddisplayitem page
    */
    public function saveDisplayItem(){

        $this->store_model->saveDisplayItem();
        $_SESSION['displayitem_added'] = 'displayitem_added';
        return redirect()->to(site_url('displayitem/adddisplayitem'));

    }


    /**
        * @method markdisplayedDisplayItem() is use to route the update of display item to the model
        * @param diID encypted data of display_item_id
        * @var session->displayitem_displayed the msg display on the Interface
        * @return to->viewdisplayitem/displayed page
    */
    public function markdisplayedDisplayItem($diID){

        $this->store_model->markdisplayedDisplayItem($diID);
        $_SESSION['displayitem_displayed'] = 'displayitem_displayed';
        return redirect()->to(site_url('displayitem/viewdisplayitem/displayed'));

    }


    /**
        * @method marksoldDisplayItem() is use to route the update of display item to the model
        * @param diID encypted data of display_item_id
        * @var session->displayitem_displayed the msg display on the Interface
        * @return to->viewdisplayitem/sold page
    */
    public function marksoldDisplayItem($diID){

        $this->store_model->marksoldDisplayItem($diID);
        $_SESSION['displayitem_sold'] = 'displayitem_sold';
        return redirect()->to(site_url('displayitem/viewdisplayitem/sold'));

    }

    /**
        ----------------------------------------------------------
        End of Display Module area
        ----------------------------------------------------------
    */


}