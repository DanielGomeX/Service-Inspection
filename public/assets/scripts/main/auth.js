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
					M.toast({html: data.message,classes: "green darken-1 white-text",displayLength:500,completeCallback:function(){
						window.location.href="";
					}
				});
				} else if (data.response == "failed") {
					M.toast({html: data.message,classes: "red lighten-1 white-text"});
				}
			}, 
			error : function(){

			}
		});	
	}
}
