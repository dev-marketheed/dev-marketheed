<?php
session_start();
error_reporting(0);
include("includes/config.inc.php");
include("includes/functions.inc.php");
include("includes/header.inc.php");
access_denied();
connect_db();
?>

<div class="container">
<div class="sec-heading"><h3>Please select your option for popup</h3></div>
</div>	
<form action="" method="post" enctype="multipart/form-data">

<div class="form-fields">
<input type="radio" name="popup_selection" id="exit_intent" value="exit_intent" onchange="valueChanged()" checked>
<label for = "scroll_intent">  Exit Intent</label>
</div>

<div class="form-fields">
<input type="radio" name="popup_selection" id="scroll_intent" value="scroll_intent" onchange="valueChanged()">
<label for = "scroll_intent">  % Scroll on web page</label>
</div>

<div class="form-fields">
<input type="radio" name="popup_selection" id="delay_intent" value="delay_intent" onchange="valueChanged()">
<label for = "scroll_intent">  Time Elapsed On Page</label>
</div>


<div class="sroll_intent_field">
<div class="form-fields">
<h4 style="margin-bottom:0;">Add questions for user </h4>






<div class="table-responsive">  

<table class="table table-bordered" id="dynamic_field">  

<div id="row1" class="dynamic-added">
        <textarea name="field_name[]" value="" placeholder="Add Question"/></textarea><br/>
        <div class="form-fields">
        <input class="yes_question" id="yes_question" type="checkbox" name="question" value="yes"/>
        <label for="yes_question">Yes</label></div>
        <div class="form-fields">
        <textarea class="yes_message" id="yes_message" placeholder="Message"></textarea></div>
        <div class="form-fields">
	<input class="yes_question" id="redirect_yes" type="radio" name="action_yes" value="redirect_yes" onchange="nextquestionyes1()"/>
        <label for="redirect">Redirect</label><br/>
        <input class="yes_question" id="redirect_url_yes" type="text" name="redirect_url_yes" placeholder="Redirect Url"/>
        </div>
        <div class="form-fields">
        <input class="yes_question" id="next_question_yes" type="radio" name="action_yes" value="next_question_yes" onchange="nextquestionyes()"/>
	<label for="next_question">Next Question</label></div>
	
	
	
	
<div id="row2" class="dynamic-added2 dynamic-added">
        <textarea name="field_name[]" value="" placeholder="Add Question for Yes Option"/></textarea><br/>
        <div class="form-fields">
        <input class="yes_question" id="yes_question2" type="checkbox" name="question" value="yes"/>
        <label for="yes_question">Yes</label></div>
        <div class="form-fields">
        <textarea class="yes_message" id="yes_message2" placeholder="Message"></textarea></div>
        <div class="form-fields">
	<input class="yes_question" id="redirect_yes2" type="radio" name="action_yes2" value="redirect_yes" onchange="nextquestionyes12()"/>
        <label for="redirect">Redirect</label><br/>
        <input class="yes_question" id="redirect_url_yes2" type="text" name="redirect_url_yes" placeholder="Redirect Url"/>
        </div>
        <div class="form-fields">
        <input class="yes_question" id="next_question_yes2" type="radio" name="action_yes2" value="next_question_yes" onchange="nextquestionyes2()"/>
	<label for="next_question">Next Question</label></div>
	<div class="no_section">
	
	
	
	
	
	
	<div id="row4" class="dynamic-added4 dynamic-added">
        <textarea name="field_name[]" value="" placeholder="Add Second Question for Yes Option "/></textarea><br/>
        <div class="form-fields">
        <input class="yes_question" id="yes_question" type="checkbox" name="question" value="yes"/>
        <label for="yes_question">Yes</label></div>
        <div class="form-fields">
        <textarea class="yes_message" id="yes_message" placeholder="Message"></textarea></div>
        <div class="form-fields">
	<input class="yes_question" id="redirect_yes4" type="radio" name="action_yes4" value="redirect_yes"/>
        <label for="redirect">Redirect</label><br/>
        <input class="yes_question" id="redirect_url_yes4" type="text" name="redirect_url_yes" placeholder="Redirect Url"/>
        </div>
        <!--<div class="form-fields">
        <input class="yes_question" id="next_question_yes4" type="radio" name="action_yes4" value="next_question_yes"/>
	<label for="next_question">Next Question</label></div>-->
	<div class="no_section">
	<div class="form-fields">
	<input class="no_question" id="no_question4" type="checkbox" name="question" value="No"/>
        <label for="no_question">No</label></div>
        <div class="form-fields">
        <textarea class="no_message" id="no_message4" placeholder="Message"></textarea></div>
        <div class="form-fields">
        <input class="no_question" id="redirect_no4" type="radio" name="action_no4" value="redirect"/>
        <label for="redirect">Redirect</label><br/>
        <input class="yes_question" id="redirect_url_no4" type="text" name="redirect_url_no" placeholder="Redirect Url"/></div>
	<!--<input class="no_question" id="next_question_no4" type="radio" name="action_no4" value="Next Question"/>
	<label for="next_question">Next Question</label>--></div>
</div>
	
	
	
	
	
	<div class="form-fields">
	<input class="no_question" id="no_question2" type="checkbox" name="question" value="No"/>
        <label for="no_question">No</label></div>
        <div class="form-fields">
        <textarea class="no_message" id="no_message2" placeholder="Message"></textarea></div>
        <div class="form-fields">
        <input class="no_question" id="redirect_no2" type="radio" name="action_no2" value="redirect"/>
        <label for="redirect">Redirect</label><br/>
        <input class="yes_question" id="redirect_url_no2" type="text" name="redirect_url_no" placeholder="Redirect Url"/></div>
	<input class="no_question" id="next_question_no2" type="radio" name="action_no2" value="Next Question" />
	<label for="next_question">Next Question</label></div>
</div>
	
	<div class="no_section">
	<div class="form-fields">
	<input class="no_question" id="no_question" type="checkbox" name="question" value="No"/>
        <label for="no_question">No</label></div>
        <div class="form-fields">
        <textarea class="no_message" id="no_message" placeholder="Message"></textarea></div>
        <div class="form-fields">
        <input class="no_question" id="redirect_no" type="radio" name="action_no" value="redirect" onchange="nextquestionno1()"/>
        <label for="redirect">Redirect</label><br/>
        <input class="yes_question" id="redirect_url_no" type="text" name="redirect_url_no" placeholder="Redirect Url"/></div>
	<input class="no_question" id="next_question_no" type="radio" name="action_no" value="Next Question" onchange="nextquestionno()"/>
	<label for="next_question">Next Question</label></div>
</div>








<div id="row3" class="dynamic-added3 dynamic-added">
        <textarea name="field_name[]" value="" placeholder="Add Question for No Option"/></textarea><br/>
        <div class="form-fields">
        <input class="yes_question" id="yes_question3" type="checkbox" name="question" value="yes"/>
        <label for="yes_question">Yes</label></div>
        <div class="form-fields">
        <textarea class="yes_message" id="yes_message3" placeholder="Message"></textarea></div>
        <div class="form-fields">
	<input class="yes_question" id="redirect_yes3" type="radio" name="action_yes3" value="redirect_yes" onchange="nextquestionred12()"/>
        <label for="redirect">Redirect</label><br/>
        <input class="yes_question" id="redirect_url_yes3" type="text" name="redirect_url_yes" placeholder="Redirect Url"/>
        </div>
        <div class="form-fields">
        <input class="yes_question" id="next_question_yes3" type="radio" name="action_yes3" value="next_question_yes" onchange="nextquestionyes3()"/>
	<label for="next_question">Next Question</label></div>
	
	
	
	
	
	
	
<div id="row5" class="dynamic-added5 dynamic-added">
        <textarea name="field_name[]" value="" placeholder="Add Question"/></textarea><br/>
        <div class="form-fields">
        <input class="yes_question" id="yes_question5" type="checkbox" name="question" value="yes"/>
        <label for="yes_question">Yes</label></div>
        <div class="form-fields">
        <textarea class="yes_message" id="yes_message5" placeholder="Message"></textarea></div>
        <div class="form-fields">
	<input class="yes_question" id="redirect_yes5" type="radio" name="action_yes5" value="redirect_yes"/>
        <label for="redirect">Redirect</label><br/>
        <input class="yes_question" id="redirect_url_yes5" type="text" name="redirect_url_yes" placeholder="Redirect Url"/>
        </div>
        <!--<div class="form-fields">
        <input class="yes_question" id="next_question_yes5" type="radio" name="action_yes5" value="next_question_yes"/>
	<label for="next_question">Next Question</label></div>-->
	<div class="no_section">
	<div class="form-fields">
	<input class="no_question" id="no_question5" type="checkbox" name="question" value="No"/>
        <label for="no_question">No</label></div>
        <div class="form-fields">
        <textarea class="no_message" id="no_message5" placeholder="Message"></textarea></div>
        <div class="form-fields">
        <input class="no_question" id="redirect_no5" type="radio" name="action_no5" value="redirect"/>
        <label for="redirect">Redirect</label><br/>
        <input class="yes_question" id="redirect_url_no5" type="text" name="redirect_url_no" placeholder="Redirect Url"/></div>
	<!--<input class="no_question" id="next_question_no5" type="radio" name="action_no5" value="Next Question"/>
	<label for="next_question">Next Question</label>--></div>
</div>
	
	
	
	
	
	
	
	
	
	
	
	
	<div class="no_section">
	<div class="form-fields">
	<input class="no_question" id="no_question3" type="checkbox" name="question" value="No"/>
        <label for="no_question">No</label></div>
        <div class="form-fields">
        <textarea class="no_message" id="no_message" placeholder="Message"></textarea></div>
        <div class="form-fields">
        <input class="no_question" id="redirect_no3" type="radio" name="action_no" value="redirect"/>
        <label for="redirect">Redirect</label><br/>
        <input class="yes_question" id="redirect_url_no3" type="text" name="redirect_url_no" placeholder="Redirect Url"/></div>
	<input class="no_question" id="next_question_no3" type="radio" name="action_no3" value="Next Question"/>
	<label for="next_question">Next Question</label></div>
</div>













</table> 









<div class="field_wrapper">
    <div>
        
	
    </div>
</div>
       </div>
  
<div class="form-fields">
<input type="submit" value="Save" name="save" /></div>

</div>

 </form>
</div>

</div>
</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
   /* var i=1;  
    var maxField = 2; 
    var addButton = $('#next_question_yes'); 
    var wrapper = $('.table-responsive'); 
    i++;
    $('input:radio[name="action_yes"]').change(function () {
    if ($(this).val() == 'next_question_yes'){
    $(wrapper).parent().append('<div id="yes'+i+'" class="dynamic-added_ro"><textarea name="field_name[]" value="" placeholder="Add Question for Yes Option"/></textarea><br/><div class="form-fields"><input class="yes_question" id="yes_question'+i+'" type="checkbox" name="question" value="yes"/><label for="yes_question">Yes</label></div><div class="form-fields"><textarea class="yes_message" id="yes_message" placeholder="Message"></textarea></div><div class="form-fields"><input class="yes_question" id="redirect_yes" type="radio" name="action_yes" value="redirect_yes"/><label for="redirect">Redirect</label><br/><input class="yes_question" id="redirect_url_yes" type="text" name="redirect_url_yes" placeholder="Redirect Url"/></div><div class="form-fields"><input class="yes_question" id="next_question_yes" type="radio" name="action_yes" value="next_question_yes"/><label for="next_question">Next Question</label></div><div class="no_section"><div class="form-fields"><input class="no_question" id="no_question" type="checkbox" name="question" value="No"/><label for="no_question">No</label></div><div class="form-fields"><textarea class="no_message" id="no_message" placeholder="Message"></textarea></div><div class="form-fields"><input class="no_question" id="redirect_no" type="radio" name="action_no" value="redirect"/><label for="redirect">Redirect</label><br/><input class="yes_question" id="redirect_url_no" type="text" name="redirect_url_no" placeholder="Redirect Url"/></div><input class="no_question" id="next_question_no" type="radio" name="action_no" value="Next Question"/><label for="next_question">Next Question</label></div></div>'); }  else { $('#yes'+i+'').remove(); } });*/

$(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  

      });  
});



function nextquestionyes()
{
    if($('#next_question_yes').is(":checked"))  
    {
        $(".dynamic-added2").show();
    }
  
}
function nextquestionyes1()
{
   
   if($('#redirect_yes').is(":checked")) 
   {
        
        $(".dynamic-added2").hide();
    }
}


function nextquestionno()
{
    if($('#next_question_no').is(":checked"))  
    {
        $(".dynamic-added3").show();
    }
  
}
function nextquestionno1()
{
   
   if($('#redirect_no').is(":checked")) 
   {
        
        $(".dynamic-added3").hide();
    }
}

function nextquestionyes2()
{
    if($('#next_question_yes2').is(":checked"))  
    {
        $(".dynamic-added4").show();
        

    }
  
}
function nextquestionyes12()
{
   
   if($('#redirect_yes2').is(":checked")) 
   {
        
        $(".dynamic-added4").hide();
    }
}

function nextquestionyes3()
{
    if($('#next_question_yes3').is(":checked"))  
    {
        $(".dynamic-added5").show();
        

    }
  
}
function nextquestionred12()
{
   
   if($('#redirect_yes3').is(":checked")) 
   {
        
        $(".dynamic-added5").hide();
    }
}
















  
function valueChanged()
{
    if($('#exit_intent').is(":checked"))   
        $(".sroll_intent_field").show();
    else
        $(".sroll_intent_field").hide();
}




</script>
<style>
input[type=checkbox] , input[type=radio] {
    min-width: 45px;
   
}
.hide , .dynamic-added2 , .dynamic-added3 , .dynamic-added4 , .dynamic-added5 {
  display: none;
}

.form-fields.two-col {
    display: inline-block;
    
    width: 28%;
    vertical-align: top;
}
form {
    background: #fff;
}
.dynamic-added .form-fields {
    display: inline-block;
    vertical-align: top;
    margin-right: 24px;
}

.dynamic-added_ro .form-fields {
    display: inline-block;
    vertical-align: top;
    margin-right: 24px;
}
#row2 , #row3 {

    border: 1px solid #dfdfdf;
    margin-left: 103px;
    margin-bottom: 44px;

}
#row4 , #row5{

    border: 1px solid #dfdfdf;
    margin-left: 150px;
    margin-bottom: 44px;

}

</style>
<?php
include("includes/footer.inc.php");
?>
</body>
</html>