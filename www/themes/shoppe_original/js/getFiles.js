jQuery(document).ready(function($){
	$("#getLink").click(function(e) {
		e.preventDefault();
		if(e.isDefaultPrevented() == true) {		
		$.ajax({
			url : $("#formLink").attr("action"),
			data : $("#formLink").serialize(),
			type : $("#formLink").attr("method"),
			success : function(data, textStatus, jqXHR) {
				var dataReq = data.split('<section class="span9 first">');
				dataReq = dataReq[1].split("</div>");
				dataReq = dataReq[0];
				$("#linkContent").html(dataReq);
			},
			error : function() {
				$("#linkContent").html("Error send request!");
			}
		});
		}
	});
}); 
