$(function() {
    $('#data_table').DataTable({
        dom: 'Blfrtip',
        buttons: ["copyHtml5", "csvHtml5", "excelHtml5", "pdfHtml5", "print", "colvis"],
        "paging": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        language: {
            "emptyTable": "Tidak ada data di dalam tabel",
            "info": "Menampilkan _START_ hingga _END_ dari _TOTAL_ data entri",
            "lengthMenu": "Lihat _MENU_ entri",
            "loadingRecords": "Loading data...",
            "processing": "Memproses data...",
            "search": "Pencarian: ",
        },
        ajax: {
            "url": "<?= base_url($controller . '/clientData/' . $detail->id_service) ?>",
            "type": "POST",
            "dataType": "json",
            "async": "true"
        },
        columnDefs: [
            {
                "targets": [],
                "visible": false,
                "searchable": false
            },
            {
                "targets": [0, 1, 2, 3, 5, 6],
                "className": "dt-body-center"
            },
            {
                "targets": [0],
                "width": "6%"
            },
            {
                "targets": [6],
                "width": "7%"
            },
        ]
    });
});

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

// function viewProgress(id_progress) {
//     $.ajax({
//         url: "<?= base_url($controller . '/getOne') ?>",
//         type: 'post',
//         data: {
//             id_progress: id_progress
//         },
//         dataType: 'json',
//         success: function(response) {
//             $("#photo-form")[0].reset();
//             $(".form-control").removeClass('is-invalid').removeClass('is-valid');
//             $('#photo-modal').modal('show');
//             $("#photo-form #pgs_photo").attr('src', window.location.origin + '/appmaster/public/progress/' + response.pgs_photo);
//             $("#photo-form #pgs_note").val(response.pgs_note).css("text-align", "center");
//             $("#photo-form #id_progress").val(response.id_progress);
//         }
//     })
//     };