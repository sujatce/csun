<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Home Page</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
				<h1>Website Title</h1>
				<a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>
		<div class="content">
			<h2>Home Page</h2>
			<p>Hi <?=$_SESSION['name']?>!, you have logged in 5 times and Last Login date: 10/7/2021 9:00 PM</p>
			<h2>Company Confidential Information</h2>
			<p>CovidLab is committed to protecting the privacy of every person who visits the CovidLab Web site so that each person will feel free to gather information, make inquiries/comments, and/or perform bill payment functions on our site. As part of covidlab's effort to protect the privacy of your personal information while visiting the site, we created this web privacy statement to inform you of the privacy standards used to ensure the security and confidentiality of your information. </p>
			<a href="">Download Company Confidential File</a>
		</div>
	</body>
</html>