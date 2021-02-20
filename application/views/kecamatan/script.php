<script>
    $(document).ready(function() {
        $('#tabelKecamatan').DataTable({
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
        $('.tambahKecamatanModal').on('click', function() {
            $('#kecamatanModalLabel').html('Tambah Data Kecamatan');
            $('.modal-body form').attr('action', '<?= base_url('kecamatan/insert') ?>');
            $('#kecamatan').val('');
            $('#password').val('');
        });
        $(document).on('click', '.ubahKecamatanModal', function() {
            $('#kecamatanModalLabel').html('Ubah Data Kecamatan');
            $('.modal-body form').attr('action', '<?= base_url('kecamatan/update') ?>');

            const id = $(this).data('id');

            $.ajax({
                url: '<?= base_url('kecamatan/ajax') ?>',
                data: {
                    id: id
                },
                method: 'post',
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    $('#id').val(data.id);
                    $('#kecamatan').val(data.kecamatan);
                    $('#password').val(data.password);
                    $('#koordinator').val(data.koordinator);
                }
            });
        });
    });
</script>

<script>
    function show() {
        var x = document.getElementById('password').type;

        if (x == 'password') {
            document.getElementById('password').type = 'text';
            document.getElementById('mybutton').innerHTML = '<i class="fa fa-eye-splash"></i>';
        } else {
            document.getElementById('password').type = 'password';
            document.getElementById('mybutton').innerHTML = '<i class="fa fa-eye"></i>';
        }
    }
</script>