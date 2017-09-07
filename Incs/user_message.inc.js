$(document).ready(function(){
	$('.reply_messaging_section').hide();
	$('.previous_messages').hide();
	$('.reply_message').click(function(){
		$(this).parent().parent().parent().find('.previous_messages').show();
		$(this).parent().parent().next('.reply_messaging_section').show();
		$(this).hide();
		user_recieving = $(this).parent().parent().parent().find('.user_recieving_message').html();
		username_sending = $('.username_user_sending').html();
		$.ajax({
			url: 'Incs/user_message_seen.inc.php',
			type: 'POST',
			data: {'other_user': user_recieving, 'username_sending':username_sending},
				success: function(data){
				the_message.val('');
				}
			});
	});
	$('.message_go_up').click(function(){
		$(this).parent().parent().parent().parent().parent().parent().parent().find('.previous_messages').hide();
		$(this).parent().parent().parent().parent().parent().parent().parent().find('.reply_messaging_section').hide();
		$(this).parent().parent().parent().parent().parent().parent().parent().find('.reply_message').show();
	});
	
	$('#user_reply_to_message').click(function(){
		var message =$.trim($('#user_messaging_reply_section').val());
		if(message==''){
			$('#user_messaging_reply_section').val('');
			$('#user_messaging_reply_section').attr('placeholder','Please type your message here... ');
		} else {
			$('#user_message_reply_form').submit();
		}
	});
	
	$('#message_all_scroll').scrollTop($('#message_all_scroll').height());
	
	$('.user_notifications_comparisons').hide();
	$('.user_notifications_dp').click(function(){
		usersComps = $(this).parent().find('.user_notifications_comparisons');
		if(usersComps.is(':visible')){
			usersComps.slideUp();
		} else {
			usersComps.slideDown();
		}
		//$(this).parent().find('.user_notifications_comparisons').hide();
	});
	
});

function message_user(){
	message = $('#user_messaging');
	if(($.trim(message.val()))==''){
		message.val('');
		message.attr('placeholder','Please type your message here... ');
	} else {
		$('#user_message_form').submit();
	}
}

function user_reply(){
	message = the_message;
	if(!($.trim(message.val()))){
		message.val('');
		message.attr('placeholder','Please type your message here... ');
	} else {
		other_user = $('#user_recieving_message').html();
		username_sending = $('#username_user_sending').html();
		$.ajax({
		url: 'Incs/user_view_message_reply_form.inc.php',
		type: 'POST',
		data: {'other_user': other_user, 'message': message.val(), 'user_sending':username_sending},
			success: function(data
			}
		});
	}
}