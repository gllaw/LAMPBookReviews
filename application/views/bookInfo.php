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
	*{
		margin: 0;
		padding: 0;
	}
	#container{
		padding-left: 3%;
	}
	#eachrev{
		border-top: 2px solid black;
	}
	#navlinks{
		width:100%;
		padding-left: 90%;
		display: inline;
		text-align: top;
	}
	#revside{
		display: inline-block;
		width: 60%;
	}
	#addside{
		display: inline-block;
		width: 34%;
		margin-left: 3%;
		text-align: center;
	}
</style>
<body>

	<!-- // $results = array();
	// $results[] = array("title" => "A Title", "authName" => "Author Name", "reviews" => array(array("id" => 1), array("id" => 2)));
	// var_dump($results);
	// die(); -->
<div id="container">
	<div id="navlinks">
		<a href="/booksHome">Home</a>
		<a href="/logout">Logout</a>
	</div>
	<h1><?= $bookArray['title'] ?></h1>
	<p>Author: <?= $bookArray['authName'] ?></p>
	<div id="revside">
		<h2>Reviews:</h2>
		<?= $this->session->flashdata('revDeleted'); ?>
<?php
			foreach($allReviewsArray as $review){
?>
			<div id="eachrev">
				Rating: <?= $review['rating'] ?><br>
				<a href="/userRev/<?= $review['userID'] ?>">OK SO THERE'S NO REVIEWER ID IN THIS ARRAY. Backtrace and find out what IS in here, and see if you can tack in the user table and the ID. Remember that these methods (for submitting book rev) is found on 2 pages so it'll affect things for both. <?= $review['name'] ?></a> says: <?= $review['revtext'] ?><br>
				Posted on <?= $review['created_at'] ?>
				<p><a href="/Main/deleteReview/<?= $review['id'] ?>">Delete this Review</a></p>
			</div>
<?php
			}
?>
	</div>
	<div id="addside">
		<h2>Add a Review</h2>
		<form id="review" action="/Main/addBookReview" method="post">
			<textarea form="review" name="revtext" rows="10" cols="50"></textarea>
			<p>Rating
	    	<select name="rating">
	    		<option value="1">1</option>
	    		<option value="2">2</option>
	    		<option value="3">3</option>
	    		<option value="4">4</option>
	    		<option value="5">5</option>
	    	</select> stars.</p>
	    	<input type="hidden" name="title" value="<?= $bookArray['title'] ?>">
	    	<input type="hidden" name="name" value="<?= $bookArray['authName'] ?>">
	    	<p><input type="submit" value="Add Book and Review"></p>
	    </form>
	</div>
</div>
</body>
</html>