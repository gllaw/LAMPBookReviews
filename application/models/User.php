<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Model{
//--------------------------------------------------------------------------------
	function insertNewUser($userInfo){
		$query = "INSERT INTO user (name, alias, email, password, created_at, updated_at) VALUES (?,?,?,?, NOW(), NOW())";
        $values = array($userInfo['name'], $userInfo['alias'], $userInfo['email'], $userInfo['password']); 
        $this->db->query($query, $values);
        return $this->db->insert_id();
	}
//--------------------------------------------------------------------------------
	function findUser($userID){
		$query = "SELECT * FROM user WHERE user.id = $userID";
		return $this->db->query($query)->row_array();
	}
//--------------------------------------------------------------------------------
	function checkUserAgainstDB($userinfo){
		$query = "SELECT * FROM user WHERE user.email = '{$userinfo['email']}'";
		// $values = array($userinfo['email')];		Would need this line if you wanna replace the stuff after "=" in $query with just a "?".
		return $this->db->query($query)->row_array();
	}
//--------------------------------------------------------------------------------
}
?>