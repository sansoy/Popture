<?php
$con=mysqli_connect("localhost","root","root","popture");
//$con=mysqli_connect("sabrihack.db.4286364.hostedresource.com","sabrihack","P0ptur3!","sabrihack");
// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$question = array();

$slot1 = $_POST["slot1"];
$slot2 = $_POST["slot2"];
$slot3 = $_POST["slot3"];

// find questions with all three celebs
$sql = "SELECT questionid, question FROM questions WHERE ";
$sql .= "celebrities = '".$slot1.",".$slot2.",".$slot3."'";
$result = mysqli_query($con,$sql);
while($row = mysqli_fetch_array($result)) {
    $questionId = $row['questionid'];
    $question[ $questionId ] = $row['question'];
}

// find questions with combos of first two celebs
$sql = "SELECT questionid, question FROM questions WHERE ";
$sql .= "celebrities = '".$slot1.",".$slot2."'";
$result = mysqli_query($con,$sql);
while($row = mysqli_fetch_array($result)) {
    $questionId = $row['questionid'];
    $question[ $questionId ] = $row['question'];
}

// find questions with combos of last two celebs
$sql = "SELECT questionid, question FROM questions WHERE ";
$sql .= "celebrities = '".$slot2.",".$slot3."'";
$result = mysqli_query($con,$sql);
while($row = mysqli_fetch_array($result)) {
    $questionId = $row['questionid'];
    $question[ $questionId ] = $row['question'];
}

// find questions with combos of first and last two celebs
$sql = "SELECT questionid, question FROM questions WHERE ";
$sql .= "celebrities = '".$slot1.",".$slot3."'";
$result = mysqli_query($con,$sql);
while($row = mysqli_fetch_array($result)) {
    $questionId = $row['questionid'];
    $question[ $questionId ] = $row['question'];
}

// find questions with first celeb
$sql = "SELECT questionid, question FROM questions WHERE ";
$sql .= "celebrities = '".$slot1."'";
$result = mysqli_query($con,$sql);
while($row = mysqli_fetch_array($result)) {
    $questionId = $row['questionid'];
    $question[ $questionId ] = $row['question'];
}

// find questions with second celeb
$sql = "SELECT questionid, question FROM questions WHERE ";
$sql .= "celebrities = '".$slot2."'";
$result = mysqli_query($con,$sql);
while($row = mysqli_fetch_array($result)) {
    $questionId = $row['questionid'];
    $question[ $questionId ] = $row['question'];
}

// find questions with last celeb
$sql = "SELECT questionid, question FROM questions WHERE ";
$sql .= "celebrities = '".$slot3."'";
$result = mysqli_query($con,$sql);
while($row = mysqli_fetch_array($result)) {
    $questionId = $row['questionid'];
    $question[ $questionId ] = $row['question'];
}

mysqli_close($con);




if($question){
    $questionId = array_rand($question);  //select one random question from all possible choices
    echo $question[$questionId];
    echo "<script>$('.question').attr('id',".$questionId.");</script>";
} else {
    echo "no question found  <script>$('#spin').toggle();$('#submit_answer').toggle();$('body').on('click', '.celeb', selectAnswer);</script>";
}

?>




