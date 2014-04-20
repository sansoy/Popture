<?php

$questionId = $_POST["questionId"];
$answers = $_POST["answers"];

sort($answers);  //from lowest to highest

$answer = implode(",", $answers);  //turn into comma separated value

//$mysqli = new mysqli("sabrihack.db.4286364.hostedresource.com","sabrihack","P0ptur3!","sabrihack");
$mysqli = new mysqli("localhost","root","root","popture");
// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$sql = "SELECT * FROM questions WHERE questionid = ". $questionId ." AND celebrities='". $answer ."' ";


if ($result = $mysqli->query($sql)){
    $row_cnt = $result->num_rows;
    if($row_cnt > 0){
        echo "<span style='color:greenyellow;'>CORRECT!</span>";
    } else {
        echo "<span style='color:red;'>INCORRECT!</span>";
    }
    $result->close();
}


$mysqli->close();

?>




