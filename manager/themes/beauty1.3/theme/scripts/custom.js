var initD = function() {
	return {
		start : start,
		new_btn : new_btn
	};

	function new_btn() {
		$(".btn-danger").click(function(e) {
			e.preventDefault();
			$.ajax({
				url : $(this).parents("form").attr("action"),
				data : $(this).parents("form").serialize(),
				method : "post",
				beforeSend : function(xhr) {
					xhr.overrideMimeType('text/html; charset=utf-8');
				},
				success : function(data) {
					var dataReq = data.split('<p class="prepend-top append-0">');
					dataReq = dataReq[1].split("</p>");
					$.jGrowl(dataReq[0]);
					$.ajax({
						url : 'bookEdit.php?id=' + $("#bookID").val(),
						method : "get",
						beforeSend : function(xhr) {
							xhr.overrideMimeType('text/html; charset=utf-8');
						},
						success : function(data) {
							var dataReq = data.split('<div class="control-group" id="authorContent">');
							dataReq = dataReq[1].split("<hr>");
							dataReq = dataReq[0] + "</div>";
							$("#authorContent").html(dataReq);
							var dataReq = data.split('<div class="control-group" id="categoryContent">');
							dataReq = dataReq[1].split("<hr>");
							dataReq = dataReq[0] + "</div>";
							$("#categoryContent").html(dataReq);
							var dataReq = data.split('<div class="control-group" id="fileContent">');
							dataReq = dataReq[1].split("<hr>");
							dataReq = dataReq[0] + "</div>";
							$("#fileContent").html(dataReq);
							var dataReq = data.split('<div class="control-group" id="imageContent">');
							dataReq = dataReq[1].split("<hr>");
							dataReq = dataReq[0] + "</div>";
							$("#imageContent").html(dataReq);
							var dataReq = data.split('<div class="control-group" id="printContent">');
							dataReq = dataReq[1].split("<hr>");
							dataReq = dataReq[0] + "</div>";
							$("#printContent").html(dataReq);
							initD.start();
						},
					});
				}
			});
		});
	}

	function start() {
		$(".btn-add-page, .btn-danger").click(function(e) {
			e.preventDefault();
			$.ajax({
				url : $(this).parents("form").attr("action"),
				data : $(this).parents("form").serialize(),
				method : "post",
				beforeSend : function(xhr) {
					xhr.overrideMimeType('text/html; charset=utf-8');
				},
				success : function(data) {
					var dataReq = data.split('<p class="prepend-top append-0">');
					dataReq = dataReq[1].split("</p>");
					$.jGrowl(dataReq[0]);
					$.ajax({
						url : 'bookEdit.php?id=' + $("#bookID").val(),
						mathod : "get",
						beforeSend : function(xhr) {
							xhr.overrideMimeType('text/html; charset=utf-8');
						},
						success : function(data) {
							var dataReq = data.split('<div class="control-group" id="authorContent">');
							dataReq = dataReq[1].split("<hr>");
							dataReq = dataReq[0] + "</div>";
							$("#authorContent").html(dataReq);
							var dataReq = data.split('<div class="control-group" id="categoryContent">');
							dataReq = dataReq[1].split("<hr>");
							dataReq = dataReq[0] + "</div>";
							$("#categoryContent").html(dataReq);
							var dataReq = data.split('<div class="control-group" id="fileContent">');
							dataReq = dataReq[1].split("<hr>");
							dataReq = dataReq[0] + "</div>";
							$("#fileContent").html(dataReq);
							var dataReq = data.split('<div class="control-group" id="imageContent">');
							dataReq = dataReq[1].split("<hr>");
							dataReq = dataReq[0] + "</div>";
							$("#imageContent").html(dataReq);
							var dataReq = data.split('<div class="control-group" id="printContent">');
							dataReq = dataReq[1].split("<hr>");
							dataReq = dataReq[0] + "</div>";
							$("#printContent").html(dataReq);
							initD.new_btn();
						},
					});
				}
			});
		});
	}

}();

$(function() {
	initD.start();
});

