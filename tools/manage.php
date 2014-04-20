<?php

if($_POST){
    $question = $_POST["question"];
    $answers = $_POST["answers"];
    $answer = implode(",", $answers);  //turn into comma separated value

    if($question != "" && $answer != ""){
        //
        //$mysqli = new mysqli("sabrihack.db.4286364.hostedresource.com","sabrihack","P0ptur3!","sabrihack");
        $mysqli = new mysqli("localhost","root","root","popture");

        // Check connection
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        $sql = "INSERT INTO questions (question,celebrities) VALUES ('".$question."','".$answer ."')";
        $mysqli->query($sql);
        $id = $mysqli->insert_id;
        $mysqli->close();
        ?>
            <script>
                $('#resetForm').trigger('click');

                $('#database tr').eq(1).before('<tr><td><?=$id?></td><td><?=$question?></td><td><?=$answer?></td></tr>');
            </script>
        <?php
    } else {
        echo "OOPS THERE WAS A PROBLEM. TRY AGAIN!";
    }

}
?>




