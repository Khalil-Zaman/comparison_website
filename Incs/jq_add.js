$('document').ready(function(){
	
	var URL = window.URL || window.webkitURL;
   
	var input = document.querySelector('#add_pic_name');
    var preview = document.querySelector('#img_chosen');
    
    // When the file input changes, create a object URL around the file.
    input.addEventListener('change', function () {
        preview.src = URL.createObjectURL(this.files[0]);
    });
	
	// When the image loads, release object URL
    preview.addEventListener('load', function () {
        URL.revokeObjectURL(this.src);
    });
	
	
	$('.input_add').focusout(function(){
		id = $(this).attr('id');
		input = $(this).val();
		$('#display_'+id).html(input);
	});
	
});