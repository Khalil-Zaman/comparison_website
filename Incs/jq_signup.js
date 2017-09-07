$(document).ready(function(){
	
	$('#signup_username').keyup(function(){
		username = $.trim($(this).val());
		if(username!=''){
			$('#username_check').text('Searching...');
			$.ajax({
			type: 'POST',
			url: 'Incs/username.inc.php',
			data: {'username':username},
				success: function(data){
					$('#username_check').html(data);
				}
			}); 
		} 
		if(username==''){
			$('#username_check').text('');
		}
	});
	
	$('#signup_password_again').focusout(function(){
		pass = $('#signup_password').val();
		pass_again = $(this).val();
		if(pass_again!=pass){
			$('#password_again_check').html("<span style='font-size:12px; color:#404040;'>"+'Password\'s don\'t match'+"</span>");
		} else {
			$('#password_again_check').html("<span style='font-size:12px; color:#404040;'>"+'Password\'s are a match'+"</span>");
		}
	});
	
	$('#signup_email').focusout(function(){
		email = $.trim($(this).val());
		if(email!=''){
			$.ajax({
			type: 'POST',
			url: 'Incs/email.inc.php',
			data: {'email':email},
				success: function(data){
					//if ((data).indexOf('Already In Use')){
						//$('#email_check').css('color','#DB4646').html(data);
					//} else {
						$('#email_check').html(data);
					//}
				}
			}); 
		} 
		if(email==''){
			$('#email_check').text('');
		}
	});
	
	$('#reg_button').click(function(){
		var check = 0;
		$.each($('#reg_table .i'),function(){
			var input = $.trim($(this).val());
			if(input==''){
				$(this).css('background-color','#FF8080').css('border','1px solid red');
				check = 1;
			}
		});
		if(check==1){
			$('#reg_heading').html("<span class='reg_log_headings'>Registration</span><span class='reg_log_error'> - Please fill in all highlighted fields </span>")
		} else {
			$('#reg_table').submit();
		}
	});
	
	$('.i').focusin(function(){
		$(this).css('background-color','#FFFFFF').css('border','1px solid #AAAAAA');
	});
	
	$('#log_button').click(function(){
		var check_log = 0;
		$.each($('#log_table .i'),function(){
			var input = $.trim($(this).val());
			if(input==''){
				$(this).css('background-color','#FF8080').css('border','1px solid red');
				check_log = 1;
			}
		});
		if(check_log==1){
			$('#log_heading').html("<span class='reg_log_headings'>Login</span><span class='reg_log_error'> - Please fill in all highlighted fields </span>")
		} else {
			$('#log_table').submit();
		}
	});
	
	$(document).keyup(function (event) {	
	switch(event.keyCode){
		case 13:
			if($('.log_i').is(":focus")){
				$('#log_table').submit();
			}
			if($('.edit_source_input').is(":focus")){
				$('#details_changes_form').submit();
			}
			break;
		default:
			break;
	}
});
	
});