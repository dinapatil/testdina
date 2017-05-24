<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
   

    function addUser($data){
        try {
           // print_r($data);
            $this->db->insert('user', $data);
			$query = $this->db->last_query();
            return $this->db->insert_id();
        } catch (Exception $ex) {
            log_message('error', $ex->getMessage());
            return $ex->getMessage();
        }
    }
    
    
    function getUsersList($searchString, $limit, $endLimit){
         try {
			
            $this->db->select('id, name, email_id, details ');
            $this->db->from('user');
             if (!empty($searchString)) {
                $this->db->where("name like '%$searchString%' or email_id like '%$searchString%' ");
            }
            $this->db->order_by('id', 'desc');
             $this->db->limit($endLimit, $limit);
            $query = $this->db->get();
            
           // echo $this->db->last_query();
            if (($query)) {
                return $query->result_array();
            } else {
                throw new Exception("user table failed");
            }
        } catch (Exception $ex) {
            log_message('error', $ex->getMessage());
            return $ex->getMessage();
        }
    }
    function getUserTotalCount($searchString){
         try {
            $this->db->select('count(id) as count ');
            $this->db->from('user');
             if (!empty($searchString)) {
                $this->db->where("name like '%$searchString%' or email_id like '%$searchString%' ");
            }
            $query = $this->db->get();
            
            echo $this->db->last_query();die;
            if (($query)) {
               $result = $query->row_array();
                return $result['count'];
            } else {
                throw new Exception("user table failed");
            }
        } catch (Exception $ex) {
            log_message('error', $ex->getMessage());
            return $ex->getMessage();
        }
    }
    
    function userDelete($userId) {
		try {
			  $this->db->where('id', $userId);
			  $query = $this->db->delete('user'); 
			  return $query;
      
		} catch (Exception $ex) {
            log_message('error', $ex->getMessage());
            return $ex->getMessage();
        }
	}
    
    function allUsersData($searchString) {
	
	try {
			
            $this->db->select('id, name, email_id, details ');
            $this->db->from('user');
             if (!empty($searchString)) {
                $this->db->where("name like '%$searchString%' or email_id like '%$searchString%' ");
            }
            $this->db->order_by('id', 'desc');
         //    $this->db->limit($endLimit, $limit);
            $query = $this->db->get();
            
           // echo $this->db->last_query();
            if (($query)) {
                return $query->result_array();
            } else {
                throw new Exception("user table failed");
            }
        } catch (Exception $ex) {
            log_message('error', $ex->getMessage());
            return $ex->getMessage();
        }
        
	}

}
