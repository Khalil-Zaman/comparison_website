var backColor = 'rgb(255, 64, 64)';
var loopTime = 5000;
var nextBackColor = $('.compsHover');
$(document).ready(function(){
	$('.fpTableSdWrapper').hide();
	$('#fpTableSdWrapperAll').show();
	
	$('.fpTop').hide();
	$('.fpTopAll').show();
	
	var slide = 0;
	var startSlide = setInterval(function(){
		if(slide<11){
		$( ".slidingTopAll" ).animate({ "margin-left": "-=666px" }, "fast" ); // TOP BIG COMPARISON MOVES SIDEWAYS
			if((slide+1)%4==0){
				$( ".fpSlidingTables" ).animate({ "margin-left": "-=869px" }, "slow" ); // SLIDE THE BOTTOM SMALLER COMPARISONS AFTER 4 TRANSITIONS
			}
			$('.comp_cols').css('background-color','white');
			nextBackColor.next().css('background-color',backColor);
			nextBackColor = nextBackColor.next();
			comparisonNo = $('#current_comp_id').html();
			comparisonNo++;
			$('#current_comp_id').html(comparisonNo);
		}
		slide++;
	},loopTime);
	
	$('.comp_cols').mouseenter(function(){
		clearInterval(startSlide); // STOP THE SLIDING
		$('.comp_cols').css('background-color','white'); // MAKE THE BACKGROUND WHITE
		$(this).css('background-color',backColor); // MAKE THE CONTAINERS BACKGROUND RED (To look as if the border is red)
		colNo = ($(this).index());	// GET COLUMN NUMBER, STARTS FROM 0
		slidingLeft = parseInt($(".slidingTopAll").css("margin-left"));	 // GETS CURRENT MARGIN-LEFT OF TABLE
		slidingDifference = (colNo*666)+slidingLeft; // CALCULATES THE DIFFERENCE BETWEEN WHERE IT NEEDS TO BE, AND WHERE IT IS
		slidingDifference = slidingDifference * -1; // MULTIPLIES BY MINUS ONE, DUE TO MARGIN-LEFT AND NOT MARGIN-RIGHT
		slidingDifference = slidingDifference + slidingLeft; // ADDING THE CURRENT MARGIN-LEFT, TO THE DIFFERENCE TO PLACE IT WHERE IT NEEDS TO BE
		$( ".slidingTopAll" ).animate({ "margin-left": slidingDifference+"px" }, "fast" );
		$('#current_comp_id').html((colNo+1));
	});
	
	
	$(document).keyup(function (event) {
	switch(event.keyCode){
		case 39: //RIGHT
			clearInterval(startSlide);
			var next;
			$('.comp_cols').each(function(){
				colBackgroundColor = $(this).css('background-color');
				if(colBackgroundColor==backColor){
					colNo = (nextBackColor.index())+1;
					next = nextBackColor.next();
				}
			});
			if(colNo!=12){
				$('.comp_cols').css('background-color','white');
				nextBackColor.next().css('background-color',backColor);
				nextBackColor = nextBackColor.next();
				if(next.index()<12 && next.index()>0){
					if(((next.index()) % 4) == 0){	//IF AT THE END OF A SLIDE
						$('.comp_cols').css('background-color','white');
						next.css('background-color',backColor);
						$( ".fpSlidingTables" ).animate({ "margin-left": "-=869px" }, "fast", function(){
							slidingLeft = parseInt($(".slidingTopAll").css("margin-left"));	 // GETS CURRENT MARGIN-LEFT OF TABLE
							slidingDifference = (colNo*666)+slidingLeft; // CALCULATES THE DIFFERENCE BETWEEN WHERE IT NEEDS TO BE, AND WHERE IT IS
							slidingDifference = slidingDifference * -1; // MULTIPLIES BY MINUS ONE, DUE TO MARGIN-LEFT AND NOT MARGIN-RIGHT
							slidingDifference = slidingDifference + slidingLeft; // ADDING THE CURRENT MARGIN-LEFT, TO THE DIFFERENCE TO PLACE IT WHERE IT NEEDS TO BE
							$( ".slidingTopAll" ).animate({ "margin-left": slidingDifference+"px" }, "fast" );
						});	
					} else {
						$('.comp_cols').css('background-color','white');
						next.css('background-color',backColor);
						slidingLeft = parseInt($(".slidingTopAll").css("margin-left"));	 // GETS CURRENT MARGIN-LEFT OF TABLE
						slidingDifference = (colNo*666)+slidingLeft; // CALCULATES THE DIFFERENCE BETWEEN WHERE IT NEEDS TO BE, AND WHERE IT IS
						slidingDifference = slidingDifference * -1; // MULTIPLIES BY MINUS ONE, DUE TO MARGIN-LEFT AND NOT MARGIN-RIGHT
						slidingDifference = slidingDifference + slidingLeft; // ADDING THE CURRENT MARGIN-LEFT, TO THE DIFFERENCE TO PLACE IT WHERE IT NEEDS TO BE
						$( ".slidingTopAll" ).animate({ "margin-left": slidingDifference+"px" }, "fast" );
					}
					stop = 1;
					$('#current_comp_id').html((colNo+1));
				}
			}
			break;
		case 37: //LEFT
			clearInterval(startSlide);
			var prev;
			$('.comp_cols').each(function(){
				colBackgroundColor = $(this).css('background-color');
				if(colBackgroundColor==backColor){
					colNo = (nextBackColor.index())-1;
					prev = nextBackColor.prev();
				}
			});
			if(colNo!='-1'){
				$('.comp_cols').css('background-color','white');
				nextBackColor.prev().css('background-color',backColor);
				nextBackColor = nextBackColor.prev();
				if(prev.index()>=0){
					if(((prev.index()+1) % 4) == 0){
						$('.comp_cols').css('background-color','white');
						prev.css('background-color',backColor);
						$( ".fpSlidingTables" ).animate({ "margin-left": "+=869px" }, "fast" , function(){
							slidingLeft = parseInt($(".slidingTopAll").css("margin-left"));	 // GETS CURRENT MARGIN-LEFT OF TABLE
							slidingDifference = (colNo*666)+slidingLeft; // CALCULATES THE DIFFERENCE BETWEEN WHERE IT NEEDS TO BE, AND WHERE IT IS
							slidingDifference = slidingDifference * -1; // MULTIPLIES BY MINUS ONE, DUE TO MARGIN-LEFT AND NOT MARGIN-RIGHT
							slidingDifference = slidingDifference + slidingLeft; // ADDING THE CURRENT MARGIN-LEFT, TO THE DIFFERENCE TO PLACE IT WHERE IT NEEDS TO BE
							$( ".slidingTopAll" ).animate({ "margin-left": slidingDifference+"px" }, "fast" );
						});	
					} else {
						$('.comp_cols').css('background-color','white');
						prev.css('background-color',backColor);
						slidingLeft = parseInt($(".slidingTopAll").css("margin-left"));	 // GETS CURRENT MARGIN-LEFT OF TABLE
						slidingDifference = (colNo*666)+slidingLeft; // CALCULATES THE DIFFERENCE BETWEEN WHERE IT NEEDS TO BE, AND WHERE IT IS
						slidingDifference = slidingDifference * -1; // MULTIPLIES BY MINUS ONE, DUE TO MARGIN-LEFT AND NOT MARGIN-RIGHT
						slidingDifference = slidingDifference + slidingLeft; // ADDING THE CURRENT MARGIN-LEFT, TO THE DIFFERENCE TO PLACE IT WHERE IT NEEDS TO BE
						$( ".slidingTopAll" ).animate({ "margin-left": slidingDifference+"px" }, "fast" );
					}
				stop = 1;
				$('#current_comp_id').html((colNo+1));
				}
			}
			break;
		default:
			break;
	}
});
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
	$('.fpTop').hide();
	$('.fpTopAll').show();
	$('.fpTableSdWrapper').hide();
	$('#fpTableSdWrapperAll').show();
});
$('#fpGames').click(function(){
	$('.fpSideContainer').removeClass('fpSlidingBack');
	$(this).addClass('fpSlidingBack');
	$('.fpSlidingDiv').hide();
	$('#fpSlidingGames').show();
	$('.fpTop').hide();
	$('.fpTopGames').show();
	$('.fpTableSdWrapper').hide();
	$('#fpTableSdWrapperGames').show();
});
$('#fpLaptops').click(function(){
	$('.fpSideContainer').removeClass('fpSlidingBack');
	$(this).addClass('fpSlidingBack');
	$('.fpSlidingDiv').hide();
	$('#fpSlidingLaptops').show();
	$('.fpTop').hide();
	$('.fpTopLaptops').show();
	$('.fpTableSdWrapper').hide();
	$('#fpTableSdWrapperLaptops').show();
});
$('#fpPhones').click(function(){
	$('.fpSideContainer').removeClass('fpSlidingBack');
	$(this).addClass('fpSlidingBack');
	$('.fpSlidingDiv').hide();
	$('#fpSlidingPhones').show();
	$('.fpTop').hide();
	$('.fpTopPhones').show();
	$('.fpTableSdWrapper').hide();
	$('#fpTableSdWrapperPhones').show();
});

$('#back_sliding1').click(function(){
	$( ".fpSlidingTables" ).animate({ "margin-left": "+=869px" }, "slow" );
});

$('#next_sliding1').click(function(){
	$( ".fpSlidingTables" ).animate({ "margin-left": "-=869px" }, "slow" );
});

// SCROLL THROUGH TOP ITEMS
new IScroll('#fpTableSdWrapperGames', { mouseWheel: true });
new IScroll('#fpTableSdWrapperAll', { mouseWheel: true });
new IScroll('#fpTableSdWrapperPhones', { mouseWheel: true });
new IScroll('#fpTableSdWrapperLaptops', { mouseWheel: true });

document.addEventListener('touchmove', function (e) { e.preventDefault(); }, false);