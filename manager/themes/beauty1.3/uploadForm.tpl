<div class="span12">
	<h3>Загрузить файлы</h3>

	<!-- Upload Plugin  -->
	<form id="fileupload" action="uploadFiles.php" method="POST" enctype="multipart/form-data">

		<!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
		<div class="row fileupload-buttonbar">
			<div class="span8">
				<!-- The fileinput-button span is used to style the file input field as button -->
				<span class="btn btn-success fileinput-button"> <i class="icon-plus icon-white"></i>
					<input type="file" name="files[]" multiple />
				</span>
				<button type="submit" class="btn btn-primary start">
					<i class="icon-upload icon-white"></i><span>Начать загрузку</span>
				</button>
				<button type="reset" class="btn cancel">
					<i class="icon-ban-circle icon-brown"></i><span>Отменить загрузку</span>
				</button>
				<button type="button" class="btn btn-danger delete">
					<i class="icon-trash icon-white"></i><span>Удалить</span>
				</button>
				<input type="checkbox" class="toggle" />
			</div>

			<!-- The global progress information -->
			<div class="span5 fileupload-progress fade">
				<!-- The global progress bar -->
				<div class="progress progress-success progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
					<div class="bar" style="width: 0%;"></div>
				</div>
				<!-- The extended global progress information -->
				<div class="progress-extended">
					&nbsp;
				</div>
			</div>
		</div>

		<!-- The loading indicator is shown during file processing -->
		<div class="fileupload-loading"></div>
		<br>

		<!-- The table listing the files available for upload/download -->
		<table role="presentation" class="table table-striped">
			<tbody class="files" data-toggle="modal-gallery" data-target="#modal-gallery"></tbody>
		</table>
	</form>
	<!-- End Upload Plugin -->
</div>
<!-- modal-gallery is the modal dialog used for the image gallery -->
<div id="modal-gallery" class="modal modal-gallery hide fade" data-filter=":odd" tabindex="-1">
	<div class="modal-header">
		<a class="close" data-dismiss="modal">&times;</a>
		<h3 class="modal-title"></h3>
	</div>
	<div class="modal-body">
		<div class="modal-image"></div>
	</div>
	<div class="modal-footer">
		<a class="btn modal-download" target="_blank"><i class="icon-download"></i> <span>Загрузить</span></a>
		<a class="btn btn-success modal-play modal-slideshow" data-slideshow="5000"><i class="icon-play icon-white"></i> <span>Slideshow</span></a>
		<a class="btn btn-info modal-prev"><i class="icon-arrow-left icon-white"></i> <span>Предыдущий</span></a>
		<a class="btn btn-primary modal-next"><span>Следующий</span> <i class="icon-arrow-right icon-white"></i></a>
	</div>
</div>

<!-- Bootstrap -->
<script src="{THEME_PATH}/bootstrap/js/bootstrap.min.js"></script>

<!--  File Upload Plugin  ------------------------------------------------------>

<!-- The template to display files available for upload -->
<script id="template-upload" type="text/x-tmpl">
	{% for (var i=0, file; file=o.files[i]; i++) { %}
	<tr class="template-upload fade">
	<td class="preview"><span class="fade"></span></td>
	<td class="name"><span>{%=file.name%}</span></td>
	<td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>
	{% if (file.error) { %}
	<td class="error" colspan="2"><span class="label label-important">Ошибка</span> {%=file.error%}</td>
	{% } else if (o.files.valid && !i) { %}
	<td>
	<div class="progress progress-success progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="bar" style="width:0%;"></div></div>
	</td>
	<td class="start">{% if (!o.options.autoUpload) { %}
	<button class="btn btn-primary">
	<i class="icon-upload icon-white"></i>
	<span>Start</span>
	</button>
	{% } %}</td>
	{% } else { %}
	<td colspan="2"></td>
	{% } %}
	<td class="cancel">{% if (!i) { %}
	<button class="btn btn-warning">
	<i class="icon-ban-circle icon-white"></i>
	<span>Отмена</span>
	</button>
	{% } %}</td>
	</tr>
	{% } %}
</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
	{% for (var i=0, file; file=o.files[i]; i++) { %}
	<tr class="template-download fade">
	{% if (file.error) { %}
	<td></td>
	<td class="name"><span>{%=file.name%}</span></td>
	<td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>
	<td class="error" colspan="2"><span class="label label-important">Ошибка</span> {%=file.error%}</td>
	{% } else { %}
	<td class="preview">{% if (file.thumbnail_url) { %}
	<a href="{%=file.url%}" title="{%=file.name%}" rel="gallery" download="{%=file.name%}"><img src="{%=file.thumbnail_url%}"></a>
	{% } %}</td>
	<td class="name">
	<a href="{%=file.url%}" title="{%=file.name%}" rel="{%=file.thumbnail_url&&'gallery'%}" download="{%=file.name%}">{%=file.name%}</a>
	</td>
	<td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>
	<td colspan="2"></td>
	{% } %}
	<td class="delete">
	<button class="btn btn-danger" data-type="{%=file.delete_type%}" data-url="{%=file.delete_url%}">
	<i class="icon-trash icon-white"></i>
	<span>Отмена</span>
	</button>
	<input type="checkbox" name="delete" value="1">
	</td>
	</tr>
	{% } %}
</script>
<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script
src="{THEME_PATH}/theme/scripts/jquery-file-upload/js/vendor/jquery.ui.widget.js"></script>
<!-- The Templates plugin is included to render the upload/download listings -->
<script
src="{THEME_PATH}/theme/scripts/github/tmpl.min.js"></script>
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script
src="{THEME_PATH}/theme/scripts/github/load-image.min.js"></script>
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script
src="{THEME_PATH}/theme/scripts/github/canvas-to-blob.min.js"></script>
<!-- Bootstrap JS and Bootstrap Image Gallery are not required, but included for the demo -->

<script
src="{THEME_PATH}/theme/scripts/github/bootstrap-image-gallery.min.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script
src="{THEME_PATH}/theme/scripts/jquery-file-upload/js/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script
src="{THEME_PATH}/theme/scripts/jquery-file-upload/js/jquery.fileupload.js"></script>
<!-- The File Upload file processing plugin -->
<script
src="{THEME_PATH}/theme/scripts/jquery-file-upload/js/jquery.fileupload-fp.js"></script>
<!-- The File Upload user interface plugin -->
<script
src="{THEME_PATH}/theme/scripts/jquery-file-upload/js/jquery.fileupload-ui.js"></script>
<!-- The main application script -->
<script src="{THEME_PATH}/theme/scripts/jquery-file-upload/js/main.js"></script>
