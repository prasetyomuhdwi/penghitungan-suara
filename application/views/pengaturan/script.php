<script>
    $(function() {
        $('.passwordModal').on('click', function() {
            const id = $(this).data('id');

            $.ajax({
                url: '<?= base_url('pengaturan/ajaxadmin') ?>',
                data: {
                    id: id
                },
                method: 'post',
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    $('#showPassword').val(data.password);
                }
            });
        });
    });
</script>

<script>
    $(function() {
        $('.tambahAdminModal').on('click', function() {
            $('#adminModalLabel').html('Tambah Akun Admin');
            $('.modal-body form').attr('action', '<?= base_url('pengaturan/addadmin') ?>');
            $('#username').val('');
            $('#password').val('');
        });
        $(document).on('click', '.ubahAdminModal', function() {
            $('#adminModalLabel').html('Ubah Akun Admin');
            $('.modal-body form').attr('action', '<?= base_url('pengaturan/updateadmin') ?>');

            const id = $(this).data('id');

            $.ajax({
                url: '<?= base_url('pengaturan/ajaxadmin') ?>',
                data: {
                    id: id
                },
                method: 'post',
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    $('#id').val(data.id);
                    $('#username').val(data.username);
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

<script>
    $(function() {
        $('.uploadLogo').click(function() {
            $('#uploadModalLabel').html('Upload Logo')
            $('#nama').val($(this).data('name'));
        });
        $('.uploadLogoText').click(function() {
            $('#uploadModalLabel').html('Upload Logo Nama')
            $('#nama').val($(this).data('name'));
        });
        $('.uploadLogoKop').click(function() {
            $('#uploadModalLabel').html('Upload Logo Kop')
            $('#nama').val($(this).data('name'));
        });
    });
</script>

<script>
    function saveAplikasi() {

        value = [$('#aplikasi').attr('name'), $('#aplikasi')[0].value];

        $.ajax({
            url: '<?= base_url('pengaturan/ajaxaplikasi') ?>',
            data: {
                value: value
            },
            method: 'post',
            dataType: 'json',
            success: function(data) {
                window.location.replace('<?= base_url('pengaturan') ?>');
            }
        });
    }
</script>

<script>
    function saveLaporan() {
        var value = [];

        for (i = 0; i <= 6; i++) {
            value[i] = [$('#laporan' + i).attr('name'), $('#laporan' + i)[0].value];
        }

        $.ajax({
            url: '<?= base_url('pengaturan/ajaxlaporan') ?>',
            data: {
                value: value
            },
            method: 'post',
            dataType: 'json',
            success: function(data) {
                window.location.replace('<?= base_url('pengaturan') ?>');
            }
        });
    }
</script>