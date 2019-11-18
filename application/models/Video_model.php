<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


class Video_model extends CI_Model
{
    function ListingCount($searchText = '', $tblName){
        $this->db->select('BaseTbl.id, BaseTbl.user_id, BaseTbl.institut_id, BaseTbl.name, User.name, Institute.inst_name, BaseTbl.category, BaseTbl.subject, BaseTbl.url, BaseTbl.status, BaseTbl.created_at, BaseTbl.updated_at');
        $this->db->from($tblName.' as BaseTbl');
        $this->db->join('tbl_users as User', 'User.userId = BaseTbl.user_id','left');
        $this->db->join('tbl_institute as Institute', 'Institute.id = BaseTbl.institut_id','left');
        if(!empty($searchText)) {
            $likeCriteria = "(
                            BaseTbl.subject  LIKE '%".$searchText."%'
                            BaseTbl.category  LIKE '%".$searchText."%'
                            OR  BaseTbl.name  LIKE '%".$searchText."%'
                            OR  User.name  LIKE '%".$searchText."%'
                            OR  Institute.inst_name LIKE '%".$searchText."%'
                            )";
            $this->db->where($likeCriteria);
        }
        $query = $this->db->get();
        return $query->num_rows();
    }

    function caListing($searchText = ''){
        $this->db->select('BaseTbl.id, BaseTbl.user_id, BaseTbl.institut_id, BaseTbl.name, User.name as UserName, Institute.inst_name as InstituteName, BaseTbl.category, BaseTbl.subject, BaseTbl.url, BaseTbl.status, BaseTbl.created_at, BaseTbl.updated_at');
        $this->db->from('videos as BaseTbl');
        $this->db->join('tbl_users as User', 'User.userId = BaseTbl.user_id','left');
        $this->db->join('tbl_institute as Institute', 'Institute.id = BaseTbl.institut_id','left');
        if(!empty($searchText)) {
            $likeCriteria = "(
                            BaseTbl.subject  LIKE '%".$searchText."%'
                            BaseTbl.category  LIKE '%".$searchText."%'
                            OR  BaseTbl.name  LIKE '%".$searchText."%'
                            OR  User.name  LIKE '%".$searchText."%'
                            OR  Institute.inst_name LIKE '%".$searchText."%'
                            )";
            $this->db->where($likeCriteria);
        }
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }

    function addInfo($tblName, $Info){
        $this->db->trans_start();
        $this->db->insert($tblName, $Info);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }

    function editInfo($tblName, $infoId, $Info){
        $this->db->where('id', $infoId);
        $this->db->update($tblName, $Info);

        return $this->db->affected_rows();
        // return TRUE;
    }

    function getSmInfoById($Id){
        $this->db->select('BaseTbl.*, User.name as Uname, Institute.inst_name');
        $this->db->from('current_affairs as BaseTbl');
        $this->db->join('tbl_users as User', 'User.userId = BaseTbl.user_id','left');
        $this->db->join('tbl_institute as Institute', 'Institute.id = BaseTbl.institut_id','left');
        $this->db->where('BaseTbl.id', $Id);
        $query = $this->db->get();
        
        return $query->row();
    }

    function getAllInstUsers(){
        $this->db->select('userId, name');
        $this->db->from('tbl_users');
        $this->db->where('roleId !=', 3);
        $query = $this->db->get();
        
        return $query->result();
    }

    function getAllInstitutes(){
        $this->db->select('id, inst_name');
        $this->db->from('tbl_institute');
        // $this->db->where('status', 1);
        $query = $this->db->get();
        
        return $query->result();
    }
}