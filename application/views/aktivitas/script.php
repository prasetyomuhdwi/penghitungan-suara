<script>
    $(document).ready(function() {
        $('#tabelWeb').DataTable({
            "order": [
                [1, "desc"]
            ],
            "language": {
                "lengthMenu": "Menampilkan _MENU_ aktivitas",
                "info": "Menampilkan _START_ - _END_ dari _TOTAL_ aktivitas",
                "infoEmpty": "Data kosong",
                "search": "Cari :",
                "paginate": {
                    "first": "Pertama",
                    "last": "Terakhir",
                    "next": "Selanjutnya",
                    "previous": "Sebelumnya"
                }
            }
        });
    });
    $(document).ready(function() {
        $('#tabelMobile').DataTable({
            "order": [
                [1, "desc"]
            ],
            "language": {
                "lengthMenu": "Menampilkan _MENU_ aktivitas",
                "info": "Menampilkan _START_ - _END_ dari _TOTAL_ aktivitas",
                "infoEmpty": "Data kosong",
                "search": "Cari :",
                "paginate": {
                    "first": "Pertama",
                    "last": "Terakhir",
                    "next": "Selanjutnya",
                    "previous": "Sebelumnya"
                }
            }
        });
    });
</script>