function photoProgress(id_progress) {
    $.ajax({
        url: "<?= base_url($controller . '/getOne') ?>",
        type: 'post',
        data: {
            id_progress: id_progress
        },
        dataType: 'json',
        success: function(response) {
            $("#photo-form")[0].reset();
            $(".form-control").removeClass('is-invalid').removeClass('is-valid');
            $('#photo-modal').modal('show');
            $("#photo-form #pgs_photo").attr('src', window.location.origin + '/appmaster/public/progress/' + response.pgs_photo);
            $("#photo-form #pgs_note").val(response.pgs_note).css("text-align", "center");
            $("#photo-form #id_progress").val(response.id_progress);
        }
    })
    };