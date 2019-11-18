$(document).ready(function(){
	
	var editUserForm = $("#editSm");
	
	var validator = editUserForm.validate({
		
		rules:{
			fname :{ required : true },
			subname :{ required : true },
			catname :{ required : true },
			
			ubu : { required : true, selected : true},
			// status : { required : true, selected : true}
		},
		messages:{
			fname :{ required : "This field is required" },
			subname :{ required : "This field is required" },
			catname :{ required : "This field is required" },
			
			ubu : { required : "This field is required", selected : "Please select atleast one option" },
			// status : { required : "This field is required", selected : "Please select atleast one option" }
		}
	});

	var editProfileForm = $("#editProfile")
	var validator = editProfileForm.validate({
		
		rules:{
			fname :{ required : true },
			mobile : { required : true, digits : true },
			email : { required : true, email : true, remote : { url : baseURL + "checkEmailExists", type :"post", data : { userId : function(){ return $("#userId").val(); } } } },
		},
		messages:{
			fname :{ required : "This field is required" },
			mobile : { required : "This field is required", digits : "Please enter numbers only" },
			email : { required : "This field is required", email : "Please enter valid email address", remote : "Email already taken" },
		}
	});

});