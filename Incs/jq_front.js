//var backColor = 'rgb(255, 165, 0)';
//var backColor = 'rgb(221, 84, 84)';
var backColor = 'rgb(255, 64, 64)';
var loopTime = 5000;
$('document').ready(function(){
	
	$('.front_top_comp').hide();
	$('#game_top_1').show();
	$('#game_top_1').show();
	
	var colNo, nextColNo, dpRow = 1, stop=2, hover_stop = 0;
	$('.comp_dp').hide();
	$('#game_top_dp_1').show();
	//$('#column_1').css('background-color','#CCCCCC');
	$('#column_1').css('background-color',backColor);
	$('#game_top_dp_2').show();
	$('#game_top_dp_3').show();
	
	function intervalLoop(){
		$('.comp_cols').each(function(){
			colBackgroundColor = $(this).css('background-color');
			if(colBackgroundColor==backColor){
				colNo = ($(this).index())+1;
				if(colNo==3){
					nextColNo = 1;
					if(dpRow==7){
						dpRow=1;
						$('.comp_dp').hide();
						$('#game_top_dp_'+dpRow).show();
						$('#game_top_dp_'+(dpRow+1)).show();
						$('#game_top_dp_'+(dpRow+2)).show();
					} else {
						dpRow = dpRow + 3;
						$('.comp_dp').hide();
						$('#game_top_dp_'+dpRow).show();
						$('#game_top_dp_'+(dpRow+1)).show();
						$('#game_top_dp_'+(dpRow+2)).show();
					}
				} else {
					nextColNo = colNo + 1;
				}
			}
		});
		$('.comp_cols').css('background-color','white');
		$('#column_'+nextColNo).css('background-color',backColor);
		$('.front_top_comp').hide();
		$('#game_top_'+((nextColNo+dpRow)-1)).show();
		//	alert(nextColNo + " " + dpRow);
		currentComp(nextColNo, dpRow);
	}
	
	var slideShow = setInterval(intervalLoop,loopTime);
	
	var startSlide = setInterval(function(){
		if(hover_stop==0){
			if(stop == 0){
				slideShow = setInterval(intervalLoop,loopTime);
				stop = 2;
			}
			if(stop==1){
				stop = 0;
			}
		}
	},loopTime);
	
	$('#showing_comparison, #column_1, #column_2, #column_3').mouseenter(function(){
		clearInterval(slideShow);
		hover_stop = 1;
		//$('#showing_comparison').css('background-color','#CCCCCC');
		$('#showing_comparison').css('background-color',backColor);
	}).mouseleave(function(){
		stop = 0;
		hover_stop = 0;
		$('#showing_comparison').css('background-color','white');
	});
	
	$('.comp_cols').mouseenter(function(){
		$('.comp_cols').css('background-color','white');
		//$(this).css('background-color','#CCCCCC');
		$(this).css('background-color',backColor);
		colNo = ($(this).index());
		$('.front_top_comp').hide();
		$('#game_top_'+((colNo+dpRow))).show();
		currentComp(colNo+1, dpRow);
	});

	$('#next_sliding').click(function(){
		$('.comp_cols').each(function(){
			colBackgroundColor = $(this).css('background-color');
			if(colBackgroundColor==backColor){
				colNo = ($(this).index())+1;
				if(dpRow==7){
					dpRow=1;
					$('.comp_dp').hide();
					$('#game_top_dp_'+dpRow).show();
					$('#game_top_dp_'+(dpRow+1)).show();
					$('#game_top_dp_'+(dpRow+2)).show();
				} else {
					dpRow = dpRow + 3;
					$('.comp_dp').hide();
					$('#game_top_dp_'+dpRow).show();
					$('#game_top_dp_'+(dpRow+1)).show();
					$('#game_top_dp_'+(dpRow+2)).show();
				}
			}
		});
		$('.comp_cols').css('background-color','white');
		$('#column_'+colNo).css('background-color',backColor);
		$('.front_top_comp').hide();
		$('#game_top_'+((nextColNo+dpRow)-1)).show();
		currentComp(nextColNo, dpRow);
	});
	
	$('#back_sliding').click(function(){
		$('.comp_cols').each(function(){
			colBackgroundColor = $(this).css('background-color');
			if(colBackgroundColor==backColor){
				colNo = ($(this).index())+1;
				if(dpRow==1){
					dpRow=7;
					$('.comp_dp').hide();
					$('#game_top_dp_'+dpRow).show();
					$('#game_top_dp_'+(dpRow+1)).show();
					$('#game_top_dp_'+(dpRow+2)).show();
				} else {
					dpRow = dpRow - 3;
					$('.comp_dp').hide();
					$('#game_top_dp_'+dpRow).show();
					$('#game_top_dp_'+(dpRow+1)).show();
					$('#game_top_dp_'+(dpRow+2)).show();
				}
			}
		});
		$('.comp_cols').css('background-color','white');
		$('#column_'+colNo).css('background-color',backColor);
		$('.front_top_comp').hide();
		$('#game_top_'+((nextColNo+dpRow)-1)).show();
		currentComp(colNo, dpRow);
	});
	
	function currentComp(col, row){
		$('#current_comp_id').html(col+row-1);
	}
	
	$(document).keyup(function (event) {
	switch(event.keyCode){
		case 39: //RIGHT
			clearInterval(slideShow);
			$('.comp_cols').each(function(){
				colBackgroundColor = $(this).css('background-color');
				//if(colBackgroundColor=='rgb(204, 204, 204)'){
				if(colBackgroundColor==backColor){
					colNo = ($(this).index())+1;
					if(colNo==3){
						nextColNo = 1;
						if(dpRow==7){
							dpRow=1;
							$('.comp_dp').hide();
							$('#game_top_dp_'+dpRow).show();
							$('#game_top_dp_'+(dpRow+1)).show();
							$('#game_top_dp_'+(dpRow+2)).show();
						} else {
							dpRow = dpRow + 3;
							$('.comp_dp').hide();
							$('#game_top_dp_'+dpRow).show();
							$('#game_top_dp_'+(dpRow+1)).show();
							$('#game_top_dp_'+(dpRow+2)).show();
						}
					} else {
						nextColNo = colNo + 1;
					}
				}
			});
			$('.comp_cols').css('background-color','white');
			//$('#column_'+nextColNo).css('background-color','#CCCCCC');
			$('#column_'+nextColNo).css('background-color',backColor);
			$('.front_top_comp').hide();
			$('#game_top_'+((nextColNo+dpRow)-1)).show();
			currentComp(nextColNo, dpRow);
			stop = 1;
			break;
		case 37: //LEFT
			clearInterval(slideShow);
			$('.comp_cols').each(function(){
				colBackgroundColor = $(this).css('background-color');
				//colBackgroundColor = $(this).css('border');
				//if(colBackgroundColor=='rgb(204, 204, 204)'){
				if(colBackgroundColor==backColor){
					colNo = ($(this).index())+1;
					if(colNo==1){
						nextColNo = 3;
						if(dpRow==1){
							dpRow=7;
							$('.comp_dp').hide();
							$('#game_top_dp_'+dpRow).show();
							$('#game_top_dp_'+(dpRow+1)).show();
							$('#game_top_dp_'+(dpRow+2)).show();
						} else {
							dpRow = dpRow - 3;
							$('.comp_dp').hide();
							$('#game_top_dp_'+dpRow).show();
							$('#game_top_dp_'+(dpRow+1)).show();
							$('#game_top_dp_'+(dpRow+2)).show();
						}
					} else {
						nextColNo = colNo - 1;
					}
				}
			});
			$('.comp_cols').css('background-color','white');
			$('#column_'+nextColNo).css('background-color',backColor);
			//$('#column_'+nextColNo).css('border','1px solid red');
			$('.front_top_comp').hide();
			$('#game_top_'+((nextColNo+dpRow)-1)).show();
			currentComp(nextColNo, dpRow);
			stop = 1;
			break;
		default:
			break;
	}
});

$('#fpAll').addClass('fpSlidingBack');
$('#fpSlidingGames').hide();
$('#fpSlidingPhones').hide();
$('#fpSlidingLaptops').hide();
$('#fpAll').click(function(){
	$('.fpSideContainer').removeClass('fpSlidingBack');
	$(this).addClass('fpSlidingBack');
	$('.fpSlidingDiv').hide();
	$('#fpSlidingAll').show();
});
$('#fpGames').click(function(){
	$('.fpSideContainer').removeClass('fpSlidingBack');
	$(this).addClass('fpSlidingBack');
	$('.fpSlidingDiv').hide();
	$('#fpSlidingGames').show();
});
$('#fpLaptops').click(function(){
	$('.fpSideContainer').removeClass('fpSlidingBack');
	$(this).addClass('fpSlidingBack');
	$('.fpSlidingDiv').hide();
	$('#fpSlidingLaptops').show();
});
$('#fpPhones').click(function(){
	$('.fpSideContainer').removeClass('fpSlidingBack');
	$(this).addClass('fpSlidingBack');
	$('.fpSlidingDiv').hide();
	$('#fpSlidingPhones').show();
});

$('#back_sliding1').click(function(){
	$( ".fpSlidingTables" ).animate({ "margin-left": "+=869px" }, "slow" );
	
});

$('#next_sliding1').click(function(){
	$( ".fpSlidingTables" ).animate({ "margin-left": "-=869px" }, "slow" );
});

});

var myScroll;

function loaded () {
	myScroll = new IScroll('#fpTableSdWrapper', { mouseWheel: true });
}

document.addEventListener('touchmove', function (e) { e.preventDefault(); }, false);