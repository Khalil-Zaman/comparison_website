$(document).keyup(function (event) {	
	switch(event.keyCode){
		case 39: //RIGHT
			var no = 0;
			var check = 0;
			$('.image_showing_more_pics').each(function(){
				if(no==1){
					$('.image_showing_more_pics').hide();
					$(this).show();
					no = 0;
					check = 1;
					$('.more_pic_likes').hide();
				}
				if(($(this).is(":visible"))&&(check != 1)){
					no = 1;
				}
			});
			if(check != 1){
				$('.image_showing_more_pics').hide();
				$('#first_more_pics').show();
			}
			
			
			var no = 0;
			var check = 0;
			$('.pics_of_item').each(function(){
				if(no==1){
					$(this).css('border','1px solid red');
					no = 0;
					check = 1;
				}
				border = $(this).css('border');
				if((border=="1px solid rgb(255, 0, 0)")&&(check!=1)){
					$(this).css('border','1px solid #CCCCCC');
					no = 1;
				} 
			});
			if(check != 1){
				$('#first_one').css('border','1px solid red');
			}
			$('.more_pic_likes').css('opacity','0');
			$('.image_showing_more_pics').each(function(){
				if(($(this).is(":visible"))){
					$(this).next('.more_pic_likes').show().css('opacity','0');;
				} else {
					$(this).next('.more_pic_likes').hide();
				}
			});
			break;
		case 37: //LEFT
			var no = 0;
			var check = 0;
			$($('.image_showing_more_pics').get().reverse()).each(function(){
				if(no==1){
					$('.image_showing_more_pics').hide();
					$(this).show();
					no = 0;
					check = 1;
				}
				if(($(this).is(":visible"))&&(check != 1)){
					no = 1;
				}
			});
			if(check != 1){
				$('.image_showing_more_pics').hide();
				$('#last_more_pics').show();
			}
			
			
			var no = 0;
			var check = 0;
			$($('.pics_of_item').get().reverse()).each(function(){
				if(no==1){
					$(this).css('border','1px solid red');
					no = 0;
					check = 1;
				}
				border = $(this).css('border');
				if((border=="1px solid rgb(255, 0, 0)")&&(check!=1)){
					$(this).css('border','1px solid #CCCCCC');
					no = 1;
				} 
			});
			if(check != 1){
				$('#last_one').css('border','1px solid red');
			}
			$('.more_pic_likes').css('opacity','0');
			$('.image_showing_more_pics').each(function(){
				if(($(this).is(":visible"))){
					$(this).next('.more_pic_likes').show().css('opacity','0');;
				} else {
					$(this).next('.more_pic_likes').hide();
				}
			});
			break;
		case 13:
			if($('.edit_input').is(":focus")){
				$('#details_changes_form').submit();
			}
			if($('.edit_source_input').is(":focus")){
				$('#details_changes_form').submit();
			}
			break;
		default:
			break;
	}
});

$(document).ready(function(){
	$('.image_showing_more_pics').hide();
	$('#first_more_pics').show();
	$('#detail_pic').show();
	$('#add_pic_table').hide();
	$('#first_one').css('border','1px solid red');
	$('.more_pic_likes').hide();
	$('.more_pic_likes').hide();
	$('.details_options').hide();
	$('.details_edit_edits').hide();
	$('.personal_edit_inputs').hide();
	$('.more_pic_likes').hide();
	
	$('#detail_info_tr').show();
	$('#detail_comparisons_tr').hide();
	$('#detail_reviews_tr').hide();
	$('#detail_buy_tr').hide();
	review_show = $('#review_show').val();
	buy_show = $('#buy_show').val();
	if(review_show=='1'){ // Show specific reviews if page URL has reviews
		$('#detail_info_tr').hide();
		$('#detail_comparisons_tr').hide();
		$('#detail_reviews_tr').show();
		$('#detail_buy_tr').hide();
		
		$('#detail_info').css('background-color','#E9E9E9');
		$('#detail_review').css('background-color','#D3D3D3');
		$('#detail_comparisons').css('background-color','#E9E9E9');
		$('#detail_buy').css('background-color','#E9E9E9');
	} else {
		$('#detail_info').css('background-color','#D3D3D3');
		$('#detail_review').css('background-color','#E9E9E9');
		$('#detail_comparisons').css('background-color','#E9E9E9');
		$('#detail_buy').css('background-color','#E9E9E9');
	}
	if(buy_show=='1'){ // Show specific reviews if page URL has reviews
		$('#detail_info_tr').hide();
		$('#detail_comparisons_tr').hide();
		$('#detail_reviews_tr').hide();
		$('#detail_buy_tr').show();
		
		$('#detail_info').css('background-color','#E9E9E9');
		$('#detail_review').css('background-color','#E9E9E9');
		$('#detail_comparisons').css('background-color','#E9E9E9');
		$('#detail_buy').css('background-color','#D3D3D3');
	} else {
		$('#detail_info').css('background-color','#D3D3D3');
		$('#detail_review').css('background-color','#E9E9E9');
		$('#detail_comparisons').css('background-color','#E9E9E9');
		$('#detail_buy').css('background-color','#E9E9E9');
	}
	
	$('.image_showing_more_pics').each(function(){
		if(($(this).is(":visible"))){
			$(this).next('.more_pic_likes').show().css('opacity','0');
		} else {
			$(this).next('.more_pic_likes').hide();
		}
	});
});

$('.review_section_post').hide();
$('#post_review_button').click(function(){
	$('.review_section_post').show();
	$(this).hide();
	$('.review_scroll').css('height','90');
});
$('.review_section_up').click(function(){
	$('.review_scroll').css('height','320');
	$('.review_section_post').hide();
	$('#post_review_button').show();
});

$('.image_showing_more_pics').mouseenter(function(){
	$(this).next('.more_pic_likes').show().css('opacity','0.9');
}).mouseleave(function(){
	$('.more_pic_likes').css('opacity','0');
});

$('.more_pic_likes').mouseenter(function(){
	$('.more_pic_likes').each(function(){
		var par = $(this).prev().find('#detail_pic');
		if(par.is(':visible')){
			$(this).css('opacity','0.9');
		}
	});
}).mouseleave(function(){
	$(this).css('opacity','0');
});



$('#detail_info').click(function(){
	$('.details_options').hide();
	$('#detail_info_tr').show();
	$('#detail_reviews_tr').hide();
	$('#detail_comparisons_tr').hide();
	$('#detail_buy_tr').hide();

	$('#detail_info').css('background-color','#D3D3D3');
	$('#detail_review').css('background-color','#E9E9E9');
	$('#detail_comparisons').css('background-color','#E9E9E9');
	$('#detail_buy').css('background-color','#E9E9E9');
});
$('#detail_review').click(function(){
	$('#detail_info_tr').hide();
	$('#detail_reviews_tr').show();
	$('#detail_comparisons_tr').hide();
	$('#detail_buy_tr').hide();

	$('#detail_info').css('background-color','#E9E9E9');
	$('#detail_review').css('background-color','#D3D3D3');
	$('#detail_comparisons').css('background-color','#E9E9E9');
	$('#detail_buy').css('background-color','#E9E9E9');
});
$('#detail_comparisons').click(function(){
	$('#detail_info_tr').hide();
	$('#detail_reviews_tr').hide();
	$('#detail_comparisons_tr').show();
	$('#detail_buy_tr').hide();

	$('#detail_info').css('background-color','#E9E9E9');
	$('#detail_review').css('background-color','#E9E9E9');
	$('#detail_comparisons').css('background-color','#D3D3D3');
	$('#detail_buy').css('background-color','#E9E9E9');
});
$('#detail_buy').click(function(){
	$('#detail_info_tr').hide();
	$('#detail_reviews_tr').hide();
	$('#detail_comparisons_tr').hide();
	$('#detail_buy_tr').show();

	$('#detail_info').css('background-color','#E9E9E9');
	$('#detail_review').css('background-color','#E9E9E9');
	$('#detail_comparisons').css('background-color','#E9E9E9');
	$('#detail_buy').css('background-color','#D3D3D3');
});



$("#add_another_photo").click(function(){
	$('#add_pic_table').show();
});
$('.details_row').mouseenter(function(){
	$(this).find('.details_options').show().css('opacity','0.7');
}).mouseleave(function(){
	$(this).find('.details_options').hide();
});
$('.review_row').mouseenter(function(){
	$(this).find('.details_options').show().css('opacity','0.7');
	this_one = $(this);
	$('.review_row').each(function(){
		$(this).find('.review_given').attr('colspan','6');
	});
	this_one.find('.review_given').attr('colspan','1');
}).mouseleave(function(){
	$(this).find('.details_options').hide();
});

$('.details_edit').click(function(){
	$('.details_edit_edits').hide();
	$(this).parent().parent().next().show();
	if($(this).parent().parent().next().next().length == 0){
		$(this).parent().parent().css('border-bottom','1px solid #CCCCCC');
	}
});

$('.edits_up').click(function(){
	$(this).parent().parent().parent().parent().parent().parent().hide();
	if ($(this).parent().parent().parent().parent().parent().parent().next().length == 0){
		$(this).parent().parent().parent().parent().parent().parent().prev().css('border-bottom','0');
	}
});

$('.pics_of_item').click(function(){
	$('.pics_of_item').css('border','1px solid #CCCCCC');
	$(this).css('border','1px solid red');
	var new_src = $(this).find('img').attr('src');
	//$('#detail_pic').attr('src',new_src);
	var no = 0;
	var large_pic_src = 0;
	var check = 0;
	$('.image_showing_more_pics').each(function(){
		large_pic_src = ($(this).find('.pics').attr('src'));
		if(large_pic_src==new_src){
			$('.image_showing_more_pics').hide();
			$(this).show();
		}
	});
});

$('#add_pic_up').click(function(){
	$('#add_pic_table').hide();
});

$('.img_hover').mouseenter(function(){
	alert('s');
});

$('.edit_button').click(function(){
	$(this).hide();
	alert('s');
});
$('.submit_changes').click(function(){
	$('#details_changes_form').submit();
});
$('.personal_edit').click(function(){
	$(this).parent().hide();
	$(this).parent().next().show();
	$(this).parent().next().next().show();
});
$('.edit_section_up').click(function(){
	$(this).parent().parent().hide();
	$(this).parent().parent().prev().hide();
	$(this).parent().parent().prev().prev().show();
});


var number;
$('.need_login').click(function(){
	number = $(this).parent().parent().next().html();
	$(this).parent().parent().next().html('You need to be logged in');	
}).mouseleave(function(){
	$(this).parent().parent().next().html(number);
});

var number;
$('.need_loginReview').click(function(){
	number = $(this).parent().next().html();
	$(this).parent().next().html('You need to be logged in');
})
$('.review_given').mouseleave(function(){
	$(this).find('.need_loginReview').parent().next().html(number);
});
// .mouseleave(function(){	$(this).parent().next().delay(1000).html(number);	});


$('.thumb_up_image').each(function(){
	$(this).next().hide();
});
$('.already_liked_before').hide().each(function(){
	$(this).next().show();
});
$('.already_liked').click(function(){
	this_one = $(this);
	img = $(this).parent().parent().parent().parent().parent().parent().prev().find('#detail_pic').attr('src');
	id = $('#choice_id').val();
	name = $('#choice_name').val();
	category = $('#choice_category').val();
	likes_place = $(this).parent().next();
	likes = $(this).parent().next().html();
	likes--;
	likes_place.html(likes);
	this_one.hide();
	this_one.prev().show();
	img = img.replace('Pictures/'+category+'/','');
	$.ajax({
		type:'POST',
		url:'Incs/Details/details_pic_unlike.inc.php',
		data: {'id':id,'name':name,'category':category, 'pic_name':img},
		success: function(data){
		}
	});
});
$('.thumb_up_image').click(function(){
	this_one = $(this);
	img = $(this).parent().parent().parent().parent().parent().parent().parent().prev().find('#detail_pic').attr('src');
	id = $('#choice_id').val();
	name = $('#choice_name').val();
	category = $('#choice_category').val();
	likes_place = $(this).parent().parent().next();
	likes = $(this).parent().parent().next().html();
	likes++;
	likes_place.html(likes);
	this_one.hide();
	this_one.next().show();
	img = img.replace('Pictures/'+category+'/','');
	check_visibility = $(this).parent().parent().next().next().find('.already_disliked');
	if(check_visibility.is(":visible")){
		check_visibility.hide().prev().show();
		dislikes = check_visibility.parent().next().html();
		dislikes--;
		check_visibility.parent().parent().next().html(dislikes);
	}
	$.ajax({
		type:'POST',
		url:'Incs/Details/details_pic_like.inc.php',
		data: {'id':id,'name':name,'category':category, 'pic_name':img},
		success: function(data){
		}
	});
});

$('.thumb_down_image').each(function(){
	$(this).next().hide();
});
$('.already_disliked_before').hide().each(function(){
	$(this).next().show();
});
$('.already_disliked').click(function(){
	this_one = $(this);
	img = $(this).parent().parent().parent().parent().parent().parent().prev().find('#detail_pic').attr('src');
	id = $('#choice_id').val();
	name = $('#choice_name').val();
	category = $('#choice_category').val();
	dislikes_place = $(this).parent().next();
	dislikes = $(this).parent().next().html();
	dislikes--;
	dislikes_place.html(dislikes);
	this_one.hide();
	this_one.prev().show();
	img = img.replace('Pictures/'+category+'/','');
	$.ajax({
		type:'POST',
		url:'Incs/Details/details_pic_undislike.inc.php',
		data: {'id':id,'name':name,'category':category, 'pic_name':img},
		success: function(data){
		}
	});
});
$('.thumb_down_image').click(function(){
	this_one = $(this);
	img = $(this).parent().parent().parent().parent().parent().parent().prev().find('#detail_pic').attr('src');
	id = $('#choice_id').val();
	name = $('#choice_name').val();
	category = $('#choice_category').val();
	dislikes_place = $(this).parent().next();
	dislikes = $(this).parent().next().html();
	dislikes++;
	dislikes_place.html(dislikes);
	this_one.hide();
	this_one.next().show();
	img = img.replace('Pictures/'+category+'/','');
	check_visibility = $(this).parent().prev().prev().find('.already_liked');
	if(check_visibility.is(":visible")){
		check_visibility.hide().prev().show();
		likes = check_visibility.parent().next().html();
		likes--;
		check_visibility.parent().next().html(likes);
	}	
	$.ajax({
		type:'POST',
		url:'Incs/Details/details_pic_dislike.inc.php',
		data: {'id':id,'name':name,'category':category, 'pic_name':img},
		success: function(data){
		}
	});
}); 

$('.flag_image').each(function(){
	$(this).next().hide();
});
$('.already_flagged_before').hide().each(function(){
	$(this).next().show();
});

$('.thumb_up_review').each(function(){
	$(this).next().hide();
});
$('.already_liked_before_review').hide().each(function(){
	$(this).next().show();
});
$('.already_liked_review').click(function(){
	this_one = $(this);
	item_id = $('#choice_id').val();
	category = $('#choice_category').val();
	review_id = $(this).parent().parent().parent().parent().parent().find('.review_id').val();
	likes_place = $(this).parent().next();
	likes = $(this).parent().next().html();
	likes--;
	likes_place.html(likes);
	this_one.hide().prev().show();
	$.ajax({
		type:'POST',
		url:'Incs/Details/details_unlike_review.inc.php',
		data: {'item_id':item_id, 'category':category, 'review_id':review_id},
		success: function(data){
		}
	});
});
$('.thumb_up_review').click(function(){
	this_one = $(this);
	item_id = $('#choice_id').val();
	category = $('#choice_category').val();
	review_id = $(this).parent().parent().parent().parent().parent().find('.review_id').val();
	likes_place = $(this).parent().next();
	likes = $(this).parent().next().html();
	likes++;
	likes_place.html(likes);
	this_one.hide().next().show();
	check_visibility = $(this).parent().next().next().find('.already_disliked_review');
	if(check_visibility.is(":visible")){
		check_visibility.hide().prev().show();
		dislikes = check_visibility.parent().next().html();
		dislikes--;
		check_visibility.parent().next().html(dislikes);
	}
	$.ajax({
		type:'POST',
		url:'Incs/Details/details_like_review.inc.php',
		data: {'item_id':item_id, 'category':category, 'review_id':review_id},
		success: function(data){
			alert(data);
		}
	});
});

$('.thumb_down_review').each(function(){
	$(this).next().hide();
});
$('.already_disliked_before_review').hide().each(function(){
	$(this).next().show();
});

$('.flag_image_review').each(function(){
	$(this).next().hide();
});
$('.already_flagged_before_review').hide().each(function(){
	$(this).next().show();
});
$('.already_flagged_review').click(function(){
	this_one = $(this);
	item_id = $('#choice_id').val();
	category = $('#choice_category').val();
	review_id = $(this).parent().parent().parent().parent().parent().parent().find('.review_id').val();
	this_one.hide();
	this_one.prev().show();
	$.ajax({
		type:'POST',
		url:'Incs/Details/details_unflag_review.inc.php',
		data: {'item_id':item_id, 'category':category, 'review_id':review_id},
		success: function(data){
		}
	});
});
$('.flag_image_review').click(function(){
	this_one = $(this);
	item_id = $('#choice_id').val();
	category = $('#choice_category').val();
	review_id = $(this).parent().parent().parent().parent().parent().parent().find('.review_id').val();
	this_one.hide();
	this_one.next().show();
	$.ajax({
		type:'POST',
		url:'Incs/Details/details_flag_review.inc.php',
		data: {'item_id':item_id, 'category':category, 'review_id':review_id},
		success: function(data){
			alert(data);
		}
	});
});