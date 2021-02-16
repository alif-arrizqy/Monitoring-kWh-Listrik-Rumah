const SUKSES = $('.flash-data-success').data('sukses');
console.log(SUKSES);
if(SUKSES){
	Swal.fire({
		title : 'Pemberitahuan',
		text : SUKSES,
		type : 'success'
	});
}

const GAGAL = $('.flash-data-failed').data('gagal');
console.log(GAGAL);
if(GAGAL){
	Swal.fire({
		title : 'Pemberitahuan',
		text : GAGAL,
		type : 'error'
	});
}

const HAPUS = $('.flash-data-success').data('hapus');
console.log(HAPUS);
if(HAPUS){
	Swal.fire({
		title : 'Pemberitahuan',
		text : HAPUS,
		type : 'success'
	});
}