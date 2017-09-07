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
			if(newEmail.length > 5){
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
							}
						});
					}
				} else {
					checkDiv.css('color','#FA0F0F').html('Emails Don\'t Match');
					enableNewEmails();
					$('#checkUserEmailChangeConfirm').removeClass('normalPointer').addClass('userEmailHover');
				}
			} else {
				checkDiv.css('color','#FA0F0F').html('Emails must be over 6 characters');
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
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	