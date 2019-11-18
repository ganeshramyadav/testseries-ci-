
jQuery(document).ready(function(){
	jQuery(document).on("click", ".addFavorite", function(){
		var id = $(this).data("id");
		var msg = $(this).data("msg");
		var url = $(this).data("url");

		hitURL = baseURL + "add";
		currentRow = $(this);
		
		var confirmation = confirm("Are you sure to add in "+msg+" ?");

		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { id : id, url : url }
			}).done(function(data){
				// currentRow.parents('tr').remove();
				if(data.status = true) {
					alert("Successfully add");
					location.reload(true);
				}
				else if(data.status = false) { alert(" Process failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});

	jQuery(document).on("click", ".deleteProduct", function(){
		var id = $(this).data("id");
		var msg = $(this).data("msg");
		var url = $(this).data("url");

		hitURL = baseURL + "delete";
		currentRow = $(this);

		// alert(hitURL);
		
		var confirmation = confirm("Are you sure to delete this "+msg+" ?");

		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { id : id, url : url }
			}).done(function(data){
				currentRow.parents('tr').remove();
				if(data.status == "TRUE") {
					alert("Successfully deleted");
					location.reload(true);
				}
				else if(data.status = "FALSE") { alert(" Deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});
});

