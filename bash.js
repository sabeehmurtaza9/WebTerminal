$(function(){
	Clean("bashApi.php");
	$(document).on("submit","form",function(e){
		e.preventDefault();
		var file = "bashApi.php";
		RunCommand(file);
	});
});

function RunCommand(file)
{
	var bash = $(".inputBox");
	var outputBox = $(".output");
	var val = bash.val();
	outputBox.append("<span class='green'>$:></span> "+val+"<br>");
	$.get(file,{"command":val},function(returnData){
		outputBox.append(returnData);
	});
	//outputBox.animate({ scrollTop: outputBox.height()}, 1000);
	outputBox.animate({ scrollTop: outputBox.prop('scrollHeight') }, 1000);
	bash.val("");
}

function Clean(file)
{
	$.get(file,{"run":"clean"},function(data){
		console.log(data);
	});
}