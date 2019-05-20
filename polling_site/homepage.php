<!-- Austin Cultra -->
<html>
<title>Home</title>
<head>
  <link rel="stylesheet" href="style.css"> <!-- bring in css stylesheet -->
  <input type="button" onclick="window.location.href='http://localhost/project2/addpoll.php';" id="addpoll" value="Add Poll" />
  <input type="button" onclick="window.location.href='http://localhost/project2/viewpolls.php';" id="viewpolls" value="View Polls" />
</head>
<h1>Home Page</h1>
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
    $SQLstring = "SELECT questionid, question, (avotes + bvotes + cvotes + dvotes + evotes + fvotes) FROM poll
    ORDER BY (avotes + bvotes + cvotes + dvotes + evotes + fvotes) DESC LIMIT 10"; // select top 10 most voted on polls (top is most voted on)
    $result = mysqli_query($conn, $SQLstring) or die(mysqli_error()); // query SQL string


    echo "<h2>Top 10 Most Voted Polls</h2>";
        echo "<table width='100%' border='1'>\n"; // create table
    echo "<tr><th>Question</th><th>Total Votes</th>\n"; // table headers

    // while there is a tuple in the database
    while(($Value = mysqli_fetch_row($result))!= FALSE)
    {
      echo "<tr><td align='center'><a href='voteonpoll.php?qid={$Value[0]}'>{$Value[1]}</td>"; // make a link to vote on a question
      echo "<td align='center'>{$Value[2]}</td>"; // total number of votes on each poll
    }
    mysqli_close($conn); // close connection
?>
