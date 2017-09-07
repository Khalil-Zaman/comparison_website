$(document).ready(function(){
	//$('.Which_one_sub_cat, .Forum_sub_cat').hide();
	$('.laptops_subs').hide();
	$('.games_subs').hide();
	$('.phones_subs').hide();
	$('.Login_sub_cat_username').show();
	$('.Login_sub_cat_password').show();
	$('.Login_sub_cat_login_button').show();
	$('.Login_sub_cat_sign_up').show();
	$('.Login_sub_cat_problems').show();
	$('.User_sub_cat_logout').show();
	$('.User_sub_cat_manage_account').show();
	$('.User_sub_cat_profile_pic').show();
	$('.laptop_details').hide();
	$('.name_details').hide();
	$('.reply_box').hide();
	$('#Laptop_Brand').hide();
	$('#Brand_up_arrow').hide();
	$('#Brand_down_arrow').show();
	$('.hover_compare').hide();
	$('#game_top_1').show();
	$('#left_normal').show();
	$('#left_normal_liked').hide();
	$('#right_normal').show();
	$('#right_normal_liked').hide();
	$('#this_one').css('opacity','0.5');
	$('.compareLikes').hide();
	$('.compareDetails').show();
	$('.compareReviews').hide();
	$('#table_likes').show();
	$('#table_details').hide();
	$('#table_reviews').hide();
	$('#login_table').hide();
	$('#user_table').hide();
	$('#search_options').hide();
	$('#user_likes').show();
	$('#user_items_added').hide();
		
	// CATEGORIES
	$('.curvedEdgesSelect').mouseenter(function(){
		$(this).find('.laptop_details').show();
	}).mouseleave(function(){
		$(this).find('.laptop_details').hide();
	});
	
	$('.reply_comment').click(function(){
		$(this).next('.reply_box').show();
	});
	
	$('#Laptop_specific').css('cursor', 'pointer');
	
	$('#Laptop_specific').click(function(){
		$('#Laptop_Brand').toggle('fast', 'linear');		
	});
	
	/* GAME */
	$('.game_compare').mouseenter(function(){
		$(this).find('.name_details').show();
		//$(this).next('.hover_compare').show();
	}).mouseleave(function(){
		$(this).find('.name_details').hide();	
		//$(this).next('.hover_compare').hide();		
	});
	
	var place;
	$('.comp_select').mouseenter(function(){
		var place = $(this).index();
		place++;
			if(place==1){
				$(this).parent().prev().find('.comp_select').first().css('border-bottom','1px solid RoyalBlue');
			}
			if(place==2){
				$(this).prev().css('border-right','1px solid RoyalBlue');
				$(this).parent().prev().find('.comp_select').first().next().css('border-bottom','1px solid RoyalBlue');
			}
			if(place==3){
				$(this).prev().css('border-right','1px solid RoyalBlue');
				$(this).parent().prev().find('.comp_select').first().next().next().css('border-bottom','1px solid RoyalBlue');
			}
		$(this).find('.name_details').show();
		$(this).css('border','1px solid RoyalBlue');
		$(this).css('border-bottom','0');
		$(this).parent().parent().parent().find('#highlight_around').css('background-color','#CCCCCC');
		//$('.name_details').css('background-color','#E9E9E9');
		$('.compDetailsTable').css('background-color','#E9E9E9');
		$('.name_details_td').css('background-color','#F6F6F6');
		$(this).find('.sd_game_details').show();
	}).mouseleave(function(){
		$('.comp_select').css('border','1px solid #CCCCCC');
		$(this).css('border','1px solid #CCCCCC');
		$(this).find('.name_details').hide();	
		$(this).parent().parent().find('#highlight_around').css('background-color','white');
		$(this).css('background-color','white');
		//$('.name_details').css('background-color','white');
		$('.compDetailsTable').css('background-color','white');
		$('.name_details_td').css('background-color','white');
		$(this).find('.sd_game_details').hide();
	});
	
	$('.showDetails').mouseenter(function(){
		var place = $(this).index();
		place++;
			if(place==1){
				$(this).parent().prev().find('.showDetails').first().css('border-bottom','1px solid RoyalBlue');
			}
			if(place==2){
				$(this).prev().css('border-right','1px solid RoyalBlue');
				$(this).parent().prev().find('.showDetails').first().next().css('border-bottom','1px solid RoyalBlue');
			}
			if(place==3){
				$(this).prev().css('border-right','1px solid RoyalBlue');
				$(this).parent().prev().find('.showDetails').first().next().next().css('border-bottom','1px solid RoyalBlue');
			}
		$(this).find('.name_details').show();
		$(this).css('border','1px solid RoyalBlue');
		$(this).css('border-bottom','0');
		$(this).parent().parent().parent().find('#highlight_around').css('background-color','#CCCCCC');
		$('.compDetailsTable').css('background-color','#E9E9E9');
		$('.name_details_td').css('background-color','#F6F6F6');
		$(this).find('.sd_game_details').show();
	}).mouseleave(function(){
		$('.showDetails').css('border','1px solid #CCCCCC');
		$(this).css('border','1px solid #CCCCCC');
		$(this).find('.name_details').hide();	
		$(this).parent().parent().find('#highlight_around').css('background-color','white');
		$(this).css('background-color','white');
		$('.compDetailsTable').css('background-color','white');
		$('.name_details_td').css('background-color','white');
		$(this).find('.sd_game_details').hide();
	});
	$('.sd_game_details').hide();
	
	$('.comparison_select').mouseenter(function(){
		$(this).find('.game_details').show();
		$(this).parent().parent().parent().find('#highlight_around').css('background-color','#CCCCCC');
	}).mouseleave(function(){
		$(this).find('.game_details').hide();	
		$(this).parent().parent().find('#highlight_around').css('background-color','white');	
	});
	$('.game_details').hide();
	
	// LAPTOPS SLIDE SHOW
	l1 = $('#laptop_top_1');
	l2 = $('#laptop_top_2');
	l3 = $('#laptop_top_3');
	l4 = $('#laptop_top_4');
	ldp1 = $('#laptop_top_dp_1');
	ldp2 = $('#laptop_top_dp_2');
	ldp3 = $('#laptop_top_dp_3');
	ldp4 = $('#laptop_top_dp_4');
	borderl_1 = ldp1.find('.game_compare');
	borderl_2 = ldp2.find('.game_compare');
	borderl_3 = ldp3.find('.game_compare');
	borderl_4 = ldp4.find('.game_compare');
	
	l1.show();
	l2.hide();
	l3.hide();
	l4.hide();
	
	borderl_1.css('border', '1px solid red');
	timer_count = 0;
	setInterval(function(){	
		if ((l4.css('display') != 'none')&&(timer_count==0)){
			l1.show();
			l2.hide();
			l3.hide();
			l4.hide();
			borderl_1.css('border', '1px solid Red');
			borderl_2.css('border', '1px solid RoyalBlue');
			borderl_3.css('border', '1px solid RoyalBlue');
			borderl_4.css('border', '1px solid RoyalBlue');
			timer_count++;
		}
		if ((l3.css('display') != 'none')&&(timer_count==0)){
			l1.hide();
			l2.hide();
			l3.hide();
			l4.show();
			borderl_1.css('border', '1px solid RoyalBlue');
			borderl_2.css('border', '1px solid RoyalBlue');
			borderl_3.css('border', '1px solid RoyalBlue');
			borderl_4.css('border', '1px solid Red');
			timer_count++;
		}	
		if ((l2.css('display') != 'none')&&(timer_count==0)){
			l1.hide();
			l2.hide();
			l3.show();
			l4.hide();
			borderl_1.css('border', '1px solid RoyalBlue');
			borderl_2.css('border', '1px solid RoyalBlue');
			borderl_3.css('border', '1px solid Red');
			borderl_4.css('border', '1px solid RoyalBlue');
			timer_count++;
		}
		if ((l1.css('display') != 'none')&&(timer_count==0)){
			l1.hide();
			l2.show();
			l3.hide();
			l4.hide();
			borderl_1.css('border', '1px solid RoyalBlue');
			borderl_2.css('border', '1px solid Red');
			borderl_3.css('border', '1px solid RoyalBlue');
			borderl_4.css('border', '1px solid RoyalBlue');
			timer_count++;
		} 
		timer_count=0;
	},2000);
	
	$('#login_click').click(function(){
		login_table = $('#login_table');
		if(login_table.is(':visible')){
			login_table.hide();
		} else {
			login_table.show();
		}
	});
	
	$('#user_click').click(function(){
		user_table = $('#user_table');
		if(user_table.is(':visible')){
			user_table.hide();
		} else {
			user_table.show();
		}
	});
	
	$('#comparison_search').click(function(){
		search_options = $('#search_options');
		if(search_options.is(':visible')){
			search_options.slideUp();
		} else {
			search_options.slideDown();
		}
	});
	
	$('.thumbs_up').mouseenter(function(){
		$(this).attr('src',"Pictures/Website/green_thumbs_up.png");
	}).mouseleave(function(){
		$(this).attr('src',"Pictures/Website/thumbs_up.png");
	});
	
	$('.thumbs_down').mouseenter(function(){
		$(this).attr('src','Pictures/Website/red_thumbs_down.png');
	}).mouseleave(function(){
		$(this).attr('src','Pictures/Website/thumbs_down.png');
	});
	
	$('.flag').mouseenter(function(){
		$(this).attr('src','Pictures/Website/red_flag.png');
	}).mouseleave(function(){
		$(this).attr('src','Pictures/Website/flag.png');
	});
	

	
	$('.user_cat_likes').click(function(){
		$('#user_likes').show();
		$('#user_items_added').hide();
	});
	$('.user_cat_items_added').click(function(){
		$('#user_likes').hide();
		$('#user_items_added').show();
	});
	
	$('.link_login').mouseenter(function(){
		var pathname = window.location.href;
		var prev_page = pathname.replace('http://localhost/website/','');
		$(this).attr('href','loginform.php?prev_page='+prev_page+'-finish');
	});
	
	$('.login_required').mouseenter(function(){
		var original = $(this).html();
		var pathname = window.location.pathname;
		var prev_page = pathname.replace('/website/','');
		$(this).attr('href','loginform.php?prev_page='+prev_page);
		$(this).html('Log in');
		$(this).append('<div class="login_box"style="background-color:white; border:1px solid #CCCCCC; height:40px; width:200px; font-size:12px; position:absolute;">You need to be logged in to '
		+original+' </div>');
	}).mouseleave(function(){
		var statement = $(this).find('.login_box').html();
		var original = statement.replace('You need to be logged in to ','');
		$(this).html(original);
		$('.login_box').hide();
	});
	
	$('#notification').mouseenter(function(){
		$('#notification_image').css('box-shadow','2px 2px 4px #888');
		$('#notification_number').css('box-shadow','2px 2px 4px #888');
	}).mouseleave(function(){
		if($('#notification_slide').is(':hidden')){
			$('#notification_number').css('box-shadow','none');
			$('#notification_image').css('box-shadow','none');
		}
	});
	
	$('#notification_slide').hide();
	$('.user_notifications').hide();
	$('#notification').click(function(){
		if($('#notification_slide').is(':hidden')){
			$('#notification_image').css('box-shadow','2px 2px 4px #888');
			$('#notification_number').css('box-shadow','2px 2px 4px #888');
			$('#notification_slide').show();
			$('.user_notifications').show();
		} else {
			$('#notification_slide').hide();
			$('.user_notifications').hide();
		}
	});
	
	$('#follow_button_td').mouseenter(function(){
		text = $('#follow_button');
		if(text.html()=='Following'){
			text.html('Unfollow');
		}
	}).mouseleave(function(){
		text = $('#follow_button');
		if(text.html()=='Unfollow'){
			text.html('Following');
		}
	});
	//$('.test').append("<div class='test_2'></div>");
	
	$('.test_2').mouseenter(function(){
		$(this).css('border-bottom','23px solid #CCCCCC');
	}).mouseleave(function(){
		$(this).css('border-bottom','23px solid white');
	});
	function keyPress(e){
		var keyCode = (window.event) ? event.keyCode : event.which;
		switch(keyCode){
			case 13:			
				if($('.search_bar').is(":focus")){
					if($('#search_bar_top').is(":focus")){
						var top_search = $.trim($('#search_bar_top').val());
						alert('s');
						if(top_search != ''){
							$('#search_top_form').submit();
						}
					}
				}
				break;
			default:
				break;
		}
	}
	
	$('#search_button').click(function(){
		var search = $.trim($('#search_bar_long').val());
		if(search!=''){
			$('#search_form').submit();
		}
	});
	
	$('.search_nav').hide();
	$('#category_search_head').click(function(){
		search_options = $('.category_search');
		if(search_options.is(':visible')){
			search_options.slideUp();
			$('#search_options_laptops').slideUp();
			$('#search_options_games').slideUp();
			$('#search_options_phones').slideUp();
		} else {
			search_options.slideDown();
		}
	});
	$('#search_options_laptops').hide();
	$('#search_options_games').hide();
	$('#search_options_phones').hide();
	$('#laptops_search').click(function(){
		search_options = $('#search_options_laptops');
		$('#search_options_games').slideUp();
		$('#search_options_phones').slideUp();
		if(search_options.is(':visible')){
			search_options.slideUp();
		} else {
			search_options.slideDown();
		}
	});
	$('#games_search').click(function(){
		search_options = $('#search_options_games');
		$('#search_options_laptops').slideUp();
		$('#search_options_phones').slideUp();
		if(search_options.is(':visible')){
			search_options.slideUp();
		} else {
			search_options.slideDown();
		}
	});
	$('#phones_search').click(function(){
		search_options = $('#search_options_phones');
		$('#search_options_laptops').slideUp();
		$('#search_options_games').slideUp();
		if(search_options.is(':visible')){
			search_options.slideUp();
		} else {
			search_options.slideDown();
		}
	});
	
	
	$('#compare_search_head').click(function(){
		search_options = $('.compare_search');
		if(search_options.is(':visible')){
			search_options.slideUp();
			$('#search_options_laptops_compare').slideUp();
			$('#search_options_games_compare').slideUp();
			$('#search_options_phones_compare').slideUp();
		} else {
			search_options.slideDown();
		}
	});
	$('#search_options_laptops_compare').hide();
	$('#search_options_games_compare').hide();
	$('#search_options_phones_compare').hide();
	$('#laptops_search_compare').click(function(){
		search_options = $('#search_options_laptops_compare');
		$('#search_options_games_compare').slideUp();
		$('#search_options_phones_compare').slideUp();
		if(search_options.is(':visible')){
			search_options.slideUp();
		} else {
			search_options.slideDown();
		}
	});
	$('#games_search_compare').click(function(){
		search_options = $('#search_options_games_compare');
		$('#search_options_laptops_compare').slideUp();
		$('#search_options_phones_compare').slideUp();
		if(search_options.is(':visible')){
			search_options.slideUp();
		} else {
			search_options.slideDown();
		}
	});
	$('#phones_search_compare').click(function(){
		search_options = $('#search_options_phones_compare');
		$('#search_options_laptops_compare').slideUp();
		$('#search_options_games_compare').slideUp();
		if(search_options.is(':visible')){
			search_options.slideUp();
		} else {
			search_options.slideDown();
		}
	});
	var original;
	$('.login_link').mouseenter(function(){
		src = $(this).find('.login_link_2').attr('href');
		//alert(src);
		var pathname = window.location.pathname;
		var prev_page = pathname.replace('/website/','');
		var href = 'loginform.php?prev_page='+prev_page;
		src = 'loginform.php?prev_page='+src
		original = $(this).find('.login_link_2').html();
		$(this).find('.login_link_2').html("<span style='font-size:15px;'>You need to be logged in </span><a href='"+src+"-finish' class='link_login' style='font-size:18px;'>Log in</a>");
	}).mouseleave(function(){
		$(this).find('.login_link_2').html(original);
	});
		
	/*
	var original_2;
	$('.login_link').mouseenter(function(){
		original_2 = $(this).find('.login_link_2').html();
		var pathname = window.location.pathname;
		var prev_page = pathname.replace('/website/','');
		var href = 'loginform.php?prev_page='+prev_page;
		$(this).append("<div class='login_box'>You need to be logged in to"+original_2+ "</div>'");
		//$(this).find('.login_link_2').html('You need to login');
	}).mouseleave(function(){
		$(this).find('.login_link_2').html(original_2);
		$('.login_box').remove();
	});
	*/
	
});	
// _____________________________________________________________________________________________________________________________________________
function like_left(category, url){
	if ($('#left_normal').css('opacity') != 0.5){
		left_likes = $('#left_likes');
		left_likes_value = $('#left_likes').html();
		left_likes_value++;
		left_likes.html(left_likes_value);
		$('#right_normal').css('opacity','0.5');
		$('#left_normal').hide();
		$('#left_normal_liked').show();
		$.ajax({
		url: 'Incs/like-left.inc.php',
		data: {'category': category, 'url': url, 'total_likes': left_likes_value},
			success: function(data){
				left_likes.text(data);
			}
		});
	} else {
		left_likes = $('#left_likes');
		right_likes = $('#right_likes');
		left_likes.html("You have already liked this");
		right_likes.html("You have already liked this");
	}	
}
	
function like_right(category, url){
	if ($('#right_normal').css('opacity') != 0.5){
		right_likes = $('#right_likes');
		right_likes_value = $('#right_likes').html();
		right_likes_value++;
		right_likes.html(right_likes_value);
		$('#left_normal').css('opacity','0.5');
		$('#right_normal').hide();
		$('#right_normal_liked').show();
		$.ajax({
		url: 'Incs/like-right.inc.php',
		data: {'category': category, 'url': url, 'total_likes': right_likes_value},
			success: function(data){
				right_likes.text(data);
			}
		});
	} else {
		left_likes = $('#left_likes');
		right_likes = $('#right_likes');
		left_likes.html("You have already liked this");
		right_likes.html("You have already liked this");
	}
}

function already_liked(){
	left_likes = $('#left_likes');
	right_likes = $('#right_likes');
	left_likes.html("You have already liked this");
	right_likes.html("You have already liked this");
}

function Like_com(x, table_name, id){
	com_likes = $('#'+x+'comment_like');
	No_likes = $('#'+x+'comment_like').html();
	No_likes++;
	com_likes.text(No_likes);
	$.ajax({
	url: 'Incs/comlike.inc.php',
	data: {'table_name': table_name, 'comment_id': id, "likes": No_likes},
		success: function(data){
			com_likes.text(data);
		}
	});
}

function Dislike_com(x, table_name, id){
	com_dislikes = $('#'+x+'comment_dislike');
	No_dislikes = $('#'+x+'comment_dislike').html();
	No_dislikes++;
	com_dislikes.text(No_dislikes);
	$.ajax({
	url: 'Incs/comdislike.inc.php',
	data: {'table_name': table_name, 'comment_id': id, "dislikes": No_dislikes},
		success: function(data){
			com_likes.text(data);
		}
	});
}

function login(){
	username = $('#username_field').val();
	password = $('#password_field').val();
	$.ajax({
	url: 'Incs/comlike.inc.php',
	data: {'table_name': table_name, 'comment_id': id, "likes": No_likes},
		success: function(data){
			com_likes.text(data);
		}
	});
}

$('#logout_button').click(function(){
	$.ajax({
		type:'POST',
		url:'Incs/logout.inc.php',
		success: function(data){
			window.location.replace('index.php');
		}
	});
});

//Add_item
$('#divAddNameCheckTick').hide();
$('#trAddNameCheck').hide();
$('#add_Name').keyup(function(){
	newItem = $.trim($(this).val());
	category = $('#addCategory').val();
	$('#divAddNameCheckTick').hide();
	$('#trAddNameCheck').hide();
	if(newItem!=''){
		$.ajax({
		type: 'POST',
		url: 'Incs/AddItem/nameCheck.inc.php',
		data: {'name':newItem, 'category':category},
			success: function(data){
				if(data==1){
					$('#trAddNameCheck').hide();
					$('#divAddNameCheckTick').show();
				} else {
					$('#trAddNameCheck').show();
					$('#divAddNameCheckTablePossibilities').html(data);
				}
			}
		}); 
	} 
	if(newItem==''){
		$('#divAddNameCheck').text('');
	}
});