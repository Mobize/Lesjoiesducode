$(function() {

	var setSidebarTogglePos = function() {
		var width = $('#sidebar-left').css('display') == 'none' ? 20 : $('#sidebar-left').width();
		$('#sidebar-toggle').css('left', width+'px').show();
	}

	$('#sidebar-toggle').click(function() {
		//$(this).find('span').switchClass('.glyphicon-chevron-left', '.glyphicon-chevron-right');

		$('#sidebar-left').toggle();

		if ($(this).find('span').hasClass('glyphicon-chevron-left')) {
			$(this).removeClass('sidebar-toggle-left').addClass('sidebar-toggle-right');
			$(this).find('span').removeClass('glyphicon-chevron-left').addClass('glyphicon-chevron-right');
			$('#main-container').attr('class', 'col-sm-12 col-sm-offset-0 col-md-12 col-md-offset-0 main');
		} else {
			$(this).removeClass('sidebar-toggle-right').addClass('sidebar-toggle-left');
			$(this).find('span').removeClass('glyphicon-chevron-right').addClass('glyphicon-chevron-left');
			$('#main-container').attr('class', 'col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main');
		}

		setSidebarTogglePos();
	});

	setTimeout(function() {
		setSidebarTogglePos();
	}, 500);
	$(window).resize(function() {
		setSidebarTogglePos();
	});
});

$(document).ready(function(){
    $('#table-dynamic').DataTable({
    	language: {
	        url: 'js/dataTables.fr_FR.json'
	    }
    });
});