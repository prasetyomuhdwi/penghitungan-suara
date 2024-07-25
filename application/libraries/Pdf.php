<?php defined('BASEPATH') or exit('No direct script access allowed');
class Pdf
{
	public function ci()
	{
		return get_instance();
	}

	public function printPdf($view, $data, $option)
	{
		error_reporting(0);
		$mpdf = new \Mpdf\Mpdf(
			[
				'orientation' => $option['orientation'],
				'format' => [210, 330],
			]

		);
		ini_set("pcre.backtrack_limit", "5000000");
		ini_set("memory_limit", "128M");
		ini_set('max_execution_time', 120);

		foreach ($this->ci()->pengaturan->getPengaturan() as $pengaturan) {
			$data[$pengaturan['name']] = $pengaturan['value'];
		}
		$data = $this->ci()->load->view($view, $data, true);
		$footer = $this->ci()->load->view('cetak/templates/footer', $data, true);


		$mpdf->shrink_tables_to_fit = 0;
		$mpdf->SetTitle($option['name']);
		$mpdf->WriteHTML($data);
		$mpdf->SetHTMLFooter($footer);

		$mpdf->Output($option['name'] . '_' . date('dmY_hi') . '.pdf', $option['type']);
	}
}
