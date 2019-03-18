var Cars = {
	delete : function(url, id){
		$.post(base_url + url, { carId : id, controller : "delete" }, function(data){
			if(data.response == "Success"){
				$("#row"+id).fadeOut("fast");
			}
		},"json");
	},
	updateInsert: function(url, formData){
		$.post(base_url + url, $(formData).serialize(), function(data){
			if(data.response == "Success") {
				M.toast({html: data.message,classes: "green white-text",displayLength:500,completeCallback:function(){
						window.location.href="?p=cars";
					}
				});
			}else{
				M.toast({html:  data.message ,classes: "red llighten-1 white-text"});
			}
		},"json");
	},
	resetForm: function(){
		$("#carForm").trigger("reset");
		$(".car-field").val('');
		$("#controller").val("updateInsert");
	}
}


$(document).ready(function(){
	
	$("select[required]").css({display: "block", height: 0, padding: 0, width: 0, position: 'absolute'});

	$(document).on("submit","#carForm",function(){
		Cars.updateInsert("/app/admin/carController.php","#carForm");
	});
	$(document).on("click",".car-delete-btn",function(){
		let id = $(this).data("id");
		Swal.fire({
			title: 'Are you sure?',
			text: "You won't be able to revert this!",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#ef5350',
			cancelButtonColor: '#43a047',
			confirmButtonText: 'Yes, delete it!'
		}).then((result) => {
			if (result.value) {
				Cars.delete("/app/admin/carController.php",id);
				Swal.fire(
					'Deleted!',
					'Your file has been deleted.',
					'success'
				)
			}
		});

	});
});