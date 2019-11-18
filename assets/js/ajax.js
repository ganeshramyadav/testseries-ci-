function getAjax(parent, child, url, option, name){
    $(parent).change(function(e){
        if(this.value != '' || this.value != 0){
            $.ajax({
                type: "POST",
                url : baseURL+url+this.value,
                success: function (response) {
                    let res = jQuery.parseJSON(response);
                    $(child).empty();
                    $(child).append('<option value="0">Select '+ option +'</option>');
                    // console.log(res);
                    
                    $(res).each(function (ind,val) {
                        var branchesList='<option value="'+val.id +'">'+val[name]+'</option>';
                        $(child).append(branchesList);
                    });
                }
            });
        }
    });
}

/* function addToCartAjax(element){
  alert("Clicked on " + element.value);
} */

/* function addToCartAjax(id){
    $(id).onclick(function(e){

        console.log(Id);

        alert("addToCart");

        if(this.value != '' || this.value != 0){
            $.ajax({
                type: "POST",
                url : baseURL+url+this.value,
                success: function (response) {
                    let res = jQuery.parseJSON(response);
                    $(child).empty();
                    $(child).append('<option value="">Select '+ option +'</option>');
                    // console.log(res);
                    
                    $(res).each(function (ind,val) {
                        var branchesList='<option value="'+val.id +'">'+val[name]+'</option>';
                        $(child).append(branchesList);
                    });
                }
            });
        }

    });
} */

/* $(document).ready(function() { 
    $( "#add-to-cart" ).click(function() {
        alert( "Handler for .click() called." );
    });
}); */ 



/*
jQuery(document).ready(function(){
    jQuery(document).on("click", ".deleteProduct", function(){
        var id = $(this).data("id"),
            hitURL = baseURL + "delete",
            currentRow = $(this);
        
        var confirmation = confirm("Are you sure to delete this Record ?");
        
        if(confirmation)
        {
            jQuery.ajax({
            type : "POST",
            dataType : "json",
            url : hitURL,
            data : { id : id } 
            }).done(function(data){
                // console.log(data);
                currentRow.parents('tr').remove();
                if(data.status = true) { alert("Record successfully deleted"); }
                else if(data.status = false) { alert("Record deletion failed"); }
                else { alert("Access denied..!"); }
            });
        }
    });
});
 
// function deleteAjax("deleteProduct", "Product"){
function deleteAjax(className, msg){
    alert("test");
    debugger;
    $(parent).Click(function(e){
        var Id = $(this).data("id"),
        hitURL = baseURL + "delete",
        currentRow = $(this);
        var confirmation = confirm("Are you sure to delete this "+ msg +" ?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { id : id } 
			}).done(function(data){
				// console.log(data);
				currentRow.parents('tr').remove();
				if(data.status = true) { alert( msg +" successfully deleted"); }
				else if(data.status = false) { alert( msg +" deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
    }); 
} */