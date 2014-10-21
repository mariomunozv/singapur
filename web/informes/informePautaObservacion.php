<?php
    ob_start();
    include(dirname(__FILE__).'/res/pautaObservacion.php');
    
    $content = ob_get_clean();

    require_once(dirname(__FILE__).'/../plugins/html2pdf/html2pdf.class.php');
    try
    {
        $html2pdf = new HTML2PDF('P', 'A4', 'fr');
        $html2pdf->setDefaultFont('Arial');
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        $str = "pautaObservacion"."".".pdf";
        $html2pdf->Output($str);
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }

?>