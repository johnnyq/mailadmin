
//Submits All Form POST data with div id #ajaxform via AJAX
$("#ajaxAddForm").submit(function(e){
	var postData = $(this).serializeArray();	   
    $.ajax(
    {
        url : "post.php",
        type: "POST",
        data : postData,
        success : function(response)
        {
            $("#response").html(response);
            $('#ajaxform').trigger("reset");
    		$("form:not(.filter) :input:visible:enabled:first").focus();
        }, 	
    });
    e.preventDefault(); //STOP default POST action
});

$("#ajaxEditForm").submit(function(e){
	var postData = $(this).serializeArray();	   
    $.ajax(
    {
        url : "post.php",
        type: "POST",
        data : postData,
        success : function(response)
        {
            $("#response").html(response);
        }, 	
    });
    e.preventDefault();
});