<?php

require_once __DIR__ . '/vendor/autoload.php';

use MPDF\MPDF;

$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML('<h1>Hello world!</h1>');
$mpdf->Output();