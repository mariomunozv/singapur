<?php
    ob_start();

    if($_GET["tipo"]=="completo"){
        include(dirname(__FILE__).'/res/visitaEscuelaCompleto.php');
    }else{
        include(dirname(__FILE__).'/res/visitaEscuelaCorto.php');
    }
    
    $content = ob_get_clean();

    require_once(dirname(__FILE__).'/../plugins/html2pdf/html2pdf.class.php');
    try
    {
        $html2pdf = new HTML2PDF('P', 'A4', 'fr');
        $html2pdf->setDefaultFont('Arial');
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        $html2pdf->Output('Visita_Escuela.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }

?>