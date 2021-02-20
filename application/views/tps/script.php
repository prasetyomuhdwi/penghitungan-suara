<script>
    $(document).ready(function() {
        $('#tabelTps').DataTable({
            "oLanguage": {
                "sSearch": "Cari : "
            },
            "paging": false,
            "ordering": false,
            "info": false
        });
    });
</script>
<script>
    $(function() {

        $('.tambahTpsModal').on('click', function() {
            $('#tpsModalLabel').html('Tambah Data TPS');
            $('.modal-body form').attr('action', '<?= base_url('tps/insert') ?>');
            $('#tps').val('');
            $('#dpt').val('');
        });

        $(document).on('click', '.ubahTpsModal', function() {
            $('#tpsModalLabel').html('Ubah Data TPS');
            $('.modal-body form').attr('action', '<?= base_url('tps/update') ?>');

            const id = $(this).data('id');

            $.ajax({
                url: '<?= base_url('tps/ajax') ?>',
                data: {
                    id: id
                },
                method: 'post',
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    $('#id').val(data.id);
                    $('#dpt').val(data.dpt);
                    $('#tps').val(data.tps);
                    $('#desa_id').val(data.desa_id);
                }
            });
        });

    });
</script>