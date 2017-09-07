var xmlhttp = createXmlHttpRequestObject();

function createXmlHttpRequestObject(){
	var xmlhttp;
	
	if(window.XMLHttpRequest){
		xmlhttp = new XMLHttpRequest();
	} else {
		try{
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		} catch(e) {
			alert(e.toString);
		}
	}
	
	return xmlhttp;
}

function like_right(){
	xmlhttp.onreadystatechange = function(){
		if (xmlhttp.readyState == 4 && xmlhttp.status==200){
			Upd_Like_right = document.getElementById("div_right_upd");
			Upd_Like_right.innerHTML = xmlhttp.responseText;
		}
	}
	xmlhttp.open("GET","like-right.inc.php",true);
	xmlhttp.send();
}

function like_left(){
	xmlhttp.onreadystatechange = function(){
		if (xmlhttp.readyState == 4 && xmlhttp.status==200){
			Upd_Like_left = document.getElementById("div_left_upd");
			Upd_Like_left.innerHTML = xmlhttp.responseText;
		}
	}
	xmlhttp.open("GET","like-left.inc.php",true);
	xmlhttp.send();
}

function Like_com(var1){
	xmlhttp.onreadystatechange = function(){
		if (xmlhttp.readyState == 4 && xmlhttp.status==200){
			Comment_like = document.getElementById(var1+"comment_like");
			Comment_like.innerHTML = xmlhttp.responseText;
		}
	}
	xmlhttp.open("GET","comlike.inc.php?"+var1,true);
	xmlhttp.send();
}

function Dislike_com(var1){
	xmlhttp.onreadystatechange = function(){
		if (xmlhttp.readyState == 4 && xmlhttp.status==200){
			Comment_dislike = document.getElementById(var1+"comment_dis");
			Comment_dislike.innerHTML = xmlhttp.responseText;
		}
	}
	xmlhttp.open("GET","comdislike.inc.php?"+var1,true);
	xmlhttp.send();
}

function if_exists(){
	xmlhttp.onreadystatechange = function(){
		if (xmlhttp.readyState == 4 && xmlhttp.status==200){
			name_given = document.getElementById("name_given").value;
			Available = document.getElementById("Check_topic_name_available");
			Available.innerHTML = '<span style="color:blue">' + xmlhttp.responseText + '</span>';
		}
	}
	xmlhttp.open("GET","topic_names.inc.php?="+(name_given),true);
	xmlhttp.send();
}