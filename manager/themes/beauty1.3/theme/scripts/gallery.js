$(function()
{
	// helper function that gets a set of elements
	// determines which is the tallest and
	// applies it's height to all it's elements
	function equalHeight(group, plus, animate)
	{
		group.attr('style', '');
		
		if (typeof animate == 'undefined') 
			var animate = true;
		
		var tallest = 0;
		group.each(function()
		{
			thisHeight = $(this).height();
			if(thisHeight > tallest)
			{
				tallest = thisHeight;
			}
		});
		if (animate == true)
			group.animate({ height: tallest + plus }, 200);
		else
			group.height(tallest + plus);
	}
	
	/* Helper Function for preloading images */
	function preloadImages(images)
	{
		for(i=0;i<images.length;i++)
		{
			$('<img>').prop('src', images[i]);
		}
	}
	
	var loadTimeout;
	var circleRemoveTimeouts = [];
	var modalUploadInit = false;
	
	/* Media items: Hover effect */
	$('.gallery .media').on('mouseenter', 'li', function()
	{
		$(this).find('.hover')
			.height($(this).find('.image img').height())
			.css({ display: 'table' })
			.fadeIn(300, function(){});
		
	}).on('mouseleave', 'li', function()
	{
		$(this).find('.hover').fadeOut(600, function(){});
	});
	
	/* window resize */
	$(window).resize(function()
	{
		// set all gallery items to equal height (tallest item + 15px)
		equalHeight($('.media .galleryItems li'), 15, false);
	});

	/* Albums menu: Change album */
	$('.albums ul').on('click', 'li a', function(e)
	{
		// prevent default action
		e.preventDefault();

		// do nothing if album already selected
		if ($(this).parent().is('.active') && !$(this).parent().is('.init')) return false;
		if ($(this).parent().is('.init')) $(this).parent().removeClass('init');

		// clicked album
		var button = $(this);

		// album_id to load
		var album_id = $(this).parent().attr('data-album-id');
		
		// hide delete icon from gallery items / prevents some weird flicker
		$('.media .galleryItems li .circle_remove').hide();
		
		// show some feedback to the user, show that something is happening while waiting for server's response
		$('.media .ajax-loaded').slideUp(function()
		{
			$('.media .ajax-loader').slideDown(function()
			{
				clearTimeout(loadTimeout);
				loadTimeout = setTimeout(function()
				{
					// add AJAX call to server side processing
					$.ajax(
					{
						url: 'http://demo.mosaicpro.biz/beautyadmin/php/theme/scripts/ajax.php?section=galleryItems',
						type: 'POST',
						data: 'album_id=' + album_id,
						cache: false,
						headers: {
							// this prevents iOS6's Safari from caching the response 
							// Safari will cache the response even if cache is set to false above
							"Cache-Control": "no-cache"
						},
						success: function(rd)
						{
							$('.media .ajax-loader').slideUp();
							$('.media .ajax-loaded').html(rd).show(function()
							{
								// clear previous timeouts, if any
								$.each(circleRemoveTimeouts, function(k,v){
									clearTimeout(v);
								});
								circleRemoveTimeouts = [];
								
								// interval in ms for showing delete icons
								var circleRemoveInt = 100;
								
								// showing delete icons delayed
								$('.media .galleryItems li .circle_remove').each(function(k,v)
								{
									var timeout = setTimeout(function(){
										$(v).fadeIn();
									}, circleRemoveInt*k);

									circleRemoveTimeouts.push(timeout);
								});
								
								// set all gallery items to equal height (tallest item + 15px)
								equalHeight($('.media .galleryItems li'), 15);
								
								// preload images
								var pim = [];
								$('.media .galleryItems li').each(function(k,v)
								{
									pim.push($(v).find('a').attr('href'));
								});
								preloadImages(pim);
							});
							
							// toggle off currently active album
							$('.albums .active').removeClass('active');
							$('.albums li .glyphicons').removeClass('pencil').addClass('camera');
		
							// make this album active
							button.addClass('pencil').parent().addClass('active');
						}
					});
				}, 500);
			});			
		});
	});

	// load items for active album
	$('.albums ul .init a').click();

	/* Remove media item */
	$('.media').on('click', '.thumb .circle_remove', function(e)
	{
		// prevent default action
		e.preventDefault();
		
		// media item container
		var p = $(this).parents('li:first');

		// get media item id from the data-item-id attribute
		var rel_id = p.attr('data-item-id');
		
		// get album id from the data-album-id attribute
		var album_id = p.attr('data-album-id');
		
		// confirmation
		bootbox.confirm('Are you sure you want to delete this item?', function(confirmed)
		{
			if (!confirmed) return false;
			
			// add AJAX call to server side processing
			$.ajax(
			{
				url: 'http://demo.mosaicpro.biz/beautyadmin/php/theme/scripts/ajax.php?section=galleryRemove',
				type: 'POST',
				data: 'type=item&rel_id=' + rel_id + '&album_id=' + album_id,
				dataType: 'json',
				cache: false,
				headers: {
					// this prevents iOS6's Safari from caching the response 
					// Safari will cache the response even if cache is set to false above
					"Cache-Control": "no-cache"
				},
				success: function(rdObj)
				{
					// check for errors
					if (rdObj == null)
					{
						bootbox.alert('An error occurred when deleting item.');
						return false;
					}
					if (rdObj != null && rdObj.errors != false)
					{
						bootbox.alert('An error occurred when deleting item with message: ' + rdObj.errorMsg);
						return false;
					}
					
					// no errors recieved from server, remove media item from list with a nice fadeOut effect
					p.fadeOut(function()
					{
						$(this).remove();
					});
				}
			});
		});
	});
	
	/* Remove Album */
	$('.albums').on('click', 'li .circle_remove', function()
	{
		// list item container
		var p = $(this).parents('li:first');

		// get album id from the data-album-id attribute
		var rel_id = p.attr('data-album-id');
		
		// confirmation
		bootbox.confirm('Are you sure you want to delete this album?', function(confirmed)
		{
			if (!confirmed) return false;

			// add AJAX call to server side processing
			$.ajax(
			{
				url: 'http://demo.mosaicpro.biz/beautyadmin/php/theme/scripts/ajax.php?section=galleryRemove',
				type: 'POST',
				data: 'type=album&rel_id=' + rel_id,
				dataType: 'json',
				cache: false,
				headers: {
					// this prevents iOS6's Safari from caching the response 
					// Safari will cache the response even if cache is set to false above
					"Cache-Control": "no-cache"
				},
				success: function(rdObj)
				{
					// check for errors
					if (rdObj == null)
					{
						bootbox.alert('An error occurred when deleting album.');
						return false;
					}
					if (rdObj != null && rdObj.errors != false)
					{
						bootbox.alert('An error occurred when deleting album with message: ' + rdObj.errorMsg);
						return false;
					}
					
					// no errors recieved from server, remove album from list with a nice fadeOut effect
					p.fadeOut(function()
					{
						$(this).remove();
						
						// select 1st album if there is one and update gallery
						$('.albums ul li:first a').click();
					});
				}
			});
		});
	});
	
	/* Custom event for showing Item details modal */
	$('.media').on('click', '.galleryItems li', function(e)
	{
		// prevent default action
		e.preventDefault();
		
		// clicked element
		var target = e.target;
		while (target.nodeType != 1) target = target.parentNode;
		
		// stop if target or it's parent is the remove item element
		if ($(target).is('.circle_remove') || $(target).parent().is('.circle_remove')) return false;
		
		// open item details modal
		$($(this).find('a').attr('data-target')).data('origin', $(this)).modal('show');
	})

	/* Init & hide modals */
	$('.modalGallery')
	
		// init modals and hide immediately
		.modal('hide')
		
		// execute once modal starts showing
		.on('show', function(e)
		{
			// our modal
			var modal = $(this);

			// make sure ajax loader feedback is hidden
			modal.find('.ajax-loader').hide();
			
			// reset previous responses
			modal.find('.ajax-loaded').show().find('.ajax-rd').empty();

			// reset form
			modal.find('input[type=text], input[type=password], textarea').val('');

			// item details modal
			if (modal.is('#modalItem'))
			{
				var origin = modal.data('origin');
				
				modal.find('.ajax-loader').show();
				modal.find('.ajax-loaded').hide();
				
				modal.find('.title').text(origin.find('.name').text());
				modal.find('.image').html('<img src="' + origin.find('a').attr('href') +'" />');

				clearTimeout(loadTimeout);
				loadTimeout = setTimeout(function()
				{
					modal.find('.ajax-loader').fadeOut(function(){
						modal.find('.ajax-loaded').show(0, function(){
							modal.animate({
								marginLeft: 0,
								width: modal.find('.image img').width() + 40,
								left: ($(document).width() / 2) - ((modal.find('.image img').width()+40) / 2)
							}, 200);
						});
					});
				}, 100);
			}
			
			// upload modal
			if (modal.is('#modalUpload'))
			{
				// select to populate
				var controlAlbumId = modal.find('#controlAlbumId');

				// reset previous options
				controlAlbumId.empty();

				// generate options
				var options = getAlbumsSelectOptions();

				// append options to select
				$.each(options, function(k,v)
				{
					controlAlbumId.append(v);
				});
				
				// demo only
				if (controlAlbumId.val() == 1 || controlAlbumId.val() == 2 || controlAlbumId.val() == 3)
				{
					bootbox.alert('This demo allows you to manage photos only in Albums you created.');
					e.preventDefault();
					return false;
				}

				// execute only once
				if (modalUploadInit == false)
				{
					// prevent this from executing again
					modalUploadInit = true;
					
					// select album change action
					modal.on('change', '#controlAlbumId', function()
					{
						// redefine out if scope variables
						
						// modal
						var modal = $(this).parents('.modal:first');
						
						// albums select box
						var controlAlbumId = modal.find('#controlAlbumId');
						
						// the form
						var form = modal.find('form');
						
						// remove previous loaded files
						form.find('tbody.files').empty();
						
						// album id
						var album_id = controlAlbumId.find('option').size() > 0 ? controlAlbumId.val() : false;

						// demo only
						if (album_id == 1 || album_id == 2 || album_id == 3)
						{
							bootbox.alert('This demo allows you to manage photos only in Albums you created.');
							modal.modal('hide');
							return false;
						}
						
						// only if album selected
						if (album_id != false)
						{
							// load existing images
							$.getJSON($(form).attr('action') + '&album_id=' + album_id, function(result)
					        {
					            if (result && result.length) 
								{
					            	form.fileupload('option', 'done')
										.call(form.get(0), null, {result: result});
					            }
					        });
						}
					});
				}
				
				// load fileupload existing files for the selected album
				controlAlbumId.trigger('change');
			}
		})
		
		// execute once modals starts hidding
		.on('hide', function()
		{
			// our modal
			var modal = $(this);

			// upload modal
			if (modal.is('#modalUpload'))
			{
				// albums select
				var controlAlbumId = modal.find('#controlAlbumId');

				// load fileupload existing files for the selected album
				$(".albums ul li[data-album-id='" + controlAlbumId.val() + "']").addClass('init').find('a').click();
			}
		});

	/* Modals Save button: submit */
	$('.modal .btn-submit').click(function(e)
	{
		// prevent default action
		e.preventDefault();

		// trigger submit event for whatever form contained in this modal
		$(this).parents('.modal:first').find('form').submit();
	});

	/* Generate albums select options from tabs & set default selection to the active album */
	function getAlbumsSelectOptions()
	{
		var options = [];
		$('.albums ul li').each(function(k,v)
		{
			var option = '<option value="' + $(v).attr('data-album-id') + '"';
			if ($(v).is('.active')) option += ' selected="selected"';
			option += ">" + $(v).find('a').text() + '</option>';
			options.push(option);
		});
		return options;
	}

	/* Album modal: Submit */
	$('#modalAlbum .ajaxForm').submit(function(e)
	{
		// prevent default action
		e.preventDefault();

		// our form
		var form = $(this);

		// show some feedback to the user, show that something is happening while waiting for server's response
		form.parents('.modal:first').find('.ajax-loader').show();
		form.parents('.modal:first').find('.ajax-loaded').hide();

		// call server side processing through AJAX
		$.ajax(
		{
			type: 'POST',
			url: form.attr('action'),
			data: form.serialize(),
			dataType: 'json',
			cache: false,
			headers: {
				// this prevents iOS6's Safari from caching the response 
				// Safari will cache the response even if cache is set to false above
				"Cache-Control": "no-cache"
			},
			success: function(rdObj)
			{
				// handle errors
				var rdErrors = false,
					rdErrorMsg = "";
				
				// check for errors
				if (rdObj == null)
				{
					rdErrors = true;
					rdErrorMsg = "An error occurred when adding album.";
				}
				if (rdObj != null && rdObj.errors != false)
				{
					rdErrors = true;
					rdErrorMsg = 'An error occurred when adding album with message: ' + rdObj.errorMsg;
				}
				if (rdErrors)
				{
					form.parents('.modal:first').find('.ajax-loader').hide();
					form.parents('.modal:first').find('.ajax-loaded').show().find('.ajax-rd').show().html(rdErrorMsg);
					return false;
				}

				// toggle off currently active albums
				$('.albums .active').removeClass('active');
				$('.albums li .glyphicons').removeClass('pencil').addClass('camera');

				// append the newly created album & make it active
				$('<li data-album-id="' + rdObj.album_id + '"><a href="#" class="glyphicons pencil"><i></i> ' + rdObj.album_name + '</a><span class="glyphicons circle_remove" rel="tooltip" data-placement="left" data-original-title="Remove album"><i></i></span></li>')
					.appendTo('.albums ul').
					find("[rel='tooltip']").tooltip();

				// close modal
				form.parents('.modal:first').modal('hide');

				// make album active
				$('.albums ul li:last a').click();
			}
		});
	});
});