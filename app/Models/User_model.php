<?php
namespace App\Models;
use CodeIgniter\Model;
class User_model extends  Model {
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
    protected $tblwh = "tbl_warehouse";
    protected $tblug = "tbl_user_group";
    protected $tblm = "tbl_module";
    protected $tblacl = "tbl_access_control_list";
    protected $tbla = "tbl_agency";
    
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
        User Module area
        ---------------------------------------------------

        * @method getadder() use to get the admin information based on id
        * @param uID decrypted data of user_id
        * @return users->as->single_result
    */
    public function getadder($uID){
        
        $res = $this->db->query("select name 
        from ".$this->tblu."
        where user_id = '$uID'");
        return $res->getRowArray();

    }


    /**
        * @method viewaActiveUser() use to get the active user information 
        * @return users->as->multiple_result
    */
    public function viewaActiveUser(){

        $res = $this->db->query("select tu.user_id, tu.user_group_id, tu.username, tu.name as nameuser, tu.status as tustatus, tug.name as groupname, tu.added_by as added
        from ".$this->tblu." as tu, ".$this->tblug." as tug
        where tu.user_group_id = tug.user_group_id
        and user_id != 2
        and isdeleted != 1
        and tu.status = 'active'");
        return $res->getResultArray();

    }


    /**
        * @method viewaInactiveUser() use to get the inactive user information 
        * @return users->as->multiple_result
    */
    public function viewaInactiveUser(){

        $res = $this->db->query("select tu.user_id, tu.user_group_id, tu.username, tu.name as nameuser, tu.status as tustatus, tug.name as groupname, tu.added_by as added
        from ".$this->tblu." as tu, ".$this->tblug." as tug
        where tu.user_group_id = tug.user_group_id
        and user_id != 2
        and isdeleted != 1
        and tu.status = 'inactive'");
        return $res->getResultArray();

    }


    /**
        * @method registerUser() use to register the user information 
        * @var data data container of user information
        * @return sql_execution bool
    */
    public function registerUser(){
       
        $data = array(
            'user_group_id' => $this->encrypter->decrypt($this->request->getPost('user-account-type')),
            'username' => $this->request->getPost('username'),
            'password' => $this->encrypter->encrypt($this->request->getPost('password')), 
            'name' => ucfirst($this->request->getPost('name')),
            'status' => 'active',
            'added_by' => $this->encrypter->decrypt($_SESSION['userID']),
            'added_on' => $this->date.' '.$this->time
        );

        $builder = $this->db->table($this->tblu);
        $builder->insert($data);
 
    }


    /**
        * @method updateUser() use to update the user information based on id
        * @param uID encrypted data of user_id
        * @var uid decrypted data of user_id
        * @var data->true data container of user information without password
        * @var data->false data container of user information with password
        * @return sql_execution bool
    */
    public function updateUser($uID){

        $uid = $this->encrypter->decrypt(str_ireplace(['~','$'],['/','+'],$uID));
    
        if(empty($this->request->getPost('password')) or  $this->request->getPost('password') == '' or  $this->request->getPost('password') == null){

            $data = array(
                'user_group_id' => $this->encrypter->decrypt($this->request->getPost('user-account-type')),
                'name' => ucfirst($this->request->getPost('name')),
                'status' => $this->request->getPost('status'),
                'updated_by' => $this->encrypter->decrypt($_SESSION['userID']),
                'updated_on' => $this->date.' '.$this->time
            );

        }else{

            $data = array(
                'user_group_id' => $this->encrypter->decrypt($this->request->getPost('user-account-type')),
                'password' => $this->encrypter->encrypt($this->request->getPost('password')),
                'name' => ucfirst($this->request->getPost('name')),
                'status' => $this->request->getPost('status'),
                'updated_by' => $this->encrypter->decrypt($_SESSION['userID']),
                'updated_on' => $this->date.' '.$this->time
            );

        }

        $builder = $this->db->table($this->tblu);
        $builder->where('user_id', $uid);
        $builder->update($data);

    }


    /**
        * @method deleteUser() use to delete the user information based on id
        * @param uID encrypted data of user_id
        * @var uid decrypted data of user_id
        * @var data delete information of the user
        * @return sql_execution bool
    */
    public function deleteUser($uID){

        $uid = $this->encrypter->decrypt(str_ireplace(['~','$'],['/','+'],$uID));

        $data = array(
            'isdeleted' => 1, 
            'updated_by' => $this->encrypter->decrypt($_SESSION['userID']),
            'updated_on' => $this->date.' '.$this->time 
        );

        $builder = $this->db->table($this->tblu);
        $builder->where("user_id", $uid);
        $builder->update($data);

    }
    /**
        ---------------------------------------------------
        End of User Module area
        ---------------------------------------------------
    */





















    /**
        ---------------------------------------------------
        Group User Module area
        ---------------------------------------------------
        * @method getGroupUser() use to get the group user information 
        * @return group->as->multiple_result
    */
    public function getGroupUser(){

        $res = $this->db->query("select * from ".$this->tblug." where user_group_id != 2");
        return $res->getResultArray();

    }


    /**
        * @method countModuleGroup() use to count the module group user information based on id 
        * @param gID decrypted data of group id
        * @return group->as->single_result
    */
    public function countModuleGroup($gID){

        $res = $this->db->query("select count(module_id) as countgroup from ".$this->tblacl." where user_group_id = $gID");
        return $res->getRowArray();

    }


    /**
        * @method getParentModule() use to get the Parent Module user information
        * @return module->as->multiple_result
    */
    public function getParentModule(){

        $res = $this->db->query("select * from ".$this->tblm." where parent = 0");
        return $res->getResultArray();

    }


    /**
        * @method getChildModule() use to get the child Module user information based on parent module
        * @return module->as->multiple_result
    */
    public function getChildModule($mID){

        $res = $this->db->query("select * from ".$this->tblm." where parent = $mID");
        return $res->getResultArray();

    }


    /**
        * @method checkGroupAccess() use to validate group access of the user information based on id
        * @param gID decrypted data of user_group_id
        * @return access_control_list->as->multiple_result
    */
    public function checkGroupAccess($gID){

        $query = $this->db->query("select * from ".$this->tblacl." where user_group_id = $gID");
        return $query->getResultArray();

    }


    /**
        * @method getUserAccess() use to get the user access information based on id
        * @param gID decrypted data of user_group_id
        * @return access_control_list->as->multiple_result
    */
    public function getUserAccess($gID){

        $query = $this->db->query("select tacl.user_group_id as ugi, tacl.module_id as mi, name
        from ".$this->tblm." as tm, ".$this->tblacl." as tacl
        where tm.module_id = tacl.module_id
        and tacl.user_group_id = $gID");
        return $query->getResultArray();

    }


    /**
        * @method addGroup() use to register the group user information
        * @var data container of group information
        * @var grpID contains user_group_id
        * @var data2 container of the module information
        * @return sql_execution bool
    */
    public function addGroup(){

        $data = array(
            'name' => ucfirst($this->request->getPost('groupname')),
            'level' => $this->request->getPost('grouplevel'),
            'status' => 'active',
            'added_by' => $this->encrypter->decrypt($_SESSION['userID']),
            'added_on' => $this->date.' '.$this->time,
        );

        $builder = $this->db->table($this->tblug);
        $builder->insert($data);

        $grpID = $this->db->query("select user_group_id from ".$this->tblug." order by user_group_id desc limit 1")->getRowArray();

        foreach($_POST['module'] as $m){

            $data2 = array(
                'user_group_id' => $grpID['user_group_id'],
                'module_id' => $this->encrypter->decrypt($m)
            );

            $builder2 = $this->db->table($this->tblacl);
            $builder2->insert($data2);

        }


    }


    /**
        * @method updateGroup() use to update the group user information based on id
        * @param gID encrypted data of user_group_id
        * @var gid decrypted data of user_group_id
        * @var data container of group information
        * @var data2 container of the module information
        * @return sql_execution bool
    */
    public function updateGroup($gID){

        $gid = $this->encrypter->decrypt(str_ireplace(['~','$'],['/','+'],$gID));

        $data = array(
            'name' => ucfirst($this->request->getPost('groupname')),
            'level' => $this->request->getPost('grouplevel'),
            'updated_by' => $this->encrypter->decrypt($_SESSION['userID']), // current user/admin
            'updated_on' => $this->date.' '.$this->time,
        );

        $builder = $this->db->table($this->tblug);
        $builder->where("user_group_id", $gid);
        $builder->update($data);

        $builder2 = $this->db->table($this->tblacl);
        $builder2->where("user_group_id",$gid);
        $builder2->delete();

        foreach($_POST['module'] as $m){

            $data2 = array(
                'user_group_id' => $gid,
                'module_id' => $this->encrypter->decrypt($m)
            );

            $builder3 = $this->db->table($this->tblacl);
            $builder3->insert($data2);

        }

    }
    /**
        ---------------------------------------------------
        Group User Module area
        ---------------------------------------------------
    */
























    /**
        ---------------------------------------------------
        Employee Module area
        ---------------------------------------------------
        * @method getAgency() use to get the agency information
        * @return agency->as->multiple_result
    */
    public function getAgency(){

        $query = $this->db->query("select * 
        from ".$this->tbla." 
        where status = 'active'");

        return $query->getResultArray();

    }


    /**
        * @method getEmployeesInfo() use to get the Employees information based on status
        * @param stats status information of employees
        * @return employees->as->multiple_result
    */
    public function getEmployeesInfo($state){

        if($state == 'all'){
            $query = $this->db->query("select tu.*, tw.name as warehouse, tug.name as groupname, tu.name as nameuser, ta.name as agency 
            from ".$this->tbla." ta,".$this->tblwh." tw,".$this->tblu." tu,".$this->tblug." tug
            where tu.user_group_id = tug.user_group_id
            and tu.warehouse_id = tw.warehouse_id
            and tu.agency_id = ta.agency_id");
            return $query->getResultArray();
        }else{
            $query = $this->db->query("select tu.*, tw.name as warehouse, tug.name as groupname, tu.name as nameuser, ta.name as agency 
            from ".$this->tbla." ta,".$this->tblwh." tw,".$this->tblu." tu,".$this->tblug." tug
            where tu.user_group_id = tug.user_group_id
            and tu.warehouse_id = tw.warehouse_id
            and tu.agency_id = ta.agency_id
            and tu.status = '$state'");
            return $query->getResultArray();
        }
        
    }


    /**
        * @method getmyInfo() use to get the Employees information current user of the system
        * @param uid consist of decypted data of user_id
        * @return employees->as->single_result
    */
    public function getmyInfo(){

        $uid = $this->encrypter->decrypt($_SESSION['userID']);

        $query = $this->db->query("select tu.*, tw.name as warehouse, tug.name as groupname, tu.name as nameuser, ta.name as agency 
        from ".$this->tbla." ta,".$this->tblwh." tw,".$this->tblu." tu,".$this->tblug." tug
        where tu.user_group_id = tug.user_group_id
        and tu.warehouse_id = tw.warehouse_id
        and tu.agency_id = ta.agency_id
        and tu.user_id = $uid");
        return $query->getRowArray();

    }


    /**
        * @method saveEmployee() use to register the employee information 
        * @var data data container of employee information
        * @return sql_execution bool
    */
    public function saveEmployee(){

        $data = array(
            'user_group_id' => $this->encrypter->decrypt($this->request->getPost("account-type")),
            'username' => trim($this->request->getPost("username")),
            'password' => $this->encrypter->encrypt($this->request->getPost('password')),
            'warehouse_id' => $this->encrypter->decrypt($this->request->getPost("assigned-warehouse")),
            'agency_id' => $this->encrypter->decrypt($this->request->getPost("assigned-agency")),
            'first_name' => ucfirst($this->request->getPost("first-name")),
            'middle_name' => ucfirst($this->request->getPost("middle-name")),
            'last_name' => ucfirst($this->request->getPost("last-name")),
            'name' => ucfirst($this->request->getPost("last-name")).', '.ucfirst($this->request->getPost("first-name")).' '.ucfirst($this->request->getPost("middle-name")),
            'email' => $this->request->getPost("email"),
            'address' => ucfirst($this->request->getPost("address")),
            'birthday' => $this->request->getPost("birthday"),
            'gender' => $this->request->getPost("gender"),
            'contact_number' => $this->request->getPost("contact-number"),
            'salary' => $this->request->getPost("salary"),
            'salary_type' => $this->request->getPost("salary-type"),
            'date_hired' => $this->request->getPost("date-hired"),
            'position' => $this->request->getPost("position"),
            'sss_number' => $this->request->getPost("sss-number"),
            'philhealth_number' => $this->request->getPost("philhealth-number"),
            'pagibig_number' => $this->request->getPost("pagibig-number"),
            'brgy_clearance' => $this->request->getPost("barangay-clearance"),
            'nbi_clearance' => $this->request->getPost("nbi-clearance"),
            'emergency_contact_person' => $this->request->getPost("emergency-contact-person"),
            'emergency_contact_number' => $this->request->getPost("emergency-contact-number"),
            'emergency_contact_relation' => $this->request->getPost("emergency-contact-relation"),
            'status' => 'active',
            'added_by' => $this->encrypter->decrypt($_SESSION['userID']),
            'added_on' => $this->date.' '.$this->time
        );

        $builder = $this->db->table($this->tblu);
        $builder->insert($data);

    }



    /**
        * @method updateEmployee() use to update the employee information based on id
        * @param uID encrypted data of user_id
        * @var uid decrypted data of user_id
        * @var data->true data container of employee information without password
        * @var data->false data container of employee information with password
        * @return sql_execution bool
    */
    public function updateEmployee($uID){

        $uid = $this->encrypter->decrypt(str_ireplace(['~','$'],['/','+'],$uID));

        if(empty($this->request->getPost('password')) or  $this->request->getPost('password') == '' or  $this->request->getPost('password') == null){

            $data = array(
                'user_group_id' => $this->encrypter->decrypt($this->request->getPost("account-type")),
                'warehouse_id' => $this->encrypter->decrypt($this->request->getPost("assigned-warehouse")),
                'agency_id' => $this->encrypter->decrypt($this->request->getPost("assigned-agency")),
                'first_name' => ucfirst($this->request->getPost("first-name")),
                'middle_name' => ucfirst($this->request->getPost("middle-name")),
                'last_name' => ucfirst($this->request->getPost("last-name")),
                'name' => ucfirst($this->request->getPost("last-name")).', '.ucfirst($this->request->getPost("first-name")).' '.ucfirst($this->request->getPost("middle-name")),
                'email' => $this->request->getPost("email"),
                'address' => ucfirst($this->request->getPost("address")),
                'birthday' => $this->request->getPost("birthday"),
                'gender' => $this->request->getPost("gender"),
                'contact_number' => $this->request->getPost("contact-number"),
                'salary' => $this->request->getPost("salary"),
                'salary_type' => $this->request->getPost("salary-type"),
                'position' => $this->request->getPost("position"),
                'sss_number' => $this->request->getPost("sss-number"),
                'philhealth_number' => $this->request->getPost("philhealth-number"),
                'pagibig_number' => $this->request->getPost("pagibig-number"),
                'brgy_clearance' => $this->request->getPost("barangay-clearance"),
                'nbi_clearance' => $this->request->getPost("nbi-clearance"),
                'emergency_contact_person' => $this->request->getPost("emergency-contact-person"),
                'emergency_contact_number' => $this->request->getPost("emergency-contact-number"),
                'emergency_contact_relation' => $this->request->getPost("emergency-contact-relation"),
                'status' => $this->request->getPost('status'),
                'updated_by' => $this->encrypter->decrypt($_SESSION['userID']),
                'updated_on' => $this->date.' '.$this->time
            );

        }else{

            $data = array(
                'user_group_id' => $this->encrypter->decrypt($this->request->getPost("account-type")),
                'password' => $this->encrypter->encrypt($this->request->getPost('password')),
                'warehouse_id' => $this->encrypter->decrypt($this->request->getPost("assigned-warehouse")),
                'agency_id' => $this->encrypter->decrypt($this->request->getPost("assigned-agency")),
                'first_name' => ucfirst($this->request->getPost("first-name")),
                'middle_name' => ucfirst($this->request->getPost("middle-name")),
                'last_name' => ucfirst($this->request->getPost("last-name")),
                'name' => ucfirst($this->request->getPost("last-name")).', '.ucfirst($this->request->getPost("first-name")).' '.ucfirst($this->request->getPost("middle-name")),
                'email' => $this->request->getPost("email"),
                'address' => ucfirst($this->request->getPost("address")),
                'birthday' => $this->request->getPost("birthday"),
                'gender' => $this->request->getPost("gender"),
                'contact_number' => $this->request->getPost("contact-number"),
                'salary' => $this->request->getPost("salary"),
                'salary_type' => $this->request->getPost("salary-type"),
                'position' => $this->request->getPost("position"),
                'sss_number' => $this->request->getPost("sss-number"),
                'philhealth_number' => $this->request->getPost("philhealth-number"),
                'pagibig_number' => $this->request->getPost("pagibig-number"),
                'brgy_clearance' => $this->request->getPost("barangay-clearance"),
                'nbi_clearance' => $this->request->getPost("nbi-clearance"),
                'emergency_contact_person' => $this->request->getPost("emergency-contact-person"),
                'emergency_contact_number' => $this->request->getPost("emergency-contact-number"),
                'emergency_contact_relation' => $this->request->getPost("emergency-contact-relation"),
                'status' => $this->request->getPost('status'),
                'updated_by' => $this->encrypter->decrypt($_SESSION['userID']),
                'updated_on' => $this->date.' '.$this->time
            );

        }

        $builder = $this->db->table($this->tblu);
        $builder->where("user_id", $uid);
        $builder->update($data);


    }


    /**
        * @method updatemyProfile() use to update the employee information based on id
        * @var uid decrypted data of user_id
        * @var data->true data container of employee information without password
        * @var data->false data container of employee information with password
        * @return sql_execution bool
    */
    public function updatemyProfile(){

        $uid = $this->encrypter->decrypt($_SESSION['userID']);

        if(empty($this->request->getPost('password')) or  $this->request->getPost('password') == '' or  $this->request->getPost('password') == null){

            $data = array(
                'first_name' => ucfirst($this->request->getPost("first-name")),
                'middle_name' => ucfirst($this->request->getPost("middle-name")),
                'last_name' => ucfirst($this->request->getPost("last-name")),
                'name' => ucfirst($this->request->getPost("last-name")).', '.ucfirst($this->request->getPost("first-name")).' '.ucfirst($this->request->getPost("middle-name")),
                'email' => $this->request->getPost("email"),
                'address' => ucfirst($this->request->getPost("address")),
                'birthday' => $this->request->getPost("birthday"),
                'gender' => $this->request->getPost("gender"),
                'contact_number' => $this->request->getPost("contact-number"),
                'emergency_contact_person' => $this->request->getPost("emergency-contact-person"),
                'emergency_contact_number' => $this->request->getPost("emergency-contact-number"),
                'emergency_contact_relation' => $this->request->getPost("emergency-contact-relation"),
                'updated_by' => $this->encrypter->decrypt($_SESSION['userID']),
                'updated_on' => $this->date.' '.$this->time
            );

        }else{

            $data = array(
                'password' => $this->encrypter->encrypt($this->request->getPost('password')),
                'first_name' => ucfirst($this->request->getPost("first-name")),
                'middle_name' => ucfirst($this->request->getPost("middle-name")),
                'last_name' => ucfirst($this->request->getPost("last-name")),
                'name' => ucfirst($this->request->getPost("last-name")).', '.ucfirst($this->request->getPost("first-name")).' '.ucfirst($this->request->getPost("middle-name")),
                'email' => $this->request->getPost("email"),
                'address' => ucfirst($this->request->getPost("address")),
                'birthday' => $this->request->getPost("birthday"),
                'gender' => $this->request->getPost("gender"),
                'contact_number' => $this->request->getPost("contact-number"),
                'emergency_contact_person' => $this->request->getPost("emergency-contact-person"),
                'emergency_contact_number' => $this->request->getPost("emergency-contact-number"),
                'emergency_contact_relation' => $this->request->getPost("emergency-contact-relation"),
                'updated_by' => $this->encrypter->decrypt($_SESSION['userID']),
                'updated_on' => $this->date.' '.$this->time
            );

        }

        $builder = $this->db->table($this->tblu);
        $builder->where("user_id", $uid);
        $builder->update($data);


    }
    /**
        ---------------------------------------------------
        Employee Module area
        ---------------------------------------------------
    */


}
