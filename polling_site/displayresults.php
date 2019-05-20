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
    $qid = $_GET['qid']; // get questionid from voteonpoll page
    $totalvotes = "SELECT (avotes + bvotes + cvotes + dvotes + evotes + fvotes) FROM poll WHERE questionid=$qid"; // total number of votes for the poll
    $question = "SELECT question FROM poll WHERE questionid=$qid"; // question for the poll
    $SQLstring = "SELECT choicea, ((avotes/(avotes + bvotes + cvotes + dvotes + evotes + fvotes)) * 100) FROM poll WHERE questionid=$qid"; // percentage for choice a
    $SQLstring2 = "SELECT choiceb, ((bvotes/(avotes + bvotes + cvotes + dvotes + evotes + fvotes)) * 100) FROM poll WHERE questionid=$qid";// percentage for choice b
    $SQLstring3 = "SELECT choicec, ((cvotes/(avotes + bvotes + cvotes + dvotes + evotes + fvotes)) * 100) FROM poll WHERE questionid=$qid";// percentage for choice c
    $SQLstring4 = "SELECT choiced, ((dvotes/(avotes + bvotes + cvotes + dvotes + evotes + fvotes)) * 100) FROM poll WHERE questionid=$qid";// percentage for choice d
    $SQLstring5 = "SELECT choicee, ((evotes/(avotes + bvotes + cvotes + dvotes + evotes + fvotes)) * 100) FROM poll WHERE questionid=$qid";// percentage for choice e
    $SQLstring6 = "SELECT choicef, ((fvotes/(avotes + bvotes + cvotes + dvotes + evotes + fvotes)) * 100) FROM poll WHERE questionid=$qid";// percentage for choice f

    // query SQLstring 1-6
    $result = mysqli_query($conn, $SQLstring) or die(mysqli_error($conn));
    $result2 = mysqli_query($conn, $SQLstring2) or die(mysqli_error($conn));
    $result3 = mysqli_query($conn, $SQLstring3) or die(mysqli_error($conn));
    $result4 = mysqli_query($conn, $SQLstring4) or die(mysqli_error($conn));
    $result5 = mysqli_query($conn, $SQLstring5) or die(mysqli_error($conn));
    $result6 = mysqli_query($conn, $SQLstring6) or die(mysqli_error($conn));

    // query question and totalvotes
    $QueryResult =  @mysqli_query($conn, $question);
    $QueryResult8 = @mysqli_query($conn, $totalvotes);

    // inserts results from queries into array based on the tuple they are in
    $Value = mysqli_fetch_row($QueryResult);
    $Value2 = mysqli_fetch_row($result);
    $Value3 = mysqli_fetch_row($result2);
    $Value4 = mysqli_fetch_row($result3);
    $Value5 = mysqli_fetch_row($result4);
    $Value6 = mysqli_fetch_row($result5);
    $Value7 = mysqli_fetch_row($result6);
    $Value8 = mysqli_fetch_row($QueryResult8);

    mysqli_close($conn); // close connection

?>
<html>
<title>Results</title>
<head>
  <link rel="stylesheet" href="style.css"> <!-- bring in css stylesheet -->
  <input type="button" onclick="window.location.href='http://localhost/project2/homepage.php';" id="homepage" value="Home Page" />
  <input type="button" onclick="window.location.href='http://localhost/project2/addpoll.php';" id="addpoll" value="Add Poll" />
  <input type="button" onclick="window.location.href='http://localhost/project2/viewpolls.php';" id="viewpolls" value="View Polls" />
</head>
<?php echo "<h1>{$Value[0]}</h1>"; // show question as header
echo "<h2>Total Votes: {$Value8[0]}</h2>"; // show total votes

// show all answer choices
echo "<body>
        <br>
        <br>
        <br>
        {$Value2[0]}
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        {$Value3[0]}
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        {$Value4[0]}
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        {$Value5[0]}
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        {$Value6[0]}
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        {$Value7[0]}
        </body>";?>

        <canvas id="myCanvas" width="800" height="600" style="border:2px solid #000000;"> <!-- creates a canvas for chart -->
          <script>

var c = document.getElementById("myCanvas"); // assigns variable to be able to draw on canvas
var ctx = c.getContext("2d"); // allows you to use the API
ctx.font = "20px Arial";

// puts percentages beside bars
ctx.fillText(<?php echo "{$Value2[1]}"?>+"%",(<?php echo "{$Value2[1]}"?>*6)+25,50);
ctx.fillText(<?php echo "{$Value3[1]}"?>+"%",(<?php echo "{$Value3[1]}"?>*6)+25,150);
ctx.fillText(<?php echo "{$Value4[1]}"?>+"%",(<?php echo "{$Value4[1]}"?>*6)+25,250);
ctx.fillText(<?php echo "{$Value5[1]}"?>+"%",(<?php echo "{$Value5[1]}"?>*6)+25,350);
ctx.fillText(<?php echo "{$Value6[1]}"?>+"%",(<?php echo "{$Value6[1]}"?>*6)+25,450);
ctx.fillText(<?php echo "{$Value7[1]}"?>+"%",(<?php echo "{$Value7[1]}"?>*6)+25,550);

// colors rectangles and finds the size of each based on their percentage
ctx.fillStyle = '#39e600';
ctx.fillRect(20, 20, <?php echo "{$Value2[1]}"?>*6, 50);
ctx.fillStyle = '#ffff00';
ctx.fillRect(20, 120, <?php echo "{$Value3[1]}"?>*6, 50);
ctx.fillStyle = '#e62e00';
ctx.fillRect(20, 220, <?php echo "{$Value4[1]}"?>*6, 50);
ctx.fillStyle = '#3366ff';
ctx.fillRect(20, 320, <?php echo "{$Value5[1]}"?>*6, 50);
ctx.fillStyle = '#ff6600';
ctx.fillRect(20, 420, <?php echo "{$Value6[1]}"?>*6, 50);
ctx.fillStyle = '#ac00e6';
ctx.fillRect(20, 520, <?php echo "{$Value7[1]}"?>*6, 50);
ctx.stroke(); // draws rectangles

</script>
</html>
