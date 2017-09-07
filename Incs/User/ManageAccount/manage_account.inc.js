$('document').ready(function(){
	$('.imgTick').hide();
	$('.imgCross').hide();
	$('.divChecking').hide();
	
	// PASSWORD CHANGING ____________________________________________________________________________________________________________________________________
	
	$('#editPassword').click(function(){
		tr = $('#trChangePass');
		if(tr.css('display')=='none'){
			tr.show();
		} else {
			tr.hide();
		}
	});
	
	$('#INPUT_changeUserNewPass').attr('disabled','disabled');
	$('#INPUT_changeUserNewPassConfirm').attr('disabled','disabled');
	
	$('#checkUserPassChange').click(function(){
		if(	($('#INPUT_changeUserPass').attr('disabled')!='disabled')	&&	($('#imgPasswordTick').css('display')=='none')){
			$('#checkUserPassChange').removeClass('userPassHover').addClass('normalPointer');
			checkPassword = $('#INPUT_changeUserPass').val();
			$('#INPUT_changeUserPass').attr('disabled','disabled');
			$('#imgPasswordTick').hide();
			$('#imgPasswordCross').hide();
			$('#DIVpasswordCheck').show();
			$.ajax({
				type:'POST',
				url:'Incs/User/ManageAccount/verifyPassword.inc.php',
				data: {'password':checkPassword},
				success: function(data){
					$('#DIVpasswordCheck').hide();
					if(data==1){
						$('#INPUT_changeUserNewPass').removeAttr('disabled','disabled');
						$('#INPUT_changeUserNewPassConfirm').removeAttr('disabled','disabled');
						$('#imgPasswordTick').show();
						$('#INPUT_changeUserPass').attr('disabled','disabled');
						$('#checkUserPassChange').removeClass('userPassHover').addClass('normalPointer');
						$('#checkUserPassChangeConfirm').removeClass('normalPointer').addClass('userPassHover');
						$('.trUserNewPass').show();
					}
					if(data==0){
						$('#INPUT_changeUserPass').removeAttr('disabled');
						$('#imgPasswordCross').show();
						$('#checkUserPassChange').removeClass('normalPointer').addClass('userPassHover');
					}
				}
			});
		}
	});
	
	 $('#INPUT_changeUserPass').focusin(function(){
		$('.imgTick').hide();
		$('.imgCross').hide();
		$('.divChecking').hide();
	 });

	function checkingHtml(){
		checkDiv = $('#DIVpasswordMacthCheck');
		checkDiv.css('color','#3BCE16').html('Checking...');
	}
	
	function enableNewPasswords(){
		$('#imgPasswordMatchTick').hide();
		$('#imgPasswordMatchCross').hide();
		$('#INPUT_changeUserNewPass').removeAttr('disabled');
		$('#INPUT_changeUserNewPassConfirm').removeAttr('disabled');
		checkDiv = $('#DIVpasswordMacthCheck');
		checkDiv.show();
	}
	
	$('#checkUserPassChangeConfirm').click(function(){
		if(	($('#INPUT_changeUserNewPass').attr('disabled')!='disabled') && ($('#INPUT_changeUserNewPassConfirm').attr('disabled')!='disabled') && 
		($('#imgPasswordMatchTick').css('display')=='none') && ($('#INPUT_changeUserPass').attr('disabled')=='disabled') && ($('#imgPasswordTick').css('display')!='none')){
			$('#checkUserPassChangeConfirm').removeClass('userPassHover').addClass('normalPointer');
			$('#imgPasswordMatchTick').hide();
			$('#imgPasswordMatchCross').hide();
			$('#INPUT_changeUserNewPass').attr('disabled','disabled');
			$('#INPUT_changeUserNewPassConfirm').attr('disabled','disabled');
			newPassword = $('#INPUT_changeUserNewPass').val();
			newPasswordConfirm = $('#INPUT_changeUserNewPassConfirm').val();
			checkDiv = $('#DIVpasswordMacthCheck');
			checkDiv.show();
			if(newPassword.length > 5){
				if(newPassword==newPasswordConfirm){
					checkDiv.css('color','#3BCE16').html('Passwords Match'); // MAKE WAIT TIME BETWEEN PASSWORDS MATCH AND SUBIMTTING
					window.setTimeout(checkingHtml,700);
					oldPassword = $('#INPUT_changeUserPass').val();
					if(	($('#INPUT_changeUserPass').attr('disabled')=='disabled')	&&	($('#imgPasswordTick').css('display')!='none')){
						$.ajax({
							type:'POST',
							url:'Incs/User/ManageAccount/changePassword.inc.php',
							data: {'newPassword':newPassword, 'oldPassword':oldPassword},
							success: function(data){
								if(data==1){
									$('#INPUT_changeUserNewPass').attr('disabled','disabled');
									$('#INPUT_changeUserNewPassConfirm').attr('disabled','disabled');
									checkDiv.css('color','#3BCE16').html('Password successfully changed.');
									$('#imgPasswordMatchTick').show();
									$('#checkUserPassChangeConfirm').removeClass('userPassHover').addClass('normalPointer');
								}
								if(data==0){
									enableNewPasswords();
									checkDiv.css('color','#FA0F0F').html('Failed, please try again later.');
									$('#imgPasswordMatchCross').show();
									$('#checkUserPassChangeConfirm').removeClass('normalPointer').addClass('userPassHover');
								}
							}
						});
					}
				} else {
					checkDiv.css('color','#FA0F0F').html('Passwords Don\'t Match');
					enableNewPasswords();
					$('#checkUserPassChangeConfirm').removeClass('normalPointer').addClass('userPassHover');
				}
			} else {
				checkDiv.css('color','#FA0F0F').html('Passwords must be over 6 characters');
				enableNewPasswords();
				$('#checkUserPassChangeConfirm').removeClass('normalPointer').addClass('userPassHover');
			}
		}
	});
	
	$('#INPUT_changeUserNewPass').focusin(function(){
		enableNewPasswords();
		checkDiv.hide();
	 });
	 
	 $('#INPUT_changeUserNewPassConfirm').focusin(function(){
		enableNewPasswords();
		checkDiv.hide();
	 });
	 
	 //EMAIL CHANGING_________________________________________________________________________________________________________________________________________________
	$('#editEmail').click(function(){
		tr = $('#trChangeEmail');
		if(tr.css('display')=='none'){
			tr.show();
		} else {
			tr.hide();
		}
	});
	
	$('#INPUT_changeUserNewEmail').attr('disabled','disabled');
	$('#INPUT_changeUserNewEmailConfirm').attr('disabled','disabled');
	
	$('#checkUserEmailChange').click(function(){
		if(	($('#INPUT_changeUserEmail').attr('disabled')!='disabled')	&&	($('#imgEmailTick').css('display')=='none')){
			$('#checkUserEmailChange').removeClass('userEmailHover').addClass('normalPointer');
			checkEmail = $('#INPUT_changeUserEmail').val();
			$('#INPUT_changeUserEmail').attr('disabled','disabled');
			$('#imgEmailTick').hide();
			$('#imgEmailCross').hide();
			$('#DIVEmailCheck').show();
			$.ajax({
				type:'POST',
				url:'Incs/User/ManageAccount/verifyEmail.inc.php',
				data: {'Email':checkEmail},
				success: function(data){
					$('#DIVEmailCheck').hide();
					if(data==1){
						$('#INPUT_changeUserNewEmail').removeAttr('disabled','disabled');
						$('#INPUT_changeUserNewEmailConfirm').removeAttr('disabled','disabled');
						$('#imgEmailTick').show();
						$('#INPUT_changeUserEmail').attr('disabled','disabled');
						$('#checkUserEmailChange').removeClass('userEmailHover').addClass('normalPointer');
						$('#checkUserEmailChangeConfirm').removeClass('normalPointer').addClass('userEmailHover');
						$('.trUserNewEmail').show();
					}
					if(data==0){
						$('#INPUT_changeUserEmail').removeAttr('disabled');
						$('#imgEmailCross').show();
						$('#checkUserEmailChange').removeClass('normalPointer').addClass('userEmailHover');
					}
				}
			});
		}
	});
	
	 $('#INPUT_changeUserEmail').focusin(function(){
		$('.imgTick').hide();
		$('.imgCross').hide();
		$('.divChecking').hide();
	 });

	function checkingHtml(){
		checkDiv = $('#DIVEmailMacthCheck');
		checkDiv.css('color','#3BCE16').html('Checking...');
	}
	
	function enableNewEmails(){
		$('#imgEmailMatchTick').hide();
		$('#imgEmailMatchCross').hide();
		$('#INPUT_changeUserNewEmail').removeAttr('disabled');
		$('#INPUT_changeUserNewEmailConfirm').removeAttr('disabled');
		checkDiv = $('#DIVEmailMacthCheck');
		checkDiv.show();
	}
	
	$('#checkUserEmailChangeConfirm').click(function(){
		if(	($('#INPUT_changeUserNewEmail').attr('disabled')!='disabled') && ($('#INPUT_changeUserNewEmailConfirm').attr('disabled')!='disabled') && 
		($('#imgEmailMatchTick').css('display')=='none') && ($('#INPUT_changeUserEmail').attr('disabled')=='disabled') && ($('#imgEmailTick').css('display')!='none')){
			$('#checkUserEmailChangeConfirm').removeClass('userEmailHover').addClass('normalPointer');
			$('#imgEmailMatchTick').hide();
			$('#imgEmailMatchCross').hide();
			$('#INPUT_changeUserNewEmail').attr('disabled','disabled');
			$('#INPUT_changeUserNewEmailConfirm').attr('disabled','disabled');
			newEmail = $('#INPUT_changeUserNewEmail').val();
			newEmailConfirm = $('#INPUT_changeUserNewEmailConfirm').val();
			checkDiv = $('#DIVEmailMacthCheck');
			checkDiv.show();
			if(newEmail.length > 5 && (newEmail.indexOf('@') != -1)){
				if(newEmail==newEmailConfirm){
					checkDiv.css('color','#3BCE16').html('Emails Match'); // MAKE WAIT TIME BETWEEN EMAILS MATCH AND SUBIMTTING
					window.setTimeout(checkingHtml,700);
					oldEmail = $('#INPUT_changeUserEmail').val();
					if(	($('#INPUT_changeUserEmail').attr('disabled')=='disabled')	&&	($('#imgEmailTick').css('display')!='none')){
						$.ajax({
							type:'POST',
							url:'Incs/User/ManageAccount/changeEmail.inc.php',
							data: {'newEmail':newEmail, 'oldEmail':oldEmail},
							success: function(data){
								if(data==3){
									enableNewEmails();
									checkDiv.css('color','#FA0F0F').html('This is already you\'re current email.');
									$('#imgEmailMatchCross').show();
									$('#checkUserEmailChangeConfirm').removeClass('normalPointer').addClass('userEmailHover');
								}
								if(data==2){
									enableNewEmails();
									checkDiv.css('color','#FA0F0F').html('This email is already in use.');
									$('#imgEmailMatchCross').show();
									$('#checkUserEmailChangeConfirm').removeClass('normalPointer').addClass('userEmailHover');
								}
								if(data==1){
									$('#INPUT_changeUserNewEmail').attr('disabled','disabled');
									$('#INPUT_changeUserNewEmailConfirm').attr('disabled','disabled');
									checkDiv.css('color','#3BCE16').html('Email successfully changed.');
									$('#imgEmailMatchTick').show();
									$('#checkUserEmailChangeConfirm').removeClass('userEmailHover').addClass('normalPointer');
								}
								if(data==0){
									enableNewEmails();
									checkDiv.css('color','#FA0F0F').html('Failed, please try again later.');
									$('#imgEmailMatchCross').show();
									$('#checkUserEmailChangeConfirm').removeClass('normalPointer').addClass('userEmailHover');
								}
								alert(data);
							}
						});
					}
				} else {
					checkDiv.css('color','#FA0F0F').html('Emails Don\'t Match');
					enableNewEmails();
					$('#checkUserEmailChangeConfirm').removeClass('normalPointer').addClass('userEmailHover');
				}
			} else {
				checkDiv.css('color','#FA0F0F').html('Please enter a valid email address');
				enableNewEmails();
				$('#checkUserEmailChangeConfirm').removeClass('normalPointer').addClass('userEmailHover');
			}
		}
	});
	
	$('#INPUT_changeUserNewEmail').focusin(function(){
		enableNewEmails();
		checkDiv.hide();
	 });
	 
	 $('#INPUT_changeUserNewEmailConfirm').focusin(function(){
		enableNewEmails();
		checkDiv.hide();
	 });
});