<script>
$(function () {
	$('#data_table').DataTable({
    dom: 'Bfrtip',
    buttons: ["copyHtml5", "csvHtml5", "excelHtml5", "pdfHtml5", "print", "colvis"],
		"paging": true,
		"lengthChange": false,
		"searching": true,
		"ordering": true,
		"info": true,
		"autoWidth": true,
		"responsive": true,
		"ajax": {
			"url": '<?php echo base_url($controller.'/getAll') ?>',			
			"type": "POST",
			"dataType": "json",
			async: "true"
		}	  
	});
});

function add() {
	// reset the form 
	$("#add-form")[0].reset();
	$(".form-control").removeClass('is-invalid').removeClass('is-valid');		
	$('#add-modal').modal('show');
	// submit the add from 
	$.validator.setDefaults({
		highlight: function(element) {
			$(element).addClass('is-invalid').removeClass('is-valid');
		},
		unhighlight: function(element) {
			$(element).removeClass('is-invalid').addClass('is-valid');
		},
		errorElement: 'div ',
		errorClass: 'invalid-feedback',
		errorPlacement: function(error, element) {
			if (element.parent('.input-group').length) {
				error.insertAfter(element.parent());
			} else if ($(element).is('.select')) {
				element.next().after(error);
			} else if (element.hasClass('select2')) {
				//error.insertAfter(element);
				error.insertAfter(element.next());
			} else if (element.hasClass('selectpicker')) {
				error.insertAfter(element.next());
			} else {
				error.insertAfter(element);
			}
		},

		submitHandler: function(form) {
			
			var form = $('#add-form');
			// remove the text-danger
			$(".text-danger").remove();

			$.ajax({
				url: '<?php echo base_url($controller.'/add') ?>',						
				type: 'post',
				data: form.serialize(), // /converting the form data into array and sending it to server
				dataType: 'json',
				beforeSend: function() {
					$('#add-form-btn').html('<i class="fa fa-spinner fa-spin"></i>');
				},					
				success: function(response) {

					if (response.success === true) {

						Swal.fire({
							position: 'bottom-end',
							icon: 'success',
							title: response.messages,
							showConfirmButton: false,
							timer: 1500
						}).then(function() {
							$('#data_table').DataTable().ajax.reload(null, false).draw(false);
							$('#add-modal').modal('hide');
						})

					} else {

						if (response.messages instanceof Object) {
							$.each(response.messages, function(index, value) {
								var id = $("#" + index);

								id.closest('.form-control')
									.removeClass('is-invalid')
									.removeClass('is-valid')
									.addClass(value.length > 0 ? 'is-invalid' : 'is-valid');

								id.after(value);

							});
						} else {
							Swal.fire({
								position: 'bottom-end',
								icon: 'error',
								title: response.messages,
								showConfirmButton: false,
								timer: 1500
							})

						}
					}
					$('#add-form-btn').html('Add');
				}
			});

			return false;
		}
	});
	$('#add-form').validate();
}

function edit(id_stall) {
	$.ajax({
		url: '<?php echo base_url($controller.'/getOne') ?>',
		type: 'post',
		data: {
			id_stall: id_stall
		},
		dataType: 'json',
		success: function(response) {
			// reset the form 
			$("#edit-form")[0].reset();
			$(".form-control").removeClass('is-invalid').removeClass('is-valid');				
			$('#edit-modal').modal('show');	

			$("#edit-form #idStall").val(response.id_stall);
			$("#edit-form #stall").val(response.stall);
			$("#edit-form #username").val(response.username);
			$("#edit-form #updateAt").val(response.update_at);

			// submit the edit from 
			$.validator.setDefaults({
				highlight: function(element) {
					$(element).addClass('is-invalid').removeClass('is-valid');
				},
				unhighlight: function(element) {
					$(element).removeClass('is-invalid').addClass('is-valid');
				},
				errorElement: 'div ',
				errorClass: 'invalid-feedback',
				errorPlacement: function(error, element) {
					if (element.parent('.input-group').length) {
						error.insertAfter(element.parent());
					} else if ($(element).is('.select')) {
						element.next().after(error);
					} else if (element.hasClass('select2')) {
						//error.insertAfter(element);
						error.insertAfter(element.next());
					} else if (element.hasClass('selectpicker')) {
						error.insertAfter(element.next());
					} else {
						error.insertAfter(element);
					}
				},

				submitHandler: function(form) {
					var form = $('#edit-form');
					$(".text-danger").remove();
					$.ajax({
						url: '<?php echo base_url($controller.'/edit') ?>' ,						
						type: 'post',
						data: form.serialize(), 
						dataType: 'json',
						beforeSend: function() {
							$('#edit-form-btn').html('<i class="fa fa-spinner fa-spin"></i>');
						},								
						success: function(response) {

							if (response.success === true) {

								Swal.fire({
									position: 'bottom-end',
									icon: 'success',
									title: response.messages,
									showConfirmButton: false,
									timer: 1500
								}).then(function() {
									$('#data_table').DataTable().ajax.reload(null, false).draw(false);
									$('#edit-modal').modal('hide');
								})
								
							} else {

								if (response.messages instanceof Object) {
									$.each(response.messages, function(index, value) {
										var id = $("#" + index);

										id.closest('.form-control')
											.removeClass('is-invalid')
											.removeClass('is-valid')
											.addClass(value.length > 0 ? 'is-invalid' : 'is-valid');

										id.after(value);

									});
								} else {
									Swal.fire({
										position: 'bottom-end',
										icon: 'error',
										title: response.messages,
										showConfirmButton: false,
										timer: 1500
									})

								}
							}
							$('#edit-form-btn').html('Update');
						}
					});

					return false;
				}
			});
			$('#edit-form').validate();

		}
	});
}	

function remove(id_stall) {	
	swal.fire({
	  title: 'Are you sure of the deleting process?',
	  text: "You cannot back after confirmation",
	  icon: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  confirmButtonText: 'Confirm',
	  cancelButtonText: 'Cancel'		  
	}).then((result) => {		

	  if (result.value) {
		$.ajax({
			url: '<?php echo base_url($controller.'/remove') ?>',
			type: 'post',
			data: {
				id_stall: id_stall
			},
			dataType: 'json',
			success: function(response) {

				if (response.success === true) {
					Swal.fire({
						position: 'bottom-end',
						icon: 'success',
						title: response.messages,
						showConfirmButton: false,
						timer: 1500
					}).then(function() {
						$('#data_table').DataTable().ajax.reload(null, false).draw(false);								
					})
				} else {
					Swal.fire({
						position: 'bottom-end',
						icon: 'error',
						title: response.messages,
						showConfirmButton: false,
						timer: 1500
					})

					
				}
			}
		});
	  }
	})		
}  
</script>