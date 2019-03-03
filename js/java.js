$(document).ready(function(){
	$("#index").hide();
	$('#toogler').on
	('click',
		function()
		{
			$('#index').toggle();
		}
	);
	modal();
	
	sendToFetch();
	sendToFetch2();
	
});

function sendToFetch()
{
	var content = document.getElementById("lieferschein");
	content.addEventListener("input",function(){
	var string=$.trim(content.value);
	$.post('fetch.php', {lieferschein : string} , function(data){
	$('#lager-anzeige').html(data);
		});
	});
}
function sendToFetch2()
{
	var content = document.getElementById("Gerätename");
	content.addEventListener("input",function(){
		var string=$.trim(content.value);
		$.post('fetch.php', {id : string} , function(data){
			$('#ausgabe-lager').html(data);
		});
	});
}
function modal()
{
	$('.hover').click(function(event)
	{
		event.preventDefault();
		//var content = document.getElementsByClassName("hover");
		//var src = $(this).attr('href');
		//$('.modal img').attr("src",src);
		$('.modal').modal('show');
	});
}

function fetchData()
{
	var fetch_data="";
	var element = $(this);
	alert(7);
}


