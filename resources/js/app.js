require('./bootstrap');

$(function() {

	$('#openQuiz').on( 'click', function(){
		$('#video').trigger('pause');
	});

	$('.chapterOrder').on( 'change', function(){
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		$.ajax({
			url: "/co",
			type: 'post',
			dataType: 'json',
			data: {
				'cid': $(this).attr('id'),
				'order': $(this).val(),
			},
			success: function(data) {
				window.location.replace( data ); 
			},
			error: function() {
				console.log('error');
			}
		});
	});

});