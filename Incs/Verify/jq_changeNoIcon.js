$('document').ready(function(){
	var changeIconSrc1 = $('#img_chosen_icon').attr('src');

	var URL = window.URL || window.webkitURL;
   
	var input_icon = document.querySelector('#add_icon_name');
	var preview_icon = document.querySelector('#img_chosen_icon');
	var previewBig_icon = document.querySelector('#img_chosen_iconBig');
    	
	input_icon.addEventListener('change', function () {
        preview_icon.src = URL.createObjectURL(this.files[0]);
        previewBig_icon.src = URL.createObjectURL(this.files[0]);
    });
	
	preview_icon.addEventListener('load', function () {
        URL.revokeObjectURL(this.src);
    });
	
	previewBig_icon.addEventListener('load', function () {
        URL.revokeObjectURL(this.src);
		$('#changeIcon1').css('display','none');
		$('#changeIcon2').css('display','inline');
    });
		
	//ICON IMAGES GAMES
	$('#changeImgIcon1').click(function(){
		$('#changeIcon1').css('display','inline');
		$('#changeIcon2').css('display','none');
	});
	$('#img_chosen_icon').click(function(){
		changeIconSrc2 = $('#img_chosen_icon').attr('src');
		if(changeIconSrc2!=changeIconSrc1){
			$('#changeIcon1').css('display','none');
			$('#changeIcon2').css('display','inline');
		}
	});
	$('.changeSmallIconHighlight').click(function(){
		changeIconSrc2 = $('#img_chosen_icon').attr('src');
		if(changeIconSrc2!=changeIconSrc1){
			$('.changeSmallIconHighlight').css('background-color','transparent');
			$(this).css('background-color','#868686');
		}
	});
	
	$('.input_add').focusout(function(){
		id = $(this).attr('id');
		input = $(this).val();
		$('#display_'+id).html(input);
	});
	
	// CHANGING INFORMATION FROM THE PUBLIC
	var originalInput;
	var adminInput;
	$('.verifyInputWrapper').click(function(){
		if($(this).find('.originalInput').length == 0){
			input = originalInput = $.trim($(this).find('.verifyTheInput').html());
		} else {
			originalInput = $.trim($(this).find('.originalInput').html());
			input = $.trim($(this).find('.verifyTheInput').html());
		}
		input = input.replace("'","\'");
		if($(this).find('.inputChangeVerify').length == 0){
			$(this).html('<input value="'+input+'" type="text" class="inputChangeVerify" id="change"/><div class="originalInput">  '+originalInput+'</div>');
			field = $.trim($(this).parent().prev().html());
			AlertField = "Name";
			if(field==AlertField){
				NameCheck = "1";
			}
		}		
	});
	$(document).keyup(function (event) {
		switch(event.keyCode){
			case 13:
				if($('.inputChangeVerify').is(":focus")){
					adminInput = $.trim($('#change').val());
					originalInput = $.trim($('#change').parent().find('.originalInput').html());
					if(adminInput != ''){
						if(adminInput == originalInput){
							$('#change').parent().empty().html("<div class='verifyTheInput'>"+originalInput+"</div>");
						} else {
							ifAexists = $('#change').parent().parent().prev().find('a');
							NameCheck = "Name";
							ifNameExists = "";
							ifNameExists = $.trim($("#change").parent().parent().parent().parent().parent().parent().prev().find("#verifyNameChanger").html());
							if(ifAexists.length){
								field = ifAexists.html();
							} else if(ifNameExists==NameCheck) {
								field = "Name";
							} else {
								field = $('#change').parent().parent().prev().find('div').html();
							}
							$('#change').parent().empty().html(
							"<div class='verifyInputWrapper'>"+
							"<div class='verifyTheInput'>"+adminInput+"</div>"+
							"<div class='originalInput'>"+originalInput+"</div></div>").css('color','red');
							changes = $('#changes').html();
							$('#changes').html(changes + "FIELD" + field + "-"+adminInput+"END");
							$('.originalInput').css('color','black');
						}
					} else {
						$('#change').parent().empty().html("<div class='verifyTheInput'>"+originalInput+"</div>");
					}
				}
				break;
			default:
				break;
		}
	});
	
	$('.delete').click(function(){
		category = $('#verifyCategory').val();
		id = $('#verifyId').val();
		this_verify = $(this);
		$.ajax({
			type:'POST',
			url:'Incs/Verify/delete.inc.php',
			data: {'category':category, 'id':id},
			success: function(data){
				$('#divVerifyErrors').html(data);
			}
		});
	});
	
	$('.verify').click(function(){
		category = $('#verifyCategory').val();
		id = $('#verifyId').val();
		changes = $('#changes').html();
		this_verify = $(this);
		$.ajax({
			type:'POST',
			url:'Incs/Verify/verify.inc.php',
			data: {'category':category, 'id':id, 'changes':changes},
			success: function(data){
				if(data=="Success"){
					$('#divVerifyErrors').html('<span style="color:green;"'+data+'</span>');
				} else {
					$('#divVerifyErrors').html(data);
				}
			}
		});
	});	
});