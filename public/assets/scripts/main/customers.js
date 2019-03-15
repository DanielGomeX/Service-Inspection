var Customers = {
	delete : function(url, id){
		$.post(base_url + url, { customerId : id, controller : "delete" }, function(data){
			if(data.response == "Success"){
				$("#row"+id).fadeOut("fast");
			}
		},"json");
	},
	updateInsert: function(url, formData){
		$.post(base_url + url, $(formData).serialize(), function(data){
			if(data.response == "Success") {
				M.toast({html: "Success! Nice one.",classes: "green white-text"});
				Customers.resetForm();
			}else{
				M.toast({html: "Failed! Customer Already Exists.",classes: "red llighten-1 white-text"});
			}
		},"json");
	},
	resetForm: function(){
		$("#customerForm").trigger("reset");
		$(".customer-field").val('');
		$("#controller").val("updateInsert");
	}
}


$(document).ready(function(){
	
	$("select[required]").css({display: "block", height: 0, padding: 0, width: 0, position: 'absolute'});
	
	$(document).on("submit","#customerForm",function(){
		Customers.updateInsert("/app/admin/customerController.php","#customerForm");
	});
	$(document).on("click",".customer-delete-btn",function(){
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
				Customers.delete("/app/admin/customerController.php",id);
				Swal.fire(
					'Deleted!',
					'Your file has been deleted.',
					'success'
				)
			}
		});

	});
});