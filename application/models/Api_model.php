<?php
class Api_model extends CI_Model
{
 function fetch_all()
 {
  $this->db->order_by('userId', 'DESC');
  return $this->db->get('tbl_users');
 }

 function insert_api($data)
 {
  $this->db->insert('tbl_users', $data);
  if($this->db->affected_rows() > 0)
  {
   return true;
  }
  else
  {
   return false;
  }
 }

 function fetch_single_user($user_id)
 {
  $this->db->where("userId", $user_id);
  $query = $this->db->get('tbl_users');
  return $query->result_array();
 }
 function update_api($user_id, $data)
 {
  $this->db->where("userId", $user_id);
  $this->db->update("tbl_users", $data);
 }
 
 function delete_single_user($user_id)
 {
    $this->db->where("userId", $user_id);
     $this->db->delete("tbl_users");
     if($this->db->affected_rows() > 0)
     {
      return true;
     }
      else
     {
      return false;
     }
  }
}