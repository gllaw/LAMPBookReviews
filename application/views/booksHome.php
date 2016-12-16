<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$thisUser = $this->session->userdata('currentUser');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Books Home</title>
	<!-- <link rel="stylesheet" type="text/css" href="/assets/stylesheets/style.css"> -->
</head>
<style type="text/css">
	* {
		margin: 0;
		padding: 0;
	}
	#container{
		padding: 1em;
	}
	#header{
		width: 100%;
		height: auto;
		display: inline-block;
		vertical-align: top;
		margin-bottom: 2em;
	}
	#greeting{
		display: inline;
		text-align: top;
	}
	#navlinks{
		margin-left: 60%;
		display: inline;
		text-align: right;
		text-align: top;
	}
	#content{
		width: 100%;
		display: inline-block;
		vertical-align: top;
	}
	#recent{
		display: inline-block;
	}
	#eachRev{
		margin-top: 2em;
	}
	#other h2{
		margin-bottom: 1em;
	}
	#other{
		display: inline-block;
		vertical-align: top;
		margin-left: 40%;
	}
	#scrollbox{
		width: 25em;
		height: 8em;
		overflow: auto;
		border: 1px solid black;
		padding: 1em;
		/*text-align: justify;*/
		/*background: transparent;*/
	}
	#scrollbox p{
		margin-bottom: 1em;
	}
</style>
<body>
<div id="container">
	<div id="header">
		<h1 id="greeting">Welcome, <?= $thisUser['alias'] ?>!</h1>
		<div id="navlinks">
			<a href="/add">Add Book and Review</a>
			<a href="/logout">Logout</a>
		</div>
	</div>
	<div id="content">
		<div id="recent">
			<h2>Recent Book Reviews:</h2>
<?php
			foreach($revsArray as $review){
?>
			<div id="eachRev"
				<p><a href="/bookInfo/<?= $review['bookID'] ?>"><?= $review['title'] ?></a></p>
				<p>Rating: <?= $review['rating'] ?></p>
				<p><a href="/userRev/<?= $review['userID'] ?>"><?= $review['userName'] ?></a> says: <?= $review['revtext'] ?></p>
				<p>Posted on <?= $review['postedDate'] ?></p>
			</div>
<?php
			}
?>
		</div>
		<div id="other">
			<h2>Other Books with Reviews:</h2>
			<div id="scrollbox">
<?php
				foreach($titlesArray as $title){
?>
				<p><a href="/bookInfo/<?= $title['bookID'] ?>" title="<?= $title['title'] ?>"><?= $title['title'] ?></a></p> <!--i herd you like title in your title...-->
<?php
			}
?>
			</div>
		</div>
	</div>
</div>
</body>
</html>