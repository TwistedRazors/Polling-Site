<!-- Austin Cultra -->
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
  // if the del value from admin page is set
	if( isset($_GET['del']) )
	{
		$qid = $_GET['del']; // questionid = del value from admin page
		$SQLstring= "DELETE FROM poll WHERE questionid=$qid"; // delete tuple corresponding to that question id
		$result = mysqli_query($conn, $SQLstring) or die(mysqli_error($conn)); // query SQL string
		echo "<meta http-equiv='refresh' content='0;url=admin.php'>"; // refresh admin page with question deleted
	}

  mysqli_close($conn); // close connection
?>
