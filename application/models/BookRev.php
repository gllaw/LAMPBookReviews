<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BookRev extends CI_Model{
//------------------------------SELECT METHODS----------------------------------
	function getAllBookReviews(){
		$query = "SELECT book.id AS bookID, book.title, review.rating, user.id AS userID, user.name AS userName, review.revtext, review.created_at AS postedDate
		FROM review
		LEFT JOIN user on user.id = review.user_id
		LEFT JOIN book on book.id = review.book_id
		LIMIT 3";
		return $this->db->query($query)->result_array();
	}
	function getAllBooksWithRevs(){
		$query = "SELECT book.title, book.id AS bookID FROM book
		JOIN review on review.book_id = book.id";
		return $this->db->query($query)->result_array();
	}
	function getAllAuthors(){			//for Add New author dropdown selection
		$query = "SELECT name FROM author";
		return $this->db->query($query)->result_array();
	}
	function getOneBook($bookID){
		$query = "SELECT title, author.name AS authName
		FROM book
		LEFT JOIN author on author.id = book.author_id
		WHERE book.id = ?";
		$values = array($bookID);
		return $this->db->query($query,$values)->row_array();
	}
	function getAllRevForOneBook($bookID){
		$query = "SELECT * FROM review
		LEFT JOIN book on book.id = review.book_id
		LEFT JOIN user on user.id = review.user_id
		WHERE book.id = ?";
		$values = array($bookID);
		return $this->db->query($query,$values)->result_array();
	}
	function getOneUser($userID){
		$query = "SELECT * FROM user 
		WHERE user.id = ?";
		$values = array($userID);
		return $this->db->query($query, $values)->row_array();
	}
	function getAllOneUserRevs($userID){
		$query = "SELECT book.id AS bookID, book.title FROM book
		JOIN review ON review.book_id = book.id
		JOIN user ON user.id = review.user_id
		WHERE user.id = ?";
		$values = array($userID);
		return $this->db->query($query, $values)->result_array();
	}
	function countAllOneUserRevs($userID){
		$query = "SELECT user_id, COUNT(*) AS rev_count FROM review WHERE user_id = ?";
		$values = array($userID);
		return $this->db->query($query, $values)->row_array();
	}
//----------------------------DELETE METHOD---------------------------------------
	function deleteRevFromDB($revID){
		$query = "DELETE FROM review WHERE review.id = ?";
		$values = array($revID);
		$this->db->query($query, $values);
	}
//----------------------------INSERT METHODS--------------------------------------
	function insertAllTheThings($post){
		$query = "INSERT INTO author (name, created_at, updated_at) VALUES (?, NOW(), NOW())";
        $values = array($post['name']);
		$this->db->query($query, $values);
		$authID = $this->db->insert_id();

		$query = "INSERT INTO book (title, author_id, created_at, updated_at) VALUES (?, $authID, NOW(), NOW())";
        $values = array($post['title']);
		$this->db->query($query, $values);
		$bookID = $this->db->insert_id();

		$userID = $this->session->userdata('currentUser')['id'];
		$query = "INSERT INTO review (revtext, rating, user_id, book_id, created_at, updated_at) VALUES (?, ?, $userID, $bookID, NOW(), NOW())";
        $values = array($post['revtext'], $post['rating']);

		$this->db->query($query, $values);

		// var_dump($bookID);
		// die();
		return $bookID;			//is this not sending to controller?
	}
//-------------------------------------------------------------------------
}
?>