<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Add Book and Review</title>
</head>
<style type="text/css">
	#navlinks{
		width:100%;
		padding-left: 90%;
		display: inline;
		text-align: top;
	}
</style>
<body>
	<div id="navlinks">
		<a href="/booksHome">Home</a>
		<a href="/logout">Logout</a>
	</div>
	<h1>Add a New Book Title and a Review:</h1>
	<form id="review" action="/Main/addBookReview" method="post">
		<h2>Book Title:</h2>
	    <input type="text" name="title"><br>
	    <h2>Author:</h2>
	    <h3>Choose from the list:</h3>
	    <select>
<?php
			foreach($authsArray as $author){
?>
			<option value="<?= $author['name'] ?>"><?= $author['name'] ?></option>
<?php
			}
?>
		</select>
		<h3>Or add a new author:</h3>
    	<input type="text" name="name"><br>
    	<h2>Review</h2>
    	<textarea form="review" name="revtext" cols="50" rows="10"></textarea>
    	<h2>Rating</h2>
    	<select name="rating">
    		<option value="1">1</option>
    		<option value="2">2</option>
    		<option value="3">3</option>
    		<option value="4">4</option>
    		<option value="5">5</option>
    	</select> stars.
    	<p><input type="submit" value="Add Book and Review"></p>
	</form>
</body>
</html>