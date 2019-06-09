<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bootgrid extends CI_Controller {
 
 public function __construct()
 {
  parent::__construct();
  $this->load->model('Bootgrid_model');
 }

 function index()
 {
  $this->load->view('modal/bootgrid');
  
 }

 function fetch_data()
 {
  $data = $this->bootgrid_model->make_query();
  $array = array();
  foreach($data as $row)
  {
   $array[] = $row;
  }
  $output = array(
   'current'  => intval($_POST["current"]),
   'rowCount'  => 10,
   'total'   => intval($this->bootgrid_model->count_all_data()),
   'rows'   => $array
  );
  echo json_encode($output);
 }

 function action()
 {
  if($this->input->post('operation'))
  {
   $data = array(
    'book_id'   => $this->input->post('id_product'),
    'book_name'  => $this->input->post('name'),
    'description'  => $this->input->post('content'),
    'price' => $this->input->post('price'),
    'img'   => $this->input->post('image_link'),
    'pub_id' => $this->input->post('pub_id'),
    'cat_id'   => $this->input->post('id_catalog')
   );
   if($this->input->post('operation') == 'Add')
   {
    $this->bootgrid_model->insert($data);
    echo 'Data Inserted';
   }
   if($this->input->post('operation') == 'Edit')
   {
    $this->bootgrid_model->update($data, $this->input->post('employee_book_id'));
    echo 'Data Updated';
   }
  }
 }

 function fetch_single_data()
 {
  if($this->input->post('id_product'))
  {
   $data = $this->bootgrid_model->fetch_single_data($this->input->post('id_product'));
   foreach($data as $row)
   {
    $output['book_id'] = $row['id_product'];
    $output['book_name'] = $row['name'];
    $output['description'] = $row['content'];
    $output['price'] = $row['price'];
    $output['img'] = $row['image_link'];
    $output['pub_id'] = $row['pub_id'];
    $output['cat_id'] = $row['id_catalog'];
   }
   echo json_encode($output);
  }
 }

 function delete_data()
 {
  if($this->input->post('id_product'))
  {
   $this->bootgrid_model->delete($this->input->post('id_product'));
   echo 'Data Deleted';
  }
 }
}

?>