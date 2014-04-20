<!DOCTYPE HTML>
    <html>
<head>
    <style>
        body{
            font-family: arial;
            font-size: 14px;
        }
        h2{
            font-family: arial;
            color:#79bbff;
        }
        td {
            padding:5px;
        }
        #tool{
            position: absolute;
            top:10px;
            left:50px;
        }
        #mgmt{
            width:800px;
        }
        #questionError,#celebrityError{
            color:red;
        }
        .submitqanda {
            -moz-box-shadow:inset 0px 1px 0px 0px #bbdaf7;
            -webkit-box-shadow:inset 0px 1px 0px 0px #bbdaf7;
            box-shadow:inset 0px 1px 0px 0px #bbdaf7;
            background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #79bbff), color-stop(1, #378de5) );
            background:-moz-linear-gradient( center top, #79bbff 5%, #378de5 100% );
            filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#79bbff', endColorstr='#378de5');
            background-color:#79bbff;
            -moz-border-radius:6px;
            -webkit-border-radius:6px;
            border-radius:6px;
            border:1px solid #84bbf3;
            display:inline-block;
            color:#ffffff;
            font-family:arial;
            font-size:15px;
            font-weight:bold;
            padding:6px 24px;
            text-decoration:none;
            text-shadow:1px 1px 0px #528ecc;
        }.submitqanda:hover {
             background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #378de5), color-stop(1, #79bbff) );
             background:-moz-linear-gradient( center top, #378de5 5%, #79bbff 100% );
             filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#378de5', endColorstr='#79bbff');
             background-color:#378de5;
         }.submitqanda:active {
              position:relative;
              top:1px;
          }

    </style>
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
    <script>
        $(function(){


            $('#qanda').submit(function() {

                $("#questionError").html(' ');
                $("#celebrityError").html(' ');
                $("#status").html(' ');

                var question = $("textarea#question").val(),
                    celebrity1 = $("input[name=celebrity1]:checked").val(),
                    celebrity2 = $("input[name=celebrity2]:checked").val(),
                    celebrity3 = $("input[name=celebrity3]:checked").val(),
                    flag = 0,
                    answers = [];

                if(celebrity1) answers.push(celebrity1);
                if(celebrity2) answers.push(celebrity2);
                if(celebrity3) answers.push(celebrity3);


                if (question==null || question=="") {
                    $("#questionError").html('you must type a question');
                    flag = 1;
                }

                if (answers.length == 0){
                    $("#celebrityError").html('you must select at least 1 celebrity');
                    flag = 1;
                }

                if(flag == 0) $("#status").load("manage.php", {'question':question,'answers':answers});
                return false;
            });

            $('#displayContent').click(function(){
                $('#current').slideToggle('slow');
            });

        });

    </script>
</head>
<body>
<div id="tool">
<h2>POPTURE MANAGEMENT TOOL</h2>
    <div id="status"></div>
<form id="qanda" method="post" action="">

<table id="mgmt">
<tr>
    <td colspan="2">Question:</td>
   <td> <button id="resetForm" type="reset">RESET</button></td>
</tr>
<tr><td colspan="3"><div id="questionError"></div></td></tr>
<tr>
    <td colspan="3"><textarea id="question" rows="4" cols="90"></textarea></td>
</tr>
<tr><td>SLOT 1</td><td>SLOT 2</td><td>SLOT 3</td></tr>
<tr><td colspan="3"><div id="celebrityError"></div></td></tr>
<tr>
    <td>1. <input type="radio" name="celebrity1" value="1">Kim Kardashian</td>
    <td>6. <input type="radio" name="celebrity2" value="6">Lady Gaga</td>
    <td>11. <input type="radio" name="celebrity3" value="11">Taylor Swift</td>
</tr>
<tr>
    <td>2. <input type="radio" name="celebrity1" value="2">Derek Hough</td>
    <td>7. <input type="radio" name="celebrity2" value="7">Mark Ballas</td>
    <td>12. <input type="radio" name="celebrity3" value="12">Owen Wilson</td>
</tr>
<tr>
    <td>3. <input type="radio" name="celebrity1" value="3">Tara Reid</td>
    <td>8. <input type="radio" name="celebrity2" value="8">Khloe Kardashian</td>
    <td>13. <input type="radio" name="celebrity3" value="13">Jaden Smith</td>
</tr>
<tr>
    <td>4. <input type="radio" name="celebrity1" value="4">Justin Bieber</td>
    <td>9. <input type="radio" name="celebrity2" value="9">Ben Stiller</td>
    <td>14. <input type="radio" name="celebrity3" value="14">Simon Cowell</td>
</tr>
<tr>
    <td>5. <input type="radio" name="celebrity1" value="5">Kristen Stewart</td>
    <td>10. <input type="radio" name="celebrity2" value="10">Taylor Lautner</td>
    <td>15. <input type="radio" name="celebrity3" value="15">Queen Latifah</td>
</tr>
    <tr>
        <td></td>
        <td></td>
        <td><button class="submitqanda"  id="submitqanda" value="submit">SUBMIT</button></td>
    </tr>
</table>


</form>
    </tool>
<hr>
    <a id="displayContent" href="#">Click Here To Display The Content</a>
    <div id="current" style="display:none;">
    <?php
    //$mysqli = new mysqli("sabrihack.db.4286364.hostedresource.com","sabrihack","P0ptur3!","sabrihack");
    $mysqli = new mysqli("localhost","root","root","popture");

    // Check connection
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    $sql = "SELECT * FROM questions ORDER by questionId DESC";
    $result = $mysqli->query($sql);
    echo "<table id='database'>";
    echo "<tr><td><u>ID</u></td><td><u>QUESTION</u></td><td><u>CELEBRITY IDS</u></td></tr>";
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>".$row['questionId']."</td><td>".$row['question']."</td><td>".$row['celebrities']."</td></tr>";
        }
    } else {
        echo 'NO RESULTS';
    }
    echo "</table>";

    $mysqli->close();

    ?>

</body>
</html>