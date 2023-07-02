<?php

require_once '../../vendor/autoload.php';

ob_start();
include '../../pages/report/reportheader.php';
$header = ob_get_clean();
// ob_end_clean();

ob_start();
include 'reportinsentifbelumdiajukan-res.php';
$html = ob_get_clean();
// ob_end_clean();

ob_start();
include '../../pages/report/reportfooter.php';
$footer = ob_get_clean();
ob_end_clean();

$mpdf = new \Mpdf\Mpdf([
  'format' => 'A4-P',
  'margin_top' => '32',
  'margin_bottom' => '30'
]);

$mpdf->SetTitle('Amanah | Report Insentif Belum Pengajuan');
$mpdf->SetHTMLHeader($header);
$mpdf->SetHTMLFooter($footer);
$mpdf->WriteHTML($html);
$mpdf->Output('Report Insentif Belum Pengajuan.pdf', 'I');
