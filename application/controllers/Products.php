<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller{

	function __construct() {
		parent::__construct();
		$this->load->model('Product');
	}
	function index(){
		$products = $this->Product->getAllProductInfo();
		$this->load->view('allProducts', array("productArray" => $products));
	}
//--------------------------------------------------
	function loadAddProductView(){
		$this->load->view('AddNewProduct');
	}

	function actuallyAddProduct(){
		$this->load->library("form_validation");
		$this->form_validation->set_rules("price", "Price", "trim|required|numeric|greater_than[0.99]");
		if($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('addError', validation_errors());
		    redirect('/addNewProduct');
		}
		else{				
		$this->Product->addProductToDB($this->input->post());
		$this->session->set_flashdata('successfulAdd', "Successfully added product.");
		redirect('/');
		}
	}
//--------------------------------------------------
	function loadProductInfoView($id){
		$product = $this->Product->getOneProductInfo($id);
		$this->load->view('productInfo', array("productDetails" => $product));
	}
//--------------------------------------------------
	function loadEditProductView($id){
		$product = $this->Product->getOneProductInfo($id);
		$this->load->view('editProduct', array("productDetails" => $product));
	}
	function actuallyEditProduct(){
		$this->load->library("form_validation");
		$this->form_validation->set_rules("price", "Price", "trim|required|numeric|greater_than[0.99]");
		if($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('editError', validation_errors());
			$itemIDAsNum = intval($this->input->post('id'));
		    redirect("editProductInfo/$itemIDAsNum");
		}
		else{				
		$this->Product->editProductinDB($this->input->post());
		$this->session->set_flashdata('successfulEdit', "Successfully edited product.");
		redirect('/');
		}
	}
//--------------------------------------------------
	function removeProduct($id){
		$this->Product->removeProductFromDB($id);
		// var_dump($this->input->post());
		// die();	It's just an empty array wow.
		$this->session->set_flashdata('removed', 'Product removed.');
		redirect('/');
	}	
//--------------------------------------------------
}
?>