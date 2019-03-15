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
	$('.modal').modal();
};

var previousPage = () =>{
		function preventBack(){window.history.forward();} 
		setTimeout("preventBack()", 0); 
		window.onunload=function(){null}; 
}