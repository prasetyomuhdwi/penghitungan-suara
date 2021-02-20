<script>
    $(document).ready(function() {
        $('#tabelDesa').DataTable({
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

        $('.tambahDesaModal').on('click', function() {
            $('#desaModalLabel').html('Tambah Data Desa');
            $('.modal-body form').attr('action', '<?= base_url('desa/insert') ?>');
            $('#desa').val('');
            $('#kecamatan').val('');
            $('#password').val('');
        });

        $(document).on('click', '.ubahDesaModal', function() {
            $('#desaModalLabel').html('Ubah Data Desa');
            $('.modal-body form').attr('action', '<?= base_url('desa/update') ?>');

            const id = $(this).data('id');

            $.ajax({
                url: '<?= base_url('desa/ajax') ?>',
                data: {
                    id: id
                },
                method: 'post',
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    $('#id').val(data.id);
                    $('#desa').val(data.desa);
                    $('#password').val(data.password);
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