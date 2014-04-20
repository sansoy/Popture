$(function(){

    $("#spin").click(function(){

        $("#answer").html('');
        $("#spin").toggle();
        $("#submit_answer").toggle();
        $("#submit_answer").attr("disabled", true);
        //$.playSound('audio/slotmachine.mp3');
        $(".question").html(' ');


        spinSlot("slot1");
        spinSlot("slot2");
        spinSlot("slot3");

        setTimeout(function(){
            random = Math.ceil(Math.random() * 500)
            setTimeout(function(){stopSlot("slot1");},random);

            random = Math.ceil(Math.random() * 500) + 500;
            setTimeout(function(){stopSlot("slot2");},random);

            random = Math.ceil(Math.random() * 500) + 1000
            setTimeout(function(){stopSlot("slot3");},random);
        },1000);

            setTimeout(function(){
                var slot1 = Math.abs( parseInt( $("#slot1").css("top") ) / 200 ) + 1;
                var slot2 = Math.abs( parseInt( $("#slot2").css("top") ) / 200 ) + 6;
                var slot3 = Math.abs( parseInt( $("#slot3").css("top") ) / 200 ) + 11;
                if(slot1 == 6) slot1=1;
                if(slot2 == 11) slot2=6;
                if(slot3 == 16) slot3=11;
/*
                console.log("slot1 =" + slot1);  //console.log breaks IE8
                console.log("slot2 =" + slot2);
                console.log("slot3 =" + slot3);
*/

                $(".question").load("pullQuestions.php", { 'slot1':slot1,'slot2':slot2,'slot3':slot3 });

            },3000);

        $("body").on("click", ".celeb", selectAnswer);

        });


        $("#submit_answer").click(function(){
            if(selectedAnswers){
                $("img").css("opacity", "1");
                $("#spin").toggle();
                $("#submit_answer").toggle();
                $("body").off("click", ".celeb", selectAnswer);

                var qId = $('.question').attr('id');
                $("#answer").load("answerQuestion.php", { 'questionId':qId,'answers':selectedAnswers });
                selectedAnswers = [];
            }

        });

/*
        //var selectedAnswers = [];
        var selectedAnswers;
        $(".celeb").click(function() {
                $("img").css("opacity", "0.5");
                $(this).css("opacity", "1");
                selectedAnswers = ($(this).attr("id"));
                //$('.celeb').click(function(){return false;});
            //
            var isSelected = $(this).css("opacity");
            if(isSelected == 1){
                $("img").css("opacity", "0.5");
                $(this).css("opacity", "1");
                console.log($(this).attr("id"));
                selectedAnswers.push($(this).attr("id"));
                $("img").click(false);
            } else {
                $(this).css("opacity", "1");
                console.log($(this).attr("id"));
                selectedAnswers.splice( $.inArray($(this).attr("id"), selectedAnswers), 1 );
            }

        });
*/


        $("#stop").click(function(){
            random = Math.ceil(Math.random() * 500)
            setTimeout(function(){stopSlot("slot1");},random);

            random = Math.ceil(Math.random() * 500) + 500;
            setTimeout(function(){stopSlot("slot2");},random);

            random = Math.ceil(Math.random() * 500) + 1000
            setTimeout(function(){stopSlot("slot3");},random);

            //setTimeout(function(){alert("done");},2000);
        });

    $('#error').html('no errors');

});

function spinSlot(slot){
    var foo = $("#" + slot);
    foo.css('top', '-1000px').animate({top: '0px'}, 300, 'linear', function(){spinSlot(slot);});
}

function stopSlot(slot){
    var foo = $("#" + slot);
    foo.stop();

    currentPos = foo.position().top;
    ceiling =  (Math.ceil(currentPos / 200) * 200);
    //$.playSound('audio/dink.mp3');
    foo.css('top', currentPos +'px').animate({top: ceiling +'px'}, 500, 'easeOutBounce');
    $("#slotSound").trigger("play");
}

/*
var selectedAnswers;
function selectAnswer(){
    //$("img").css("opacity", "0.2");
    $(this).css("opacity", ".5");
    selectedAnswers = ($(this).attr("id"));
}
*/

var selectedAnswers = [], isSelected;
function selectAnswer(){
    $("#submit_answer").attr("disabled", false);
    isSelected = $(this).css("opacity");
    if(isSelected == 1){
        $(this).css("opacity", ".5");
        selectedAnswers.push($(this).attr("id"));
    } else {
        $(this).css("opacity", "1");
        selectedAnswers.splice( $.inArray($(this).attr("id"), selectedAnswers), 1 );
    }
}


