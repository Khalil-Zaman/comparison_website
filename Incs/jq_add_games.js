$('document').ready(function(){

	/*	var URL = window.URL || window.webkitURL;
    var input = document.querySelector('#image');
	var preview = document.querySelector('#img_preview');
    
    // When the file input changes, create a object URL around the file.
    input.addEventListener('change', function () {
        preview.src = URL.createObjectURL(this.files[0]);
    });
    
	var img_height;
	var img_width;
    // When the image loads, release object URL
    preview.addEventListener('load', function () {
        URL.revokeObjectURL(this.src);
        alert('jQuery code here. W: ' + this.width + ', H: ' + this.height);
		img_height = this.height;
		img_width = this.width;
    });*/
	
	var URL = window.URL || window.webkitURL;
   
	var input = document.querySelector('#add_pic_name');
    var preview = document.querySelector('#img_chosen');
	
	var icon_img = document.querySelector('#add_icon_img');
	var preview_icon = document.querySelector('#img_chosen_icon');
    
    // When the file input changes, create a object URL around the file.
    input.addEventListener('change', function () {
        preview.src = URL.createObjectURL(this.files[0]);
    });
	
	// When the image loads, release object URL
    preview.addEventListener('load', function () {
        URL.revokeObjectURL(this.src);
    });
	
	icon_img.addEventListener('change', function () {
        preview_icon.src = URL.createObjectURL(this.files[0]);
    });
	
	preview_icon.addEventListener('load', function () {
        URL.revokeObjectURL(this.src);
    });
	
	$('.input_add').focusout(function(){
		id = $(this).attr('id');
		input = $(this).val();
		$('#display_'+id).html(input);
	});
	
});