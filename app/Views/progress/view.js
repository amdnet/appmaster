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
            emptyTable: "Tidak ada data di dalam tabel",
            info: "Menampilkan _START_ hingga _END_ dari _TOTAL_ data entri",
            lengthMenu: "Lihat _MENU_ entri",
            loadingRecords: "Loading data...",
            processing: "Memproses data...",
            search: "Pencarian: ",
        },
        "ajax": {
            "url": "<?= base_url($controller . '/getProgress/' . $detail->id_service) ?>",
            "type": "POST",
            "dataType": "json",
            async: "true"
        }
    });
});