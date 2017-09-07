var NameCheck;
$(document).ready(function(){
	$('.item_details').hide();	
	$('#closeVerifyInfo').click(function(){
		$(this).parent().remove();
		$('.alreadyVerified').css('opacity','0.1');
	});

	$('#loadingVerify').hide();
	
	var originalInput;
	var adminInput;
	$('.verifyInputWrapper').click(function(){
		if($(this).find('.originalInput').length == 0){
			input = originalInput = $.trim($(this).find('.verifyTheInput').html());
		} else {
			originalInput = $.trim($(this).find('.originalInput').html());
			input = $.trim($(this).find('.verifyTheInput').html());
		}
		if($(this).find('.inputChangeVerify').length == 0){
			$(this).html("<input value='"+input+"' type='text' class='inputChangeVerify' id='change'/><div class='originalInput'>  "+originalInput+"</div>");
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
							$('#change').parent().empty().html(
							"<div class='verifyInputWrapper'>"+
							"<div class='verifyTheInput'>"+adminInput+"</div>"+
							"<div class='originalInput'>"+originalInput+"</div></div>").css('color','red');
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
});