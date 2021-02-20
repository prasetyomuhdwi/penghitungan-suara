<script>
    $('.ubahDataModal').on('click', function() {
        const id = $(this).data('id');

        $.ajax({
            url: '<?= base_url('suara-masuk/ajax') ?>',
            data: {
                id: id
            },
            method: 'post',
            dataType: 'json',
            success: function(data) {
                console.log(data);
                $('#tps_id').val(id);
                for (i in data) {
                    $('#paslon_id' + i).val(data[i].id);
                    $('#suara' + i).val(data[i].jml_suara);
                }
            }
        });
    });
</script>

<script>
    var cacheData;
    var data = $('#refresh').html();
    var auto_refresh = setInterval(
        function() {
            $.ajax({
                url: '<?= base_url('dashboard/refresh') ?>',
                type: 'POST',
                data: data,
                dataType: 'html',
                success: function(data) {
                    if (data !== cacheData) {
                        cacheData = data;
                        $('#refresh').html(data);
                    }
                }
            })
        },
        1000);
</script>