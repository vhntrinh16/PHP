
<?php
class Bootgrid_model extends CI_Model
{
 var $records_per_page = 10;
 var $start_from = 0;
 var $current_page_number = 1;

 function make_query()
 {
  if(isset($_POST["rowCount"]))
  {
   $this->records_per_page = $_POST["rowCount"];
  }
  else
  {
   $this->records_per_page = 10;
  }
  if(isset($_POST["current"]))
  {
   $this->current_page_number = $_POST["current"];
  }
  $this->start_from = ($this->current_page_number - 1) * $this->records_per_page;
  $this->db->select("*");
  $this->db->from("product");
  if(!empty($_POST["searchPhrase"]))
  {
   $this->db->like('id_product', $_POST["searchPhrase"]);
   $this->db->or_like('name', $_POST["searchPhrase"]);
   $this->db->or_like('content', $_POST["searchPhrase"]);
   $this->db->or_like('price', $_POST["searchPhrase"]);
   $this->db->or_like('image_link', $_POST["searchPhrase"]);
   $this->db->or_like('pub_id', $_POST["searchPhrase"]);
   $this->db->or_like('id_catalog', $_POST["searchPhrase"]);
  }
  if(isset($_POST["sort"]) && is_array($_POST["sort"]))
  {
   foreach($_POST["sort"] as $key => $value)
   {
    $this->db->order_by($key, $value);
   }
  }
  else
  {
   $this->db->order_by('id_product', 'DESC');
  }
  if($this->records_per_page != -1)
  {
   $this->db->limit($this->records_per_page, $this->start_from);
  }
  $query = $this->db->get();
  return $query->result_array();
 }

 function count_all_data()
 {
  $this->db->select("*");
  $this->db->from("product");
  $query = $this->db->get();
  return $query->num_rows();
 }

 function insert($data)
 {
  $this->db->insert('product', $data);
 }

 function fetch_single_data($book_id)
 {
  $this->db->where('id_product', $book_id);
  $query = $this->db->get('product');
  return $query->result_array();
 }

 function update($data, $book_id)
 {
  $this->db->where('id_product', $book_id);
  $this->db->update('product', $data);
 }

 function delete($book_id)
 {
  $this->db->where('id_product', $book_id);
  $this->db->delete('product');
 }
}

?>
