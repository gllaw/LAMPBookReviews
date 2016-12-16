<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Model{
//--------------------------------------------------
	function addProductToDB($post){
		$query = "INSERT INTO products (name, description, price, created_at, updated_at) VALUES (?,?,?, NOW(), NOW())";
        $values = array($post['productName'], $post['descrip'], $post['price']); 
        $this->db->query($query, $values);
	}
//--------------------------------------------------
	function getAllProductInfo(){
		$query = "SELECT * FROM products";
		return $this->db->query($query)->result_array();
	}
//--------------------------------------------------
	function getOneProductInfo($id){
		$query = "SELECT * FROM products WHERE products.id = ?";
		$values = array($id);
		return $this->db->query($query,$values)->row_array();
	}
//--------------------------------------------------
	function editProductinDB($post){
		$query = "UPDATE products SET name=?, description=?, price=? WHERE id=?";
		$values = array($post['productName'], $post['descrip'], $post['price'], $post['id']); 
        $this->db->query($query, $values);
	}
//--------------------------------------------------
	function removeProductFromDB($id){
		$query = "DELETE FROM products WHERE products.id = ?";
		$values = array($id);
		$this->db->query($query, $values);
	}
//--------------------------------------------------
}
?>
