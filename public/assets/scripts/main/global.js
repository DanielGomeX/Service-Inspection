$(document).ready(()=>{
	materializeInit();
});

var materializeInit = () => {
	$('.sidenav').sidenav();
	$('select').formSelect();
	$('.collapsible').collapsible();
	$('.tooltipped').tooltip();
	$('.tabs').tabs();
	$('.table').DataTable();
	$('.fixed-action-btn').floatingActionButton();
	$('.tooltipped').tooltip();
	$('.modal').modal();
	$("time.timeago").timeago();
};


$(document).on("click",'.paginate_button',function(){
	$("time.timeago").timeago();
	
})