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
            } else if (element.hasClass('.datepicker')) {
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
                url: "<?= base_url($controller . '/addProgress') ?>",
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