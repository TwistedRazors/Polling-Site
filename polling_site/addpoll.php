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

// assign values based on user input
$question = $_POST['question'];
$answer1 = $_POST['answer1'];
$answer2 = $_POST['answer2'];
$answer3 = $_POST['answer3'];
$answer4 = $_POST['answer4'];
$answer5 = $_POST['answer5'];
$answer6 = $_POST['answer6'];

if ($_POST){
    mysqli_select_db($conn, "project2"); // select database
    // Inserts question, answer choices, and initial number of votes, which will always be 0, into the database
    $SQLstring1 = "INSERT INTO poll(question, choicea, choiceb, choicec, choiced, choicee, choicef, avotes, bvotes, cvotes, dvotes, evotes, fvotes)
    VALUES ('$question', '$answer1', '$answer2', '$answer3', '$answer4', '$answer5', '$answer6', 0, 0, 0, 0, 0, 0)";

    $result1 = mysqli_query($conn, $SQLstring1) or die(mysqli_error($conn)); // query SQL string

    // if the SQL can be queried
    if ($result1 === TRUE) {
      echo "New record created successfully"; // data is inserted into database
    }
    else {
      echo "Error: " . $SQLstring1 . "<br>" . $conn->error;
    }
    echo "<script> location.href='http://localhost/project2/viewpolls.php'; </script>"; // redirect to viewpolls page to see your new poll inserted at the bottom
    mysqli_close($conn); // close connection
}
?>
<html>
<title>Create Poll</title>
<head>
  <link rel="stylesheet" href="style.css"> <!-- bring in css stylesheet -->
  <input type="button" onclick="window.location.href='http://localhost/project2/homepage.php';" id="homepage" value="Home Page" />
  <input type="button" onclick="window.location.href='http://localhost/project2/viewpolls.php';" id="viewpolls" value="View Polls" />
  <h1>Create a Poll</h1>

  <body>
    <form method="post" action="" autocomplete="off">
      Question: &nbsp <input type="text" name="question" minlength="1" maxlength="300" required>
      <br>
      <br>
      Answer 1: &nbsp <input type="text" name="answer1" minlength="1" maxlength="40" required>
      <br>
      <br>
      Answer 2: &nbsp <input type="text" name="answer2" minlength="1" maxlength="40" required>
      <br>
      <br>
      Answer 3 (optional): &nbsp <input type="text" name="answer3" minlength="1" maxlength="40">
      <br>
      <br>
      Answer 4 (optional): &nbsp <input type="text" name="answer4" minlength="1" maxlength="40">
      <br>
      <br>
      Answer 5 (optional): &nbsp <input type="text" name="answer5" minlength="1" maxlength="40">
      <br>
      <br>
      Answer 6 (optional): &nbsp <input type="text" name="answer6" minlength="1" maxlength="40">
      <br>
      <br>
      <input type="submit" name="add_poll" value="Create Poll">
  </body>
</head>
</html>
