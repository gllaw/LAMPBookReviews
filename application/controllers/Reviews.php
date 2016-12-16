<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reviews extends CI_Controller{
	function recentReviews(){
		$reviews = $this->Review->getAllReviews();
		$this->load->view('booksHome', array("reviewsArray" => $reviews));
	}
//--------------------------------------------------------------------------------
}
?>