<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>User Reviews</title>
</head>
<style type="text/css">
	#navlinks{
		width:100%;
		padding-left: 80%;
		display: inline;
		text-align: top;
	}
</style>
<body>
	<div id="navlinks">
		<a href="/booksHome">Home</a>
		<a href="/add">Add Book and Review</a>
		<a href="/logout">Logout</a>
	</div>
	<h1>User Alias: <?= $oneUserArray['alias'] ?></h1>
	<table>
		<tr>
			<td>Name: </td>
			<td><?= $oneUserArray['name'] ?></td>
		</tr>
		<tr>
			<td>Email: </td>
			<td><?= $oneUserArray['email'] ?></td>
		</tr>
		<tr>
			<td>Total Reviews: </td>
			<td><?= $reviewsCountArray['rev_count'] ?></td>
		</tr>
	</table>
	<h2>Posted Reviews on the following books:</h2>
<?php
		foreach($allOneUserRevsArray as $reviewedBook){
?>
		<p><a href="/bookInfo/<?= $reviewedBook['bookID'] ?>"><?= $reviewedBook['title'] ?></a></p>
<?php
		}
?>
</body>
</html>