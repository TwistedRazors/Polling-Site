<!-- Austin Cultra -->
<html>
<title>Vote</title>
<head>
  <link rel="stylesheet" href="style.css"> <!-- bring in css stylesheet -->
  <input type="button" onclick="window.location.href='http://localhost/project2/homepage.php';" id="homepage" value="Home Page" />
  <input type="button" onclick="window.location.href='http://localhost/project2/addpoll.php';" id="addpoll" value="Add Poll" />
  <input type="button" onclick="window.location.href='http://localhost/project2/viewpolls.php';" id="viewpolls" value="View Polls" />
</head>
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

    mysqli_select_db($conn, "project2"); // select datbase
    $qid = $_GET['qid']; // get questionid based on which poll is selected by user
    $question = "SELECT question FROM poll WHERE questionid=$qid"; // selects question that corresponds assigned questionid
    $SQLstring = "SELECT choicea, choiceb, choicec, choiced, choicee, choicef FROM poll WHERE questionid=$qid"; // selects answer choices on that poll
    $SQLstring1 = "UPDATE poll SET avotes = avotes + 1 WHERE questionid=$qid";// will increment votes for choicea if chosen
    $SQLstring2 = "UPDATE poll SET bvotes = bvotes + 1 WHERE questionid=$qid";// will increment votes for choiceb if chosen
    $SQLstring3 = "UPDATE poll SET cvotes = cvotes + 1 WHERE questionid=$qid";// will increment votes for choicec if chosen
    $SQLstring4 = "UPDATE poll SET dvotes = dvotes + 1 WHERE questionid=$qid";// will increment votes for choiced if chosen
    $SQLstring5 = "UPDATE poll SET evotes = evotes + 1 WHERE questionid=$qid";// will increment votes for choicee if chosen
    $SQLstring6 = "UPDATE poll SET fvotes = fvotes + 1 WHERE questionid=$qid";// will increment votes for choicef if chosen

    $result1 = mysqli_query($conn, $SQLstring) or die(mysqli_error($conn)); // query SQL string
    $QueryResult2 =  @mysqli_query($conn, $question); // query question query

    // inserts results from queries into array based on the tuple they are in
    $Value = mysqli_fetch_row($result1);
    $Value2 = mysqli_fetch_row($QueryResult2);


    echo "<h1>{$Value2[0]}</h1>"; // header is question

    //loops through number of possible answer choices
    for ($i = 0; $i < 6; $i++)
    {
      // if there is an answer choice, radio button with that choice is created
      if (!empty($Value[$i])) {
        echo "<form method='post' action=''>
              <input type='radio' name='answer' value='{$Value[$i]}'> {$Value[$i]}
              <br>
              <br>";
      }

    }
    echo "<input type='submit' name='vote' value='Vote'>";
    $answer = $_POST['answer']; // assign value based on user's vote

    // query SQL string to increment vote based on which choice was picked by user; then redirects user to displayresults page
    if ($answer === $Value[0]) {
      $result2 = mysqli_query($conn, $SQLstring1) or die(mysqli_error($conn));
      echo "<script> location.href='http://localhost/project2/displayresults.php?qid=$qid'; </script>";
    }
    elseif ($answer === $Value[1]) {
      $result3 = mysqli_query($conn, $SQLstring2) or die(mysqli_error($conn));
      echo "<script> location.href='http://localhost/project2/displayresults.php?qid=$qid'; </script>";
    }
    elseif ($answer === $Value[2]) {
      $result4 = mysqli_query($conn, $SQLstring3) or die(mysqli_error($conn));
      echo "<script> location.href='http://localhost/project2/displayresults.php?qid=$qid'; </script>";
    }
    elseif ($answer === $Value[3]) {
      $result5 = mysqli_query($conn, $SQLstring4) or die(mysqli_error($conn));
      echo "<script> location.href='http://localhost/project2/displayresults.php?qid=$qid'; </script>";
    }
    elseif ($answer === $Value[4]) {
      $result6 = mysqli_query($conn, $SQLstring5) or die(mysqli_error($conn));
      echo "<script> location.href='http://localhost/project2/displayresults.php?qid=$qid'; </script>";
    }
    elseif ($answer === $Value[5]) {
      $result7 = mysqli_query($conn, $SQLstring6) or die(mysqli_error($conn));
      echo "<script> location.href='http://localhost/project2/displayresults.php?qid=$qid'; </script>";
    }
    mysqli_close($conn); // close connection
?>
