$(document).ready(function(){
	
	// HOVERING OVER TABS - LIKE - DETIALS - REVIEWS
	var backTabs = "#EEEEEE";
	$('#details').mouseenter(function(){
		$('#table_details').show();
		$('#table_likes').hide();
		$('#table_reviews').hide();
		$('#details').css('background-color',backTabs);
		$('#likes').css('background-color','white');
		$('#reviews').css('background-color','white');
	});
	
	$('#likes').mouseenter(function(){
		$('#table_details').hide();
		$('#table_reviews').hide();
		$('#table_likes').show();
		$('#details').css('background-color','white');
		$('#likes').css('background-color',backTabs);
		$('#reviews').css('background-color','white');
	});
	
	$('#reviews').mouseenter(function(){
		$('#table_details').hide();
		$('#table_reviews').show();
		$('#table_likes').hide();
		$('#details').css('background-color','white');
		$('#likes').css('background-color','white');
		$('#reviews').css('background-color',backTabs);
	});	
	
	// HOVERING OVER SIDE COMPARISONS
	$('.highlight_comparison').mouseenter(function(){
		old_border = $('.highlight_comparison').css('border');
		$(this).css('border','1px solid #4169E1').find('.game_details').css('border-left','1px solid #4169E1')
		.css('border-right','1px solid #4169E1').css('border-bottom','1px solid #4169E1').css('border-top','1px solid #4169E1');
		$(this).parent().prev().find('.highlight_comparison').css('border-bottom','1px solid #4169E1');
	}).mouseleave(function(){
		$(this).css('border',old_border);
		$(this).parent().prev().find('.highlight_comparison').css('border-bottom',old_border);
	});
	
	$('.sd_highlight').mouseenter(function(){
		old_border = $('.topSdComparison').css('border');
		$(this).parent().parent().parent().parent().css('border','1px solid #4169E1');
		$(this).find('.game_details').css('border','1px solid #4169E1');
	}).mouseleave(function(){
		$(this).parent().parent().parent().parent().css('border',old_border);
	});
	
	
	$('.sd_highlight').hide();
	$('#sd_1').show();
	$('#circle_1').addClass('circleTopDark');
	var fdOut = 1;
	var fdIn = 2;
	
	topSdInterval = setInterval(function(){
		if(fdIn==6){
			fdIn = 1;
		}
		$('.sd_highlight').fadeOut(500);
		$('#sd_'+fdIn).delay(750).fadeIn(500);
		$('.circleTop').addClass('circleTopLight');
		$('.circleTop').removeClass('circleTopDark');
		$('#circle_'+fdIn).removeClass('circleTopLight');
		$('#circle_'+fdIn).addClass('circleTopDark');
		fdIn++;
	},3000)
	
	$('.circleTop').click(function(){
		clearInterval(topSdInterval);
		$('.circleTop').addClass('circleTopLight');
		$('.circleTop').removeClass('circleTopDark');
		$(this).removeClass('circleTopLight').addClass('circleTopDark');
		//oldSd = $(this).parent().parent().parent().parent().next('.topSdComparison').find('.sd_1');
		id = $(this).attr('id');
		idNumber = id.replace('circle_', '');
		$('.sd_highlight').fadeOut(500);
		$('#sd_'+idNumber).delay(750).fadeIn(500);
		fdIn = idNumber++;
		fdIn = idNumber;
		topSdInterval = setInterval(function(){
			if(fdIn==6){
				fdIn = 1;
			}
			$('.sd_highlight').fadeOut(500);
			$('#sd_'+fdIn).delay(750).fadeIn(500);
			$('.circleTop').addClass('circleTopLight');
			$('.circleTop').removeClass('circleTopDark');
			$('#circle_'+fdIn).removeClass('circleTopLight');
			$('#circle_'+fdIn).addClass('circleTopDark');
			fdIn++;
		},3000);
	});

	$(document).keyup(function (event) {
		switch(event.keyCode){
			case 39: //RIGHT
				url = $('#go_right').attr('href');
				window.location.replace(url);
				break;
			case 37: //LEFT
				url = $('#go_left').attr('href');
				window.location.replace(url);
				break;
			default:
				break;
		}
	});
	
	$('.thumbs_up_comparison_left').next().hide();
	$('.thumbs_up_comparison_right').next().hide();
	$('.thumbs_up_comparison_already_left').hide().next().show();
	$('.thumbs_up_comparison_already_right').hide().next().show();
	
	$('.thumbs_up_comparison_left_loggedin').next().hide();
	$('.thumbs_up_comparison_right_loggedin').next().hide();
	$('.thumbs_up_comparison_already_left_loggedin').hide().next().show();
	$('.thumbs_up_comparison_already_right_loggedin').hide().next().show();
});

$('.thumbs_up_comparison_left').click(function(){
	this_one = $(this);
	url = $('#comparison_url').val();
	category = $('#choice_category').val();
	
	left_likes = $('#left_likes');
	left_likes_value = $('#left_likes').html();
	left_likes_value++;
	left_likes.html(left_likes_value);
	
	left_likes_public = $('#left_likes_public');
	left_likes_value_public = $('#left_likes_public').html();
	left_likes_value_public++;
	left_likes_public.html(left_likes_value_public);
	
	this_one.hide().next().show();
	check_visibility = $(this).parent().next().find('.already_liked_comparison_right');
	if(check_visibility.is(":visible")){
		check_visibility.hide().prev().show();
		
		right_likes = $('#right_likes');
		right_likes_value = $('#right_likes').html();
		right_likes_value--;
		right_likes.html(right_likes_value);
		
		right_likes_public = $('#right_likes_public');
		right_likes_value_public = $('#right_likes_public').html();
		right_likes_value_public--;
		right_likes_public.html(right_likes_value_public);
	}
	$.ajax({
		type:'POST',
		url:'Incs/like-left.inc.php',
		data: {'category': category, 'url': url},
		success: function(data){
		}
	});
});
$('.already_liked_comparison_left').click(function(){
	this_one = $(this);
	url = $('#comparison_url').val();
	category = $('#choice_category').val();
	
	left_likes = $('#left_likes');
	left_likes_value = $('#left_likes').html();
	left_likes_value--;
	left_likes.html(left_likes_value);
	
	left_likes_public = $('#left_likes_public');
	left_likes_value_public = $('#left_likes_public').html();
	left_likes_value_public--;
	left_likes_public.html(left_likes_value_public);
	
	this_one.hide().prev().show();
	$.ajax({
		type:'POST',
		url:'Incs/unlike-left.inc.php',
		data: {'category': category, 'url': url},
		success: function(data){
		}
	});
});
$('.thumbs_up_comparison_right').click(function(){
	this_one = $(this);
	url = $('#comparison_url').val();
	category = $('#choice_category').val();
	
	right_likes = $('#right_likes');
	right_likes_value = $('#right_likes').html();
	right_likes_value++;
	right_likes.html(right_likes_value);
	
	right_likes_public = $('#right_likes_public');
	right_likes_value_public = $('#right_likes_public').html();
	right_likes_value_public++;
	right_likes_public.html(right_likes_value_public);
	
	this_one.hide().next().show();
	check_visibility = $(this).parent().prev().find('.already_liked_comparison_left');
	if(check_visibility.is(":visible")){
		check_visibility.hide().prev().show();
		
		left_likes = $('#left_likes');
		left_likes_value = $('#left_likes').html();
		left_likes_value--;
		left_likes.html(left_likes_value);
		
		left_likes_public = $('#left_likes_public');
		left_likes_value_public = $('#left_likes_public').html();
		left_likes_value_public--;
		left_likes_public.html(left_likes_value_public);
	}
	$.ajax({
		type:'POST',
		url:'Incs/like-right.inc.php',
		data: {'category': category, 'url': url},
		success: function(data){
		}
	});
});
$('.already_liked_comparison_right').click(function(){
	this_one = $(this);
	url = $('#comparison_url').val();
	category = $('#choice_category').val();
	
	right_likes = $('#right_likes');
	right_likes_value = $('#right_likes').html();
	right_likes_value--;
	right_likes.html(right_likes_value);
	
	right_likes_public = $('#right_likes_public');
	right_likes_value_public = $('#right_likes_public').html();
	right_likes_value_public--;
	right_likes_public.html(right_likes_value_public);
	
	this_one.hide().prev().show();
	$.ajax({
		type:'POST',
		url:'Incs/unlike-right.inc.php',
		data: {'category': category, 'url': url},
		success: function(data){
		}
	});
});

$('.thumbs_up_comparison_left_loggedin').click(function(){
	this_one = $(this);
	url = $('#comparison_url').val();
	category = $('#choice_category').val();
	
	left_likes = $('#left_likes'); // UPDATE THE VALUE FOR LEFT LIKES TOTAL
	left_likes_value = $('#left_likes').html();
	left_likes_value++;
	left_likes.html(left_likes_value);
	
	left_likes_user = $('#left_likes_user'); // UPDATE THE VAlUE FOR LEFT LIKE USERS
	left_likes_value_user = $('#left_likes_user').html();
	left_likes_value_user++;
	left_likes_user.html(left_likes_value_user);
	
	this_one.hide().next().show(); // SHOW THE GREEN THUMBS UP
	check_visibility = $(this).parent().next().find('.already_liked_comparison_right_loggedin'); // CHECK TO SEE IF RIGHT HAND WAS LIKED BEFORE
	if(check_visibility.is(":visible")){
		check_visibility.hide().prev().show(); // SHOW NORMAL GREY HAND FOR RIGHT SIDE 
		
		right_likes = $('#right_likes');
		right_likes_value = $('#right_likes').html();
		right_likes_value--;
		right_likes.html(right_likes_value); // DECREASE TOTAL RIGHT LIKES VALUE
		
		right_likes_user = $('#right_likes_user');
		right_likes_value_user = $('#right_likes_user').html();
		right_likes_value_user--;
		right_likes_user.html(right_likes_value_user); // DECREASE USERS RIGHT LIKES VALUE
	}
	$.ajax({
		type:'POST',
		url:'Incs/like-left.inc.php',
		data: {'category': category, 'url': url},
		success: function(data){
		}
	});
});
$('.already_liked_comparison_left_loggedin').click(function(){
	this_one = $(this);
	url = $('#comparison_url').val();
	category = $('#choice_category').val();
	
	left_likes = $('#left_likes');
	left_likes_value = $('#left_likes').html();
	left_likes_value--;
	left_likes.html(left_likes_value);
	
	left_likes_user = $('#left_likes_user');
	left_likes_value_user = $('#left_likes_user').html();
	left_likes_value_user--;
	left_likes_user.html(left_likes_value_user);
	
	this_one.hide().prev().show();
	$.ajax({
		type:'POST',
		url:'Incs/unlike-left.inc.php',
		data: {'category': category, 'url': url},
		success: function(data){
		}
	});
});
$('.thumbs_up_comparison_right_loggedin').click(function(){
	this_one = $(this);
	url = $('#comparison_url').val();
	category = $('#choice_category').val();
	
	right_likes = $('#right_likes');
	right_likes_value = $('#right_likes').html();
	right_likes_value++;
	right_likes.html(right_likes_value);
	
	right_likes_user = $('#right_likes_user');
	right_likes_value_user = $('#right_likes_user').html();
	right_likes_value_user++;
	right_likes_user.html(right_likes_value_user);
	
	this_one.hide().next().show();
	check_visibility = $(this).parent().prev().find('.already_liked_comparison_left_loggedin');
	if(check_visibility.is(":visible")){
		check_visibility.hide().prev().show();
		
		left_likes = $('#left_likes');
		left_likes_value = $('#left_likes').html();
		left_likes_value--;
		left_likes.html(left_likes_value);
		
		left_likes_user = $('#left_likes_user');
		left_likes_value_user = $('#left_likes_user').html();
		left_likes_value_user--;
		left_likes_user.html(left_likes_value_user);
	}
	$.ajax({
		type:'POST',
		url:'Incs/like-right.inc.php',
		data: {'category': category, 'url': url},
		success: function(data){
		}
	});
});
$('.already_liked_comparison_right_loggedin').click(function(){
	this_one = $(this);
	url = $('#comparison_url').val();
	category = $('#choice_category').val();
	
	right_likes = $('#right_likes');
	right_likes_value = $('#right_likes').html();
	right_likes_value--;
	right_likes.html(right_likes_value);
	
	right_likes_user = $('#right_likes_user');
	right_likes_value_user = $('#right_likes_user').html();
	right_likes_value_user--;
	right_likes_user.html(right_likes_value_user);
	
	this_one.hide().prev().show();
	$.ajax({
		type:'POST',
		url:'Incs/unlike-right.inc.php',
		data: {'category': category, 'url': url},
		success: function(data){
		}
	});
});


// REVIEW SECTION ________________________________________________________________________________________________________________________________________________
$('.thumb_up_review_comp').each(function(){
	$(this).next().hide();
});
$('.already_liked_before_review_comp').hide().each(function(){
	$(this).next().show();
});
$('.already_liked_review_comp').click(function(){
	this_one = $(this);
	url = $('#comparison_url').val();
	category = $('#choice_category').val();
	review_id = $(this).parent().parent().parent().parent().next().find('.review_id').val();
	likes_place = $(this).parent().next();
	likes = $(this).parent().next().html();
	//likes = likes.replace('(','').replace(')','');  EXAMPLE HERE INCASE BRING BACK PARANTHESIS AROUND NO. LIKES AND DISLIKES
	likes--;
	likes_place.html(likes);
	this_one.hide().prev().show();
	$.ajax({
		type:'POST',
		url:'Incs/CompareIncs/compare_unlike_review.inc.php',
		data: {'review_id':review_id, 'category':category, 'pageUrl':url},
		success: function(data){
		}
	});
});
$('.thumb_up_review_comp').click(function(){
	this_one = $(this);
	url = $('#comparison_url').val();
	category = $('#choice_category').val();
	review_id = $(this).parent().parent().parent().parent().next().find('.review_id').val();
	likes_place = $(this).parent().next();
	likes = $(this).parent().next().html();
	likes++;
	likes_place.html(likes);
	this_one.hide().next().show();
	check_visibility = $(this).parent().next().next().find('.already_disliked_review_comp');
	if(check_visibility.is(":visible")){
		check_visibility.hide().prev().show();
		dislikes = check_visibility.parent().next().html();
		dislikes--;
		check_visibility.parent().next().html(dislikes);
	}
	$.ajax({
		type:'POST',
		url:'Incs/CompareIncs/compare_like_review.inc.php',
		data: {'review_id':review_id, 'category':category, 'pageUrl':url},
		success: function(data){
		}
	});
});

$('.thumb_down_review_comp').each(function(){
	$(this).next().hide();
});
$('.already_disliked_before_review_comp').hide().each(function(){
	$(this).next().show();
});
$('.already_disliked_review_comp').click(function(){
	this_one = $(this);
	url = $('#comparison_url').val();
	category = $('#choice_category').val();
	review_id = $(this).parent().parent().parent().parent().next().find('.review_id').val();
	dislikes_place = $(this).parent().next();
	dislikes = $(this).parent().next().html();
	dislikes--;
	dislikes_place.html(dislikes);
	this_one.hide().prev().show();
	$.ajax({
		type:'POST',
		url:'Incs/CompareIncs/compare_undislike_review.inc.php',
		data: {'review_id':review_id, 'category':category, 'pageUrl':url},
		success: function(data){
		}
	});
});
$('.thumb_down_review_comp').click(function(){
	this_one = $(this);
	url = $('#comparison_url').val();
	category = $('#choice_category').val();
	review_id = $(this).parent().parent().parent().parent().next().find('.review_id').val();
	dislikes_place = $(this).parent().next();
	dislikes = $(this).parent().next().html();
	dislikes++;
	dislikes_place.html(dislikes);
	this_one.hide().next().show();
	check_visibility = $(this).parent().prev().prev().find('.already_liked_review_comp');
	if(check_visibility.is(":visible")){
		check_visibility.hide().prev().show();
		likes = check_visibility.parent().next().html();
		likes--;
		check_visibility.parent().next().html(likes);
	}
	$.ajax({
		type:'POST',
		url:'Incs/CompareIncs/compare_dislike_review.inc.php',
		data: {'review_id':review_id, 'category':category, 'pageUrl':url},
		success: function(data){
		}
	});
});

$('.flag_review_comp').each(function(){
	$(this).next().hide();
});
$('.already_flagged_before_review_comp').hide().each(function(){
	$(this).next().show();
});
$('.already_flagged_review_comp').click(function(){
	this_one = $(this);
	item_id = $('#choice_id').val();
	category = $('#choice_category').val();
	review_id = $(this).parent().parent().parent().parent().next().find('.review_id').val();
	this_one.hide();
	this_one.prev().show();
	$.ajax({
		type:'POST',
		url:'Incs/CompareIncs/compare_unflag_review.inc.php',
		data: {'review_id':review_id, 'category':category, 'pageUrl':url},
		success: function(data){
		}
	});
});
$('.flag_review_comp').click(function(){
	this_one = $(this);
	url = $('#comparison_url').val();
	category = $('#choice_category').val();
	review_id = $(this).parent().parent().parent().parent().next().find('.review_id').val();
	this_one.hide();
	this_one.next().show();
	$.ajax({
		type:'POST',
		url:'Incs/CompareIncs/compare_flag_review.inc.php',
		data: {'review_id':review_id, 'category':category, 'pageUrl':url},
		success: function(data){
		}
	});
});

$('#post_review_button').click(function(){
	$('.review_section_post').show();
});
$('.review_section_up').click(function(){
	$('.review_section_post').hide();
});

$('.row_likes').hide();
$('.reviewMoreOptions').click(function(){
	moreOptions = $(this).parent().parent().prev();
	if(moreOptions.css('display')!='none'){ //IF IT IS SHOWING
		moreOptions.hide();
	} else {
		moreOptions.show();
	}
});

//COMMENT SECTION _____________________________________________________________________________________________________________________________________________________
$('.thumb_up_comment_comp').each(function(){
	$(this).next().hide();
});
$('.already_liked_before_comment_comp').hide().each(function(){
	$(this).next().show();
});
$('.already_liked_comment_comp').click(function(){
	this_one = $(this);
	category = $('#choice_category').val();
	comment_id = $(this).parent().parent().find('.comment_id').val();
	likes_place = $(this).parent().next();
	likes = $(this).parent().next().html();
	likes = likes.replace('(','').replace(')','');
	likes--;
	likes_place.html("("+likes+")");
	this_one.hide().prev().show();
	$.ajax({
		type:'POST',
		url:'Incs/CompareIncs/compare_unlike_comment.inc.php',
		data: {'comment_id':comment_id, 'category':category},
		success: function(data){
		}
	});
});
$('.thumb_up_comment_comp').click(function(){
	this_one = $(this);
	category = $('#choice_category').val();
	comment_id = $(this).parent().parent().find('.comment_id').val();
	likes_place = $(this).parent().next();
	likes = $(this).parent().next().html();
	likes = likes.replace('(','').replace(')','');
	likes++;
	likes_place.html("("+likes+")");
	this_one.hide().next().show();
	check_visibility = $(this).parent().next().next().find('.already_disliked_comment_comp');
	if(check_visibility.is(":visible")){
		check_visibility.hide().prev().show();
		dislikes = check_visibility.parent().next().html();
		dislikes = dislikes.replace('(','').replace(')','');
		dislikes--;
		check_visibility.parent().next().html("("+dislikes+")");
	}
	$.ajax({
		type:'POST',
		url:'Incs/CompareIncs/compare_like_comment.inc.php',
		data: {'comment_id':comment_id, 'category':category},
		success: function(data){
		}
	});
});

$('.thumb_down_comment_comp').each(function(){
	$(this).next().hide();
});
$('.already_disliked_before_comment_comp').hide().each(function(){
	$(this).next().show();
});
$('.already_disliked_comment_comp').click(function(){
	this_one = $(this);
	category = $('#choice_category').val();
	comment_id = $(this).parent().parent().find('.comment_id').val();
	dislikes_place = $(this).parent().next();
	dislikes = $(this).parent().next().html();
	dislikes = dislikes.replace('(','').replace(')','');
	dislikes--;
	dislikes_place.html("("+dislikes+")");
	this_one.hide().prev().show();
	$.ajax({
		type:'POST',
		url:'Incs/CompareIncs/compare_undislike_comment.inc.php',
		data: {'comment_id':comment_id, 'category':category},
		success: function(data){
		}
	});
});
$('.thumb_down_comment_comp').click(function(){
	this_one = $(this);
	category = $('#choice_category').val();
	comment_id = $(this).parent().parent().find('.comment_id').val();
	dislikes_place = $(this).parent().next();
	dislikes = $(this).parent().next().html();
	dislikes = dislikes.replace('(','').replace(')','');
	dislikes++;
	dislikes_place.html("("+dislikes+")");
	this_one.hide().next().show();
	check_visibility = $(this).parent().prev().prev().find('.already_liked_comment_comp');
	if(check_visibility.is(":visible")){
		check_visibility.hide().prev().show();
		likes = check_visibility.parent().next().html();
		likes = likes.replace('(','').replace(')','');
		likes--;
		check_visibility.parent().next().html("("+likes+")");
	}
	$.ajax({
		type:'POST',
		url:'Incs/CompareIncs/compare_dislike_comment.inc.php',
		data: {'comment_id':comment_id, 'category':category},
		success: function(data){
		}
	});
});

$('.flag_comment_comp').each(function(){
	$(this).next().hide();
});
$('.already_flagged_before_comment_comp').hide().each(function(){
	$(this).next().show();
});
$('.already_flagged_comment_comp').click(function(){
	this_one = $(this);
	category = $('#choice_category').val();
	comment_id = $(this).parent().parent().find('.comment_id').val();
	this_one.hide();
	this_one.prev().show();
	$.ajax({
		type:'POST',
		url:'Incs/CompareIncs/compare_unflag_comment.inc.php',
		data: {'comment_id':comment_id, 'category':category},
		success: function(data){
		}
	});
});
$('.flag_comment_comp').click(function(){
	this_one = $(this);
	category = $('#choice_category').val();
	comment_id = $(this).parent().parent().find('.comment_id').val();
	this_one.hide();
	this_one.next().show();
	$.ajax({
		type:'POST',
		url:'Incs/CompareIncs/compare_flag_comment.inc.php',
		data: {'comment_id':comment_id, 'category':category},
		success: function(data){
		}
	});
});