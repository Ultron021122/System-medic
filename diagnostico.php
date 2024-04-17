<?php
    require_once 'vendor/autoload.php';

    use Dompdf\Dompdf;
    $dompdf =new Dompdf();
    ob_start();
    include('./archivo.php');
    $html=ob_get_clean();
    $options = $dompdf->getOptions();
    $options->set(array('isRemoteEnabled' => true));
    $dompdf->setOptions($options);

    $dompdf->loadHtml($html);

    $dompdf->setPaper('letter');
    // $dompdf->setPaper('A4', 'landscape');
    $dompdf->render();
    header("Content-type: application/pdf");
    header("Content-Disposition: inline; filename=diagnostico.pdf");
    // Output the generated PDF to Browser
    // $dompdf->stream("archivo.pdf", array("Attachment" =>false));
    echo $dompdf->output();

?>