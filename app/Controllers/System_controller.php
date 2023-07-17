<?php 
namespace App\Controllers;
use CodeIgniter\API\ResponseTrait;
class System_controller extends BaseController{
    /** 
        All Display function has user validation of authentication
        if the user rejected/ejected it will return on the login page.
        It checks if user has session and authenticated
    */

    /**
        Properties being used on this file
        * @property system_model to load the system model
        * @property encrypter use for encryption
    */
    protected $system_model;


    /**
        * @method __construct()is being executed automatically when this file is loaded
        * load all the methods/object to the properties of this class
    */
    public function __construct(){

        \Config\Services::session();
        $this->login_model = new \App\Models\Login_model;
        $this->system_model = new \App\Models\System_model;

    }


    /**
        * @method systemSettings() use to display the setting page of system
        * @var data->accesslogs contains the access logs of users
        * @var data->onlineusers contains data of online users
        * @var data->settings contains system settings
        * being displayed on the sales page
        * @var page is the name of the php file
        * @var data->title displays the title on the Tab browser
    */
    public function systemSettings(){

        $page = 'systemsettings';
        $data['title'] = 'System Setting';

        $data['accesslogs'] = $this->system_model->getAccessLogs();
        $data['onlineusers'] = $this->system_model->getOnlineUsers();
        $data['settings'] = $this->system_model->getsettings();
        
        echo view('includes/header', $data);
        echo view('system/'.$page, $data);
        echo view('includes/footer');

    }

    /**
        * @method ejectUser() is use to route the ejection of user to the model
        * @param uID encypted data of user_id
        * @return to->systemsettings page
    */
    public function ejectUser($sID){

        $this->system_model->ejectUser($sID);
        $_SESSION['user_eject'] = 'user_eject';
        return redirect()->to(site_url('systemsettings'));

    }

    public function udpateSystemSettings($oID){

        $this->system_model->udpateSystemSettings($oID);
        $_SESSION['system_update'] = 'system_update';
        return redirect()->to(site_url('systemsettings'));

    }















}