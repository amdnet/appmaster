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
            $("#photo-form #pgs_note").val(response.pgs_note);
            $("#photo-form #id_progress").val(response.id_progress);
        }
    })
    };

function viewProgress(id_progress) {
    $.ajax({
        url: "<?= base_url($controller . '/getOne') ?>",
        type: 'post',
        data: {
            id_progress: id_progress
        },
        dataType: 'json',
        success: function(response) {
            $("#view-form")[0].reset();
            $(".form-control").removeClass('is-invalid').removeClass('is-valid');
            $('#view-modal').modal('show');
            $("#view-form #tgl_progress").val(response.tgl_progress);
            $("#view-form #id_stall").val(response.stall);
            $("#view-form #pgs_photo").attr('src', window.location.origin + '/appmaster/public/progress/' + response.pgs_photo);
            $("#view-form #pgs_note").val(response.pgs_note);
            $("#view-form #id_progress").val(response.id_progress);
            $("#view-form #created_at").val(response.created_at);
            $("#view-form #updated_at").val(response.updated_at);
            $("#view-form #id_users").val(response.fullname);
            // $("#view-form #pgs_persen")[0].css("width", response.pgs_persen + "%").attr("aria-valuenow", response.pgs_persen).text(response.pgs_persen + "%");;
            
            var value = 0;
            var interval = setInterval(function() {
            value += 1;
            $("#view-form #pgs_persen")
            .css("width", value + "%")
            .attr("aria-valuenow", value)
            .text(value + "%");
            if (value >= response.pgs_persen)
            clearInterval(interval);
            }, 100);
        }
    })
    };