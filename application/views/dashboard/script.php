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
