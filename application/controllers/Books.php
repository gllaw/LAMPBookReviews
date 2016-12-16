<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Books extends CI_Controller{
	function index(){
		$this->load->view('addBookReview');
	}
	function add(){
		$this->load->model('Author');
		$authorArray = $this->Author->insertAuthorInfo($this->input->post());

		$this->load->model('Book');
		$bookArray = $this->Book->insertBookInfo($this->input->post());

		$this->load->model('Review');
		$reviewArray = $this->Review->insertReviewInfo($this->input->post());

		//insert into one table, join table, insert into next table, join etc...

		
	}
//--------------------------------------------------------------------------------
}
?>