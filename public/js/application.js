

//Like photo works
var photoId = 0;			
$('.like').on('click',function(event){
	event.preventDefault();
	photoId = event.target.parentNode.parentNode.dataset['photoid'];
	$.ajax({
		method: 'POST',
		url: urlLike,
		data: {photoId: photoId, _token: token},
	})
	.done(function($count){
		//console.log($count);
		//show the number of likes
		if($count != 0)
			event.target.innerText = " "+$count;
		else
			event.target.innerText = " ";

		//change the thumbs icon
		if($(event.target).hasClass("glyphicon-thumbs-up"))
			$(event.target).removeClass("glyphicon-thumbs-up").addClass("glyphicon-thumbs-down");
		else if($(event.target).hasClass("glyphicon-thumbs-down"))
		 	$(event.target).removeClass("glyphicon-thumbs-down").addClass("glyphicon-thumbs-up");
    });
});
