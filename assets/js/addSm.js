
$(document).ready(function(){
	
    var editUserForm = $("#addSm");
	
	var validator = editUserForm.validate({
		
		rules:{
			fname :{ required : true },
			subname :{ required : true },
			catname :{ required : true }
		},
		messages:{
			fname :{ required : "This field is required" },
			subname :{ required : "This field is required" },
			catname :{ required : "This field is required" }
		}
    });
});