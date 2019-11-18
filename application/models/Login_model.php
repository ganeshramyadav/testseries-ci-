<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model
{
    
    function loginMe($email, $password)
    {
        // $this->db->select('BaseTbl.*');
        $this->db->select('BaseTbl.id, BaseTbl.password, BaseTbl.first_name, BaseTbl.last_name, BaseTbl.roleId, BaseTbl.created_at, Roles.role');
        $this->db->from('user as BaseTbl');
        $this->db->join('tbl_roles as Roles','Roles.roleId = BaseTbl.roleId');
        $this->db->where('BaseTbl.email', $email);
        $this->db->where('BaseTbl.isDeleted', 0);
        $query = $this->db->get();
        
        $user = $query->row();
        
        if(!empty($user)){
            if(verifyHashedPassword($password, $user->password)){
                return $user;
            } else {
                return array();
            }
        } else {
            return array();
        }
    }

    /**
     * This function used to check email exists or not
     * @param {string} $email : This is users email id
     * @return {boolean} $result : TRUE/FALSE
     */
    function checkEmailExist($email)
    {
        $this->db->select('id');
        $this->db->where('email', $email);
        $this->db->where('isDeleted', 0);
        $query = $this->db->get('user');

        if ($query->num_rows() > 0){
            return true;
        } else {
            return false;
        }
    }

    function emailExist($email){
        $this->db->select('id');
        $this->db->where('email', $email);
        $query = $this->db->get('user');
        $result = $query->num_rows();
        return $result;
    }

    function insEmailExist($email){
        $this->db->select('id');
        $this->db->where('email', $email);
        $query = $this->db->get('institute');
        $result = $query->num_rows();
        return $result;
    }


    /**
     * This function used to insert reset password data
     * @param {array} $data : This is reset password data
     * @return {boolean} $result : TRUE/FALSE
     */
    function resetPasswordUser($data)
    {
        $result = $this->db->insert('tbl_reset_password', $data);

        if($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * This function is used to get customer information by email-id for forget password email
     * @param string $email : Email id of customer
     * @return object $result : Information of customer
     */
    function getCustomerInfoByEmail($email)
    {
        $this->db->select('id, email, first_name, last_name');
        $this->db->from('user');
        $this->db->where('isDeleted', 0);
        $this->db->where('email', $email);
        $query = $this->db->get();

        return $query->row();
    }

    /**
     * This function used to check correct activation deatails for forget password.
     * @param string $email : Email id of user
     * @param string $activation_id : This is activation string
     */
    function checkActivationDetails($email, $activation_id)
    {
        $this->db->select('id');
        $this->db->from('tbl_reset_password');
        $this->db->where('email', $email);
        $this->db->where('activation_id', $activation_id);
        $query = $this->db->get();
        return $query->num_rows();
    }

    // This function used to create new password by reset link
    function createPasswordUser($email, $password)
    {
        $this->db->where('email', $email);
        $this->db->where('isDeleted', 0);
        $this->db->update('user', array('password'=>getHashedPassword($password)));
        $this->db->delete('tbl_reset_password', array('email'=>$email));
    }

    /**
     * This function used to save login information of user
     * @param array $loginInfo : This is users login information
     */
    function lastLogin($loginInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_last_login', $loginInfo);
        $this->db->trans_complete();
    }

    /**
     * This function is used to get last login info by user id
     * @param number $userId : This is user id
     * @return number $result : This is query result
     */
    function lastLoginInfo($userId)
    {
        $this->db->select('BaseTbl.createdDtm');
        $this->db->where('BaseTbl.userId', $userId);
        $this->db->order_by('BaseTbl.id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('tbl_last_login as BaseTbl');

        return $query->row();
    }

    function getGender(){
        /* $this->db->select('id, name, key');
        $this->db->from('tbl_gender');
        $query = $this->db->get();
        return $query->result(); */
    }

    function insert($tblName, $Info){
        $this->db->trans_start();
        $this->db->insert($tblName, $Info);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }

/*     function insertInstitute($insData){
        $this->db->trans_start();
        $this->db->insert('tbl_institute', $insData);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    } */

    function insertUserInstitute($userInsData){
        $this->db->trans_start();
        $this->db->insert('tbl_user_institute', $userInsData);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }

    function getUserById($userId){
        $this->db->select('BaseTbl.id, BaseTbl.password, BaseTbl.first_name, BaseTbl.last_name, BaseTbl.roleId, Roles.role');
        
        $this->db->from('user as BaseTbl');
        $this->db->join('tbl_roles as Roles','Roles.roleId = BaseTbl.roleId');
        
        $this->db->where('BaseTbl.id', $userId);
        $this->db->where('BaseTbl.isDeleted', 0);
        $query = $this->db->get();
        $user = $query->row();
        return $user;
    }
}

?>