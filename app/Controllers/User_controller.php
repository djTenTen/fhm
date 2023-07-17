<?php 
namespace App\Controllers;
use CodeIgniter\API\ResponseTrait;
class User_controller extends BaseController{
    /** 
        All Display function has user validation of authentication
        if the user rejected/ejected it will return on the login page.
        It checks if user has session and authenticated
    */


    /**
        Properties being used on this file
        * @property user_model to load the user model
        * @property request for the post function method
    */
    protected $warehouse_model;
    protected $user_model;
    protected $request;


    /**
        * @method __construct()is being executed automatically when this file is loaded
        * load all the methods/object to the properties of this class
    */
    public function __construct(){
        \Config\Services::session();
        $this->warehouse_model = new \App\Models\Warehouse_model;
        $this->user_model = new \App\Models\User_model;
        $this->request = \Config\Services::Request();
        helper(['form', 'url']);

    }


    


    /**
        ----------------------------------------------------------
        User Management Module area
        ----------------------------------------------------------
        * @method usermanagement() use to display the users page
        * @var data->ausr contains the active user information
        * @var data->iusr contains the inactive user information
        * @var data->grp contains the group user information
        * @var data->prntmodule contains the parent module group information
        * being displayed on the sales page
        * @var page is the name of the php file
        * @var data->title displays the title on the Tab browser
    */
    public function usermanagement(){

        $page = 'usermanagement';
        $data['title'] = 'User Management';
        $data['ausr'] = $this->user_model->viewaActiveUser();
        $data['iusr'] = $this->user_model->viewaInactiveUser();
        $data['grp'] = $this->user_model->getGroupUser();
        $data['prntmodule'] = $this->user_model->getParentModule();
        
        echo view('includes/header', $data);
        echo view('users/'.$page, $data);
        echo view('includes/footer');

    }


    /**
        * @method registerUser() is use to route the registration of user to the model
        * @var session->user_registered the msg display on the Interface
        * @return to->usermanagement page
    */
    public function registerUser(){

        //$this->user_model->registerUser();
        $_SESSION['user_registered'] = 'user_registered';
        return redirect()->to(site_url('user/usermanagement'));

    }


    /**
        * @method updateUser() is use to route the update of user to the model
        * @param uID encypted data of user_id
        * @var session->user_updated the msg display on the Interface
        * @return to->usermanagement page
    */
    public function updateUser($uID){

        //$this->user_model->updateUser($uID);
        $_SESSION['user_updated'] = 'user_updated';
        return redirect()->to(site_url('user/usermanagement'));

    }


    /**
        * @method deleteUser() is use to route the update of user to the model
        * @param uID encypted data of user_id
        * @var session->user_deleted the msg display on the Interface
        * @return to->usermanagement page
    */
    public function deleteUser($uID){

        //$this->user_model->deleteUser($uID);
        $_SESSION['user_deleted'] = 'user_deleted';
        return redirect()->to(site_url('user/usermanagement'));

    }
    /**
        ----------------------------------------------------------
        End User Management Module area
        ----------------------------------------------------------
    */








    



    /**
        ----------------------------------------------------------
        Group User Management Module area
        ----------------------------------------------------------    
        * @method addGroup() is use to route the registration of user group to the model
        * @var session->group_added the msg display on the Interface
        * @return to->usermanagement page
    */
    public function addGroup(){
       
        $this->user_model->addGroup();
        $_SESSION['group_added'] = 'group_added';
        return redirect()->to(site_url('user/usermanagement'));

    }


    /**
        * @method updateGroup() is use to route the update of user group to the model
        * @param gID encypted data of user_id
        * @var session->group_updated the msg display on the Interface
        * @return to->usermanagement page
    */
    public function updateGroup($gID){

        $this->user_model->updateGroup($gID);
        $_SESSION['group_updated'] = 'group_updated';
        return redirect()->to(site_url('user/usermanagement'));

    }
    /**
        ----------------------------------------------------------
        End Group User Management Module area
        ----------------------------------------------------------
    */














    /**
        ----------------------------------------------------------
        Employee Management Module area
        ----------------------------------------------------------
        * @method addEmployee() use to display the adding page of employeee
        * @var data->warehouse contains the warehouse information
        * @var data->agency contains agency information
        * @var data->grp contains group user information
        * @var data->prntmodule contains user module information
        * being displayed on the sales page
        * @var page is the name of the php file
        * @var data->title displays the title on the Tab browser
    */
    public function addEmployee(){

        $page = 'addemployee';
        $data['title'] = 'Employee Management';

        $data['warehouse'] = $this->warehouse_model->getActiveWarehouse();
        $data['agency'] = $this->user_model->getAgency();
        $data['grp'] = $this->user_model->getGroupUser();
        $data['prntmodule'] = $this->user_model->getParentModule();
        
        echo view('includes/header', $data);
        echo view('users/'.$page, $data);
        echo view('includes/footer');
    
    }


    /**
        * @method viewEmployee() use to display the employee page
        * @param stats contains data submitted which employee should be displayed
        * @var data->state contains the sales information
        * @var data->employee contains the employee information
        * @var data->warehouse contains the warehouse information
        * @var data->agency contains agency information
        * @var data->grp contains group user information
        * being displayed on the sales page
        * @var page is the name of the php file
        * @var data->title displays the title on the Tab browser
    */
    public function viewEmployee($state){

        $page = 'employees';
        $data['title'] = 'Employee Management';

        $data['state'] = ucfirst($state);

        $data['employee'] = $this->user_model->getEmployeesInfo($state);
        $data['warehouse'] = $this->warehouse_model->getActiveWarehouse();
        $data['agency'] = $this->user_model->getAgency();
        $data['grp'] = $this->user_model->getGroupUser();
        
        echo view('includes/header', $data);
        echo view('users/'.$page, $data);
        echo view('includes/footer');

    }


    /**
        * @method group() use to display the user group page
        * @var data->grp contains group user information
        * @var data->prntmodule contains user module information
        * being displayed on the sales page
        * @var page is the name of the php file
        * @var data->title displays the title on the Tab browser
    */
    public function group(){

        $page = 'usergroup';
        $data['title'] = 'Employee Group Management';

        $data['grp'] = $this->user_model->getGroupUser();
        $data['prntmodule'] = $this->user_model->getParentModule();
        
        echo view('includes/header', $data);
        echo view('users/'.$page, $data);
        echo view('includes/footer');

    }


    /**
        * @method myProfile() use to display the user profile page
        * @var data->pf contains employee user information
        * @var data->grp contains group user information
        * @var data->prntmodule contains user module information
        * being displayed on the sales page
        * @var page is the name of the php file
        * @var data->title displays the title on the Tab browser
    */
    public function myProfile(){

        $page = 'myprofile';
        $data['title'] = 'My Profile';

        $data['pf'] = $this->user_model->getmyInfo();
        $data['grp'] = $this->user_model->getGroupUser();
        $data['prntmodule'] = $this->user_model->getParentModule();
        
        echo view('includes/header', $data);
        echo view('users/'.$page, $data);
        echo view('includes/footer');

    }


    /**
        * @method saveEmployee() is use to route the registration of employee information to the model
        * @var session->employee_added the msg display on the Interface
        * @return to->addemployee page
    */
    public function saveEmployee(){

        //$this->user_model->saveEmployee();
        $_SESSION['employee_added'] = 'employee_added';
        return redirect()->to(site_url('employee/addemployee'));

    }


    /**
        * @method updateEmployee() is use to route the update of employee information to the model
        * @param uID encrypted data of user_id
        * @var session->employee_updated the msg display on the Interface
        * @return to->viewemployee/all page
    */
    public function updateEmployee($uID){

        //$this->user_model->updateEmployee($uID);
        $_SESSION['employee_updated'] = 'employee_updated';
        return redirect()->to(site_url('employee/view/all'));

    }

    /**
        * @method updatemyProfile() is use to route the update of employee information to the model
        * @var session->myproflie_updated the msg display on the Interface
        * @return to->myprofile page
    */
    public function updatemyProfile(){

        $this->user_model->updatemyProfile();
        $_SESSION['myproflie_updated'] = 'myproflie_updated';
        return redirect()->to(site_url('employee/myprofile'));

    }
    /**
        ----------------------------------------------------------
        End of Employee Module area
        ----------------------------------------------------------
    */
    

    

    







}