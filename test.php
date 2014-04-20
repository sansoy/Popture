<!DOCTYPE HTML>
    <html>

<head>
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"> </script>

    <script type="text/javascript">
        $(function(){
            $("#submit_answer").click(function(){
                $("#answer").load("testajax.php");
            });
        });


    </script>
<style>
    #answer{
        position:absolute;
        top:0px;
        left:0px;
        font-family: arial;
        font-size: 60px;
        z-index:100;
    }
    img{
        position:absolute;
        top:0px;
        width:200px;
        height:200px;
    }
    #submit_answer{
        position:absolute;
        top:100px;
    }
</style>
</head>
<body>


<div id="answer">hello</div>
<img src="images/kim_kardashian.jpg">
<button id="submit_answer">submit</button>

</body>

</html>