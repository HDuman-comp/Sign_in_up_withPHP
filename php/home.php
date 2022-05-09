<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'phplogin';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

?>
<!DOCTYPE html>
<html>
	<head>
	<style>


  a {
    font-size: 20px;
  }

  .users-table table {
    border-collapse: collapse;
    margin: 150px 0;
    font-size: 0.9em;
    font-family: sans-serif;
    min-width: 400px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.35);

  }

  .users-table tr th {
    background-color: rgb(36, 188, 235);
    color: #ffffff;
    text-align: center;
  }

  .users-table th,
  .users-table td {
    padding: 12px 15px;
  }

  .anchor {
    display: block;
  }

  .anchor:hover {
    color: black;
  }
</style>
		<meta charset="utf-8">
		<title>Home Page</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body class="loggedin">
		<nav class="navtop" style="background-color: #3f69a8;">
			<div>
				<h1>Welcome to Homepage</h1>
				<a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
				<a href="update.php"><i class="fas fa-user-circle"></i>Update Profile</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>
		<div class="content">
			<h2>Home Page</h2>
			<div class="users-table">
			<?php
$result = mysqli_query($con,"SELECT * FROM accounts");


echo "<table border='1'  border-collapse: 'collapse'>
<tr>
<th>Username</th>
<th>password</th>
<th>email</th>
<th>phone</th>
</tr>";

while($row = mysqli_fetch_array($result))
{
echo "<tr>";
echo "<td>" . $row['username'] . "</td>";
echo "<td>" . $row['password'] . "</td>";
echo "<td>" . $row['email'] . "</td>";
echo "<td>" . $row['phone'] . "</td>";
echo "</tr>";
}
echo "</table>";

mysqli_close($con);
?>
</div>
</div>

</body>