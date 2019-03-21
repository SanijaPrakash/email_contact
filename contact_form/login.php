<!-- 
 * Created by hiran.
 * Date: 12/3/19
 * Time: 4:30 PM
 */ -->
<!DOCTYPE html>
<html>
<head><h2><center>CONTACT FORM</center></h2></head>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script type="text/javascript">
	
	var onloadCallback = function() {
		grecaptcha.render('html_element', {
			'sitekey' : '6LdclJgUAAAAAFjlK2VQSH8l82RK6gZb5kv38KnS',
		});
	};

	function get_action() {
		var v = grecaptcha.getResponse();
        console.log("Resp" + v);
        if (v == '') {
            document.getElementById('captcha').innerHTML = "please verify captcha";
            return false;
        }
        else {
            document.getElementById('captcha').innerHTML = "Captcha completed";
            return true;
            }
        }
   
	$(document).ready(function () {
		$("#form").validate({
			rules: {
				name:{
		            required:true,
		            minlength:3,
		            maxlength:20
		        },
		        email: {
		            required: true,
		            email:true
		            		        },
		        phone:{
		            required:true,
		            minlength:10,
		            maxlength:10
		        }
		    },
		    messages: {
		    	name: { 
			        required:"Please enter your name",
			        minlength:"name should have 3 to 20 characters "

			    },
			    email: {
			         required:"Please enter your email"
			    },
			    phone:{
			        required:"phone number required",
			        minlength:"please enter a valid phone number"
			    }
			},
			submitHandler: function(form) {
				form.submit();
			}
		});
	
	 });
</script>
<body>
	<form action="home.php" method="POST" id="form" onsubmit="return get_action();">
		<table align="center">
			<tr>
				<label id="nameerr"></label>
				<td colspan="2">Name :</td>
				<td colspan="2"><input type="text" name="name" id="name"></td>
			</tr>
			<tr>
				<label id="emailerr"></label>
				<td colspan="2">Email :</td>
				<td colspan="2"><input type="text" name="email" id="email"></td>
			</tr>	
			<tr>
				<label id></label>
				<td colspan="2">Phone Number :</td>
				<td><input type="text" name="phone" id="phone"></td>
			</tr>
			<tr>
				<td colspan="2">Message :</td>
				<td><textarea rows="3" cols="25" name="message"></textarea></td>
			</tr>
			<tr>
				<td colspan="2">Captcha :</td>
				<td><div class="g-recaptcha" id="html_element"></div></td>
				<td>  <div name= "captcha" id="captcha"></div></td>
			</tr>
			<tr>
				<td colspan="2"><input type="submit" name="btnsubmit" value="submit"></td>
				<td colspan="2"><input type="reset" name="reset" value="clear"></td>
			</tr>
			<script type="text/javascript" src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer>
				$(document).ready(function() {
					$('#btnsubmit').click(function(e){
						 e.preventDefault();
						var name = $("#name").val();
				    	var email = $("#email").val();
				    	var phone = $("#phone").val();
				    	var nameerr;
				    	var emailerr;
				    	// var phoneerr;
				    	$.ajax({
				    		type: "POST",
				        	url: "home.php",
				        	dataType: "json",
				        	data: {name:name,email:email,phone:phone},
				        	success : function(data){
				        		if(data.status==0){
				        			$.each(data.error, function( index, value ) {
				        				if(index=='name'){
				        					nameerr=value;
				        				}
				                    	if(index=='email'){
				                        	emailerr=value;
				                    	}
				                    	if (index=='phone'){
				                    		phoneerr==value;
				                    	}
				                	});
				                	$('#nameerr').html(nameerr);
				            	    $('#emailerr').html(emailerr);
				            	    $('#phoneerr').html(phoneerr);
				            	}
				            }
				        });
				    });
				});
			</script>
		</table>
	</form>
</body>
</html>
