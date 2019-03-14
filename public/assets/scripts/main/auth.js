var User = {
	Login:function(url, LoginData){
		$.ajax({
			url : base_url + url,
			type:"POST",
			dataType : 'json',
			data : LoginData,
			success : function(data){
				console.log(data);

				if(data.response == "success") {
					window.location.href = "";
				} else if (data.response == "failed") {
					alert("Fail");
				}
			}, 
			error : function(){

			}
		});	
	}
}