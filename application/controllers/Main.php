<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller{
	function index(){
		$this->load->view('loginReg');		
	}
//-------------------------------------------------------------------------
	function register(){
		$this->load->library("form_validation");
		$this->form_validation->set_rules("name", "Name", "trim|required");
		$this->form_validation->set_rules("alias", "Alias", "trim|required");
		$this->form_validation->set_rules("email", "Email", "trim|required|valid_email|is_unique[user.email]");
		$this->form_validation->set_rules("password", "Password", "trim|required|min_length[8]");
		$this->form_validation->set_rules("confirmPassword", "Confirm Password", "trim|required|matches[password]");
		
		if($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('regError', validation_errors());
		    redirect('/');
		}
		else{
        	$this->load->model("User");
			$newUserID = $this->User->insertNewUser($this->input->post());		//Get user info as their DB insert ID.
			$userData = $this->User->findUser($newUserID);					//Use that ID to get all their info as an array.
			$this->session->set_userdata('currentUser', $userData);			//Put all their info in session.
			// $thisUserInfo = $this->session->userdata('currentUser');		//Set this user's info array (in session) to a handy-dandy variable that can be used to inject info into targeted spots in a view. 
			redirect('booksHome');
		}
	}
//--------------------------------------------------------------------------------
	function login(){
		$this->load->library("form_validation");
		$this->form_validation->set_rules("email", "Email", "trim|required|valid_email");
		$this->form_validation->set_rules("password", "Password", "trim|required|min_length[8]");

		if($this->form_validation->run() == FALSE){
		    $this->session->set_flashdata('loginError', validation_errors()); 
		    redirect('/');
		}
		else{
        	$this->load->model("User");
			$userInfo = $this->User->checkUserAgainstDB($this->input->post());
			$postedInfo = $this->input->post();			//setting form inputs to a variable to check against DB result below.
			if ($userInfo['password'] == $postedInfo['password']){		//compare db pw to input pw.
				$this->session->set_userdata('currentUser', $userInfo);		//give them a new session
				redirect('booksHome');
			}
			else{
		     	$this->session->set_flashdata("DNEerror", "You should register first.");
		    	redirect('/');
			}
		}
	}
//--------------------------------------------------------------------------------
	function logout(){
		session_destroy();
		redirect('/');
	}
//--------------------------------------------------------------------------------
	function loadBooksHome(){
		if(!$this->session->userData('currentUser')){		//if no session then redirect to root.
			redirect('/');
		}
		$this->load->model('BookRev');
		$allReviews = $this->BookRev->getAllBookReviews();
		$allTitles = $this->BookRev->getAllBooksWithRevs();
		$this->load->view('booksHome', array("revsArray" => $allReviews, "titlesArray"=>$allTitles));
	}
	function loadAddBookReview(){
		if(!$this->session->userData('currentUser')){
			redirect('/');
		}
		$this->load->model('BookRev');
		$allAuthors = $this->BookRev->getAllAuthors();
		$this->load->view('addBookReview', array("authsArray" => $allAuthors));
	}
	function loadBookInfo($id){
		if(!$this->session->userData('currentUser')){
			redirect('/');
		}
		$this->load->model('BookRev');
		$oneBookInfo = $this->BookRev->getOneBook($id);
		$oneBookRev = $this->BookRev->getAllRevForOneBook($id);
		$this->load->view('bookInfo', array("bookArray" => $oneBookInfo, 
			"allReviewsArray" => $oneBookRev));
	}
	function loadUserReviews($id){
		$this->load->model('BookRev');
		$oneUserInfo = $this->BookRev->getOneUser($id);
		$allUserRevs = $this->BookRev->getAllOneUserRevs($id);
		$revCountArray = $this->BookRev->countAllOneUserRevs($id);
		$this->load->view('userReviews', array("oneUserArray" => $oneUserInfo, 
			"allOneUserRevsArray"=> $allUserRevs, "reviewsCountArray" => $revCountArray));
	}
//--------------------------------------------------------------------------------
	function deleteReview($id){
		$this->load->model("BookRev");
		$this->BookRev->deleteRevFromDB($id);
		$this->session->set_flashdata('revDeleted', 'Review deleted.');
		// redirect('/bookInfo/' . $bookID);
	}
//--------------------------------------------------------------------------------
	function addBookReview(){
		// $this->load->library("form_validation");
		// $this->form_validation->set_rules("title", "Title", "trim|required|is_unique")
		// $this->form_validation->set_rules("name", "Author", "trim|required|is_unique[author.name]");
		
		// if($this->form_validation->run() == FALSE){
		// 	$this->session->set_flashdata('addRevError', validation_errors());
		//     redirect('/');
		// }
		// else{

		if(!$this->session->userData('currentUser')){		//if no session then redirect to root.
			redirect('/');
		}
		$postData = $this->input->post();
		$this->load->model("BookRev");
		$bookID = $this->BookRev->insertAllTheThings($postData);
		redirect('/bookInfo/' . $bookID);	//can't get it to redirec by $bookID, bc that was declared in model.
		// 
	}
//--------------------------------------------------------------------------------
}
?>