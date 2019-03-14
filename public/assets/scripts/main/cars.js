var Cars = {
	getCarList : function(url){
		$.get(base_url + url, { keyword : ""}, function(data){ 
			// $("#tbl_cars").html("").append(data);
		},"html");
	},
	delete : function(url, id){
		$.post(base_url + url, { cid : id, controller : "delete" }, function(data){
			if(data.response == "Success"){
				$("#row"+id).fadeOut("fast");
			}
		},"json");
	},
	updateInsert: function(url, formData){
		$.post(base_url + url, $(formData).serialize(), function(data){
			if(data.response == "Success") {
				M.toast({html: "Successfully Created!",classes: "green white-text"});
				Cars.resetForm();
			}else{
				M.toast({html: "Failed! Plate Number Already Exists.",classes: "red llighten-1 white-text"});
			}
		},"json");
	},
	getCar: function(url,id,controller){
		$.get(base_url + url, { cid : id,controller : controller }, function(data){ 
			$("#carId").val(data.carId);
			$("#carNameField").val(data.carName);
			$("#carDescField").text(data.description);
			$("#minSessionField").val(data.scorePerSet);
			$("#numSessionField").val(data.numSet);
		},"json");
	},
	resetForm: function(){
		$("#carForm").trigger("reset");
		// $("#carDescField").text('');
		$("#carId").val('');
		$("#controller").val("updateInsert");
	}
}

// $(document).on("submit","#carForm",function(){
// 	Cars.updateInsert("/app/admin/carController.php","#carForm");
// 	Cars.getCarList('/views/admin/list-cars.php');
// 	Global.transition("list","cars");
// 	return false;
// });
// window.setInterval(function(){
//   Cars.getCarList('/views/admin/list-cars.php');
// }, 5000);

// $(document).on("click", ".car", function(){
// 	var type= $(this).data("type");
// 	if(type == "edit"){
// 		Global.transition("create","cars");
// 		Cars.getCar("/app/admin/carController.php", $(this).data("id"), $(this).data("controller"));	
// 	}else if(type == "delete"){
// 		Sweet.delete("Cars","Success","Car successfully deleted",$(this).data("id"));
// 		return false;
// 	}else return false;
// });



$(document).ready(function(){
	
	$("select[required]").css({display: "block", height: 0, padding: 0, width: 0, position: 'absolute'});

	$(document).on("submit","#carForm",function(){
		Cars.updateInsert("/app/admin/carController.php","#carForm");
	});
});