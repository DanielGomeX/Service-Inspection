var Inspections = {
	delete : function(url, id){
		$.post(base_url + url, { inspectionId : id, controller : "delete" }, function(data){
			if(data.response == "Success"){
				$("#row"+id).fadeOut("fast");
			}
		},"json");
	},
	updateInsert: function(url, formData){

		$.post(base_url + url,$(formData).serialize(), function(data){
			if(data.response == "Success") {
				M.toast({html: data.message,classes: "green white-text",displayLength:500,completeCallback:function(){
						window.location.href="?p=dashboard";
					}
				});
				Inspections.resetForm();
			}else{
				M.toast({html:  data.message,classes: "red llighten-1 white-text"});
			}
		},"json");
	},
	resetForm: function(){
		$("#inspectionForm").trigger("reset");
		$(".inspection-field").val('');
		$("#controller").val("updateInsert");
	}
}


$(document).ready(function(){
	
	$("select[required]").css({display: "block", height: 0, padding: 0, width: 0, position: 'absolute'});
	
	$(document).on("submit","#inspectionForm",function(){

		var lubrication = $("input[class=field-lubrication]:checked").map(function() {
			return $(this).data("id");
		}).get();
		var underhood = $("input[class=field-underhood]:checked").map(function() {
			return $(this).data("id");
		}).get();
		var road = $("input[class=field-road]:checked").map(function() {
			return $(this).data("id");
		}).get();
		$('#lubrication').val(lubrication);
		$('#underhood').val(underhood);
		$('#road').val(road);
		Inspections.updateInsert("/app/admin/inspectionController.php","#inspectionForm");
	});
	$(document).on("click",".inspection-delete-btn",function(){
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
				Inspections.delete("/app/admin/inspectionController.php",id);
				Swal.fire(
					'Deleted!',
					'Your file has been deleted.',
					'success'
				)
			}
		});

	});
});