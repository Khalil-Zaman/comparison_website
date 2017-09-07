$(document).ready(function(){
	
	function add_container(x){
		var x_height = x.css('height');
		var x_width = x.css('width');
		$('#container_dp').css('height',x_height);
		$('#container_dp').css('width',x_width);
		$('#back_cover').css('width',x_width);
		$('#back_cover').css('height',x_height);
		$('#back_cover').css('background-color','white');
		$('#img_chosen').css('clip','rect(0px 101px 101px 0px)');
	}
	$('#selector').hide();
	$('#dp_display_conatiner').hide();
	var URL = window.URL || window.webkitURL;
    var input = document.querySelector('#change_pic_profile');
	var preview = document.querySelector('#img_chosen');
	var background = document.querySelector('#img_chosen_back');
	var profile_display = document.querySelector('#profile_display');
	var unchanged_pic = document.querySelector('#unchanged_pic');
    
    // When the file input changes, create a object URL around the file.
    input.addEventListener('change', function () {
        preview.src = URL.createObjectURL(this.files[0]);
        background.src = URL.createObjectURL(this.files[0]);
        profile_display.src = URL.createObjectURL(this.files[0]);
        unchanged_pic.src = URL.createObjectURL(this.files[0]);
    });
    
	var img_height;
	var img_width;
    // When the image loads, release object URL
    preview.addEventListener('load', function () {
        URL.revokeObjectURL(this.src);
        alert('jQuery code here. W: ' + this.width + ', H: ' + this.height);
		img_height = this.height;
		img_width = this.width;
		add_container($('#img_chosen_back'));
		$('#selector').show();
    });
	
	var selector_x1;
	var selector_y1;
	var selector_x2;
	var selector_y2;
	var x1;
	var y1;
	var x2;
	var y2;
	var img = $('#img_chosen').offset();
	var img_top = (img.top);
	var img_left =(img.left);
	var test;
	
	function main(selector){
		$('#dp_display_conatiner').show();
		offset = selector.offset();
		selector_x1 = offset.left; // LEFT X CO-ORDINATE
		selector_y1 = offset.top; // TOP Y CO-ORDINATE
		selector_x2 = selector_x1 + selector.width(); // RIGHT X CO-ORDINATE
		selector_y2 = selector_y1 + selector.height(); // BOTTOM Y CO-ORDINATE
		x1 = ((selector_x1 - img_left) - 375)+(($('#img_chosen_back').width())/2);
		x2 = ((selector_x2 - img_left) - 375)+(($('#img_chosen_back').width())/2);
		y1 = selector_y1 - img_top;
		y2 = selector_y2 - img_top;
		// $('#posY').text('y: ' + selector_y1 + ' y2: ' + selector_y2);
		//$('#posX').text('x: ' + selector_x1 + ' x2: ' + selector_x2 + ' X1: ' +	x1);
		$('#img_chosen').css('clip','rect('+y1+'px '+(x2+1)+'px '+(y2+1)+'px '+x1+'px)'); 
		dp_Cont_Height = parseInt($('#dp_display_conatiner').css('height'),10);
		dp_Cont_Width = parseInt($('#dp_display_conatiner').css('width'),10);
		percent_height = ((((dp_Cont_Height / (y2-y1))*($('#img_chosen_back').height()))/dp_Cont_Height)*100);
		percent_width = ((((dp_Cont_Width / (x2-x1))*($('#img_chosen_back').width()))/dp_Cont_Width)*100);
		$('#profile_display').css('height',percent_height+'%');
		$('#profile_display').css('width',percent_width+'%');
		dp_Cont_Height = parseInt($('#profile_display').css('height'),10);
		dp_Cont_Width = parseInt($('#profile_display').css('width'),10);
		new_perc_height = (dp_Cont_Height/img_height);
		new_perc_width = (dp_Cont_Width/img_width);
		margin_top = (y1 * new_perc_height);
		margin_left = (x1 * new_perc_width);
		$('#profile_display').css('margin-left','-'+margin_left+'px');
		$('#profile_display').css('margin-top','-'+margin_top+'px');
		x1_magnified = (x1 * new_perc_width);
		x2_magnified = (x2 * new_perc_width);
		y1_magnified = (y1 * new_perc_height);
		y2_magnified = (y2 * new_perc_height);
		$('#profile_display').css('clip','rect('+y1_magnified+'px '+(x2_magnified+1)+'px '+(y2_magnified)+'px '+x1_magnified+'px)');
	}
	
	var stop_scrolling = 0;
	$( "#selector" ).draggable({
		containment:$('#img_chosen_back'),
		drag:function(){
			main($('#selector'));
			if(stop_scrolling==0){
				window.scrollTo(0,0);
			}
		},
		stop:function(){
			main($('#selector'));
		}
	}).resizable({
		containment:'parent',
		minWidth:50,
		minHeight:50,
		handles: 'n, e, s, w',
		resize:function(){
			main($('#selector'));
			stop_scrolling = 1;
		},
		aspectRatio:true
	});
});

function pic_change(){
	var element = $("#selector");
	var img = $('#img_chosen').offset();
	var img_top = (img.top);
	var img_left =(img.left);
	offset = element.offset();
	selector_x1 = offset.left;
	selector_y1 = offset.top;
	selector_x2 = selector_x1 + element.width();
	selector_y2 = selector_y1 + element.height();
	x1 = selector_x1 - img_left;
	x2 = selector_x2 - img_left;
	y1 = selector_y1 - img_top;
	y2 = selector_y2 - img_top;
	//alert(x1+' '+x2+' '+y1+' '+y2);
	img_height = $('#img_chosen').height();
	img_width = $('#img_chosen').width();
	dp_Cont_Height = parseInt($('#profile_display').css('height'),10);
	dp_Cont_Width = parseInt($('#profile_display').css('width'),10);
	new_perc_height = (dp_Cont_Height/img_height);
	new_perc_width = (dp_Cont_Width/img_width);
	x1_magnified = (x1 * new_perc_width);
	x2_magnified = (x2 * new_perc_width);
	y1_magnified = (y1 * new_perc_height);
	y2_magnified = (y2 * new_perc_height);
	$('#profile_display').css('clip','rect('+y1_magnified+'px '+(x2_magnified+1)+'px '+(y2_magnified+1)+'px '+x1_magnified+'px)'); 
	img_height_real = $('#unchanged_pic').height();
	img_width_real = $('#unchanged_pic').width();
	magnify_x = (img_width_real/img_width);
	magnify_y =(img_height_real/img_height);
	x1 = magnify_x*x1;
	x2 = magnify_x*x2;
	y1 = magnify_y*y1;
	y2 = magnify_y*y2;
	$.ajax({
		url: 'Incs/User/ManageAccount/manage_account_profile_upd.inc.php',
		type:'POST',
		data: {'x1': x1,'x2': x2, "y1":y1, 'y2':y2, 'img_height':img_height,'img_width':img_width},
		success: function(data){
			$('#dp_pic_form').submit();
		}
	});
}