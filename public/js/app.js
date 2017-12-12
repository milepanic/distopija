$(document).ready(function() {

	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

	// function for changing tabs on wellcome page
	$(".nav-tabs li a").click(function(e) {
		e.preventDefault();
		var type = $(this).data('type');

		window.location.pathname = '/' + type;
		
		$.ajax({
			type: 'GET',
			url: '/' + type,
			data: type,
			success: function(data) {
				$(this).parent().addClass('active');
				$("#jokes").html(data);
			},
			error: function() {
				/* Act on the event */
			}
		});
	});

	// function for voting on posts
	$('.vote').click(function() {
		var vote = {
			type: $(this).data('type'),
			id: $(this).data('id')
		};

		if($(this).data('type') === 'upvote') {
			if($('#downvote').hasClass('btn-danger'))
				$('#downvote').removeClass('btn-danger');
			$(this).toggleClass('btn-primary');
		}
		if($(this).data('type') === 'downvote') {
			if($('#upvote').hasClass('btn-primary'))
				$('#upvote').removeClass('btn-primary');
			$(this).toggleClass('btn-danger');
		}

		$.ajax({
			type: 'POST',
			url: '/post/vote',
			data: vote,
			success: function (data) {

			},
			error: function() {

			}
		});
	});

	// function on favoriting posts
	$('.favorite').click(function() {
		var vote = {
			id: $(this).data('id')
		};

		$(this).toggleClass('voted');

		$.ajax({
			type: 'POST',
			url: '/post/favorite',
			data: vote,
			success: function (data) {
				
			},
			error: function() {

			}
		});
	});

	$('.edit').on('click', function(e) {
		e.preventDefault();
		var comment_p = $(this).parent().find('.comment');
		var id = comment_p.data('id');
		var comment = comment_p.text();
		comment_p.hide();

		var comment_box = $(this).parent().find('.comment-box');
		$(comment_box).append(
			'<div class="edit-form">' +
			'<input class="comment-edit" type="text" value="' + comment + '" placeholder="Edit comment">' +
			'<button class="comment-edit-button" type="submit">Edit</button>' +
			'</div>'
		);

		$('.comment-edit-button').on('click', function() {
			var edit = { 
				comment: $('.comment-edit').val()
			};

			$.ajax({
				type: 'PATCH',
				url: '/comment/edit/' + id,
				data: edit,
				success: function(data) {
					$('.edit-form').remove();
					comment_p.text(data);
					comment_p.show();
				},
				error: function() {

				}
			});
		});
	});

	$('.delete').on('click', function(e) {
		e.preventDefault();
		var comment_div = $(this).parent();
		var id = comment_div.find('.comment').data('id');

		$.ajax({
			url: '/comment/delete/' + id,
			type: 'DELETE',
			success: function() {
				comment_div.remove();
			}
		});
		
	})

});