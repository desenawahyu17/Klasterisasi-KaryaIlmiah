// FRONTEND
$(document).ready(function() {
	$('#myTable').DataTable();
	$('#myTable2').DataTable();
	$('#myTable3').DataTable();
});


//sidebar
$('#menu-action').click(function() {
	$('.sidebar').toggleClass('active');
	$('.main').toggleClass('active');
	$(this).toggleClass('active');
	
	if ($('.sidebar').hasClass('active')) {
		$(this).find('i').addClass('fa-close');
		$(this).find('i').removeClass('fa-bars');
	} else {
		$(this).find('i').addClass('fa-bars');
		$(this).find('i').removeClass('fa-close');
		$('ul .collapse').collapse('hide');
	}
});

// sidebar
$('#menu-action').hover(function() {
	$('.sidebar').toggleClass('hovered');
});

$("a[data-toggle='collapse']").click(function() {
	if (!$('.sidebar').hasClass('active')) {
		$('#menu-action').click();
	}
});


// AJAX LABELING MANUAL
$('select[name="label_data"]').on('change ', function() {
	id = $(this).attr('data-id');
	value = $(this).find(':selected').text();
	
	$.ajax({
		url         : "../controllers/labeling_add.php",
		data		: {'id': id, 'value': value},
		type        : "POST",
		dataType	: "json",
		success     : function(response) {
			console.log(response);
		},
		error     : function(x) {
			console.log(x.responseText);
		}
	});
});
// TAMPIL DATA LABELING (TANPA LABEL) [END]

// AUTO REFRESH PAGE SETELAH PROSES PELABELAN AJAX
$('#labelingModal').on('hidden.bs.modal', function () {
	window.location.reload();
});


$jumlah_data = parseInt($('#data').val());
$('#latih').val(Math.round($jumlah_data * 0.8));
$('#uji').val(Math.round($jumlah_data * 0.2));

// console.log($data_latih.val());

// UBAH JUMLAH DATA LATIH
$('#latih').on("change paste keyup", function() {
	let value = parseInt($(this).val());
	let max = parseInt($('#data').val());

	if(value > 0 && value <= max) {
		$('#latih').val(value);
		$('#uji').val(Math.round(max - value));
	}
	else {
		$('#latih').val(Math.round($jumlah_data * 0.8));
		$('#uji').val(Math.round($jumlah_data * 0.2));
	}
});