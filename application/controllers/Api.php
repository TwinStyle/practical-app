<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

 public function __construct()
 {
  parent::__construct();
  $this->load->model('api_model');
  $this->load->library('form_validation');
 }

 function index()
 {
  $data = $this->api_model->fetch_all();
  echo json_encode($data->result_array());
 }
 
 function insert()
 {
  $this->form_validation->set_rules("name", "First Name", "required");
  $this->form_validation->set_rules("email", "Your Email", "required");
  $array = array();
  if($this->form_validation->run())
  {
   $data = array(
    'name' => trim($this->input->post('name')),
    'email'  => trim($this->input->post('email'))
   );
   $this->api_model->insert_api($data);
   $array = array(
    'success'  => true
   );
  }
  else
  {
   $array = array(
    'error'    => true,
    'name_error' => form_error('name'),
    'email_error' => form_error('email')
   );
  }
  echo json_encode($array, true);
 }

 function fetch_single()
 {
  if($this->input->post('id'))
  {
   $data = $this->api_model->fetch_single_user($this->input->post('id'));
   foreach($data as $row)
   {
    $output['name'] = $row["name"];
    $output['email'] = $row["email"];
   }
   echo json_encode($output);
  }
 }

 function update()
 {
  $this->form_validation->set_rules("name", "First Name", "required");
  $this->form_validation->set_rules("email", "your email", "required");
  $array = array();
  if($this->form_validation->run())
  {
   $data = array(
    'name' => trim($this->input->post('name')),
    'email'  => trim($this->input->post('email'))
   );
   $this->api_model->update_api($this->input->post('id'), $data);
   $array = array(
    'success'  => true
   );
  }
  else
  {
   $array = array(
    'error'    => true,
    'name_error' => form_error('name'),
    'email_error' => form_error('email')
   );
  }
  echo json_encode($array, true);
 }

 function delete()
 {
  if($this->input->post('id'))
  {
   if($this->api_model->delete_single_user($this->input->post('id')))
   {
    $array = array(
     'success' => true
    );
   }
   else
   {
    $array = array(
     'error' => true
    );
   }
   echo json_encode($array);
  }
 }
 
}