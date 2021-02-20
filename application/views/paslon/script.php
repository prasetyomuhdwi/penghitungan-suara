<script>
    $(function() {
        $('.tambahPaslonModal').on('click', function() {
            $('#paslonModalLabel').html('Tambah Data Paslon');
            $('.modal-body form').attr('action', '<?= base_url('paslon/insert') ?>');
            $('#no_urut').val('');
            $('#nama').val('');
            $('#cabub').val('');
            $('#cawabub').val('');
        });
        $(document).on('click', '.ubahPaslonModal', function() {
            $('#paslonModalLabel').html('Ubah Data Paslon');
            $('.modal-body form').attr('action', '<?= base_url('paslon/update') ?>');

            const id = $(this).data('id');

            $.ajax({
                url: '<?= base_url('paslon/ajax') ?>',
                data: {
                    id: id
                },
                method: 'post',
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    $('#id').val(data.id);
                    $('#no_urut').val(data.no_urut);
                    $('#nama').val(data.nama);
                    $('#cabub').val(data.cabub);
                    $('#cawabub').val(data.cawabub);
                }
            });
        });
    });
</script>

<script>
    $("input").change(function(e) {

        for (var i = 0; i < e.originalEvent.srcElement.files.length; i++) {

            var file = e.originalEvent.srcElement.files[i];

            var img = document.createElement("img");
            img.className = "img-fluid";
            var reader = new FileReader();
            reader.onloadend = function() {
                img.src = reader.result;
            }
            reader.readAsDataURL(file);
            $("input").after(img);
        }
    });
</script>

<script>
    $(document).on('click', '.ubahFotoModal', function() {
        const id = $(this).data('id');

        $.ajax({
            url: '<?= base_url('paslon/ajax') ?>',
            data: {
                id: id
            },
            method: 'post',
            dataType: 'json',
            success: function(data) {
                console.log(data);
                $('#id2').val(data.id);
            }
        });
    });
</script>