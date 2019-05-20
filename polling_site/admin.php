<!-- Austin Cultra -->
<html>
<title>Admin Page</title>
<head>
  <link rel="stylesheet" href="style.css"> <!-- bring in css stylesheet -->
  <input type="button" onclick="window.location.href='http://localhost/project2/homepage.php';" id="homepage" value="Home Page" />
  <input type="button" onclick="window.location.href='http://localhost/project2/addpoll.php';" id="addpoll" value="Add Poll" />
  <input type="button" onclick="window.location.href='http://localhost/project2/viewpolls.php';" id="viewpolls" value="View Polls" />
</head>
<h1>Delete Poll</h1>
<body>

</body>
</html>
<?php
error_reporting(E_ERROR | E_PARSE); // removes errors if there are any
$databaseName = 'project2';
$databaseUser = 'root';
$databasePassword = '';
$databaseHost = '127.0.0.1';

$conn = new mysqli($databaseHost, $databaseUser, $databasePassword, $databaseName); // connect to database
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

    mysqli_select_db($conn, "project2"); // select database
    $SQLstring = "SELECT questionid, question FROM poll"; // Selects all question ids and questions

    $result = mysqli_query($conn, $SQLstring) or die(mysqli_error()); // query SQL string

    echo "<table width='100%' border='1'>\n"; // create table
echo "<tr><th>ID</th><th>Question</th><th>Delete Poll?</th>\n"; // table headers

// while there is a tuple in the database
while(($Value = mysqli_fetch_row($result))!= FALSE)
{
  echo "<tr><td align='center'>{$Value[0]}</td>"; // fill ID with question ids
  echo "<td align='center'><a href='voteonpoll.php?qid={$Value[0]}'>{$Value[1]}</td>"; // make a link to vote on a question
  echo "<td align='center'><a href='delete.php?del={$Value[0]}'>Delete</td>"; // make a link to delete a question

}
    mysqli_close($conn); // close connection
?>
